@extends('admin.layouts.app')

@section('title', 'Blogs')
@push('admin_dashboard_style')
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

    @section('heading', 'Blogs')
    
@endsection