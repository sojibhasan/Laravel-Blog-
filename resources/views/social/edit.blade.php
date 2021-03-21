@extends('layouts.back') @section('title') Social edit @endsection @section('page_title') Social edit @endsection @section('css_plugins')
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('top_btn')
<a href="{{ route('social.index') }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add New Social</a>
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ url('admin/social') }}">Social</a></li>
    <li class="breadcrumb-item active">Social edit</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <form id="form" action="{{ route('social.update', $social->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="card">
                        <div class="body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="name">Social Name</label>
                                        <input id="name" rows="4" class="form-control no-resize" placeholder="Facebook ..." name="name" value="{{ $social->name }}" />
                                        @if($errors->has('name'))
                                        <span style="color: red;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <label for="link">Social Link</label>
                                        <input id="link" rows="4" placeholder="http:// ..." class="form-control no-resize" name="link" value="{{ $social->link }}" />
                                        @if($errors->has('link'))
                                        <span style="color: red;">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <label for="class">Icon Class</label>
                                        <input id="class" rows="4" class="form-control no-resize" name="class" value="{{ $social->class }}" placeholder="fab fa-facebook" />
                                        @if($errors->has('class'))
                                        <span style="color: red;">{{ $errors->first('class') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-info" type="submit">Edit Social Media</button>
                                    <a class="btn btn-success" href="{{ url()->previous() }}">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Link</th>
                                        <th style="text-align: left;">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Link</th>
                                        <th style="text-align: left;">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($socials as $social)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $social->name }}</td>
                                        <td>{{ $social->class }}</td>
                                        <td><a target="_blank" href="{{ $social->link }}">{{ $social->link }}</a></td>
                                        <td class="d-flex">
                                            <a href="{{ route('social.edit', $social->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                            <form class="d-inline" method="POST" action="{{ route('social.destroy', $social->id) }}">
                                                @csrf @method('DELETE')
                                                <button class="waves-effect waves-float btn-sm waves-red text-black border-0"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="edit-btn"></div>
<div class="edit-btn"></div>
<div class="edit-btn"></div>
<div class="edit-btn"></div>
<div class="edit-btn"></div>
@endsection @section('js_plugins')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('back/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
@endsection @section('custom_js')

<script src="{{ asset('back/js/pages/tables/jquery-datatable.js') }}"></script>

@endsection
