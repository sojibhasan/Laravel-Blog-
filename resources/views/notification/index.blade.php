@extends('layouts.back') @section('title') All Notifications @endsection @section('page_title') All Notifications @endsection @section('css_plugins')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('top_btn')
<a href="{{ route('slider.create') }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add New Slide</a>
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Notifications</li>
</ul>
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
                                    <th>#</th>
                                    <th></th>
                                    <th>Notification</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Notification</th>
                                    <th>Created at</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($notifications as $notification) @if(isset(json_decode($notification->data)->massage))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td align="center">
                                        @if($notification->type == 'App\Notifications\ProfileNoti')
                                        <div style="border-radius: 4px; color: #fff; width: 36px; height: 36px; text-align: center; line-height: 36px;" class="icon-circle bg-purple"><i class="zmdi zmdi-refresh"></i></div>
                                        @elseif($notification->type == 'App\Notifications\RegisterNoti')
                                        <div style="border-radius: 4px; color: #fff; width: 36px; height: 36px; text-align: center; line-height: 36px;" class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                        @elseif($notification->type == 'App\Notifications\PostNoti')
                                        <div style="border-radius: 4px; color: #fff; width: 36px; height: 36px; text-align: center; line-height: 36px;" class="icon-circle bg-green"><i class="zmdi zmdi-edit"></i></div>
                                        @elseif($notification->type == 'App\Notifications\DeleteNoti')
                                        <div style="border-radius: 4px; color: #fff; width: 36px; height: 36px; text-align: center; line-height: 36px;" class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>
                                        @elseif($notification->type == 'App\Notifications\SettingNoti')
                                        <div style="border-radius: 4px; color: #fff; width: 36px; height: 36px; text-align: center; line-height: 36px;" class="icon-circle bg-light-blue"><i class="zmdi zmdi-settings"></i></div>
                                        @elseif($notification->type == 'App\Notifications\CommentNoti')
                                        <div style="border-radius: 4px; color: #fff; width: 36px; height: 36px; text-align: center; line-height: 36px;" class="icon-circle bg-grey"><i class="zmdi zmdi-comment-text"></i></div>
                                        @endif
                                    </td>

                                    <td>
                                        {{ ucwords(json_decode($notification->data)->massage) }}
                                    </td>

                                    <td>
                                        {{ $notification->created_at }}
                                    </td>
                                </tr>
                                @endif @endforeach
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
@endsection
