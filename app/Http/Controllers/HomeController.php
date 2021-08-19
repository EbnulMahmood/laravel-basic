<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function HomeSlider()
    {
        $num_page = 3;
        $sliders = Slider::latest()->paginate($num_page);
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {   
        $validated = $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|max:500',
        ], [
            'title.required' => 'Please input slider title.',
            'title.min' => 'Slider longer than 4 characters.',
            'description.required' => 'Please input slider description.',
            'description.min' => 'Slider greater than 500 characters.',
        ]);

        $slider_image = $request->file('image');
        $upload_location = 'images/slider/';

        $image_name = hexdec(uniqid()).'.'.strtolower($slider_image->getClientOriginalExtension());
        $last_image = $upload_location.$image_name;
        Image::make($slider_image)->resize(1920, 1088)->save($last_image);

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_image,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home-slider')->with('message', 'Slider inserted successfully!')->with('alert', 'success');
    }

    public function Edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|max:500',
        ], [
            'title.required' => 'Please input slider title.',
            'title.min' => 'Slider longer than 4 characters.',
            'description.required' => 'Please input slider description.',
            'description.min' => 'Slider greater than 500 characters.',
        ]);

        $slider_image = $request->file('image');

        if ($slider_image) {
            $upload_location = 'images/slider/';
            $old_image = $request->old_image;
    
            $image_name = hexdec(uniqid()).'.'.strtolower($slider_image->getClientOriginalExtension());
            $last_image = $upload_location.$image_name;
            Image::make($slider_image)->resize(1920, 1088)->save($last_image);

            unlink($old_image);
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_image,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);
        }
        return Redirect()->back()->with('message', 'Slider updated successfully!')->with('alert', 'success');
    }

    public function Delete($id)
    {
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);
        
        Slider::find($id)->delete();
        return Redirect()->back()->with('message', 'Slider deleted successfully!')->with('alert', 'success');
    }
}
