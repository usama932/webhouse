@php $setting =\App\Setting::pluck('value','name')->toArray(); @endphp
    <!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="@isset($setting['favicon']) {{ asset('uploads/'.$setting['favicon']) }}@endisset" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="{{asset("frontend/css/fontawesome_all.min.css")}}" rel="stylesheet">
    <link href="{{asset("frontend/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- MAIN SITE STYLE SHEETS -->
    <link href="{{asset("frontend/css/login.css")}}" rel="stylesheet">
    @yield("meta")


</head>

<body class="d-flex flex-column min-vh-100 justify-content-center justify-content-md-between">


<main class="enter_view d-flex flex-column justify-content-center min-vh-100 flex-grow-1">

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-7 mb-5">

                <div class="enter_view_logo text-center">
                    <img alt="" src="@isset($setting['logo']) {{ asset('uploads/'.$setting['logo']) }}@endisset" width="150" />
                </div>

            </div>

            @yield("content")

        </div>
    </div>

</main>

<!-- Js -->
<script src="{{asset("frontend/js/jquery-3.6.0.min.js")}}"></script>
<script src="{{asset("frontend/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("frontend/js/main.js")}}"></script>

{{--<script>--}}
{{--    $("a").click(function(){--}}
{{--        var formId = $(this).attr('data-formID');--}}
{{--        if(formId){--}}
{{--            $(this).closest("form").addClass('d-none');--}}
{{--            $('#'+formId+'').removeClass('d-none');--}}
{{--            $('#'+formId+'').addClass('d-block');--}}
{{--        };--}}
{{--    });--}}
{{--</script>--}}

</body>

</html>
