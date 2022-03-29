@extends('admin.layouts.app')

@section('title', 'Blogs')
@push('yajra_datatable_css_cdn')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

@section('heading', 'Blogs')
@section('data-target', '#addBlogModal')
    
    {{-- User's Datatable --}}
    <table class="table table-bordered text-center" id="blogs-table">
        <span id="blogStatusMsg"></span>
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    {{-- Add Blog Modal --}}
  <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mr-auto" id="addBlogModal">Add Blog</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="addBlogForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Title <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="slug">
                </div>
                <div class="mb-3">
                    <label id="description" for="name" class="form-label">Description <b class="text-danger">*</b></label>
                    <textarea id="editor" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Images <b class="text-danger">*</b></label>
                    <input type="file" name="images[]" multiple>
                </div>
                <div class="mb-3">
                    <input type="checkbox" name="status" value="1" id="status" checked> Publish
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeBlogFormBtn" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-light">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function index() {
            $('#blogs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('blogs.index')}}',
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'slug', name: 'slug'},
                    {data: 'description', name: 'description'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'asc']],
                paging: true,
                searching: true,
                destroy: true
            });
        }   
        index();

        $("#addBlogForm").on('submit', function(ev){
            ev.preventDefault();
            console.log('submit');
            var formData = new FormData(this);
            $(this).validate({
                ignore: [],
                rules: {
                    title: 'required',
                    slug: 'required',
                    accept: "image/*",
                    description: 'required',
                    'images[]': {
                        required: true,
                        extension: 'jpg,png,jpeg',
                    }
                },
                messages: {
                    title: '<small class="text-danger">Title is required!</small>',
                    slug: '<small class="text-danger">Slug is required!</small>',
                    accept: '<small class="text-danger">File should be an image!</small>',
                    description: '<small class="text-danger">Description is required!</small>',
                    'images[]': {
                       required: '<small class="text-danger">Image is required!</small>',
                       extension: '<small class="text-danger">Only jpg/png/jpeg file is allowed!</small>',
                    }
                }
            });
            if($(this).valid()){
                    $.ajax({
                    url: '/admin/blogs/store',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log(response);
                    },
                });
            }
        });


    </script>
    
   
@endpush