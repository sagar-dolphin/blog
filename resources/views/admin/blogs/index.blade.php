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
            <th>No.</th>
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
                <form class="addBlogForm" id="addBlogForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Title <b class="text-danger">*</b></label>
                        <input id="title" type="text" class="form-control" name="title">
                        <div id="errorTitle"></div>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="slug" class="form-label">Slug <b class="text-danger">*</b></label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div> --}}
                    <div class="mb-3">
                        <label id="descLabel" for="desc" class="form-label">Description <b
                                class="text-danger">*</b></label>
                        <textarea id="description" class="editor" name="description" row="10"></textarea>
                        <div id="errorDescription"></div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Images </label>
                        <input id="images" type="file" name="images[]" multiple>
                        <div class=" text-center" id="display_product_list">
                            <ul id="blog-image-list"></ul>
                        </div>
                        <div id="errorImages"></div>
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
                <form id="editBlogForm" method="POST" class="editBlogForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Title <b class="text-danger">*</b></label>
                        <input type="hidden" name="blog_id" id="blog_id">
                        <input id="editTitle" type="text" class="form-control" name="title">
                        <div id="editErrorTitle"></div>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="slug" class="form-label">Slug <b class="text-danger">*</b></label>
                        <input id="editSlug" type="text" class="form-control" name="slug">
                    </div> --}}
                    <div class="mb-3">
                        <label id="editdesc" for="editdesc" class="form-label">Description <b
                                class="text-danger">*</b></label>
                        <textarea id="editDescription" class="editor" name="description"></textarea>
                        <div id="editErrorDesc"></div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Images </label>
                        <input id="editImages" type="file" name="images[]" multiple>
                        <div id="editErrorImages"></div>
                        <div class=" text-center" id="edit_display_product_list">
                            <ul id="edit-blog-image-list"></ul>
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

    $(function() {
        var table = $('#blogs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('blogs.index') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'description',
                    name: 'description',
                    orderable: false
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ],
            paging: true,
            searching: true,
            destroy: true
        });

        // $("#images").on("change", function(e) {
        //     $(".pip").empty();
        //     var files = e.target.files,
        //         filesLength = files.length;
        //     for (var i = 0; i < filesLength; i++) {
        //         var f = files[i];
        //         var fileReader = new FileReader();
        //         fileReader.onload = (function(e) {
        //             var file = e.target;
        //             $("<span class=\"pip\">" +
        //                 "<img class=\"imageThumb\" src=\"" + e.target.result +
        //                 "\" title=\"" + file.name + "\"/>" +
        //                 "<br/><span class=\"remove\">x</span>" +
        //                 "</span>").insertAfter("#images");
        //             $(".remove").click(function() {
        //                 $(this).parent(".pip").remove();
        //             });
        //         });
        //         fileReader.readAsDataURL(f);
        //     }
        //     $.ajax({
        //         url: '{{ route('blogs.images.upload') }}',
        //         type: 'post',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        //         },
        //         data: {images: files},
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             console.log(response);
        //         }
        //     });
        //     console.log(images);
        // });

        var input_file = document.getElementById('images');
        var image_dynamic_id = 0;
        var remove_image_ids = [];
        $("#images").change(function(e) {
            remove_image_ids = [];
            image_dynamic_id = 0;
            var len = e.target.files.length;
            $('#display_product_list ul').html("");
            for (var j = 0; j < len; j++) {
                var src = "";
                var name = event.target.files[j].name;
                var mime_type = event.target.files[j].type.split("/");
                if (mime_type[0] == "image") {
                    src = URL.createObjectURL(event.target.files[j]);
                }
                $('#display_product_list ul').append("<li id='" + image_dynamic_id +
                    "'><div class='ic-sing-file'><img class='imageThumb' id='" +
                    image_dynamic_id + "' src='" + src +
                    "' title='" + name + "'><p class='close' id='" + image_dynamic_id +
                    "'>X</p></div></li>");
                image_dynamic_id++;
            }
        });
        $(document).on('click', 'p.close', function() {
            var id = $(this).attr('id');
            remove_image_ids.push(id);
            $('li#' + id).remove();
            if (("li").length == 0) document.getElementById('products_uploaded').value = "";
        });

        // Add Blog
        $("#addBlogModal").on('submit', '.addBlogForm', function(ev) {
            ev.preventDefault();
            console.log('submit clicked');
            var formData = new FormData(this);
            formData.append("remove_image_ids", remove_image_ids);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
            $(this).validate({
                ignore: [],
                rules: {
                    title: 'required',
                    // slug: 'required',
                    accept: "image/*",
                    description: 'required',
                    'images[]': {
                        extension: 'jpg,png,jpeg',
                    }
                },
                messages: {
                    title: '<small class="text-danger">Title is required!</small>',
                    // slug: '<small class="text-danger">Slug is required!</small>',
                    accept: '<small class="text-danger">File should be an image!</small>',
                    description: '<small class="text-danger">Description is required!</small>',
                    'images[]': {
                        extension: '<small class="text-danger">Only jpg/png/jpeg file is allowed!</small>',
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "description") {
                        error.appendTo("#errorDescription");
                    }
                    if (element.attr("name") == "title") {
                        error.appendTo("#errorTitle")
                    }
                    if (element.attr("name") == "images") {
                        error.appendTo("#errorImages")
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
                            $("#addBlogForm")[0].reset();
                            $("#blog-image-list").empty();
                            CKEDITOR.instances.description.setData('');
                            $("#closeBlogModelBtn").click();
                            $("#blogStatusMsg").text(response.message);
                            setTimeout(() => {
                                $("#blogStatusMsg").text(response.message).show();
                            }, 0);
                            setTimeout(() => {
                                $("#blogStatusMsg").fadeOut();
                            }, 3000);
                            $("#blogStatusMsg").addClass('alert alert-success');
                            table.draw();
                        }
                    },
                });
            }
        });

        // Update Blog
        $("#editBlogModal").on('submit', '.editBlogForm', function(ev) {
            ev.preventDefault();
            var formData = new FormData(this);
            $(this).validate({
                ignore: [],
                rules: {
                    title: 'required',
                    // slug: 'required',
                    accept: "image/*",
                    description: 'required',
                    'images[]': {
                        extension: 'jpg,png,jpeg',
                    }
                },
                messages: {
                    title: '<small class="text-danger">Title is required!</small>',
                    // slug: '<small class="text-danger">Slug is required!</small>',
                    accept: '<small class="text-danger">File should be an image!</small>',
                    description: '<small class="text-danger">Description is required!</small>',
                    'images[]': {
                        extension: '<small class="text-danger">Only jpg/png/jpeg file is allowed!</small>',
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "description") {
                        error.appendTo("#editErrorDesc");
                    }
                    if (element.attr("name") == "title") {
                        error.appendTo("#editErrorTitle")
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
                            $("#blog-image-list").empty();
                            CKEDITOR.instances.description.setData('');
                            $("#closeEditBlogModelBtn").click();
                            $("#blogStatusMsg").text(response.message);
                            setTimeout(() => {
                                $("#blogStatusMsg").text(response.message).show();
                            }, 0);
                            setTimeout(() => {
                                $("#blogStatusMsg").fadeOut();
                            }, 3000);
                            $("#blogStatusMsg").addClass('alert alert-success');
                            table.draw();
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
                    console.log("response:: ", response);
                    $("#blog_id").val(response.id);
                    $("#editTitle").val(response.title);
                    $("#editSlug").val(response.slug);
                    CKEDITOR.instances.editDescription.setData(response.description);
                    if (response.status == 1) {
                        $('#editStatus').prop('checked', true);
                    } else {
                        $('#editStatus').prop('checked', false);
                    }
                    $("#preview-images").empty();
                    $(".pip").empty();
                    // $.each(response.blog_images, function(index, value) {
                    //     imgs += '<img src="{{ asset('images') }}/' + value.name +
                    //         '" width="50" height="50" class="img-rounded m-2" />';
                    // });
                    // $("#preview-images").append(imgs);
                    remove_image_ids = [];
                    image_dynamic_id = 0;
                    var len = response.blog_images.length;
                    $('#edit_display_product_list ul').html("");
                    for (var j = 0; j < len; j++) {
                        var src = response.blog_images[j].name;
                        var name = response.blog_images[j].name;
                        $('#edit_display_product_list ul').append("<li id='" +
                            image_dynamic_id +
                            "'><div class='ic-sing-file'><img class='imageThumb' id='" +
                            image_dynamic_id + "' src='{{ asset('images') }}/" + src +
                            "' title='" + name + "'><p class='close' id='" +
                            image_dynamic_id +
                            "'>X</p></div></li>");
                        image_dynamic_id++;
                    }
                    $("#editImages").on('change', function(e) {
                            var len = e.target.files.length;
                            for (var j = 0; j < len; j++) {
                                var src = "";
                                var name = event.target.files[j].name;
                                var mime_type = event.target.files[j].type.split(
                                    "/");
                                if (mime_type[0] == "image") {
                                    src = URL.createObjectURL(event.target.files[
                                    j]);
                                }
                                $('#edit_display_product_list ul').append("<li id='" +
                                    image_dynamic_id +
                                    "'><div class='ic-sing-file'><img class='imageThumb' id='" +
                                    image_dynamic_id + "' src='" + src +
                                    "' title='" + name +
                                    "'><p class='close' id='" +
                                    image_dynamic_id +
                                    "'>X</p></div></li>");
                                image_dynamic_id++;
                            }
                        });
                }
            });
        });

        $("table").on('click', '.delete-blog', function(ev) {
            ev.preventDefault();
            swal({
                    title: `Are you sure you want to delete this blog?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).data('id');
                        var url = '{{ route('blogs.destroy', ':id') }}';
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            type: 'delete',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    setTimeout(() => {
                                        $("#blogStatusMsg").text(response
                                            .message).show();
                                    }, 0);
                                    setTimeout(() => {
                                        $("#blogStatusMsg").fadeOut();
                                    }, 3000);
                                    $("#blogStatusMsg").addClass('alert alert-danger');
                                    table.draw();
                                }
                            }
                        });
                    }
                });

        });
    });
</script>
@endpush
