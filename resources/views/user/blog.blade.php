@extends('user.app')

@section('head')
    <style>
        #showBlogImages {
            vertical-align: middle;
            width: 100%;
            height: 480px;
        }

    </style>
@endsection
@section('title', $blogData->title)
@section('sub-heading', '')

@section('main-content')

    <!-- Main Content-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <h2 class="mt-3">{{$blogData->title}}</h2>
                <!-- Post preview-->
                <div class="post-preview">
                    <p>
                        {{ $blogData->description }}
                    </p>
                    <p class="post-meta">
                        Posted
                        <a href="#!"></a>
                        On {{ $blogData->created_at->format('M d Y')}}
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4">
            </div>
        </div>
    </div>
@endsection
