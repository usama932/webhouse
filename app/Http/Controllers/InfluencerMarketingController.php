<?php

namespace App\Http\Controllers;

use App\Models\InfluencerMarketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfluencerMarketingController extends Controller
{
    public function index()
    {
        $data['influencer_service'] = InfluencerMarketing::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'influencer_service';

        return view('influencer_service.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $influencer_service = InfluencerMarketing::first();
            if (!$influencer_service) {
                $influencer_service = new InfluencerMarketing();
            }

            $influencer_service->main_heading_1 = $request->main_heading_1;
            $influencer_service->main_heading_2 = $request->main_heading_2;
            $influencer_service->main_description = $request->main_description;

            $influencer_service->service_1_heading = $request->service_1_heading;
            $influencer_service->service_1_text = $request->service_1_text;

            $influencer_service->service_2_heading = $request->service_2_heading;
            $influencer_service->service_2_text = $request->service_2_text;

            $influencer_service->service_3_heading = $request->service_3_heading;
            $influencer_service->service_3_text = $request->service_3_text;

            $influencer_service->service_4_heading = $request->service_4_heading;
            $influencer_service->service_4_text = $request->service_4_text;

            $influencer_service->service_5_heading = $request->service_5_heading;
            $influencer_service->service_5_text = $request->service_5_text;

            $influencer_service->service_6_heading = $request->service_6_heading;
            $influencer_service->service_6_text = $request->service_6_text;

            if ($request->image) {
                $imageName = 'images/influencer_service/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/influencer_service'), $imageName);
                $influencer_service->image = $imageName;
            }
            if ($request->influencer_image) {
                $imageName = 'images/influencer_service/' . time() . '.' . $request->influencer_image->extension();
                $request->influencer_image->move(public_path('images/influencer_service'), $imageName);
                $influencer_service->influencer_image = $imageName;
            }

            $influencer_service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
