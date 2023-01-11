<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterController extends Controller
{
    public function index()
    {
        $data['footer'] = Footer::first();
        $data['main_menu'] = 'footer';
        $data['sub_menu'] = '';

        return view('footer.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $footer = Footer::first();
            if (!$footer) {
                $footer = new Footer();
            }
            
            $footer->fb_link = $request->fb_link;
            $footer->insta_link = $request->insta_link;
            $footer->tw_link = $request->tw_link;
            $footer->li_link = $request->li_link;
            $footer->contact_numbers = $request->contact_numbers;
            $footer->email = $request->email;
            $footer->address = $request->address;
            $footer->copyright_text = $request->copyright_text;

            $imageName = 'images/footer/' . time() . '.' . $request->main_logo->extension();
            $request->main_logo->move(public_path('images/footer'), $imageName);
            $footer->main_logo = $imageName;

            $imageName = 'images/footer/' . time() . '.' . $request->bg_image->extension();
            $request->bg_image->move(public_path('images/footer'), $imageName);
            $footer->bg_image = $imageName;

            $imageName = 'images/footer/' . time() . '.' . $request->logo_1->extension();
            $request->logo_1->move(public_path('images/footer'), $imageName);
            $footer->logo_1 = $imageName;

            $imageName = 'images/footer/' . time() . '.' . $request->logo_2->extension();
            $request->logo_2->move(public_path('images/footer'), $imageName);
            $footer->logo_2 = $imageName;

            $imageName = 'images/footer/' . time() . '.' . $request->logo_3->extension();
            $request->logo_3->move(public_path('images/footer'), $imageName);
            $footer->logo_3 = $imageName;

            $imageName = 'images/footer/' . time() . '.' . $request->logo_4->extension();
            $request->logo_4->move(public_path('images/footer'), $imageName);
            $footer->logo_4 = $imageName;

            $footer->save();
            
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error'=>$e->getMessage()));
        }
    }
}
