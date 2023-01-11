@extends('frontend.index')
@section('page')
    <header>
    @include('frontend.layout.menu')
    @php
        $ecommerce_service = App\Models\EcommerceDevelopment::first();
    @endphp
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{ isset($ecommerce_service->main_heading) ?  $ecommerce_service->main_heading : 'ECOMMERCE
                    DEVELOPMENT' }}</h1>
                    <p>{{ isset($ecommerce_service->main_description) ? $ecommerce_service->main_description : 'Webhouse offers robust and scalable web application development
                        services across various platforms and industry verticals. We provide
                        complete end-to-end website development services for mission-critical
                        web applications demanding superior performance.' }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($ecommerce_service->image) ? asset($ecommerce_service->image) : asset('assets/imges/services/web-development.png') }}" alt="Web development" class=" service-banner-img img-fluid ">
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
                  <h3>{{ isset($ecommerce_service->description_heading) ? $ecommerce_service->description_heading : ' WEBHOUSE IS ONE OF THE
                    TOP WEB DEVELOPMENT
                    COMPANY WITH OVER
                    50,000 MAN YEARS OF
                    EXPERIENCE.' }}</h3>
                    <p>
                        {{ isset($ecommerce_service->description_text) ? $ecommerce_service->description_text : ' WEBHOUSE IS ONE OF THE
                    Webhouse is a ISO 9001 certified web development company, backed by a
                    strong workforce of 300+ experts providing high-performance, custom web
                    development services of any complexity with incredible competence.
                    Webhouse is a leading offshore web development company that have been
                    delivering result-oriented web solutions to SMEs across the globe for more
                    than 15+ years. We are committed towards adhering to latest technology
                    trends and successfully implementing end-to-end web solutions that
                    enhances the brand value of your your business. The development cycle at
                    Webhouse enables us to take the scalability and reliability of our web
                    solutions to next level so, you can focus on your core business processes.
                    The robust web applications developed by our web developers enhances
                    your online prominence through effective and interactive
                    customer-engagement. Hire web developers from Webhouse to get
                    professionally tailored web applications and solutions.' }}
                      
                    </p>
              </div>
          </div>
          <div class="col-md-6">
              <div class="service-right-description">
                  <div class="service-right-title">
                      <h2>{{ isset($ecommerce_service->service_1_heading) ? $ecommerce_service->service_1_heading : 'ECOMMERCE SHOPPING CART' }}</h2>
                      <p>
                        {{ isset($ecommerce_service->service_1_text) ? $ecommerce_service->service_1_text : 'Webhouse offers end-to-end ecommerce shopping cart development and implementation services for the growth of your online business.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($ecommerce_service->service_2_heading) ? $ecommerce_service->service_2_heading : 'MODULE DEVELOPMENT' }}</h2>
                    <p>
                        {{ isset($ecommerce_service->service_2_text) ? $ecommerce_service->service_2_text : 'Webhouse provides ecommerce plugin and module development services with on-time deliverable guarantee and 100% satisfaction.' }}
                      
                    </p>
                </div>

                    <div class="service-right-title float-start">
                      <h2>{{ isset($ecommerce_service->service_3_heading) ? $ecommerce_service->service_3_heading : 'ECOMMERCE WEBSITE DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($ecommerce_service->service_3_text) ? $ecommerce_service->service_3_text : 'Webhouse provides reliable ecommerce website development services with exceptional and powerful features.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($ecommerce_service->service_4_heading) ? $ecommerce_service->service_4_heading : 'CUSTOM ECOMMERCE DEVELOPMENT' }}</h2>
                    <p>
                        {{ isset($ecommerce_service->service_4_text) ? $ecommerce_service->service_4_text : 'Webhouse offers custom ecommerce development services that are robust, highly scalable and meets the online demands of our customers.' }}
                      
                    </p>
                </div>
                    <div class="service-right-title float-start">
                      <h2>{{ isset($ecommerce_service->service_5_heading) ? $ecommerce_service->service_5_heading : 'MULTI STORE DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($ecommerce_service->service_5_text) ? $ecommerce_service->service_5_text : 'Webhouse provides robust and cost-effective Multi-Store and Multi-Site development solutions for growing businesses.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($ecommerce_service->service_6_heading) ? $ecommerce_service->service_6_heading : 'MAINTENANCE & MIGRATION' }}</h2>
                    <p>
                        {{ isset($ecommerce_service->service_6_text) ? $ecommerce_service->service_6_text : 'Webhouse provides ecommerce data migration and maintenance services that empowers your business to surge ahead of the competition.' }}
                     
                    </p>
                </div>
              </div>
          </div>
        </div>
      </div>

    </section>

    @endsection
