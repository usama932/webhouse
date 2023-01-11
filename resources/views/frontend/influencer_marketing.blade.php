@extends('frontend.index')
@section('page')
<header>
@php
    $influencer_service = App\Models\InfluencerMarketing::first();
@endphp
  @include('frontend.layout.menu')
  <div class="row g-0">
    <div class="col-12">
      <div class="banner-text-page1">
        <h1 class="">{{ isset($influencer_service->main_heading_1) ? $influencer_service->main_heading_1 : 'Influencer' }}</h1>
        <h1 class="banner-text-page-1-2">{{ isset($influencer_service->main_heading_2) ? $influencer_service->main_heading_2 : 'Marketing' }}</h1>
      </div>
      <img src="{{ isset($influencer_service->image) ? asset($influencer_service->image) : asset('assets/imges/ezgif.com-gif-maker-9.jpg') }}" alt="" class="img-fluid banner-page1">
    </div>
  </div>
  <!-- <img src="assets/imges/slider1.png" alt="web House" class="img-fluid banner-img"> -->

</header>
<!-- Header end -->

<section class="page-1">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="page-1-text float-end">
          <p>{{ isset($influencer_service->main_description) ? $influencer_service->main_description : 'From mega-influencers with millions of
            followers, to niche nano-influencers – we
            leverage their influence to generate
            impressions, drive consideration, build
            trust and ultimately make your brand
            more famous.' }}</p>
        </div>
      </div>
      <div class="col-md-6">
        <img src="{{ isset($influencer_service->influencer_image) ? asset($influencer_service->influencer_image) : asset('assets/imges/Content-Creation_Header.png') }}" alt="" class="img-fluid">
      </div>
    </div>

    <div class="row">
      <div class="col-md-1"></div>

      <div class="col-md-5">
        <h1>{{ isset($influencer_service->service_1_heading) ? $influencer_service->service_1_heading : 'Influencer strategy' }}</h1>
        <p class="page1-descrioption">{{ isset($influencer_service->service_1_text) ? $influencer_service->service_1_text : 'We devise a strategy that makes sure
            you get what you want out of every
            single influencer partnership.' }}</p>
      </div>
      <div class="col-md-5 page1-margin-top">
        <h1>{{ isset($influencer_service->service_2_heading) ? $influencer_service->service_2_heading : 'Database Creation' }}</h1>
        <p class="page1-descrioption">{{ isset($influencer_service->service_2_text) ? $influencer_service->service_2_text : 'We create an influencer database that
            is specific to your brand and objectives
            – giving you a bank of super relevant
            people to work with.' }}</p>
      </div>
      <div class="col-md-1"></div>

    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <h1>{{ isset($influencer_service->service_3_heading) ? $influencer_service->service_3_heading : 'Influencer Campaign Management' }}
          </h1>
        <p class="page1-descrioption">{{ isset($influencer_service->service_3_text) ? $influencer_service->service_3_text : 'From campaign ideas, to briefs, contracts
            to reports, we look after every element
            of your influencer marketing, so you
            don’t have to.' }}</p>
      </div>
      <div class="col-md-5 page1-margin-top pt-5">
        <h1>{{ isset($influencer_service->service_4_heading) ? $influencer_service->service_4_heading : 'Ambassador programmes' }}</h1>
        <p class="page1-descrioption">{{ isset($influencer_service->service_2_heading) ? $influencer_service->service_2_heading : 'Build authentic relationships with ongoing<br>
            brand ambassador programmer.' }}</p>
      </div>
      <div class="col-md-1"></div>

    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <h1>{{ isset($influencer_service->service_5_heading) ? $influencer_service->service_5_heading : '' }}
          </h1>
        <p class="page1-descrioption">{{ isset($influencer_service->service_5_text) ? $influencer_service->service_5_text : '' }}</p>
      </div>
      <div class="col-md-5 page1-margin-top pt-5">
        <h1>{{ isset($influencer_service->service_6_heading) ? $influencer_service->service_6_heading : '' }}</h1>
        <p class="page1-descrioption">{{ isset($influencer_service->service_6_heading) ? $influencer_service->service_6_heading : '' }}</p>
      </div>
      <div class="col-md-1"></div>

    </div>
  </div>

</section>
<section class="bg-img" style="background-image:url({{ asset('assets/imges/contact-background.optimised.png') }})">
  <h1>WANT BETTER?</h1>
  <h1 class="text-yello">LET'S TALK ></h1>
</section>

@endsection
