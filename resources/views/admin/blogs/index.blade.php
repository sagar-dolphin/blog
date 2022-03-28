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
                <th>Status</th>
                <th>Created_by</th>
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
            <form id="addBlogForm" method="Post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Title <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="title" id="title">
                    @if ($errors->has('title'))
                        <small class="text-danger">{{ $errors->first('title') }}</small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="slug" id="slug">
                </div>
                @if ($errors->has('slug'))
                    <small class="text-danger">{{ $errors->first('slug') }}</small>
                @endif
                <div class="mb-3">
                    <label id="description-msg" for="name" class="form-label">Description <b class="text-danger">*</b></label>
                    <textarea id="editor" name="description"></textarea>
                </div>
                @if ($errors->has('description'))
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Images <b class="text-danger">*</b></label>
                    <input type="file" name="images[]" id="image" multiple>
                </div>
                @if ($errors->has('images'))
                    <small class="text-danger">{{ $errors->first('images') }}</small>
                @endif
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>   
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

        $("#addBlogForm").on('submit', function(ev){
            ev.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '/admin/blogs/store',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response);
                }
            });
        })


    </script>
    
   
@endpush