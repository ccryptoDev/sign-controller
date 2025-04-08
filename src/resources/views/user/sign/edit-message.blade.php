@include('user.header_new')
<div class="d-flex flex-column justify-content-between px-8 py-2 px-lg-24">
    <!-- custom header  -->
    <x-header title="Messages" description="This menu allows the user to retrieve or create messages" helpLink="#" />

    <div class="px-4">
        <div class="d-block d-sm-none text-center italic page-title">
            <h2>MESSAGES</h2>
            <p>This menu allows the user to retrieve or create messages</p>
        </div>
    </div>
    <!-- end: custom-header -->

    <div class="container">
        <div class="row">
            <div class="card card-custom card-stretch">
                <input
                    class="form-control signalMessage hidden-input"
                    name="message_1"
                    id="message_1"
                    value="{{isset($message_data->draw_mode) && $mode == 'edit' && $message_data->draw_mode == 0 ? (isset($message_data->message[0]) ? $message_data->message[0] : '') : '' }}"
                >
                <input
                    class="form-control signalMessage hidden-input"
                    name="message_2"
                    id="message_2"
                    value="{{isset($message_data->draw_mode) && $mode == 'edit' && $message_data->draw_mode == 0 ? (isset($message_data->message[1]) ? $message_data->message[1] : '') : '' }}"
                >
                <input
                    class="form-control signalMessage hidden-input"
                    name="message_3"
                    id="message_3"
                    value="{{isset($message_data->draw_mode) && $mode == 'edit' && $message_data->draw_mode == 0 ? (isset($message_data->message[2]) ? $message_data->message[2] : '') : '' }}"
                >
                <div class="card-header mb-0 col-md-12 flex-column message-inform-form {{ (isset($mode) && $mode == 'create') ? '' : 'd-none' }}"> <!-- mesage name and keywords -->
                    <div class="message-inform"> <!-- name -->
                        <label for="message-name">Name</label>
                        <div>
                            <input class="form-control"
                                name="message_name"
                                id="message_name"
                                placeholder="Input the message name"
                                value="{{ isset($message_data['name']) ? pathinfo($message_data['name'], PATHINFO_FILENAME) : '' }}"
                                {{ isset($message_data['no']) && $message_data['no'] > 0 ? 'disabled' : '' }}
                            >
                            <input class="form-control text-center"
                                name="message_ID"
                                id="message_ID"
                                value="{{ isset($message_data['no']) ? $message_data['no'] : '' }}"
                                disabled
                            >
                        </div>
                    </div> <!-- end: name -->
                    {{-- <div class="message-inform"> <!-- keywords -->
                        <label for="message-keywords">Keywords</label>
                        <div>
                            <input class="form-control"
                                name="message_keywords"
                                id="message_keywords"
                                placeholder="Insert a space for multiple keywords"
                                value="{{ isset($message_data['keywords']) ? $message_data['keywords'] : '' }}"
                            >
                        </div>
                    </div> <!-- end: keywords --> --}}
                </div> <!-- end: message name and keywords -->

                <div class="card-body pt-0">
                    <div class="mode d-flex flex-wrap justify-content-center gap-2"> <!-- mode -->
                        {{-- @if(isset($message_data['no']) && $message_data['no'] > 0)
                        <button class="btn btn-primary mr-1" type="button" id="saveMessage">Update</button>
                        <button class="btn btn-primary mr-1" type="button" id="saveAcopy">Save a Copy</button>
                        @else
                            <button class="btn btn-primary mr-1" type="button" id="saveMessage">Save</button>
                        @endif --}}
                        <div style="max-width: 100px; margin-right: 20px; gap: 10px;" class="d-flex align-items-center gap-2 edit-msg-single-inp-wrapper ">
                            <input class="form-control" style="width: 45px; text-align: center" name="time_to_show" id="time_to_show" value="" />
                            <label for="time_to_show" class="m-0 py-1" style="color: black; width: 70px; text-align: left; font-size: 12px;">Seconds to show image</label>
                        </div>
                        <button class="btn btn-danger" type="button" id="saveMessage">Save</button>
                        <button class="btn btn-danger" type="button" id="quit">Quit</button>
                        <button class="btn btn-danger" type="button" id="clearMessage">Clear</button>
                        <button class="btn btn-primary" type="button" id="line-mode">3-Line</button>
                        <button class="btn btn-secondary" type="button" id="dot-mode">Dot Draw</button>
                        <button class="btn btn-secondary" type="button" id="importImage">Import</button>
                        <button class="btn btn-secondary mr-5" type="button" id="exportImage">Export</button>
                        <div class="align-wrapper">
                            <div class="btn-group text-alignment mr-2" role="group" data-layer="1" aria-label="Basic example"> <!-- alignment 1 -->
                                <button class="btn btn-sm btn-icon btn-light text-left bg-dark"
                                    data-alignment="left"
                                    id="leftAlign"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Click here to Left Justify"
                                >
                                    <i class="fas fa-align-left"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-center"
                                    data-alignment="center"
                                    id="centerAlign"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Click here to Center Justify"
                                >
                                    <i class="fas fa-align-center"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-right"
                                    data-alignment="right"
                                    id="rightAlign"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Click here to Right Justify"
                                >
                                    <i class="fas fa-align-right"></i>
                                </button>
                            </div>
                        </div>
                    </div> <!-- end: mode -->

                    <!-- start led -->
                    <div id="ledDiv" class="text-center work-area">
                        <div id="ledContainer">
                            <div id='wrapperLed' class="row"></div>
                        </div>
                        <canvas id="3LineLed" width="{{$screenSettings['screen_pixels_wide'] ?? 56}}" height="{{$screenSettings['screen_pixels_high'] ?? 40}}" class="d-none"></canvas>

                        {{-- <canvas id="canvas_bg" width="800" height="600" class="d-none"></canvas> --}}
                        <canvas id="canvas" width="700" height="390" class="d-none"></canvas>
                        <div id="gridCanvas" class="gridCanvas rotationTime d-none">
                            {{-- <table id="pixelCanvas" class="flyItIn2"></table> --}}
                            <div id="pixelCanvas" class="row flyItIn2"></div>
                        </div>
                        <canvas id="draw-mode" width="{{$screenSettings['screen_pixels_wide'] ?? 56}}" height="{{$screenSettings['screen_pixels_high'] ?? 40}}" class="d-none"></canvas>
                    </div>
                    <!-- end led -->

                    {{-- <div class="flex-column messages">
                        <div class="message_1 message"> <!-- message 1 -->
                            <div class="align-wrapper">
                                <div class="btn-group text-alignment mr-2" role="group" data-layer="1" aria-label="Basic example"> <!-- alignment 1 -->
                                    <button class="btn btn-sm btn-icon btn-light text-left bg-dark"
                                        data-alignment="left"
                                        id="alignLeftFirst"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Left Justify"
                                    >
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light text-center"
                                        data-alignment="center"
                                        id="alignCenterFirst"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Center Justify"
                                    >
                                        <i class="fas fa-align-center"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light text-right"
                                        data-alignment="right"
                                        id="alignRightFirst"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Right Justify"
                                    >
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="message-input">
                                <input
                                    class="form-control signalMessage"
                                    name="message_1"
                                    id="message_1"
                                    value="{{ $mode == 'edit' && $message_data->draw_mode == 0 ? (isset($message_data->message[0]) ? $message_data->message[0] : '') : '' }}"
                                >
                            </div>
                        </div>  <!-- end: message 1 -->

                        <div class="message_1 message"> <!-- message 2 -->
                            <div class="align-wrapper">
                                <div class="btn-group text-alignment mr-2" role="group" data-layer="2" aria-label="Basic example"> <!-- alignment 2 -->
                                    <button class="btn btn-sm btn-icon btn-light text-left bg-dark"
                                        data-alignment="left"
                                        id="alignLeftSecond"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Left Justify"
                                    >
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light text-center"
                                        data-alignment="center"
                                        id="alignCenterSecond"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Center Justify"
                                    >
                                        <i class="fas fa-align-center"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light text-right"
                                        data-alignment="right"
                                        id="alignRightSecond"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Right Justify"
                                    >
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="message-input">
                                <input
                                    class="form-control signalMessage"
                                    name="message_2"
                                    id="message_2"
                                    value="{{ $mode == 'edit' && $message_data->draw_mode == 0 ? (isset($message_data->message[1]) ? $message_data->message[1] : '') : '' }}"
                                >
                            </div>
                        </div>  <!-- end: message 2 -->

                        <div class="message_1 message"> <!-- message 3 -->
                            <div class="align-wrapper">
                                <div class="btn-group text-alignment mr-2" role="group" data-layer="3" aria-label="Basic example"> <!-- alignment 3 -->
                                    <button class="btn btn-sm btn-icon btn-light text-left bg-dark"
                                        data-alignment="left"
                                        id="alignLeftThird"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Left Justify"
                                    >
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light text-center"
                                        data-alignment="center"
                                        id="alignCenterThird"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Center Justify"
                                    >
                                        <i class="fas fa-align-center"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light text-right"
                                        data-alignment="right"
                                        id="alignRightThird"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Click here to Right Justify"
                                    >
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="message-input">
                                <input
                                    class="form-control signalMessage"
                                    name="message_3"
                                    id="message_3"
                                    value="{{ $mode == 'edit' && $message_data->draw_mode == 0 ? (isset($message_data->message[2]) ? $message_data->message[2] : '') : '' }}"
                                >
                            </div>
                        </div>  <!-- end: message 3 -->
                    </div><!-- end: message editbox --> --}}

                    <div class="message-inform mt-2 {{ (isset($mode) && $mode == 'create') ? '' : 'd-none' }}"> <!-- keywords -->
                        <label for="message-keywords">Keywords</label>
                        <div>
                            <input class="form-control"
                                name="message_keywords"
                                id="message_keywords"
                                placeholder="Insert a space for multiple keywords"
                                value="{{ isset($message_data['keywords']) ? $message_data['keywords'] : '' }}"
                            >
                        </div>
                    </div> <!-- end: keywords -->

                    <div class="mt-4" style="display: flex; justify-content: space-evenly; ">
                        @foreach ($messages_data as $index => $message_data)
                            <img
                                class="messageImage {{ $index == 0 ? 'image-highlight' : '' }}"
                                src="{{ asset('assets/media/signmessage/' . $message_data->name) }}"
                                style="width: 10%; cursor: pointer;"
                                alt="image"
                                data-message="{{ json_encode($message_data->message) }}"
                                data-index="{{ $index }}"
                            />
                        @endforeach

                    </div>
                </div>
                {{-- <div class="action-group flex-wrap p-1"> <!-- actions -->
                    <button class="btn btn-primary" type="button" id="sendMessage">Send</button>
                    @if(isset($message_data['no']) && $message_data['no'] > 0)
                        <button class="btn btn-primary" type="button" id="saveMessage">Update</button>
                        <button class="btn btn-primary" type="button" id="saveAcopy">Save a Copy</button>
                    @else
                        <button class="btn btn-primary" type="button" id="saveMessage">Save</button>
                    @endif
                    <button class="btn btn-primary" type="button" id="clearMessage">Clear</button>
                    <button class="btn btn-primary" type="button" id="exit">
                        <a href="{{ route('send-to-sign') }}">Exit</a>
                    </button>
                    <!-- <div class="card-title">
                        <select class="form-control selectpicker d-inline mr-3" id="edit-mode" data-style="btn-success">
                            <option value="0">3-Line Mode</option>
                            <option value="1">Dot-Type</option>
                        </select>
                        <div class="gridControl">
                            <form id="sizePicker" name="gridSize">
                            </form>
                        </div>
                        <button class="btn btn-warning mt-0 d-inline mr-3" type="button" id="createGrid">Set</button>
                    </div> -->
                </div> <!-- actions --> --}}
                <textarea class="form-control d-none" id="dummy" rows="3"></textarea>
            </div>
        </div>
    </div>

</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Select an Image</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <!-- File Input -->
                <div class="mb-3">
                    <label for="modalImageInput" class="form-label">Choose an Image:</label>
                    <input type="file" class="form-control" id="modalImageInput" accept="image/*">
                </div>

                <!-- Image Preview -->
                <div class="text-center">
                    <img id="modalImagePreview" class="img-fluid rounded d-none" style="max-width: 100%;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Cancel</button>
                <button id="confirmImportButton" class="btn btn-success" disabled>Import</button>
            </div>
        </div>
    </div>
</div>
@include('user.footer')

<script src="/js/charToLed.js"></script>
<script src="/js/canvastobmp.min.js"></script>
<script src="/js/html2canvas.min.js"></script>

<script>
    var pixelHeight = parseInt("{{$screenSettings['font_pixels_high'] ?? 10}}");
    var pixelWidth = parseInt("{{$screenSettings['font_pixels_wide'] ?? 6}}");

    $(document).ready(function () {
        $(".signalMessage").on("focus", function () {
            let targetDiv = $("#ledDiv");

            // Wait for keyboard to fully open before scrolling
            setTimeout(() => {
                targetDiv[0].scrollIntoView({ behavior: "smooth", block: "center" });
            }, 500);
        });

        // Detect keyboard pop-up using window resize
        $(window).on("resize", function () {
            if ($(window).height() < screen.height * 0.6) {
                setTimeout(() => {
                    $("#ledDiv")[0].scrollIntoView({ behavior: "smooth", block: "center" });
                }, 500);
            }
        });

        $(".ledGroup").on("click", function () {
            highlightLedGroup($(this));
        });

        // $(document).on("click", function (event) {
        //     // Check if the click is outside .ledGroup and input fields
        //     if (!$(event.target).closest(".ledGroup, .signalMessage").length) {
        //         $(".ledGroup").removeClass("screen-layer-highlight");
        //         $(".signalMessage").blur(); // Remove focus from input fields
        //     }
        // });

        $("#quit").on("click", function () {
            window.location.href = "{{ route('send-to-sign') }}";
        });
    });

    const messagesData = @json($messages_data);
    const screenSettings = @json($screenSettings);

    let messageData = [];
    // let temp = [];
    if (messagesData.length > 0) {
        messageData = messagesData[0];
        // temp = messageData.message;
    }

    const mode = "{{ $mode }}";
    var alignmentList = ['center', 'center', 'center'];   // default ones
    let alignments = [1,1,1];

    const canvasWidth = parseInt("{{$screenSettings['screen_pixels_wide'] ?? 56}}");;
    const canvasHeight = parseInt("{{$screenSettings['screen_pixels_high'] ?? 40}}");;
    let drawMode = mode == "create" ? 0 : messageData.draw_mode; // 3-line mode

    var messages = [];
    var isSaveCopy = false;

    let message_name = $('#message_name').val();
    let message_ID = $('#message_ID').val();
    let message_keywords = $('#message_keywords').val();

    const lightOff = function (rowNum, col, mode = 'line') {

        for(j = 0; j < canvasWidth; j++) {
            var line_0 = document.createElement('div');
            if (mode != 'line')
                line_0.className = "pixel_" + (rowNum) + "_" + j + " light off";
            else
                line_0.className = (rowNum) + "_" + j + " light off";
            col.append(line_0);
        }
    }

    const addBlankRow = function (length, previousRowNum) {

        for (let i = 0; i < length; i ++) {
            var col = $('<div style="padding: 0 25px !important;" class="col-12 p-1 d-flex justify-content-center col blank"/>').appendTo('#wrapperLed');
            lightOff(previousRowNum + i, col, 'line');
        }
    }

    const addBlackRow = function (length, previousRowNum, mode) {
        let target = mode === 'line' ? '#wrapperLed' : '#pixelCanvas';
        let ledGroup = $('<div class="ledGroup col"></div>').appendTo(target); // Wrap group
        for (let i = 0; i < length; i++) {
            var col = $('<div class="col-12 d-flex justify-content-center col"/>').appendTo(ledGroup);
            lightOff(previousRowNum + i, col, mode);
        }
    }

    // Make the initial screen in 3-line mode
    addBlankRow(screenSettings.top_blank_rows, 0);
    addBlackRow(screenSettings.font_pixels_high, 2, 'line');
    addBlankRow(screenSettings.between_1st_2nd_row, 12);
    addBlackRow(screenSettings.font_pixels_high, 15, 'line');
    addBlankRow(screenSettings.between_2nd_3rd_row, 25);
    addBlackRow(screenSettings.font_pixels_high, 28, 'line');
    addBlankRow(screenSettings.blank_lines_bottom, 38);

    // addBlankRow(2, 0);
    // addBlackRow(10, 2, 'line');
    // addBlankRow(1, 12);
    // addBlackRow(10, 15, 'line');
    // addBlankRow(1, 25);
    // addBlackRow(10, 28, 'line');
    // addBlankRow(2, 38);
    var convertImageToHTML = function (imageFile) {
        let img = new Image();
        img.src = URL.createObjectURL(imageFile);

        img.onload = function () {
            let canvas = document.getElementById('draw-mode');
            let ctx = canvas.getContext('2d', { willReadFrequently: true });

            // Set canvas size to match the image
            canvas.width = img.width;
            canvas.height = img.height;

            // Draw the image onto the canvas
            ctx.drawImage(img, 0, 0);

            // Get pixel data
            let imageData = ctx.getImageData(0, 0, img.width, img.height);
            let data = imageData.data;

            // Select existing divs inside #pixelCanvas
            let cols = document.querySelectorAll('#pixelCanvas .ledGroup .col');
            let totalCols = cols.length;

            for (let col = 0; col < totalCols; col++) {
                let pixels = cols[col].querySelectorAll('div');
                for (let row = 0; row < pixels.length; row++) {
                    let index = (col * img.width + row) * 4;
                    let r = data[index];
                    let g = data[index + 1];
                    let b = data[index + 2];

                    // Check if the color is "yellow" (similar to original function)
                    if (r > 200 && g > 200 && b < 100) {
                        pixels[row].classList.add('on'); // Apply "on" class for yellow pixels
                    } else {
                        pixels[row].classList.remove('on'); // Remove "on" class for other colors
                    }
                }
            }
        };
    };

    function updateValuesAndAlignments() {
        alignmentList = messageData.three_line_alignment;
        alignmentList.forEach(function(alignment, index) {
            switch (alignment) {
                case 'left':
                    alignments[index] = 0;
                    break;
                case 'center':
                    alignments[index] = 1;
                    break;
                case 'right':
                    alignments[index] = 2;
                    break;
                default:
                    break;
            }
            // justifyAlignment(index);
        });

        $('.btn-group').each(function(index) {
            let alignmentIndex = alignments[index];
            $(this).find('button').removeClass('bg-dark');
            $(this).find(`button:eq(${alignmentIndex})`).addClass('bg-dark');
        });

        messageData.message.forEach(function(msg, index) {
            $('.signalMessage').eq(index).val(msg);
            console.log($('.signalMessage').eq(index).val());
        });

        $('#message_name').val(messageData.name.replace(".bmp", ""));
        $('#message_ID').val(messageData.no);
        $('#message_keywords').val(messageData.keywords);

        message_name = $('#message_name').val();
        message_ID = $('#message_ID').val();
        message_keywords = $('#message_keywords').val();
    }

    function highlightLedGroup($target) {
        // Remove border from all groups
        $(".ledGroup").removeClass("screen-layer-highlight");

        // Add border to the selected group
        $target.addClass("screen-layer-highlight");

        // Get the index of the selected group
        let groupIndex = $target.index(".ledGroup") + 1;

        // Focus the corresponding message input field
        let $input = $("#message_" + groupIndex);
        let input = $input[0]; // get the raw DOM element

        $input.focus();
        input.setSelectionRange(input.value.length, input.value.length);
        // let $input = $("#message_" + groupIndex);
        // $input.focus();

        // Highlight the correct alignment button
        $(".text-alignment .btn").each(function () {
            if (alignmentList[groupIndex - 1] == $(this).data("alignment")) {
                $(this).addClass("bg-dark");
            } else {
                $(this).removeClass("bg-dark");
            }
        });
    }


    $(document.fonts).ready(function() {
        // assign alignments after loading
        const $firstGroup = $(".ledGroup").first();
        if (mode == 'edit' && messageData.draw_mode == 0) {
            // if (messageData.message1 !== null) {
            //     messages.push(
            //         messageData.message1.map(innerArray => {
            //             return innerArray.map(item => item === 'true' ? true : item === 'false' ? false : item);
            //         })
            //     );
            // } else {
            //     messages.push([]);
            // }

            // if (messageData.message2 !== null) {
            //     messages.push(
            //         messageData.message2.map(innerArray => {
            //             return innerArray.map(item => item === 'true' ? true : item === 'false' ? false : item);
            //         })
            //     );
            // } else {
            //     messages.push([]);
            // }

            // if (messageData.message3 !== null) {
            //     messages.push(
            //         messageData.message3.map(innerArray => {
            //             return innerArray.map(item => item === 'true' ? true : item === 'false' ? false : item);
            //         })
            //     );
            // } else {
            //     messages.push([]);
            // }

            updateValuesAndAlignments()
            displayLED();

            if ($firstGroup.length) {
                highlightLedGroup($firstGroup);
            }
        }
        else if (mode == 'edit' && messageData.draw_mode == 1) {
            if ($('#dot-mode').hasClass('btn-secondary')) $('#dot-mode').removeClass('btn-secondary');
            if (!$('#dot-mode').hasClass('btn-primary')) $('#dot-mode').addClass('btn-primary');

            if ($('#line-mode').hasClass('btn-primary')) $('#line-mode').removeClass('btn-primary');
            if (!$('#line-mode').hasClass('btn-secondary')) $('#line-mode').addClass('btn-secondary');
        } else {
            if ($firstGroup.length) {
                highlightLedGroup($firstGroup);
            }
        }


        function textToLED(theWord){
            var theMessage = [];
            var totalWidth = 0;
            var letterArrays = [];

            // First, get all character arrays
            for (var i = 0; i < theWord.length; i++) {
                var letterArray = transposeArray(charToLED(theWord.charAt(i), pixelHeight, pixelWidth));
                letterArrays.push(letterArray);
                totalWidth += letterArray.length;
            }

            // Add spaces between characters (1 pixel each)
            totalWidth += Math.max(0, theWord.length - 1); // Add 1 pixel space between each character

            // Create the final array with exact spacing
            var currentPosition = 0;
            for (var i = 0; i < letterArrays.length; i++) {
                var letterArray = letterArrays[i];

                // Add the character
                for (var j = 0; j < letterArray.length; j++) {
                    theMessage[currentPosition + j] = letterArray[j];
                }
                currentPosition += letterArray.length;

                // Add one pixel space after character (except for last character)
                if (i < letterArrays.length - 1) {
                    theMessage[currentPosition] = new Array(pixelHeight).fill(false);
                    currentPosition++;
                }
            }

            return theMessage;
        }

        function justifyAlignment(layer) {

            if (!messages[layer]) return;

            const emptyLetter = [false, false, false, false, false, false, false, false, false, false];

            if (alignments[layer] === 0) {

                var emptyLetters = [], afterEmptyLetters = [];

                emptyLetters.push(emptyLetter);

                for (let j = 0; j < canvasWidth - messages[layer].length; j++) {
                    emptyLetters.push(emptyLetter);
                }

                emptyLetters = messages[layer].concat(emptyLetters);
                drawMessage(emptyLetters, layer);

            } else {
                // alignment
                let upwordLength;

                if (alignments[layer] === 1)
                    upwordLength = (canvasWidth - messages[layer].length) / 2;
                else
                    upwordLength = canvasWidth - messages[layer].length - 1;

                var emptyLetters = [], afterEmptyLetters = [];
                for (let j = 0; j < upwordLength; j++) {
                    emptyLetters.push(emptyLetter);
                }

                emptyLetters = emptyLetters.concat(messages[layer]);

                for (let j = 0; j < canvasWidth - emptyLetters.length; j++) {
                    afterEmptyLetters.push(emptyLetter);
                }
                emptyLetters = emptyLetters.concat(afterEmptyLetters);
                drawMessage(emptyLetters, layer);

            }
        }

        function transposeArray(array) {
            return array[0].map((_, colIndex) => array.map(row => row[colIndex]));
        }

        // Get messages from editor
        function getMessage() {
            let temp = [];
            $('.signalMessage').each(function() {
                temp.push($(this).val());
            });

            return temp;
        }

        function displayLED() {

            if(messageData.draw_mode == 0 || messageData.draw_mode == undefined ) {
                let temp = getMessage();

                clearLights('wrapperLed');
                messages = [];

                let layer = temp.length;
                for (let i = 0; i < layer; i++) {
                    letters = textToLED(temp[i]);
                    messages.push(letters);
                    justifyAlignment(i);
                }
            }
        }

        $('.messageImage').on('click', function () {
            $(".messageImage").each(function(){
                $(this).removeClass('image-highlight');
            })
            $(this).addClass('image-highlight');
            let textMessages = $(this).data('message');
            let index = $(this).data('index');
            messageData = messagesData[index];
            // mode == "create" ? 0 : messageData.draw_mode; // 3-line mode
            drawMode = mode == "create" ? 0 : messageData.draw_mode; // 3-line mode
            // updateValuesAndAlignments();
            // displayLED();
            changeToImageDefaultMode(drawMode);
            if (drawMode == 0) {
                clearLights('wrapperLed');
                updateValuesAndAlignments();
                displayLED();
            } else {
                // makeGrid();
                changeThreeDotImageToDotDraw();
            }
        });
        // function handleImageClick(textMessages) {
        //     textMessages = JSON.parse(textMessages)
        //     textMessages.forEach(function(item, index, array) {
        //         temp.push(item);
        //     });
        //     displayLED();
        //     console.log(temp);

        //     // console.log(JSON.parse(textMessage));
        // }

        // message change event in 3-line mode
        $('.signalMessage').on('keyup', function(e) {
            displayLED();
        });

        // $("#inputBox").on('keyup', function(e) {
        //     clearLights();
        //     var value = $("#inputBox").val();
        //     messages = [];

        //     if(value != '' ) {
        //         var msg = value.split('\n');
        //         var layer = msg.length;

        //         for (let i = 0; i < layer; i++) {
        //             console.log('layer ', i);
        //             myMessage = textToLED(msg[i]);
        //             messages.push(myMessage);
        //             justifyAlignment(i);
        //         }
        //     }
        // });

        function setLight(row, col, state){
            var theLight = $('#wrapperLed').find('.' + row+ '_' + col);
            if(state) {
                theLight.addClass('on');
            } else {
                theLight.removeClass('on');
            }
        }

        function clearLights(target) {
            var lightsOn = $('#' + target).find('.on');
            lightsOn.addClass('off');
            lightsOn.removeClass('on');
        }

        function drawMessage(messageArray, layer){

            // console.log(messageArray);
            // console.log(layer);

            var offsetRow = layer === 0 ? 2 : layer === 1 ? 5 : 8; // start from 15'th row for 2'nd message, start from 28'th row for 3'nd message
            // offsetRow ++;

            var messageLength = messageArray.length;
            var totalScrollLength = canvasWidth + messageLength;

            if(messageLength > 0) {
                for (var col = 0; col < messageLength; col++) {
                    for (var row = 0; row < 10; row++) {
                        var offsetCol = 0 + col;
                        if (offsetCol < canvasWidth || offsetCol >= 0) {
                            setLight(offsetRow + layer * 10 + row, offsetCol, messageArray[col][row]);
                        }
                    }
                }
            }
        }

        var value = "";
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        var undo_lists = [];
        var redo_lists = [];
        var undo_flag = false;

        // const canvas_bg = document.getElementById('canvas_bg');
        // const ctx_bg = canvas_bg.getContext("2d");
        // const bWidth = $('.card-body').width() * 0.8;
        // canvas.width = bWidth;
        // canvas.height = bWidth / 2;
        // let isDown = false;
        // canvas.addEventListener('mousedown', handleOnClick);
        // canvas.addEventListener('touchstart', handleOnClick);
        // canvas.addEventListener('mouseup', handleUpClick);
        // canvas.addEventListener('touchend', handleUpClick);
        // function handleOnClick () {
        //     console.log('down')
        //     isDown = true;
        // }
        // function handleUpClick () {
        //     console.log('up')
        //     isDown = false;
        // }
        canvas.addEventListener('mousemove', handleClick);
        // canvas.addEventListener('touchmove', handleClick);
        var line = 0;
        var x = canvas.width / 2;

        function drawText () {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawBoard()
            // ctx.font = "120px serif";
            ctx.font = "119px FFFFORWA";
            // lineHeight = ctx.measureText('M').width;
            // ctx.textBaseline = "middle";
            // ctx.fontKerning = "none";

            console.log('drawtext value: ', getMessage());

            const currentMsg = getMessage();
            if (currentMsg.length) {
                currentMsg.map((item, index) => {

                    const alignment = alignmentList[index];
                    ctx.textAlign = alignment;
                    ctx.color = "black";

                    if(alignment == 'left') {
                        ctx.fillText(item, 10, 130 * (index + 1));
                    } else if(alignment == 'center') {
                        ctx.fillText(item, x, 130 * (index + 1));
                    } else {
                        ctx.fillText(item, canvas.width - 10, 130 * (index + 1));
                    }

                    // ctx.fillText(alignment + "-aligned", item, 10 , 100 * (index + 1) + (index == 0 ? 0 : 10 * index));
                })
                if(undo_flag == false) {
                    undo_lists.push(value);
                    undo_flag = false;
                }
            }
        }

        function handleClick(e) {
            var flag = false;
            for(let j = 0; j < 3; j++) {
                if(e.offsetY > (100 * j  + 30 * (j + 1)) && e.offsetY < 130 * (j + 1)) {
                    flag = true;
                }
            }
            if(flag == true) {
                canvas.style.cursor = 'text';
            } else {
                canvas.style.cursor = 'default';
            }
        }

        var bw = 400;
        // Box height
        var bh = 400;
        // Padding
        var totalRow = 130;
        var blank = 30;
        var j = 1;
        var rows = 3;

        function drawBoard(){

            for (let x = 0; x < canvas.width; x += 10) {
                ctx.moveTo(x, 0);
                ctx.lineTo(x, canvas.height);
            }
            // Blank Space
            ctx.fillStyle = "black";
            for(let j = 0; j < rows; j++) {
                ctx.fillRect(0, 0 + (totalRow * j), canvas.width, blank);
            }
            // Editable Space
            ctx.fillStyle = "black";
            for(let j = 0; j < rows; j++) {
                ctx.fillRect(0, 0 + (totalRow * j) + blank, canvas.width, 100);
            }

            for (let y = 0; y < canvas.height; y += 10) {
                ctx.fillStyle = "yellow";
                ctx.moveTo(0, y);
                ctx.lineTo(canvas.width, y);
                if(y > totalRow * j) {
                    j++;
                }
                if(y <= totalRow * j - blank) {
                    ctx.strokeStyle = "white";
                } else {
                    ctx.strokeStyle = "black";
                }
                ctx.lineWidth = 1;
                ctx.stroke();
            }
            // ctx.strokeStyle = "black";
        }

        drawBoard();

        let pathsry = [];
        $("#dummy").focus();
        $(document).on('keyup', function(event) {
            if(event.keyCode == 8) {
                value = value.slice(0, -1);
                drawText();
            }
        })
        $(document).on('click', function(){
            $("#dummy").trigger('tap');
        })
        $("#dummy").on('change', function(e){
            if(e.which == 13) {
                var newArray = value.split("\n");
                if(newArray.length >= 3) {
                    return false;
                }
            }
            value = $(this).val();
            drawText();
        })

        // Text Alignment
        $(".text-alignment .btn").on('click', function() {
            $(".text-alignment .btn").each(function(){
                $(this).removeClass('active');
            })
            $(this).addClass('active');
            // line = value.split("\n").length - 1;
            // line = Number($(this).parent().data('layer')) - 1;
            let highlightedDiv = $(".ledGroup.screen-layer-highlight");
            let index = highlightedDiv.index(".ledGroup");
            if (index > -1) {
                alignmentList[index] = $(this).data('alignment');
                drawText();
            }
        });

        // Switch the mode
        $('.mode .btn').on('click', function(e) {
            let whichMode = e.target.id;
            if (whichMode == 'line-mode') {
                if ($(this).hasClass('btn-secondary')) $(this).removeClass('btn-secondary');
                if (!$(this).hasClass('btn-primary')) $(this).addClass('btn-primary');

                if ($('#dot-mode').hasClass('btn-primary')) $('#dot-mode').removeClass('btn-primary');
                if (!$('#dot-mode').hasClass('btn-secondary')) $('#dot-mode').addClass('btn-secondary');
                drawMode = 0;
                clearLights('wrapperLed');
                updateValuesAndAlignments();
                displayLED();
            } else if (whichMode == 'dot-mode') {
                if ($(this).hasClass('btn-secondary')) $(this).removeClass('btn-secondary');
                if (!$(this).hasClass('btn-primary')) $(this).addClass('btn-primary');

                if ($('#line-mode').hasClass('btn-primary')) $('#line-mode').removeClass('btn-primary');
                if (!$('#line-mode').hasClass('btn-secondary')) $('#line-mode').addClass('btn-secondary');
                drawMode = 1;
                changeThreeDotImageToDotDraw();
            } else {}

            changeMode();
            // makeGrid();
        });

        var changeToImageDefaultMode = function(mode) {
            if (mode == 0) {
                if ($('#line-mode').hasClass('btn-secondary')) $('#line-mode').removeClass('btn-secondary');
                if (!$('#line-mode').hasClass('btn-primary')) $('#line-mode').addClass('btn-primary');

                if ($('#dot-mode').hasClass('btn-primary')) $('#dot-mode').removeClass('btn-primary');
                if (!$('#dot-mode').hasClass('btn-secondary')) $('#dot-mode').addClass('btn-secondary');
                drawMode = 0;
            } else if (mode == 1) {
                if ($('#dot-mode').hasClass('btn-secondary')) $('#dot-mode').removeClass('btn-secondary');
                if (!$('#dot-mode').hasClass('btn-primary')) $('#dot-mode').addClass('btn-primary');

                if ($('#line-mode').hasClass('btn-primary')) $('#line-mode').removeClass('btn-primary');
                if (!$('#line-mode').hasClass('btn-secondary')) $('#line-mode').addClass('btn-secondary');
                drawMode = 1;
            } else {}

            changeMode();
        }

        var changeMode = function() {
            value = "";
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawBoard();

            if(drawMode == 0) { // 3-line mode
                $('.messages').removeClass('d-none');
                $("#canvas").removeClass('d-none');
                $("#ledContainer").removeClass('d-none');
                $("#inputBox").removeClass('d-none');
                $("#gridCanvas").addClass('d-none');
            } else {
                $('.messages').addClass('d-none');
                $("#gridCanvas").removeClass('d-none');
                $("#ledContainer").addClass('d-none');
                $("#inputBox").addClass('d-none');
                $("#canvas").addClass('d-none');
            }
        }

        changeMode();

        var changeThreeDotImageToDotDraw = function () {
            let imgUrl = $('.messageImage.image-highlight').attr('src');

            fetch(imgUrl)
                .then(response => response.blob())
                .then(blob => {
                    let file = new File([blob], "image.png", { type: blob.type });
                    clearLights('pixelCanvas');
                    convertImageToHTML(file);
                })
                .catch(error => console.error("Error fetching image:", error));
        }

        var undoFunction = function () {
            if(undo_lists.length >= 0 && undo_lists[undo_lists.length - 1]) {
                undo_flag = true;
                var poped = undo_lists.pop();
                redo_lists.push(poped);
                if(undo_lists[undo_lists.length - 2]) {
                    value = undo_lists[undo_lists.length - 2];
                    drawText();
                } else if(!undo_lists[undo_lists.length - 2] && undo_lists[undo_lists.length - 1]) {
                    value = undo_lists[undo_lists.length - 1];
                    drawText();
                } else {
                    value = '';
                    drawText();
                }
            }
        }
        $(".undo").click(function(){
            undoFunction();
        })

        function redoAction () {
            if(redo_lists.length >= 0 && redo_lists[redo_lists.length - 1]) {
                undo_flag = true;
                value = redo_lists[redo_lists.length - 1];
                undo_lists.push(redo_lists.pop());
                drawText();
            }
        }
        $(".redo").click(function() {
            redoAction();
        })


        $(document).on('keyup', function(e) {
            if (e.target.id == 'message_name' || e.target.id == 'message_keywords')
                return;

            // if( e.which === 91 && e.ctrlKey){
            //     undoFunction();
            // }
            // else if( e.which === 90 && e.ctrlKey ){
            //     undoFunction();
            // } else if( e.which === 89 && e.ctrlKey ){
            //     redoAction();
            // } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || e.which == 32){
            //     value += e.key;
            //     drawText();
            // } else if(e.keyCode == 13) {
            //     var newArray = value.split("\n");
            //     if(newArray.length >= 3) {
            //         return false;
            //     }
            //     value += "\n";
            //     line ++;
            //     drawText();
            // }

            // call this function whenever message is changed.
            drawText();
        });

        // Grid Control
        $(".btn-toggle").on("click", function() {
            $(".gridContainer").toggle();
        })
        // Create a grid that a user can color with clicks
        //   - allows grid size entry and color selection

        // When size is submitted by the user, call makeGrid()

        // Set the inital 'paint' changes happen in click event
        const PAINT = 'PAINT';
        const ERASE = 'ERASE';
        const theGridSize = document.forms.gridSize;
        const userColor = document.getElementById('colorPicker');
        const tileMode = document.getElementById('modeDisplay');
        const displayHeight = document.getElementById('gridHeightDisplay');
        const displayWidth = document.getElementById('gridWidthDisplay');
        const userHeight = document.getElementById('inputHeight');
        const userWidth = document.getElementById('inputWidth');
        const grid = document.getElementById('pixelCanvas');
        const gridCanvas = document.getElementById('gridCanvas');
        let gridTileMode = PAINT // controls paint or erase of grid cells (td's)

        var checkCanvas = function() {
            var canvasLED = document.getElementById('canvas');
            var ctx = canvasLED.getContext('2d');
            var width = canvasLED.width;
            var height = canvasLED.height;

            var imageData = ctx.getImageData(0, 0, width, height);
            var data = imageData.data;

            var isEmpty = true;
            for (var i = 0; i < data.length; i += 4) {
                if (data[i + 3] !== 0) {
                    isEmpty = false;
                    break;
                }
            }

            return isEmpty;
        }

        var convertHTMLtoImage = function () {
            let cols, canvas;
            if (drawMode == 0) {
                cols = document.querySelectorAll('#wrapperLed .col:not(.ledGroup)');
                canvas = document.getElementById('3LineLed');
            } else {
                cols = document.querySelectorAll('#pixelCanvas .col:not(.ledGroup)');
                canvas = document.getElementById('draw-mode');
            }

            let context = canvas.getContext('2d');

            for (let col = 0; col < cols.length; col++) {
                const pixels = cols[col].querySelectorAll('div');
                for (let row = 0; row < pixels.length; row++) {
                    if (pixels[row].classList.contains('on')) {
                        context.fillStyle = 'yellow';
                    } else {
                        context.fillStyle = 'black';
                    }
                    context.fillRect(row, col, 1, 1);
                }
            }

            const width = canvas.width;
            const height = canvas.height;
            const imageData = context.getImageData(0, 0, width, height);
            const data = imageData.data;

            const headerSize = 54;
            const imageSize = width * height * 3; // 3 bytes per pixel (RGB)
            const fileSize = headerSize + imageSize;
            const buffer = new ArrayBuffer(fileSize);
            const view = new DataView(buffer);

            // BMP Header
            view.setUint16(0, 0x424D, false); // 'BM'
            view.setUint32(2, fileSize, true);
            view.setUint32(6, 0, true);
            view.setUint32(10, headerSize, true);

            // DIB Header
            view.setUint32(14, 40, true); // DIB header size
            view.setInt32(18, width, true); // Width
            view.setInt32(22, -height, true); // Height (negative for top-down bitmap)
            view.setUint16(26, 1, true); // Planes
            view.setUint16(28, 24, true); // Bits per pixel (24 for RGB)
            view.setUint32(30, 0, true); // Compression (no compression)
            view.setUint32(34, imageSize, true); // Image size
            view.setInt32(38, 2835, true); // Horizontal resolution (pixels per meter)
            view.setInt32(42, 2835, true); // Vertical resolution (pixels per meter)
            view.setUint32(46, 0, true); // Colors in color table (none)
            view.setUint32(50, 0, true); // Important color count (all colors are important)

            // Pixel data
            let offset = headerSize;
            for (let i = 0; i < data.length; i += 4) {
                view.setUint8(offset, data[i + 2]); // Blue
                view.setUint8(offset + 1, data[i + 1]); // Green
                view.setUint8(offset + 2, data[i]); // Red
                offset += 3;
            }

            const blob = new Blob([buffer], { type: 'image/bmp' });
            return blob;
        }

        function drawModePixelArray() {
            let pixelArray = [];

            for (let row = 0; row < canvasHeight; row++) {
                let rowArray = [];
                for (let col = 0; col < canvasWidth; col++) {
                    let pixelElement = document.querySelector(`#pixelCanvas .col .pixel_${row}_${col}`);
                    if (pixelElement) {
                        rowArray.push(pixelElement.classList.contains('on') ? 1 : 0);
                    } else {
                        rowArray.push(0); // Default to 0 if element not found
                    }
                }
                pixelArray.push(rowArray);
            }

            return pixelArray;
        }

        var saveMessageCall = function (range, imageFile, imageType) {
            const [msg1 = [], msg2 = [], msg3 = []] = messages;
            let msg = getMessage();

            if (drawMode == 1) msg = drawModePixelArray();

            const formData = new FormData();
            formData.append('imageFile', imageFile);
            formData.append('imageType', imageType);
            formData.append('range', JSON.stringify(range));
            formData.append('mode', parseInt(message_ID, 10) ? 'edit' : 'create');
            formData.append('saveMode', isSaveCopy ? 'saveAcopy' : 'save');
            formData.append('imageID', message_ID);
            formData.append('imageName', message_name);
            formData.append('imageKeywords', message_keywords);
            // formData.append('msg1', JSON.stringify(msg1));
            // formData.append('msg2', JSON.stringify(msg2));
            // formData.append('msg3', JSON.stringify(msg3));
            formData.append('msg', JSON.stringify(msg));
            formData.append('drawMode', drawMode);
            formData.append('three_line_alignment', JSON.stringify(alignmentList)); // e.g ['center', 'left', 'right']

            $.ajax({
                url: '/save-message',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res.success) {
                        if (isSaveCopy) {
                            var newMessageId = res.newID;
                            var newMessageURL = '{{ url('/edit-message/') }}' + '/' + newMessageId;
                            Swal.fire({
                                icon: 'success',
                                title: 'Copy of a message done successfully!',
                                timer: 2000,
                                timerProgressBar: true,
                                onClose: function () {
                                    window.location.href = newMessageURL;
                                }
                            });
                        } else {
                            toastr.success('Saved the message successfully!');
                        }
                    } else {
                        toastr.error("Something went wrong, please try again.");
                    }
                },
                error: function (err) {
                    toastr.error("Please refresh your browser");
                }
            });
        }

        var saveMessage = function (range) {

            // Get base64data of BMP

            if (drawMode == 0) { // 3-line mode
                drawText();
                // CanvasToBMP.toDataURL($("#canvas").first()[0], function (url) {
                //     saveMessageCall(range, url, 'bmp');
                // });
            }
            const convertedBMP = convertHTMLtoImage();
            saveMessageCall(range, convertedBMP, 'bmp');
        }

        // Get user role
        var getUserRole = async function() {
            try {
                var res = await $.ajax({
                    url: '/get-user-role',
                    type: "GET"
                });

                console.log(res);

                if (res.success) {
                    return res.role;
                } else {
                    throw new Error("Please try to login again!");
                }
            } catch (err) {
                throw new Error("An error occurred while getting permissions. Please refresh!");
            }
        }

        // Stuffs before saving
        var beforeSave = async function() {
            try {
                var role = await getUserRole();

                // step1: check if message is empty
                if (!getMessage().length) {
                    Swal.fire({
                        text: 'Please edit the message',
                        icon: "error",
                        confirmButtonText: "Confirm",
                        customClass: {
                            confirmButton: "btn-danger",
                        },
                    }).then(function(result) {
                        return;
                    });

                    return;
                }

                // step 2: check if message name is defined
                if (message_name == '') {
                    Swal.fire({
                        text: 'The `Name` field is required!',
                        icon: "error",
                        confirmButtonText: "Confirm",
                        customClass: {
                            confirmButton: "btn-danger",
                        },
                    }).then(function(result) {
                        return;
                    });

                    return;
                }

                if (!checkAlphanumeric(message_name)) {
                    Swal.fire({
                        text: 'The Name should only contain alphanumeric characters.',
                        icon: "error",
                        confirmButtonText: "Confirm",
                        customClass: {
                            confirmButton: "btn-danger",
                        },
                    }).then(function(result) {
                        return;
                    });

                    return;
                }

                if (message_ID > 0 && !isSaveCopy) { // in case of edit
                    Swal.fire({
                        text: 'It will update the original one. Are you sure?',
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                        customClass: {
                            confirmButton: "btn-danger",
                        },
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            saveMessage([0, 0]);
                        } else {
                            return;
                        }
                    });
                } else { // in case of create or save a copy
                    if (role === 0) {
                        saveMessage([1, 999]);
                    } else {
                        const inputOptions = role === 1 ? { "0": "User", "1": "Company"} : { "0": "User", "1": "Company", "2": "INEX" };

                        const { value: option } = await Swal.fire({
                            title: "Select the local storage to save",
                            showCancelButton: true,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn-danger",
                            },
                            input: "radio",
                            inputOptions,
                            inputValidator: (value) => {
                                if (!value) {
                                    return "You need to choose at least one."
                                }
                            }
                        });

                        if (option) {
                            var range = [1, 999];   // user
                            if (option === "1") range = [1000, 1999];   // Admin
                            if (option === '2') range = [2000, 2999];   // SuperAdmin

                            saveMessage(range);
                        }
                    }
                }
            } catch (error) {
                toastr.error(error.message);
            }
        }

        // **Download the image when clicking the "Export" button**
        document.getElementById("exportImage").addEventListener("click", function () {
            const imageBlob = convertHTMLtoImage();
            const url = URL.createObjectURL(imageBlob);

            const a = document.createElement("a");
            a.href = url;
            a.download = message_name + ".bmp"; // File name for download
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);

            URL.revokeObjectURL(url); // Clean up memory
        });

        // Save Or Update
        $("#saveMessage").on("click", function() {
            event.preventDefault();
            beforeSave();
        });

        // Save A Copy
        $('#saveAcopy').on("click", function() {
            event.preventDefault();
            isSaveCopy = true;
            beforeSave();
        });

        $("#createGrid").on("click", function() {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: 'You won"t be able to revert this!',
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, create new one!",
                customClass: {
                    confirmButton: "btn-danger",
                },
            }).then(function(result) {
                if (result.value) {
                    changeMode();
                    makeGrid();
                }
            });
        });

        var makeGrid = function () {
            let mouseIsDown = false;
            let isRightClick = false;

            while (grid.hasChildNodes()) {
                grid.removeChild(grid.lastChild);
            }

            addBlackRow(canvasHeight, 0, 'grid');

            // orignal draw in draw-mode
            if (mode == 'edit') {
                for (var row = 0; row < messageData.message.length; row++) {
                    for (var col = 0; col < canvasWidth; col++) {
                        if (messageData.message[row][col]) {
                            $('.pixel_' + row + '_' + col).removeClass('off');
                            $('.pixel_' + row + '_' + col).addClass('on');
                        }
                    }
                }
            }

            // Prevent the context menu from appearing on right-click
            grid.addEventListener('contextmenu', function(event) {
                event.preventDefault();
                paintEraseTiles(event.target, false);
            });

            // Handle left-click and right-click
            grid.addEventListener('mousedown', function(event) {
                event.preventDefault();
                if (event.button === 0) { // Left-click
                    mouseIsDown = true;
                    isRightClick = false;
                    paintEraseTiles(event.target, true);
                } else if (event.button === 2) { // Right-click
                    mouseIsDown = true;
                    isRightClick = true;
                    paintEraseTiles(event.target, false);
                }
            });

            // Handle touchstart
            grid.addEventListener('touchstart', function(event) {
                event.preventDefault();
                mouseIsDown = true;
                paintEraseTiles(event.target, true);
            });

            // Handle mousemove for continuous painting/erasing
            grid.addEventListener('mousemove', function(event) {
                if (mouseIsDown) {
                    event.preventDefault();
                    paintEraseTiles(event.target, !isRightClick);
                }
            });

            // Handle touchmove for continuous painting/erasing
            grid.addEventListener('touchmove', function(event) {
                if (mouseIsDown && event.touches.length > 0) {
                    event.preventDefault();

                    const touch = event.touches[0];
                    const x = touch.clientX;
                    const y = touch.clientY;

                    const target = document.elementFromPoint(x, y);
                    if (target) {
                        paintEraseTiles(target, true);
                    }
                }
            }, { passive: false });

            // grid.addEventListener('touchmove', function(event) {
            //     if (mouseIsDown) {
            //         event.preventDefault();
            //         paintEraseTiles(event.target, true);
            //     }
            // });

            // Handle mouseup to stop painting/erasing
            document.addEventListener('mouseup', function(event) {
                event.preventDefault();
                mouseIsDown = false;
            });

            // Handle mouseover for continuous painting/erasing
            grid.addEventListener('mouseover', function(event) {
                if (mouseIsDown) {
                    event.preventDefault();
                    paintEraseTiles(event.target, !isRightClick);
                }
            });
        };

        makeGrid();

        // paint or erase cells based on the mode (girdTileMode)

        function paintEraseTiles(targetCell, mode) {
            if (targetCell.classList.contains('light')) {
                if($($(targetCell).parent())[0].className == 'disabled') {
                    return;
                }
                // targetCell.style.backgroundColor = gridTileMode === PAINT ? userColor.value : 'transparent';
                if (mode == true) {
                    targetCell.classList.add('on');
                    targetCell.classList.remove('off');
                } else {
                    targetCell.classList.add('off');
                    targetCell.classList.remove('on');
                }
            } else {
                console.log("Nice try: " + targetCell.nodeName + " talk to the hand!");
            }
        }

        $("#inputWidth").on('change', function() {
            $(displayWidth).val($(this).val());
        });

        $("#gridWidthDisplay").on('change', function() {
            $("#inputWidth").val($(this).val());
        });

        $("#inputHeight").on('change', function() {
            $(displayHeight).val($(this).val());
        });

        $("#gridHeightDisplay").on('change', function() {
            $("#inputHeight").val($(this).val());
        });

        $("#colorPicker").on('change', function() {
            gridTileMode = PAINT;
            tileMode.innerHTML = ' ' + gridTileMode;
        });

        if (document.getElementById('clearGrid') !== null) {
            document.getElementById('clearGrid').addEventListener('click', function() {
                // gridCanvas.classList.toggle('rotateCanvas'); // rotate the Design Canvas div
                let tiles = grid.getElementsByTagName('td');
                // grid.children().children().removeAttr("style");
                for(let i = 0; i <= tiles.length; i++) {
                    if(tiles[i]) {
                        tiles[i].style.backgroundColor = 'transparent';
                    }
                }
            });
        }

        // set the mode to PAINT or ERASE
        $(".btn-mode").on('click', function() {
            $(".btn-mode").each((index, item) => {
                $(item).removeClass('btn-danger');
            })
            $(this).addClass('btn-danger');
        })

        if (document.getElementById('mode') !== null) {
            document.getElementById('mode').addEventListener('click', function(event) {
                gridTileMode = event.target.className.indexOf('paint') >=0 ? PAINT : ERASE;
                tileMode.innerHTML = ' ' + gridTileMode;
            });
        }

        // Dynamic layer Alignment
        $("#leftAlign").on("click", function() {
            event.preventDefault();

            let highlightedDiv = $(".ledGroup.screen-layer-highlight");
            let index = highlightedDiv.index(".ledGroup");
            if (index > -1) {
                document.getElementById("leftAlign").classList.add("bg-dark");
                document.getElementById("centerAlign").classList.remove("bg-dark");
                document.getElementById("rightAlign").classList.remove("bg-dark");

                alignments[index] = 0;

                justifyAlignment(index);
            }
        });

        $("#centerAlign").on("click", function() {
            event.preventDefault();

            let highlightedDiv = $(".ledGroup.screen-layer-highlight");
            let index = highlightedDiv.index(".ledGroup");
            if (index > -1) {
                document.getElementById("leftAlign").classList.remove("bg-dark");
                document.getElementById("centerAlign").classList.add("bg-dark");
                document.getElementById("rightAlign").classList.remove("bg-dark");

                alignments[index] = 1;

                justifyAlignment(index);
            }
        });

        $("#rightAlign").on("click", function() {
            event.preventDefault();

            let highlightedDiv = $(".ledGroup.screen-layer-highlight");
            let index = highlightedDiv.index(".ledGroup");
            if (index > -1) {
                document.getElementById("leftAlign").classList.remove("bg-dark");
                document.getElementById("centerAlign").classList.remove("bg-dark");
                document.getElementById("rightAlign").classList.add("bg-dark");

                alignments[index] = 2;

                justifyAlignment(index);
            }
        });
        // End

        // $("#alignLeftFirst").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftFirst").classList.add("bg-dark");
        //     document.getElementById("alignCenterFirst").classList.remove("bg-dark");
        //     document.getElementById("alignRightFirst").classList.remove("bg-dark");

        //     alignments[0] = 0;

        //     justifyAlignment(0);
        // })

        // $("#alignCenterFirst").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftFirst").classList.remove("bg-dark");
        //     document.getElementById("alignCenterFirst").classList.add("bg-dark");
        //     document.getElementById("alignRightFirst").classList.remove("bg-dark");

        //     alignments[0] = 1;
        //     justifyAlignment(0);
        // })

        // $("#alignRightFirst").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftFirst").classList.remove("bg-dark");
        //     document.getElementById("alignCenterFirst").classList.remove("bg-dark");
        //     document.getElementById("alignRightFirst").classList.add("bg-dark");

        //     alignments[0] = 2;
        //     justifyAlignment(0);
        // })

        // // the second layer
        // $("#alignLeftSecond").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftSecond").classList.add("bg-dark");
        //     document.getElementById("alignCenterSecond").classList.remove("bg-dark");
        //     document.getElementById("alignRightSecond").classList.remove("bg-dark");

        //     alignments[1] = 0;

        //     justifyAlignment(1);
        // })

        // $("#alignCenterSecond").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftSecond").classList.remove("bg-dark");
        //     document.getElementById("alignCenterSecond").classList.add("bg-dark");
        //     document.getElementById("alignRightSecond").classList.remove("bg-dark");

        //     alignments[1] = 1;
        //     justifyAlignment(1);
        // })

        // $("#alignRightSecond").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftSecond").classList.remove("bg-dark");
        //     document.getElementById("alignCenterSecond").classList.remove("bg-dark");
        //     document.getElementById("alignRightSecond").classList.add("bg-dark");

        //     alignments[1] = 2;
        //     justifyAlignment(1);
        // })

        // // the third layer
        // $("#alignLeftThird").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftThird").classList.add("bg-dark");
        //     document.getElementById("alignCenterThird").classList.remove("bg-dark");
        //     document.getElementById("alignRightThird").classList.remove("bg-dark");

        //     alignments[2] = 0;

        //     justifyAlignment(2);
        // })

        // $("#alignCenterThird").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftThird").classList.remove("bg-dark");
        //     document.getElementById("alignCenterThird").classList.add("bg-dark");
        //     document.getElementById("alignRightThird").classList.remove("bg-dark");

        //     alignments[2] = 1;
        //     justifyAlignment(2);
        // })

        // $("#alignRightThird").on("click", function() {
        //     event.preventDefault();

        //     document.getElementById("alignLeftThird").classList.remove("bg-dark");
        //     document.getElementById("alignCenterThird").classList.remove("bg-dark");
        //     document.getElementById("alignRightThird").classList.add("bg-dark");

        //     alignments[2] = 2;
        //     justifyAlignment(2);
        // })

        // Clear Canvas for New button

        var clearMessage = function () {
            if (drawMode == 0) {
                let highlightedDiv = $(".ledGroup.screen-layer-highlight");
                let index = highlightedDiv.index(".ledGroup") + 1;
                if (index > 0) {
                    $("#message_" + index).val('');
                    displayLED();
                } else {
                    $('.signalMessage').each(function() {
                        $(this).val('');
                    });
                    clearLights('wrapperLed');
                    messages = [];
                }
            } else {
                clearLights('pixelCanvas');
            }
        }

        $("#clearMessage").on("click", function () {
            event.preventDefault();

            clearMessage();
        })

        // message name
        $('#message_name').on('keyup', function(e) {
            message_name = e.target.value;
        });

        // let message_keywords = $('#message_keywords').val().split(' ');
        $('#message_keywords').on('keyup', function(e) {
            message_keywords = e.target.value;
        });

        function checkAlphanumeric(message) {
            var pattern = /^[a-zA-Z0-9]+$/;
            return pattern.test(message);
        }

        $("#importImage").on("click", function (event) {
            $("#dot-mode").click();
            $('#importModal').modal('show');
        });

        let importedFile = null;
        document.getElementById("modalImageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("modalImagePreview");
            const confirmButton = document.getElementById("confirmImportButton");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove("d-none");
                    confirmButton.disabled = false; // Enable Import button
                };
                reader.readAsDataURL(file);
                importedFile = file;
            } else {
                importedFile = null;
                preview.classList.add("d-none");
                confirmButton.disabled = true;
            }
        });

        document.getElementById("confirmImportButton").addEventListener("click", function() {
            clearLights('pixelCanvas');
            convertImageToHTML(importedFile);
            $('#importModal').modal('hide');
        });

        $(".close-modal").on("click", function (event) {
            $('#importModal').modal('hide');
        });
    });
</script>
