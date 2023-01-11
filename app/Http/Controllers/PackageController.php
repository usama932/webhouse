<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackagePage;
use App\Models\PackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
     

    public function index()
    {
        $data['package_page'] = PackagePage::first();
        $data['main_menu'] = 'package_page';
        $data['sub_menu'] = 'package_page';

        return view('package_page.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $package_page = PackagePage::first();
            if (!$package_page) {
                $package_page = new PackagePage();
            }
            $package_page->package_heading = $request->package_heading;
            $package_page->package_content = $request->package_content;
            $package_page->pricing_heading = $request->pricing_heading;
            $package_page->pricing_content = $request->pricing_content;
            $imageName = 'images/package_page/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/package_page'), $imageName);
            $package_page->image = $imageName;

            $package_page->save();
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }

    public function package_types()
    {
        $data['package_types'] = PackageType::all();
        $data['main_menu'] = 'package_page';
        $data['sub_menu'] = 'package_type';

        return view('package_page.package_types', $data);
    }

    public function add_package_type()
    {
        $data['main_menu'] = 'package_page';
        $data['sub_menu'] = 'package_type';

        return view('package_page.add_package_type', $data);
    }

    public function store_package_type(Request $request)
    {
        DB::beginTransaction();
        try {
            $package_type = new PackageType();
            $package_type->name = $request->name;
            $package_type->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
    public function edit_package_type($id)
    {
        $data['package_type'] = PackageType::find($id);
        $data['main_menu'] = 'package_page';
        $data['sub_menu'] = 'package_type';

        return view('package_page.edit_package_type', $data);
    }

    public function update_package_type(Request $request)
    {
        DB::beginTransaction();
        try {
            $package_type = PackageType::find($request->id);
            $package_type->name = $request->name;
            $package_type->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
    public function packages()
    {
        $data['packages'] = Package::with('package_type')->get();
        $data['main_menu'] = 'package_page';
        $data['sub_menu'] = 'package';

        return view('package_page.packages', $data);
    }

    public function add_package()
    {
        $data['package_types'] = PackageType::all();
        $data['main_menu'] = 'package_page';
        $data['sub_menu'] = 'package';

        return view('package_page.add_package', $data);
    }

    public function store_package(Request $request)
    {
        DB::beginTransaction();
        try {
            $package = new Package();
            $package->type = $request->type;
            $package->name = $request->name;
            $package->price = $request->price;
            $package->content = $request->content;
            $package->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
    public function edit_package($id)
    {
        $data['package'] = Package::find($id);
        $data['main_menu'] = 'package_page';
        $data['sub_menu'] = 'package';
        $data['package_types'] = PackageType::all();

        return view('package_page.edit_package', $data);
    }

    public function update_package(Request $request)
    {
        DB::beginTransaction();
        try {
            $package = Package::find($request->id);
            $package->type = $request->type;
            $package->name = $request->name;
            $package->price = $request->price;
            $package->content = $request->content;
            $package->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function delete_package(Request $request)
    {
        DB::beginTransaction();
        try {
            $package = Package::find($request->id);
            
            $package->delete();

            set_alert('success', 'Information has been deleted successfully');
            DB::commit();
            return redirect()->route('admin_packages');
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
