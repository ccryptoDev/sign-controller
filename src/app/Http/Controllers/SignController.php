<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Image;

class SignController extends Controller
{
    public function sign_editor(Request $request) {
        return view('user.sign.editor');
    }

    public function edit_message(Request $request) {
        return view('user.sign.edit-message');
    }

    public function get_user_role(Request $request) {
        
        $response["role"] = Auth::user()->level;
        $response["success"] = true;

        return $response;
    }

    // public function get_range(Request $request) {
        
    //     // 0, user role 
    //     $response["range"] = [1, 999];
    //     $response["success"] = true;

    //     if ($request["role"] === 1) { // admin role
    //         if ($request["option"] === 0) { // user option
    //             // keep [1, 999]
    //         } else { // company option
    //             $response["range"] = [1000, 1999];
    //         }
    //     }

    //     if ($request["role"] === 2) { // superadmin role
    //         if ($request["option"] === 0) { // user option
    //             // keep [1, 999]
    //         } else if($request["option"] === 1){ // company option
    //             $response["range"] = [1000, 1999];
    //         } else { //INEX option
    //             $response["range"] = [2000, 2999];
    //         }
    //     }

    //     return $response;

    // }

    public function save_message(Request $request) {
        
        Storage::disk("public")->putFileAs("assets/media/signmessage", $request->base64Image, $request->imageName.".".$request->imageType);
        
        // get max value for imageNo
        $existedNo = Image::where("no", ">=", $request["range"][0])->where("no", "<=", $request["range"][1])->max("no");

        if (!$existedNo) {
            $no = $request["range"][0];
        } else {
            $no = $existedNo + 1;
        }

        // Save a message into database (Missing validator)
        $image = new Image;

        $image->no = $no;
        $image->type = $request->imageType;
        $image->name = $request->imageName.".".$request->imageType;
        $image->path = "public/assets/media/signmessage";
        $image->keywords = $request->imageKeywords;

        $image->save(); 
        
        $response["success"] = true;
        return $response;
    }
}
