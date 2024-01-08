<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Promise\Create;
use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate'])->name('login.authenticate');
//Route::get('/logout', [LoginController::class,'logout'])->middleware('auth');
Route::post('/', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('welcome');
})->name('logout')->middleware('auth');
Route::get('/register', [RegisterController::class,'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class,'store'])->name('register.store');

Route::get('/home',[HomeController::class,'index'])->middleware('auth');
Route::get('/administrator',[HomeController::class,'index'])->middleware('auth')->middleware('can:isAdministrator');
Route::get('/admin',[HomeController::class,'index'])->middleware('auth')->middleware('can:isAdmin');
Route::get('/userbiasa',[HomeController::class,'index'])->middleware('auth')->middleware('can:isUserBiasa');

Route::get('/welcome',function(){
    echo "hai";
});

Route::get('/show/{id}', function ($id) {
    echo "nilai saya $id";
    echo "nilai saya ".$id;
});

Route::get('/show/{id?}', function ($id=1) {
    echo "nilai saya $id";
    echo "nilai saya ".$id;
});

Route::get('/edit/{nama}', function ($nama) {
    echo "nilai saya $nama";
})->where('nama','[A-Za-z]+');

Route::get('/create',function() {
    echo "Route diakses menggunakan nama";
})->name('tulis');

Route::get('/index',function() {
    echo "<a href='".route('tulis')."'>Akses route dengan nama </a>";
});

Route::get('/product',[ProductController::class,'index']);
Route::get('/productshow',[ProductController::class,'show']);
Route::get('/productshowall',[ProductController::class,'showAll']);
Route::get('/productstore',[ProductController::class,'store']);
Route::get('/productupdate',[ProductController::class,'update']);
Route::get('/productdelete',[ProductController::class,'delete']);

Route::resource('posts',PostController::class);


Route::get('/halaman',function(){
    $title='Harry Potter';
    $konten='Harry Potter and The Deadly Hallows: Part 2';
    return view('konten.halaman',compact('title','konten'));
});

Route::get('/kategori',[KategoriController::class,'index']);
Route::get('/kategori/store',[KategoriController::class,'store']);
Route::get('/kategori/update',[KategoriController::class,'update']);
Route::get('/kategori/delete',[KategoriController::class,'delete']);

Route::get('/users',[UserController::class,'index']);
Route::get('/categories',[CategoryController::class,'index']);
