<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $screenSettings = Setting::pluck('value', 'key')->toArray();
        return view('dashboard.system-settings', compact('screenSettings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'num_messages_to_keep' => 'required|integer|min:1',
            'screen_pixels_high' => 'required|integer|min:1',
            'screen_pixels_wide' => 'required|integer|min:1',
            'font_pixels_high' => 'required|integer|min:1',
            'font_pixels_wide' => 'required|integer|min:1',
            'top_blank_rows' => 'required|integer|min:0',
            'between_1st_2nd_row' => 'required|integer|min:0',
            'between_2nd_3rd_row' => 'required|integer|min:0',
            'blank_lines_bottom' => 'required|integer|min:0',
        ]);

        // Ensure proper alignment formula
        $expectedHeight =
            $request->top_blank_rows +
            $request->font_pixels_high +
            $request->between_1st_2nd_row +
            $request->font_pixels_high +
            $request->between_2nd_3rd_row +
            $request->font_pixels_high +
            $request->blank_lines_bottom;

        if ($expectedHeight != $request->screen_pixels_high) {
            return back()->withErrors(['screen_pixels_high' => 'The alignment does not match the total screen height.']);
        }

        foreach ($validated as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => now()]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
