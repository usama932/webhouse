<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutPageController extends Controller
{
     

    public function index()
    {
        $data['about'] = AboutPage::first();
        $data['main_menu'] = 'about_page';
        $data['sub_menu'] = '';

        return view('about.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $about = AboutPage::first();
            if (!$about) {
                $about = new AboutPage();
            }
            $about->about_heading_one = $request->about_heading_one;
            $about->about_heading_two = $request->about_heading_two;
            $about->about_content = $request->about_content;
            $imageName = 'images/about_page/' . time() . '.' . $request->about_image->extension();
            $request->about_image->move(public_path('images/about_page'), $imageName);
            $about->about_image = $imageName;
            $about->mission_heading = $request->mission_heading;
            $about->mission_content = $request->mission_content;
            $imageName = 'images/about_page/' . time() . '.' . $request->mission_image->extension();
            $request->mission_image->move(public_path('images/about_page'), $imageName);
            $about->mission_image = $imageName;
            $about->vision_heading = $request->vision_heading;
            $about->vision_content = $request->vision_content;
            $imageName = 'images/about_page/' . time() . '.' . $request->vision_image->extension();
            $request->vision_image->move(public_path('images/about_page'), $imageName);
            $about->vision_image = $imageName;
            $about->save();
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }
}