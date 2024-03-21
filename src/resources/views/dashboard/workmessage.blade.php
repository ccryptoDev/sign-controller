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
            Work With a Message
        </div>
        <div class="pt-6"></div>
        <div class="d-flex px-12 text-center">
            <div style="flex-grow: 1; align-self: center;">
                <img src="/assets/media/logos/logo_new.png" class="login-header-logo-image"  style="width: 100%; height: 100%;"alt="logo_image"/>
            </div>
            <div style="flex-grow: 7; align-self: center; direction: row; align-items: center;" class="d-flex;">
                <div style="align-self:center;">This menu allows the user to retrieve or edit existing </div>
                <p style="align-self:center;">messages, make new ones or send to sign </p>
            </div>
            <div style="flex-grow:2; align-self: center;">
                <img src="/assets/media/mainmenu/qr_code.png" style="width: 40px; height:50px;" alt="qr_code_image"/>
            </div>
        </div>
        <div class="ellipse-container py-3 pt-12">
            <div class="ellipse-border italic text-center font-size-13pt" style="width: 360px; background-color: blue; border-color: blue;">  <a href="#" style ="color: white; text-decoration: none; font-weight: bold;">Send a Message to the Sign</a></div>  
        </div>
        <div class="ellipse-container py-3">
            <div class="ellipse-border italic text-center font-size-13pt" style="width: 360px; background-color: blue; border-color: blue;">  <a href="#" style ="color: white; text-decoration: none; font-weight: bold;">Edit a Message</a></div>  
        </div>
        <div class="ellipse-container py-3">
            <div class="ellipse-border italic text-center font-size-13pt" style="width: 360px; background-color: blue; border-color: blue;">  <a href="#" style ="color: white; text-decoration: none; font-weight: bold;">Copy a Message</a></div>  
        </div>
        <div class="ellipse-container py-3">
            <div class="ellipse-border italic text-center font-size-13pt" style="width: 360px; background-color: blue; border-color: blue;">  <a href="#" style ="color: white; text-decoration: none; font-weight: bold;">Delete a Message</a></div>  
        </div>
        <div class="ellipse-container py-3">
            <div class="ellipse-border italic text-center font-size-13pt" style="width: 360px; background-color: blue; border-color: blue;">  <a href="#" style ="color: white; text-decoration: none; font-weight: bold;">Upload a Message</a></div>  
        </div>
        <div class="ellipse-container py-3">
            <div class="ellipse-border italic text-center font-size-13pt" style="width: 360px; background-color: blue; border-color: blue;">  <a href="#" style ="color: white; text-decoration: none; font-weight: bold;">Download a Message</a></div>  
        </div>
        <div class="ellipse-container py-3">
            <div class="ellipse-border italic text-center font-size-13pt" style="width: 360px; background-color: blue; border-color: blue;">  <a href="#" style ="color: white; text-decoration: none; font-weight: bold;">Return to Previous Screen</a></div>  
        </div>
    </body>
</html>
