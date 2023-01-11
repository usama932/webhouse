@extends('frontend.index')
@section('page')
  <header>
  @include('frontend.layout.menu')

  <div class="row g-0">
    <div class="col-6">
      <div class="banner-text">
        <h1 class="">NEED A FIX?</h1>
        <h1 class="text-yello">HIRE WEBHOUSE!</h1>
        <p class="mt-4">
          In this world where everything is delayed.
  Web House offers a fast and effective
  solution to all your digital problems.
  So what are you waiting for? Avail
  our services!
        </p>
      </div>
    </div>
    <div class="col-6">
      <img src="{{asset('assets/imges/pexels-andrea-piacquadio-845451.png')}}" alt="" class="img-fluid banner-img1">
    </div>
  </div>
      <!-- <img src="assets/imges/slider1.png" alt="web House" class="img-fluid banner-img"> -->

  </header>
    <!-- Header end -->

<section class="about-us">
  <div class="row g-0">

    <div class="col-md-6  order-md-2 bg-block">
      <div class="container">
        <div class="about-us-text">
          <h1 class="header-text text-yello">OUR MISSION</h1>
        <p class="mt-5">is to provide timely solutions without any compromise on quality and
          offer the best possible experience to our customers so that we can
          deliver the WOW factor.</p>
          <ul>
            <li>Attract new customers while retaining the current clients.</li>
            <li>Quality shall never be compromised.</li>
            <li>Timeliness is very important for us.</li>
          </ul>
      </div>
        </div>
    </div>
    <div class="col-md-6 order-md-1">
      <img src="{{asset('assets/imges/icons8-team-yTwXpLO5HAA-unsplash.png')}}" alt="" class="img-fluid">
  </div>
  </div>

  <div class="row g-0">

    <div class="col-md-6  bg-block">
      <div class="container">
        <div class="about-us-text">
          <h1 class="header-text text-yello">OUR VISION</h1>
        <p class="mt-5">Our vision is to become the one and only stop for all your digital
          problems. Whether you want to develop your website, want
          brand promotion, need marketing, or need content, Quickficks
          should be your go to place.</p>
          <ul>
            <li>Becoming the most client centric digital enterprise.</li>
            <li>Deliver measurable results to our clients.</li>
            <li>Assisting people and businesses to explore their full potential.</li>
          </ul>
      </div>
        </div>
    </div>
    <div class="col-md-6 ">
      <img src="{{asset('assets/imges/our-vision.png')}}" alt="" class="img-fluid">
  </div>
  </div>

</section>
@endsection
