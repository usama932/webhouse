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
                        <h3 class="section_heading section_heading_divider mb-5">Categories</h3>
                    </div>
                    <div class="col-md-5">
                        <form action="{{route('user.search_category')}}" class="mb-5" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="search">
                                <button class="input-group-text"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
               
                <ul class="list_items p-0 m-0">
                    @foreach($categories as $category)
                        <li class="list_item d-flex align-items-center">
                            <a href="#" class="list_item_thumb">
                                <img alt="" src="{{asset("uploads")}}/{{$category->image}} " width="60"/>    
                            </a>
                            <div class="list_item_info mx-3">
                                <a class="list_item_info_title" href="#">{{$category->name}}</a>
                                <a class="list_item_info_sub" href="#"></a>
                                
                            </div>
                            <div class="list_item_icons ms-auto">   
                                <div class="text-center">
                                    <a  href="{{route('user.audio_category_songs',$category->id)}}" class=" btn btn_light btn_sm">Audio Songs</a>
                                    <a  href="{{route('user.video_category_songs',$category->id)}}" class=" btn btn_light btn_sm">Video Songs</a>
                                </div>
                            </div>
                        </li>   
                    @endforeach

                     <div class="d-flex justify-content-center">
                       {!! $categories ->links() !!}
                    </div>

                    
            
                </ul>
                
            </div>
            <!-- Songs Audio End -->

        </div>
    </div>
</div>
<!-- Songs End -->





</main>


@endsection
@section("scripts")

@endsection