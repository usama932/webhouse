@extends('frontend.index')
@section('page')

    <header>
    @include('frontend.layout.menu')
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-6">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{isset($package_page->package_heading) ? $package_page->package_heading : 'Our Packages'}}</h1>
                    <p>{{isset($package_page->package_content) ? $package_page->package_content : 'UK Web Designs aims to help small and medium-sized
                      businesses in the UK. We have affordable pricing plans
                      for all services. What are you waiting for? Share your
                      project with our account manager now!'}}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($package_page->image) ? $package_page->image : asset('assets/imges/card-mockup.png')}}" alt="industries" class="service-industries-banner-img img-fluid ">
            </div>
          </div>
      </div>

    </header>
    <!-- Header end -->


    <section class="service-description">
      <div class="row mt-5">
        <h1>{{isset($package_page->pricing_heading) ? $package_page->pricing_heading : 'Our Affordable Pricing Plan'}}Our Affordable Pricing Plan</h1>
        <p class="text-center p-3">{{isset($package_page->pricing_content) ? $package_page->pricing_content : 'We aim to deliver high-quality service to our clients to
          build a long-lasting business relationship'}}</p>
      </div>

      {{-- <div class="work-tab">
        <button class="btn btn-work-tab-p work-tab-active" work-filter-p="website-p" >Website</button>
        <button class="btn btn-work-tab-p" work-filter-p="logo-p">Logo</button>
        <button class="btn btn-work-tab-p " work-filter-p="ecommerce-p">Ecommerce</button>
        <button class="btn btn-work-tab-p " work-filter-p="brand-p">Branding</button>
        <button class="btn btn-work-tab-p " work-filter-p="video-p">Video</button>
        <button class="btn btn-work-tab-p " work-filter-p="illu-p">Illustrative</button>
        <button class="btn btn-work-tab-p " work-filter-p="digital-p">Digital Martketing</button>
    </div> --}}
        <div class="container">
          <div class="package website-p">
            <div class="container">
              <div class="owl-container">
                <div class="owl-carousel owl-theme">
                    @if ($packages->isEmpty())
                            @include('frontend.default_packages')
                        @endif
                        @foreach ($packages as $package)
                        <div class="item">
                            <div class="package-container">
                                <div class="package-header">
                                    {{ $package->name }}
                                </div>
                                <div class="package-header2">
                                   <span class="">${{ $package->price }}</span>
                                </div>
                                <div class="package-body">
                                    {{ $package->content }}
                                    {{-- <ul>
                                        <li>UNLIMITED Logo Design Concepts</li>
                                        <li>By 4 Designers</li>
                                        <li>UNLIMITED Revisions</li>
                                        <li>Stationary Design (Business Card,<br>
                                            Letterhead. Envelope)</li>
                                        <li>FREE MS Word Letterhead</li>
                                        <li>48 to 72 hours TAT</li>
                                        <li>All Final Files Format (AI, PSD, EPS, PNG,<br>
                                            GIF, JPG, PDF)</li>
                                    </ul> --}}
                                </div>
                                <div class="text-center">
                                    <form action="{{ route('add_to_cart_package') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $package->id }}">
                                        <button class="btn btn-warning" type="submit">Buy Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
            </div>
          </div>

        </div>
    </section>

    @endsection
