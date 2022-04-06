@extends('admin.layouts.app')

@section('title', 'Users')
@push('yajra_datatable_css_cdn')
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

@section('heading', 'Users')
@section('data-target', '#addUserModal')

{{-- User's Datatable --}}
<table class="table table-bordered text-center" id="users-table">
    <span id="userStatusMsg"></span>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
</table>


{{-- Add User Modal --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mr-auto" id="addUserModalTitle">Add User</h5>
                <span id="formMsgOnError" class="ml-2"></span>
                <button type="button" id="closeUserModelBtn" class="btn-close btn" data-dismiss="modal"
                    aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form class="addUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                        <input id="name" type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email <b class="text-danger">*</b></label>
                        <input id="email" type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <b class="text-danger">*</b></label>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeUserFormBtn" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-light">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>


{{-- Edit/Update User Modal --}}
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mr-auto" id="addUserModalTitle">Edit User</h5>
                <span id="formMsgOnError" class="ml-2"></span>
                <button type="button" id="closeUserModelBtn" class="btn-close btn" data-dismiss="modal"
                    aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form class="editUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                        <input id="user_id" type="hidden" name="user_id">
                        <input id="editName" type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Email <b class="text-danger">*</b></label>
                        <input id="editEmail" type="email" class="form-control" name="email">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="slug" class="form-label">Password <b class="text-danger">*</b></label>
                        <input id="editPassword" type="password" class="form-control" name="password">
                    </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" id="closeEditUserFormBtn" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-light">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.index') }}',
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'asc']
            ],
            paging: true,
            searching: true,
            destroy: true
        });

        $(".addUserForm").on('submit', function(ev) {
            ev.preventDefault();
            var formData = new FormData(this);
            $(this).validate({
                ignore: [],
                rules: {
                    name: 'required',
                    email: {
                        email: true,
                        required: true,
                    },
                    password: 'required',
                },
                messages: {
                    name: '<small class="text-danger">Name is required!</small>',
                    email: {
                        email: '<small class="text-danger">Invalid email!</small>',
                        required: '<small class="text-danger">Email is required!</small>'
                    },
                    password: '<small class="text-danger">Password is required!</small>',
                }
            });

            if ($(this).valid()) {
                $.ajax({
                    url: '{{ route('users.store') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $(".addUserForm")[0].reset();

                            $("#closeUserModelBtn").click();
                            $("#userStatusMsg").text(response.message);
                            setTimeout(() => {
                                $("#userStatusMsg").text(response.message).show();
                            }, 0);
                            setTimeout(() => {
                                $("#userStatusMsg").fadeOut();
                            }, 3000);
                            $("#userStatusMsg").addClass('alert alert-success');
                            index();
                        }
                    },
                });
            }
        });

        $("#users-table").on('click', '.edit-user', function(ev) {
            ev.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            var url = '{{ route('users.edit', ':id') }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                type: 'get',
                success: function(data) {
                    console.log(data);
                    $("#user_id").val(data.id);
                    $("#editName").val(data.name);
                    $("#editEmail").val(data.email);
                }
            });

        });

        $(".editUserForm").on('submit', function(ev) {
            ev.preventDefault();
            var formData = new FormData(this);
            $(this).validate({
                ignore: [],
                rules: {
                    name: 'required',
                    email: {
                        email: true,
                        required: true,
                    },
                },
                messages: {
                    name: '<small class="text-danger">Name is required!</small>',
                    email: {
                        email: '<small class="text-danger">Invalid email!</small>',
                        required: '<small class="text-danger">Email is required!</small>'
                    },
                }
            });
            if ($(this).valid()) {
                var id = $("#user_id").val();
                var url = '{{ route('users.update', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $(".editUserForm")[0].reset();

                            $("#closeEditUserFormBtn").click();
                            $("#userStatusMsg").text(response.message);
                            setTimeout(() => {
                                $("#userStatusMsg").text(response.message).show();
                            }, 0);
                            setTimeout(() => {
                                $("#userStatusMsg").fadeOut();
                            }, 3000);
                            $("#userStatusMsg").addClass('alert alert-success');
                            index();
                        }
                    },
                });
            }
        });

        $("table").on('click', '.delete-user', function(ev) {
            ev.preventDefault();
            var id = $(this).data('id');
            var url = '{{ route('users.destroy', ':id') }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                type: 'delete',
                success: function(response) {
                    if (response.success) {
                        setTimeout(() => {
                            $("#userStatusMsg").text(response.message).show();
                        }, 0);
                        setTimeout(() => {
                            $("#userStatusMsg").fadeOut();
                        }, 3000);
                        $("#userStatusMsg").addClass('alert alert-danger');
                        index();
                    }
                }
            });
        });

    });
</script>
@endpush
