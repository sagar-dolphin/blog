@extends('admin.layouts.app')

@section('title', 'Dashboard')
@push('yajra_datatable_css_cdn')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

  <!-- Content Wrapper. Contains page content -->

  @section('heading','Dashboard')
      
    <!-- Main content -->
    
    <!-- /.content -->
@endsection



