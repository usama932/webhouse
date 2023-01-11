<?php

namespace App\Http\Controllers;

use App\Models\ContactField;
use App\Models\ContactPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactPageController extends Controller
{
     

    public function index()
    {
        $data['contact_page'] = ContactPage::first();
        $data['main_menu'] = 'contact_page';
        $data['sub_menu'] = 'contact_page';

        return view('contact_page.contact_page', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $contact_page = ContactPage::first();
            if (!$contact_page) {
                $contact_page = new ContactPage();
            }
            $contact_page->heading = $request->heading;
            $contact_page->text = $request->text;
            $contact_page->form_heading = $request->form_heading;
            $contact_page->form_text = $request->form_text;
            $imageName = 'images/contact_page/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/contact_page'), $imageName);
            $contact_page->image = $imageName;

            $contact_page->save();
            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }

    public function contact_fields()
    {
        $data['contact_fields'] = ContactField::all();
        $data['main_menu'] = 'contact_page';
        $data['sub_menu'] = 'contact_fields';

        return view('contact_page.contact_fields', $data);
    }

    
    public function add_contact_field()
    {
        $data['main_menu'] = 'contact_page';
        $data['sub_menu'] = 'contact_fields';

        return view('contact_page.add_contact_field', $data);
    }

    public function store_contact_field(Request $request)
    {
        DB::beginTransaction();
        try {
            $contact_field = new ContactField();
           
            $contact_field->label = $request->label;
            $contact_field->name = $request->name;
            $contact_field->placeholder = $request->placeholder;
            $contact_field->type = $request->type;
            $contact_field->is_required = $request->is_required;

            $contact_field->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function edit_contact_field($id)
    {
        $data['contact_field'] = ContactField::find($id);
        $data['main_menu'] = 'contact_page';
        $data['sub_menu'] = 'contact_fields';

        return view('contact_page.edit_contact_field', $data);
    }

    public function update_contact_field(Request $request)
    {
        DB::beginTransaction();
        try {
            $contact_field = ContactField::find($request->id);
           
            $contact_field->label = $request->label;
            $contact_field->name = $request->name;
            $contact_field->placeholder = $request->placeholder;
            $contact_field->type = $request->type;
            $contact_field->is_required = $request->is_required;

            $contact_field->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail'));
        }
    }
}
