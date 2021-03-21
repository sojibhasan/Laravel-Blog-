@extends('layouts.front')

@section('page_title')
DivineBlog :: Contact
@endsection

                    @section('content')
                    <div class="col-xl-12 col-lg-12">
                        <!-- Contact area start -->
                        <div class="contact-area pt-30 pb-90">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 order-2 order-lg-1">
                                        <div class="contact-info mb-30">
                                            <h2>Keep in touch</h2>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="contact-meta mb-30">
                                                        <div class="contact-meta-info">
                                                            <h4>Phone</h4>
                                                            @php
                                                                $phones = explode(",",$setting->phone)
                                                            @endphp
                                                            @foreach($phones as $phone)
                                                            <p>{{ $phone }}</p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="contact-meta mb-30">
                                                        <div class="contact-meta-info">
                                                            <h4>E-mail</h4>
                                                            <p><a href="mailto:{{ $setting->email }}" class="__cf_email__" >{{ $setting->email }}</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 mb-30">
                                                    <div class="contact-meta">
                                                        <div class="contact-meta-info">
                                                            <h4>Address</h4>
                                                            <p>{{ $setting->address }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="footer-social">
                                                        @foreach($socials as $social)
                                                        @php
                                                        $social_class = '';
                                                        if($social->name == 'facebook') {
                                                            $social_class = 'facebook';
                                                        }

                                                        elseif($social->name == 'twitter') {
                                                            $social_class = 'twitter';
                                                        }

                                                        elseif($social->name == 'instagram') {
                                                            $social_class = 'instagram';
                                                        }

                                                        elseif($social->name == 'linkedin') {
                                                            $social_class = 'linkedin';
                                                        }

                                                        elseif($social->name == 'dribbble') {
                                                            $social_class = 'dribbble';
                                                        }

                                                        elseif($social->name == 'google') {
                                                            $social_class = 'google-plus';
                                                        }

                                                        else {
                                                            $social_class = 'facebook';
                                                        }
                                                        @endphp
                                                        <a target="_blank" class="{{ $social_class }}" href="{{ $social->link }}"><i class="{{ $social->class }}"></i></a>

                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 order-1 order-lg-2">
                                        <div class="contact-form mb-30">
                                            <h3>Do you have any question?</h3>
                                            <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <input name="name" type="text" placeholder="Name">
                                                        @if($errors->has('name'))
                                                        <span style="color: red;">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <input name="email" type="email" placeholder="Email">
                                                        @if($errors->has('email'))
                                                        <span style="color: red;">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <input name="subject" type="text" placeholder="Subject">
                                                        @if($errors->has('subject'))
                                                        <span style="color: red;">{{ $errors->first('subject') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <textarea name="content" id="mesage" cols="30" rows="10" placeholder="Message"></textarea>
                                                        @if($errors->has('content'))
                                                        <span style="color: red;">{{ $errors->first('content') }}</span>
                                                        @endif
                                                        <div style="margin-top: 30px;">
                                                        <button class="btn brand-btn" type="submit">send message</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <p class="ajax-response"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Contact area end -->
                    </div>
                    @endsection