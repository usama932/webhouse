@extends('frontend.index')
@section('page')
    <header>
        @include('frontend.layout.menu')

        <img src="assets/imges/slider1.png" alt="web House" class="img-fluid banner-img">

    </header>
    <!-- Header end -->

    <!-- About Us   data-aos="fade-down"-->
    @php
        $home_about = App\Models\AboutUs::first();
    @endphp

    <section class="about-section">
        <div class="about-area" style="background-color: #FFC312">
            <div class="container">
                <h1 class="about-header-text">{{ isset($home_about->header_one) ? $home_about->header_one : 'WEB HOUSE' }}
                </h1>
                <h3 style="color: white">{{ isset($home_about->header_two) ? $home_about->header_two : 'ABOUT US' }}</h3>
                <p style="color: black">
                    {{ isset($home_about->content)
                        ? $home_about->content
                        : 'Everything we create for brands works better.
                                    That’s because whether we’re working on
                                    branding, digital marketing or content, we
                                    start with better insight. Better Works is what
                                    makes everything this full-service agency
                                    creates brilliantly effective. We providing
                                    software development services , mobile app
                                    development, technology consulting and IT
                                    outsourcing solutions to clients worldwide.
                                    We empower enterprises to transform their
                                    businesses by accelerating digital innovation,
                                    enabling agile business platforms and
                                    shortening time-to-market through our
                                    distributed project management capabilities.' }}
                </p>
            </div>
        </div>
        <img src="{{ isset($home_about->image) ? asset($home_about->image) : asset('assets/imges/about-section.png') }}"
            alt="" class="img-fluid about-backgroud-img">
        <!-- <img src="assets/imges/about-section.png" alt="Web House" class="img-fluid about-backgroud-img">  -->
    </section>

    <!-- About Us  -->

    <!-- Service section -->
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
    <!-- Service section End -->

    <!-- Service1 section  -->
    <section class="service-section-1">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="assets/imges/panda1.png" alt="Web house" class="img-fluid">
                    <div class="service-1-text">
                        <h1>Find everything
                            your brand needs
                            to grow.</h1>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row  gy-3 mt-3">
                        <div class="col-6 col-sm-6 col-md-4">
                            <img src="assets/imges/services1/ezgif.com-gif-maker1.png" alt="Ecommerce" class="img-fluid">
                        </div>
                        <div class="col-6 col-sm-6 col-md-4">
                            <img src="assets/imges/services1/ezgif.com-gif-maker2.png" alt="Digital Marketing"
                                class="img-fluid">
                        </div>
                        <div class="col-6 col-sm-6 col-md-4">
                            <img src="assets/imges/services1/ezgif.com-gif-maker3.png" alt="Digital Content"
                                class="img-fluid">
                        </div>

                        <div class="col-6 col-sm-6 col-md-4">
                            <img src="assets/imges/services1/Content-Design.png" alt="Content Design" class="img-fluid">
                        </div>
                        <div class="col-6 col-sm-6 col-md-4">
                            <img src="assets/imges/services1/Service-06.png" alt="Video Editing" class="img-fluid">
                        </div>
                        <div class="col-6 col-sm-6 col-md-4">
                            <img src="assets/imges/services1/Web-Development.png" alt="Web Development" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service section END -->

    <!-- Service-product -->
    <section class="service-product">
        <h1 class="text-center">Unlock the Door</h1>
        <h2 class="text-center">Trust with Us</h2>
        <div class="row gy-3">
            <div class="col-md-6">
                <div class="service-product-area">
                    <div class="row">
                        <div class="col-8">
                            <div class="container">
                                <h3>Website Design and
                                    Digital Marketing
                                    Services</h3>
                            </div>

                        </div>
                        <div class="col-4">
                            <img src="assets/imges/ezgif.com-gif-maker1.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-product-area">
                    <div class="row">
                        <div class="col-8">
                            <div class="container">
                                <h3>Vibrant Web Design
                                    to Showcase a
                                    Brand's Creative Flair</h3>
                            </div>

                        </div>
                        <div class="col-4">
                            <img src="assets/imges/ezgif.com-gif-maker2.png" alt="Web house" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-3 mt-3">
            <div class="col-md-6">
                <div class="service-product-area">
                    <div class="row">
                        <div class="col-8">
                            <div class="container">
                                <h3>Creative &
                                    Responsive Joomla
                                    Web Design</h3>
                            </div>

                        </div>
                        <div class="col-4">
                            <img src="assets/imges/ezgif.com-gif-maker3.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-product-area">
                    <div class="row">
                        <div class="col-8">
                            <div class="container">
                                <h3>Delivering a Managed
                                    Web Service to
                                    Support the Trust's
                                    Intranet Sites</h3>
                            </div>

                        </div>
                        <div class="col-4">
                            <img src="assets/imges/ezgif.com-gif-maker4.png" alt="Web house" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- packages  -->
    @php
        $home_package = App\Models\HomePackage::first();
    @endphp
    {{-- @if ($home_package) --}}

    <section class="packages">
        <div class="container">
            <h1 class="text-center">
                {{ isset($home_package->heading_text) ? $home_package->heading_text : 'PROFESSIONAL DESIGN PACKAGES FOR ANY BUDGET' }}
            </h1>
            <h3 class="text-center">
                {{ isset($home_package->sub_heading_text)
                    ? $home_package->sub_heading_text
                    : 'OFFERING A RANGE OF COMPETITIVE CUSTOM LOGO DESIGN PACKAGES
                                    DESIGNED FOR YOUR BUSINESS NEEDS' }}
            </h3>
            <div class="owl-container">
                <div class="owl-carousel owl-theme">
                    @php
                        $packages = App\Models\Package::all();
                    @endphp
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
                                    <span class="">$ {{ $package->price }}</span>
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
    </section>
    {{-- @endif --}}

    <!-- packages End -->

    <!-- All in one combo -->
    <section class="combo">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="combo-header">
                                <h1>ALL-IN-ONE COMBO</h1>
                            </div>
                            <div class="combo-text">
                                <p>
                                    This logo design package offers remarkable value for companies looking to
                                    establish their online presence and increase their market reach with innovative
                                    digital solutions. Benefit from our power-packed combo package, custom
                                    made to suit your needs.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="combo-header">
                                <h3>Logo Design</h3>
                            </div>
                            <div class="combo-text">
                                <ul class="unstyle-list">
                                    <li>Unlimited Logo Design Concepts</li>
                                    <li> Unlimited Revisions</li>
                                    <li>Icon Design</li>
                                    <li>All Final File Formats</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="combo-header mt-5">
                                <h3>Stationary Design</h3>
                            </div>
                            <div class="combo-text">
                                <ul class="unstyle-list">
                                    <li>Business Card</li>
                                    <li>Letterhead</li>
                                    <li>Envelope</li>
                                    <li>MS Word Letterhead</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="combo-header">
                                <h3>Website Design</h3>
                            </div>
                            <div class="combo-text">
                                <ul class="unstyle-list">
                                    <li>UNLIMITED Pages Website</li>
                                    <li>Content Management System (CMS)</li>
                                    <li>Mobile Responsive</li>
                                    <li>5 Stock Photos + 3 Banner Designs</li>
                                    <li>Any 3 Social Media Platforms</li>
                                    <li>Complete W3C Certified HTML</li>
                                    <li>Complete Deployment</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="combo-header mt-5">
                                <h3>Value Added Services</h3>
                            </div>
                            <div class="combo-text">
                                <ul class="unstyle-list">
                                    <li> Dedicated Account Manager</li>
                                    <li>100% Ownership Rights</li>
                                    <li>100% Money Back Guarantee</li>
                                    <li>Complete Deployment</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="price-container">
                        All for <br>
                        Just <span class="price-lable"> $999</span>
                        <p class="text-right">Only</p>
                    </div>
                    <img src="assets/imges/2554013.png" alt="Web House" class="img-fluid">
                </div>
            </div>
        </div>

    </section>
    <!-- All in one combo end -->

    <!-- Contact us form  -->

    <section class="contact-us">
        <div class="contact-us-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Get In Touch</h1>
                        <div class="contact-container">
                            @if ($errors->any())
                                <div class="alert alert-success">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('send_enquiry') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text contact-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="sender_name" class="form-control contact-control"
                                        placeholder="Name" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text contact-group-text"><i
                                            class="fas fa-envelope"></i></span>
                                    <input type="email" name="sender_email" class="form-control contact-control"
                                        placeholder="Email" required>
                                </div>
                                <div class="input-group mb-3">
                                    <textarea name="message" id="" rows="5" class="form-control contact-control" placeholder="Message"
                                        required></textarea>
                                </div>

                                <button type="submit" class="btn btn-sm bnt-send">Send</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/imges/piccccc.png') }}" alt="Web House" class="contact-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us End -->
    <div class="padding-footer">

    </div>
@endsection
