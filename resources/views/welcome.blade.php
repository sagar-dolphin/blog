@extends('user.app')

@section('bg-img',asset('user/img/home-bg.jpg'))
@section('head')

@endsection
@section('title','Welcome')
@section('sub-heading','A Blogging System...')

@section('main-content')

    <!-- Main Content-->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <!-- Post preview-->
                @foreach ($blogs as $blog)
                    <div class="post-preview">
                        <a href="{{route('user.show', encrypt($blog->id))}}">
                            <h2 class="post-title">{{$blog->title}}</h2>
                        </a>
                        <p class="post-meta">
                            Posted
                            <a href="#!"></a>
                            On {{$blog->created_at->toDateString()}}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4">
                @endforeach
                
                {{-- <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div> --}}
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection