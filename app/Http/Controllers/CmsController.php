<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsController extends Controller
{
    public function index()
    {
        $data['cms_service'] = CMS::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'cms_service';

        return view('cms_service.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $cms_service = CMS::first();
            if (!$cms_service) {
                $cms_service = new CMS();
            }

            $cms_service->main_heading = $request->main_heading;
            $cms_service->main_description = $request->main_description;
            $cms_service->description_heading = $request->description_heading;
            $cms_service->description_text = $request->description_text;

            $cms_service->service_1_heading = $request->service_1_heading;
            $cms_service->service_1_text = $request->service_1_text;

            $cms_service->service_2_heading = $request->service_2_heading;
            $cms_service->service_2_text = $request->service_2_text;

            $cms_service->service_3_heading = $request->service_3_heading;
            $cms_service->service_3_text = $request->service_3_text;

            $cms_service->service_4_heading = $request->service_4_heading;
            $cms_service->service_4_text = $request->service_4_text;

            $cms_service->service_5_heading = $request->service_5_heading;
            $cms_service->service_5_text = $request->service_5_text;

            $cms_service->service_6_heading = $request->service_6_heading;
            $cms_service->service_6_text = $request->service_6_text;

            if ($request->image) {
                $imageName = 'images/cms_service/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/cms_service'), $imageName);
                $cms_service->image = $imageName;
            }

            $cms_service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
