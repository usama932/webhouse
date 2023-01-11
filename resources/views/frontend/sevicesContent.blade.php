@extends('frontend.index')
@section('page')
    <header>
    @include('frontend.layout.menu')
    @php
        $cms_service = App\Models\CMS::first();
    @endphp
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{ isset($cms_service->main_heading) ?  $cms_service->main_heading : 'CONTENT MANAGEMENT SYSTEM' }}</h1>
                    <p>{{ isset($cms_service->main_description) ? $cms_service->main_description : 'Webhouse is a one stop solution for all your CMS development requirements. We offer robust and scalable content management development services across various platforms and industry verticals with applications ranging from simple to mission-critical.' }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($cms_service->image) ? asset($cms_service->image) : asset('assets/imges/services/web-development.png') }}" alt="Web development" class=" service-banner-img img-fluid ">
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
                  <h3>{{ isset($cms_service->description_heading) ? $cms_service->description_heading : ' OUR CMS DEVELOPMENT SERVICES ENABLES ORGANIZATIONS TO BUILD THEIR DIGITAL BRAND & BRING INCREDIBLE OPPORTUNITIES.' }}</h3>
                    <p>
                        {{ isset($cms_service->description_text) ? $cms_service->description_text : ' Today is the era of internet and providing right information through websites has become extremely important. Thats why content management systems have become one of the most vital solutions to ensure that the right information is presented to the right people at the right time in a most professional manner. As a top CMS development company, Webhouse offers content management system services for all kind of businesses. Our skilled team of CMS developers work closely with the clients to make sure that the projects are developed as per their custom requirements. We have extensive experience in the implementing Drupal, Magento, WordPress, Joomla, Kentico, Umbraco and Dotnetnuke CMS.' }}
                      
                    </p>
              </div>
          </div>
          <div class="col-md-6">
              <div class="service-right-description">
                  <div class="service-right-title">
                      <h2>{{ isset($cms_service->service_1_heading) ? $cms_service->service_1_heading : 'WEB CONTENT MANANGEMENT' }}</h2>
                      <p>
                        {{ isset($cms_service->service_1_text) ? $cms_service->service_1_text : 'Webhouse assists enterprises in delivering right information to their customers with our expert web content management services. We facilitate efficient management, creation and delivery of web content stored in databases.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($cms_service->service_2_heading) ? $cms_service->service_2_heading : 'THEME DEVELOPMENT' }}</h2>
                    <p>
                        {{ isset($cms_service->service_2_text) ? $cms_service->service_2_text : 'Webhouse provides ecommerce plugin and module development services with on-time deliverable guarantee and 100% satisfaction.' }}
                      
                    </p>
                </div>

                    <div class="service-right-title float-start">
                      <h2>{{ isset($cms_service->service_3_heading) ? $cms_service->service_3_heading : 'ENTERPRISE CONTENT MANAGEMENT' }}</h2>
                      <p>
                        {{ isset($cms_service->service_3_text) ? $cms_service->service_3_text : 'Webhouse provides enterprise content management services and we are fully capable to solve complex problems of enterprises spread across different industry verticals. We help companies to effectively manage their enterprise web content, digital assets, documents and electronic records.' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($cms_service->service_4_heading) ? $cms_service->service_4_heading : 'DOCUMENT MANAGEMENT' }}</h2>
                    <p>
                        {{ isset($cms_service->service_4_text) ? $cms_service->service_4_text : 'Smart businesses need smart documents. Therefore, we provide document management services inclusive of document management, digitization, imaging, indexing and archiving services to ensure that all the information can be stored safely and retrieved quickly whenever it is required.' }}
                      
                    </p>
                </div>
                    <div class="service-right-title float-start">
                      <h2>{{ isset($cms_service->service_5_heading) ? $cms_service->service_5_heading : '' }}</h2>
                      <p>
                        {{ isset($cms_service->service_5_text) ? $cms_service->service_5_text : '' }}
                        
                      </p>
                  </div>
                  <div class="service-right-title float-right">
                    <h2>{{ isset($cms_service->service_6_heading) ? $cms_service->service_6_heading : '' }}</h2>
                    <p>
                        {{ isset($cms_service->service_6_text) ? $cms_service->service_6_text : '' }}
                     
                    </p>
                </div>
              </div>
          </div>
        </div>
      </div>

    </section>

    @endsection
