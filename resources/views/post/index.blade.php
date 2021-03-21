@extends('layouts.back') @section('title') Blog List @endsection @section('page_title') All Posts @endsection 
@section('css_plugins')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
@endsection 
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Posts</li>
</ul>
@endsection @section('top_btn')
<a href="{{ route('post.create') }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add New Post</a>
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
                                    <th style="white-space: nowrap;">#</th>
                                    <th style="white-space: nowrap;">Title</th>
                                    <th style="white-space: nowrap;">Image</th>
                                    <th style="white-space: nowrap;">Category</th>
                                    <th style="white-space: nowrap;">Comment</th>
                                    <th style="white-space: nowrap;">Status</th>
                                    <th style="white-space: nowrap;">Created at</th>
                                    <th style="white-space: nowrap;">Updated at</th>
                                    <th style="white-space: nowrap;">Posted by</th>
                                    <th style="white-space: nowrap;">Visitor</th>
                                    <th style="white-space: nowrap;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Posted by</th>
                                    <th>Visitor</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($posts->reverse() as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div style="width: 250px;">
                                            <p>{{ $post->title }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="{{ asset('front/images/post/' . $post->image) }}" alt="Blog image" style="width: 200px; max-width: 200px; height: 100px; object-fit: cover;" />
                                    </td>
                                    <td>
                                        <div>
                                            <p>{{ ucwords($post->category->name) }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <span>({{ count($post->comment) }})</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <span class="badge {{ $post->status == 1 ? 'badge-success' : 'badge-info'}}">{{ $post->status == 1 ? 'Published' : 'Unpublished'}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <span>{{ $post->created_at->format('d M yy') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <span>{{ $post->updated_at->format('d M yy') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span>{{ ucwords($post->user->profile->name) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <span>{{ $post->visitor }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-btn d-flex">
                                            <a title="View" href="{{ route('post.show', $post->id) }}" class="waves-effect waves-float btn-sm waves-light-blue text-black mr-2"><i class="zmdi zmdi-eye" style="line-height: 1.8;"></i></a>
                                            <a title="Edit" href="{{ route('post.edit', $post->id) }}" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                            <a title="Delete" href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-red text-black mr-2 delete-btn-form"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></a>
                                            <form class="d-none" action="{{ route('post.destroy', $post->id) }}" method="POST">
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
