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
                <form action="{{ route('system-settings.update') }}" method="POST" class="container p-4">
                    @csrf

                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">System Settings</h5>
                        </div>
                        <div class="card-body">

                            <!-- General Settings -->
                            <h6 class="text-muted mb-3">General Settings</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Number of Messages to Keep:</label>
                                    <input type="number" class="form-control" name="num_messages_to_keep"
                                        value="{{ old('num_messages_to_keep', $screenSettings['num_messages_to_keep'] ?? '') }}" required>
                                </div>
                            </div>

                            <!-- Screen Settings -->
                            <h6 class="text-muted mt-4">Screen Settings</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Screen Pixels High:</label>
                                    <input type="number" class="form-control" name="screen_pixels_high"
                                        value="{{ old('screen_pixels_high', $screenSettings['screen_pixels_high'] ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Screen Pixels Wide:</label>
                                    <input type="number" class="form-control" name="screen_pixels_wide"
                                        value="{{ old('screen_pixels_wide', $screenSettings['screen_pixels_wide'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Font Pixels High:</label>
                                    <input type="number" class="form-control" name="font_pixels_high"
                                        value="{{ old('font_pixels_high', $screenSettings['font_pixels_high'] ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Font Pixels Wide:</label>
                                    <input type="number" class="form-control" name="font_pixels_wide"
                                        value="{{ old('font_pixels_wide', $screenSettings['font_pixels_wide'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Seconds To Show:</label>
                                    <input type="number" class="form-control" name="seconds_to_show"
                                        value="{{ old('seconds_to_show', $screenSettings['seconds_to_show'] ?? '') }}" required>
                                </div>
                            </div>

                            <!-- Layout Settings -->
                            <h6 class="text-muted mt-4">Layout Settings</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Top Blank Rows:</label>
                                    <input type="number" class="form-control" name="top_blank_rows"
                                        value="{{ old('top_blank_rows', $screenSettings['top_blank_rows'] ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Blank Lines Bottom:</label>
                                    <input type="number" class="form-control" name="blank_lines_bottom"
                                        value="{{ old('blank_lines_bottom', $screenSettings['blank_lines_bottom'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Between 1st & 2nd Row:</label>
                                    <input type="number" class="form-control" name="between_1st_2nd_row"
                                        value="{{ old('between_1st_2nd_row', $screenSettings['between_1st_2nd_row'] ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Between 2nd & 3rd Row:</label>
                                    <input type="number" class="form-control" name="between_2nd_3rd_row"
                                        value="{{ old('between_2nd_3rd_row', $screenSettings['between_2nd_3rd_row'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary px-4">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </form>


                {{-- <div class="menu-item">
                    <a href="{{route('main-menu')}}">Return to Previous Screen</a>
                </div> --}}
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

@if (!$isAdmin)
    <script>
        $('input').prop('readonly', true);
    </script>
@endif


