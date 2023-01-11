@extends('frontend.index')
@section('page')
    <header>
    @include('frontend.layout.menu')
    @php
        $consultancy_service = App\Models\ITConsultancy::first();
    @endphp
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{ isset($consultancy_service->main_heading) ?  $consultancy_service->main_heading : 'IT CONSULTING' }}</h1>
                    <p>{{ isset($consultancy_service->main_description) ? $consultancy_service->main_description : 'Webhouse offers provide business & technology consulting services to enterprises and organizations looking to supplement their IT requirements.' }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($consultancy_service->image) ? asset($consultancy_service->image) : asset('assets/imges/services/web-development.png') }}" alt="Web development" class=" service-banner-img img-fluid ">
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
                  <h3>{{ isset($consultancy_service->description_heading) ? $consultancy_service->description_heading : 'WEBHOUSE OFFERS BOUQUET OF IT CONSULTING SERVICES FOR DEVELOPING INNOVATIVE SOFTWARES & MOBILE APPLICATIONS.' }}</h3>
                    <p>
                        {{ isset($consultancy_service->description_text) ? $consultancy_service->description_text : 'The advantages that accrue from IT sources are well understood and appreciated by businesses and organisations across the globe. IT Consulting services have emerged as one of the most effective and convenient method of reducing overall operational cost of a business while furnishing it with high quality solutions for all the IT requirements. Over the last 15+ years, Webhouse has earned its spurs deploying the whole gamut of IT outsourcing services both to offshore and onshore businesses.' }}
                      
                    </p>
              </div>
          </div>
          <div class="col-md-6">
              <div class="service-right-description">
                  <div class="service-right-title">
                      <h2>{{ isset($consultancy_service->service_1_heading) ? $consultancy_service->service_1_heading : 'PRODUCT ENGINEERING SOLUTIONS' }}</h2>
                      <p>
                        {{ isset($consultancy_service->service_1_text) ? $consultancy_service->service_1_text : 'Webhouse renders product engineering solutions that integrate with our global delivery model to enable you to reduce time-tomarket and stay ahead of the competition.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($consultancy_service->service_2_heading) ? $consultancy_service->service_2_heading : 'MANAGED IT SOLUTIONS' }}</h2>
                    <p>
                        {{ isset($consultancy_service->service_2_text) ? $consultancy_service->service_2_text : 'Webhouse has been offering exemplary managed IT services to its elite clients consisting of large enterprises and fortune 1000 companies.' }}
                      
                    </p>
                </div>

                    <div class="service-right-title float-start">
                      <h2>{{ isset($consultancy_service->service_3_heading) ? $consultancy_service->service_3_heading : 'CLOUD SOLUTIONS' }}</h2>
                      <p>
                        {{ isset($consultancy_service->service_3_text) ? $consultancy_service->service_3_text : 'Webhouse cloud computing solutions have emerged as a promising solution, capable of bridging the gap between business expectations and IT capabilities.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($consultancy_service->service_4_heading) ? $consultancy_service->service_4_heading : 'ENGAGEMENT MODELS' }}</h2>
                    <p>
                        {{ isset($consultancy_service->service_4_text) ? $consultancy_service->service_4_text : 'Webhouse engages its clients in various flexible ways using our refined engagement models to manage client requirements that could be one-time or on-going multi-year projects.' }}
                      
                    </p>
                </div>
                    <div class="service-right-title float-start">
                      <h2>{{ isset($consultancy_service->service_5_heading) ? $consultancy_service->service_5_heading : '' }}</h2>
                      <p>
                        {{ isset($consultancy_service->service_5_text) ? $consultancy_service->service_5_text : '' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($consultancy_service->service_6_heading) ? $consultancy_service->service_6_heading : '' }}</h2>
                    <p>
                        {{ isset($consultancy_service->service_6_text) ? $consultancy_service->service_6_text : '' }}
                     
                    </p>
                </div>
              </div>
          </div>
        </div>
      </div>

    </section>

    @endsection
