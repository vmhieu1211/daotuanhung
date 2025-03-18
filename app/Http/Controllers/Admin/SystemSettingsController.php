<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SystemSettingsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('password.confirm');
    }

    public function index()
    {
        $setting = SystemSetting::firstOrFail();

        return view('admin.settings.index', compact('setting'));
    }

    public function edit($slug)
    {
        $setting = SystemSetting::where('slug', $slug)->firstOrFail();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $slug)
    {
         $request->validate([
            'name' => 'required',
            'tel' => 'required',
            'address' => 'required',
            'email' => 'required',
            'logo' => 'image',
        ]);
         $setting = SystemSetting::where('slug', $slug)->firstOrFail();

        $data = $request->only([
            'name',
            'email',
            'tel',
            'logo',
            'favicon',
            'address',
            'description',

        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $logoPath = $request->file('logo')->store('uploads/logos', 'public');
            $data['logo'] = $logoPath;
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $faviconPath = $request->file('favicon')->store('uploads/logos', 'public');
            $data['favicon'] = $faviconPath;
        }

        if (request('logo')) {
            $setting->update(array_merge(
                $data,
                ['logo' => $logoPath],
                ['favicon' => isset($faviconPath) ? $faviconPath : '']
            ));
        } elseif (request('favicon')) {
            $setting->update(array_merge(
                $data,
                ['favicon' => $faviconPath]
            ));
        } else {
            $setting->update($data);
        }
        // $setting->update($data);
        return redirect()->route('system-settings.index')->with('success', 'Company info updated successfully');
    }
}
