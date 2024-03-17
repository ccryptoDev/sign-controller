<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../../">
    <meta charset="utf-8" />
    <title>{{config('app.name')}}</title>
    <meta name="description" content="Login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="/assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/assets/media/logos/logo-letter-13.png" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="/assets/css/splash_header_custom.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">    
</head>

<body class="fluid bg-white">
    <!-- <div class="d-flex flex-column flex-root bg-white"> -->
    <div class="fluid bg-white">
        <!--begin::Login-->
        <!-- <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
            id="kt_login"> -->
        <div class="fluid bg-white"
            >
            <!--begin::Aside-->
            <div class="d-flex overflow-hidden">
                <!--begin: Aside Container-->
                <div class="d-flex flex-column-fluid flex-column justify-content-between py-10 px-3 py-lg-10 px-lg-3">
                    <!--begin::Logo-->
                    <a href="#" class="text-center pt-16">
                       <img src="/assets/media/logos/logo_new.png" id = "splash-header-logo-image" class="w3-animate-fading splash-header-logo-image" alt="" /> 
                    </a>
                    <!--end::Logo-->

                    <!--begin::Aside body-->
                    <div class="d-flex flex-column-fluid flex-column pt-6 px-7 px-lg-10">
                        <!--begin::Signin-->