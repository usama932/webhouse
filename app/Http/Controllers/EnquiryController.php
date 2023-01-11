<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{
    public function user_enquiries()
    {
        $data['enquiries'] = Enquiry::all();
        $data['main_menu'] = 'enquiries';
        $data['sub_menu'] = '';

        return view('enquiries.index', $data);
    }
    public function send_enquiry(Request $request)
    {
        DB::beginTransaction();
        try {
            $enquiry = new Enquiry();
            $enquiry->sender_name = $request->sender_name;
            $enquiry->sender_email = $request->sender_email;
            $enquiry->message = $request->message;

            $enquiry->save();

            // set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return redirect()->back()->withErrors(['alert-success'=>'Enquiry Sent Successfully']);
            // return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            // set_alert('fail', 'Something went wrong !!');
            // return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
            return redirect()->back()->withErrors(['alert-danger'=>'Something Went Wrong!!']);

        }
    }
}
