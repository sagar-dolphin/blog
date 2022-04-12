@extends('user.app')

@section('bg-img', asset('user/img/home-bg.jpg'))
@section('head')
    <style>
        #cardBlog {
            max-width: 750px !important;
            border-radius: 30px;
        }

        #blogImage {
            border-radius: 20px;
        }

    </style>
@endsection
@section('title', 'Welcome')
@section('sub-heading', 'A Blogging System...')

@section('main-content')

    <!-- Main Content-->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <!-- Post preview-->
                @foreach ($blogs as $blog)
                    <div id="cardBlog" class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img id="blogImage" src="{{ asset('admins/images/' . $blog->blogImages[0]->name) }}"
                                    height="230" width="230" class="img-fluid rounded-start" alt="not found">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="{{ route('user.show', encrypt($blog->id)) }}" class="card-title">
                                        <h3>{{ $blog->title }}</h3>
                                    </a>
                                    <p class="card-text">{{ str_limit(strip_tags($blog->description), 90) }}
                                        @if (strlen(strip_tags($blog->description)) > 90)
                                            <a href="{{ route('user.show', encrypt($blog->id)) }}"
                                                class="btn-sm">Read More</a>
                                        @endif
                                    </p>
                                    <p class="card-text"><small class="text-muted">Created at
                                            {{ $blog->created_at->toDateString() }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider-->
                    <hr class="my-4">
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
