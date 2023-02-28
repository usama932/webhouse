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
    public function show_audioSongs($id){
        $user_id = Auth::id();
        
        $audios = Audio::where('category',$id)->with('cat','artist','fav')->paginate(10);
           
        return view("user.category.audio_songs", ["audios" => $audios]);
    }
    public function show_videoSongs($id){
        $user_id = Auth::id();
        $videos = Video::with('cat','artist')->paginate(10);
        return view("user.category.video_songs", ["videos" => $videos]);
    }
    public function searchCategory(Request $request){
        $search = $request->search;
        $categories = Category::where('name', 'like', "%{$search}%")->latest()
            ->paginate(10);
            return view('user.category.index', ['title' => 'Categories List','categories' => $categories]);
        }
    public function categoryAudioSearch(Request $request){
        $search = $request->search;
        $audios = Audio::where('category',$id)->where('name', 'like', "%{$search}%")->with('cat','artist','fav')->paginate(10);    
        return view("user.category.audio_songs", ["audios" => $audios]);
       
        }
    public function categoryVideoSearch(Request $request){
        $search = $request->search;
        $videos = Video::where('category',$id)->where('name', 'like', "%{$search}%")->with('cat','artist','fav')->paginate(10);
        return view("user.category.video_songs", ["videos" => $videos]);
        }
        
        
}
