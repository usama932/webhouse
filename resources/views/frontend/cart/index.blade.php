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
                  <h1>User Cart</h1>
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
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
              <div class="card">
                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-success">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                  <div class="row">
      
                    <div class="col-lg-7">
                      {{-- <h5 class="mb-3"><a href="#!" class="text-body"><i
                            class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5> --}}
                      <hr>
      
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                          <p class="mb-1">Shopping cart</p>
                          <p class="mb-0">You have {{ $user_carts->count() }} items in your cart</p>
                        </div>
                        {{-- <div>
                          <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                              class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                        </div> --}}
                      </div>
      
                      @foreach ($user_carts as $item)
                      <div class="card mb-3">
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                              {{-- <div>
                                <img
                                  src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp"
                                  class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                              </div> --}}
                              <div class="ms-3">
                                <h5>{{ $item->package->name }}</h5>
                                {{-- <p class="small mb-0">256GB, Navy Blue</p> --}}
                              </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                              {{-- <div style="width: 50px;">
                                <h5 class="fw-normal mb-0">2</h5>
                              </div> --}}
                              <div style="width: 80px;">
                                <h5 class="mb-0">${{ $item->package->price }}</h5>
                              </div>
                              <form action="{{ route('delete_from_cart') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" style="border:none"><i class="fas fa-trash-alt" style="color: #cecece;"></i></button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
      
                    </div>
                    <div class="col-lg-5">
      
                      <div class="card bg-warning text-white rounded-3">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Card details</h5>
                            {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                              class="img-fluid rounded-3" style="width: 45px;" alt="Avatar"> --}}
                          </div>
      
                          <p class="small mb-2">Card type</p>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-visa fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-amex fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>
      
                          <form class="mt-4">
                            <div class="form-outline form-white mb-4">
                              <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                placeholder="Cardholder's Name" required>
                              <label class="form-label" for="typeName">Cardholder's Name</label>
                            </div>
      
                            <div class="form-outline form-white mb-4">
                              <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                                placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" required>
                              <label class="form-label" for="typeText">Card Number</label>
                            </div>
      
                            <div class="row mb-4">
                              <div class="col-md-6">
                                <div class="form-outline form-white">
                                  <input type="text" id="typeExp" class="form-control form-control-lg"
                                    placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" required>
                                  <label class="form-label" for="typeExp">Expiration</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-outline form-white">
                                  <input type="password" id="typeText" class="form-control form-control-lg"
                                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" required>
                                  <label class="form-label" for="typeText">CVV</label>
                                </div>
                              </div>
                            </div>
      
                          </form>
      
                          <hr class="my-4">
      
                          <div class="d-flex justify-content-between">
                            <p class="mb-2">Subtotal</p>
                            <p class="mb-2">${{ $user_carts->sum('amount') }}</p>
                          </div>
      
                          {{-- <div class="d-flex justify-content-between">
                            <p class="mb-2">Shipping</p>
                            <p class="mb-2">$20.00</p>
                          </div> --}}
      
                          <div class="d-flex justify-content-between mb-4">
                            <p class="mb-2">Total{{-- (Incl. taxes) --}}</p>
                            <p class="mb-2">${{ $user_carts->sum('amount') }}</p>
                          </div>
      
                          <div class="text-center">
                            <button type="button" class="btn btn-dark btn-lg" {{ $user_carts->sum('amount') == 0 ? 'disabled' : '' }}>
                                <div class="d-flex justify-content-between">
                                  <span>Buy Now</span>
                                </div>
                              </button>
                          </div>
      
                        </div>
                      </div>
      
                    </div>
      
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