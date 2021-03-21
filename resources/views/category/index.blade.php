@extends('layouts.back') @section('title') Category List @endsection @section('page_title') Category @endsection @section('css_plugins')
<link rel="stylesheet" href="{{ asset('back/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Category</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-sm-4">
            <div class="card">
                <div class="body">
                    <form id="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label for="name">Category name (max 55 characters)</label>
                                    <input id="name" class="form-control no-resize" placeholder="Please type what you want..." name="name" value="{{ old('name') }}" />
                                    <small><span id="title-count">0</span> of 55</small>
                                    @if($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 mt-3 text-right">
                                <button class="btn btn-primary" type="submit">Save Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                                    <th>Slug</th>
                                    <th>Post</th>
                                    <th style="width: 90px;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Post</th>
                                    <th style="width: 90px;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($categories->reverse() as $category)
                                <tr>
                                    <td>{!! $loop->iteration !!}</td>
                                    <td>{!! ucwords($category->name) !!}</td>
                                    <td>{!! $category->slug !!}</td>
                                    <td>{!! count($category->posts) !!}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('category.edit', $category->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2 edit-btn"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                        <a href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-red text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                        <form class="delete-form d-none" method="POST" action="{{ route('category.destroy', $category->id) }}">
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
                var data = {
                        results: [],
                    },
                    i,
                    j,
                    s;
                for (i = 1; i < 5; i++) {
                    s = "";
                    for (j = 0; j < i; j++) {
                        s = s + query.term;
                    }
                    data.results.push({
                        id: query.term + i,
                        text: s,
                    });
                }
                query.callback(data);
            },
        });
        var data = [
            {
                id: 0,
                tag: "enhancement",
            },
            {
                id: 1,
                tag: "bug",
            },
            {
                id: 2,
                tag: "duplicate",
            },
            {
                id: 3,
                tag: "invalid",
            },
            {
                id: 4,
                tag: "wontfix",
            },
        ];

        function format(item) {
            return item.tag;
        }
        $("#array-select").select2({
            placeholder: "Select",
            data: {
                results: data,
                text: "tag",
            },
            formatSelection: format,
            formatResult: format,
        });
    });

    let deleteBtn = document.getElementsByClassName("delete-btn-form");
    for (let btn of deleteBtn) {
        btn.addEventListener("click", function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    swal("Deleting process in progress.", {
                        icon: "success",
                    });
                    this.parentElement.querySelector("form").submit();
                } else {
                    swal("Your Category is safe!");
                }
            });
        });
    }
</script>
@endsection
