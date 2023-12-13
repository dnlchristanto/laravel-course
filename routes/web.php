<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;

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
