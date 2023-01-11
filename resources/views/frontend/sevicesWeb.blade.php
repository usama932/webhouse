@extends('frontend.index')
@section('page')
    <header>
    @include('frontend.layout.menu')
    @php
        $web_service = App\Models\WebService::first();
    @endphp
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{ isset($web_service->main_heading) ?  $web_service->main_heading : 'WEBSITE
                    DEVELOPMENT' }}</h1>
                    <p>{{ isset($web_service->main_description) ? $web_service->main_description : 'Webhouse offers robust and scalable web application development
                        services across various platforms and industry verticals. We provide
                        complete end-to-end website development services for mission-critical
                        web applications demanding superior performance.' }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($web_service->image) ? asset($web_service->image) : asset('assets/imges/services/web-development.png') }}" alt="Web development" class=" service-banner-img img-fluid ">
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
                  <h3>{{ isset($web_service->description_heading) ? $web_service->description_heading : ' WEBHOUSE IS ONE OF THE
                    TOP WEB DEVELOPMENT
                    COMPANY WITH OVER
                    50,000 MAN YEARS OF
                    EXPERIENCE.' }}</h3>
                    <p>
                        {{ isset($web_service->description_text) ? $web_service->description_text : ' WEBHOUSE IS ONE OF THE
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
                      <h2>{{ isset($web_service->service_1_heading) ? $web_service->service_1_heading : 'WEB DESIGN & DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($web_service->service_1_text) ? $web_service->service_1_text : 'Webhouse offers end-to-end website design,
                        web application development and portal
                        development services for your business.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($web_service->service_2_heading) ? $web_service->service_2_heading : 'ECOMMERCE SOLUTIONS' }}</h2>
                    <p>
                        {{ isset($web_service->service_2_text) ? $web_service->service_2_text : 'Webhouse build scalable and secure
                        E-business and ecommerce solutions for
                        customers across various business verticals.' }}
                      
                    </p>
                </div>

                    <div class="service-right-title float-start">
                      <h2>{{ isset($web_service->service_3_heading) ? $web_service->service_3_heading : 'PHP DEVELOPMENT' }}</h2>
                      <p>
                        {{ isset($web_service->service_3_text) ? $web_service->service_3_text : 'Webhouse offers PHP development services
                        that enhances the business demands of our
                        customers across all verticals.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($web_service->service_4_heading) ? $web_service->service_4_heading : 'ASP.NET DEVELOPMENT' }}</h2>
                    <p>
                        {{ isset($web_service->service_4_text) ? $web_service->service_4_text : 'Webhouse provides cost effective and high
                        performance ASP.NET development services
                        for growing businesses and startups.' }}
                      
                    </p>
                </div>
                    <div class="service-right-title float-start">
                      <h2>{{ isset($web_service->service_5_heading) ? $web_service->service_5_heading : 'OPEN SOURCE SOLUTIONS' }}</h2>
                      <p>
                        {{ isset($web_service->service_5_text) ? $web_service->service_5_text : 'We leverage time and cost saving advantages
                        of open source technologies, frameworks and
                        platforms to deliver scalable web applications.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($web_service->service_6_heading) ? $web_service->service_6_heading : 'WEBSITE TESTING' }}</h2>
                    <p>
                        {{ isset($web_service->service_6_text) ? $web_service->service_6_text : ' We have 50+ web testers to provide high
                        performance and 100% reliable website
                        testing services.' }}
                     
                    </p>
                </div>
              </div>
          </div>
        </div>
      </div>

    </section>

    @endsection
