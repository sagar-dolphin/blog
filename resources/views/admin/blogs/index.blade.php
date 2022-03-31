@extends('admin.layouts.app')

@section('title', 'Blogs')
@push('yajra_datatable_css_cdn')
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
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
          <h5 class="modal-title mr-auto" id="addBlogModalTitle">Add Blog</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" id="closeBlogModelBtn" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form class="addBlogForm" method="POST" enctype="multipart/form-data">
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
                    <textarea class="editor" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Images <b class="text-danger">*</b></label>
                    <div class="dropzone">

                    </div>
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


  {{-- Edit Blog Modal
  <div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mr-auto" id="editBlogModalTitle">Edit Blog</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" id="editCloseBlogModelBtn" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="editBlogForm" method="POST" enctype="multipart/form-data">
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
                    <textarea class="editor" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Images <b class="text-danger">*</b></label>
                    <div class="input-images"></div>
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
  </div> --}}

@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script>

        // Image Uploader   
        $(".dropzone").dropzone({
            url: '/admin/blogs/store',
        });

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        ClassicEditor
            .create( document.querySelector( '.editor' ) )
            .catch( error => {
                console.error( error );
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
                    {data: 'image', name: 'image'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'asc']],
                paging: true,
                searching: true,
                destroy: true
            });
        }   
        index();
         
        var images = [];
        // Image Uploading
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("[type='file']").on("change", function(e) {
                    var files = e.target.files;
                    filesLength = files.length; 
                    for(let i=0; i<filesLength; i++){
                        images.push(files[i]);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });

        $("[type='file']").attr('name', 'images[]');

        $(".addBlogForm").on('submit', function(ev){
            ev.preventDefault();
            var formData = new FormData(this);
            formData.append('images', JSON.stringify(images));
            for(var pair of formData.entries()) {
                console.log(pair[0]+ ', '+ pair[1]);
            }
            $(this).validate({
                ignore: [],
                rules: {
                    title: 'required',
                    slug: 'required',
                    accept: "image/*",
                    description: 'required',
                    // 'images[]': {
                    //     required: true,
                    //     extension: 'jpg,png,jpeg',
                    // }
                },
                messages: {
                    title: '<small class="text-danger">Title is required!</small>',
                    slug: '<small class="text-danger">Slug is required!</small>',
                    accept: '<small class="text-danger">File should be an image!</small>',
                    description: '<small class="text-danger">Description is required!</small>',
                    // 'images[]': {
                    //    required: '<small class="text-danger">Image is required!</small>',
                    //    extension: '<small class="text-danger">Only jpg/png/jpeg file is allowed!</small>',
                    // }
                }
            });
            if($(this).valid()){
                    $.ajax({
                    url: '{{ route('blogs.store')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.success){
                            $("#addBlogForm")[0].reset();
                            $("#closeBlogModelBtn").click();
                            $("#blogStatusMsg").text(response.message);
                            setTimeout(() => {
                            $("#blogStatusMsg").text(response.message).show();
                            }, 0);
                            setTimeout(() => {
                            $("#blogStatusMsg").fadeOut();
                            }, 3000);
                            $("#blogStatusMsg").addClass('alert alert-success');
                            index();
                        }
                    },
                });
            }
        });

        $("#blogs-table").on('click', '.edit-blog', function(ev){
            ev.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route('blogs.edit', 'id')}}',
                type: 'get',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                success: function(response){
                    console.log(response);
                }
            })
        });


    </script>
    
   
@endpush