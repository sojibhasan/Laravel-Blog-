@extends('layouts.back')

@section('title')
Menu
@endsection

@section('page_title')
Menu
@endsection

@section('custom_css')
<link href="{{ asset('back/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Menu</li>
</ul>
@endsection


@section('content')
{!! Menu::render() !!}
@endsection

@push('scripts')
    {!! Menu::scripts() !!}
@endpush