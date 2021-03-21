@extends('layouts.back') @section('title') All user @endsection @section('page_title') All user @endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All Users</li>
</ul>
@endsection @section('top_btn')
<a href="{{ route('user.create') }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add User</a>
@endsection @section('content')
<div class="container-fluid">
    <div class="row clearfix">
        @foreach($users as $user)
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card mcard_3">
                <div class="body position-relative">
                    <ul class="header-dropdown" style="list-style: none; position: absolute; right: 15px; top: 15px;">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-edit"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{ route('user.show', $user->id) }}">Show</a></li>
                                <li><a href="{{ route('user.edit', $user->id) }}">Edit</a></li>
                                @if($user->role != 1)
                                <li><a class="delete-btn-form" href="javascript:void(0);">Delete</a></li>
                                @endif
                                <form class="delete-form" action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </ul>
                        </li>
                    </ul>
                    <img style="max-width: 180px;" src="{{ $user->profile->image == '' ? asset('back/images/profile_av.jpg') :  $user->profile->image}}" class="rounded-circle" alt="profile-image" />
                    <h4 class="m-t-10">{{ $user->profile->name == '' ? 'N/A' : ucfirst($user->profile->name) }}</h4>
                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <ul class="social-links list-unstyled">
                                <li>
                                    <a href="{{ $user->profile->facebook == '' ? '#' :  $user->profile->facebook}}" title="facebook"><i class="zmdi zmdi-facebook-box"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $user->profile->twitter == '' ? '#' :  $user->profile->twitter}}" title="twitter"><i class="zmdi zmdi-twitter-box"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $user->profile->linkedin == '' ? '#' :  $user->profile->linkedin}}" title="instagram"><i class="zmdi zmdi-linkedin-box"></i></a>
                                </li>
                            </ul>
                        </div>
                        <?php 
                            if($user->role == 1) { $role = 'Super Admin'; } elseif($user->role == 2) { $role = 'Administrator'; } else { $role = 'Blogger'; } ?>
                        <div class="col-5 text-left">
                            <small>User Role</small>
                            <p>{{ $role }}</p>
                        </div>
                        <div class="col-7 text-right">
                            <small>Phone</small>
                            <p><a class="text-black" href="tel:{{ $user->phone }}">{{ $user->phone }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-12">
            <div class="card">
                {{ $users->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Attention Please</h4>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus
                ullamcorper.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
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
                    this.parentElement.parentElement.querySelector("form").submit();
                } else {
                    swal("This User is safe!");
                }
            });
        });
    }
</script>
@endsection
