@extends('layouts.front-login')
@section("meta")
    <title>Reset Password | Soul Entertainment</title>
@endsection
@section("content")
    <div class="col-md-10 col-lg-8">

        <div class="enter_view_content">

            <ul class="nav nav_items d-flex" id="EnterView_header">
                <li class="nav-item col-6" role="presentation">
                    <a class="nav-link active" href="{{route("login")}}" >User</a>
                </li>
                <li class="nav-item col-6" role="presentation">
                    <a class="nav-link"   href="{{route("artist-login")}}" >Artist</a>
                </li>
            </ul>

            <div class="tab-content" id="EnterViewContent">

                <!-- Tab content user start -->
                <div class="tab-pane show active section_bg_dark" id="EnterViewUser">




                    <!-- Form artist forgot start -->
                    <form id="form_forgot_user" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row justify-content-center">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="col-sm-8 mb-3 text-center">
                                <h4 class="EnterView_tab_title">Forgot Your Password</h4>
                            </div>

                            <div class="col-sm-8 mb-3 form-floating">
                                <div class="form-floating">
                                    <input type="email" name="email" value="{{ old('email') }}"  class="form-control @error('email') is-invalid @enderror" id="userForgotEmail" placeholder="Email address">
                                    <label for="userForgotEmail">Email address</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8 text-center">
                                <button type="submit" class="btn btn_light w-100">Submit</button>
                            </div>

                            <div class="col-sm-8 mt-4 text-center">
                                <p class="mb-0">Already have an account?</p>
                                <a href="{{route("login")}}" data-formID="form_login_user">Sign In</a>
                            </div>

                        </div>
                    </form>
                    <!-- Form artist forgot end -->

                </div>
                <!-- Tab content user end -->



            </div>

        </div>

    </div>
@endsection

