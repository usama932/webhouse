<?php

namespace App\Http\Controllers;

use App\Models\EcommerceDevelopment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcommerceDevelopmentController extends Controller
{
    public function index()
    {
        $data['ecommerce_service'] = EcommerceDevelopment::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'ecommerce_service';

        return view('ecommerce_service.index', $data);
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $ecommerce_service = EcommerceDevelopment::first();
            if (!$ecommerce_service) {
                $ecommerce_service = new EcommerceDevelopment();
            }
            
            $ecommerce_service->main_heading = $request->main_heading;
            $ecommerce_service->main_description = $request->main_description;
            $ecommerce_service->description_heading = $request->description_heading;
            $ecommerce_service->description_text = $request->description_text;

            $ecommerce_service->service_1_heading = $request->service_1_heading;
            $ecommerce_service->service_1_text = $request->service_1_text;

            $ecommerce_service->service_2_heading = $request->service_2_heading;            
            $ecommerce_service->service_2_text = $request->service_2_text;

            $ecommerce_service->service_3_heading = $request->service_3_heading;            
            $ecommerce_service->service_3_text = $request->service_3_text;

            $ecommerce_service->service_4_heading = $request->service_4_heading;            
            $ecommerce_service->service_4_text = $request->service_4_text;

            $ecommerce_service->service_5_heading = $request->service_5_heading;            
            $ecommerce_service->service_5_text = $request->service_5_text;

            $ecommerce_service->service_6_heading = $request->service_6_heading;            
            $ecommerce_service->service_6_text = $request->service_6_text;


            $imageName = 'images/ecommerce_service/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/ecommerce_service'), $imageName);
            $ecommerce_service->image = $imageName;

            $ecommerce_service->save();
            
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error'=>$e->getMessage()));
        }
    }
}
