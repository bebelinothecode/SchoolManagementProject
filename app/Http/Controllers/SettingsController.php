<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Session;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings() {
        return view('backend.settings.settings');
    }

    public function savesettings(Request $request) {

        $validatedData = $request->validate([
            'startyear' => 'required|integer',
            'endyear' => 'required|integer',
            'name' => 'required|string'
        ]);

        AcademicYear::create([
            'startyear' => $validatedData['startyear'],
            'endyear' => $validatedData['endyear']
        ]);

        Session::create([
            'name' => $validatedData['name']
        ]);

        return redirect()->back()->with('success','Settings Saved');
    }
}
