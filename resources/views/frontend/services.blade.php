@extends('frontend.index')
@section('page')
<header>
  @include('frontend.layout.menu')

  <div class="row g-0">
    <div class="col-5 bg-block">
      <div class="banner-text">
        <h1 class="">Our</h1>
        <h1 class="text-yello">Services</h1>
      </div>
    </div>
    <div class="col-7">
      <img src="assets/imges/pexels-andrea-piacquadio-845451.png" alt="" class="img-fluid banner-img1">
    </div>
  </div>
  <!-- <img src="assets/imges/slider1.png" alt="web House" class="img-fluid banner-img"> -->

</header>
<!-- Header end -->



<section class="service-section">
    <div class="container">
        <h3>BETTER IN EVERY AREA</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="service-div1 bg-color2">
                    <p style="color: black">Creativity mixed with vision
                        and cutting edge-technology
                        is what we pour behind the
                        bar at Application Nexus.</p>
                    <img src="assets/imges/services/11.png" alt="Web House" class="img-fluid">
                </div>
            </div>
            <div class="col-md-8" style="color: white">
                <div class="row gy-3 mt-2 row-cols-sm-2">
                    @if (!$services->isEmpty())
                    @foreach ($services as $item)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="service-div">
                            <div class="service-img">
                                <img src="{{ asset($item->image) }}" alt="Web House" class="img-fluid">
                            </div>
                            <h4>{{$item->name}}</h4>
                        </div>

                    </div>
                    @endforeach
                    @else
                        @include('frontend.defaultServices')
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection