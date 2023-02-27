@extends('layouts.front-login')
@section("meta")
    <title>Register | Soul Entertainment</title>
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


                    <!-- Form user register start -->
                    <form id="form_register_user" action="{{route("register")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">

                            <div class="col-sm-8 mb-3 text-center">
                                <h4 class="EnterView_tab_title">Register As User</h4>
                            </div>

                            <div class="col-sm-8 mb-3">
                                <div class="form-floating">
                                    <input type="text" name="name"  value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="userRegister_fname" placeholder=" Name">
                                    <label for="userRegister_fname">Name</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8 mb-3">
                                <div class="form-floating">
                                    <input type="text" name="phone"  value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" id="userRegister_phone" placeholder="Phone number">
                                    <label for="userRegister_phone">Phone number</label>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8 mb-3">
                                <div class="form-floating">
                                    <input type="email" name="email"  value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="userRegister_email" placeholder="Email address">
                                    <label for="userRegister_email">Email address</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8 mb-3">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="userRegister_password" placeholder="Password">
                                    <label for="userRegister_password">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8 mb-3">
                                <div class="form-floating">
                                    <input type="password" name="password_confirmation" class="form-control" id="userRegister_password2" placeholder="Confirm password">
                                    <label for="userRegister_password2">Confirm password</label>
                                </div>
                            </div>

                            <div class="col-sm-8 mb-3 d-flex align-items-center">
                                <label class="form-check-label me-3" for="userRegister_gender">Gender :</label>
                                <div class="form-check me-3">
                                    <input class="form-check-input" checked value="1" type="radio" name="gender" id="userRegister_gender_male">
                                    <label class="form-check-label" for="userRegister_gender_male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" checked value="0" type="radio" name="gender" id="userRegister_gender_female">
                                    <label class="form-check-label" for="userRegister_gender_female">Female</label>
                                </div>
                                @error('gender')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-sm-8 mb-3 d-flex align-items-center">
                                <label for="userRegister_image" class="form-label col-sm-4 col-4">Upload Image</label>
                                <input class="form-control  @error('image') is-invalid @enderror" name="image"  type="file" id="userRegister_image">
                                @error('image')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-sm-8 text-center">
                                <button type="submit" class="btn btn_light w-100">Register</button>
                            </div>

                            <div class="col-sm-8 mt-4 text-center">
                                <p class="mb-0">Already have an account?</p>
                                <a href="{{route("login")}}" data-formID="form_login_user">Sign In</a>
                            </div>

                        </div>
                    </form>
                    <!-- Form user register end -->

                    <!-- Form artist forgot start -->
                    <form id="form_forgot_user" class="d-none" action="indexUser.html">
                        <div class="row justify-content-center">

                            <div class="col-sm-8 mb-3 text-center">
                                <h4 class="EnterView_tab_title">Forgot Your Password</h4>
                            </div>

                            <div class="col-sm-8 mb-3 form-floating">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="userForgotEmail" placeholder="Email address">
                                    <label for="userForgotEmail">Email address</label>
                                </div>
                            </div>

                            <div class="col-sm-8 text-center">
                                <button type="submit" class="btn btn_light w-100">Submit</button>
                            </div>

                            <div class="col-sm-8 mt-4 text-center">
                                <p class="mb-0">Already have an account?</p>
                                <a href="#" data-formID="form_login_user">Sign In</a>
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
