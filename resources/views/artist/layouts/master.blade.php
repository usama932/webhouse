<?php
$setting =\App\Setting::pluck('value','name')->toArray();
// $logo = isset($setting['logo']) ? '/uploads/'.$setting['logo'] : 'frontend/images/logo_light.png';
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="@isset($setting['favicon']) {{ asset('uploads/'.$setting['favicon']) }}@endisset" type="image/x-icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="{{asset('frontend/css/fontawesome_all.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MAIN SITE STYLE SHEETS -->
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">

    <link href="{{url('frontend/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
   @yield('stylesheets')

    @yield("meta")


</head>

<body class="d-flex flex-column min-vh-100 justify-content-center justify-content-md-between">

<!-- Offcanvas Menu Start -->
<div class="offcanvas offcanvas-start offcanvas-lg" data-bs-scroll="true" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header">
        <a href="{{route('artist.dashboard')}}">
            <img alt="" src="{{asset('frontend/images/logo_light.png')}}"/>
        </a>
        <button type="button" class="btn_offcanvas_close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fas fa-times-circle"></i>
        </button>
    </div>
    <div class="offcanvas-body pt-0">
        <ul class="navbar-nav mt-0">

            <li class="nav-item">
                <a class="nav-link" href="{{route("artist-videos.index")}}">
                    <i class="fas fa-video"></i>
                    <span class="nav-link-title">Videos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("artist-audios.index")}}">
                    <i class="fas fa-headphones"></i>
                    <span class="nav-link-title">Audios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("artist-images.index")}}">
                    <i class="fas fa-images"></i>
                    <span class="nav-link-title">Photos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("artist-albums.index")}}">
                    <i class="fas fa-compact-disc"></i>
                    <span class="nav-link-title">Albums</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("artist-subscribers.index")}}">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-title">Subscribers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("artist-events.index")}}">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="nav-link-title">Events</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle"></i>
                    <span class="nav-link-title">Account</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('artist.profile')}}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('artist.logout')}}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Offcanvas Menu End -->

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg py-0">
                    <div class="col col-md-3 navbar-brand">
                        <a href="{{route("artist.dashboard")}}">
                            <img alt="" src = "{{asset('frontend/images/logo_light.png')}}" width="100" />
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
                        <svg width="28" height="28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />
                        </svg>
                    </button>

                    <div class="col col-md-6 collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0 d-flex align-items-start">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('artist/artist-videos') ? ' current-page-item active' : '' }}" href="{{route("artist-videos.index")}}">
                                    <i class="fas fa-video"></i>
                                    <span class="nav-link-title">Videos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('artist/artist-audios') ? ' current-page-item active' : '' }}" href="{{route("artist-audios.index")}}">
                                    <i class="fas fa-headphones"></i>
                                    <span class="nav-link-title">Audios</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('artist/artist-images') ? ' current-page-item active' : '' }}" href="{{route("artist-images.index")}}">
                                    <i class="fas fa-images"></i>
                                    <span class="nav-link-title">Photos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('artist/artist-albums') ? ' current-page-item active' : '' }}" href="{{route('artist-albums.index')}}">
                                    <i class="fas fa-compact-disc"></i>
                                    <span class="nav-link-title">Albums</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('artist/artist-subscribers') ? ' current-page-item active' : '' }}" href="{{route("artist-subscribers.index")}}">
                                    <i class="fas fa-users"></i>
                                    <span class="nav-link-title">Subscribers</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Request::is('artist/artist-events') ? ' current-page-item active' : '' }} " href="{{route("artist-events.index")}}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="nav-link-title">Events</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 d-none d-lg-inline-flex">
                        <ul class="navbar-nav d-inline-flex align-items-center justify-content-end w-100">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav-link-avatar d-inline-flex align-items-center" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                 
                                    <img alt="" src="{{asset('frontend/images/avatar.png')}}" width="40"/>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{route('artist.profile')}}">Profile</a></li>
                                    <li><a class="dropdown-item" href="{{route('artist.logout')}}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>

                </nav>
            </div>
        </div>
    </div>
</header>

@yield("content")

<footer>

    <div class="footer_copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-2 mt-2">© 2022 Soul Entertainment. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>

</footer>


<!-- Js -->
<script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/lightbox.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script src="{{asset('frontend/sweetalert2/sweetalert2.min.js')}}"></script>

@yield("scripts")

</body>

</html>
