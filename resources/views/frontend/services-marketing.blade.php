
@extends('frontend.index')
@section('page')
@php
    $marketing = App\Models\DigitalMarketing::first();
@endphp
    <header>
    @include('frontend.layout.menu')
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{isset($marketing->main_heading) ? $marketing->main_heading : 'Grow with the Best
                    Digital Marketing
                    Agency in London' }}</h1>
                    <p>{{isset($marketing->main_description) ? $marketing->main_description : 'A nationally recognised online digital marketing company
                      dedicated to elevating brands through innovative marketing
                      solutions, ground-breaking strategies, and immaculate
                      execution. Irrespective of the size of your business, we develop
                      bespoke marketing strategies within your budget, ensuring
                      that your brand gets the maximum attention of your target
                      audience.' }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{isset($marketing->main_image) ? asset($marketing->main_image) : asset('assets/imges/services/markering.png')}}" alt="Digital Marketing" class="service-marketing-banner-img img-fluid ">
            </div>
          </div>
      </div>

    </header>
    <!-- Header end -->


    <section class="service-description">
        <div class="container">
          <div class="row">
              <div class="col-md-9">
                  <h2>{{isset($marketing->service_description_heading) ? $marketing->service_description_heading : 'Boost Your Business With Online
                    Digital Marketing Services' }}</h2>
                    <p>{{isset($marketing->service_description) ? $marketing->service_description : 'Choose UK Web Designs as your digital marketing agency and take your business to new
                      heights of success with our award-winning digital marketing strategies. We help businesses
                      drive real growth and crush competitors. Our team of digital marketing experts has executed
                      countless digital marketing campaigns for businesses looking to generate more traffic, leads,
                      and sales. Your business can be next!' }}
                      
                    </p>
              </div>
              <div class="col-md-3">
                  <img src="{{ isset($marketing->service_image) ? asset($marketing->service_image) : asset('assets/imges/img11.png') }}" alt="" class="img-fluid">
              </div>
          </div>

          <div class="row mt-5">
            <h1>{{isset($marketing->portfolio_heading) ? $marketing->portfolio_heading : 'We Have Helped 1000+ Clients Grow Digitally!' }}</h1>
            <p class="text-center p-3">{{isset($marketing->portfolio_text) ? $marketing->portfolio_text : 'Our tech-enabled digital marketing services have helped thousands of businesses attract qualified
              traffic, online leads, increase in calls, and greater revenues.' }}</p>
          </div>

          @if (!$portfolios->isEmpty())
                <div class="work-tab">
                    @foreach ($portfolio_types as $item)
                        <button class="btn btn-work-tab work-tab-active"
                            work-filter="{{ str_replace(' ', '-', $item->name) }}">{{ $item->name }}</button>
                    @endforeach
                </div>
                <div class="work-area">
                    <div class="container">
                        <div class="marketing-img">
                            <div class="row gy-3">
                                @foreach ($portfolios as $item)
                                    <div class="col-6 col-md-4 {{ str_replace(' ', '-', $item->portfolio_type->name) }}">
                                        <a href="{{ $item->link }}" target="__blank">
                                            <div class="card">
                                                <div class="card-top-img">
                                                    <img src="{{ asset($item->image) }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @include('frontend.defaultPortfolios')
            @endif
         <div class="row mt-5">
          <h1>{{isset($marketing->custom_service_heading) ? $marketing->custom_service_heading : 'Our Custom Digital Marketing Services' }}</h1>
          <p class="text-center p-3">{{isset($marketing->custom_service_text) ? $marketing->custom_service_text : 'UK Web Designs follows a systematic approach to make sure that all our digital marketing<br>
            efforts drive profitable results, leverage our online marketing services, and let us help your business grow.' }}</p>
        </div>

        <div class="marketing-2">
          <div class="row g-0">
            <div class="col-md-3">
              <div class="row mt-3">
                @if ($services_one->isEmpty())
                    @include('frontend.defaultServiceOne')
                @else
                @foreach ($services_one as $service_one)
                    <div class="col-4 col-md-12">
                  <div class="card card-tab">
                    <div class="card-top-img">
                      <img src="{{ asset($service_one->image) }}" class="img-fluid">
                    </div>
                    <h5 class="card-title"><b></b></h5>
                    <p class="card-text">{{$service_one->description}}</p>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
            <div class="col-md-9">
               <div class="marketing-details">
                 <h1 class="mt-4">{{isset($marketing->social_media_services_heading) ? $marketing->social_media_services_heading : 'Social Media Marketing' }}</h1>
                  <div class="row gy-3 mt-5">
                    @if ($services_two->isEmpty())
                    @include('frontend.defaultServiceTwo')
                    @else
                       @foreach ($services_two as $service_two)
                            <div class="col-md-4">
                      <div class="card">
                        <img src="{{  asset($service_two->image) }}" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{$service_two->name}}</h5>
                          <p class="card-text">
                            {{$service_two->description}}
                          </p>
                        </div>
                      </div>
                    </div>
                       @endforeach
                    @endif

                  </div>
               </div>
            </div>
          </div>
        </div>

        </div>
    </section>

    @endsection
