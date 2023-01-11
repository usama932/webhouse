<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralSettingController extends Controller
{
     

    public function index()
    {
        $data['general_settings'] = GeneralSetting::first();
        $data['main_menu'] = 'general_settings';
        $data['sub_menu'] = 'general_settings';

        return view('general_settings.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $general_setting = GeneralSetting::first();
            if (!$general_setting) {
                $general_setting = new GeneralSetting();
            }
            
            $general_setting->bg_color = $request->bg_color;
            $general_setting->heading_color = $request->heading_color;
            $general_setting->text_color = $request->text_color;

            $general_setting->save();
            
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }
}
