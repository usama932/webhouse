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
                    <h3 class="section_heading section_heading_divider mb-5">Weekly Top 5 Audios</h3>
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
                        </div>
                        <div class="list_item_icons ms-auto">
                            <a href="#"><i class="fas fa-play"></i></a>
                             <a href="javascript:;" class="favour1" data-id="{{ $audio->id }}"><i class="far fa-heart"></i></a>

                        </div>
                    </li>
                    @endforeach
                

                </ul>
                
            </div>
            <!-- Top Songs Audio End -->

            <!-- Top Songs Video Start -->
            <div class="col-lg-6 ps-lg-5">

                <div class="d-flex justify-content-between">
                    <h3 class="section_heading section_heading_divider mb-5">Weekly Top 5 Videos</h3>
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
                            </div>
                            <div class="list_item_icons ms-auto">
                                <a href="#"><i class="fas fa-play"></i></a>
                                 <a href="javascript:;" class="favour"  data-id="{{ $video->id }}"><i class="far fa-heart"></i></a>
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

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="artist.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Artists Name</h5>
                                    <div class="text-center">
                                        <a href="#" class="btn btn_light btn_sm">subscribe</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="artist.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Artists Name</h5>
                                    <div class="text-center">
                                        <a href="#" class="btn btn_light btn_sm">subscribed</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="artist.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Artists Name</h5>
                                    <div class="text-center">
                                        <a href="#" class="btn btn_light btn_sm">subscribe</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="artist.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Artists Name</h5>
                                    <div class="text-center">
                                        <a href="#" class="btn btn_light btn_sm">subscribed</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="artist.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Artists Name</h5>
                                    <div class="text-center">
                                        <a href="#" class="btn btn_light btn_sm">subscribe</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="artist.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Artists Name</h5>
                                    <div class="text-center">
                                        <a href="#" class="btn btn_light btn_sm">subscribe</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
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
                <a href="categories.html">View All</a>
            </div>

            <div class="col-md-12">

                <!-- Slider main container -->
                <div class="swiper featured_artists">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="category.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Category Name</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="category.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Category Name</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="category.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Category Name</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="category.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Category Name</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="category.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Category Name</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="item_box">
                                <a href="category.html" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="images/placeholder_1.jpg"/>
                                </div>
                                <div class="item_box_content">
                                    <h5 class="item_box_title">Category Name</h5>
                                </div>
                            </div>
                        </div>

                        
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
@endsection