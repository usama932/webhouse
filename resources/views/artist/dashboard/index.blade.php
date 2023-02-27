@extends("artist.layouts.master")
@section("meta")
    <title>Artist Dashboard | Soul Entertainment</title>
@endsection
@section("content")
    <main class="d-flex flex-column justify-content-start flex-grow-1">


        <div class="section_space d-flex flex-column justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-12">
                        <div class="header_box d-flex align-items-start">
                            <div class="header_box_thumb">
                                @php $img = Auth::user()->image; $artist = Auth::user(); @endphp
                                <img alt="" src="{{asset('frontend/images/avatar.png')}}" width="90"/>
                            </div>
                            <div class="header_box_content ms-3 d-flex flex-column flex-sm-row justify-content-center flex-grow-1">
                                <div class="header_box_info">
                                    <h5>{{$artist->name}}</h5>
                                    <a href="#">{{$artist->email}}</a>
                                    <p class="mb-0">@if($artist->gender) Male @else Female @endif</p>
                                </div>
                                <div class="header_box_icons ms-sm-auto mt-2 mt-sm-0">
                                    <a target="_blank" href="{{$artist->facebook_link}}"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="{{$artist->twitter_link}}"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="{{$artist->youtube_link}}"><i class="fab fa-youtube"></i></a>
                                    <a target="_blank" href="{{$artist->instagram_link}}"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center mt-5">

                        <div class="row g-4">

                            <div class="col-md-4">
                                <div class="stat_box">
                                    <a href="{{route('artist-videos.index')}}" class="stretched-link"></a>
                                    <div class="stat_box_image" style="background-image: url({{asset('frontend/images/box_thumb_video.jpg')}});"></div>
                                    <div class="stat_box_content">
                                        <span class="stat_box_content_stat">{{$artist->videos->count()}}</span>
                                        <h3 class="stat_box_content_title">Videos</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="stat_box">
                                    <a href="{{route('artist-audios.index')}}" class="stretched-link"></a>
                                    <div class="stat_box_image" style="background-image: url({{asset("frontend/images/box_thumb_audio.jpg")}});"></div>
                                    <div class="stat_box_content">
                                        <span class="stat_box_content_stat">{{$artist->audios->count()}}</span>
                                        <h3 class="stat_box_content_title">Audios</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="stat_box">
                                    <a href="{{route("artist-images.index")}}" class="stretched-link"></a>
                                    <div class="stat_box_image" style="background-image: url({{asset("frontend/images/box_thumb_image.jpg")}});"></div>
                                    <div class="stat_box_content">
                                        <span class="stat_box_content_stat">{{$artist->images->count()}}</span>
                                        <h3 class="stat_box_content_title">Photos</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="stat_box">
                                    <a href="{{route("artist-albums.index")}}" class="stretched-link"></a>
                                    <div class="stat_box_image" style="background-image: url({{asset("frontend/images/box_thumb_album.jpg")}});"></div>
                                    <div class="stat_box_content">
                                        <span class="stat_box_content_stat">{{$artist->albums->count()}}</span>
                                        <h3 class="stat_box_content_title">Albums</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="stat_box">
                                    <a href="{{route("artist-subscribers.index")}}" class="stretched-link"></a>
                                    <div class="stat_box_image" style="background-image: url({{asset("frontend/images/box_thumb_subscribers.jpg")}});"></div>
                                    <div class="stat_box_content">
                                        <span class="stat_box_content_stat">{{$artist->subscribes->count()}}</span>
                                        <h3 class="stat_box_content_title">Subscribers</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="stat_box">
                                    <a href="{{route("artist-events.index")}}" class="stretched-link"></a>
                                    <div class="stat_box_image" style="background-image: url({{asset("frontend/images/box_thumb_events.jpg")}});"></div>
                                    <div class="stat_box_content">
                                        <span class="stat_box_content_stat">{{$artist->events->count()}}</span>
                                        <h3 class="stat_box_content_title">Events</h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
@section("scripts")
@endsection
