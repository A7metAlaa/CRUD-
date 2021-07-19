<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\BrandController;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;



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

/*************************** Email Verrification ***************************************** */

//The Email Verification Notice

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');




//The Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Resending The Verification Email

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/***************************** FrontEnd pages ********************************************** */

 Route::get('/', function () {
     $brands = DB::table('brands')->get();
     $abouts = DB::table('home_abouts')->first();  //Query Builder
     $images = Multipic::all();//Elquoent ORM
     return view('home',compact('brands','abouts','images'));
 });
/*
Route::get('/',function(){
    return view('home');
});*/

Route::get('/about', function () {
    return view('about');
});

Route::get('/home',function()
    {echo 'THis is home page As A result returned from'; });


/*************************** Contact Controller  ************************************************/
Route::get('/contact=ashfasdhgashdghas',[ContactController::class, 'index'])->name('ariyan');


/*************************** Category Controller  ************************************************/

Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');

Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);

Route::get('/softdelete/category/{id}',[CategoryController::class,'SoftDelete']);

Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);

Route::get('/pdelete/category/{id}',[CategoryController::class,'Pdelete']);


/************************ Brand Route --Controller ************************************ */
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}',[BrandController::class,'Update']);
Route::get('brand/delete/{id}',[BrandController::class,'Delete']);


/****************************  Muli Route / Controller *********************************** */
Route::get('/multi/image',[BrandController::class,'Multipic'])->name('multi.image');
Route::post('/multi/add',   [BrandController::class,'StoreImage'])->name('store.image');


/*****************************   Authentication    ******************************************* */


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    // $users = User::all();   
    
    //$users = DB::table('users')->get();

    //return view('admin.index',compact('users'));

    return view('admin.index');
})->name('dashboard');


/************************* Dashboard****************************************/

//User Logout
Route::get('user/logout',[BrandController::class,'Logout'])->name('user.logout');

//Change Password User Profile
Route::get('/user/password',[ChangePass::class,'CPassword'])->name('change.password');
Route::post('password/update',[ChangePass::class,'UpdatePassword'])->name('password.update');

/************************* Admin Routes **************************** */

//Slider route

Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');

Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');

Route::post('store.slider',[HomeController::class,'StoreSlider'])->name('store.slider');

Route::get('slider/edit/{id}',[HomeController::class,'EditSlider']);
Route::post('/slider/update/{id}',[HomeController::class,'UpdateSlider']);
Route::get('/slider/delete/{id}',[HomeController::class,'Delete']);


//About Route
Route::post('update/homeabout/{id}',[AboutController::class,'UpdateAbout']);
Route::get('/home/About',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/add/About',[AboutController::class,'addabout'])->name('add.about');
Route::post('/store/about',[AboutController::class,'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class,'EditAbout']);
Route::post('update/homeabout/{id}',[AboutController::class,'UpdateAbout']);
Route::get('about/delete/{id}',[AboutController::class,'DeleteAbout']);

//Potfolio Page Route
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');

//Admin Contact Page Route
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class,'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact',[ContactController::class,'AdminStoreContact'])->name('store.contact');
Route::get('/admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');

Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::get('/contact/edit/{id}',[ContactController::class,'Edit']);
Route::post('/update/contact/{id}',[ContactController::class,'UpdateContact']);
Route::get('/contact/delete/{id}',[ContactController::class,'DeleteContact']);
Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');
Route::get('/message/delete/{id}',[ContactController::class,'DeleteMessage']);

//User Profile

Route::get('/user/profile',[ChangePass::class,'PUpdate'])->name('profile.update');
Route::post('/user/profile/update',[ChangePass::class,'UpdateProfile'])->name('update.user.profile');

