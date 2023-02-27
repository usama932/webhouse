@extends("artist.layouts.master")
@section("meta")
<title>Events | Soul Entertainment</title>
@endsection
@section("content")

<main class="d-flex flex-column justify-content-start flex-grow-1">

    <!-- Start -->
    <div class="section_space d-flex flex-column justify-content-center ">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Start -->
                <div class="col-md-12 ">

                    <div class="row justify-content-md-between">
                        <div class="col-md-12 d-flex align-items-center justify-content-between mb-5">
                            <h3 class="section_heading section_heading_divider">Events</h3>
                            <a href="{{route('artist-events.create')}}" data-bs-toggle="tooltip" title="Add New Event" class="ms-4 btn_plus"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>


                    <div class="row g-4">
                        @foreach($data as $event)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="item_box">
                                <a href="{{route('artist.eventDetail',$event->id)}}" class="stretched-link"></a>
                                <div class=" item_box_thumb_link">
                                    <img alt="" src="{{ asset("uploads/image/$event->image") }}" />
                                </div>

                                <!-- <a href="" class="btn_del"><i class="far fa-trash-alt"></i></a> -->
                                <a href="javascript:;" class="btn_del" data-id="{{ $event->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </a>

                         
                                    <h5 class="item_box">  <i class="far fa-calendar-alt"></i>
                                          {{date('d-m-Y', strtotime($event->date_time))}}</h5>
                              
                                          <h5 class="item_box_title">{{$event->name}}</h5>
                                
                                <div class="item_box_content">
                                    
                                </div>

                                
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
                <!-- End -->

            </div>
        </div>
    </div>



    <!-- End -->

</main>

@endsection


@section("scripts")
<script>
    $(document).on('click', '.btn_del', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
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
                        '_method': 'DELETE'
                    },
                    url: "{{url('artist/artist-events/')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Deleted!", response.msg, "success");
                    location.reload();





                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
@endsection