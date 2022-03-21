
<div id="sidebar" class="d-flex shadow fixed-top flex-column flex-shrink-0 p-2 bg-pink" style="width: 250px; height:950px">
  <h1 class="m-3"><i class="fa fa-blog"></i></h1>
  <a href="/" class="align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
  </a>

  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}" aria-current="page">
        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
        Dashboard   
      </a>
    </li>
    <li>
      <a href="/admin/users" class="nav-link link-dark {{ request()->is('admin/users*') ? 'active' : '' }}">
        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
        Users
      </a>
    </li>
    <li>
      <a href="/admin/blogs" class="nav-link link-dark {{ request()->is('admin/blogs*') ? 'active' : '' }}">
        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
        Blogs
      </a>
    </li>
  </ul>
  <hr>  
</div>