<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $messagesToKeep = Setting::where('key', 'num_messages_to_keep')->value('value') ?? 30;
        return view('dashboard.system-settings', compact('messagesToKeep'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'num_messages_to_keep' => 'required|integer|min:1|max:200',
        ]);

        Setting::updateOrCreate(
            ['key' => 'num_messages_to_keep'],
            ['value' => $request->num_messages_to_keep]
        );

        return redirect()->back()->with('success', 'Settings updated!');
    }
}
