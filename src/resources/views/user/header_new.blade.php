<!DOCTYPE html>
<html lang="en" >
    <!--begin::Head-->
    <head>
        <base href="">
        <meta charset="utf-8"/>
        <title>{{config('app.name')}}</title>
        <meta name="description" content="User Panel"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <!--end::Fonts-->
        <!--begin::Page Vendors Styles(used by this page)-->
        <link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/message.css" rel="stylesheet" type="text/css" />
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="/assets/media/logos/logo-letter-13.png"/>

        <style>
            #wrapperLed, #pixelCanvas {
                margin: 0px;
                /* border: 1px solid #ddd; */
                padding-bottom: 0px;
                /* position: absolute; */
                left: 0;
            }

            .screen-layer-highlight {
                border: 2px solid red;
                /* padding: 0.5px; */
                border-radius: 8px;
                transition: 0.3s ease-in-out;
            }

            .image-highlight {
                border: 4px solid #4A41C2;
                padding: 0.5px;
                border-radius: 1px;
                transition: 0.3s ease-in-out;
            }

            .hidden-input {
                position: absolute;
                left: -9999px;  /* Moves it off-screen */
                width: 1px;
                height: 1px;
                border: none;
                outline: none;
                background: transparent;
            }

            .mode {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .mode button {
            padding: 6px 10px;
            font-size: 13px;
            margin: 2px;
            flex: 0 1 auto;
            white-space: nowrap;
        }

        .edit-msg-single-inp-wrapper {
            display: flex;
            align-items: center;
            margin-right: 10px;
            flex: 1 1 auto;
        }

        .edit-msg-single-inp-wrapper input {
            width: 38px;
            height: 38px;
            text-align: center;
        }

        .edit-msg-single-inp-wrapper label {
            font-size: 10px;
            margin-left: 5px;
        }

        @media (max-width: 876px) {

        .mode {
            overflow-x: auto;
            flex-wrap: nowrap;
            gap: 7px;
            justify-content: center;
            padding: 0 5px;
            -webkit-overflow-scrolling: touch;
        }

        .mode::-webkit-scrollbar {
            display: none; /* Hide scrollbar for clean look */
        }

        .mode .alignment-btns button,
        .mode button {
            padding: 6px 10px !important;
            border-radius: 3px !important;
            font-size: 8px;
            flex-shrink: 0;
        }
        .mode .alignment-btns{
            display: flex;
            align-items: center;
            gap: 0 !important;
        }

        .mode .alignment-btns button{
            font-size: 12px;
            /* border-radius: 0px !important; */
            max-height: 24px;
            max-width: 24px;
        }
        .mode .edit-msg-single-inp-wrapper{
            max-width: auto !important;
            max-width:75px !important;
        }
        .mode .alignment-btns button i{
            font-size: 8px;
            max-height: 15px
        }

        .edit-msg-single-inp-wrapper {
            flex-shrink: 0;
            margin-right: 3px;
            gap: 4px !important;
        }

        }

        /* ---- Mobile Fix (Force Single Row) ---- */
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
            .mode {
                overflow-x: auto;
                flex-wrap: nowrap;
                gap: 1px;
                justify-content: center;
                padding: 0 5px;
                -webkit-overflow-scrolling: touch;
            }

            .mode::-webkit-scrollbar {
                display: none; /* Hide scrollbar for clean look */
            }

            .mode .alignment-btns button,
            .mode button {
                padding: 2px 4px !important;
                border-radius: 3px !important;
                font-size: 5px;
                flex-shrink: 0;
            }
            .mode .alignment-btns{
                display: flex;
                align-items: center;
                gap: 0 !important;
            }

            .mode .alignment-btns button{
                font-size: 8px;
                /* border-radius: 0px !important; */
                max-height: 15px;
                max-width: 15px;
            }
            .mode .edit-msg-single-inp-wrapper{
                max-width: auto !important;
                max-width:25px !important;
            }
            .mode .alignment-btns button i{
                font-size: 8px;
                max-height: 15px
            }

            .edit-msg-single-inp-wrapper {
                flex-shrink: 0;
                margin-right: 3px;
                gap: 4px !important;
            }

            .edit-msg-single-inp-wrapper input {
                width: 20px !important;
                height: 16px;
                padding: 0 !important;
                font-size: 7px;
            }

            .edit-msg-single-inp-wrapper label {
                font-size: 5px !important;
            }
            .edit-message-card-body .message-inform label{
                font-size: 12px;
            }
            .edit-message-card-body .message-inform input {
                font-size: 12px;
                width: 90%;
            }
            .edit-message-card-body .message-inform input:placeholder{
                font-size: 12px;
            }
        }


            /* Extra small screens (phones) */
            @media (max-width: 480px) {
               .edit-message-card-body{
                padding-top: 0 !important;
                padding-bottom: 10px !important;
               }
               .image-highlight {
                border: 2px solid #4A41C2;
               }
            }

        </style>
    </head>
    <body  id="kt_body"class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading"  >


