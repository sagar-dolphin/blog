<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    @include('admin.layouts.includes.head')
    @stack('yajra_datatable_css_cdn')
    @stack('admin_dashboard_style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.layouts.includes.header')
    @include('admin.layouts.includes.sidebar')
    @section('main-content')
    @show
    @include('admin.layouts.includes.footer')
    
    @stack('scripts')
</div>
</body>
</html>