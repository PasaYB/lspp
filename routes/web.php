<?php
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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


Route::get('login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'authenticate']);
Route::post('logout', [LoginController::class,'logout']);
Route::get('logout', [LoginController::class,'logout']);

Route::get('register', [RegisterController::class,'create']);
Route::post('register', [RegisterController::class,'store']);

Route::resource('siswa',SiswaController::class)->middleware('auth');
Route::resource('barang',BarangController::class)->middleware('auth');
Route::resource('kategori',KategoriController::class)->middleware('auth');
Route::resource('barangmasuk',BarangMasukController::class)->middleware('auth');
Route::resource('barangkeluar',BarangKeluarController::class)->middleware('auth');