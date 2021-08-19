<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $num_brand = 8;
    $num_image = 9;
    $brands = DB::table('brands')->take($num_brand)->get();
    $about = DB::table('home_abouts')->first();
    $images = DB::table('multi_pics')->latest()->take($num_image)->get();
    return view('home', compact('brands', 'about', 'images'));
});

// Route::get('/home', function () {
//     return 'This is home.';
// });

// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/contact', [ContactController::class, 'index'])->name('con');

// category route
Route::get('/category/all', [CategoryController::class, 'AllCategory'])->name('all-category');

Route::post('/category/add', [CategoryController::class, 'AddCategory'])->name('store-category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::get('softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);

Route::get('category/restore/{id}', [CategoryController::class, 'Restore']);

Route::get('permanentdelete/category/{id}', [CategoryController::class, 'PermanentDelete']);

// brand route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all-brand');

Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store-brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);

Route::post('/brand/update/{id}', [BrandController::class, 'Update']);

Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

// multi image route
Route::get('/multi/image', [BrandController::class, 'MultiPic'])->name('multi-image');

Route::post('/multi/add', [BrandController::class, 'AddImages'])->name('store-image');

// user route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/route', [BrandController::class, 'Logout'])->name('user-logout');

// admin route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home-slider');

Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add-slider');

Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store-slider');

Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);

Route::post('/slider/update/{id}', [HomeController::class, 'Update']);

Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);

// about route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home-about');

Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add-about');

Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store-about');

Route::get('/about/edit/{id}', [AboutController::class, 'Edit']);

Route::post('/about/update/{id}', [AboutController::class, 'Update']);

Route::get('/about/delete/{id}', [AboutController::class, 'Delete']);

// portfolio route
Route::get('/portfolio', [FrontController::class, 'Portfolio'])->name('portfolio');

// admin: contact route
Route::get('/admin/contact', [ContactController::class, 'Contact'])->name('admin-contact');

Route::get('/add/contact', [ContactController::class, 'AddContact'])->name('add-contact');

Route::post('/store/contact', [ContactController::class, 'StoreContact'])->name('store-contact');

Route::get('/contact/edit/{id}', [ContactController::class, 'Edit']);

Route::post('/contact/update/{id}', [ContactController::class, 'Update']);

Route::get('/contact/delete/{id}', [ContactController::class, 'Delete']);

// admin: contact route
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin-message');

Route::get('/message/delete/{id}', [ContactController::class, 'DeleteMessage']);

// home: contact route
Route::get('/contact', [FrontController::class, 'HomeContact'])->name('contact');

Route::post('/contact/form', [FrontController::class, 'ContactForm'])->name('contact-form');

// change-password and user profile route
Route::get('/user/password', [PasswordController::class, 'ChangePassword'])->name('change-password');

Route::post('/update/password', [PasswordController::class, 'UpdatePassword'])->name('update-password');

Route::get('/user/profile', [ProfileController::class, 'UpdateProfile'])->name('update-profile');

Route::post('/update/profile', [ProfileController::class, 'UpdateUserProfile'])->name('update-user-profile');
