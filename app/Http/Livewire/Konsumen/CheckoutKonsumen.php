<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\KeranjangItem;
use App\Models\MetodeKirim;
use App\Models\MetodeKirimPembayaran;
use App\Models\MetodePembayaran;
use App\Models\ProdukStok;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use App\Models\TransaksiLog;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class CheckoutKonsumen extends Component
{
    public $alamat;
    public $pengiriman, $pembayaran = [];

    public $itemcart = [];

    public $metode_kirim_id, $metode_pembayaran_id, $catatan;
    public $biaya_kirim, $kode_unik, $status;

    public function mount()
    {
        $this->itemcart = KeranjangItem::with('produk')->where('konsumen_id', auth('konsumen')->user()->id)->where('selected', true)->get();

        $cek = KeranjangItem::where('konsumen_id', auth('konsumen')->user()->id)->where('selected', true)->first();
        if ($cek == null) {
            session()->flash('error');
            redirect('keranjang');
        }

        $this->alamat = auth('konsumen')->user();
    }

    public function render()
    {
        $this->pengiriman = MetodeKirim::with('metode_pembayaran')->where('isaktif', true)->get();
        if ($this->metode_kirim_id) {
            $kirim =  MetodeKirim::with('metode_pembayaran')->find($this->metode_kirim_id);
            $this->pembayaran = $kirim->metode_pembayaran->where('isaktif', true);
        }

        return view('livewire.konsumen.checkout-konsumen')->extends('layouts.main')->section('content');
    }

    public function updated()
    {
        // cek kirim, cek biaya
        if ($this->metode_kirim_id) {
            $cek_pengiriman = MetodeKirim::with('metode_pembayaran')->find($this->metode_kirim_id);
            $this->biaya_kirim = $cek_pengiriman->biaya;
        }
        // cek pembayaran ,kode unik, status. lunas
        if ($this->metode_pembayaran_id) {
            $cek_pembayaran = MetodePembayaran::find($this->metode_pembayaran_id);
            if ($cek_pembayaran->metode == 'bank transfer') {
                $this->kode_unik = rand(100, 999);
                $this->status = 'konfirm';
            } elseif ($cek_pembayaran->metode == 'dompet digital') {
                $this->kode_unik = rand(100, 999);
                $this->status = 'konfirm';
            } elseif ($cek_pembayaran->metode == 'cod') {
                $this->status = 'sedang_dikemas';
                $this->kode_unik = 0;
            } elseif ($cek_pembayaran->metode == 'tunai') {
                $this->kode_unik = 0;
                $this->status = 'konfirm';
            }
        }
    }

    public function buatpesanan()
    {
        $this->validate([
            'catatan' => 'max:100',
            'metode_kirim_id' => 'required',
            'metode_pembayaran_id' => 'required'
        ]);

        $make_no = 'T' . date('Y') . date('m') . date('d') . date('H') . rand(10, 99) . rand(10, 99);
        $cek_transaksi = Transaksi::where('no_transaksi', $make_no)->first();
        if ($cek_transaksi != null) {
            $make_no = 'T' . date('Y') . date('m') . date('d') . date('H') . rand(10, 99) . rand(11, 99);
        }
        $cek_jenis_pemasukan = TransaksiJenis::where('nama', 'pemasukan')->first();
        $cek_kategori_penjualan = TransaksiKategori::where('nama', 'penjualan')->first();

        $total_belanja = KeranjangItem::with('produk')->where('konsumen_id', auth('konsumen')->user()->id)->where('selected', true)->get()->sum('total_harga');
        $total_modal = KeranjangItem::with('produk')->where('konsumen_id', auth('konsumen')->user()->id)->where('selected', true)->get()->sum('total_modal');
        $total_berat = KeranjangItem::with('produk')->where('konsumen_id', auth('konsumen')->user()->id)->where('selected', true)->get()->sum('total_berat');

        $total_pembayaran = $total_belanja + $this->biaya_kirim + $this->kode_unik;
        $laba_penjualan_produk = $total_belanja - $total_modal;
        $laba_penjualan_bersih = $laba_penjualan_produk + $this->biaya_kirim + $this->kode_unik;

        try {
            $buattransaksi = Transaksi::create([
                'no_transaksi' => $make_no,
                'transaksi_jenis_id' => $cek_jenis_pemasukan->id,
                'transaksi_kategori_id' => $cek_kategori_penjualan->id,
                'konsumen_id' => auth('konsumen')->user()->id,
                'metode_kirim_id' => $this->metode_kirim_id,
                'metode_pembayaran_id' => $this->metode_pembayaran_id,
                'total_belanja' => $total_belanja,
                'total_modal' => $total_modal,
                'total_berat' => $total_berat,
                'kode_unik' =>  $this->kode_unik,
                'biaya_kirim' => $this->biaya_kirim,
                'total_pembayaran' => $total_pembayaran,
                'laba_penjualan_produk' => $laba_penjualan_produk,
                'laba_penjualan_bersih' => $laba_penjualan_bersih,
                'catatan' => $this->catatan,
                'status' => $this->status,
                'islunas' => false
            ]);

            TransaksiLog::create([
                'transaksi_id' => $buattransaksi->id,
                'status' => $this->status,
            ]);

            foreach ($this->itemcart as $item) {
                $buat_transaksi_item = TransaksiItem::create([
                    'transaksi_id' => $buattransaksi->id,
                    'produk_id' => $item->produk_id,
                    'qty' => $item->qty,
                    'total_harga' => $item->total_harga,
                    'total_modal' => $item->total_modal,
                    'total_berat' => $item->total_berat
                ]);

                $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();
                $produkstok->update([
                    'po' => $produkstok->po - $item->qty,
                ]);

                if ($buat_transaksi_item) {
                    KeranjangItem::find($item->id)->delete();
                }
            }




            $this->emit('success', ['pesan' => 'Berhasil buat pesanan']);

            redirect()->to('/');
        } catch (\Exception $e) {
            dd($e);
            $this->emit('error', ['pesan' => $e->getMessage()]);
        }
    }
}
