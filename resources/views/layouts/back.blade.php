<?php
use App\User;
use Illuminate\Support\Facades\DB;
$user_info = User::with('profile')
    ->where('id', auth()->user()->id)
    ->get();
if ($user_info->first()->role == 1) {
    $user_role = 'Super Admin';
} elseif ($user_info->first()->role == 2) {
    $user_role = 'Administrator';
} else {
    $user_role = 'Blogger';
}
$notifications = DB::table('notifications')
    ->where('type', '!=', 'App\Notifications\BulkMail')
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get(); 

?>


<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Blog website for Affiliate Marketing" />

        <title>:: Divine-Blog : @yield('title') ::</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
        <link rel="stylesheet" href="{{asset('back/plugins/bootstrap/css/bootstrap.min.css')}}" />
        <!-- Favicon-->
        @yield('css_plugins')
        <link rel="stylesheet" href="{{asset('back/plugins/toastr/toastr.min.css')}}" />
        <!-- Custom Css -->
        <link rel="stylesheet" href="{{asset('back/css/style.min.css')}}" />
        @yield('custom_css')

        <style>
            .theme-dark th,
            .theme-dark td {
                color: #777;
            }

            .theme-dark .report-item {
                background-color: #313131;
                box-shadow: 0 0 15px #666;
            }

            .theme-dark #hwpwrap .js .control-section.open .accordion-section-title {
                color: #c7c2c2;
            }

            .theme-dark #hwpwrap p,
            .theme-dark #hwpwrap label,
            .theme-dark #hwpwrap span {
                color: #c7c2c2;
            }

            .theme-dark #hwpwrap .manage-menus {
                background: #313131;
                border-color: transparent;
                color: #c7c2c2;
            }

            .theme-dark #hwpwrap #menu-management {
                background: #313131;
            }

            .theme-dark #hwpwrap .js .control-section:hover .accordion-section-title {
                color: #222;
                background: #313131;
            }

            .theme-dark #hwpwrap .accordion-section-content {
                background: #313131;
            }

            .theme-dark #hwpwrap input[type="text"] {
                background-color: transparent;
            }

            .theme-dark #hwpwrap .js .control-section.open .accordion-section-title {
                background-color: transparent;
            }

            .theme-dark #hwpwrap .nav-menus-php #post-body {
                background: transparent;
            }

            .select2-container .select2-choice {
                background-color: transparent;
            }

            .theme-dark .select2-drop {
                background-color: #313131;
                color: #c7c2c2;
            }

            .theme-dark .bootstrap-tagsinput {
                background-color: transparent;
            }

            .theme-dark .bootstrap-tagsinput input {
                background-color: transparent;
                color: #fff;
            }
        </style>
    </head>

    <body class="theme-blush">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('back/images/loader.svg') }}" width="48" height="48" alt="Devine Blog" /></div>
                <p>Please wait...</p>
            </div>
        </div>

        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>

        <!-- Right Icon menu Sidebar -->
        <div class="navbar-right">
            <ul class="navbar-nav">
                <li>
                    <a href="javascript:void(0);" class="js-right-sidebar" title="Design"><i class="zmdi zmdi-apps"></i></a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" title="Notifications" data-toggle="dropdown" role="button">
                        <i class="zmdi zmdi-notifications"></i>
                        <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                    </a>
                    <ul class="dropdown-menu slideUp2">
                        <li class="header">Notifications</li>
                        <li class="body">
                            <ul class="menu list-unstyled">
                                @foreach($notifications as $notification)
                                <li>
                                    <a href="javascript:void(0);">
                                        @if($notification->type == 'App\Notifications\ProfileNoti')
                                        <div class="icon-circle bg-purple"><i class="zmdi zmdi-refresh"></i></div>
                                        @elseif($notification->type == 'App\Notifications\RegisterNoti')
                                        <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                        @elseif($notification->type == 'App\Notifications\PostNoti')
                                        <div class="icon-circle bg-green"><i class="zmdi zmdi-edit"></i></div>
                                        @elseif($notification->type == 'App\Notifications\DeleteNoti')
                                        <div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>
                                        @elseif($notification->type == 'App\Notifications\SettingNoti')
                                        <div class="icon-circle bg-light-blue"><i class="zmdi zmdi-settings"></i></div>
                                        @elseif($notification->type == 'App\Notifications\CommentNoti')
                                        <div class="icon-circle bg-grey"><i class="zmdi zmdi-comment-text"></i></div>
                                        @endif
                                        <div class="menu-info">
                                            <h4>{{ ucwords(json_decode($notification->data)->massage) }}</h4>
                                            <p><i class="zmdi zmdi-time"></i> {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{ route('notification') }}">View All Notifications</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('setting.index') }}" class="" title="Setting"><i class="zmdi zmdi-settings"></i></a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="zmdi zmdi-power"></i> </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <div class="navbar-brand">
                <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
                <a target="_blank" href="{{ url('/') }}"><i class="zmdi zmdi-laptop-mac ml-3"></i><span class="m-l-10">Visit Site</span></a>
            </div>
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <a class="image" href="{{ route('profile.edit', auth()->user()->id) }}">
                                <img src="{{ $user_info->first()->profile->image == '' ? asset('back/images/profile_av.jpg') : $user_info->first()->profile->image}}" alt="User" />
                            </a>
                            <div class="detail text-left">
                                <h4>
                                    @if($user_info->first()->profile->name == '') Your Name @elseif((strlen($user_info->first()->profile->name) > 10)) {{ substr($user_info->first()->profile->name, 0, 10) }}... @else {{
                                    $user_info->first()->profile->name }} @endif
                                </h4>
                                <small>{{ $user_role }}</small>
                            </div>
                        </div>
                    </li>
                    <li class="{{ (Request::is('admin') ? 'active' : ' ') }}">
                        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="{{ (Route::is('contact*') ? 'active' : ' ') }}">
                        <a href="{{ route('contact.index') }}"><i class="zmdi zmdi-account-box-mail"></i><span>Contact</span></a>
                    </li>
                    <li>
                    <hr style="margin-top: 5px; margin-bottom: 5px;">
                    </li>
                    <li class="{{ (Request::is('admin/profile*', 'admin/change-password') ? 'active open' : '') }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account"></i><span>Our Profile</span></a>
                        <ul class="ml-menu">
                            <li class="{{ Route::is('profile.index') ? 'active' : '' }}"><a href="{{ route('profile.index') }}">My Profile</a></li>
                            <li class="{{ (Request::is('admin/change-password') ? 'active' : '') ? 'active' : '' }}"><a href="{{ route('change.password') }}">Change Password</a></li>
                        </ul>
                    </li>
                    @if($user_info->first()->role == 1 || $user_info->first()->role == 2)
                    <li class="{{ (Request::is('admin/slider*') ? 'active open' : '') }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-slideshare"></i><span>Slider</span></a>
                        <ul class="ml-menu">
                            <li class="{{ Route::is('slider.index') ? 'active' : '' }}"><a href="{{ route('slider.index') }}">Banner Slider</a></li>
                            <li class="{{ (Route::is('slider.create') ? 'active' : '') }}"><a href="{{ route('slider.create') }}">Add New Slider</a></li>
                        </ul>
                    </li>

                    <li class="{{ (Request::is('admin/setting*', 'admin/social*', 'admin/pages*') || Route::is('menu') ? 'active open' : '') }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings"></i><span>Setting</span></a>
                        <ul class="ml-menu">
                            <li class="{{ Route::is('setting.index') ? 'active' : '' }}"><a href="{{ route('setting.index') }}">Theme</a></li>
                            <li class="{{ Route::is('pages*') ? 'active' : '' }}"><a href="{{ route('pages.index') }}">Pages</a></li>
                            <li class="{{ Route::is('menu') ? 'active' : '' }}"><a href="{{ route('menu') }}">Menus</a></li>
                            <li class="{{ Route::is('social.index') ? 'active' : '' }}"><a href="{{ route('social.index') }}">Social Media</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="{{ (Request::is('admin/post*', 'admin/category*', 'admin/tag*') ? 'active open' : '') }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>Post</span></a>
                        <ul class="ml-menu">
                            <li class="{{ Route::is('post.index') ? 'active' : '' }}"><a href="{{ route('post.index') }}">Post List</a></li>
                            <li class="{{ Route::is('post.create') ? 'active' : '' }}"><a href="{{ route('post.create') }}">Create Post</a></li>
                            <li class="{{ Route::is('category.index', 'category.edit') ? 'active' : '' }}"><a href="{{ route('category.index') }}">Category</a></li>
                            <li class="{{ Route::is('tag.index', 'tag.edit') ? 'active' : '' }}"><a href="{{ route('tag.index') }}">Tag</a></li>
                        </ul>
                    </li>
                    @if($user_info->first()->role == 1)
                    <li class="{{ (route::is('gallery*') ? 'active open' : '') }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-folder"></i><span>Media</span></a>
                        <ul class="ml-menu">
                            <li class="{{ Route::is('gallery*') ? 'active' : '' }}"><a href="{{ route('gallery.blogs') }}">Images</a></li>
                        </ul>
                    </li>

                    <li class="{{ (Request::is('admin/user*') ? 'active open' : '') }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts"></i><span>Users</span></a>
                        <ul class="ml-menu">
                            <li class="{{ Route::is('user.index') ? 'active' : '' }}"><a href="{{ route('user.index') }}">All User</a></li>
                            <li class="{{ Route::is('user.create') ? 'active' : '' }}"><a href="{{ route('user.create') }}">Add New User</a></li>
                        </ul>
                    </li>
                    @endif @if($user_info->first()->role == 1 || $user_info->first()->role == 2)
                    <li class="{{ (Route::is('marketing.single', 'marketing.bulk', 'marketing.subscribers', 'subscribers.reply') ? 'active open' : '') }}">
                        <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-headset-mic"></i><span>Marketing</span></a>
                        <ul class="ml-menu">
                            <li class="{{ Route::is('marketing.single') ? 'active' : '' }}"><a href="{{ route('marketing.single') }}">Quick Mail</a></li>
                            <li class="{{ Route::is('marketing.bulk') ? 'active' : '' }}"><a href="{{ route('marketing.bulk') }}">Bulk Mail</a></li>
                            <li class="{{ Route::is('marketing.subscribers', 'subscribers.reply') ? 'active' : '' }}"><a href="{{ route('marketing.subscribers') }}">Subscribers</a></li>
                        </ul>
                    </li>
                    @endif
                    <li>
                        <hr style="margin-top: 5px; margin-bottom: 5px;">
                    </li>
                    <li class="{{ Route::is('doc') ? 'active' : '' }}">
                        <a href="{{ route('doc') }}"><i class="zmdi zmdi-help-outline"></i><span>Documentation</span></a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <div class="nav nav-tabs sm">
                <span class="text-white"> Theme Design</span>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="setting">
                    <div class="slim_scroll">
                        <div class="card">
                            <h6>Theme Option</h6>
                            <div class="light_dark">
                                <div class="radio">
                                    <input type="radio" name="radio1" id="lighttheme" value="light" checked="" />
                                    <label for="lighttheme">Light Mode</label>
                                </div>
                                <div class="radio mb-0">
                                    <input type="radio" name="radio1" id="darktheme" value="dark" />
                                    <label for="darktheme">Dark Mode</label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h6>Color Skins</h6>
                            <ul class="choose-skin list-unstyled">
                                <li data-theme="purple"><div class="purple"></div></li>
                                <li data-theme="blue"><div class="blue"></div></li>
                                <li data-theme="cyan"><div class="cyan"></div></li>
                                <li data-theme="green"><div class="green"></div></li>
                                <li data-theme="orange"><div class="orange"></div></li>
                                <li data-theme="blush" class="active"><div class="blush"></div></li>
                            </ul>
                        </div>
                        <div class="card">
                            <h6>General Settings</h6>
                            <ul class="setting-list list-unstyled">
                                <li>
                                    <div class="checkbox rtl_support">
                                        <input id="checkbox1" type="checkbox" value="rtl_view" />
                                        <label for="checkbox1">RTL Version</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox ms_bar">
                                        <input id="checkbox2" type="checkbox" value="mini_active" />
                                        <label for="checkbox2">Mini Sidebar</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>@yield('page_title')</h2>
                            @yield('breadcrumb')
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                            @yield('top_btn')
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
            <footer>
                <div class="container-fluid bg-white text-dark" style="padding: 15px; border-radius: 0.35rem;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="copyright text-center text-md-left">
                                &copy; <span>Copyright</span>
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <span>All Rights Reserved </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="copyright text-center text-md-right">
                                <span>Developed by <a href="#" >Sojib Hasan</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            </div>
        </section>                               
        <!-- Jquery Core Js -->
        <script src="{{ asset('back/js/sweetalert.min.js') }}"></script>
        <script src="{{asset('back/bundles/libscripts.bundle.js')}}"></script>
        <!-- Lib Scripts Plugin Js -->
        <script src="{{asset('back/bundles/vendorscripts.bundle.js')}}"></script>
        <!-- Lib Scripts Plugin Js -->
        <script src="{{asset('back/plugins/toastr/toastr.min.js')}}"></script>

        @yield('js_plugins')

        <script src="{{asset('back/bundles/mainscripts.bundle.js')}}"></script>
        <!-- Custom Js -->
        @stack('scripts') 
        @yield('custom_js') {!! Toastr::message() !!}
        
    </body>
</html>
