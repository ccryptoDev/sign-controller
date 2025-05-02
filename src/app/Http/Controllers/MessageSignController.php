<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MessageSignController extends Controller
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
        $images = collect(Storage::disk('public')->files('assets/media/signmessage'))->map(function ($item) {
            return basename($item);
        });
        // dd("dfsdfafasf");
        // dd(Storage::disk('public') ->files('assets/media/signmessage'));
        // dd("imagesList", $images);

        // dd($images);

        return view('dashboard.messagesign', compact('images'));
    }

    public function send_to_sign(Request $request) {

        // $images = collect(Storage::disk('public')->files('assets/media/signmessage'))->map(function ($item) {
        //     return basename($item);
        // });

        $numMessages = Setting::where('key', 'num_messages_to_keep')->value('value') ?? 30;

        $userLevel = auth()->user()->level;

        $query = Image::select('no', 'name', 'path', 'keywords', 'user_level')
            ->orderBy('id', 'desc')
            ->limit($numMessages);

        if ($userLevel == 0) {
            $query->where('user_id', auth()->user()->id);
        } elseif ($userLevel == 1) {
            $query->where('user_level', 0);
        } elseif ($userLevel == 2) {
            $query->where('user_level', 1);
        } else {
            $query->whereRaw('1 = 0');
        }

        $images = $query->get();

        return view('dashboard.send-to-sign', compact('images'));
    }

    public function libraryMessages(Request $request) {

        // $images = collect(Storage::disk('public')->files('assets/media/signmessage'))->map(function ($item) {
        //     return basename($item);
        // });

        $numMessages = Setting::where('key', 'num_messages_to_keep')->value('value') ?? 30;
        $query = Image::select('no', 'name', 'path', 'keywords', 'user_level')->orderBy('id','desc')->limit($numMessages);

        $userLevel = auth()->user()->level;
        if ($userLevel == 0 || $userLevel == 1) {
            $query->where('user_level', 1);
        } elseif ($userLevel == 2) {
            $query->where('user_level', 2);
        } else {
            $query->whereRaw('1 = 0');
        }

        $images = $query->get();

        return view('dashboard.library-messages', compact('images'));
    }

    public function deleteMessage($ids) {
        $messageIds = explode(',', $ids);

        // Get the images before deleting
        $images = Image::whereIn('no', $messageIds)->get();

        foreach ($images as $image) {
            $filePath = str_replace('public/', '', $image->path) . '/' . $image->name;

            // Delete the file if it exists
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        // Delete the DB records
        Image::whereIn('no', $messageIds)->delete();

        return response()->json(['success' => true]);
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
