<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

// require_once __DIR__ . '/../../../../vendor/thiagoalessio/tesseract_ocr/src/TesseractOCR.php';
use thiagoalessio\tesseractOCR\TesseractOCR;
// use Intervention\Image\ImageManagerStatic as Image;

class MessageMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $timeArray['now'] = time();
        // $timeArray['login_time'] = Session::get('login_time');
        // dd("time_interval", $timeArray['now'] - $timeArray['login_time']);
        // dd(session('login_time'));

        return view('dashboard.messagemenu');
    }

    public function sendMessage(Request $request) {
        $imagePath = public_path('assets/media/messages/SpeedLimit25.bmp');
        $image = Image::read($imagePath);
        $image->save('temp_image.png');

        // Perform OCR using Tesseract OCR
        // $text = (new TesseractOCR('temp_image.png'))
        //     ->run();

        // unlink('temp_image.png');

        // return view('dashboard.message', ['text' => $text]);
        return view('dashboard.message', ['text' => __DIR__]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
