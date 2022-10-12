<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CWS Machine Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container mt-2">
        <div class="card">
            <div class="card-header row">
                <div class="col-md-4">
                    <h2>CWS Machine Test</h2>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <button class="btn btn-success" onClick="add()"> Create User</button>
                </div>
            </div>
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card-body">
                <table class="table table-bordered" id="user-view'">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Email ID</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> @php $i=1; @endphp
                        @foreach($data as $users)
                            <tr class="">
                                <td class="">{{ $i++ }}</td>
                                <td class="">{{ $users->first_name??null }}</td>
                                <td class="">{{ $users->last_name??null }}</td>
                                <td class="">{{ $users->phone??null }}</td>
                                <td class="">{{ $users->email??null }}</td>
                                <td class="">{{ $users->address??null }}</td>
                                <td class="">{{ $users->dob??null }}</td>
                                <td class="">{{ $users->gender??null }}</td>
                                <td class=""><a href="javascript:void(0)" data-toggle="tooltip"
                                        onClick="editFunc({{ $users->id??null }})" data-original-title="Edit"
                                        class="edit btn btn-success edit">
                                        Edit
                                    </a>
                                    <a href="javascript:void(0);" id="delete-user"
                                        onClick="deleteFunc({{ $users->id??null }})" data-toggle="tooltip"
                                        data-original-title="Delete" class="delete btn btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- boostrap user model -->
    <div class="modal fade" id="user-modal1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userModal1"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="userForm" name="userForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="Enter First Name" maxlength="50" value="">
                                @if($errors->has('first_name'))
                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Enter Last Name" maxlength="50" value="">
                                @if($errors->has('last_name'))
                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">User Phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter User Phone Number" maxlength="50" value="">
                                @if($errors->has('phone'))
                                    <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">User Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter User Email" maxlength="50" value="">
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">User Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter User Address" value="">
                                @if($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date of Birth</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="dob" name="dob"
                                    placeholder="Enter Date of Birth" value="">
                                @if($errors->has('dob'))
                                    <div class="error">{{ $errors->first('dob') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-form-label">Gender: &nbsp;&nbsp;</label>
                            <input type="radio" id="male" name="gender" value="Male"> Male &nbsp;&nbsp;
                            <input type="radio" id="female" name="gender" value="Female"> Female &nbsp;&nbsp;
                            <input type="radio" id="other" name="gender" value="Other"> Other
                            @if($errors->has('gender'))
                                <div class="error">{{ $errors->first('gender') }}</div>
                            @endif
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload Resume</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="resume" name="resume">
                        @if($errors->has('resume'))
                            <div class="error">{{ $errors->first('resume') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">User Photo</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="user_photo" name="user_photo">
                        @if($errors->has('user_photo'))
                            <div class="error">{{ $errors->first('user_photo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                    </button>
                </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    </div>
    <!-- end bootstrap model -->

    <!-- boostrap user model -->
    <div class="modal fade" id="user-modal2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userModal2"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="userForm" name="userForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="{{ $data[0]->id }}">
                        <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="Enter First Name" maxlength="50"
                                    value="{{ $data ? $data[0]->first_name : '' }}">
                                @if($errors->has('first_name'))
                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Enter Last Name" maxlength="50"
                                    value="{{ $data ? $data[0]->last_name : '' }}">
                                @if($errors->has('last_name'))
                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">User Phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter User Phone Number" maxlength="50"
                                    value="{{ $data ? $data[0]->phone : '' }}">
                                @if($errors->has('phone'))
                                    <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">User Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter User Email" maxlength="50"
                                    value="{{ $data ? $data[0]->email : '' }}">
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">User Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter User Address"
                                    value="{{ $data ? $data[0]->address : '' }}">
                                @if($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date of Birth</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="dob" name="dob"
                                    placeholder="Enter Date of Birth"
                                    value="{{ $data ? $data[0]->dob : '' }}">
                                @if($errors->has('dob'))
                                    <div class="error">{{ $errors->first('dob') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-form-label">Gender: &nbsp;&nbsp;</label>
                            <input type="radio" id="male" name="gender" value="Male"
                                checked="{{ ($data && $data[0]->gender=='Male') ? 'checked' : '' }}">
                            Male &nbsp;&nbsp;
                            <input type="radio" id="female" name="gender" value="Female"
                                checked="{{ ($data && $data[0]->gender=='Female') ? 'checked' : '' }}">
                            Female &nbsp;&nbsp;
                            <input type="radio" id="other" name="gender" value="Other"
                                checked="{{ ($data && $data[0]->gender=='Other') ? 'checked' : '' }}">
                            Other
                            @if($errors->has('gender'))
                                <div class="error">{{ $errors->first('gender') }}</div>
                            @endif
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload Resume</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="resume" name="resume">
                        @if($errors->has('resume'))
                            <div class="error">{{ $errors->first('resume') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">User Photo</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="user_photo" name="user_photo">
                        @if($errors->has('user_photo'))
                            <div class="error">{{ $errors->first('user_photo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                    </button>
                </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    </div>
    <!-- end bootstrap model -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#user-view').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('user-view') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'dob',
                    name: 'dob'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });

        //-----------form validation----------------

        $.validator.addMethod('latter_only', function (value) {
            return /^[a-z\.\s]+$/i.test(value);
        }, 'Type Letters Only.');

        $("#userForm").validate({
            rules: {
                first_name: {
                    required: true,
                    latter_only: true,
                    minlength: 3,
                    maxlength: 15
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                dob: {
                    required: true
                },
                address: {
                    required: true,
                    minlength: 4,
                    maxlength: 100
                },
                gender: {
                    required: true
                },
                resume: {
                    required: true,
                    extension: 'docx|doc|pdf',
                    filesize: 2000
                },
                user_photo: {
                    required: true,
                    extension: 'jpg|png',
                    filesize: 2000
                },
            },
            messages: {
                first_names: {
                    required: 'Please Fill This Field',
                    only_latter: 'Type Letters Only.'
                },
                last_name: {
                    required: 'Please Fill This Field',
                    only_latter: 'Type Letters Only.'
                },
                resume: "File must be in PDF, Docx or Doc Format and size must be 2 MB",
                user_photo: "Photo must be in jpg or png and size must be 2 MB",
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
    });

    function add() {
        $('#userForm').trigger("reset");
        $('#userModal1').html("Add User");
        $('#user-modal1').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $('#user-modal2').modal('show');
        $.ajax({
            type: "POST",
            url: "{{ url('edit-user') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#userModal2').html("Edit User");
                $('#user-modal2').modal('show');
                $('#id').val(res.id);
                $('#first_name').val(res.first_name);
                $('#last_name').val(res.last_name);
                $('#phone').val(res.phone);
                $('#email').val(res.email);
                $('#address').val(res.address);
                $('#dob').val(res.dob);
                $('#gender').val(res.gender);
            }
        });
    }

    function deleteFunc(id) {
        if (confirm("Delete Record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('delete-user') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    var oTable = $('#user-view').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }


    $('#userForm').submit(function (e) {
        e.preventDefault();
        var formValid = $('#userForm').valid();
        var formData = new FormData(this);
        if (formValid) {
            $.ajax({
                type: 'POST',
                url: "{{ url('store-user') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    // $("#user-modal1").modal('hide');
                    // $("#user-modal2").modal('hide');
                    var oTable = $('#user-view').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });

    

</html>
