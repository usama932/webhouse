@extends('frontend.index')
@section('page')
    <header>
    @include('frontend.layout.menu')
    @php
        $software_service = App\Models\SoftwareDevelopment::first();
    @endphp
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{ isset($software_service->main_heading) ?  $software_service->main_heading : 'SOFTWARE DEVELOPMENT' }}</h1>
                    <p>{{ isset($software_service->main_description) ? $software_service->main_description : 'Webhouse offers robust and scalable software development services across various platforms and industry verticals. We provide complete end-to-end software development services for mission-critical software applications demanding superior performance.' }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($software_service->image) ? asset($software_service->image) : asset('assets/imges/services/web-development.png') }}" alt="Web development" class=" service-banner-img img-fluid ">
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
                  <h3>{{ isset($software_service->description_heading) ? $software_service->description_heading : 'WEBHOUSE IS ONE OF THE TOP SOFTWARE DEVELOPMENT COMPANY WITH OVER 50,000 MAN YEARS OF EXPERIENCE.' }}</h3>
                    <p>
                        {{ isset($software_service->description_text) ? $software_service->description_text : 'Webhouse is a ISO 9001 certified, offshore software development company , backed by a strong workforce of 300+ experts that have been delivering result-oriented software development services to SMEs across the globe for more than 15+ years. We are committed towards adhering to latest technology trends and successfully implementing end-to-end software solutions that enhances the brand value of your your business. The development cycle at Webhouse enables us to take the scalability and reliability of our software solutions to next level so, you can focus on your core business processes. The robust software applications developed by our software developers enhances your business value through effective and interactive customer-engagement. Hire software developers from Webhouse to get professionally tailored software solutions and services that promotes enhanced productivity and increases ROI.' }}
                      
                    </p>
              </div>
          </div>
          <div class="col-md-6">
              <div class="service-right-description">
                  <div class="service-right-title">
                      <h2>{{ isset($software_service->service_1_heading) ? $software_service->service_1_heading : 'SOFTWARE DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($software_service->service_1_text) ? $software_service->service_1_text : 'Webhouse provides high-performance custom software development services and solutions customized for your business.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($software_service->service_2_heading) ? $software_service->service_2_heading : 'JAVA ENTERPRISE APPLICATIONS' }}</h2>
                    <p>
                        {{ isset($software_service->service_2_text) ? $software_service->service_2_text : 'Webhouse provides robust, scalable, customer focused and cost-effective software development services for large enterprises.' }}
                      
                    </p>
                </div>

                    <div class="service-right-title float-start">
                      <h2>{{ isset($software_service->service_3_heading) ? $software_service->service_3_heading : 'SOFTWARE MIGRATION' }}</h2>
                      <p>
                        {{ isset($software_service->service_3_text) ? $software_service->service_3_text : 'Webhouse helps enterprises in migrating their legacy systems from old technologies to present day latest platforms.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($software_service->service_4_heading) ? $software_service->service_4_heading : 'SOFTWARE TESTING' }}</h2>
                    <p>
                        {{ isset($software_service->service_4_text) ? $software_service->service_4_text : 'We have 50+ software testers to provide high performance and 100% reliable software testing services for all businesses.' }}
                      
                    </p>
                </div>
                    <div class="service-right-title float-start">
                      <h2>{{ isset($software_service->service_5_heading) ? $software_service->service_5_heading : 'DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($software_service->service_5_text) ? $software_service->service_5_text : 'Webhouse develops robust and scalable Java and J2EE applications and software for customers across various business verticals.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($software_service->service_6_heading) ? $software_service->service_6_heading : 'ASP.NET DEVELOPMENT' }}</h2>
                    <p>
                        {{ isset($software_service->service_6_text) ? $software_service->service_6_text : 'Webhouse offers ASP.NET development services that are robust and enhances the business demands of our customers.' }}
                     
                    </p>
                </div>
              </div>
          </div>
        </div>
      </div>

    </section>

    @endsection
