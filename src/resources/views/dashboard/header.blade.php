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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/assets/media/logos/logo-letter-13.png" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .admin-library-btn {
            color: #ffffff;
            background-color: purple;
            border-color: purple;
        }
        .admin-library-btn:hover {
            background-color: rgb(116, 2, 116); /* or any darker shade of purple */
            color: #ffffff;
        }
        @media (max-width: 576px) {

            .custom-header{
                padding-inline: 10px !important;
            }
            .custom-header .page-title p{
                font-size: 8px !important;
                line-height: 100%;
            }
            .custom-header .page-title a{
                font-size: 8px !important;
                text-align: center;
            }
            .custom-header h1{
                font-size: 12px !important;
            }
            .custom-header .login-header-logo-image{
                width: 60px;
            }
        }

    </style>
</head>
