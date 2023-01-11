@extends('frontend.index')
@section('page')
    <header>
        @include('frontend.layout.menu')
        <div class="service-banner" style="background-image: url({{ asset('assets/imges/back-ground-service.png') }})">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="container">
                        <div class="service-banner-text">
                            <h1>{{ isset($portfolio_page->heading) ? $portfolio_page->heading : 'Our Portfolio' }}</h1>
                            <p>{{ isset($portfolio_page->description)
                                ? $portfolio_page->description
                                : 'Our designers and developers put their heart and soul
                                                    into delivering the best quality work. Do check our
                                                    portfolio of multiple services and assess our service
                                                    delivery skills.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-protfolio">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ isset($portfolio_page->image_1) ? asset($portfolio_page->image_1) : asset('assets/imges/protfolio/Mask-Group-14.png') }}"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="col-6 mt-4">
                                <img src="{{ isset($portfolio_page->image_2) ? asset($portfolio_page->image_2) : asset('assets/imges/protfolio/Mask-Group-15.png') }}"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <img src="{{ isset($portfolio_page->image_3) ? asset($portfolio_page->image_3) : asset('assets/imges/protfolio/Mask-Group-16.png') }}"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="col-6 mt-4">
                                <img src="{{ isset($portfolio_page->image_4) ? asset($portfolio_page->image_4) : asset('assets/imges/protfolio/Mask-Group-19.png') }}"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <img src="{{ isset($portfolio_page->image_5) ? asset($portfolio_page->image_5) : asset('assets/imges/protfolio/Mask-Group-18.png') }}"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="col-6 mt-4">
                                <img src="{{ isset($portfolio_page->image_6) ? asset($portfolio_page->image_6) : asset('assets/imges/protfolio/Mask-Group-17.png') }}"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- Header end -->


    <section class="service-description">
        <div class="container">
            <div class="row mt-5">
                <h1>{{ isset($portfolio_page->portfolio_heading) ? $portfolio_page->portfolio_heading : 'We Have Helped 1000+ Clients Grow Digitally!' }}
                </h1>
                <p class="text-center p-3">
                    {{ isset($portfolio_page->portfolio_text)
                        ? $portfolio_page->portfolio_text
                        : 'Our tech-enabled digital marketing services have helped thousands of businesses attract qualified
                                    traffic, online leads, increase in calls, and greater revenues.' }}
                </p>
            </div>

            @if (!$portfolios->isEmpty())
                <div class="work-tab">
                    @foreach ($portfolio_types as $item)
                        <button class="btn btn-work-tab work-tab-active"
                            work-filter="{{ str_replace(' ', '-', $item->name) }}">{{ $item->name }}</button>
                    @endforeach
                </div>
                <div class="work-area">
                    <div class="container">
                        <div class="marketing-img">
                            <div class="row gy-3">
                                @foreach ($portfolios as $item)
                                    <div class="col-6 col-md-4 {{ str_replace(' ', '-', $item->portfolio_type->name) }}">
                                        <a href="{{ $item->link }}" target="__blank">
                                            <div class="card">
                                                <div class="card-top-img">
                                                    <img src="{{ asset($item->image) }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @include('frontend.defaultPortfolios')
            @endif
        </div>
    </section>

@endsection
