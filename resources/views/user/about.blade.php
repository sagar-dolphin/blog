@extends('user.app')

@section('bg-img',asset('user/img/post-bg.jpg'))
{{-- @section('head')
    <link rel="stylesheet" href="{{ asset('user/css/prism.css') }}">
@endsection --}}
@section('title', 'About Me')
@section('sub-heading','This is what i do.')

@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo totam dicta ea, fugiat nobis et nihil quam expedita esse laborum distinctio voluptatum. Optio sapiente hic ut architecto accusantium officiis rem.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem quo iure officiis, cumque illo earum quos temporibus nihil ut eveniet. Ad dignissimos asperiores quam? Tenetur saepe quia nulla placeat natus.</p>
        </div>
    </div>
</div>

@endsection

{{-- @section('footer')
    <script src="{{ asset('user/js/prism.js') }}"></script>
@endsection --}}