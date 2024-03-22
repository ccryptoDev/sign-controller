@include('dashboard.header')
    <!-- Aside Container -->
    <div class="d-flex flex-column justify-content-between px-8 py-lg-10 px-lg-24">

        <!-- custom header  -->
        <div class="custom-header">
            <div class="page-logo">
                <img  src="/assets/media/logos/logo_new.png" class="login-header-logo-image" alt=""  /> 
            </div>
            <div class="text-center italic page-title">
                <h2>Work with a Message</h2>
                <p>This menu allows the user to retrieve or edit existing messages, make new ones or send to the sign</p>
            </div>
            <div class="qrcode-form">
                <a href="#">Click for HELP</a>
                <img src="/assets/media/mainmenu/qr_code.png" alt="Sign Controller QRcode">
            </div>
        </div>
        <!-- end: custom-header -->

        <!--begin::Aside body-->
        <div class="d-flex flex-column-fluid flex-column px-16 page-container message-menu">
            <h1>{{ text }}</h1>
        </div>
        <!--end::Aside body-->
    </div>
    <!-- end:: Aside Container -->
    
@include('dashboard.footer')
