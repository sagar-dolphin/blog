

 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-pink">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse flex-row-reverse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link btn btn-light active" aria-current="page" href="/admin/logout"><strong>Logout</strong></a>
        </li>   
      </ul>
    </div>
  </div>
</nav>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 id="headTitle" class="m-0">@yield('heading')</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>