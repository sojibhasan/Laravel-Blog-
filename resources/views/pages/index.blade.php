@extends('layouts.back') 
@section('title') 
All Pages
@endsection 
@section('page_title') 
All Pages
@endsection 
@section('css_plugins')

@section('css_plugins')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection 

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Pages</li>
</ul>
@endsection

@endsection @section('content')
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
                                    <th style="width: 20px;">#</th>
                                    <th style="white-space: nowrap;">Page name</th>
                                    <th style="white-space: nowrap;">Label</th>
                                    <th style="white-space: nowrap;">Page title</th>
                                    <th style="white-space: nowrap;">Updated at</th>
                                    <th style="white-space: nowrap;">Updated by</th>
                                    <th style="white-space: nowrap; width: 9px">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width: 20px;">#</th>
                                    <th style="white-space: nowrap;">Page name</th>
                                    <th style="white-space: nowrap;">Label</th>
                                    <th style="white-space: nowrap;">Page title</th>
                                    <th style="white-space: nowrap;">Updated at</th>
                                    <th style="white-space: nowrap;">Updated by</th>
                                    <th style="white-space: nowrap; width: 9px">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>
                                            <p>{{ ucfirst($page->name) }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p>{{ $page->label }}</p>
                                        </div>
                                    </td>

                                    <td>
                                        <p>{{ $page->title }}</p>
                                    </td>

                                    <td>
                                        <p>{{ date_format($page->created_at, 'd/m/Y') }}</p>
                                    </td>

                                    <td>
                                        <p>{{ $page->updated_by }}</p>
                                    </td>
                                    
                                    <td>
                                        <div class="action-btn d-flex">
                                            <a title="View" href="{{ route('pages.show', $page->label) }}" class="waves-effect waves-float btn-sm waves-light-blue text-black mr-2"><i class="zmdi zmdi-eye" style="line-height: 1.8;"></i></a>
                                            <a title="Edit" title="Edit" href="{{ route('pages.edit', $page->label) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
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
@endsection 
@section('custom_js')
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
                    swal("Your Contact info is safe!");
                }
            });
        });
    }
</script>
@endsection