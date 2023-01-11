<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo" /> <span
                    class="logo-name">Web House</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown  <?= $main_menu == 'dashboard' ? 'active' : '' ?>">
                <a href="{{ route('dashboard') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            <li class="dropdown <?= $main_menu == 'Home' ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Home</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= $sub_menu == 'slider' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('slider') }}">Slider</a></li>
                    <li class="<?= $sub_menu == 'aboutus' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('aboutUs') }}">About Us</a></li>
                    <li class="<?= $sub_menu == 'packages' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('home_package') }}">Packages</a></li>

                </ul>
            </li>
            <li class="dropdown  <?= $main_menu == 'about_page' ? 'active' : '' ?>">
                <a href="{{ route('admin_about_page') }}" class="nav-link"><i data-feather="monitor"></i><span>About
                        Page</span></a>
            </li>
            <li class="dropdown  <?= $main_menu == 'menu' ? 'active' : '' ?>">
                <a href="{{ route('admin_menu') }}" class="nav-link"><i data-feather="monitor"></i><span>Menu</span></a>
            </li>
            <li class="dropdown  <?= $main_menu == 'footer' ? 'active' : '' ?>">
                <a href="{{ route('admin_footer') }}" class="nav-link"><i data-feather="monitor"></i><span>Footer</span></a>
            </li>

            <li class="dropdown  <?= $main_menu == 'general_settings' ? 'active' : '' ?>">
                <a href="{{ route('admin_general_settings') }}" class="nav-link"><i data-feather="monitor"></i><span>General Settings</span></a>
            </li>           

            <li class="dropdown <?= $main_menu == 'contact_page' ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Contact Page</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= $sub_menu == 'contact_page' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_contact_page') }}">Contact Page</a></li>
                    {{-- <li class="<?= $sub_menu == 'contact_fields' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_contact_fields') }}">Contact Fields</a></li> --}}
                    
                </ul>
            </li>
            <li class="dropdown <?= $main_menu == 'package_page' ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Package Page</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown  <?= $sub_menu == 'package_page' ? 'active' : '' ?>">
                        <a href="{{ route('admin_package_page') }}" class="nav-link"><span>Package
                                Page</span></a>
                    </li>
                    <li class="<?= $sub_menu == 'package_type' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_package_types') }}">Package Types</a></li>
                    <li class="<?= $sub_menu == 'packages' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_packages') }}">Packages</a></li>
                    
                </ul>
            </li>
            <li class="dropdown <?= $main_menu == 'portfolio_page' ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Portfolio</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown  <?= $sub_menu == 'portfolio_page' ? 'active' : '' ?>">
                        <a href="{{ route('admin_portfolio_page') }}" class="nav-link"><span>Portfolio
                                Page</span></a>
                    </li>
                    <li class="<?= $sub_menu == 'portfolio_types' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_portfolio_types') }}">Portfolio Types</a></li>
                    <li class="<?= $sub_menu == 'portfolio' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_portfolio') }}">Portfolios</a></li>
                    
                </ul>
            </li>
            <li class="dropdown <?= $main_menu == 'service_page' ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Services Page</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown  <?= $sub_menu == 'service_page' ? 'active' : '' ?>">
                        <a href="{{ route('admin_service_page') }}" class="nav-link"><span>Services
                                Page</span></a>
                    </li>
                    <li class="<?= $sub_menu == 'services' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_services') }}">Services</a></li>

                    <li class="<?= $sub_menu == 'web_service' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_web_service') }}">Web development</a></li>
                    <li class="<?= $sub_menu == 'ecommerce_service' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_ecommerce_service') }}">Ecommerce development</a></li>
                    <li class="<?= $sub_menu == 'cms_service' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_cms_service') }}">CMS development</a></li>
                    <li class="<?= $sub_menu == 'mobile_service' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_mobile_service') }}">Mobile app development</a></li>
                    <li class="<?= $sub_menu == 'software_service' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_software_service') }}">Software development</a></li>
                    <li class="<?= $sub_menu == 'consultancy_service' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_consultancy_service') }}">IT consultancy</a></li>
                    <li class="<?= $sub_menu == 'influencer_service' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_influencer_service') }}">Influencer Marketing</a></li>
                    
                </ul>
            </li>
            <li class="dropdown <?= $main_menu == 'digital_marketing_page' ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Digital Marketing Service</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown  <?= $sub_menu == 'digital_marketing_page' ? 'active' : '' ?>">
                        <a href="{{ route('admin_digital_marketing_page') }}" class="nav-link"><span>Digital Marketing Page</span></a>
                    </li>
                    <li class="<?= $sub_menu == 'social_media_section_one' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_social_media_section_one') }}">Social Media Section One</a></li>
                    <li class="<?= $sub_menu == 'social_media_section_two' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_social_media_section_two') }}">Social Media Section Two</a></li>
                    
                </ul>
            </li>
            <li class="dropdown <?= $main_menu == 'industry_page' ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Industry Page</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown  <?= $sub_menu == 'industry_page' ? 'active' : '' ?>">
                        <a href="{{ route('admin_industry_page') }}" class="nav-link"><span>Industry
                                Page</span></a>
                    </li>
                    <li class="<?= $sub_menu == 'industries' ? 'active' : '' ?>"><a class="nav-link"
                            href="{{ route('admin_industries') }}">Industries</a></li>
                    
                </ul>
            </li>
            <li class="dropdown  <?= $main_menu == 'enquiries' ? 'active' : '' ?>">
                <a href="{{ route('admin_enquiries') }}" class="nav-link"><i data-feather="monitor"></i><span>Enquiries</span></a>
            </li>
            

        </ul>
    </aside>
</div>
