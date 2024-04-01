@include('dashboard.header')
<!-- Aside Container -->
<!-- full background -->
<style>
    /* .form-control {
        border: 1px solid #007bff;
    } */
</style>
<div class="fluid bg-white">
    <!-- page outer -->
    <div class="d-flex overflow-hidden">
        <div class="d-flex flex-column justify-content-betfween px-8 py-10 px-lg-24">
            <!-- custom header -->
            <div class="custom-header">
                <div class="page-logo">
                    <img src="/assets/media/logos/logo_new.png" class="login-header-logo-image" alt="" />
                </div>
                <div class="text-center italic page-title">
                    <h2>Choose a Message</h2>
                    <p>Search for a message by keyword, then use slider or thumbnails to choose an image, click on
                        middle image in the bluebox to choose</p>
                </div>
                <div class="qrcode-form">
                    <a href="#">Click for HELP</a>
                    <img src="/assets/media/mainmenu/qr_code.png" alt="Sign Controller QRcode">
                </div>
            </div>
            <!-- end: custom-header -->

            <!-- begin::Aside body -->
            <div class="d-flex flex-column-fluid flex-column px-16 page-container message-menu">
                <div class="main-menu">
                    <div class="search-item">
                        <label class="italic">Keywords: </label>
                        <input class="form-control search-input text-center" name="id-name" value="1002-35MPH"></input>
                    </div>
                    <div class="search-item">
                        <label class="italic">Search 1: </label>
                        <input class="form-control search-input text-center" name="keyword" id="firstSearch" ></input>
                    </div>
                </div>
            </div>
            <!-- end::Aside body -->
        </div>
    </div>
</div>
</div>
<div id="slickPanel">
    <!-- <div class="slick">
        @foreach ($images as $image)
        <div>
            <span>
                <img src="{{ asset('assets/media/signmessage/' . $image) }}" alt="image" />
            </span>
        </div>
        @endforeach
        
    </div> -->
</div>
<div class="fluid bg-white">
    <!-- page outer -->
    <div class="d-flex flex-column-fluid flex-column px-16 page-container message-menu">
        <div class="main-menu">
            <div class="search-item">
                <label class="">Search 2: </label>
                <input class="form-control search-input text-center" name="id-name" id="secondSearch" ></input>
            </div>
        </div>
    </div>
    <div class="d-flex overflow-hidden">
        <div class="d-flex flex-column justify-content-betfween px-8 py-lg-10 px-lg-24">
            <div class="d-flex flex-column-fluid flex-column px-16 page-container message-menu">
                <!-- <div class="main-menu">
                    <div class="search-item">
                        <label class="visible-hidden">Search: </label>
                        <input class="search-input text-center" name="id-name" id="secondSearch" ></input>
                    </div>
                </div> -->
                <ul class="thumbnail-list" id="thumbnail-list">
                    <!-- @foreach ($images as $image)
                    <li>
                        <span>
                            <img src="{{ asset('assets/media/signmessage/' . $image) }}" alt="image" />
                        </span>
                    </li>
                    @endforeach -->
                </ul>               
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid flex-column px-16 page-container message-menu">
        <div class="main-menu">
            <div class="search-item">            
                <button class="btn btn-danger mt-0 d-inline mr-3 mt-10" type="button" id="send">Send</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/messagesign.js"></script>
<script src="/assets/js/redirect.js"></script>
<script>
    var currentIndex = 0;
    var images = {!! json_encode($images) !!};
    
    $("#send").on("click", function () {
        event.preventDefault();

        if (images[currentIndex]) {
            $.ajax({
                url : '/send-image-socket',
                type : "POST",
                data : {
                    imageName: images[currentIndex],
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(res){
                    if (res.success){
                        console.log(res);
                        // toastr.success('Saved the message successfully!');
                    }
                    else{
                        // toastr.error("Something went wrong, please try again.");    
                    }
                },
                error : function(err){
                    // toastr.error("Please refresh your browser");
                }
            })
        } else {
            // toastr.error("Please select image.");
        }
    })

    var secondSearch  = function () {
        var value1 = $("#firstSearch").val().toLowerCase().trim(), value2 = $("#secondSearch").val().toLowerCase().trim();
        var secondSelectedImages = images.filter(image => image.toLowerCase().trim().includes(value1) && image.toLowerCase().trim().includes(value2));

        $("#thumbnail-list").html('');
        for (var i = 0; i < secondSelectedImages.length; i++) {

            var component = `<li><span><img src="{{ asset('assets/media/signmessage/${secondSelectedImages[i]}' ) }}" alt="image" /></span></li>`;
            $("#thumbnail-list").append(component);

        }

        addClassFunction();
    }

    $("#firstSearch").on('keyup', function(e){
        
        var value = $("#firstSearch").val().toLowerCase().trim();
        var firstSelectedImages = images.filter(image => image.toLowerCase().trim().includes(value));

        // console.log(firstSelectedImages);

        $("#slickPanel").html('<div class="slick" id="slick"></div>');
        for (var i = 0; i < firstSelectedImages.length; i++) {

            var component = `<div><span><img src="{{ asset('assets/media/signmessage/${firstSelectedImages[i]}') }}" alt="image" /></span></div>`;
            $("#slick").append(component);

        }

        slickFunction();

        secondSearch();
    });

    $("#secondSearch").on('keyup', function(e){

        secondSearch();        

    });


</script>
</body>

</html>