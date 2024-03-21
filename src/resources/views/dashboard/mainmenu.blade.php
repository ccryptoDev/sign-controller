@include('dashboard.header')
    <!-- Aside Container -->
    <div class="d-flex flex-column-fluid flex-column justify-content-between px-24 py-lg-10 px-lg-24">
        <div class="page-logo text-center">
            <img  src="/assets/media/logos/logo_new.png" class="login-header-logo-image" alt=""  /> 
        </div>

        <!--begin::Aside body-->
        <div class="d-flex flex-column-fluid flex-column page-container main-dashbaord">
            <div class="text-center italic page-title">
                Main Menu
            </div>
            <div class="qrcode-form">
                <img src="/assets/media/mainmenu/qr_code.png" alt="Sign Controller QRcode">
                <div class="description">
                    <p>This is the main operations menu</p>
                    <a href="#">Click this link or QR Code for Help</a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-item"> 
                    <a href="{{route('message-menu')}}">Messages</a>
                </div>
                <div class="menu-item"> 
                    <a href="#">Schedules</a>
                </div>
                <div class="custom-item">
                    <div class="menu-item"> 
                        <a href="#">Turn Sign On/Off</a>
                    </div>
                    <div class="sign-status">
                        <p>Sign</p>
                        <p class="status">ON</p>
                    </div>
                </div>
                <div class="menu-item"> 
                    <a href="#">System Settings</a>
                </div>
                <div class="menu-item"> 
                    <a href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
        <!--end:: Aside body-->
    </div>
    <!-- end:: Aside Container -->
@include('dashboard.footer')
