@extends('layouts.back') @section('title') Tag edit @endsection @section('page_title') Tag edit @endsection @section('css_plugins')
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" />
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('top_btn')
<a href="{{ route('tag.index') }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add another tags</a>
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ url('admin/tag') }}">Tag</a></li>
    <li class="breadcrumb-item active">Edit Tag</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-4">
            <form id="form" action="{{ route('tag.update', $tag->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="card">
                    <div class="body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="name">Update tag</label>
                                    <div>
                                        <input id="name" rows="4" class="form-control no-resize" placeholder="Please type what you want..." name="name" value="{{ $tag->name }}" />
                                    </div>
                                    @if($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <button class="btn btn-info" type="submit">Update Tags</button>
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
                                    <th>Tag</th>
                                    <th>slug</th>
                                    <th style="text-align: left;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Tag</th>
                                    <th>slug</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('tag.edit', $tag->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                        <form class="d-inline" method="POST" action="{{ route('tag.destroy', $tag->id) }}">
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
<script src="{{ asset('back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- Bootstrap Tags Input Plugin Js -->

@endsection
