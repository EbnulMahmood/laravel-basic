<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function AllCategory()
    {
        $num_page = 4;
        $categories = Category::latest()->paginate($num_page);
        $trashCategories = Category::onlyTrashed()->latest()->paginate($num_page - 2);
        // $categories = DB::table('categories')->join('users', 'categories.user_id', 'users.id')->select('categories.*', 'users.name')->latest()->paginate($num_page);
        return view('admin.category.index', compact('categories', 'trashCategories'));
    }

    public function AddCategory(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ], [
            'category_name.required' => 'Please input category name.',
            'category_name.max' => 'Category less than 255 characters.',
        ]);

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now(),
        // ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('message', 'Category inserted successfully!')->with('alert', 'success'); 
    }
    
    public function Edit($id)
    {
        // $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id)
    {
        // $category = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        // ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all-category')->with('message', 'Category updated successfully!')->with('alert', 'success');
    }

    public function SoftDelete($id)
    {
        $category = Category::find($id)->delete();

        return Redirect()->back()->with('message', 'Category Trashed successfully!')->with('alert', 'success'); 
    }

    public function Restore($id)
    {
        $category = Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('message', 'Category restored successfully!')->with('alert', 'success');   
    }

    public function PermanentDelete($id)
    {
        $category = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('message', 'Category permanently deleted successfully!')->with('alert', 'success');   
    }
}
