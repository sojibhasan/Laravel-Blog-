@extends('layouts.back') 
@section('title') 
Category Edit 
@endsection 
@section('page_title') 
Category
@endsection 
@section('css_plugins')
<link rel="stylesheet" href="{{ asset('back/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('top_btn')
<a href="{{ route('category.index') }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add New Category</a>
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">Category</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <form id="form" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card">
                        <div class="body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="name">Update name (max 55 characters)</label>
                                        <input id="name" class="form-control no-resize" placeholder="Please type what you want..." name="name" value="{{ $category->name }}" />
                                        <small><span id="title-count">0</span> of 55</small>
                                        @if($errors->has('name'))
                                        <span style="color: red;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-3 text-right">
                                    <button class="btn btn-info" type="submit">Update Category</button>
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
                                        <th>Category</th>
                                        <th>slug</th>
                                        <th style="text-align: left;">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>slug</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{!! $loop->iteration !!}</td>
                                        <td>{!! $category->name !!}</td>
                                        <td>{!! $category->slug !!}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('category.edit', $category->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2 edit-btn"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                            <form class="d-inline" method="POST" action="{{ route('category.destroy', $category->id) }}">
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

<script src="{{ asset('back/plugins/select2/select2.min.js') }}"></script>
<!-- Select2 Js -->
<script src="{{ asset('back/js/pages/tables/jquery-datatable.js') }}"></script>

<script>
    $("#name").on("keyup blur", function () {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, "-");
        $("#slug").val(Text);

        let titleLength = $(this).val().length;
        $("#title-count").text(titleLength);
    });
    $("#slug").on("blur", function () {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, "-");
        $("#slug").val(Text);
    });

    // Select2 selectbox
    $(function () {
        $(".select2").select2();
        $(".search-select").select2({
            allowClear: true,
        });
        $("#max-select").select2({
            placeholder: "Select",
            maximumSelectionSize: 2,
        });
        $("#loading-select").select2({
            placeholder: "Select",
            minimumInputLength: 1,
            query: function (query) {
                var data = { results: [] },
                    i,
                    j,
                    s;
                for (i = 1; i < 5; i++) {
                    s = "";
                    for (j = 0; j < i; j++) {
                        s = s + query.term;
                    }
                    data.results.push({ id: query.term + i, text: s });
                }
                query.callback(data);
            },
        });
        var data = [
            { id: 0, tag: "enhancement" },
            { id: 1, tag: "bug" },
            { id: 2, tag: "duplicate" },
            { id: 3, tag: "invalid" },
            { id: 4, tag: "wontfix" },
        ];
        function format(item) {
            return item.tag;
        }
        $("#array-select").select2({
            placeholder: "Select",
            data: { results: data, text: "tag" },
            formatSelection: format,
            formatResult: format,
        });
    });
</script>
@endsection
