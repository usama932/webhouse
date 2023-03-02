<?php

namespace App\Http\Controllers\User;

use App\Audio;
use App\FavrateAudio;
use App\FavrateVideo;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ArtistSubscribe;
use App\Artist;
use App\User;
use App\Category;

class CategoryController extends Controller
{
    public function category(){
        $categories = Category::latest()->paginate(10);
        return view('user.category.index', ['title' => 'Categories List','categories' => $categories]);
    }
    public function select_category($id){
        $user_id = Auth::id();
        $category = $id;
        $category_name = Category::where('id',$id)->first();
        $category_name = $category_name->name;
        $audios = Audio::leftjoin('favrate_audio' ,'audio.id','=','favrate_audio.audio_id')
                        ->leftjoin('categories as cat','audio.category','=', 'cat.id')
                        ->select(
                            'audio.id',
                            'favrate_audio.audio_id',
                            'favrate_audio.id as fav_id',
                            'audio.name',
                            'audio.thumbnail',
                            'audio.audio',
                            'cat.name as cat_name' ,
                        )
                        ->where('audio.category',$category)->paginate(10);
            $videos = Video::leftjoin('favrate_videos' ,'videos.id','=','favrate_videos.video_id')
                            ->leftjoin('categories as cat','videos.category','=', 'cat.id')
                            ->select(
                                'videos.id',
                                'favrate_videos.video_id',
                                'favrate_videos.id as fav_id',
                                'videos.name',
                                'videos.thumbnail',
                                'videos.video',
                                'cat.name as cat_name' ,
                            )
                            ->where('videos.category',$category)->paginate(10);
                            $videoActive = '';
                            $audioActive ='active';
                            return view("user.category.category", ["audios" => $audios,'category' => $category, "videos" => $videos,
                                                                    'videoActive'=>  $videoActive,'audioActive'=> $audioActive , 'category_name' => $category_name]);
    }
    public function show_audioSongs($id)
    {
        $user_id = Auth::id();
        $category = $id;
        $audios = Audio::leftjoin('favrate_audio' ,'audio.id','=','favrate_audio.audio_id')
                        ->leftjoin('categories as cat','audio.category','=', 'cat.id')
                        ->select(
                            'audio.id',
                            'favrate_audio.audio_id',
                            'favrate_audio.id as fav_id',
                            'audio.name',
                            'audio.thumbnail',
                            'audio.audio',
                            'cat.name as cat_name' ,
                        )
                        ->where('audio.category',$category)->paginate(10);

        
        return view("user.category.audio_songs", ["audios" => $audios,'category' => $category, "videos" => $videos]);
    }
    public function show_videoSongs($id)
    {
        $user_id = Auth::id();
        $category = $id;
        $videos = Video::leftjoin('favrate_videos' ,'videos.id','=','favrate_videos.video_id')
                        ->leftjoin('categories as cat','videos.category','=', 'cat.id')
                        ->select(
                            'videos.id',
                            'favrate_videos.video_id',
                            'favrate_videos.id as fav_id',
                            'videos.name',
                            'videos.thumbnail',
                            'videos.video',
                            'cat.name as cat_name' ,
                        )
                        ->where('videos.category',$category)->paginate(10);
        return view("user.category.video_songs", ["videos" => $videos,'category' => $category]);
    }
    public function searchCategory(Request $request)
    {
        $search = $request->search;
        $categories = Category::where('name', 'like', "%{$search}%")->latest()
            ->paginate(10);
            return view('user.category.index', ['title' => 'Categories List','categories' => $categories]);
    }
    public function categoryAudioSearch(Request $request)
    {
     
        $search = $request->search;
        $category = $request->category;
        $audios = Audio::where('category',$category)->where('name', 'like', "%{$search}%")->with('cat','artist','fav')->paginate(10);    
        return view("user.category.audio_songs", ["audios" => $audios,"category" => $category]);
       
    }
    public function categoryVideoSearch(Request $request){
        $search = $request->search;
        $category = $request->category;
        $videos = Video::where('category',$category)->where('name', 'like', "%{$search}%")->with('cat','artist','fav')->paginate(10);
        return view("user.category.video_songs", ["videos" => $videos,"category" => $category]);
    }
        
        
}
