@extends("user.layouts.master")
@section("meta")
<title>Audios | Soul Entertainment</title>
@endsection
@section("content")

<main class="d-flex flex-column justify-content-start flex-grow-1">

<!-- Songs Start -->
<div class="section_space d-flex flex-column justify-content-center ">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Songs Audio Start -->
            <div class="col-md-12 ">

                <div class="row justify-content-md-between">
                    <div class="col-md-6">
                        <h3 class="section_heading section_heading_divider mb-5">Favorites Audio Songs</h3>
                    </div>
                    <div class="col-md-5">
                        <form action="#" class="mb-5">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="search">
                                <button class="input-group-text"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
               
                <ul class="list_items p-0 m-0">
                    @foreach($audios as $audio)
                        <li class="list_item d-flex align-items-center">
                            <a href="#" class="list_item_thumb">
                                <img alt="" src="{{asset("uploads/audio/$audio->autdio->thumbnail")}}" width="60"/>    
                            </a>
                            <div class="list_item_info mx-3">
                                <a class="list_item_info_title" href="#">{{$audio->audio->name}}</a>
                                <a class="list_item_info_sub" href="category.html">{{$audio->audio->cat->name}}</a>
                            </div>
                            <div class="list_item_icons ms-auto">
                                <a href="#"><i class="fas fa-play"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </li>   
                    @endforeach

                    

                    
            
                </ul>
                
            </div>
            <!-- Songs Audio End -->

        </div>
    </div>
</div>
<!-- Songs End -->



</main>


@endsection