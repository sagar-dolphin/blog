@extends('admin.layouts.app')

@section('title', 'Blogs')
@push('yajra_datatable_css_cdn')
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
                <h5 class="modal-title mr-auto" id="addBlogModalTitle">Add Blog</h5>
                <span id="formMsgOnError" class="ml-2"></span>
                <button type="button" id="closeBlogModelBtn" class="btn-close btn" data-dismiss="modal"
                    aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form class="addBlogForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Title <b class="text-danger">*</b></label>
                        <input id="title" type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug <b class="text-danger">*</b></label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div>
                    <div class="mb-3">
                        <label id="descLabel" for="desc" class="form-label">Description <b
                                class="text-danger">*</b></label>
                        <textarea id="description" class="editor" name="description" row="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Images </label>
                        <input id="images" type="file" name="images[]" multiple>
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


{{-- Edit Blog Modal --}}
<div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mr-auto" id="editBlogModalTitle">Edit Blog</h5>
                <span id="editFormMsgOnError" class="ml-2"></span>
                <button type="button" id="editCloseBlogModelBtn" class="btn-close btn" data-dismiss="modal"
                    aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form id="editBlogForm" class="editBlogForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Title <b class="text-danger">*</b></label>
                        <input type="hidden" name="blog_id" id="blog_id">
                        <input id="editTitle" type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug <b class="text-danger">*</b></label>
                        <input id="editSlug" type="text" class="form-control" name="slug">
                    </div>
                    <div class="mb-3">
                        <label id="editdesc" for="editdesc" class="form-label">Description <b
                                class="text-danger">*</b></label>
                        <textarea id="editDescription" class="editor" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Images </label>
                        <input id="editImages" type="file" name="images[]" multiple>
                        <div id="preview-images" class="row">

                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" name="status" value="1" id="editStatus" checked> Publish
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeEditBlogModelBtn" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-light">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('editDescription');

    // Show Blogs
    function index() {
        $('#blogs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('blogs.index') }}',
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'image',
                    name: 'image'
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
    }
    index();

    $(document).ready(function() {
        let images = [];
        if (window.File && window.FileList && window.FileReader) {
            $("#images").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i];
                    images.push(files[i]);
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">x</span>" +
                            "</span>").insertAfter("#images");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();    
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(images);
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });

    // Add Blog
    $(".addBlogForm").on('submit', function(ev) {
        ev.preventDefault();
        var formData = new FormData(this);
        $(this).validate({
            ignore: [],
            rules: {
                title: 'required',
                slug: 'required',
                accept: "image/*",
                description: 'required',
                'images[]': {
                    extension: 'jpg,png,jpeg',
                }
            },
            messages: {
                title: '<small class="text-danger">Title is required!</small>',
                slug: '<small class="text-danger">Slug is required!</small>',
                accept: '<small class="text-danger">File should be an image!</small>',
                description: '<small class="text-danger">Description is required!</small>',
                'images[]': {
                    extension: '<small class="text-danger">Only jpg/png/jpeg file is allowed!</small>',
                }
            }
        });
        if ($(this).valid()) {
            $.ajax({
                url: '{{ route('blogs.store') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $(".addBlogForm")[0].reset();
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

    // Update Blog
    $(".editBlogForm").on('submit', function(ev) {
        ev.preventDefault();
        var formData = new FormData(this);
        $(this).validate({
            ignore: [],
            rules: {
                title: 'required',
                slug: 'required',
                accept: "image/*",
                description: 'required',
                'images[]': {
                    extension: 'jpg,png,jpeg',
                }
            },
            messages: {
                title: '<small class="text-danger">Title is required!</small>',
                slug: '<small class="text-danger">Slug is required!</small>',
                accept: '<small class="text-danger">File should be an image!</small>',
                description: '<small class="text-danger">Description is required!</small>',
                'images[]': {
                    extension: '<small class="text-danger">Only jpg/png/jpeg file is allowed!</small>',
                }
            }
        });
        if ($(this).valid()) {

            var id = $("#blog_id").val();
            var url = '{{ route('blogs.update', ':id') }}';
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
                        $(".editBlogForm")[0].reset();
                        $("#closeEditBlogModelBtn").click();
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

    $("#blogs-table").on('click', '.edit-blog', function(ev) {
        ev.preventDefault();
        $(".addBlogForm")[0].reset();
        var id = $(this).data('id');
        var imgs = '';
        var url = '{{ route('blogs.edit', ':id') }}';
        url = url.replace(':id', id);
        $("#addBlogModalTitle").text('Edit Blog');

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            success: function(response) {
                $("#blog_id").val(response[0].id);
                $("#editTitle").val(response[0].title);
                $("#editSlug").val(response[0].slug);
                CKEDITOR.instances.editDescription.setData(response[0].description);
                if (response[0].status == 1) {
                    $('#editStatus').prop('checked', true);
                } else {
                    $('#editStatus').prop('checked', false);
                }
                $("#preview-images").empty();
                $(".pip").empty();
                $.each(response[0].blog_images, function(index, value) {
                    imgs += '<img src="{{ asset('images') }}/' + value.name +
                        '" width="50" height="50" class="img-rounded m-2" />';
                });
                $("#preview-images").append(imgs);
            }
        });
    });

    $("table").on('click', '.delete-blog', function(ev){
        ev.preventDefault();
        var id = $(this).data('id');
        var url = '{{ route('blogs.destroy', ':id') }}';
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            success: function(response){
                if(response.success){
                    setTimeout(() => {
                      $("#blogStatusMsg").text(response.message).show();
                    }, 0);
                    setTimeout(() => {
                      $("#blogStatusMsg").fadeOut();
                    }, 3000);
                    $("#blogStatusMsg").addClass('alert alert-danger');
                    index();
                  }
            }
        });
    });

</script>
@endpush
