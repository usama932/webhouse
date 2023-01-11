@extends('frontend.index')
@section('page')

    <header>
    @include('frontend.layout.menu')
      <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
          <div class="row g-0">
            <div class="col-md-7">
              <div class="container">
                <div class="service-banner-text">
                  <h1>{{isset($industry_page->heading) ? $industry_page->heading : 'INDUSTRIES'}}</h1>
                    <p>{{isset($industry_page->text) ? $industry_page->text : 'Webhouse helps accelerate innovation and gratify
                      industry specific best practices to help run your core
                      business efficiently'}}</p>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{ isset($industry_page->image) ? asset($industry_page->image) : asset('assets/imges/services/istockphoto-513445601-612x612.png') }}" alt="industries" class="service-industries-banner-img img-fluid ">
            </div>
          </div>
      </div>
        <!-- <img src="assets/imges/slider1.png" alt="web House" class="img-fluid banner-img"> -->

    </header>
    <!-- Header end -->


<section class="industries">
  <div class="container">
    <div class="row gy-2 mb-3">
      @if ($industries->isEmpty())
          @include('frontend.defaultIndustries')
      @else
          @foreach ($industries as $item)
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <div class="card">
          <img src="{{ asset($item->icon) }}" class="card-img-top img-fluid" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{$item->name}}</h5>
            <p class="card-text">
              {{$item->text}}
            </p>
          </div>
        </div>
      </div>
          @endforeach
      @endif
    </div>
  </div>

</section>

@endsection
