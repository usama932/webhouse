<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $data['menu'] = Menu::first();
        $data['main_menu'] = 'menu';
        $data['sub_menu'] = '';

        return view('menu.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = Menu::first();
            if (!$menu) {
                $menu = new Menu();
            }
            
            // $menu->bg_color = $request->bg_color;
            // $menu->heading_color = $request->heading_color;
            // $menu->text_color = $request->text_color;
            $menu->contact_numbers = $request->contact_numbers;
            $menu->email = $request->email;
            $menu->address = $request->address;

            $imageName = 'images/menu/' . time() . '.' . $request->main_logo->extension();
            $request->main_logo->move(public_path('images/menu'), $imageName);
            $menu->main_logo = $imageName;

            $imageName = 'images/menu/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $menu->image = $imageName;

            $imageName = 'images/menu/' . time() . '.' . $request->logo_1->extension();
            $request->logo_1->move(public_path('images/menu'), $imageName);
            $menu->logo_1 = $imageName;

            $imageName = 'images/menu/' . time() . '.' . $request->logo_2->extension();
            $request->logo_2->move(public_path('images/menu'), $imageName);
            $menu->logo_2 = $imageName;

            $imageName = 'images/menu/' . time() . '.' . $request->logo_3->extension();
            $request->logo_3->move(public_path('images/menu'), $imageName);
            $menu->logo_3 = $imageName;

            $imageName = 'images/menu/' . time() . '.' . $request->logo_4->extension();
            $request->logo_4->move(public_path('images/menu'), $imageName);
            $menu->logo_4 = $imageName;

            $menu->save();
            
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error'=>$e->getMessage()));
        }
    }
}
