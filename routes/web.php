<?php

use App\Http\Livewire\Konsumen\BerandaKonsumen;
use App\Http\Livewire\Konsumen\DaftarKonsumen;
use App\Http\Livewire\Konsumen\KeranjangKonsumen;
use App\Http\Livewire\Konsumen\LoginKonsumen;
use App\Http\Livewire\Konsumen\MainPageKonsumen;
use App\Http\Livewire\Konsumen\PerusahaanKonsumen;
use App\Http\Livewire\Konsumen\ProdukDetailKonsumen;
use App\Http\Livewire\Konsumen\ProdukKonsumen;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('layouts.main');
// });

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('/', MainPageKonsumen::class);
Route::get('/perusahaan', PerusahaanKonsumen::class);
Route::get('/produk', ProdukKonsumen::class);
Route::get('/produk/{id}', ProdukDetailKonsumen::class);

Route::get('/keranjang', KeranjangKonsumen::class);

Route::middleware(['konsumenisnotlogin'])->group(function () {
    Route::get('login', LoginKonsumen::class);
    Route::get('daftar', DaftarKonsumen::class);
});

Route::middleware(['konsumenislogin'])->group(function () {

});


Route::prefix('admin')->group(function () {
    Route::middleware(['adminisnotlogin'])->group(function () {
        Route::get('login', LoginKonsumen::class);
    });

    Route::middleware(['adminisnotlogin'])->group(function () {
        Route::get('dashboard', LoginKonsumen::class);
    });
});

