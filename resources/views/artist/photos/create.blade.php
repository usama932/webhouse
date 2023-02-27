
@extends("artist.layouts.master")
@section("meta")
<title>Photos | Soul Entertainment</title>
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
                <h3 class="section_heading section_heading_divider section_heading_divider_center">Upload Photo</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
            <form id="upload_photo" action="{{route('artist-images.store')}}" method="POST" class="form" enctype="multipart/form-data">
                 @csrf

                    <div class="row mb-3">
                        <label for="photo" class="col-sm-3 col-form-label required">Select photo</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="photoDescription" class="col-sm-3 col-form-label">photo Description (optional)</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" id="photoDescription" name="description"></textarea>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-9 offset-3">
                            <!-- <button type="submit" class="btn btn_light">Upload Photo</button> -->
                            <a href="javascript:void(0);" onclick="return validated()" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Upload Video</a>
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

        $("#upload_photo").validate({
            ignore: ".note-editor *",
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            rules: {
               
                image: {
                    required: true,
                }


            },
            messages: {
                image: {

                    required: "Please select image",
                }
              
            }

        

        });
        if ($('#upload_photo').valid()) // check if form is valid
        {

            $("#upload_photo").submit();
        } else {
            return false;
        }
    }

    
</script>
@endsection