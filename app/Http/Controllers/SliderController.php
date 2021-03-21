<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Slider::all();
        return view('slider.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|min:5|max:255',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,gif,png|max:300',
        ]);

        $slider = new Slider();
        $slider->text = $request->text;
        $slider->status = $request->status;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = time() . '-' . 'slider-image' . '.' . $extension;
            $file->move('front/images/slider', $fileName);
            $slider->image = $fileName;
        }

        $slider->save();

        Toastr::success('Slider Added Successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('slider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('slider.create', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {

        $this->validate($request, [
            'text' => 'required|min:5|max:255',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,gif,png|max:300',
        ]);

        $slider->text = $request->text;
        $slider->status = $request->status;

        if ($request->hasFile('image')) {
            $image_path = public_path() . '/front/images/slider/' . $slider->image;
            if (File::exists($image_path)) {
                File::delete($image_path);
                $file = $request->file('image');
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = time() . '-' . 'slider-image' . '.' . $extension;
                $file->move('front/images/slider', $fileName);
                $slider->image = $fileName;
            }
        }

        $slider->save();

        Toastr::success('Slider Update Successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $image_path = public_path() . '/front/images/slider/' . $slider->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $slider->delete();
        Toastr::success('Slider Delete Successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('slider.index');
    }
}
