<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Amp\Socket;
use Amp\ByteStream;
use Amp\Socket\ClientTlsContext;
use Amp\Socket\ConnectContext;
use League\Uri\Http;
use function Amp\Socket\connect;
use function Amp\Socket\connectTls;

use Amp\Future;
use Amp\Sync\LocalMutex;
use Amp\Sync\LocalParcel;
use function Amp\async;
use Amp\Log\StreamHandler;

use WebSocket;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Lib;

class SocketController extends Controller {
    private $ip = '192.168.0.220';
    private $port = 2888;

    public function convertBitmapToHex()
    {
        $imagePath = base_path() . '/public/images/002.BMP';

        $manager = new ImageManager(new Driver());
        // Step 1: Open the bitmap file
        // $img = Image::make($imagePath);
        $img = $manager->read($imagePath);
        $imageData = $this->getImageData($img);

        // Step 2: Convert bitmap pixels data to hex
        $hexData = '';
        foreach ($imageData as $pixel) {
            $hexData .= sprintf('%02X', $pixel);
        }

        return $hexData;
    }

    public function getImageData($srcImage)
    {
        $imgWidth = $srcImage->width();
        $imgHeight = $srcImage->height();

        $picData = [];
        for ($i = 0; $i < $imgHeight; $i++) {
            for ($j = 0; $j < $imgWidth; $j++) {
                $colors = $srcImage->pickColor($j, $i);

                $pixelC = 0;

                // Quantize R component
                if ($colors->red()->toInt() > 128) {
                    $pixelC |= 0xE0;
                }

                // Quantize G component
                if ($colors->green()->toInt() > 128) {
                    $pixelC |= 0x1C;
                }

                // Quantize B component
                if ($colors->blue()->toInt() > 128) {
                    $pixelC |= 0x03;
                }

                $picData[] = $pixelC;
            }
        }

        return $picData;
    }

    public function change_brightness(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;

        $bright_val = $request['bright'];
        // $auto = $request['auto'];
        // Data to be sent
        if(strlen(dechex($bright_val)) == 1) {
            $bright_val = str_pad(dechex($bright_val), 2, '0', STR_PAD_LEFT);
        }
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0209') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
            hex2bin('00') .        // byte 00H - Default is 0
            hex2bin($bright_val) .        // byte 00H - Brigthness level 01=dim 1Fh=bright

        // Calculate the Exclusive of all bytes in $Data1 and 7Fh
        // Calculate XOR checksum of each byte with 0x7F
        $eccValue = 0x7F;
        $length = strlen($data1);
        // echo $data1. 'data1';
        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }


        // Display the original data, ECC value, and the new data
        // echo "<br>ECC Value: " . bin2hex($eccValue) . "\n";
        // echo "<br>Single Byte ECC Value: " . bin2hex(chr($eccValue)) ;
        // echo "----------------------" ;
        // echo "<br><br>Command Packet ... Then Command Packet with ECC appended: <br>" ;
        // echo bin2hex($data1) . "<br>";

        // Create a new variable $data by concatenating $data1 and $eccValue
        $data = $data1 . chr($eccValue);
        // echo bin2hex($data) . "\n <br><br>";


        // Open a socket connection
        $response = [];
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        // Send the data

        // echo ". . . sending. . \n";
        // echo $data ;

        // echo "Server  says :";//.$result;
        // print_r($result);

        $res = socket_write($socket, $data, strlen($data));

        // Reply
        $reply = socket_read($socket, 1024);
        // echo "Server Response: ". $reply;

        // echo "<br><br>Reply: " . bin2hex($reply) . "\n <br><br>";
        // echo "-----------------------------" ;


        // $reply = '';
        // socket_set_nonblock($socket);

        // socket_recv($socket, $reply, 1024, 0);

        // echo "<br><br>Reply: " . bin2hex($reply) . "\n <br><br>";
        // echo "-----------------------------" ;

        // Close the connection
        socket_close($socket);

        // echo "<br><br>Connection closed\n";
        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        return $response;
    }

    public function TomTest (Request $request) {
        // Update linux by:
        //   cd /home/linuxadmin/sign-controller
        //   git pull origin main
        //

        echo '2024-04-11 update'."<br>\n";

        $data = 'holy mackerel mackerel mackerel';
//        $compressedData = exec("echo '$data' | /usr/bin/lzop -c | tommyj.lzo");

        echo '==============================' ."<br>\n";
        echo '  Compression test            ' ."<br>\n";
        echo '==============================' ."<br>\n";

        $data = "Data,2°Use!" ;
        $compressed   =  $this->lzocompress($data) ;

        $decompressed = $this->lzodecompress($compressed) ;

      // Show utput the lzocompress() and lzodecompress()

        echo "Original Data:<br>\n";
        echo $data . "<br>\n<br>\n";
        echo "(" . bin2hex($data) . ")<br>\n<br>\n";

        echo "Compressed Data (hex):<br>\n";
        echo "(" . bin2hex($compressed) . ")<br>\n<br>\n";

        echo "Decompressed Data:<br>\n";
        echo $decompressed . "<br>\n";
        echo "(" . bin2hex($decompressed) . ")<br>\n";
        echo '==============================' ."<br>\n";

        return 'Tested';
    }

    public function lzocompress($dataToCompress)
    {
        // Generate temporary file names
        $tempDataFile = tempnam(sys_get_temp_dir(), 'data_');
        $tempCompressedFile = $tempDataFile . '.lzo';

        // Write data to temporary file
        file_put_contents($tempDataFile, $dataToCompress);

        // Compress data using lzop command
        shell_exec("lzop -1f $tempDataFile");

        // Read compressed data from temporary file
        $compressedData = file_get_contents($tempCompressedFile);

        // Clean up/delete the temporary files
        unlink($tempDataFile);
        unlink($tempCompressedFile);

        return $compressedData;
    }

    public function lzodecompress($dataToDecompress)
    {
        // Generate temporary file names
        $tempFileToDecompress = tempnam(sys_get_temp_dir(), 'decompress_');
        $tempDecompressedFile = $tempFileToDecompress . '.tmp';

        // Write compressed data to temporary file
        file_put_contents($tempFileToDecompress, $dataToDecompress);

        // Use lzop command to decompress the data
        shell_exec("lzop -1f -d $tempFileToDecompress");

        // Read decompressed data from temporary file
        $decompressedData = file_get_contents($tempDecompressedFile);

        // Clean up/delete the temporary files
        unlink($tempFileToDecompress);
        unlink($tempDecompressedFile);

        return $decompressedData;
    }


    // public function lzocompress($DataToCompress)  {
    //     $NewTempFile = $this->UniqueFileName() ;
    //     $tempdatafile= "lzopcompress_" . $NewTempFile . ".tmp" ;
    //     $tempcompressedfile= "lzopcompress_" . $NewTempFile . ".tmp.lzo" ;

    //     // Note:  tom.xxx files for debugging are in the HOST operating system
    //     //        in the path /home/inexadmin/sign-controller/src/public
    //     //        after a reboot of host OS, need to run 'docker-compose up -d --build app'

    //     // Make a file with the DATA to compress:

    //    file_put_contents($tempdatafile,$DataToCompress) ;

    //     // use the Command line lzop, to open the file, compress, write to another file:

    //     shell_exec("lzop -1f $tempdatafile ");

    //     $compressedData = "" ;
    //     $compressedData = file_get_contents($tempcompressedfile ) ;

    //     // Clean up/delete the temp files used to pass data to/from LZOP's command line. . .
    //     unlink($tempdatafile);
    //     unlink($tempcompressedfile);

    //   exitit:
    //     return $compressedData  ;
    // }

    // public function lzodecompress($DataToDecompress) {
    //     $NewTempFile = $this->UniqueFileName() ;
    //     $tempfiletodecompress = "lzopdecompress_" . $NewTempFile . ".tmp.lzo" ;
    //     $tempdecompressedfile = "lzopdecompress_" . $NewTempFile . ".tmp" ;

    //     // Make a file with the DATA to compress:
    //     file_put_contents($tempfiletodecompress,$DataToDecompress) ;

    //     // use the Command line lzop, to open the file, compress, write to another file:
    //     shell_exec(" lzop -1f -d $tempfiletodecompress");

    //     // Read back in the compressed data:

    //     $Decompressed = "" ;
    //     $Decompressed =  file_get_contents($tempdecompressedfile) ;

    //     // Clean up/delete the temp files used to pass data to/from LZOP's command line. . .
    //     unlink($tempfiletodecompress);
    //     unlink($tempdecompressedfile);

    //     return $Decompressed ;

    // }


    public function UniqueFileName() {
        $s = strtoupper(md5(uniqid(rand(),true)));
        $guidText =
            substr($s,0,8) . '-' .
            substr($s,8,4) . '-' .
            substr($s,12,4). '-' .
            substr($s,16,4). '-' .
            substr($s,20);
        return $guidText;
    }


    public function get_brightness(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('020A') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
            // hex2bin('00') .
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }
        $data = $data1 . chr($eccValue);
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $response = [];
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $res = socket_write($socket, $data, strlen($data));


        // Reply
        $reply = socket_read($socket, 1024);
        // Close the connection
        socket_close($socket);

        $currentBright = bin2hex($reply);
        $birghtness = hexdec(substr($currentBright, -6, 2));
        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        $response['bright'] = $birghtness;
        return $response;
    }
    // (0101H) Send picture playlist
    public function send_img_playlist(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;
        // Data to be sent
        // $auto = $request['auto'];
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0101') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
            hex2bin($request['page_num']) . // The display page number of the 0th scene, the value range is 0-719, where 0-699 is the user-writable di
            hex2bin('0001') . // Reserved, default is 0
            hex2bin('0001') . // The dwell time unit of Act 0 is 10 millis
            hex2bin('0001') . // Reserved, default is 0
            hex2bin('0001') . // Reserved, default is 0
            hex2bin('0001') . // Reserved, default is 0
            hex2bin('0003') . // The display page number of Act 1, the value range is 0-
            hex2bin('0001') . // Reserved, default is 0
            hex2bin('0001') . // The dwell time unit of Act 1 is 10 milliseconds, and the value
            hex2bin('0001') . // Reserved, default is 0
            hex2bin('0001') . // Reserved, default is 0
            hex2bin('0001') . // Reserved, default is 0
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }
        $data = $data1 . chr($eccValue);
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $response = [];
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $res = socket_write($socket, $data, strlen($data));


        // Reply
        $reply = socket_read($socket, 1024);
        // Close the connection
        socket_close($socket);

        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        return $response;
    }

    public function compress_image(Request $request) {
        // Compress Image
        $contents = File::get(base_path().'/public/images/99.bmp');
        // $contents = base64_encode($contents);
        // $manager = new ImageManager(new Driver());

        // // // read image from file system
        // $image = $manager->read(base_path().'/public/images/99.bmp');

        // // resize image proportionally to 300px width
        // $image->scale($request['width'], $request['height']);
        // // insert watermark
        // // $image->place('images/watermark.png');

        // // save modified image in new format
        // $image->toPng()->save('images/foo.png');
        // $encoded = $image->toJpg();
        // $contents = $encoded;

        $base64 = base64_encode($contents);
        // $hexData = bin2hex($base64);
        $hexData = [3,66,77,182,1,0,0,96,0,0,1,54,0,0,0,40,0,0,0,16,0,0,0,8,0,0,0,1,0,24,120,2,4,0,128,1,0,0,195,14,172,0,128,2,51,19,0,255,255,255,188,2,48,35,0,0,0,0,39,80,0,172,4,42,68,0,51,104,0,51,80,0,172,7,51,104,0,48,80,0,176,5,51,21,0,255,128,0,51,104,0,51,80,0,152,5,212,27,39,128,0,39,196,1,39,32,0,42,104,0,51,80,0,160,4,57,104,0,160,4,180,0,39,152,0,39,32,0,9,0,0,0,0,0,0,0,0,0,0,0,0,17,0,0];
        $data = '';
        for($i = 0; $i < count($hexData); $i++) {
            // echo dechex($hexData[$i]).",";
            $data .= dechex($hexData[$i]);
        }
        $hexData = $data;
        $length = strlen($hexData);
        // $length = 6 + $length;
        $length = 200;
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;

        echo "Opening connection. . .\n<br>";
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0103') .      // dword 020AH - Command Word
            hex2bin($length) .      // dword 0004H - Data Packet Length ('4 bytes')
            hex2bin($request['page_num']) .        // byte 00H - Brigthtness Control 0=auto, 1=manual
            hex2bin($request['width']) .
            hex2bin($request['height']) .        // byte 00H - Brigthtness Control 0=auto, 1=manual
            // hex2bin($hexData) .
            hex2bin($hexData) .

        // Calculate the Exclusive of all bytes in $Data1 and 7Fh
        // Calculate XOR checksum of each byte with 0x7F
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }


        // Display the original data, ECC value, and the new data
        // echo "<br>ECC Value: " . bin2hex($eccValue) . "\n";
        // echo "<br>Single Byte ECC Value: " . bin2hex(chr($eccValue)) ;
        // echo "----------------------" ;
        // echo "<br><br>Command Packet ... Then Command Packet with ECC appended: <br>" ;
        // echo bin2hex($data1) . "<br>";

        // Create a new variable $data by concatenating $data1 and $eccValue
        $data = $data1 . chr($eccValue);
        // echo bin2hex($data) . "\n <br><br>";


        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        // Send the data

        // echo ". . . sending. . \n";
        // echo $data ;

        // echo "Server  says :";//.$result;
        // print_r($result);

        $res = socket_write($socket, $data, strlen($data));

        // return $res;


        // Reply
        $reply = socket_read($socket, 1024);
        // echo "Server Response: ". $reply;

        // echo "<br><br>Reply: " . bin2hex($reply) . "\n <br><br>";
        // echo "-----------------------------" ;


        // $reply = '';
        // socket_set_nonblock($socket);

        // socket_recv($socket, $reply, 1024, 0);

        // echo "<br><br>Reply: " . bin2hex($reply) . "\n <br><br>";
        // echo "-----------------------------" ;


        // Close the connection
        socket_close($socket);

        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        return $response;
    }

    public function compress_image_test(Request $request) {
        // $hexData = bin2hex($base64);
        $hexData = [3,66,77,182,1,0,0,96,0,0,1,54,0,0,0,40,0,0,0,16,0,0,0,8,0,0,0,1,0,24,120,2,4,0,128,1,0,0,195,14,172,0,128,2,51,19,0,255,255,255,188,2,48,35,0,0,0,0,39,80,0,172,4,42,68,0,51,104,0,51,80,0,172,7,51,104,0,48,80,0,176,5,51,21,0,255,128,0,51,104,0,51,80,0,152,5,212,27,39,128,0,39,196,1,39,32,0,42,104,0,51,80,0,160,4,57,104,0,160,4,180,0,39,152,0,39,32,0,9,0,0,0,0,0,0,0,0,0,0,0,0,17,0,0];
        $data = '';
        for($i = 0; $i < count($hexData); $i++) {
            // echo dechex($hexData[$i]).",";
            $data .= dechex($hexData[$i]);
        }
        $hexData = $data;
        $length = strlen($hexData);
        // $length = 6 + $length;
        $length = 200;
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;

        echo "Opening connection. . .\n<br>";
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0103') .      // dword 020AH - Command Word
            hex2bin($length) .      // dword 0004H - Data Packet Length ('4 bytes')
            hex2bin($request['page_num']) .        // byte 00H - Brigthtness Control 0=auto, 1=manual
            hex2bin($request['width']) .
            hex2bin($request['height']) .        // byte 00H - Brigthtness Control 0=auto, 1=manual
            hex2bin($hexData) .

        // Calculate the Exclusive of all bytes in $Data1 and 7Fh
        // Calculate XOR checksum of each byte with 0x7F
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }

        // Create a new variable $data by concatenating $data1 and $eccValue
        $data = $data1 . chr($eccValue);

        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        $res = socket_write($socket, $data, strlen($data));

        // Reply
        $reply = socket_read($socket, 1024);

        // Close the connection
        socket_close($socket);

        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        return $response;
    }

    // (0105H) Switch display mode
    public function swith_mode(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;
        // Data to be sent
        if(!isset($request['mode'])) {
            return "Please add mode in your request body";
        }
        $mode = $request['mode'];
        // $auto = $request['auto'];
        // Data to be sent
        if(strlen(dechex($mode)) == 1) {
            $mode = str_pad(dechex($mode), 2, '0', STR_PAD_LEFT);
        }
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0105') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
            hex2bin($mode) .
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }
        $data = $data1 . chr($eccValue);
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $response = [];
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $res = socket_write($socket, $data, strlen($data));


        // Reply
        $reply = socket_read($socket, 1024);
        // Close the connection
        socket_close($socket);

        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        return $response;
    }

    // (0106H) Query the current play screen number
    public function get_current_number(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0106') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
            // hex2bin('00') .
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }
        $data = $data1 . chr($eccValue);
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $response = [];
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $res = socket_write($socket, $data, strlen($data));


        // Reply
        $reply = socket_read($socket, 1024);
        // Close the connection
        socket_close($socket);

        $currentBright = bin2hex($reply);
        $birghtness = hexdec(substr($currentBright, -6, 4));
        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        $response['number'] = $birghtness;
        return $response;
    }
    // (0107H) Query the play picture data of the specified scene number (picture data package read back)
    public function send_picture_specific_screen(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;
        // Paramenter
        $pageNum = $request['pageNum'];
        $contractNum = $request['contractNum'];
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0107') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
            hex2bin($pageNum) .
            hex2bin($contractNum) .
            // hex2bin('00') .
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }
        $data = $data1 . chr($eccValue);
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $response = [];
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $res = socket_write($socket, $data, strlen($data));


        // Reply
        $reply = socket_read($socket, 1024);
        // Close the connection
        socket_close($socket);

        $currentBright = bin2hex($reply);
        $birghtness = hexdec(substr($currentBright, -6));
        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        $response['number'] = $birghtness;
        return $response;
    }
    // (0109H) Read back the current playlist
    public function get_current_playlist(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('0109') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }
        $data = $data1 . chr($eccValue);
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $response = [];
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $res = socket_write($socket, $data, strlen($data));


        // Reply
        $reply = socket_read($socket, 1024);
        // Close the connection
        socket_close($socket);
        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        return $response;
    }
    // (020DH) Read hardware information height and width
    public function read_information(Request $request) {
        // IP address and port
        $ip = $this->ip;
        $port = $this->port;
        // Data to be sent
        $data1 =hex2bin('5948') .      // dword 5948H - Command Header
            hex2bin('0101') .      // dword 0101H - Address Word
            hex2bin('020D') .      // dword 020AH - Command Word
            hex2bin('0002') .      // dword 0004H - Data Packet Length ('4 bytes')
            // hex2bin('00') .
        $eccValue = 0x7F;
        $length = strlen($data1);

        for ($i = 0; $i < $length; $i++) {
            $byte = ord($data1[$i]); // Get the ASCII value of the byte
            $eccValue ^= $byte; // XOR with the current byte
        }
        $data = $data1 . chr($eccValue);
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $response = [];
        if ($socket === false) {
            $response['success'] = false;
            $response['message'] = "Socket creation failed";
            return $response;
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        }

        // Connect to the server
        $result = socket_connect($socket, $ip, $port);
        if ($result === false) {
            $response['success'] = false;
            $response['message'] = "Socket connection failed";
            return $response;
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $res = socket_write($socket, $data, strlen($data));


        // Reply
        $reply = socket_read($socket, 1024);
        // Close the connection
        socket_close($socket);

        $currentBright = bin2hex($reply);
        $width = hexdec(substr($currentBright, -10, 4));
        $height = hexdec(substr($currentBright, -6, 4));
        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        $response['width'] = $width;
        $response['height'] = $height;
        return $response;
    }

    public function send_image_test(Request $request) {
        #step1: convert from BMP to hex data
        $imageData = $this->convertBitmapToHex();

        #step2: compress by lzo
        // $compressedData = gzcompress($imageData);
        $compressedData = $this->lzocompress($imageData);

        #step3: send to Sign
        $res = $this->pack1LZO(103, 56, 40, 1, $compressedData);
        return $res;
    }


    public function send_image_socket(Request $request) {

        $contents = file_get_contents(base_path().'/public/assets/media/signmessage/' . $request->imageName);

        $output = '';
        for($i=0; $i < strlen($contents); $i++) {
            $output .= str_pad(dechex(ord($contents[$i])), 2, '0', STR_PAD_LEFT);
        }

        $length = str_pad(dechex(strlen($contents)), 4, '0', STR_PAD_LEFT);

        // // Data to be sent
        $data1 = '5948' .      // dword 5948H - Command Header
            '0101' .      // dword 0101H - Address Word
            '0103' .      // dword 0103H : LZO Compression Mode- Command Word
            $length .
            $output;

        // Calculate the Exclusive of all bytes in $Data1 and 7Fh
        // Calculate XOR checksum of each byte with 0x7F

        $eccValue = 0x7F;

        for ($i = 0; $i < strlen($data1); $i += 2) {
            $byte = hexdec($data1[$i].$data1[$i + 1]);
            $byte = str_pad(decbin($byte), 8, '0', STR_PAD_LEFT);

            $eccValue = str_pad(decbin($eccValue), 8, '0', STR_PAD_LEFT);

            // echo $byte . ' ';
            // echo $eccValue . ' ';

            $new = '';

            for ($j = 0; $j < 8; $j++) {

                $new .= (int)($byte[$j] xor $eccValue[$j]);

            }

            $eccValue = bindec($new);

            // echo $new . ' ';
            // echo $eccValue . '|';
        }


        $data = $data1 . dechex($eccValue);
        $data = lzo_compress($data, LZO1X_999);
        echo $data;

        // Create a new variable $data by concatenating $data1 and $eccValue
        // $data = $data1 . chr($eccValue);
        // echo $eccValue;
        // echo chr($eccValue);
        // echo $data;

        // // Open a socket connection
        // $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        // if ($socket === false) {
        //     echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        // }

        // // Connect to the server
        // $result = socket_connect($socket, $this->ip, $this->port);
        // if ($result === false) {
        //     echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        // }

        // $res = socket_write($socket, $data, strlen($data));

        // // Reply
        // $reply = socket_read($socket, 1024);

        // // Close the connection
        // socket_close($socket);


        $response['success'] = true;
        // $response['result'] = bin2hex($reply);
        return $response;
    }

    public function pack1LZO($function, $screenW, $screenH, $pNb, $str)
    {
        // Construct the packet
        $writeBuffer = [
            0x59,
            0x48,
            0x01,
            0x01,
            intval($function / 100),
            $function % 100,
            0x00, // Placeholder for length (to be calculated later)
            0x00,
            intval($pNb / 256),
            $pNb % 256,
            intval($screenW / 256),
            $screenW % 256,
            intval($screenH / 256),
            $screenH % 256,
        ];

        // Append data
        $lzoBytes = str_split($str);
        foreach ($lzoBytes as $byte) {
            $writeBuffer[] = ord($byte);
        }

        // Set length in the packet
        $length = count($writeBuffer) - 6; // Length excluding header (4 bytes) and length bytes (2 bytes)
        $writeBuffer[6] = intval($length / 256);
        $writeBuffer[7] = $length % 256;

        // Calculate CRC (XOR checksum)
        // $eccValue = 0x7F;
        // foreach ($writeBuffer as $byte) {
        //     $eccValue ^= $byte;
        // }

        // Calculate CRC16 checksum
        // $crc = $this->calculateCRC16($writeBuffer);
        $crc = $this->calculateCRC16(implode('', array_map('chr', $writeBuffer)));

        // Append CRC to the packet
        $writeBuffer[] = ($crc >> 8) & 0xFF;  // High byte of CRC
        $writeBuffer[] = $crc & 0xFF;         // Low byte of CRC

        // Convert to binary string
        $packet = '';
        foreach ($writeBuffer as $byte) {
            $packet .= chr($byte);
        }

        // Send data...
        // Open a socket connection
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
            $response['success'] = false;
            $response['result'] = "socket error";

            return $response;
        }

        // Connect to the server
        $result = socket_connect($socket, $this->ip, $this->port);
        if ($result === false) {
            echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
            $response['success'] = false;
            $response['result'] = "socket error";

            return $response;
        }

        $res = socket_write($socket, $packet, strlen($packet));

        // Reply
        $reply = socket_read($socket, 1024);

        // Close the connection
        socket_close($socket);

        $response['success'] = true;
        $response['result'] = bin2hex($reply);
        return $response;
    }

    /**
     * Calculate CCITT CRC16 checksum of data.
     *
     * @param string $data Data for which CCITT CRC16 checksum is to be calculated.
     * @return int CCITT CRC16 checksum.
     */
    public function calculateCRC16($data)
    {
        // CRC-16 lookup table
        $crcTable = array(
            0x0000, 0x1021, 0x2042, 0x3063, 0x4084, 0x50a5, 0x60c6, 0x70e7,
            0x8108, 0x9129, 0xa14a, 0xb16b, 0xc18c, 0xd1ad, 0xe1ce, 0xf1ef,
            0x1231, 0x0210, 0x3273, 0x2252, 0x52b5, 0x4294, 0x72f7, 0x62d6,
            0x9339, 0x8318, 0xb37b, 0xa35a, 0xd3bd, 0xc39c, 0xf3ff, 0xe3de,
            0x2462, 0x3443, 0x0420, 0x1401, 0x64e6, 0x74c7, 0x44a4, 0x5485,
            0xa56a, 0xb54b, 0x8528, 0x9509, 0xe5ee, 0xf5cf, 0xc5ac, 0xd58d,
            0x3653, 0x2672, 0x1611, 0x0630, 0x76d7, 0x66f6, 0x5695, 0x46b4,
            0xb75b, 0xa77a, 0x9719, 0x8738, 0xf7df, 0xe7fe, 0xd79d, 0xc7bc,
            0x48c4, 0x58e5, 0x6886, 0x78a7, 0x0840, 0x1861, 0x2802, 0x3823,
            0xc9cc, 0xd9ed, 0xe98e, 0xf9af, 0x8948, 0x9969, 0xa90a, 0xb92b,
            0x5af5, 0x4ad4, 0x7ab7, 0x6a96, 0x1a71, 0x0a50, 0x3a33, 0x2a12,
            0xdbfd, 0xcbdc, 0xfbbf, 0xeb9e, 0x9b79, 0x8b58, 0xbb3b, 0xab1a,
            0x6ca6, 0x7c87, 0x4ce4, 0x5cc5, 0x2c22, 0x3c03, 0x0c60, 0x1c41,
            0xedae, 0xfd8f, 0xcdec, 0xddcd, 0xad2a, 0xbd0b, 0x8d68, 0x9d49,
            0x7e97, 0x6eb6, 0x5ed5, 0x4ef4, 0x3e13, 0x2e32, 0x1e51, 0x0e70,
            0xff9f, 0xefbe, 0xdfdd, 0xcffc, 0xbf1b, 0xaf3a, 0x9f59, 0x8f78,
            0x9188, 0x81a9, 0xb1ca, 0xa1eb, 0xd10c, 0xc12d, 0xf14e, 0xe16f,
            0x1080, 0x00a1, 0x30c2, 0x20e3, 0x5004, 0x4025, 0x7046, 0x6067,
            0x83b9, 0x9398, 0xa3fb, 0xb3da, 0xc33d, 0xd31c, 0xe37f, 0xf35e,
            0x02b1, 0x1290, 0x22f3, 0x32d2, 0x4235, 0x5214, 0x6277, 0x7256,
            0xb5ea, 0xa5cb, 0x95a8, 0x8589, 0xf56e, 0xe54f, 0xd52c, 0xc50d,
            0x34e2, 0x24c3, 0x14a0, 0x0481, 0x7466, 0x6447, 0x5424, 0x4405,
            0xa7db, 0xb7fa, 0x8799, 0x97b8, 0xe75f, 0xf77e, 0xc71d, 0xd73c,
            0x26d3, 0x36f2, 0x0691, 0x16b0, 0x6657, 0x7676, 0x4615, 0x5634,
            0xd94c, 0xc96d, 0xf90e, 0xe92f, 0x99c8, 0x89e9, 0xb98a, 0xa9ab,
            0x5844, 0x4865, 0x7806, 0x6827, 0x18c0, 0x08e1, 0x3882, 0x28a3,
            0xcb7d, 0xdb5c, 0xeb3f, 0xfb1e, 0x8bf9, 0x9bd8, 0xabbb, 0xbb9a,
            0x4a75, 0x5a54, 0x6a37, 0x7a16, 0x0af1, 0x1ad0, 0x2ab3, 0x3a92,
            0xfd2e, 0xed0f, 0xdd6c, 0xcd4d, 0xbdaa, 0xad8b, 0x9de8, 0x8dc9,
            0x7c26, 0x6c07, 0x5c64, 0x4c45, 0x3ca2, 0x2c83, 0x1ce0, 0x0cc1,
            0xef1f, 0xff3e, 0xcf5d, 0xdf7c, 0xaf9b, 0xbfba, 0x8fd9, 0x9ff8,
            0x6e17, 0x7e36, 0x4e55, 0x5e74, 0x2e93, 0x3eb2, 0x0ed1, 0x1ef0
        );

        $crc = 0xFFFF; // Initial CRC value

        // Calculate CRC16 checksum of the data
        $length = strlen($data);
        for ($i = 0; $i < $length; $i++) {
            $crc = (($crc << 8) ^ $crcTable[($crc >> 8) ^ ord($data[$i])]) & 0xFFFF;
        }

        return $crc;
    }

}
