<?php

use App\Http\Livewire\Konsumen\BerandaKonsumen;
use App\Http\Livewire\Konsumen\DaftarKonsumen;
use App\Http\Livewire\Konsumen\LoginKonsumen;
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


Route::get('/', BerandaKonsumen::class);

Route::middleware(['konsumenisnotlogin'])->group(function () {
    Route::get('login', LoginKonsumen::class);
    Route::get('daftar', DaftarKonsumen::class);
});

Route::middleware(['konsumenislogin'])->group(function () {

});


