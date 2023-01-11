@extends('frontend.index')
@section('page')
<style>
    @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
</style>
<header>
    @include('frontend.layout.menu')
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>User Profile</h1>
                    {{-- <p>{{ isset($web_service->main_description) ? $web_service->main_description : 'Webhouse offers robust and scalable web application development
                        services across various platforms and industry verticals. We provide
                        complete end-to-end website development services for mission-critical
                        web applications demanding superior performance.' }}</p> --}}
                </div>
              </div>
            </div>
            {{-- <div class="col-md-5">
              <img src="{{ isset($web_service->image) ? asset($web_service->image) : asset('assets/imges/services/web-development.png') }}" alt="Web development" class=" service-banner-img img-fluid ">
            </div> --}}
          </div>
      </div>
    </header>
    <section class="h-100 h-custom"{{--  style="background-color: #eee;" --}}>
        <div class="row mt-sm-4">
            
            <div class="col-12 col-md-12 col-lg-12 p-4">
              <div class="card">
                <div class="padding-20">
                  <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="profile-tab1" data-toggle="tab" href="#info" role="tab"
                        aria-selected="false">Info</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                        aria-selected="false">Settings</a>
                    </li>
                  </ul>
                  <div class="tab-content tab-bordered" id="myTab3Content">
  
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="profile-tab1">
                      <form method="post" class="needs-validation" action="#" enctype="multipart/form-data">
                          @csrf
                        <div class="card-header">
                          <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-md-6 col-12">
                              <label>Name</label>
                              <input type="text" name="name" class="form-control" value="{{ Auth::guard('web')->user()->name }}" required>
                              <div class="invalid-feedback">
                                Please fill in the name
                              </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control" value="{{ Auth::guard('web')->user()->email }}" required>
                              <div class="invalid-feedback">
                                Please fill in the email
                              </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                              <label>Email</label>
                              <input type="text" name="phone" class="form-control" value="{{ Auth::guard('web')->user()->phone }}" required>
                              <div class="invalid-feedback">
                                Please fill in the phone
                              </div>
                            </div>
                          </div>
                          {{-- <div class="row">
                            <div class="form-group col-md-6 col-12">
                              <label>Profile Image</label>
                              <input type="file" name="image" class="form-control" value="">
                              <div class="invalid-feedback">
                                Please fill in the name
                              </div>
                            </div>
                          </div> --}}
                        </div>
                        <div class="card-footer text-right">
                          <button class="btn btn-indigo waves-effect waves-light" type="submit">Save Changes</button>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                      <form method="post" class="needs-validation" action="#" enctype="multipart/form-data">
                          @csrf
                        <div class="card-header">
                          <h4>Change Password</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-md-4 col-12">
                              <label>Old Password</label>
                              <input name="old_password" type="password" class="form-control" value="" required>
                              <div class="invalid-feedback">
                                Please fill in the old password
                              </div>
                            </div>
                            <div class="form-group col-md-4    col-12">
                              <label>New Password</label>
                              <input name="password" type="password" class="form-control" value="" required>
                              <div class="invalid-feedback">
                                Please fill in the new password
                              </div>
                            </div>
                            <div class="form-group col-md-4    col-12">
                              <label>Confirm New Password</label>
                              <input type="password" name="password_confirmation" class="form-control" value="" required>
                              <div class="invalid-feedback">
                                Please fill in the Confirm New Password
                              </div>
                            </div>
                          </div>
  
                        </div>
                        <div class="card-footer text-right">
                          <button class="btn btn-indigo waves-effect waves-light" type="submit">Change Password</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
      </section>

      <div class="padding-footer">

      </div>
@endsection