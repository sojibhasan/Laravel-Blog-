@extends('layouts.back') 
@section('title')
Contact 
@endsection 
@section('page_title') 
All Contact Info 
@endsection 
@section('css_plugins')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Contact Info</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2 class="text-capitalize">From Visitor Comment</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ $comment->email }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td class="text-center">
                                        @if($comment->status == 0)
                                        <a title="Click to change" href="{{ route('comment.approved', $comment->id) }}"><span class="badge badge-info">Unapproved</span></a>
                                        @else
                                        <a title="Click to change" href="{{ route('comment.unapproved', $comment->id) }}"><span class="badge badge-primary">Approved</span></a>
                                        @endif
                                    </td>
                                    <td>{{ date_format($comment->created_at, 'd/m/Y - g:i A') }}</td>

                                    <td>
                                        <div class="action-btn d-flex" style="width: 150px;">
                                            <a title="Edit" href="{{ route('comment.show', $comment->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                            <a title="Reply" href="{{ route('comment.reply', $comment->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-mail-reply" style="line-height: 1.8;"></i></a>
                                            <a title="Delete" href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-green text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                            <form class="d-none" action="{{ route('comment.destroy') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $comment->id }}" />
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

        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2 class="text-capitalize">From Contact Form</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td class="text-center">
                                        @if($contact->status == 0)
                                        <span class="badge badge-info">Unread</span>
                                        @else
                                        <span class="badge badge-primary">Read</span>
                                        @endif
                                    </td>
                                    <td>{{ date_format($contact->created_at, 'd/m/Y - g:i A') }}</td>

                                    <td>
                                        <div class="action-btn d-flex" style="width: 150px;">
                                            <a title="Read" href="{{ route('contact.show', $contact->id) }}" class="waves-effect waves-float btn-sm waves-light-blue text-black mr-2"><i class="zmdi zmdi-eye" style="line-height: 1.8;"></i></a>
                                            <a title="Reply" href="{{ route('contact.reply', $contact->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-mail-reply" style="line-height: 1.8;"></i></a>
                                            <a title="Delete" href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-green text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                            <form class="d-none" action="{{ route('contact.delete', $contact->id) }}" method="POST">
                                                @csrf
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
