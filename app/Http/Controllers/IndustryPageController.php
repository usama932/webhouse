<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\IndustryPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndustryPageController extends Controller
{
     

    public function index()
    {
        $data['industry_page'] = IndustryPage::first();
        $data['main_menu'] = 'industry_page';
        $data['sub_menu'] = 'industry_page';

        return view('industry_page.index', $data);
    }
    public function industries()
    {
        $data['industries'] = Industry::all();
        $data['main_menu'] = 'industry_page';
        $data['sub_menu'] = 'industries';

        return view('industry_page.industries', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $industry_page = IndustryPage::first();
            if (!$industry_page) {
                $industry_page = new IndustryPage();
            }
            $industry_page->heading = $request->heading;
            $industry_page->text = $request->text;
            $imageName = 'images/industry_page/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/industry_page'), $imageName);
            $industry_page->image = $imageName;

            $industry_page->save();
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }

    public function add_industry()
    {
        $data['main_menu'] = 'industry_page';
        $data['sub_menu'] = 'industries';

        return view('industry_page.add_industry', $data);
    }

    public function store_industry(Request $request)
    {
        DB::beginTransaction();
        try {
            $industry = new Industry();
            $industry->name = $request->name;
            $industry->text = $request->text;
            $imageName = 'images/industry/' . time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('images/industry'), $imageName);
            $industry->icon = $imageName;
            $industry->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function edit_industry($id)
    {
        $data['industry'] = Industry::find($id);
        $data['main_menu'] = 'industry_page';
        $data['sub_menu'] = 'industries';

        return view('industry_page.edit_industry', $data);
    }

    public function update_industry(Request $request)
    {
        DB::beginTransaction();
        try {
            $industry = Industry::find($request->id);

            $industry->name = $request->name;
            $industry->text = $request->text;
            $imageName = 'images/industry/' . time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('images/industry'), $imageName);
            $industry->icon = $imageName;

            $industry->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }
}
