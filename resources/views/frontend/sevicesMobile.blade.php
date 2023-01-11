@extends('frontend.index')
@section('page')
    <header>
    @include('frontend.layout.menu')
    @php
        $mobile_service = App\Models\MobileAppDevelopment::first();
    @endphp
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{ isset($mobile_service->main_heading) ?  $mobile_service->main_heading : 'MOBILE APP DEVELOPMENT' }}</h1>
                    <p>{{ isset($mobile_service->main_description) ? $mobile_service->main_description : 'Webhouse offers robust and scalable web application development
                        services across various platforms and industry verticals. We provide
                        complete end-to-end website development services for mission-critical
                        web applications demanding superior performance.' }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($mobile_service->image) ? asset($mobile_service->image) : asset('assets/imges/services/web-development.png') }}" alt="Web development" class=" service-banner-img img-fluid ">
            </div>
          </div>
      </div>
    </header>
    <!-- Header end -->


    <section class="service-description">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
              <div class="service-lef-description">
                  <h3>{{ isset($mobile_service->description_heading) ? $mobile_service->description_heading : 'WEBHOUSE IS A TOP MOBILE APP DEVELOPMENT COMPANY WITH OVER 50,000 MAN YEARS OF EXPERIENCE..' }}</h3>
                    <p>
                        {{ isset($mobile_service->description_text) ? $mobile_service->description_text : 'Webhouse is a ISO 9001 certified mobile app development company, backed by a strong workforce of 300+ experts providing high-performance mobile app development services of any complexity with incredible competence. We have been a leading value-driven, mobile application development company offering a range of services to clients representing services to organizations around the world. Hire mobile app developers from Webhouse to develop performance-oriented and business-centric mobile apps.' }}
                      
                    </p>
              </div>
          </div>
          <div class="col-md-6">
              <div class="service-right-description">
                  <div class="service-right-title">
                      <h2>{{ isset($mobile_service->service_1_heading) ? $mobile_service->service_1_heading : 'ANDROID APP DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($mobile_service->service_1_text) ? $mobile_service->service_1_text : 'Webhouse is a preferred Android app development company that builds highly robust and scalable Android apps with easy user interface and better user experience (UI/UX) meeting your requirements and budget.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($mobile_service->service_2_heading) ? $mobile_service->service_2_heading : 'IOS APP DEVELOPMENT' }}</h2>
                    <p>
                        {{ isset($mobile_service->service_2_text) ? $mobile_service->service_2_text : 'We build elegant and engaging iOS apps that makes your business successful. We have professional iOS app developers who always design and develop easy to use, user friendly and cost-effective iOS applications.' }}
                      
                    </p>
                </div>

                    <div class="service-right-title float-start">
                      <h2>{{ isset($mobile_service->service_3_heading) ? $mobile_service->service_3_heading : 'CROSS PLATFORM APP DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($mobile_service->service_3_text) ? $mobile_service->service_3_text : 'Webhouse builds cross platform apps with Xamarin, PhoneGap, React Native and other frameworks. Cross platform app development makes it possible to use reusable codes which saves lots of development time and costs.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($mobile_service->service_4_heading) ? $mobile_service->service_4_heading : 'AUGMENTED REALITY' }}</h2>
                    <p>
                        {{ isset($mobile_service->service_4_text) ? $mobile_service->service_4_text : 'Webhouse offers expert development of Augmented Reality apps. Right from retail to construction to daily enterprise activities, you can use the potential benefits of AR to make your key operations highly efficient, informed and cost effective for better ROI.' }}
                      
                    </p>
                </div>
                    <div class="service-right-title float-start">
                      <h2>{{ isset($mobile_service->service_5_heading) ? $mobile_service->service_5_heading : '' }}</h2>
                      <p>
                        {{ isset($mobile_service->service_5_text) ? $mobile_service->service_5_text : '' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($mobile_service->service_6_heading) ? $mobile_service->service_6_heading : '' }}</h2>
                    <p>
                        {{ isset($mobile_service->service_6_text) ? $mobile_service->service_6_text : '' }}
                     
                    </p>
                </div>
              </div>
          </div>
        </div>
      </div>

    </section>

    @endsection
