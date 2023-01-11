<?php

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\EcommerceDevelopmentController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndustryPageController;
use App\Http\Controllers\InfluencerMarketingController;
use App\Http\Controllers\DigitalMarketingController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ITConsultancyController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MobileAppDevelopmentController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServicePageController;
use App\Http\Controllers\SoftwareDevelopmentController;
use App\Http\Controllers\UserCartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [FrontEndController::class, 'index'])->name('main_web');
Route::get('/about', [FrontEndController::class, 'about'])->name('about_page');
Route::get('/packages', [FrontEndController::class, 'packages'])->name('packages_page');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('contact_page');
Route::get('/industries', [FrontEndController::class, 'industries'])->name('industries_page');
Route::get('/portfolio', [FrontEndController::class, 'portfolio'])->name('portfolio_page');
Route::get('/amazon', [FrontEndController::class, 'amazon'])->name('amazon_page');

Route::post('send_enquiry', [EnquiryController::class, 'send_enquiry'])->name('send_enquiry');

Route::group(['prefix' => 'services'], function () {
    Route::get('/', [FrontEndController::class, 'services'])->name('services_page');
    Route::get('/web_development', [FrontEndController::class, 'serviceWeb'])->name('web_services');
    Route::get('/ecommerce', [FrontEndController::class, 'servicesEcommerce'])->name('ecommerce_services');
    Route::get('/cms', [FrontEndController::class, 'cms'])->name('cms_services');
    Route::get('/influencer_marketing', [FrontEndController::class, 'influencer_marketing'])->name('influencer_marketing');
    Route::get('/digital_marketing', [FrontEndController::class, 'digital_marketing'])->name('digital_marketing');
    Route::get('/advertising', [FrontEndController::class, 'advertising'])->name('advertising');
    Route::get('/mobile_app_development', [FrontEndController::class, 'mobile_app_development'])->name('mobile_app_development');
    Route::get('/software_development', [FrontEndController::class, 'software_development'])->name('software_development');
    Route::get('/it_consultant', [FrontEndController::class, 'it_consultant'])->name('it_consultant');
});

Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.index');

Route::post('admin/signin', [AdminController::class, 'login'])->name('admin.login');

Route::group(['middleware' => ['auth.admin']], function () {
Route::group(['prefix' => 'admin'], function () {
    
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/slider', [HomeController::class, 'slider'])->name('slider');
    Route::POST('/addSlider', [HomeController::class, 'addSlider'])->name('addSlider');
    Route::get('/status/{id?}', [HomeController::class, 'status'])->name('status');
    Route::get('/sliderEdit/{id?}', [HomeController::class, 'edit'])->name('sliderEdit');
    Route::POST('/deleteslider/{id?}', [HomeController::class, 'deleteslider'])->name('deleteslider');
    Route::get('/aboutUs', [HomeController::class, 'about'])->name('aboutUs');
    Route::post('/update_about', [HomeController::class, 'update_about'])->name('update_about');
    Route::get('/home/package', [HomeController::class, 'home_package'])->name('home_package');
    Route::post('/home/update_package', [HomeController::class, 'update_home_package'])->name('update_home_package');

    Route::get('/about_page', [AboutPageController::class, 'index'])->name('admin_about_page');
    Route::post('/update_about_page', [AboutPageController::class, 'update'])->name('update_admin_about_page');

    Route::get('/general_settings', [GeneralSettingController::class, 'index'])->name('admin_general_settings');
    Route::post('/update_general_settings', [GeneralSettingController::class, 'update'])->name('update_admin_general_settings');

    Route::get('/service_page', [ServicePageController::class, 'index'])->name('admin_service_page');
    Route::post('/update_service_page', [ServicePageController::class, 'update'])->name('update_admin_service_page');
    Route::get('/service_page/services', [ServicePageController::class, 'services'])->name('admin_services');
    Route::get('/service_page/services/create', [ServicePageController::class, 'add_service'])->name('admin_add_service');
    Route::post('/service_page/services/store', [ServicePageController::class, 'store_service'])->name('admin_store_service');
    Route::get('/service_page/services/edit/{id}', [ServicePageController::class, 'edit_service'])->name('admin_edit_service');
    Route::post('/service_page/services/update', [ServicePageController::class, 'update_service'])->name('admin_update_service');

    Route::get('/package_page', [PackageController::class, 'index'])->name('admin_package_page');
    Route::post('/update_package_page', [PackageController::class, 'update'])->name('update_admin_package_page');
    Route::get('/package_page/package_types', [PackageController::class, 'package_types'])->name('admin_package_types');
    Route::get('/package_page/package_types/create', [PackageController::class, 'add_package_type'])->name('admin_add_package_type');
    Route::post('/package_page/package_types/store', [PackageController::class, 'store_package_type'])->name('admin_store_package_type');
    Route::get('/package_page/package_types/edit/{id}', [PackageController::class, 'edit_package_type'])->name('admin_edit_package_type');
    Route::post('/package_page/package_types/update', [PackageController::class, 'update_package_type'])->name('admin_update_package_type');
    Route::get('/package_page/packages', [PackageController::class, 'packages'])->name('admin_packages');
    Route::get('/package_page/packages/create', [PackageController::class, 'add_package'])->name('admin_add_package');
    Route::post('/package_page/packages/store', [PackageController::class, 'store_package'])->name('admin_store_package');
    Route::get('/package_page/packages/edit/{id}', [PackageController::class, 'edit_package'])->name('admin_edit_package');
    Route::post('/package_page/packages/update', [PackageController::class, 'update_package'])->name('admin_update_package');
    Route::delete('/package_page/packages/delete', [PackageController::class, 'delete_package'])->name('admin_delete_package');
    
    
    Route::get('/portfolio_page', [PortfolioController::class, 'index'])->name('admin_portfolio_page');
    Route::post('/update_portfolio_page', [PortfolioController::class, 'update'])->name('update_admin_portfolio_page');
    Route::get('/portfolio_types', [PortfolioController::class, 'portfolio_types'])->name('admin_portfolio_types');
    Route::get('portfolio_types/create', [PortfolioController::class, 'add_portfolio_type'])->name('admin_add_portfolio_type');
    Route::post('portfolio_types/store', [PortfolioController::class, 'store_portfolio_type'])->name('admin_store_portfolio_type');
    Route::get('portfolio_types/edit/{id}', [PortfolioController::class, 'edit_portfolio_type'])->name('admin_edit_portfolio_type');
    Route::post('portfolio_types/update', [PortfolioController::class, 'update_portfolio_type'])->name('admin_update_portfolio_type');
    Route::get('/portfolios', [PortfolioController::class, 'portfolios'])->name('admin_portfolio');
    Route::get('portfolios/create', [PortfolioController::class, 'add_portfolio'])->name('admin_add_portfolio');
    Route::post('portfolios/store', [PortfolioController::class, 'store_portfolio'])->name('admin_store_portfolio');
    Route::get('portfolios/edit/{id}', [PortfolioController::class, 'edit_portfolio'])->name('admin_edit_portfolio');
    Route::post('portfolios/update', [PortfolioController::class, 'update_portfolio'])->name('admin_update_portfolio');
    Route::delete('/portfolio/delete', [PortfolioController::class, 'delete_portfolio'])->name('admin_delete_portfolio');

    Route::get('/contact_page', [ContactPageController::class, 'index'])->name('admin_contact_page');
    Route::post('/update_contact_page', [ContactPageController::class, 'update'])->name('update_admin_contact_page');
    
    Route::get('/contact_page/contact_fields', [ContactPageController::class, 'contact_fields'])->name('admin_contact_fields');
    Route::get('/contact_page/contact_fields/create', [ContactPageController::class, 'add_contact_field'])->name('add_admin_contact_field');
    Route::post('/contact_page/contact_fields/store', [ContactPageController::class, 'store_contact_field'])->name('store_admin_contact_field');
    Route::get('/contact_page/contact_fields/edit/{id}', [ContactPageController::class, 'edit_contact_field'])->name('edit_admin_contact_field');
    Route::post('/contact_page/contact_fields/update', [ContactPageController::class, 'update_contact_field'])->name('update_admin_contact_field');

    Route::get('/industry_page', [IndustryPageController::class, 'index'])->name('admin_industry_page');
    Route::post('/update_industry_page', [IndustryPageController::class, 'update'])->name('update_admin_industry_page');
    Route::get('/industry_page/industries', [IndustryPageController::class, 'industries'])->name('admin_industries');
    Route::get('/industry_page/industries/create', [IndustryPageController::class, 'add_industry'])->name('admin_add_industry');
    Route::post('/industry_page/industries/store', [IndustryPageController::class, 'store_industry'])->name('admin_store_industry');
    Route::get('/industry_page/industries/edit/{id}', [IndustryPageController::class, 'edit_industry'])->name('admin_edit_industry');
    Route::post('/industry_page/industries/update', [IndustryPageController::class, 'update_industry'])->name('admin_update_industry');

    Route::get('menu', [MenuController::class, 'index'])->name('admin_menu');
    Route::post('/update_menu', [MenuController::class, 'update'])->name('update_admin_menu');
    
    Route::get('footer', [FooterController::class, 'index'])->name('admin_footer');
    Route::post('/update_footer', [FooterController::class, 'update'])->name('update_admin_footer');
    
    Route::get('web_service', [WebServiceController::class, 'index'])->name('admin_web_service');
    Route::post('/update_admin_web_service', [WebServiceController::class, 'update'])->name('update_admin_web_service');

    Route::get('ecommerce_service', [EcommerceDevelopmentController::class, 'index'])->name('admin_ecommerce_service');
    Route::post('/update_admin_ecommerce_service', [EcommerceDevelopmentController::class, 'update'])->name('update_admin_ecommerce_service');

    Route::get('cms_service', [CmsController::class, 'index'])->name('admin_cms_service');
    Route::post('/update_admin_cms_service', [CmsController::class, 'update'])->name('update_admin_cms_service');
    
    Route::get('mobile_service', [MobileAppDevelopmentController::class, 'index'])->name('admin_mobile_service');
    Route::post('/update_admin_mobile_service', [MobileAppDevelopmentController::class, 'update'])->name('update_admin_mobile_service');
    
    Route::get('software_service', [SoftwareDevelopmentController::class, 'index'])->name('admin_software_service');
    Route::post('/update_admin_software_service', [SoftwareDevelopmentController::class, 'update'])->name('update_admin_software_service');

    Route::get('consultancy_service', [ITConsultancyController::class, 'index'])->name('admin_consultancy_service');
    Route::post('/update_admin_consultancy_service', [ITConsultancyController::class, 'update'])->name('update_admin_consultancy_service');
    
    Route::get('influencer_service', [InfluencerMarketingController::class, 'index'])->name('admin_influencer_service');
    Route::post('/update_admin_influencer_service', [InfluencerMarketingController::class, 'update'])->name('update_admin_influencer_service');
    
    Route::get('digital_marketing_service', [DigitalMarketingController::class, 'index'])->name('admin_digital_marketing_page');
    Route::post('/update_admin_digital_marketing_service', [DigitalMarketingController::class, 'update'])->name('update_admin_digital_marketing_service');
    
    Route::get('social_media_section_one', [DigitalMarketingController::class, 'section_one_services'])->name('admin_social_media_section_one');
    Route::get('add_marketing_service_one', [DigitalMarketingController::class, 'add_marketing_service_one'])->name('admin_add_social_media_section_one');
    Route::post('store_marketing_service_one', [DigitalMarketingController::class, 'store_marketing_service_one'])->name('admin_store_social_media_section_one');
    Route::get('edit_marketing_service_one/{id}', [DigitalMarketingController::class, 'edit_marketing_service_one'])->name('admin_edit_social_media_section_one');
    Route::post('update_marketing_service_one', [DigitalMarketingController::class, 'update_marketing_service_one'])->name('admin_update_social_media_section_one');
    Route::delete('delete_marketing_service_one', [DigitalMarketingController::class, 'delete_marketing_service_one'])->name('admin_delete_social_media_section_one');

    Route::get('social_media_section_two', [DigitalMarketingController::class, 'section_two_services'])->name('admin_social_media_section_two');
    Route::get('add_marketing_service_two', [DigitalMarketingController::class, 'add_marketing_service_two'])->name('admin_add_social_media_section_two');
    Route::post('store_marketing_service_two', [DigitalMarketingController::class, 'store_marketing_service_two'])->name('admin_store_social_media_section_two');
    Route::get('edit_marketing_service_two/{id}', [DigitalMarketingController::class, 'edit_marketing_service_two'])->name('admin_edit_social_media_section_two');
    Route::post('update_marketing_service_two', [DigitalMarketingController::class, 'update_marketing_service_two'])->name('admin_update_social_media_section_two');
    Route::delete('delete_marketing_service_two', [DigitalMarketingController::class, 'delete_marketing_service_two'])->name('admin_delete_social_media_section_two');

    Route::get('user_enquiries', [EnquiryController::class, 'user_enquiries'])->name('admin_enquiries');

});

});
Route::get('/user/login', [UserController::class, 'user_login'])->name('user.login_page');

Route::post('/user/signin', [UserController::class, 'login'])->name('user.login');

Route::get('/user/register', [UserController::class, 'register_page'])->name('user_register_page');

Route::post('/user/signup', [UserController::class, 'register'])->name('user_register');

Route::group(['middleware' => ['auth.user']], function () {
Route::group(['prefix' => 'user'], function () {
    
    Route::get('/profile', [UserCartController::class, 'profile'])->name('user_profile');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/cart', [UserCartController::class, 'index'])->name('user_cart');
    Route::post('/add_to_cart_package', [UserCartController::class, 'add_to_cart_package'])->name('add_to_cart_package');
    Route::delete('/delete_from_cart', [UserCartController::class, 'delete_from_cart'])->name('delete_from_cart');
   
});

});