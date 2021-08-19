<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MultiPic;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function AllBrand()
    {
        $num_page = 4;
        $brands = Brand::latest()->paginate($num_page);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg, jpeg, png',
        ], [
            'brand_name.required' => 'Please input brand name.',
            'brand_name.min' => 'Brand longer than 4 characters.',
        ]);
        
        $brand_image = $request->file('brand_image');
        $upload_location = 'images/brand/';

        $image_name = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());
        $last_image = $upload_location.$image_name;
        Image::make($brand_image)->resize(300, 200)->save($last_image);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'created_at' => Carbon::now(),
        ]);
        $notification = AlertMessage('Brand inserted successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function Edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ], [
            'brand_name.required' => 'Please input brand name.',
            'brand_name.min' => 'Brand longer than 4 characters.',
        ]);

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $upload_location = 'images/brand/';
            $old_image = $request->old_image;
    
            $image_name = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());
            $last_image = $upload_location.$image_name;
            Image::make($brand_image)->resize(300, 200)->save($last_image);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_image,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = AlertMessage('Brand updated successfully!', 'info');

        return Redirect()->back()->with($notification);
    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);
        
        Brand::find($id)->delete();
        $notification = AlertMessage('Brand deleted successfully!', 'warning');

        return Redirect()->back()->with($notification);
    }

    public function MultiPic()
    {
        $images = MultiPic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function AddImages(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required',
        ]);
        
        $images = $request->file('image');
        
        foreach ($images as $image) {
            $upload_location = 'images/multi/';
            $image_name = hexdec(uniqid()).'.'.strtolower($image->getClientOriginalExtension());
            $last_image = $upload_location.$image_name;
            Image::make($image)->resize(300, 200)->save($last_image);
    
            MultiPic::insert([
                'image' => $last_image,
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->back()->with('message', 'Images inserted successfully!')->with('alert', 'success');
    }

    public function Logout()
    {
        Auth::logout();
        return Redirect()->route('login')->with('message', 'You have successfully logged out!')->with('alert', 'success');
    }
}
