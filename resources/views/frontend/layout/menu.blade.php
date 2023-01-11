<div class="menu">
    @php
        $menu = App\Models\Menu::first();
        $user_cart_count = App\Models\UserCart::where('user_id', Auth::guard('web')->id())->count();
    @endphp
        <div class="container">
          <div class="row">
            <div class="col-6">
              <a class="navbar-brand" href="/"><img src="{{ asset('assets/imges/logo.png') }}" alt="Web House" class="img-fluid logo"></a>
            </div>
            <div class="col-6">
                <button class="btn btn-menu" id="nav-bar"><i class="fas fa-bars"></i></button>
                @if (Auth::guard('web')->user())
                <a href="{{ route('user_cart') }}" title="Cart" style="font-size: 0.78rem">
                    <span class="fa-stack fa-2x has-badge" data-count="{{ $user_cart_count }}">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                      </span>
                </a>
                <a href="{{-- {{ route('user_profile') }} --}}#" class="user-icon" title="User Profile">
                    <i class="fas fa-user-circle"></i>
                </a>
             
                {{-- <a href="#" class="cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"><span class="cart-count">0</span></i></a>  --}}
                @endif
            </div>
          </div>
        </div>
        <div class="nav-div" >
          <button class="btn btn-close" id="btn-close"></button>
            <div class="container">
              <div class="row">
                <div class="col-md-3">
                    <h2 class="text-nav">Web House</h2>
                    <ul>
                      <li><a href="/">Home</a></li>
                      <li><a href="{{ route('about_page') }}">About us</a></li>
                      <li><a href="{{ route('services_page') }}">Services</a></li>
                      <li><a href="{{ route('packages_page') }}">Package</a></li>
                      <li><a href="{{ route('contact_page') }}">Contact Us</a></li>
                      @if (!Auth::guard('web')->user())
                      <li><a href="{{ route('user.login_page') }}">Login In</a></li>
                      <li><a href="{{ route('user_register_page') }}">Register</a></li>
                      @else
                      <li>
                        <form action="{{ route('user.logout') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <button type="submit" class="btn btn-warning">Logout</button>
                        </form>
                    </li>
                      @endif
                    </ul>
                </div>
                <div class="col-md-3">
                  <h2 class="text-nav">Service</h2>
                  <ul >
                    <li><a href="{{ route('web_services') }}">Website design and development</a></li>
                    <li><a href="{{ route('ecommerce_services') }}">Ecommerce Website</a></li>
                    <li><a href="{{ route('cms_services') }}">CMS</a></li>
                    <li><a href="{{ route('digital_marketing') }}">Digital Marketing</a></li>
                    <li><a href="{{ route('influencer_marketing') }}">Influencer Marketing</a></li>
                    {{-- <li><a href="#">Advertising.</a></li> --}}
                    <li><a href="{{ route('mobile_app_development') }}">Mobile App Development</a></li>
                    <li><a href="{{ route('software_development') }}">Software development</a></li>
                    <li><a href="{{ route('it_consultant') }}">IT Consultant</a></li>
                  </ul>
                  <img src="{{ isset($menu->main_logo) ? asset($menu->main_logo) :  asset('assets/imges/logo.png') }}" alt="" class="img-fluid menu-logo1">
                </div>
                <div class="col-md-3">
                  <h2 class="text-nav">Corporate</h2>
                  <ul >
                    <li><a href="{{ route('industries_page') }}">Industries</a></li>
                    {{-- <li><a href="#">Case study</a></li> --}}
                    <li><a href="{{ route('portfolio_page') }}">Portfolio</a></li>
                    <li><a href="{{ route('contact_page') }}">Contact us</a></li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h2 class="text-nav">Branches</h2>
                  <ul >
                    <li><a href="#">Web House UK</a></li>
                    <li><a href="#">Web House Pakistan</a></li>
                    <li><a href="#">Web Hub Z</a></li>
                    <li><a href="#">WP Technologies</a></li>
                  </ul>
                </div>
              </div>
              <div class="row" >
                <div class="col-md-6">
                  <h2 class="text-nav">Contact us</h2>
                  <ul style="">
                    <li>
                      <i class="fas fa-phone-alt"></i> '
                      @if (isset($menu->contact_numbers))
                      {{ $menu->contact_numbers }}
                      @else
                      <a href="tel:+92 316 0568889">+92 316 0568889,</a><a href="tel:+92 336 4433245" >+92 336 4433245,</a><a href="tel:+447915639488"> +447915639488</a>    
                      @endif
                    </li>
                    <li>
                      <i class="fas fa-envelope"></i> <a href="mailto:{{ isset($menu->email) ? $menu->email : 'muhammad.umair0976@gmail.com' }}">{{ isset($menu->email) ? $menu->email : 'muhammad.umair0976@gmail.com' }}</a>
                    </li>
                    <li>
                      <i class="fas fa-map-marker"></i>
                      @if (isset($menu->email))
                      {{ $menu->email }}
                      @else
                      Web House International ltd. Kamp House ,<br>
                      <span class="ml-4"> 152 -160 City Road , London , EC1V 2 NX United kingdom.</span>
                      @endif
                    </li>
                  </ul>
                  <div class="row">
                    <div class="col-3"><img src="{{ isset($menu->logo_1) ? asset($menu->logo_1) : asset('assets/imges/logo.png') }}" alt="Web House" class="img-fluid menu-logo mt-3"></div>
                    <div class="col-3"><img src="{{ isset($menu->logo_2) ? asset($menu->logo_2) :  asset('assets/imges/logo2.png') }}" alt="Web House" class="img-fluid menu-logo mt-3"></div>
                    <div class="col-3"><img src="{{ isset($menu->logo_3) ? asset($menu->logo_3) :  asset('assets/imges/logo3.png') }}" alt="Web House" class="img-fluid menu-logo mt-3"></div>
                    <div class="col-3"><img src="{{ isset($menu->logo_4) ? asset($menu->logo_4) :  asset('assets/imges/logo4.png') }}" alt="Web House" class="img-fluid menu-logo mt-3"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <img src="{{ isset($menu->image) ? asset($menu->image) :  asset('assets/imges/Free_Mug_Mockup_2 copy.png') }}" alt="web House" class="img-fluid menu-footer-img">
                </div>
              </div>
            </div>
        </div>
      </div>
