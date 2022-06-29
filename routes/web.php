<?php

use App\Http\Livewire\Admin\CatatTransaksiAdmin;
use App\Http\Livewire\Admin\DashboardAdmin;
use App\Http\Livewire\Admin\KelolaAkunAdmin;
use App\Http\Livewire\Admin\KelolaPembayaranAdmin;
use App\Http\Livewire\Admin\KelolaPengaturanAdmin;
use App\Http\Livewire\Admin\KelolaPengirimAdmin;
use App\Http\Livewire\Admin\KelolaProdukAdmin;
use App\Http\Livewire\Admin\KelolaProdukKategoriAdmin;
use App\Http\Livewire\Admin\KelolaProdukMerekAdmin;
use App\Http\Livewire\Admin\KelolaStokAdmin;
use App\Http\Livewire\Admin\KelolaTransaksiAdmin;
use App\Http\Livewire\Admin\LaporanKeuanganAdmin;
use App\Http\Livewire\Admin\LaporanPenjualanAdmin;
use App\Http\Livewire\Admin\LaporanProdukAdmin;
use App\Http\Livewire\Admin\LoginAdmin;
use App\Http\Livewire\Admin\PenjualanAdmin;
use App\Http\Livewire\Admin\PesananMasukAdmin;
use App\Http\Livewire\Admin\ProsesAntarAdmin;
use App\Http\Livewire\Admin\SelesaiAdmin;
use App\Http\Livewire\Konsumen\BerandaKonsumen;
use App\Http\Livewire\Konsumen\CheckoutKonsumen;
use App\Http\Livewire\Konsumen\DaftarKonsumen;
use App\Http\Livewire\Konsumen\KeranjangKonsumen;
use App\Http\Livewire\Konsumen\LoginKonsumen;
use App\Http\Livewire\Konsumen\MainPageKonsumen;
use App\Http\Livewire\Konsumen\PerusahaanKonsumen;
use App\Http\Livewire\Konsumen\ProdukDetailKonsumen;
use App\Http\Livewire\Konsumen\ProdukKonsumen;
use Illuminate\Support\Facades\Route;


// Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('/', MainPageKonsumen::class);
Route::get('/perusahaan', PerusahaanKonsumen::class);
Route::get('/produk', ProdukKonsumen::class);
Route::get('/produk/{id}', ProdukDetailKonsumen::class);


Route::middleware(['konsumenisnotlogin'])->group(function () {
    Route::get('login', LoginKonsumen::class);
    Route::get('daftar', DaftarKonsumen::class);
});
Route::middleware(['konsumenislogin'])->group(function () {
    Route::get('/keranjang', KeranjangKonsumen::class);
    Route::get('/checkout', CheckoutKonsumen::class);
    
});


Route::prefix('admin')->group(function () {
    Route::middleware(['adminisnotlogin'])->group(function () {
        Route::get('login', LoginAdmin::class);
    });
    Route::middleware(['adminislogin'])->group(function () {
        Route::get('/', DashboardAdmin::class);
        Route::middleware(['administrator'])->group(function () {
            Route::get('kelola-akun', KelolaAkunAdmin::class);
            Route::get('kelola-pengaturan', KelolaPengaturanAdmin::class);
        });
        Route::middleware(['admin'])->group(function () {
            Route::get('penjualan', PenjualanAdmin::class);
            Route::get('catat-transaksi', CatatTransaksiAdmin::class);
            Route::get('kelola-transaksi', KelolaTransaksiAdmin::class);
            Route::get('kelola-produk', KelolaProdukAdmin::class);
            Route::get('kelola-produk-kategori', KelolaProdukKategoriAdmin::class);
            Route::get('kelola-produk-merek', KelolaProdukMerekAdmin::class);
            Route::get('kelola-stok', KelolaStokAdmin::class);
            Route::get('metode-pengiriman]', KelolaPengirimAdmin::class);
            Route::get('metode-pembayaran', KelolaPembayaranAdmin::class);
        });
        Route::middleware(['logistik'])->group(function () {
            Route::get('pesanan-masuk', PesananMasukAdmin::class);
            Route::get('proses-antar', ProsesAntarAdmin::class);
            Route::get('selesai', SelesaiAdmin::class);
        });
        Route::middleware(['pimpinan'])->group(function () {
            Route::get('laporan-keuangan', LaporanKeuanganAdmin::class);
            Route::get('laporan-penjualan', LaporanPenjualanAdmin::class);
            Route::get('laporan-produk', LaporanProdukAdmin::class);
        });
    });
});

