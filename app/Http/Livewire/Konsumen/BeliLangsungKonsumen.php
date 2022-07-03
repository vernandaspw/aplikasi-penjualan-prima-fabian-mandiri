<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\KeranjangItem;
use App\Models\MetodeKirim;
use App\Models\MetodePembayaran;
use App\Models\Produk;
use App\Models\ProdukStok;
use App\Models\ProdukStokLog;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use App\Models\TransaksiLog;
use Livewire\Component;

class BeliLangsungKonsumen extends Component
{
    public $alamat;
    public $produk;
    public $qty = 1;
    public $kode_unik, $biaya_kirim, $expired_at;

    public $pengiriman, $pembayaran = [];


    public $metode_kirim_id, $metode_pembayaran_id, $catatan;

    public function tambahitem()
    {
        if ($this->qty < $this->produk->produkstok->po) {
            $this->qty = $this->qty + 1;
        } else {
        }
    }
    public function kurangitem()
    {
        if ($this->qty > 1) {
            $this->qty = $this->qty - 1;
        } else {
            # code...
        }
    }

    public function mount($id)
    {
        $this->produk = Produk::find($id);
        $this->alamat = auth('konsumen')->user();
    }
    public function render()
    {
        $this->pengiriman = MetodeKirim::with('metode_pembayaran')->where('isaktif', true)->get();
        if ($this->metode_kirim_id) {
            $kirim =  MetodeKirim::with('metode_pembayaran')->find($this->metode_kirim_id);
            $this->pembayaran = $kirim->metode_pembayaran->where('isaktif', true);
        }
        return view('livewire.konsumen.beli-langsung-konsumen')->extends('layouts.main')->section('content');
    }

    public function updated()
    {
        // cek kirim, cek biaya
        if ($this->metode_kirim_id) {
            $cek_pengiriman = MetodeKirim::with('metode_pembayaran')->find($this->metode_kirim_id);
            $this->biaya_kirim = $cek_pengiriman->biaya;
        }
        // cek pembayaran ,kode unik, status. lunas

        // cek pembayaran ,kode unik, status. lunas
        if ($this->metode_pembayaran_id) {
            $cek_pembayaran = MetodePembayaran::find($this->metode_pembayaran_id);
            if ($cek_pembayaran->metode == 'bank transfer') {
                $this->kode_unik = rand(100, 999);
                $this->status = 'konfirm';
                $this->expired_at = date('Y-m-d H:i:s', strtotime("+1 day", strtotime(date('Y-m-d H:i:s'))));
            } elseif ($cek_pembayaran->metode == 'dompet digital') {
                $this->kode_unik = rand(100, 999);
                $this->status = 'konfirm';
                $this->expired_at = date('Y-m-d H:i:s', strtotime("+1 day", strtotime(date('Y-m-d H:i:s'))));
            } elseif ($cek_pembayaran->metode == 'cod') {
                $this->status = 'sedang_dikemas';
                $this->kode_unik = 0;
                $this->expired_at = null;
            } elseif ($cek_pembayaran->metode == 'tunai') {
                $this->kode_unik = 0;
                $this->status = 'proses_pembayaran';
                $this->expired_at = date('Y-m-d H:i:s', strtotime("+7 day", strtotime(date('Y-m-d H:i:s'))));
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

        $total_belanja = $this->produk->harga_jual * $this->qty;
        $total_modal = $this->produk->harga_modal * $this->qty;
        $total_berat = $this->produk->berat_kg * $this->qty;

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
                'islunas' => false,
                'pembayaran_expired_at' => $this->expired_at
            ]);

            TransaksiLog::create([
                'transaksi_id' => $buattransaksi->id,
                'status' => $this->status,
            ]);

            TransaksiItem::create([
                'transaksi_id' => $buattransaksi->id,
                'produk_id' => $this->produk->id,
                'qty' => $this->qty,
                'total_harga' => $this->produk->harga_jual * $this->qty,
                'total_modal' =>  $this->produk->harga_modal * $this->qty,
                'total_berat' =>  $this->produk->berat_kg * $this->qty,
            ]);

            $produkstok = ProdukStok::where('produk_id', $this->produk->id)->first();
            $produkstok->update([
                'po' => $produkstok->po - $this->qty,
            ]);

            ProdukStokLog::create([
                'produk_stok_id' => $produkstok->id,
                'jenis' => 'keluar',
                'po' => $produkstok->po - $this->qty,
                'keterangan' => 'pre order'
            ]);

            $this->emit('success', ['pesan' => 'Berhasil buat pesanan']);

            redirect()->to('pesanan-detail/'. $buattransaksi->no_transaksi);
        } catch (\Exception $e) {
            $this->emit('error', ['pesan' => $e->getMessage()]);
        }
    }
}
