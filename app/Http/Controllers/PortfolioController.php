<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Models\PortfolioPage;
use App\Models\PortfolioTypes;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index()
    {
        $data['portfolio_page'] = PortfolioPage::first();
        $data['main_menu'] = 'portfolio_page';
        $data['sub_menu'] = 'portfolio_page';

        return view('portfolio_page.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $portfolio_page = PortfolioPage::first();
            if (!$portfolio_page) {
                $portfolio_page = new PortfolioPage();
            }

            $portfolio_page->heading = $request->heading;
            $portfolio_page->description = $request->description;

            $portfolio_page->portfolio_heading = $request->portfolio_heading;
            $portfolio_page->portfolio_text = $request->portfolio_text;

            if ($request->image_1) {
                $imageName = 'images/portfolio_page/' . time() . '.' . $request->image_1->extension();
                $request->image_1->move(public_path('images/portfolio_page'), $imageName);
                $portfolio_page->image_1 = $imageName;
            }
            if ($request->image_2) {
                $imageName = 'images/portfolio_page/' . time() . '.' . $request->image_2->extension();
                $request->image_2->move(public_path('images/portfolio_page'), $imageName);
                $portfolio_page->image_2 = $imageName;
            }
            if ($request->image_3) {
                $imageName = 'images/portfolio_page/' . time() . '.' . $request->image_3->extension();
                $request->image_3->move(public_path('images/portfolio_page'), $imageName);
                $portfolio_page->image_3 = $imageName;
            }
            if ($request->image_4) {
                $imageName = 'images/portfolio_page/' . time() . '.' . $request->image_4->extension();
                $request->image_4->move(public_path('images/portfolio_page'), $imageName);
                $portfolio_page->image_4 = $imageName;
            }
            if ($request->image_5) {
                $imageName = 'images/portfolio_page/' . time() . '.' . $request->image_5->extension();
                $request->image_5->move(public_path('images/portfolio_page'), $imageName);
                $portfolio_page->image_5 = $imageName;
            }
            if ($request->image_6) {
                $imageName = 'images/portfolio_page/' . time() . '.' . $request->image_6->extension();
                $request->image_6->move(public_path('images/portfolio_page'), $imageName);
                $portfolio_page->image_6 = $imageName;
            }

            $portfolio_page->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function portfolio_types()
    {
        $data['portfolio_types'] = PortfolioTypes::all();
        $data['main_menu'] = 'portfolio_page';
        $data['sub_menu'] = 'portfolio_types';

        return view('portfolio_types.index', $data);
    }
    // public function portfolios()
    // {
    //     $data['portfolios'] = PortfolioTypes::all();
    //     $data['main_menu'] = 'portfolio_page';
    //     $data['sub_menu'] = 'portfolios';

    //     return view('portfolio_types.index', $data);
    // }

    public function add_portfolio_type()
    {
        $data['main_menu'] = 'portfolio_page';
        $data['sub_menu'] = 'portfolio_types';

        return view('portfolio_types.add_portfolio_type', $data);
    }

    public function store_portfolio_type(Request $request)
    {
        DB::beginTransaction();
        try {
            $portfolio_type = new PortfolioTypes();
            $portfolio_type->name = $request->name;
            $portfolio_type->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
    public function edit_portfolio_type($id)
    {
        $data['portfolio_type'] = PortfolioTypes::find($id);
        $data['main_menu'] = 'portfolio_page';
        $data['sub_menu'] = 'portfolio_types';

        return view('portfolio_types.edit_portfolio_type', $data);
    }

    public function update_portfolio_type(Request $request)
    {
        DB::beginTransaction();
        try {
            $portfolio_type = PortfolioTypes::find($request->id);
            $portfolio_type->name = $request->name;
            $portfolio_type->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function portfolios()
    {
        $data['portfolios'] = Portfolio::with('portfolio_type')->get();
        $data['main_menu'] = 'portfolio_page';
        $data['sub_menu'] = 'portfolio';

        return view('portfolios.index', $data);
    }

    public function add_portfolio()
    {
        $data['portfolio_types'] = PortfolioTypes::all();
        $data['main_menu'] = 'portfolio_page';
        $data['sub_menu'] = 'portfolio';

        return view('portfolios.add_portfolio', $data);
    }

    public function store_portfolio(Request $request)
    {
        DB::beginTransaction();
        try {
            $portfolio = new Portfolio();
            $portfolio->type = $request->type;
            $portfolio->name = $request->name;
            $portfolio->link = $request->link;

            if ($request->image) {
                $imageName = 'images/portfolios/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/portfolios'), $imageName);
                $portfolio->image = $imageName;
            }

            $portfolio->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
    public function edit_portfolio($id)
    {
        $data['portfolio'] = Portfolio::find($id);
        $data['main_menu'] = 'portfolio_page';
        $data['sub_menu'] = 'portfolio';
        $data['portfolio_types'] = PortfolioTypes::all();

        return view('portfolios.edit_portfolio', $data);
    }

    public function update_portfolio(Request $request)
    {
        DB::beginTransaction();
        try {
            $portfolio = Portfolio::find($request->id);
            $portfolio->type = $request->type;
            $portfolio->name = $request->name;
            $portfolio->link = $request->link;

            if ($request->image) {
                $imageName = 'images/portfolios/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/portfolios'), $imageName);
                $portfolio->image = $imageName;
            }
            
            $portfolio->save();

            set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }

    public function delete_portfolio(Request $request)
    {
        DB::beginTransaction();
        try {
            $portfolio = Portfolio::find($request->id);
            
            $portfolio->delete();

            set_alert('success', 'Information has been deleted successfully');
            DB::commit();
            return redirect()->route('admin_portfolio');
        } catch (\Exception $e) {
            set_alert('fail', 'Something went wrong !!');
            return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
        }
    }
}
