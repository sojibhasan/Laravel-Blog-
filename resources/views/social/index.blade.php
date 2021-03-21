@extends('layouts.back') @section('title') Social @endsection @section('page_title') Social @endsection @section('css_plugins')
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Social</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Basic Validation -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <form id="form" action="{{ route('social.store') }}" method="POST" id="" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="name">Social Name</label>
                                        <input id="name" rows="4" class="form-control no-resize" placeholder="Facebook ..." name="name" value="{{ old('name') }}" />
                                        @if($errors->has('name'))
                                        <span style="color: red;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <label for="link">Social Link</label>
                                        <input id="link" rows="4" placeholder="http:// ..." class="form-control no-resize" name="link" value="{{ old('link') }}" />
                                        @if($errors->has('link'))
                                        <span style="color: red;">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <label for="class">Icon Class</label>
                                        <input id="class" rows="4" class="form-control no-resize" name="class" value="{{ old('class') }}" placeholder="fab fa-facebook" />
                                        @if($errors->has('class'))
                                        <span style="color: red;">{{ $errors->first('class') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary" type="submit">Add New Social Media</button>
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
                                            <a title="Edit" href="{{ route('social.edit', $social->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                            <a title="Delete" href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-red text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                            <form class="d-none" method="POST" action="{{ route('social.destroy', $social->id) }}">
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

<script src="{{ asset('back/js/pages/tables/jquery-datatable.js') }}"></script>
@endsection
