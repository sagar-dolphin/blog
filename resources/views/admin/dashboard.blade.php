@extends('admin.layouts.app')

@section('title', 'Dashboard')
@push('admin_dashboard_style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

  <!-- Content Wrapper. Contains page content -->

  @section('heading','Dashboard')
      
    <!-- Main content -->
    
    <!-- /.content -->
@endsection



