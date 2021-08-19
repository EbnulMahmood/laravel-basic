<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\MultiPic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function HomeAbout()
    {
        $num_page = 4;
        $homeabout = HomeAbout::latest()->paginate($num_page);
        return view('admin.home.index', compact('homeabout'));
    }

    public function AddAbout()
    {
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:4',
            'short_description' => 'required|min:10',
            'long_description' => 'required|min:10',
        ], [
            'title.required' => 'Please input title.',
            'title.min' => 'Title longer than 4 characters.',
            'short_description.min' => 'Short description longer than 10 characters.',
            'long_description.min' => 'Long description longer than 10 characters.',
        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('home-about')->with('message', 'About inserted successfully!')->with('alert', 'success');
    }

    public function Edit($id)
    {
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit', compact('homeabout'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:4',
            'short_description' => 'required|min:10',
            'long_description' => 'required|min:10',
        ], [
            'title.required' => 'Please input title.',
            'title.min' => 'Title longer than 4 characters.',
            'short_description.min' => 'Short description longer than 10 characters.',
            'long_description.min' => 'Long description longer than 10 characters.',
        ]);

        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);
        return Redirect()->route('home-about')->with('message', 'About updated successfully!')->with('alert', 'success');
    }

    public function Delete($id)
    {
        $delete = HomeAbout::find($id)->delete();
        return Redirect()->back()->with('message', 'About deleted successfully!')->with('alert', 'success');
    }
}
