@extends('user.app')

@section('bg-img', asset('user/img/home-bg.jpg'))
@section('head')
    <style>
        #cardBlog {
            max-width: 750px !important;
            border-radius: 30px;
        }

        #blogImage {
            width: 100%;
            height: 15vw;
            object-fit: cover;
            padding: 19px;
            border-top-left-radius: 35px !important;
            border-bottom-left-radius: 35px !important;
        }

        #blogItems>nav {
            position: relative;
            left: 30rem;
            top: 1rem;
        }

    </style>
@endsection
@section('title', 'Welcome')
@section('sub-heading', 'A Blogging System...')

@section('main-content')

    <!-- Main Content-->
    <div class="container">
        <div class="row justify-content-center">
            <div id="blogItems" class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <!-- Post preview-->
                <div id="renderBlogItems">
                    @include('user.blogItems', ['blogs' => $blogs])
                </div>

                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#blogItems>nav>a').on('click', function(e) {
            e.preventDefault();
            var current = $(this);
            var url = $(this).attr('href');
            baseUrl = url.slice(0, -1);
            $.get(url, function(data) {
                if (data != '') {
                    current.attr(baseUrl+data.previous);
                    $("#renderBlogItems").html(data.html);
                }
            });
        });
    </script>
@endpush
