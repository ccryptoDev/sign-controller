@include('dashboard.header')
    <!-- Aside Container -->
    <div class="d-flex flex-column-fluid flex-column justify-content-between px-8 px-md-12 px-lg-24 py-2 px-lg-24">

        <!-- custom header  -->
        <x-header title="Main Menu" description="" />

        <div class="px-4">
            <div class="d-block d-sm-none text-center italic page-title">
                <h2>Main Menu</h2>
                <p></p>
            </div>
        </div>
        <!-- end: custom-header -->

        <!--begin::Aside body-->
        <div class="d-flex flex-column-fluid flex-column mt-4 px-4 px-md-16 page-container message-menu">
            <div class="main-menu">
                <div class="menu-item">
                    <a href="{{route('send-to-sign')}}">Messages</a>
                </div>
                <div class="menu-item">
                    <a href="{{route('schedules')}}">Schedules</a>
                </div>
                <div class="custom-item">
                    <div class="menu-item">
                        <a href="{{route('turn-sign')}}">Turn Sign On/Off</a>
                    </div>
                    <div class="sign-status">
                        <span>Sign&nbsp;</span><span class="status"> ON</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="{{route('system-settings')}}">System Settings</a>
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
