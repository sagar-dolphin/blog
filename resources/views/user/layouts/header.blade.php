 <!-- Navigation -->
 <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
     <div class="container-fluid">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header page-scroll">
             <button type="button" class="navbar-toggle" data-toggle="collapse"
                 data-target="#bs-example-navbar-collapse-1">
                 <span class="sr-only">Toggle navigation</span>
                 Menu <i class="fa fa-bars"></i>
             </button>
             <a class="navbar-brand" href="{{ route('user.home') }}">Blog</a>
         </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav navbar-right">
                 <li>
                     <a href="{{ route('user.home') }}">Home</a>
                 </li>
                 <li>
                     <a href="{{ route('user.about') }}">About</a>
                 </li>
                 <li>
                     <a href="{{ route('user.contact') }}">Contact</a>
                 </li>
             </ul>
         </div>
         <!-- /.navbar-collapse -->
     </div>
     <!-- /.container -->
 </nav>

 <!-- Page Header -->
 <!-- Set your background image for this header on the line below. -->
 @if (isset($blogData))
     <div class="container">
         @foreach ($blogData->blogImages as $key => $image)
             @if ($key == 0)
                 <div class="row m-3">
                     <h1>@yield('title')</h1>
                     <div class="jumbotron">
                         <img id="showBlogImages" src="{{ asset('admins/images/' . $image->name) }}"
                             alt="Image Not Found">
                     </div>
                 </div>
                 <div class="row text-center">
                 @else
                     <img src="{{ asset('admins/images/' . $image->name) }}" height="80" width="80"
                         alt="Image Not Found">
             @endif
         @endforeach
     </div>
     <hr style="border-top:1px solid grey;">
     </div>
 @else
     <header class="intro-header" style="background-image: url(@yield('bg-img'))">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                     <div class="site-heading">
                         <h1>@yield('title')</h1>
                         <hr class="small">
                         <span class="subheading">@yield('sub-heading')</span>
                     </div>
                 </div>
             </div>
         </div>
     </header>
 @endif


 <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach ($blogData->blogImages as $image)
        @if ($loop->first)
        <div class="carousel-item active">
            <img src="{{asset('admins/images/'.$image->name)}}" class="d-block w-100" alt="...">
          </div>
        @else
        <div class="carousel-item">
            <img src="{{asset('admins/images/'.$image->name)}}" class="d-block w-100" alt="...">
          </div>
        @endif
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>