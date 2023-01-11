<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigitalMarketing;
use App\Models\SocialMediaSectionOne;
use App\Models\SocialMediaSectionTwo;
use Illuminate\Support\Facades\DB;

class DigitalMarketingController extends Controller
{
    public function index()
    {
        $data['digital_marketing_service'] = DigitalMarketing::first();
        $data['main_menu'] = 'digital_marketing_page';
        $data['sub_menu'] = 'digital_marketing_page';

        return view('digital_marketing_service.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $digital_marketing_service = DigitalMarketing::first();
            if (!$digital_marketing_service) {
                $digital_marketing_service = new DigitalMarketing();
            }

            $digital_marketing_service->main_heading = $request->main_heading;
            $digital_marketing_service->main_description = $request->main_description;

            $digital_marketing_service->service_description_heading = $request->service_description_heading;
            $digital_marketing_service->service_description = $request->service_description;

            $digital_marketing_service->portfolio_heading = $request->portfolio_heading;
            $digital_marketing_service->portfolio_text = $request->portfolio_text;

            $digital_marketing_service->custom_service_heading = $request->custom_service_heading;
            $digital_marketing_service->custom_service_text = $request->custom_service_text;

            $digital_marketing_service->social_media_services_heading = $request->social_media_services_heading;
        

            if ($request->main_image) {
                $imageName = 'images/digital_marketing_service/' . time() . '.' . $request->main_image->extension();
                $request->main_image->move(public_path('images/digital_marketing_service'), $imageName);
                $digital_marketing_service->main_image = $imageName;
            }
            if ($request->service_image) {
                $imageName = 'images/digital_marketing_service/' . time() . '.' . $request->service_image->extension();
                $request->service_image->move(public_path('images/digital_marketing_service'), $imageName);
                $digital_marketing_service->service_image = $imageName;
            }

            $digital_marketing_service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function section_one_services()
    {
        $data['marketing'] = SocialMediaSectionOne::all();
        $data['main_menu'] = 'digital_marketing_page';
        $data['sub_menu'] = 'social_media_section_one';

        return view('socialMediaSectionOne.index', $data);
    }

    public function add_marketing_service_one(Request $request)
    {
        $data['main_menu'] = 'digital_marketing_page';
        $data['sub_menu'] = 'social_media_section_one';

        return view('socialMediaSectionOne.add', $data);
    }
   

    public function store_marketing_service_one(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = new SocialMediaSectionOne();
            $service->name = $request->name;
            $service->description = $request->description;

            $imageName = 'images/digital_marketing_service/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/digital_marketing_service'), $imageName);
            $service->image = $imageName;

            $service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function edit_marketing_service_one($id)
    {
        $data['service'] = SocialMediaSectionOne::find($id);
        $data['main_menu'] = 'digital_marketing_page';
        $data['sub_menu'] = 'social_media_section_one';

        return view('socialMediaSectionOne.edit', $data);
    }

    public function update_marketing_service_one(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = SocialMediaSectionOne::find($request->id);
            $service->name = $request->name;
            $service->description = $request->description;

            $imageName = 'images/digital_marketing_service/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/digital_marketing_service'), $imageName);
            $service->image = $imageName;

            $service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function delete_marketing_service_one(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = SocialMediaSectionOne::find($request->id);
            
            $service->delete();

            set_alert('success', 'Information has been deleted successfully');
            DB::commit();
            return redirect()->route('admin_social_media_section_one');
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
    public function section_two_services()
    {
        $data['marketing'] = SocialMediaSectionTwo::all();
        $data['main_menu'] = 'digital_marketing_page';
        $data['sub_menu'] = 'social_media_section_one';

        return view('socialMediaSectionTwo.index', $data);
    }

    
    public function add_marketing_service_two(Request $request)
    {
        $data['main_menu'] = 'digital_marketing_page';
        $data['sub_menu'] = 'social_media_section_two';

        return view('socialMediaSectionTwo.add', $data);
    }

    public function store_marketing_service_two(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = new SocialMediaSectionTwo();
            $service->name = $request->name;
            $service->description = $request->description;
            
            $imageName = 'images/digital_marketing_service/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/digital_marketing_service'), $imageName);
            $service->image = $imageName;

            $service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
    public function edit_marketing_service_two($id)
    {
        $data['service'] = SocialMediaSectionTwo::find($id);
        $data['main_menu'] = 'digital_marketing_page';
        $data['sub_menu'] = 'social_media_section_two';

        return view('socialMediaSectionTwo.edit', $data);
    }


    public function update_marketing_service_two(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = SocialMediaSectionTwo::find($request->id);
            $service->name = $request->name;
            $service->description = $request->description;

            $imageName = 'images/digital_marketing_service/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/digital_marketing_service'), $imageName);
            $service->image = $imageName;

            $service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function delete_marketing_service_two(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = SocialMediaSectionTwo::find($request->id);
            
            $service->delete();

            set_alert('success', 'Information has been deleted successfully');
            DB::commit();
            return redirect()->route('admin_social_media_section_two');
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
