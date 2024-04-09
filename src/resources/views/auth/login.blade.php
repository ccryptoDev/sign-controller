@include('auth.header')
    <div class="login-form login-signin py-2">
        <!--begin::Form-->
        <form class="form" id="kt_login_signin_form" action="/login" method="POST">
            @csrf
            @if(session('success'))
                <div class="alert alert-success">
                    <span>Please verify your email address</span>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <!--begin::Title-->
            <div class="text-center pt-8 pb-8">
                <h2 class="font-weight-bolder text-dark page-title">Sign In</h2>
                <!-- <span class="text-muted font-weight-bold font-size-h4">Or <a href="{{route('register')}}"
                        class="text-primary font-weight-bolder" id="kt_login_signup">Create An
                        Account</a></span> -->
            </div>
            <!--end::Title-->

            <!--begin::Form group-->
            <div class="form-group">
                <label class="font-size-h6 font-weight-bolder text-dark">User ID or email</label>
                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                    type="text" name="username_or_email" autocomplete="off" required oninput="setEmailTouched()" value="{{old('username_or_email')}}"/>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group">
                <div class="mt-n5">
                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                </div>

                <input 
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                    type="password" 
                    name="password" 
                    autocomplete="off" 
                    required 
                    oninput="setPasswordTouched()" 
                />
                <a href="{{ route('forgot') }}"
                    class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5 d-flex justify-content-end"
                    id="kt_login_forgot">
                    Forgot Password ?
                </a>
            </div>
            <!--end::Form group-->

            <!--begin::Action-->
            <div class="text-center pt-2">
                <button id="kt_login_signin_submit"
                    type="submit"
                    class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign
                    In</button>
            </div>
            <!--end::Action-->
        </form>
        <!--end::Form-->
    </div>
@include('auth.footer')