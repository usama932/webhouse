@extends("artist.layouts.master")
@section("meta")
<title>Photos | Soul Entertainment</title>
@endsection
@section("content")


<main class="d-flex flex-column justify-content-start flex-grow-1">

    <!-- Start -->
    <div class="section_space d-flex flex-column justify-content-center ">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Start -->
                <div class="col-md-8">
                    <h3 class="section_heading text-center section_heading_divider section_heading_divider_center mb-5">Album Name</h3>
                </div>

                <div class="col-md-8 text-center">

                    <ul class="nav nav-tabs justify-content-evenly">
                        <li class="nav-item flex-fill">
                            <button class="nav-link {{$audioActive}}  w-100" data-bs-toggle="tab" data-bs-target="#audioSongs" type="button" aria-selected="false">Audio</button>
                        </li>
                        <li class="nav-item flex-fill">
                            <button class="nav-link {{$videoActive}} w-100" data-bs-toggle="tab" data-bs-target="#videoSongs" type="button" aria-selected="true">Video</button>
                        </li>
                    </ul>

                    <div class="tab-content main_tab_content">
                        <div class="tab-pane show {{$audioActive}}" id="audioSongs">
                        <form method="POST" enctype="multipart/form-data" action="{{route('artist-singleaudio-search')}}">
                            @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            <ul class="list_items p-0 m-0">

                                <!-- ltem -->
                                @foreach($audios as $audio)
                                <li class="list_item d-flex align-items-center mt-3">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="{{asset("uploads/audio/$audio->thumbnail")}}" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">{{$audio->name}}</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <audio controls>
                                            <source src="{{asset("uploads/audio")}}/{{$audio->audio}}" type="audio/mpeg"> 
                                        </audio>
                                    </div>
                                   
                                </li>
                                @endforeach

                                <!-- ltem -->


                            </ul>
                        </div>
                        <div class="tab-pane show {{$videoActive}}"  id="videoSongs">
                            <form method="POST" enctype="multipart/form-data" action="{{route('artist-singlevideo-search')}}">
                                @csrf
                                <div class="input-group">
                                <input type="hidden" class="form-control" placeholder="Search" value={{$album_id}} name="album_id">

                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            <ul class="list_items p-0 m-0">

                                <!-- ltem -->
                                @foreach($videos as $video)

                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="{{asset("uploads/video/$video->thumbnail")}}" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">{{$video->name}}</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <video width="150" height="100" controls>     
                                            <source src="{{asset("uploads/video/")}}/{{$video->video}}  " type="video/mp4">   
                                            <source src="{{asset("uploads/video/")}}/{{$video->video}}  " type="video/ogg">   
                                            Your browser does not support the video tag. 
                                        </video> 
                                    </div>
                                  
                                </li>
                                @endforeach

                                <!-- ltem -->


                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- End -->



</main>

@endsection