<?php

namespace App\Http\Livewire\Admin;

use App\Models\KeranjangItem;
use App\Models\MetodeKirim;
use App\Models\MetodePembayaran;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\ProdukStok;
use App\Models\ProdukStokLog;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use App\Models\TransaksiLog;
use Livewire\Component;

class PenjualanAdmin extends Component
{
    public $keranjangitem = [];

    public $jml_belanja, $totalbelanja;

    public $show = false;
    public $created_at;


    public $pengiriman, $pembayaran = [];
    public $metode_kirim_id, $metode_pembayaran_id, $catatan;

    public $nama_konsumen, $nowa_konsumen, $alamat_konsumen;

    public $islunas = false;

    public $bukanambilditempat;

    public $biaya_kirim, $kode_unik, $biaya_kirim_tambahan, $status, $expired_at;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->created_at = date("Y-m-d H:i");
        $kirim = MetodeKirim::where('metode', 'ambil ditempat')->first();
        $this->metode_kirim_id = $kirim->id;
        $this->biaya_kirim = $kirim->biaya == 0 ? null : $kirim->biaya;

        $this->bukanambilditempat = $kirim->metode != 'ambil ditempat' ? true : false;
        $this->metode_pembayaran_id = MetodePembayaran::where('metode', 'tunai')->first()->id;
        $cek_pembayaran = MetodePembayaran::find($this->metode_pembayaran_id);
        if ($cek_pembayaran->metode == 'bank transfer') {
            $this->kode_unik = rand(100, 999);
            $this->status = 'proses_pembayaran';
            $this->islunas = false;
            $this->expired_at = null;
        } elseif ($cek_pembayaran->metode == 'dompet digital') {
            $this->kode_unik = rand(100, 999);
            $this->status = 'proses_pembayaran';
            $this->islunas = false;
            $this->expired_at = null;
        } elseif ($cek_pembayaran->metode == 'cod') {
            $this->status = 'sedang_dikemas';
            $this->kode_unik = 0;
            $this->islunas = false;
            $this->expired_at = null;
        } elseif ($cek_pembayaran->metode == 'tunai') {
            $this->kode_unik = 0;
            $this->status = 'proses_pembayaran';
            $this->islunas = false;
            $this->expired_at = null;
        }
    }

    public function updated()
    {
        if ($this->metode_kirim_id) {
            $kirim = MetodeKirim::find($this->metode_kirim_id);
            $this->biaya_kirim = $kirim->biaya;
            $this->bukanambilditempat = $kirim->metode != 'ambil ditempat' ? true : false;
            $this->show = true;
        }
        if ($this->metode_pembayaran_id) {
            $cek_pembayaran = MetodePembayaran::find($this->metode_pembayaran_id);
            if ($cek_pembayaran->metode == 'bank transfer') {
                $this->kode_unik = rand(100, 999);
                $this->status = 'proses_pembayaran';
                $this->islunas = false;
                $this->expired_at = null;
            } elseif ($cek_pembayaran->metode == 'dompet digital') {
                $this->kode_unik = rand(100, 999);
                $this->status = 'proses_pembayaran';
                $this->islunas = false;
                $this->expired_at = null;
            } elseif ($cek_pembayaran->metode == 'cod') {
                $this->status = 'sedang_dikemas';
                $this->kode_unik = 0;
                $this->islunas = false;
                $this->expired_at = null;
            } elseif ($cek_pembayaran->metode == 'tunai') {
                $this->kode_unik = 0;
                $this->status = 'proses_pembayaran';
                $this->islunas = false;
                $this->expired_at = null;
            }
            $this->show = true;
        }
        if ($this->created_at) {
            $this->show = true;
        }
        if ($this->islunas) {
            $this->show = true;
        }
        if ($this->biaya_kirim_tambahan) {
            $this->show = true;
        }
        if ($this->biaya_kirim) {
            $this->show = true;
        }
        if ($this->catatan) {
            $this->show = true;
        }
    }

    public function render()
    {

        $this->keranjangitem = KeranjangItem::with('produk')->where('pegawai_id', auth('pegawai')->user()->id)->get();
        $this->jml_belanja = KeranjangItem::with('produk', 'keranjang')->where('pegawai_id', auth('pegawai')->user()->id)->get()->count();
        $this->totalbelanja = KeranjangItem::with('produk', 'keranjang')->where('pegawai_id', auth('pegawai')->user()->id)->get()->sum('total_harga');

        $this->pengiriman = MetodeKirim::with('metode_pembayaran')->where('isaktif', true)->get();
        if ($this->metode_kirim_id) {
            $kirim =  MetodeKirim::with('metode_pembayaran')->find($this->metode_kirim_id);
            $this->pembayaran = $kirim->metode_pembayaran->where('isaktif', true);
        }
        return view('livewire.admin.penjualan-admin')->extends('layouts.main')->section('content');
    }

    public function showOff()
    {
        $this->show = false;
    }

    public function hapuscartitem($id)
    {
        KeranjangItem::with('produk')->find($id)->delete();

        $this->show = true;
    }

    public function deleteallcartitem()
    {
        $keranjangitem =   KeranjangItem::where('pegawai_id', auth('pegawai')->user()->id)->get();
        foreach ($keranjangitem as $data) {
            KeranjangItem::with('produk')->find($data->id)->delete();
        }

        $this->emit('success', ['pesan' => 'berhasil hapus semua item di keranjang']);
        $this->show = false;
    }

    public function tambahitem($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty <= 999999999) {
            if ($data->qty < $data->produk->produkstok->po) {
                $qty = $data->qty + 1;
                $totalharga =  $data->produk->harga_jual * $qty;
                $totalmodal =  $data->produk->harga_modal * $qty;
                $totalberat =  $data->produk->berat_kg * $qty;
                $qty_update = $data->update([
                    'qty' => $qty,
                    'total_harga' => $totalharga,
                    'total_modal' => $totalmodal,
                    'total_berat' => $totalberat
                ]);
                $this->show = true;
            } else {
            }
        } else {
        }
    }
    public function kurangitem($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty > 1) {
            $qty = $data->qty - 1;
            $totalharga =  $data->produk->harga_jual * $qty;
            $totalmodal =  $data->produk->harga_modal * $qty;
            $totalberat =  $data->produk->berat_kg * $qty;
            $qty_update = $data->update([
                'qty' => $qty,
                'total_harga' => $totalharga,
                'total_modal' => $totalmodal,
                'total_berat' => $totalberat
            ]);
            $this->show = true;
        } else {
        }
    }

    public function tambahitemManual($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty <= 999999999) {
            $qty = $data->qty + 1;
            $totalharga =  $data->harga_jual * $qty;
            $totalmodal =  $data->harga_modal * $qty;
            $totalberat =  $data->berat * $qty;
            $qty_update = $data->update([
                'qty' => $qty,
                'total_harga' => $totalharga,
                'total_modal' => $totalmodal,
                'total_berat' => $totalberat
            ]);

            $this->show = true;
        } else {
        }
    }
    public function kurangitemManual($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty > 1) {
            $qty = $data->qty - 1;
            $totalharga =  $data->harga_jual * $qty;
            $totalmodal =  $data->harga_modal * $qty;
            $totalberat =  $data->berat * $qty;
            $qty_update = $data->update([
                'qty' => $qty,
                'total_harga' => $totalharga,
                'total_modal' => $totalmodal,
                'total_berat' => $totalberat
            ]);
            $this->show = true;
        } else {
        }
    }

    public function buatpesanan()
    {

        $this->validate([
            'catatan' => 'nullable|max:100',
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

        $total_belanja = KeranjangItem::with('produk')->where('pegawai_id', auth('pegawai')->user()->id)->get()->sum('total_harga');
        $total_modal = KeranjangItem::with('produk')->where('pegawai_id', auth('pegawai')->user()->id)->get()->sum('total_modal');
        $total_berat = KeranjangItem::with('produk')->where('pegawai_id', auth('pegawai')->user()->id)->get()->sum('total_berat');

        $total_pembayaran = $total_belanja + $this->biaya_kirim + $this->biaya_kirim_tambahan + $this->kode_unik;
        $laba_penjualan_produk = $total_belanja - $total_modal;
        $laba_penjualan_bersih = $laba_penjualan_produk + $this->biaya_kirim + $this->biaya_kirim_tambahan + $this->kode_unik;

        // dd([
        //     'no_transaksi' => $make_no,
        //     'transaksi_jenis_id' => $cek_jenis_pemasukan->id,
        //     'transaksi_kategori_id' => $cek_kategori_penjualan->id,
        //     'pegawai_id' => auth('pegawai')->user()->id,
        //     'nama_konsumen' => $this->nama_konsumen,
        //     'nowa_konsumen' => $this->nowa_konsumen,
        //     'alamat_konsumen' => $this->alamat_konsumen,
        //     'metode_kirim_id' => $this->metode_kirim_id,
        //     'metode_pembayaran_id' => $this->metode_pembayaran_id,
        //     'total_belanja' => $total_belanja,
        //     'total_modal' => $total_modal,
        //     'total_berat' => $total_berat,
        //     'kode_unik' =>  $this->kode_unik,
        //     'biaya_kirim' => $this->biaya_kirim + $this->biaya_kirim_tambahan,
        //     'total_pembayaran' => $total_pembayaran,
        //     'laba_penjualan_produk' => $laba_penjualan_produk,
        //     'laba_penjualan_bersih' => $laba_penjualan_bersih,
        //     'catatan' => $this->catatan,
        //     'status' => $this->status,
        //     'islunas' => $this->islunas,
        //     'pembayaran_expired_at' => $this->expired_at
        // ]);

        try {
            $buattransaksi = Transaksi::create([
                'no_transaksi' => $make_no,
                'transaksi_jenis_id' => $cek_jenis_pemasukan->id,
                'transaksi_kategori_id' => $cek_kategori_penjualan->id,
                'pegawai_id' => auth('pegawai')->user()->id,
                'nama_konsumen' => $this->nama_konsumen,
                'nowa_konsumen' => $this->nowa_konsumen,
                'alamat_konsumen' => $this->alamat_konsumen,
                'metode_kirim_id' => $this->metode_kirim_id,
                'metode_pembayaran_id' => $this->metode_pembayaran_id,
                'total_belanja' => $total_belanja,
                'total_modal' => $total_modal,
                'total_berat' => $total_berat,
                'kode_unik' =>  $this->kode_unik,
                'biaya_kirim' => $this->biaya_kirim + $this->biaya_kirim_tambahan,
                'total_pembayaran' => $total_pembayaran,
                'laba_penjualan_produk' => $laba_penjualan_produk,
                'laba_penjualan_bersih' => $laba_penjualan_bersih,
                'catatan' => $this->catatan,
                'status' => $this->status,
                'islunas' => $this->islunas,
                'pembayaran_expired_at' => $this->expired_at
            ]);

            TransaksiLog::create([
                'transaksi_id' => $buattransaksi->id,
                'status' => $this->status,
            ]);

            foreach ($this->keranjangitem as $item) {
                $buat_transaksi_item = TransaksiItem::create([
                    'transaksi_id' => $buattransaksi->id,
                    'produk_id' => $item->produk_id != null ? $item->produk_id : null,
                    'nama_produk' => $item->nama_produk,
                    'harga_jual' => $item->harga_jual,
                    'harga_modal' => $item->harga_modal,
                    'berat' => $item->berat,
                    'qty' => $item->qty,
                    'total_harga' => $item->total_harga,
                    'total_modal' => $item->total_modal,
                    'total_berat' => $item->total_berat
                ]);

                if ($item->produk_id) {
                    $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();
                    $produkstok->update([
                        'po' => $produkstok->po - $item->qty,
                    ]);

                    ProdukStokLog::create([
                        'produk_stok_id' => $produkstok->id,
                        'jenis' => 'keluar',
                        'po' => $item->qty,
                        'keterangan' => 'pre order'
                    ]);
                }

                if ($buat_transaksi_item) {
                    KeranjangItem::find($item->id)->delete();
                }
            }

            $this->emit('success', ['pesan' => 'Berhasil buat pesanan']);

            $cod = MetodePembayaran::where('metode', 'cod')->first()->id;
            if ($buattransaksi->metode_pembayaran_id == $cod) {
                redirect()->to('admin/penjualan/bayar/berhasil/'. $buattransaksi->no_transaksi);
            }else {
                redirect()->to('admin/penjualan/bayar/' . $buattransaksi->no_transaksi);
            }
        } catch (\Exception $e) {
            dd($e);
            $this->emit('error', ['pesan' => $e->getMessage()]);
        }
    }
}
