<html>
    <head>
        <base href="../../../../">
        <meta charset="utf-8" />        
        <meta name="description" content="Login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link href="/assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />        
        <link rel="shortcut icon" href="/assets/media/logos/logo-letter-13.png" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- <meta https-equiv="X-UA-Compatible" content="ie=edge" /> -->
        <link rel="stylesheet" href="/assets/css/localmessage.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>        
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class = "bg-white">
        <div class="text-center pt-6" id="choose-message">
            Choose a Message
        </div>
        <div class="pt-6"></div>
        <div class="d-flex px-12 text-center">
            <div class="login-header-logo-image">
                <img src="/assets/media/logos/logo_new.png" alt="logo_image"/>
            </div>
            <div class="filter-description">
                <div>Search for a message by keyword, then use slider or thumbnails to 
                choose an image, click on middle image in the blue box, to choose:</div>
            </div>
            <div class= "qr-code-help">
                <img src="/assets/media/mainmenu/qr_code.png"  alt="qr_code_image"/>
            </div>
        </div>
        <div class="py-3 search-box">
            <div class = "flex-1"></div>
            <div class="d-flex flex-1">
                <label> Search: </label> 
            </div>                       
            <input class="filter-input" name="keyword" value="Speed limit"></input>            
            <div class="flex-2"></div>            
        </div>
        <div class="py-3 d-flex keyword-box">
            <div class = "flex-1"></div>                      
            <div class = "d-flex flex-1">
                <label class="search-hidden"> Search: </label> 
            </div>            
            <label class="text-center searched-keyword">1002-35MPH</label>
            <div class="flex-2"></div>            
        </div>

        <div class="slick">
            <div>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 15 </p>
                </span>
            </div>
            <div>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 25 </p>
                </span>
            </div>
            <div>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 35 </p>
                </span>
            </div>
            <div>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 45 </p>
                </span>
            </div>
            <div>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 55 </p>
                </span>
            </div>
            <div>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 65 </p>
                </span>
            </div>
        </div>

        <div class="py-3 d-flex keyword-box" >
            <div class="flex-1"></div>                      
            <div class="d-flex flex-1">
                <label class="search-hidden"> Search: </label> 
            </div>            
            <label class="text-center searched-keyword-2">Keywords, Speed Limit 35</label> 
            <div class="flex-3"></div>            
        </div>

        <ul class="thumbnail-list">
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 5 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 10 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 15 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 20 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 25 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 30 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 35 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 40 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 45 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 50 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 55 </p>
                </span>
            </li>
            <li>
                <span>
                    <p class="speed"> speed</p>
                    <p class="limit"> limit </p>
                    <p class="number"> 60 </p>
                </span>
            </li>
                   
        </ul>
        <script src="/assets/js/localmessage.js"></script>           
    </body>
</html>
