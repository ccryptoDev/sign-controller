<div class="custom-header px-4 px-md-16 m-1">
    <div>
        <h1 style="color: #4A41C2">{{ $title }}</h1>
    </div>
    <div class=" text-center italic page-title">
        <p class="text-center">{{ $description }}</p>
        @if(!empty($helpLink))
        <a href="#" style="color: #D30505">(Click Here for Help)</a>
        @endif
    </div>
    <div class="">
        <img src="/assets/media/logos/logo_new.png" class="login-header-logo-image m-3" alt="" />
    </div>
</div>

