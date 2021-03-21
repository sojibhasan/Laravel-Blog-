@extends('layouts.back') 
@section('title') 
Banner Slider 
@endsection 
@section('page_title') 
Banner Slider 
@endsection 
@section('css_plugins')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection 
@section('top_btn')
<a href="{{ route('slider.create') }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add New Slide</a>
@endsection 
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Slider</li>
</ul>
@endsection 
@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Text</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Text</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($items->reverse() as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <div style="min-width: 200px;">
                                            <span> {!! $item->text !!} </span>
                                        </div>
                                    </td>

                                    <td>
                                        <img src="{{ asset('front/images/slider/' . $item->image) }}" alt="Blog image" style="max-width: 200px;" />
                                    </td>

                                    <td>
                                        <div style="width: 100px; text-align: center;">
                                            <span class="badge {{ $item->status == 1 ? 'badge-success' : 'badge-info' }}">{{ $item->status == 1 ? 'published' : 'unpublished' }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div style="width: 120px; text-align: center;">
                                            <span> {{ $item->created_at->format('d/m/Y') }} </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 120px; text-align: center;">
                                            <span> {{ $item->updated_at->format('d/m/Y') }} </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="action-btn d-flex">
                                            <a title="Edit" href="{{ route('slider.edit', $item->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                            <a title="Delete" href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-red text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                            <form class="d-none" action="{{ route('slider.destroy', $item->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class="waves-effect waves-float btn-sm waves-red text-black border-0"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></button>
                                            </form>
                                        </div>
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
@endsection 
@section('js_plugins')
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
                    swal("Your Slider item is safe!");
                }
            });
        });
    }
</script>
@endsection
