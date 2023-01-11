
@extends('frontend.index')
@section('page')

    <header>
    @include('frontend.layout.menu')
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>Amazon</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,.</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ asset('assets/imges/services/15255-ai.png') }}" alt="Digital Marketing" class="services-amazon-banner-img img-fluid ">
            </div>
          </div>
      </div>

    </header>
    <!-- Header end -->


    <section class="service-description">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h2>Boost Your Business With Online
              Digital Marketing Services</h2>
            <p>
              Choose UK Web Designs as your digital marketing agency and take your business to new
              heights of success with our award-winning digital marketing strategies. We help businesses
              drive real growth and crush competitors. Our team of digital marketing experts has executed
              countless digital marketing campaigns for businesses looking to generate more traffic, leads,
              and sales. Your business can be next!
            </p>
          </div>
        </div>
        <div class="bc-circle-line iot-line"></div>
        <div class="row mt-5">
          <div class="col-12">
            <div class="pack-container ">
              <h1>Amazon</h1>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="pack-container float-right ">
              <h1>Amazon</h1>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="pack-container ">
              <h1>Amazon</h1>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="pack-container float-right ">
              <h1>Amazon</h1>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>

          </div>
        </div>
      </div>
    </section>
  @endsection
