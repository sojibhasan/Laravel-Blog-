@extends('layouts.back') @section('title') Tag list @endsection @section('page_title') Tag list @endsection @section('css_plugins')
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" />
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Tags</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-4">
            <form id="form" action="{{ route('tag.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="name">Input all tags separated by (,)</label>
                                    <div class="border">
                                        <input data-role="tagsinput" id="name" rows="4" class="form-control no-resize" placeholder="Please type what you want..." name="name" value="{{ old('name') }}" />
                                    </div>
                                    @if($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <button class="btn btn-primary" type="submit">Save Tags</button>
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
                                    <th>Slug</th>
                                    <th>Post</th>
                                    <th style="width: 90px;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Tag</th>
                                    <th>Slug</th>
                                    <th>Post</th>
                                    <th style="width: 90px;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($tags->reverse() as $tag)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($tag->name) }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>{{ count($tag->posts) }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('tag.edit', $tag->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                        <a href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-red text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                        <form class="d-none" method="POST" action="{{ route('tag.destroy', $tag->id) }}">
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
<script>
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
                    swal("Your Social item is safe!");
                }
            });
        });
    }
</script>
@endsection
