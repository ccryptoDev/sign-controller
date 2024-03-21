<html>
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
    </head>
    <body class = "bg-white">
        <div class="text-center pt-6" style="font-weight: bold; font-style: italic; font-size: 15pt;">
            Choose a Message
        </div>
        <div class="pt-6"></div>
        <div class="d-flex px-12 text-center">
            <div style="flex-grow: 1; align-self: center;">
                <img src="/assets/media/logos/logo_new.png" class="login-header-logo-image"  style="width: 100%; height: 100%;"alt="logo_image"/>
            </div>
            <div style="flex-grow: 7; align-self: center; direction: row; align-items: center;" class="d-flex;">
                <div style="align-self:center;">Search for a message by keyword, then use slider or thumbnails to </div>
                <p style="align-self:center;">choose an image, click on middle image in the blue box, to choose:</p>
            </div>
            <div style="flex-grow:2; align-self: center;">
                <img src="/assets/media/mainmenu/qr_code.png" style="width: 40px; height:50px;" alt="qr_code_image"/>
            </div>
        </div>
        <div class="py-3" style="display:flex; ">
            <div style="flex-grow: 1;"></div>
            <label style="flex-grow: 1"> Search: </label>
            <div style="flex-basis:7;">
                <input style="width: 80vw, height: 20px"></input>
            </div>
            <div style="flex-grow:1;"></div>
            
        </div>
        
    </body>
</html>
