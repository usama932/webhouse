<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMediaSectionOne;
use App\Models\SocialMediaSectionTwo;
use App\Models\PackagePage;
use App\Models\Package;
use App\Models\IndustryPage;
use App\Models\Industry;
use App\Models\Portfolio;
use App\Models\PortfolioPage;
use App\Models\PortfolioTypes;
use App\Models\Services;

class FrontEndController extends Controller
{
    public function index()
    {
        $services = Services::all();
        return view('frontend.home', get_defined_vars());
    }
    public function about()
    {
        return view('frontend.aboutUs');
    }
    public function services()
    {   $services = Services::all();
        return view('frontend.services', get_defined_vars());
    }
    public function packages()
    {
        $package_page = PackagePage::first();
        $packages = Package::all();

        return view('frontend.packages', get_defined_vars());
    }
    public function contact()
    {
        return view('frontend.contactUs');
    }
    public function industries()
    {
        $industry_page = IndustryPage::first();
        $industries = Industry::all();

        return view('frontend.industries', get_defined_vars());
    }
    public function portfolio()
    {
        $portfolio_page = PortfolioPage::first();
        $portfolios = Portfolio::with('portfolio_type')->get();
        $portfolio_types = PortfolioTypes::all();
        return view('frontend.portfolio', get_defined_vars());
    }
    public function amazon()
    {
        return view('frontend.amazon');
    }
    public function serviceWeb()
    {
        return view('frontend.sevicesWeb');
    }
    public function servicesEcommerce(){
        return view('frontend.sevicesEcomm');
    }
    public function cms()
    {
        return view('frontend.sevicesContent');
    }

    public function influencer_marketing()
    {
        return view('frontend.influencer_marketing');
    }

    public function digital_marketing()
    {
        $services_one = SocialMediaSectionOne::all();
        $services_two = SocialMediaSectionTwo::all();
        $portfolios = Portfolio::with('portfolio_type')->get();
        $portfolio_types = PortfolioTypes::all();

        return view('frontend.services-marketing', get_defined_vars());
    }
    public function advertising()
    {
        return view('frontend.advertising');
    }
    public function mobile_app_development()
    {
        return view('frontend.sevicesMobile');
    }
    public function software_development()
    {
        return view('frontend.sevicesSoftwear');
    }
    public function it_consultant()
    {
        return view('frontend.sevicesIt');
    }
}
