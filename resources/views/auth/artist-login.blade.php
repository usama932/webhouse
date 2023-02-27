@extends('layouts.front-login')
@section("meta")
    <title>Artist Login | Soul Entertainment</title>
@endsection
@section("content")
    <div class="col-md-10 col-lg-8">

        <div class="enter_view_content">

            <ul class="nav nav_items d-flex" id="EnterView_header">
                <li class="nav-item col-6" role="presentation">
                    <a class="nav-link "  href="{{route("login")}}" >User</a>
                </li>
                <li class="nav-item col-6" role="presentation">
                    <a class="nav-link active"   href="{{route("artist-login")}}" >Artist</a>
                </li>
            </ul>

            <div class="tab-content" id="EnterViewContent">

                <!-- Tab content user start -->

                <!-- Tab content user end -->

                <!-- Tab content artist start -->
                <div class="tab-pane show active section_bg_dark" id="EnterViewArtist">

                    <!-- Form artist login start -->
                    <form id="form_login_artist" method="POST" action="{{ route('artist.login.submit') }}">
                        @csrf
                        <div class="row justify-content-center">

                            <div class="col-sm-8 mb-3 text-center">
                                <h4 class="EnterView_tab_title">Login As Artist</h4>
                            </div>

                            <div class="col-sm-8 mb-3 form-floating">
                                <div class="form-floating">
                                    <input type="email" name="email" value="{{old('email') }}" class="form-control @error('email') is-invalid @enderror" id="userEmail" placeholder="Email address">
                                    <label for="userEmail">Email address</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8 mb-3">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="userPassword" placeholder="password">
                                    <label for="userPassword">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8 text-center">
                                <button type="submit" class="btn btn_light w-100">Login</button>
                            </div>

                            <div class="col-sm-8 mt-4 text-center">
                                <p class="mb-0"><a href="{{ route('artist.register') }}" data-formID="form_register_artist">Don't have an account? Create Account</a></p>
                                <a href="{{ route('artist.password.request') }}" data-formID="form_forgot_artist">Forgot Password?</a>
                            </div>

                        </div>
                    </form>
                    <!-- Form artist login end -->




                </div>
                <!-- Tab content artist end -->

            </div>

        </div>

    </div>
@endsection

