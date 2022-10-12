<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    # User View
    public function index()
    {   
        $data = User::select('id','first_name','last_name','phone','email','address','dob','gender','resume','user_photo')->get();

        //if(request()->ajax()) {
            // return atatables::of(User::select('*'))
            // ->addColumn('action', 'action')
            // ->rawColumns(['action'])
            // ->addIndexColumn()
            // ->make(true);
        //}
        return view('users')->with('data',$data);
    }

    #save User
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required',
            'dob' => 'required|date|before:-18 years',
            'gender' => 'required',
            'resume' => 'required|mimes:pdf,docx,doc|max:2000',
            'user_photo' => 'required|image|mimes:jpg,png|max:200',
            ],
            [
                'first_name.required' => 'First Name is required',
                'last_name.required' => 'Last Name is required',
                'phone.required' => 'Phone is required',
                'email.required' => 'Email is required',
                'address.required' => 'Address is required',
                'dob.required' => 'Date of Birth is required',
                'gender.required' => 'Gender is required',
                'resume.required' => 'Resume is required',
                'user_photo.required' => 'User Photo is required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $userId = $request->id;
 
        $user   =   User::updateOrCreate(
                    [
                     'id' => $userId
                    ],
                    [
                    'first_name' => $request->first_name, 
                    'last_name' => $request->last_name, 
                    'phone' => $request->phone, 
                    'email' => $request->email,
                    'address' => $request->address,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'resume' => $request->resume, 
                    'user_photo' => $request->user_photo,  
                    ]);    
                    session()->flash("success","Successful.");                
        return Response()->json($user);
 
    }

    #Edit-User
    public function edit(Request $request)
    {   
        $id =  $request->id;
        $data  = User::select('id','first_name','last_name','phone','email','address','dob','gender')->where('id',$id)->first();
        //print_r($data);die;
        //session()->flash("success","User Data Updated Successfully.");
        return view('users',compact('id'))->with('data',$data);
    }
      
      
    #Delete-User
    public function destroy(Request $request)
    {
        $user = User::where('id',$request->id)->delete();
        session()->flash("success","Data Deleted Successfully.");
        return view('users');
    }
}
