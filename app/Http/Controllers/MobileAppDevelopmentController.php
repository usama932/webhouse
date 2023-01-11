<?php

namespace App\Http\Controllers;

use App\Models\MobileAppDevelopment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobileAppDevelopmentController extends Controller
{
    public function index()
    {
        $data['mobile_service'] = MobileAppDevelopment::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'mobile_service';

        return view('mobile_service.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $mobile_service = MobileAppDevelopment::first();
            if (!$mobile_service) {
                $mobile_service = new MobileAppDevelopment();
            }

            $mobile_service->main_heading = $request->main_heading;
            $mobile_service->main_description = $request->main_description;
            $mobile_service->description_heading = $request->description_heading;
            $mobile_service->description_text = $request->description_text;

            $mobile_service->service_1_heading = $request->service_1_heading;
            $mobile_service->service_1_text = $request->service_1_text;

            $mobile_service->service_2_heading = $request->service_2_heading;
            $mobile_service->service_2_text = $request->service_2_text;

            $mobile_service->service_3_heading = $request->service_3_heading;
            $mobile_service->service_3_text = $request->service_3_text;

            $mobile_service->service_4_heading = $request->service_4_heading;
            $mobile_service->service_4_text = $request->service_4_text;

            $mobile_service->service_5_heading = $request->service_5_heading;
            $mobile_service->service_5_text = $request->service_5_text;

            $mobile_service->service_6_heading = $request->service_6_heading;
            $mobile_service->service_6_text = $request->service_6_text;

            if ($request->image) {
                $imageName = 'images/mobile_service/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/mobile_service'), $imageName);
                $mobile_service->image = $imageName;
            }

            $mobile_service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
