<?php

namespace App\Http\Controllers;

use App\Models\ServicePage;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicePageController extends Controller
{

    public function index()
    {
        $data['service_page'] = ServicePage::first();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'service_page';

        return view('service_page.index', $data);
    }
    public function services()
    {
        $data['services'] = Services::all();
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'services';

        return view('service_page.services', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $service_page = ServicePage::first();
            if (!$service_page) {
                $service_page = new ServicePage();
            }
            $service_page->heading_one = $request->heading_one;
            $service_page->heading_two = $request->heading_two;
            $imageName = 'images/service_page/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/service_page'), $imageName);
            $service_page->image = $imageName;

            $service_page->save();
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }

    public function add_service()
    {
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'services';

        return view('service_page.add_service', $data);
    }

    public function store_service(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = new Services();
            $service->name = $request->name;

            if ($request->image) {
                $imageName = 'images/service/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/service'), $imageName);
                $service->image = $imageName;
            }

            $service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function edit_service($id)
    {
        $data['service'] = Services::find($id);
        $data['main_menu'] = 'service_page';
        $data['sub_menu'] = 'services';

        return view('service_page.edit_service', $data);
    }

    public function update_service(Request $request)
    {
        DB::beginTransaction();
        try {
            $service = Services::find($request->id);

            $service->name = $request->name;
            if ($request->image) {
                $imageName = 'images/service/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/service'), $imageName);
                $service->image = $imageName;
            }
            $service->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }
}
