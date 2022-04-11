@extends('user.app')

@section('bg-img',asset('user/img/about-bg.jpg'))
	
@section('title', $blog->title)
@section('sub-heading','')

@section('main-content')

<!-- Main Content-->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <!-- Post preview-->
                <div class="post-preview">
                    <p>
                        {{$blog->description}}
                    </p>
                    <p class="post-meta">
                        Posted
                        <a href="#!"></a>
                        On {{$blog->created_at->toDateString()}}
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4">
            
            {{-- <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div> --}}
        </div>
    </div>
</div>
@endsection