@extends("artist.layouts.master")
@section("meta")
<title>Events | Soul Entertainment</title>
@endsection
@include('artist.partials.validation_styles')
@section("content")
<main class="d-flex flex-column justify-content-start flex-grow-1">

<!-- Start -->
<div class="section_space d-flex flex-column justify-content-center ">
    <div class="container">
    @include('admin.partials._messages')
        <div class="row justify-content-center">
            <div class="col-md-12 mb-5 text-center">
                <h3 class="section_heading section_heading_divider section_heading_divider_center">Upload Event</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="create_event" class="form" action="{{route('artist-events.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row mb-3">
                        <label for="eventImage" class="col-sm-3 col-form-label required">Event Image</label>
                        <div class="col-sm-9 {{ $errors->has('image') ? 'has-error' : '' }}">
                            <input class="form-control" type="file" name="image" id="image">
                            <span class="text-danger">{{ $errors->first('image') }}</span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eventName" class="col-sm-3 col-form-label required">Event Name</label>
                        <div class="col-sm-9 {{ $errors->has('name') ? 'has-error' : '' }}">
                          <input type="text" class="form-control" name="name" id="name" value="">
                          <span class="text-danger">{{ $errors->first('name') }}</span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eventVenue" class="col-sm-3 col-form-label required">Event Venue</label>
                        <div class="col-sm-9 {{ $errors->has('venue') ? 'has-error' : '' }}">
                          <input type="text" class="form-control" id="venue" name="venue" value="">
                          <span class="text-danger">{{ $errors->first('venue') }}</span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eventDate" class="col-sm-3 col-form-label required">Event Date</label>
                        <div class="col-sm-9 {{ $errors->has('date') ? 'has-error' : '' }} ">
                          <input type="date" class="form-control" name="date" id="date" value="">
                          <span class="text-danger">{{ $errors->first('date') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eventTime" class="col-sm-3 col-form-label required">Event Time</label>
                        <div class="col-sm-9 {{ $errors->has('time') ? 'has-error' : '' }}">
                          <input type="time" class="form-control" name="time" id="time" value="">
                          <span class="text-danger">{{ $errors->first('time') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eventDescription" class="col-sm-3 col-form-label">Event Description (optional)</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" name="description" id="eventDescription"></textarea>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-9 offset-3">
                            <!-- <button type="submit" class="btn btn_light">Upload Events</button> -->
                            <a href="javascript:void(0);" onclick="return validated()" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Upload Event</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<!-- End -->

</main>

@endsection

@section('scripts')

<script>
    // $(document).ready(function() {
    //   $("#article_add_form").validate();
    // });
    function validated() {

        $("#create_event").validate({
            ignore: ".note-editor *",
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            rules: {
               
                image: {
                    required: true,
                },
                name: {
                    required: true,
                },
                venue: {
                    required: true,
                },
                date: {
                    required: true,
                },
                time: {
                    required: true,
                }

            },
            messages: {
                image: {
                    required: "Please select image",
                },
        
                name: {
                    required: "Please enter event name",
                },
                venue: {
                    required: "Please enter event venue",
                },
                date: {
                    required: "Please select event date",
                },
                time: {
                    required: "Please select event time",
                }
            }

        

        });
        if ($('#create_event').valid()) // check if form is valid
        {

            $("#create_event").submit();
        } else {
            return false;
        }
    }

    
</script>
@endsection