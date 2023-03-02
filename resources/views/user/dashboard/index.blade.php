@extends("user.layouts.master")
@section("meta")
    <title>Artist Dashboard | Soul Entertainment</title>
@endsection
@section("content")

<main class="d-flex flex-column justify-content-start flex-grow-1">

<!-- Top Songs Start -->
<div class="section_space d-flex flex-column justify-content-center ">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Top Songs Audio Start -->
            <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">

                <div class="d-flex justify-content-between">
                    <h3 class="section_heading section_heading_divider mb-5"> Top 5 Audios</h3>
                    <a href="{{route('user.audioSongs')}}">View All</a>
                </div>
                

                <ul class="list_items p-0 m-0">
                    @foreach($audios as $audio)
                    <li class="list_item d-flex align-items-center">
                        <a href="#" class="list_item_thumb">
                             <img alt="" src="{{asset("uploads/audio/$audio->thumbnail")}}" width="60"/>
                        </a>
                        <div class="list_item_info mx-3">
                            <a class="list_item_info_title" href="#">{{$audio->name}}</a>
                            <a class="list_item_info_sub" href="#">{{$audio->cat->name}}</a>
                            {{-- <a href="javascript:;" class="favour1" data-id="{{ $audio->id }}"><i class="far fa-heart"></i></a> --}}
                        </div>
                        <div class="list_item_icons ms-auto">
                            <audio controls>
                                <source src="{{asset("uploads/audio")}}/{{$audio->audio}}" type="audio/mpeg"> 
                            </audio>
                        </div>
                    </li>
                    @endforeach
                

                </ul>
                
            </div>
            <!-- Top Songs Audio End -->

            <!-- Top Songs Video Start -->
            <div class="col-lg-6 ps-lg-5">

                <div class="d-flex justify-content-between">
                    <h3 class="section_heading section_heading_divider mb-5"> Top 5 Videos</h3>
                    <a href="{{route('user.videoSongs')}}">View All</a>
                </div>

                <ul class="list_items p-0 m-0">
                    @foreach($videos as $video)
                        <li class="list_item d-flex align-items-center">
                            <a href="#" class="list_item_thumb">
                                      <img alt="" src="{{asset("uploads/video/$video->thumbnail")}}" width="60"/>
                            </a>
                            <div class="list_item_info mx-3">
                                <a class="list_item_info_title" href="#">{{$video->name}}</a>
                                <a class="list_item_info_sub" href="#">{{$video->cat->name}}</a>
                                {{-- <a href="javascript:;" class="favour"  data-id="{{ $video->id }}"><i class="far fa-heart"></i></a> --}}
                            </div>
                            <div class="list_item_icons ms-auto">
                                <video width="150" height="100" controls>                             
                                    <source src="{{asset("uploads/video")}}/{{$video->video}}  " type="video/mp4">   
                                    <source src="{{asset("uploads/video")}}/{{$video->video}}  " type="video/ogg">   
                                    Your browser does not support the video tag. 
                                </video> 
                                 
                            </div>
                        </li>

                    @endforeach
                  

                </ul>
                
            </div>
            <!-- Top Songs Video End -->

        </div>
    </div>
</div>
<!-- Top Songs End -->

<!-- Featured Artists Start -->
<div class="section_space d-flex flex-column justify-content-center pt-0">
    <div class="container">
        <div class="row justify-content-center">

            <div class="d-flex justify-content-between">
                <h3 class="section_heading section_heading_divider mb-5">Featured Artists</h3>
                <a href="artists.html">View All</a>
            </div>

            <div class="col-md-12">

                <!-- Slider main container -->
                <div class="swiper featured_artists">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        @foreach($artists as $artist)
                            <div class="swiper-slide">
                                <div class="item_box">
                                    <a href="artist.html" class="stretched-link"></a>
                                    <div class="item_box_thumb item_box_thumb_link">
                                        <img alt="" src="{{asset("uploads/$artist->image")}}"/>
                                    </div>
                                    <div class="item_box_content">
                                        <h5 class="item_box_title">{{$artist->name}}</h5>
                                        @if($artist->status == '1')
                                           <div class="text-center">
                                                <a  href="javascript:;"   data-id="{{ $artist->artist_id }}" class="unsubscribe btn btn_light btn_sm">UnSubscribe</a>
                                            </div>
                                        @elseif($artist->status == '0')
                                         <div class="text-center">
                                                <a href="javascript:;"   data-id="{{ $artist->artist_id }}" class="unsubscribe btn btn_light btn_sm">Cancel Request</a>
                                            </div>
                                        @elseif($artist->status = " " && $artist->status != '0' &&  $artist->status != '1')
                                            <div class="text-center">
                                                <a href="javascript:;"   data-id="{{ $artist->id }}" class="subscribe btn btn_light btn_sm">Subscribe</a>
                                            </div>
                                            
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                      
                        
                    </div>

                    <!-- navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Featured Artists Start -->    

<!-- Categories Start --> 
<div class="section_space d-flex flex-column justify-content-center pt-0">
    <div class="container">
        <div class="row justify-content-center">

            <div class="d-flex justify-content-between">
                <h3 class="section_heading section_heading_divider mb-5">Top Categories</h3>
                <a href="{{route('user.category')}}">View All</a>
            </div>

            <div class="col-md-12">

                <!-- Slider main container -->
                <div class="swiper featured_artists">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach($categories as $category)
                        
                            <div class="swiper-slide">
                                <div class="item_box">
                                    <a href="{{route('user.select_category',$category->id)}}" class="stretched-link"></a>
                                    <div class="item_box_thumb item_box_thumb_link">
                                        <img alt="" src="{{asset("uploads/$category->image")}}"/>
                                    </div>
                                    <div class="item_box_content">
                                        <h5 class="item_box_title">{{$category->name}}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                       
                        
                    </div>

                    <!-- navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Categories End -->    


</main>

@endsection
@section("scripts")
<script>
    $(document).on('click', '.favour1', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You could be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Favour/unFavour!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'POST'
                    },
                    url: "{{url('user/favourAudio/')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Favour Added Successfully!", response.msg, "success");
                    location.reload();
                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
<script>
    $(document).on('click', '.favour', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You can be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Added to Favourite!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'POST'
                    },
                    url: "{{url('user/favourVideo/')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Favourite!", response.msg, "success");
                    location.reload();


                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
<script>
    $(document).on('click', '.unsubscribe', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You can be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Are You Want to UnSubscribe!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'POST'
                    },
                    url: "{{url('user/unsubscribe_artist/')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("UnSubscribed!", response.msg, "success");
                    location.reload();


                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
<script>
    $(document).on('click', '.subscribe', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You can be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Are You Want to Subscribe!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'POST'
                    },
                    url: "{{url('user/subscribe_artist/')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Subscribed!", response.msg, "success");
                    location.reload();


                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
@endsection