@include('dashboard.header')
    <!-- Aside Container -->
    <div class="d-flex flex-column-fluid flex-column justify-content-between px-8 px-md-12 px-lg-24 py-10 px-lg-24">

        <!-- custom header  -->
        <x-header title="Main Menu" />

        <div class="px-4">
            <div class="d-block d-sm-none text-center italic page-title">
                <h2>Main Menu</h2>
                <p></p>
            </div>
        </div>
        <!-- end: custom-header -->

        <!--begin::Aside body-->
        <div class="d-flex flex-column-fluid flex-column px-4 px-md-16 page-container message-menu">
            <div class="main-menu">
                <h4>Coming Soon</h4>
                <p>This page is still on Development.</p>
                <div class="menu-item">
                    <a href="{{route('main-menu')}}">Return to Previous Screen</a>
                </div>
            </div>
        </div>
        <!--end:: Aside body-->
    </div>
    <!-- end:: Aside Container -->
@include('dashboard.footer')
