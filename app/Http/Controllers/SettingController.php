<?php

namespace App\Http\Controllers;

use App\Notifications\SettingNoti;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();
        return view('setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('setting.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return redirect()->route('setting.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return redirect()->route('setting.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $this->validate($request, [
            'description' => 'nullable|max:255',
            'meta_key' => 'nullable|max:255',
            'copyright' => 'required|max:255',
            'street' => 'nullable|max:255',
            'post_code' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'min:11|max:255|regex:/(01)[0-9]{9}/',
            'header_logo' => 'nullable|mimes:jpeg,jpg,gif,png|max:200',
            'footer_logo' => 'nullable|mimes:jpeg,jpg,gif,png|max:200',
            'preloader' => 'nullable|mimes:jpeg,jpg,gif,png|max:200',
            'favicon' => 'nullable|mimes:jpeg,jpg,gif,png,ico|max:200',
            'google_analytics_id' => 'nullable|max:255',
            'publisher_id' => 'nullable|max:255',
            'google_map' => 'nullable|max:255',
        ]);

        $setting->description = $request->description;
        $setting->meta_key = $request->meta_key;
        $setting->copyright = $request->copyright;
        $setting->street = $request->street;
        $setting->post_code = $request->post_code;
        $setting->city = $request->city;
        $setting->country = $request->country;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;

        $setting->google_analytics_id = $request->google_analytics_id;
        $setting->publisher_id = $request->publisher_id;
        $setting->google_map = $request->google_map;

        if ($request->hasFile('header_logo')) {
            $image_path = public_path() . '/' . $setting->header_logo;
            if (File::exists($image_path)) {
                File::delete($image_path);
                $file = $request->file('header_logo');
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = 'header-logo' . '.' . $extension;
                $file->move(public_path() . '/', $fileName);
                $setting->header_logo = $fileName;
            }
        }

        if ($request->hasFile('footer_logo')) {
            $image_path = public_path() . '/' . $setting->footer_logo;
            if (File::exists($image_path)) {
                File::delete($image_path);
                $file = $request->file('footer_logo');
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = 'footer-logo' . '.' . $extension;
                $file->move(public_path() . '/', $fileName);
                $setting->footer_logo = $fileName;
            }
        }

        if ($request->hasFile('favicon')) {
            $image_path = public_path() . '/' . $setting->favicon;
            if (File::exists($image_path)) {
                File::delete($image_path);
                $file = $request->file('favicon');
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = 'favicon' . '.' . $extension;
                $file->move(public_path() . '/', $fileName);
                $setting->favicon = $fileName;
            }
        }

        if ($request->hasFile('preloader')) {
            $image_path = public_path() . '/' . $setting->preloader;
            if (File::exists($image_path)) {
                File::delete($image_path);
                $file = $request->file('preloader');
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = 'preloader' . '.' . $extension;
                $file->move(public_path() . '/', $fileName);
                $setting->preloader = $fileName;
            }
        }

        $setting->save();

        auth()
            ->user()
            ->notify(new SettingNoti());
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
