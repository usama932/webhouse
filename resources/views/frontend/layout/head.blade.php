<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Web House</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/frontend/imges/logo.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/lib/bootstrap/css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/respon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/lib/fontawesome/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/lib/owl/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/lib/owl/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/lib/animate.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="assets/lib/aos/aos.css">  -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <?php
    $general_setting = App\Models\GeneralSetting::first();
    header("Content-type: text/css; charset: UTF-8");

    $bgColor = $general_setting ? $general_setting->bg_color : 'black';
    $textColor = $general_setting ? $general_setting->text_color : '';
    ?>
    <style>
        body{
            background-color: <?php echo $bgColor; ?> !important;
            color: <?php echo $textColor; ?> 
        }
    </style>
</head>
