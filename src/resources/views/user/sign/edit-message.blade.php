@include('user.header_new')
<style>
    table,
    tr,
    td {
        border: 1px solid black;
        cursor: pointer;
    }

    table {
        border-collapse: collapse;
        background-color: white;
        margin: 0 auto;
    }

    .disabled {
        background-color: #ddd;
        border-width: 0;
    }

    .disabled td {
        border-width: 0;
    }

    tr {
        height: 20px;
    }

    td {
        width: 20px;
    }

    p {
        margin: 1em 0 1em;
    }

    .gridSizeLabel {
        font-size: 18px;
    }

    #createMessage,
    #paintBtn {
        margin-right: 10px;
    }


    /* text fly in effect */

    /* .flyItIn {
        animation: flyin 1s ease forwards;
        opacity: 0;
        transform: scale(2);
        filter: blur(4px);
    }

    @keyframes flyin {
        to {
            filter: blur(0);
            transform: scale(1);
            opacity: 1;
        }
    }

    .flyItIn2 {
        animation: flyin2 1s ease forwards;
        opacity: 0;
        transform: scale(2);
        filter: blur(4px);
    }

    @keyframes flyin2 {
        to {
            filter: blur(0);
            transform: scale(1);
            opacity: 1;
        }
    } */

    /* rotates the Design Canvas div */

    .rotationTime {
        -webkit-transition: all 4s linear;
        -moz-transition: all 4s linear;
        -ms-transition: all 4s linear;
        -o-transition: all 4s linear;
        transition: all 4s linear;
    }

    .rotateCanvas {
        -webkit-transform: rotateX(360deg) rotateY(360deg);
        -moz-transform: rotateX(360deg) rotateY(360deg);
        -ms-transform: rotateX(360deg) rotateY(360deg);
        -o-transform: rotateX(360deg) rotateY(360deg);
        transform: rotateX(360deg) rotateY(360deg);
    }

    @font-face {
        font-family: 'FFFFORWA';
        src: url('/fonts/london-underground-platform-pis.otf');
    }

    #canvas {
        display: none;
        border: 1px solid #ddd;
    }

    #ledContainer {
        max-width: 100%;
        position: relative;
        /* height: 150px; */
        width: 100%;
        flex-flow: column wrap;
        overflow: hidden;
        margin: auto;
    }

    #wrapperLed {
        margin: 50px auto;
        /* border: 1px solid #ddd; */
        padding-bottom: 20px;
        /* position: absolute; */
        left: 0;
    }

    .light {
        width: 10px;
        height: 10px;
        margin: 1px 1px;
        text-align: center;
        font-size: 15px;
        float: left;
    }

    .off {
        background-color: #1a1a1a;
    }

    .on {
        background-color: yellow;
    }

    label {
        margin-top: 15px;
        color: #FFF;
        font-family: sans-serif;
        display: block;
        text-align: center;
    }

    .blank div{
        background: #ddd;
    }

    .swal2-label {
        color: black !important;
    }

    /* make adjustments for smaller devices */
</style>

<div class="d-flex flex-column justify-content-between px-8 py-10 px-lg-24">
    <!-- custom header  -->
    <div class="custom-header px-4 px-md-16">
        <div class="page-logo">
            <img  src="/assets/media/logos/logo_new.png" class="login-header-logo-image" alt=""  /> 
        </div>
        <div class="d-none d-sm-block text-center italic page-title">
            <h2>Work with a Message</h2>
            <p>This menu allows the user to retrieve or edit existing messages, make new ones or send to the sign</p>
        </div>
        <div class="qrcode-form">
            <a href="#">Click for HELP</a>
            <img src="/assets/media/mainmenu/qr_code.png" alt="Sign Controller QRcode">
        </div>
    </div>

    <div class="px-4">
        <div class="d-block d-sm-none text-center italic page-title">
            <h2>Work with a Message</h2>
            <p>This menu allows the user to retrieve or edit existing messages, make new ones or send to the sign</p>
        </div>
    </div>  
    <!-- end: custom-header -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom card-stretch">
                    <div class="card-header">
                        <div class="card-title">
                            <button class="btn btn-danger mt-0 d-inline mr-3" type="button" id="clearMessage">New</button>
                            <button class="btn btn-warning mt-0 d-inline mr-3" type="button">Edit</button>
                            
                        </div>
                        <div class="card-title">
                            <button class="btn btn-danger mt-0 d-inline mr-3" type="button" id="createMessage">Save & Exit</button>
                            <button class="btn btn-warning mt-0 d-inline mr-3" type="button" id="createAndSend">Save & Send</button>
                            <button class="btn btn-warning mt-0 d-inline mr-3" type="button">Cancel & Exit</button>
                        </div>
                        <div class="card-title">
                            <select class="form-control selectpicker d-inline mr-3" id="edit-mode" data-style="btn-success">
                                <option value="0">3-Line Mode</option>
                                <option value="1">Dot-Type</option>
                            </select>
                            <div class="gridControl">
                                <form id="sizePicker" name="gridSize">
                                </form>
                            </div>
                            <button class="btn btn-warning mt-0 d-inline mr-3" type="button" id="createGrid">Set</button>
                        </div>
                    </div>
                    <div class="card-body text-center" style="overflow:scroll">  
                        <!-- <div class="row align-items-center mb-6">
                            <div class="col-8">
                                <div id="kt_nouislider_2" class="nouislider nouislider-handle-danger"></div>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-info btn-block" type="button" id="changeBright">Change Brightness</button>
                            </div>
                        </div> -->
                        <textarea class="form-control d-none" id="dummy" rows="3"></textarea>
                        <textarea class="form-control" id="inputBox" rows="3" placeholder="Please enter text"></textarea>

                        <!-- Alignment -->
                        <div class="card-toolbar d-flex justify-content-between mt-5">
                            <div class="btn-group text-alignment mr-2" role="group" aria-label="Basic example">
                                <button class="btn btn-sm btn-icon btn-light text-left bg-dark" 
                                    data-alignment="left"
                                    id="alignLeftFirst"
                                >
                                    <i class="fas fa-align-left"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-center"
                                    data-alignment="center"
                                    id="alignCenterFirst"
                                >
                                    <i class="fas fa-align-center"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-right" 
                                    data-alignment="right"
                                    id="alignRightFirst"
                                >
                                    <i class="fas fa-align-right"></i>
                                </button>
                            </div>
                            <div class="btn-group text-alignment mr-2" role="group" aria-label="Basic example">
                                <button class="btn btn-sm btn-icon btn-light text-left bg-dark" 
                                    data-alignment="left"
                                    id="alignLeftSecond"
                                >
                                    <i class="fas fa-align-left"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-center"
                                    data-alignment="center"
                                    id="alignCenterSecond"
                                >
                                    <i class="fas fa-align-center"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-right" 
                                    data-alignment="right"
                                    id="alignRightSecond"
                                >
                                    <i class="fas fa-align-right"></i>
                                </button>
                            </div>
                            <div class="btn-group text-alignment mr-2" role="group" aria-label="Basic example">
                                <button class="btn btn-sm btn-icon btn-light text-left bg-dark" 
                                    data-alignment="left"
                                    id="alignLeftThird"
                                >
                                    <i class="fas fa-align-left"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-center"
                                    data-alignment="center"
                                    id="alignCenterThird"
                                >
                                    <i class="fas fa-align-center"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-right" 
                                    data-alignment="right"
                                    id="alignRightThird"
                                >
                                    <i class="fas fa-align-right"></i>
                                </button>
                            </div>
                            <!-- <a class="btn btn-sm btn-icon btn-light mr-2 undo">
                                <i class="flaticon2-left-arrow"></i>
                            </a>
                            <a class="btn btn-sm btn-icon btn-light mr-2 redo">
                                <i class="flaticon2-right-arrow"></i>
                            </a> -->
                        </div>

                        <div id="ledContainer">
                            <div id='wrapperLed' class="row"></div>
                        </div>
                        {{-- <canvas id="canvas_bg" width="800" height="600" class="d-none"></canvas> --}}
                        <canvas id="canvas" width="700" height="390" class="d-none"></canvas>
                        <div id="gridCanvas" class="gridCanvas rotationTime d-none">
                            <table id="pixelCanvas" class="flyItIn2"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('user.footer')
<!-- <script src="/js/slider.js"></script> -->
<script src="/js/charToLed.js"></script>
<script src="/js/canvastobmp.min.js"></script>
<script src="/js/html2canvas.min.js"></script>
<script>
    const canvasWidth = 56;

    var messages = [];
    let alignments = [0,0,0];
    
    const lightOff = function (rowNum, col) {
        
        for(j = 0; j < canvasWidth; j++) {
            var line_0 = document.createElement('div');
            line_0.className = (rowNum) + "_" + j + " light off";
            col.append(line_0);
        }
    }
    
    const addBlankRow = function (length, previousRowNum) {

        for (let i = 0; i < length; i ++) {
            var col = $('<div class="col-md-12 d-flex justify-content-center blank"/>').appendTo('#wrapperLed');
            lightOff(previousRowNum + i, col);
        }
    }
    
    const addBlackRow = function (length, previousRowNum) {
        for (let i = 0; i < length; i ++) {
            var col = $('<div class="col-md-12 d-flex justify-content-center"/>').appendTo('#wrapperLed');
            lightOff(previousRowNum + i, col);
        }
    }

    addBlankRow(3, 0);
    addBlackRow(10, 3);
    addBlankRow(2, 13);
    addBlackRow(10, 15);
    addBlankRow(2, 25);
    addBlackRow(10, 27);
    addBlankRow(3, 37);

    // drawGrid();
    $(document.fonts).ready(function(){
        // Change Bright ness
        // $("#changeBright").on('click', function() {
        //     var slider = document.getElementById('kt_nouislider_2');
        //     changeBrightness(slider.noUiSlider.get());
        // })
        // function changeBrightness(bright) {
        //     KTApp.blockPage();
        //     $.ajax({
        //         url : '/change-brightness',
        //         type : "POST",
        //         data : {
        //             bright: bright,
        //         },
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success : function(res){
        //             if(res['success'] == true) {
        //                 toastr.success('Success');
        //             } else {
        //                 toastr.error(res['message']);
        //             }
        //             KTApp.unblockPage();
        //         },
        //         error: function() {
        //             toastr.error("Change brightness failed");
        //             KTApp.unblockPage();
        //         }
        //     });
        // }
        // getCurrentBright();
        // function getCurrentBright() {
        //     var slider = document.getElementById('kt_nouislider_2');
        //     KTApp.block('#kt_nouislider_2', {
        //         overlayColor: 'red',
        //         opacity: 0.1,
        //         state: 'primary'
        //     });
        //     $.ajax({
        //         url : '/get-brightness',
        //         type : "POST",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success : function(res){
        //             if(res['success'] == true) {
        //                 slider.noUiSlider.set(res['bright']);
        //             }
        //             KTApp.unblock('#kt_nouislider_2');
        //         },
        //         error: function() {
        //             toastr.error("Get brightness failed");
        //             KTApp.unblock('#kt_nouislider_2');
        //         }
        //     });
        // }
        // 
        function clearLights(){
            var lightsOn = $('.on');
            lightsOn.addClass('off');
            lightsOn.removeClass('on');
            
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
        
        function textToLED(theWord){
            var theMessage = [];
            for(var i = 0; i < theWord.length; i++){
                theMessage.push(charToLED(theWord.charAt(i)));
                theMessage.push(charToLED());
            }
        
            var flatten = [];
            flatten = flatten.concat.apply(flatten, theMessage);

            return flatten;
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

        $("#inputBox").on('keyup', function(e){
            clearLights();
            var value = $("#inputBox").val();
            messages = [];
            
            if(value != '' ) {
                var msg = value.split('\n');
                var layer = msg.length;

                for (let i = 0; i < layer; i++) {
                    console.log('layer ', i);

                    myMessage = textToLED(msg[i]);
                    messages.push(myMessage);
                    justifyAlignment(i);

                }

            }
        });

        function setLight(row, col, state){
            var theLight = $('.'+row+'_'+col);
            if(state) {
                theLight.addClass('on');
            } else {
                theLight.removeClass('on');
            }
        }

        function drawMessage(messageArray, layer){

            console.log(messageArray);
            console.log(layer);

            var offsetRow = layer === 0 ? 3 : layer === 1 ? 5 : 7;
            offsetRow ++;

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

            console.log('drawtext value: ', value);
            if(value) {
                var newArray = value.split("\n");
                newArray.map((item, index) => {

                    const alignment = alignments[index];
                    ctx.textAlign = alignment;
                    ctx.color = "black";

                    if(alignment == 0) {
                        ctx.fillText(item, 10, 130 * (index + 1));
                    } else if(alignment == 1) {
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
            // if(!isDown) {
            //     return;
            // }
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
            // boxSize = 10
            // ctx.fillStyle = "black";

            // ctx.fillRect(Math.floor(e.offsetX / boxSize) * boxSize,
            // Math.floor(e.offsetY / boxSize) * boxSize,
            // boxSize, boxSize);
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
            line = value.split("\n").length - 1;
            alignmentList[line] = $(this).data('alignment');
            drawText();
        })
        var changeMode = function() {
            value = "";
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawBoard();
            if($("#edit-mode").val() == 0) {
                // $("#canvas_bg").removeClass('d-none');
                $("#canvas").removeClass('d-none');
                $("#ledContainer").removeClass('d-none');
                $("#inputBox").removeClass('d-none');
                $("#gridCanvas").addClass('d-none');
            } else {
                $("#gridCanvas").removeClass('d-none');
                $("#ledContainer").addClass('d-none');
                $("#inputBox").addClass('d-none');
                $("#canvas").addClass('d-none');
                // $("#canvas_bg").addClass('d-none');
            }

        }

        changeMode();
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


        $(document).on('keydown', function(e) {
            if( e.which === 91 && e.ctrlKey){
                undoFunction();
            }
            else if( e.which === 90 && e.ctrlKey ){
                undoFunction();
            } else if( e.which === 89 && e.ctrlKey ){
                redoAction();
            } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || e.which == 32){
                value += e.key;
                drawText();
            } else if(e.keyCode == 13) {
                var newArray = value.split("\n");
                if(newArray.length >= 3) {
                    return false;
                }
                value += "\n";
                line ++;
                drawText();
            }
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
            // let grid = $('#pixelCanvas');
        const grid = document.getElementById('pixelCanvas');
        const gridCanvas = document.getElementById('gridCanvas');
        let gridTileMode = PAINT // controls paint or erase of grid cells (td's)

        var saveMessageCall = function (range, base64Image, imageName, imageType, imageKeywords) {
            $.ajax({
                url : '/save-message',
                type : "POST",
                data : {
                    range: range,
                    base64Image: base64Image,
                    imageName: imageName,
                    imageType: imageType,
                    imageKeywords: imageKeywords
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(res){
                    if (res.success){
                        toastr.success('Saved the message successfully!');
                    }
                    else{
                        toastr.error("Something went wrong, please try again.");    
                    }
                },
                error : function(err){
                    toastr.error("Please refresh your browser");
                }
            })
        }

        var saveMessage = function (range) {           
    
            // Get base64data of BMP

            if ($("#edit-mode").val() == 0) {
                // html2canvas($("#wrapperLed").first()[0]).then(function(canvas) {
                    CanvasToBMP.toDataURL($("#canvas").first()[0], function (url) {
                        
                        // generate the name of image
                        var value = $("#inputBox").val();
                        var imageName = 'empty', imageType = 'bmp', imageKeywords = ''; // [userID]_[imageName]_[timestamp] will be sent to server
                        
                        if(value != '' ) {
                            imageName = value.split('\n').join('_');
                            imageKeywords = value.split('\n').join(', ');
                        }
    
                        saveMessageCall(range, url, imageName, imageType, imageKeywords);
    
                        clearMessage();
                    })
                // })
            } else {
                html2canvas($("#pixelCanvas").first()[0]).then(function(canvas) {
                    CanvasToBMP.toDataURL(canvas, function (url) {
                        var imageName = 'symbol', imageType = 'bmp', imageKeywords = 'symbol'; // [userID]_[imageName]_[timestamp] will be sent to server

                        // TODO: exceed error
                        // console.log(url);
                        // saveMessageCall(range, url, imageName, imageType, imageKeywords);
                        // clearMessage();
                    })
                });
            }
            
        }

        // $('#createMessage').on('click', function makeGrid(event) {gridSize
        $("#createMessage").on("click", function() {
            event.preventDefault();
            
            // get user role
            $.ajax({
                url : '/get-user-role',
                type : "GET",
                success : async function(res){
                    console.log(res);
                    if (res["success"]){
                        var role = res["role"];

                        // open Fire modal
                        if (role === 0) { //user
                            Swal.fire({
                                title: "Are you sure?",
                                text: 'You won"t be able to revert this!',
                                icon: "question",
                                showCancelButton: true,
                                confirmButtonText: "Yes, create message!",
                                customClass: {
                                    confirmButton: "btn-danger",
                                },
                            }).then(function(result) {
                                // Only one option = user
                                if (result.value) {
                                    saveMessage([1, 999])
                                }
                            });
                        } else { //admin

                            const inputOptions = role === 1 ? { "0": "User", "1": "Company"} : { "0": "User", "1": "Company", "2": "INEX" };

                            const { value: option } = await Swal.fire({
                                title: "Select your preferred option",
                                input: "radio",
                                inputOptions,
                                inputValidator: (value) => {
                                    if (!value) {
                                        return "You need to choose at least one."
                                    }
                                }
                            });

                            if (option) {
                                
                                var range = [1, 999];
                                if (option === "1") range = [1000, 1999];
                                if (option === '2') range = [2000, 2999];

                                saveMessage(range);
                            }
                        }

                    }
                    else{
                        toastr.error("Please try to login");
                    }
                },
                error : function(err){
                    toastr.error("Please refresh your browser");
                }
            })

        })

        // $('#createGrid').on('click', function makeGrid(event) {gridSize
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
        })
        var makeGrid = function () {
            // changeMode();
            // prevent page refreshing when clicking submit
            // event.preventDefault();
            let mouseIsDown = false;
            // let rows = $("#inputHeight").val();
            // let columns = $("#inputWidth").val();
            // const rows = userHeight.value;
            // const columns = userWidth.value;
            const rows = 56;
            const columns = 40;

            // grid.children().remove(); // delete any previous table rows
            while (grid.hasChildNodes()) {
                grid.removeChild(grid.lastChild); // delete any previous table rows
            }

            //Build the grid row by row and then append to the table
            //  project rubrics requires use of for and while loops

            let tableRows = '';
            let r = 1;
            
            var selectedMode = $("#edit-mode").val();
            var blank = 3;
            var j = 1;
            while (r <= rows) {
                if(selectedMode == 0) {
                    var editableRow = parseInt(rows / 3) - blank;
                    var totalRow = rows / 3;
                    if(r > totalRow * j) {
                        j++;
                    }
                    if(r <= totalRow * j - 3) {
                        tableRows += '<tr>';
                    } else {
                        tableRows += '<tr class="disabled">';
                    }
                } else {
                    tableRows += '<tr>';
                }
                for (let c=1; c <= columns; c++) {
                    tableRows += '<td class="' +c+ '"></td>';
                }
                tableRows += '</tr>';
                r += 1;
            } // end while loop
            grid.insertAdjacentHTML('afterbegin', tableRows); // add grid to DOM
            // grid.classList.toggle('flyItIn'); // fly in effect for grid
            // grid.classList.toggle('flyItIn2'); // Twice to trigger reflow
            // Listen for click to paint or erase a tile
            // grid.on('click', 'td', function() {
            //     paintEraseTiles($(this));
            // });
            grid.addEventListener("click", function(event) {
                event.preventDefault();
                paintEraseTiles(event.target);
            });
            grid.addEventListener("touchstart", function(event) {
                event.preventDefault();
                paintEraseTiles(event.target);
            });
            grid.addEventListener("touchmove", function(event) {
                event.preventDefault();
                paintEraseTiles(event.target)
            });

            // Listen for mouse down, up and over for continuous paint and erase

            // grid.on('mousedown', function(event) {
            grid.addEventListener('mousedown', function(event) {
                event.preventDefault();
                mouseIsDown = event.which === 1 ? true : false;
            });
            grid.addEventListener('touchstart', function(event) {
                event.preventDefault();
                mouseIsDown = event.which === 1 ? true : false;
            });

            // document.on('mouseup', function() {
            document.addEventListener('mouseup', function(event) {
                event.preventDefault();
                mouseIsDown = false;
            });

            // grid.on('mouseover', 'td', function() {
            grid.addEventListener('mouseover', function(event) {
                // if (mouseIsDown) {paintEraseTiles($(this));}
                event.preventDefault();
                if (mouseIsDown) {paintEraseTiles(event.target);}
            }); // end continuous paint and erase
        // }); // end grid
        }; // end grid
        makeGrid();

        // paint or erase cells based on the mode (girdTileMode)

        function paintEraseTiles(targetCell) {
            if (targetCell.nodeName === 'TD') {
                if($($(targetCell).parent())[0].className == 'disabled') {
                    return;
                }
                // targetCell.style.backgroundColor = gridTileMode === PAINT ? userColor.value : 'transparent';
                targetCell.style.backgroundColor = 'red';
                //     // $(targetCell).css('background-color', $('#colorPicker').val());
                //     // $(targetCell).css('background-color', 'transparent');
            } else {
                console.log("Nice try: " + targetCell.nodeName + " talk to the hand!");
            }
        }

        $("#inputWidth").on('change', function() {
            $(displayWidth).val($(this).val());
        })
        $("#gridWidthDisplay").on('change', function() {
            $("#inputWidth").val($(this).val());
        })
        $("#inputHeight").on('change', function() {
            $(displayHeight).val($(this).val());
        })
        $("#gridHeightDisplay").on('change', function() {
            $("#inputHeight").val($(this).val());
        })

        $("#colorPicker").on('change', function() {
            gridTileMode = PAINT;
            tileMode.innerHTML = ' ' + gridTileMode;
        })
        // userColor.oninput = function (event){
        //     gridTileMode = PAINT;
        //     tileMode.innerHTML = ' ' + gridTileMode;
        // };
        // Erase colors from the grid

        // clear.on('click', function(){
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

        // $('button').on('click', function(event) {
        if (document.getElementById('mode') !== null) {
            document.getElementById('mode').addEventListener('click', function(event) {
                gridTileMode = event.target.className.indexOf('paint') >=0 ? PAINT : ERASE;
                // $('.paintOrErase').text(' ' + gridTileMode);
                tileMode.innerHTML = ' ' + gridTileMode;
            });
        }


        
        // Alignment

        // the first layer
        $("#alignLeftFirst").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftFirst").classList.add("bg-dark");
            document.getElementById("alignCenterFirst").classList.remove("bg-dark");
            document.getElementById("alignRightFirst").classList.remove("bg-dark");

            alignments[0] = 0;

            justifyAlignment(0);
        })

        $("#alignCenterFirst").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftFirst").classList.remove("bg-dark");
            document.getElementById("alignCenterFirst").classList.add("bg-dark");
            document.getElementById("alignRightFirst").classList.remove("bg-dark");

            alignments[0] = 1;
            justifyAlignment(0);
        })

        $("#alignRightFirst").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftFirst").classList.remove("bg-dark");
            document.getElementById("alignCenterFirst").classList.remove("bg-dark");
            document.getElementById("alignRightFirst").classList.add("bg-dark");

            alignments[0] = 2;
            justifyAlignment(0);
        })

        // the second layer
        $("#alignLeftSecond").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftSecond").classList.add("bg-dark");
            document.getElementById("alignCenterSecond").classList.remove("bg-dark");
            document.getElementById("alignRightSecond").classList.remove("bg-dark");

            alignments[1] = 0;

            justifyAlignment(1);
        })

        $("#alignCenterSecond").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftSecond").classList.remove("bg-dark");
            document.getElementById("alignCenterSecond").classList.add("bg-dark");
            document.getElementById("alignRightSecond").classList.remove("bg-dark");

            alignments[1] = 1;
            justifyAlignment(1);
        })

        $("#alignRightSecond").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftSecond").classList.remove("bg-dark");
            document.getElementById("alignCenterSecond").classList.remove("bg-dark");
            document.getElementById("alignRightSecond").classList.add("bg-dark");

            alignments[1] = 2;
            justifyAlignment(1);
        })

        // the third layer
        $("#alignLeftThird").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftThird").classList.add("bg-dark");
            document.getElementById("alignCenterThird").classList.remove("bg-dark");
            document.getElementById("alignRightThird").classList.remove("bg-dark");

            alignments[2] = 0;

            justifyAlignment(2);
        })

        $("#alignCenterThird").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftThird").classList.remove("bg-dark");
            document.getElementById("alignCenterThird").classList.add("bg-dark");
            document.getElementById("alignRightThird").classList.remove("bg-dark");

            alignments[2] = 1;
            justifyAlignment(2);
        })

        $("#alignRightThird").on("click", function() {
            event.preventDefault();
            
            document.getElementById("alignLeftThird").classList.remove("bg-dark");
            document.getElementById("alignCenterThird").classList.remove("bg-dark");
            document.getElementById("alignRightThird").classList.add("bg-dark");

            alignments[2] = 2;
            justifyAlignment(2);
        })

        // Clear Canvas for New button

        var clearMessage = function () {
            
            $("#inputBox").val('\n\n');
            clearLights();
            
            messages = [];
    
            var trs = $("#pixelCanvas").first().children().children();
            
            for (let i = 0; i < trs.length; i++) {
    
                var tds = trs[i].children
                
                for (let j = 0; j < tds.length; j++) {
                    tds[j].style.backgroundColor = 'white';
                }
            }
        }

        $("#clearMessage").on("click", function () {
            event.preventDefault();

            clearMessage();
        })

    });
</script>