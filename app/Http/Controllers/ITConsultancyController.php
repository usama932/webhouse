<?php

namespace App\Http\Controllers;

use App\Models\ITConsultancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ITConsultancyController extends Controller
{
    public function index()
    {
        $data['consultancy_service'] = ITConsultancy::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'consultancy_service';

        return view('consultancy_service.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $consultancy_service = ITConsultancy::first();
            if (!$consultancy_service) {
                $consultancy_service = new ITConsultancy();
            }

            $consultancy_service->main_heading = $request->main_heading;
            $consultancy_service->main_description = $request->main_description;
            $consultancy_service->description_heading = $request->description_heading;
            $consultancy_service->description_text = $request->description_text;

            $consultancy_service->service_1_heading = $request->service_1_heading;
            $consultancy_service->service_1_text = $request->service_1_text;

            $consultancy_service->service_2_heading = $request->service_2_heading;
            $consultancy_service->service_2_text = $request->service_2_text;

            $consultancy_service->service_3_heading = $request->service_3_heading;
            $consultancy_service->service_3_text = $request->service_3_text;

            $consultancy_service->service_4_heading = $request->service_4_heading;
            $consultancy_service->service_4_text = $request->service_4_text;

            $consultancy_service->service_5_heading = $request->service_5_heading;
            $consultancy_service->service_5_text = $request->service_5_text;

            $consultancy_service->service_6_heading = $request->service_6_heading;
            $consultancy_service->service_6_text = $request->service_6_text;

            if ($request->image) {
                $imageName = 'images/consultancy_service/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/consultancy_service'), $imageName);
                $consultancy_service->image = $imageName;
            }

            $consultancy_service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
