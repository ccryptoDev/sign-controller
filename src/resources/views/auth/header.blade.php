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
    <link href="/assets/css/header_custom.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/assets/media/logos/logo-letter-13.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    .container {
      display: flex;
      align-items: center;
      /* justify-content: flex-start; */
      justify-content: center;
      padding: 0 auto;
      /* margin: auto 0; /* Horizontally center the container */
      /* padding: auto 0; */ 
      /* width: 80%; /* Adjust as needed */
      /* height: 100vh;   */
    }

    .image-container {
      flex: 0 0 auto;
      margin-right: 20px; /* Adjust as needed */
    }

    .text-container {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .text-container p {
      margin: 0;
      line-height: 1.5; /* Adjust line height as needed */
    }
    </style>
    
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
                <div class="d-flex flex-column-fluid flex-column justify-content-between py-5 px-24 py-lg-10 px-lg-24">
                    <!--begin::Logo-->
                    <a href="#" class="text-center pt-4">
                       <img  src="/assets/media/logos/logo_new.png" class="login-header-logo-image" alt=""  /> 
                    </a>
                    <!--end::Logo-->

                    <!--begin::Aside body-->
                    <div class="d-flex flex-column-fluid flex-column px-3 px-lg-10">
                        <!--begin::Signin-->