@php
    $footer = App\Models\Footer::first();
@endphp
<footer style="background: url({{ isset($footer->bg_image) ? $footer->bg_image : asset('assets/imges/footer.png') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img src="{{ isset($footer->main_logo) ? $footer->main_logo : asset('assets/imges/logo.png') }}" alt="Web House" class="img-fluid logo-footer">
                <h2 class="footer-header">Social Links</h2>
                <div class="footer-social-icon">
                    <a href="{{ isset($footer->fb_link) ? $footer->fb_link : '#'}}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ isset($footer->insta_link) ? $footer->insta_link : '#'}}"><i class="fab fa-instagram"></i></a>
                    <a href="{{ isset($footer->tw_link) ? $footer->tw_link : '#'}}"><i class="fab fa-twitter"></i></a>
                    <a href="{{ isset($footer->li_link) ? $footer->li_link : '#'}}"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <h2 class="footer-header">Contact us</h2>
                <ul style="">
                    <li>
                      <i class="fas fa-phone-alt"></i> '
                      @if (isset($footer->contact_numbers))
                      {{ $footer->contact_numbers }}
                      @else
                      <a href="tel:+92 316 0568889">+92 316 0568889,</a><a href="tel:+92 336 4433245" >+92 336 4433245,</a><a href="tel:+447915639488"> +447915639488</a>    
                      @endif
                    </li>
                    <li>
                      <i class="fas fa-envelope"></i> <a href="mailto:{{ isset($footer->email) ? $footer->email : 'muhammad.umair0976@gmail.com' }}">{{ isset($footer->email) ? $footer->email : 'muhammad.umair0976@gmail.com' }}</a>
                    </li>
                    <li>
                      <i class="fas fa-map-marker"></i>
                      @if (isset($footer->email))
                      {{ $footer->email }}
                      @else
                      Web House International ltd. Kamp House ,<br>
                      <span class="ml-4"> 152 -160 City Road , London , EC1V 2 NX United kingdom.</span>
                      @endif
                    </li>
                  </ul>
            </div>
            <div class="col-md-4">
                <div class="row mt-4">
                    <div class="col-6">
                        <img src="{{ isset($footer->logo_1) ? asset($footer->logo_1) : asset('assets/imges/logo.png') }}" alt="Web House" class="img-fluid logo-footer-b">
                    </div>
                    <div class="col-6">
                        <img src="{{  isset($footer->logo_2) ? asset($footer->logo_2) : asset('assets/imges/logo2.png') }}" alt="Web House" class="img-fluid logo-footer-b">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <img src="{{  isset($footer->logo_3) ? asset($footer->logo_3) : asset('assets/imges/logoa3.2.png') }}" alt="Web House" class="img-fluid logo-footer-b">
                    </div>
                    <div class="col-6">
                        <img src="{{  isset($footer->logo_4) ? asset($footer->logo_4) : asset('assets/imges/logoa4.1.png') }}" alt="Web House" class="img-fluid logo-footer-b">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                <h2 class="footer-header">Web House</h2>
                <ul>
                    <li><a href="/">Home</a></li>
                      <li><a href="{{ route('about_page') }}">About us</a></li>
                      <li><a href="{{ route('services_page') }}">Services</a></li>
                      <li><a href="{{ route('packages_page') }}">Package</a></li>
                      <li><a href="{{ route('contact_page') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                <h2 class="footer-header">Service</h2>
                <ul>
                    <li><a href="{{ route('web_services') }}">Website design and development</a></li>
                    <li><a href="{{ route('digital_marketing') }}">Social Media Marketing.</a></li>
                    <li><a href="{{ route('mobile_app_development') }}">Mobile App Development.</a></li>
                    <li><a href="{{ route('software_development') }}">Software Development</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                <h2 class="footer-header">Core Services</h2>
                <ul>
                    <li><a href="{{ route('amazon_page') }}">Amazon</a></li>
                    <li><a href="#">Daraz (Pakistan)</a></li>
                    <li><a href="#">Paypal</a></li>
                    <li><a href="#">Strip</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                <h2 class="footer-header">Corporate</h2>
                <ul>
                    <li><a href="{{ route('industries_page') }}">Industries</a></li>
                    {{-- <li><a href="#">Case study</a></li> --}}
                    <li><a href="{{ route('portfolio_page') }}">Portfolio</a></li>
                    <li><a href="{{ route('contact_page') }}">Contact us</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                <h2 class="footer-header">Branches</h2>
                <ul>
                    <li><a href="#">Web House UK</a></li>
                    <li><a href="#">Web House Pakistan</a></li>
                    <li><a href="#">Web Hub Z</a></li>
                    <li><a href="#">WP Technologies</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="footer-bar">
    @if (isset($footer->copyright_text))
        {{ $footer->copyright_text }}
    @else
    Copyright 2015-2022 Web house international technologies ltd . 5835 + web house client.
    @endif
</div>
