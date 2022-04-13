 <!-- Navigation -->

 <nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top bg-dark">
     <div class="container-fluid">
         <a class="navbar-brand" href="#">Blog</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="{{ route('user.home') }}">Home</a>
                 </li>
                 {{-- <li class="nav-item">
                     <a class="nav-link" href="{{ route('user.about') }}">About</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('user.contact') }}">Contact</a>
                 </li> --}}
             </ul>
         </div>
     </div>
 </nav>

 @if (isset($blogData))
     <div class="container-fluid">
         <div id="carouselExampleFade" class="carousel slide " data-bs-ride="carousel">
             <div class="carousel-inner">
                 @foreach ($blogData->blogImages as $key => $image)
                     @if ($loop->first)
                         <div class="carousel-item active">
                             <img src="{{ asset('admins/images/' . $image->name) }}" class="d-block w-100"
                                 height="500" alt="...">
                         </div>
                     @else
                         <div class="carousel-item">
                             <img src="{{ asset('admins/images/' . $image->name) }}" class="d-block w-100"
                                 height="500" alt="...">
                         </div>
                     @endif
                 @endforeach
             </div>
             <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                 data-bs-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Previous</span>
             </button>
             <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                 data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Next</span>
             </button>
         </div>
         <hr style="border-top: 1px solid black; margin-left: 15rem; margin-right: 15rem; margin-top: 5rem;">
     </div>
 {{-- @else
     <header class="intro-header" style="background-image: url(@yield('bg-img'))">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                     <div class="site-heading">
                         <h1>@yield('title')</h1>
                         <hr class="small">
                         <span class="subheading">@yield('sub-heading')</span>
                     </div>
                 </div>
             </div>
         </div>
     </header> --}}
 @endif
