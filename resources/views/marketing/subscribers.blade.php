@extends('layouts.back') 
@section('title') 
Marketing - Single 
@endsection 
@section('page_title') 
Marketing - Subscribers 
@endsection 
@section('css_plugins')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection 
@section('custom_css')

@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Subscribers</li>
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
                                    <th>Email</th>
                                    <th>Crated at</th>
                                    <th>Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                    <th>Email</th>
                                    <th>Crated at</th>
                                    <th>Count</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($subscribers as $subscriber)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <div style="min-width: 200px;">
                                            <span> {{ $subscriber->email }} </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div style="min-width: 200px;">
                                            <span> {{ date_format($subscriber->created_at, 'd/m/Y - g:i A')  }} </span>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $subscriber->count }}
                                    </td>
                                    <td>
                                        <div class="action-btn d-flex">
                                            <a href="{{ route('subscribers.reply', $subscriber->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-mail-reply" style="line-height: 1.8;"></i></a>
                                            <a href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-red text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                            <form class="d-none" action="{{ route('subscribers.destroy') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $subscriber->id }}">
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