<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\About_uss;
use App\Models\AboutUs;
use App\Models\HomePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['main_menu']='dashboard';
        $data['sub_menu']='dashboard';
        return view('home',$data);
    }

    public function slider(){
        $data['slider'] = Slider::where(['page'=>'Home'])->get();
        $data['main_menu']='Home';
        $data['sub_menu']='slider';
        return view('home.slider',$data);
    }
    public function addSlider(Request $request){

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'descripton' => 'required',
            'button_text'=>'required',
            'button_url'=>'required',
            'img'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if($validation->fails()){
            return json_encode(array('status' => 'fail', 'url' => '', 'error' =>$validation->errors()));
        }
        else{
             $imageName = time().'.'.$request->img->extension();
             $request->img->move(public_path('images/slider'), $imageName);
             $slider = new Slider;
             $slider->heading_text = $request->title;
             $slider->description = $request->descripton;
             $slider->button_text = $request->button_text;
             $slider->button_url = $request->button_url;
             $slider->img = $imageName;
             $slider->page='Home';
             $slider->save();
            set_alert('success','information has been saved successfully');
            return json_encode(array('status' => 'success'));
        }

    }

    public function status($id){
        $slider = slider::find($id);
        if($slider->status==1){
            $val = 0;
        }
        else{
            $val = 1;
        }

        $slider->status = $val;
         $slider->save();
        return redirect('slider');
    }

    public function edit($id){
        $slider = Slider::find($id)->get();
        $data['slider']=$slider;
        $data['main_menu']='Home';
        $data['sub_menu']='slider_edit';
        return view('home.sliderEdit',$data);
    }
    public function deleteslider($id){
        Slider::find($id)->delete();
    }

    public function about(){
        $data['about'] =AboutUs::first();
        $data['main_menu']='Home';
        $data['sub_menu']='aboutus';
        return view('home.about',$data);
    }

    public function update_about(Request $request)
    {
        DB::beginTransaction();
        try {
            $about = AboutUs::first();
            if (!$about) {
                $about = new AboutUs();
            }
            $about->header_one = $request->header_one;
            $about->header_two = $request->header_two;
            $about->content = $request->content;
            $imageName = 'images/home/'.time().'.'.$request->image->extension();
             $request->image->move(public_path('images/home'), $imageName);
            $about->save();
            set_alert('success','Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail','Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }
    public function home_package(){
        $data['home_package'] =HomePackage::first();
        $data['main_menu']='Home';
        $data['sub_menu']='home_package';
        return view('home.package',$data);
    }

    public function update_home_package(Request $request)
    {
        DB::beginTransaction();
        try {
            $home_package = HomePackage::first();
            if (!$home_package) {
                $home_package = new HomePackage();
            }
            $home_package->heading_text = $request->heading_text;
            $home_package->sub_heading_text = $request->sub_heading_text;
            $home_package->save();
            set_alert('success','Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail','Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }
}
