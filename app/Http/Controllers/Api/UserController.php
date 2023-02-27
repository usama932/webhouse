<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Workout;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return response([
            'user' => $user,
            'message' => "working"
        ],200);
    }


    public function getCategories()
    {
        // $user = auth()->user();
        $categories = Category::all();
        if($categories->isNotEmpty()){
            return response([
                'data' => $categories,
                'message' => "Categories List",
                'error' => false
            ],200);
        }else{
            return response([
                'message' => "Categories Not Found",
                'error' => true
            ],200);
        }
       
    }


    public function getWorkout(Request $request)
    {
        // $user = auth()->user();
        $type  = $request->input("type");
        $category  = $request->input("category");
        $level  = $request->input("level");
        if($type == 1){
            $str = "Muscle Build";
        }elseif($type == 2){
            $str = "HIIT";
        }elseif($type == 3){
            $str = "Core";
        }

        $workout = Workout::where([["type",$str],["level",$level],["category_id",$category]])->with("exercises")->first();
        if($workout){
            return response([
                'data' => $workout,
                'message' => "Workout ",
                'error' => false
            ],200);
        }else{
            return response([
                'message' => "Workout Not Found",
                'error' => true
            ],200);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
