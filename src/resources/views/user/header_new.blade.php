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

            .mode{
                gap: 10px;
            }
            .mode button{
                margin-bottom: 10px;
                padding: 8px 16px;
            }

            @media (max-width: 468px) {
                .mode{
                    align-items: flex-start;
                    /* justify-content: space-between !important; */
                    gap: 5px;
                    align-items: center;
                }
                .mode button{

                    font-size: 12px;

                    text-align: center;

                }
            }

            @media (max-width: 568px) {


            .edit-msg-single-inp-wrapper{
                /* min-width: 100%; */
                justify-content: center;
                margin-bottom: 10px;
                margin-right: 0 !important;

                input{
                    width:38px !important;
                    height: 38px;
                }
                label{
                    font-size: 10px !important;
                }
            }
        }

            .btn-custom-sm {
                padding: -0.5rem 3rem !important;  /* Default padding */
                font-size: 14px !important;    /* Default font size */
            }

            /* Smaller screens (tablets & large phones) */
            @media (max-width: 768px) {
                .btn-custom-sm {
                    padding: 4px 8px;
                    font-size: 13px;
                }
            }

            /* Extra small screens (phones) */
            @media (max-width: 480px) {
                .btn-custom-sm {
                    padding: 3px 6px;
                    font-size: 12px;
                }
            }

        </style>
    </head>
    <body  id="kt_body"class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading"  >


