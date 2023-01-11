<?php

namespace App\Http\Controllers;

use App\Models\SoftwareDevelopment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoftwareDevelopmentController extends Controller
{
    public function index()
    {
        $data['software_service'] = SoftwareDevelopment::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'software_service';

        return view('software_service.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $software_service = SoftwareDevelopment::first();
            if (!$software_service) {
                $software_service = new SoftwareDevelopment();
            }

            $software_service->main_heading = $request->main_heading;
            $software_service->main_description = $request->main_description;
            $software_service->description_heading = $request->description_heading;
            $software_service->description_text = $request->description_text;

            $software_service->service_1_heading = $request->service_1_heading;
            $software_service->service_1_text = $request->service_1_text;

            $software_service->service_2_heading = $request->service_2_heading;
            $software_service->service_2_text = $request->service_2_text;

            $software_service->service_3_heading = $request->service_3_heading;
            $software_service->service_3_text = $request->service_3_text;

            $software_service->service_4_heading = $request->service_4_heading;
            $software_service->service_4_text = $request->service_4_text;

            $software_service->service_5_heading = $request->service_5_heading;
            $software_service->service_5_text = $request->service_5_text;

            $software_service->service_6_heading = $request->service_6_heading;
            $software_service->service_6_text = $request->service_6_text;

            if ($request->image) {
                $imageName = 'images/software_service/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/software_service'), $imageName);
                $software_service->image = $imageName;
            }

            $software_service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
