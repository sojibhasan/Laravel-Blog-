<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        @if(Route::is('single.post'))
        <title>DivineBlog :: Single Post</title>
        <meta name="description" content="{{ $post->meta_des }}">
        <meta name="keywords" content="{{ $post->meta_key }}">
        <meta name="author" content="Nasrullah Mansur">
        @else
        <title>{{ $page_info->title }}</title>
        <meta name="description" content="{{ $page_info->meta_des }}">
        <meta name="keywords" content="{{ $page_info->meta_key }}">
        <meta name="author" content="Nasrullah Mansur">
        {{ $page_info->another }}
        @endif
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/' . $setting->favicon) }}" />

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{asset('back/plugins/toastr/toastr.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('front/css/fontawesome-all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('front/css/themify-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('front/css/meanmenu.css') }}" />
        <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}" />
        <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
    </head>

    <body>
        <!-- header start -->
        <header class="header">
            <div class="header__top-area black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-block">
                            <div class="header__top-menu">
                                <ul>
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li><a href="{{ route('privacy') }}">Privacy & Policy</a></li>
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="header__social text-center text-md-right mt-10">
                                @foreach($socials as $social)
                                <a href="{{ $social->link }}" title="{{ ucfirst($social->name) }}"><i class="{{ $social->class }}"></i></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__middle pt-20">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-3 d-flex align-items-center justify-content-md-start justify-content-center">
                            <div class="header__logo text-center text-md-left mb-20">
                                <a href="{{ route('home') }}"><img src="{{ asset($setting->header_logo) }}" alt="Brand logo" /></a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-9">
                            <div class="header__menu-area white__header">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12 d-flex" id="main-menu">
                                            <div class="header__menu header__menu-white f-right ml-md-auto">
                                            <div class="mobile-nav" id="mobile-nav">
                                                <i class="fas fa-bars"></i>
                                            </div>
                                                @if($main_menu)
                                                <ul class="menu">
                                                    @foreach($main_menu as $menu) @if($menu['child']) @foreach( $menu['child'] as $child ) @if($child->id == $menu->id)
                                                    <li class="{{  Route::is($menu['label']) ? 'active' : '' }}">
                                                        <a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a>
                                                        <ul class="submenu">
                                                            @foreach( $menu['child'] as $child ) @if($menu->id != $child->id)
                                                            <li class="">
                                                                <a href="{{ $child['link'] }}" title="">{{ $child['label'] }}</a>
                                                                <ul class="submenu">
                                                                    @if($child['child']) @foreach($child['child'] as $child)
                                                                    <li><a href="{{ $child['link'] }}">{{ $child['label'] }}</a></li>
                                                                    @endforeach @endif
                                                                </ul>
                                                            </li>
                                                            @endif @endforeach
                                                        </ul>
                                                    </li>
                                                    @endif @endforeach @endif @if($menu->parent == 0)
                                                    <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                                                    @endif @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                            <div class="header__right-icon header__icon-black f-right mt-17">
                                                <a href="#" data-toggle="modal" data-target="#search-modal">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Search -->
            <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <input type="text" name="search" placeholder="Search here..." />
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->

        <main>
            @yield('slider')

            <!-- news area -->
            <section class="news-area mt-60">
                <!-- trendy news -->
                <div class="container">
                    <div class="row">
                        @yield('content') @if(!Route::is('contact') && !Route::is('about') && !Route::is('privacy') && !Route::is('terms'))
                        <div class="col-xl-4 col-lg-4">
                            <div class="widget widget-border mb-40">
                                <h3 class="widget-title">Categories</h3>
                                <ul>
                                    @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('post.category', $category->slug) }}">{{ ucwords($category->name) }} <span>{{ count($category->posts) }}</span></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget widget-border mb-40">
                                <h3 class="widget-title">Popular posts</h3>
                                @foreach($popular_posts as $post)
                                <div class="post__small mb-30">
                                    <div class="post__small-thumb f-left">
                                        <a href="{{ url('/post', $post->slug) }}">
                                            <img style="width: 100px; height: 85px; object-fit: cover;" src="{{ asset('front/images/post/' . $post->image) }}" alt="{{ $post->alt }}" />
                                        </a>
                                    </div>
                                    <div class="post__small-text fix pl-10">
                                        <span class="sm-cat">
                                            <a href="{{ url('/post/category', $post->category->name) }}">{{ $post->category->name }}</a>
                                        </span>
                                        <h4 class="title-13 pr-0">
                                            <a href="{{ url('/post', $post->slug) }}">{{ Str::limit($post->title, 60) }}</a>
                                        </h4>
                                        <div class="post__small-text-meta">
                                            <ul>
                                                <li>
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>{{ $post->created_at->format('d M yy') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="widget widget-border mb-40">
                                <h3 class="widget-title">Subscribe our Newsletter!</h3>
                                <p>Subscribe to our email newsletter to receive useful articles and special offers.</p>
                                <form class="widget-subscribe" method="POST" action="{{ route('subscribe') }}">
                                    @csrf
                                    <input type="email" placeholder="Enter your email :" name="email" />
                                    <button class="btn">subscribe</button>
                                </form>
                            </div>
                            @if($most_visit)
                            <div class="widget widget-border mb-40">
                                <h3 class="widget-title">Most visited</h3>
                                <div class="postbox">
                                    <div class="postbox__thumb">
                                        <a href="{{ url('/post', $most_visit->slug) }}">
                                            <img src="{{ asset('front/images/post/' . $most_visit->image) }}" alt="{{ $most_visit->alt }}" />
                                        </a>
                                    </div>
                                    <div class="postbox__text pt-15">
                                        <div class="postbox__text-meta pb-10">
                                            <ul>
                                                <li>
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>{{ $most_visit->created_at->format('d M yy') }}</span>
                                                </li>
                                                <li>
                                                    <i class="far fa-comment"></i>
                                                    <span>({{ count($most_visit->comment) }})</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h4 class="title-16 pr-0">
                                            <a href="{{ url('/post', $most_visit->slug) }}">{!! Str::limit($most_visit->title, 90) !!}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @endif @yield('tags')
                        </div>
                        @endif
                    </div>
                </div>
                <!-- trendy news end -->
            </section>
            <!-- news area end -->
        </main>

        <!-- footer -->
        <footer class="footer-bg">
            <div class="subscribe-area pt-50 pb-50">
                <div class="container">
                    <div class="subscribe-separator pt-50 pb-20">
                        <div class="row">
                            <div class="col-xl-2 col-lg-12">
                                <div class="footer-logo mb-30">
                                    <a href="{{ url('/') }}"><img src="{{ asset($setting->footer_logo) }}" alt="Brand logo" /></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-12">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-7">
                                        <div class="subscribe-title">
                                            <h2>subscribe our newsletter</h2>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5">
                                        <div class="subscribe-form mb-30">
                                            <form method="POST" action="{{ route('subscribe') }}">
                                                @csrf
                                                <input type="email" placeholder="Enter your email" name="email" />
                                                <button type="submit">
                                                    subscribe
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area pt-25 pb-25">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="copyright text-lg-left text-center">
                                <p>{!! $setting->copyright !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="copyright-links text-lg-right text-center">
                                <a href="{{ route('about') }}">About</a>
                                <a href="{{ route('privacy') }}">Privacy & Policy</a>
                                <a href="{{ route('terms') }}">Terms and Conditions</a>
                                <a href="{{ route('contact') }}">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end -->

        <!-- JS here -->
        <script src="{{ asset('front/js/vendor/modernizr-3.5.0.min.js') }}"></script>
        <script src="{{ asset('front/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('front/js/popper.min.js') }}"></script>
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('front/js/one-page-nav-min.js') }}"></script>
        <script src="{{ asset('front/js/slick.min.js') }}"></script>
        <script src="{{ asset('front/js/jquery.meanmenu.min.js') }}"></script>
        <script src="{{ asset('front/js/wow.min.js') }}"></script>
        <script src="{{ asset('front/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('front/js/plugins.js') }}"></script>
        <script src="{{ asset('front/js/main.js') }}"></script>
        <script src="{{asset('back/plugins/toastr/toastr.min.js')}}"></script>
        {!! Toastr::message() !!}
        <script>
            $('#mobile-nav').on('click', function() {
                $('.menu').slideToggle();
            })
        </script>

        @yield('custom_js')
    </body>
</html>
