@extends('admin.layouts.app')

@section('title', 'Users')
@push('yajra_datatable_css_cdn')
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

@section('heading', 'Users')
{{-- @section('data-target', '#addUserModal') --}}

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

@endsection

@push('scripts')

    <script>

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function index() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.index')}}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'asc']],
                paging: true,
                searching: true,
                destroy: true
            });
        }   
        index();

        $("#users-table").on('click', '.edit-user', function(ev){
            ev.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/users/'+id+'/edit',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                type: 'get',
                success: function(data){
                    console.log(data);
                }
            });
            
        })
    </script>
    
@endpush