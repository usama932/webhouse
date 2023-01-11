<?php

namespace App\Http\Controllers;

use App\Models\WebService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebServiceController extends Controller
{
    public function index()
    {
        $data['web_service'] = WebService::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'web_service';

        return view('web_service.index', $data);
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $web_service = WebService::first();
            if (!$web_service) {
                $web_service = new WebService();
            }
            
            $web_service->main_heading = $request->main_heading;
            $web_service->main_description = $request->main_description;
            $web_service->description_heading = $request->description_heading;
            $web_service->description_text = $request->description_text;

            $web_service->service_1_heading = $request->service_1_heading;
            $web_service->service_1_text = $request->service_1_text;

            $web_service->service_2_heading = $request->service_2_heading;            
            $web_service->service_2_text = $request->service_2_text;

            $web_service->service_3_heading = $request->service_3_heading;            
            $web_service->service_3_text = $request->service_3_text;

            $web_service->service_4_heading = $request->service_4_heading;            
            $web_service->service_4_text = $request->service_4_text;

            $web_service->service_5_heading = $request->service_5_heading;            
            $web_service->service_5_text = $request->service_5_text;

            $web_service->service_6_heading = $request->service_6_heading;            
            $web_service->service_6_text = $request->service_6_text;


            $imageName = 'images/web_service/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/web_service'), $imageName);
            $web_service->image = $imageName;

            $web_service->save();
            
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error'=>$e->getMessage()));
        }
    }
}
