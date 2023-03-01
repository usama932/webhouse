@extends("user.layouts.master")
@section("meta")
<title>Events | Soul Entertainment</title>
@endsection
@section("content")

<main class="d-flex flex-column justify-content-start flex-grow-1">


    <div class="section_space d-flex flex-column justify-content-center ">
        <div class="container">
            <div class="row justify-content-center">



                <div class="col-md-12 text-center mt-5">
                    
                    <div class="item_box">

                        <div class="item_box_thumb_link">
                            <img alt="" src="{{ asset("uploads/image/$event->image") }}" width="30%" height="30%" />
                        </div>


                    </div>

                    <div class="tab-content main_tab_content">
                        <div class="tab-pane show active" id="songsAudio">
                            <div class="header_box_content ms-3 d-flex flex-column flex-sm-row justify-content-center flex-grow-1">
                                <div class="header_box_info">
                                    <h5>{{$event->name}}</h5>

                                </div>
                                <div class="header_box_icons ms-sm-auto mt-2 mt-sm-0">
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <ul class="list_items p-0 m-0">
                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">

                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_sub" href="#">{{$event->venue}}</a>
                                        <a class="list_item_info_sub" href="#">{{$event->description}}</a>
                                        <a class="list_item_info_sub" href="#">{{date('d-m-Y', strtotime($event->date_time))}}</a>

                                       
                                    </div>
                                    <!-- <h5 class="item_box"> <i class="far fa-calendar-alt"></i>
                                            {{date('d-m-Y', strtotime($event->date_time))}}
                                        </h5> -->


                                </li>

                            </ul>
                        </div>
                        <div class="tab-pane" id="songsVideo">
                            <form action="#" class="mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            <ul class="list_items p-0 m-0">
                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="images/placeholder_1.jpg" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">Item Title</a>
                                        <a class="list_item_info_sub" href="#">Category</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="#"><i class="fas fa-play"></i></a>
                                        <a href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </li>

                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="images/placeholder_1.jpg" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">Item Title</a>
                                        <a class="list_item_info_sub" href="#">Category</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="#"><i class="fas fa-play"></i></a>
                                        <a href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </li>

                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="images/placeholder_1.jpg" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">Item Title</a>
                                        <a class="list_item_info_sub" href="#">Category</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="#"><i class="fas fa-play"></i></a>
                                        <a href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </li>

                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="images/placeholder_1.jpg" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">Item Title</a>
                                        <a class="list_item_info_sub" href="#">Category</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="#"><i class="fas fa-play"></i></a>
                                        <a href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </li>

                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="images/placeholder_1.jpg" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">Item Title</a>
                                        <a class="list_item_info_sub" href="#">Category</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="#"><i class="fas fa-play"></i></a>
                                        <a href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </li>

                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="images/placeholder_1.jpg" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">Item Title</a>
                                        <a class="list_item_info_sub" href="#">Category</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="#"><i class="fas fa-play"></i></a>
                                        <a href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </li>

                                <!-- Song ltem -->
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="images/placeholder_1.jpg" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">Item Title</a>
                                        <a class="list_item_info_sub" href="#">Category</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="#"><i class="fas fa-play"></i></a>
                                        <a href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </li>

                            </ul>
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