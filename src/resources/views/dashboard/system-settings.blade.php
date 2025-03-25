@include('dashboard.header')
    <!-- Aside Container -->
    <div class="d-flex flex-column-fluid flex-column justify-content-between px-8 px-md-12 px-lg-24 py-10 px-lg-24">

        <!-- custom header  -->
        <x-header title="System Settings" />

        <div class="px-4">
            <div class="d-block d-sm-none text-center italic page-title">
                <h2>System Settings</h2>
                <p></p>
            </div>
        </div>
        <!-- end: custom-header -->

        <!--begin::Aside body-->
        <div class="d-flex flex-column-fluid flex-column px-4 px-md-16 page-container message-menu">
            <div class="main-menu">
                <form action="{{ route('system-settings.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Number of Messages to Keep:</label>
                        <input type="number" class="form-control" name="num_messages_to_keep"
                            value="{{ old('num_messages_to_keep', $messagesToKeep) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <div class="menu-item">
                    <a href="{{route('main-menu')}}">Return to Previous Screen</a>
                </div>
            </div>
        </div>
        <!--end:: Aside body-->
    </div>
    <!-- end:: Aside Container -->
@include('dashboard.footer')

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>
@endif

@if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif


