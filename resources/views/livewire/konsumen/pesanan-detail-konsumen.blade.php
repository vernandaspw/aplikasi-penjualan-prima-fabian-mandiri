<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('/pesanan') }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>Pesanan Detail</b></span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <livewire:konsumen.component.icon-cart-konsumen />
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="padding-top: 75px; padding-bottom: 80px;">
        <div class="d-flex justify-content-between">
            <div class="" style="text-transform: uppercase">
                <b>{{ $transaksi->status }}</b>
            </div>
            <div class="" style="color: {{ env('COLOR_PRIMARY') }}">
                <a href="{{ url('cetak-nota', $transaksi->no_transaksi) }}" class="text-decoration-none text-warning">Nota</a> |
                <a href="{{ url('cetak-surat-jalan', $transaksi->no_transaksi) }}" class="text-decoration-none" style="color: {{ env('COLOR_PRIMARY') }}">Surat jalan</a> |
                <a href="{{ url('riwayat-perjalanan', $transaksi->no_transaksi) }}" class="text-decoration-none">Lihat
                    Perjalanan</a>
            </div>
        </div>
        <div class="mt-2">

        </div>
        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                <b>{{ $transaksi->no_transaksi }}</b>
            </div>
            <div class="">
                <span
                    style="color: {{ $transaksi->islunas == 1 ? 'green' : 'red' }}">({{ $transaksi->islunas == 1 ? 'sudah bayar' : 'belum bayar' }})</span>
            </div>
        </div>

        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                Tanggal pembelian
            </div>
            <div class="">
                {{ \Carbon\Carbon::parse($transaksi->created_at)->isoFormat('D MMMM Y') }}
            </div>
        </div>
        <hr class="my-0 mt-1">
        <div class="mt-2">
            <b>Rincian produk</b>
        </div>
        <div class="mt-2">
            @forelse ($transaksi->transaksiitem as $data)
                <div class="card mb-1 shadow-sm border border-light">
                    <div class="card-body ">
                        <div class="d-flex justify-content-start">
                            @forelse ($data->produk->gambar as $gambar)
                                @if ($gambar->no == 1)
                                    <img src="{{ $gambar->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar->img)) }}"
                                        width="45px" height="45px" class="rounded" alt="...">
                                @endif
                            @empty
                                @if ($gambar->no == 1)
                                    <img src="{{ asset('imagenotfound.jpg') }}" width="45px" height="45px"
                                        class="rounded" alt="...">
                                @endif
                            @endforelse

                            <div class="ms-3">
                                <h6 class="card-title">{{ $data->produk->nama }}</h6>
                                <div style="font-size: 13px" class="card-text text-muted my-0">
                                    @uang($data->produk->harga_jual) x {{ $data->qty }}
                                    {{ $data->produk->produkstok->satuan_unit }} (@rating($data->produk->berat_kg) kg)
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-between pt-2 align-items-center">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="card-text my-0">
                                    <div class="" style="font-size: 12px">
                                        Total harga</div>
                                    <div class="" style="font-size: 14px"><b>@uang($data->produk->harga_jual * $data->qty)</b></div>
                                </div>
                            </div>
                            <div class="kanan">
                                @if ($data->transaksi->status == 'selesai')
                                    @if ($data->produkulasan)
                                    <a href="{{ url('produk', $data->produk_id) }}"
                                        class="btn btn rounded text-white"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                                        Beli lagi
                                    </a>
                                    @else
                                        <a href="{{ url('beri-ulasan-input', $data->id) }}"
                                            class="btn btn rounded text-white"
                                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                                            Beri ulasan
                                        </a>
                                    @endif
                                @endif
                                {{-- <button wire:click="deleteitem('{{ $data->id }}')"
                                        class="btn btn-sm btn-transparent">
                                        <img src="{{ asset('trash.png') }}" alt="">
                                    </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                tidak ada produk
            @endforelse
        </div>
        <hr class="my-0 mt-1">
        <div class="mt-2">
            <b>Rincian pengiriman</b>
        </div>
        <div class="mt-1 d-flex justify-content-between">
            <div class="">
                Kurir
            </div>
            <div class="">
                {{ $transaksi->metodekirim->metode }}
            </div>
        </div>
        <div class="mt-1 d-flex justify-content-between">
            <div class="">
                No Resi
            </div>
            <div class="">
                {{ $transaksi->no_resi != null ? $transaksi->no_resi : '-' }}
            </div>
        </div>
        <div class="mt-1 d-flex justify-content-between">
            <div class="">
                Alamat
            </div>
            <div class="">
                {{ $transaksi->konsumen->alamat != null ? $transaksi->konsumen->alamat : '-' }}
            </div>
        </div>
        <hr class="my-0 mt-1">
        <div class="mt-2">
            <b>Rincian pembayaran</b>
        </div>
        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                Metode pembayaran
            </div>
            <div class="">
                {{ $transaksi->metodepembayaran->metode }} - {{ $transaksi->metodepembayaran->nama }}
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                Status bayar
            </div>
            <div class="">
                <span
                    style="color: {{ $transaksi->islunas == 1 ? 'green' : 'red' }}">({{ $transaksi->islunas == 1 ? 'sudah bayar' : 'belum bayar' }})</span>
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                Total Belanja
            </div>
            <div class="">
                @uang($transaksi->total_belanja)
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                Kode unik
            </div>
            <div class="">
                @uang($transaksi->kode_unik)
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                Biaya pengiriman
            </div>
            <div class="">
                @uang($transaksi->biaya_kirim)
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-between">
            <div class="">
                <b>Total Pembayaran</b>
            </div>
            <div class="">
                <b>@uang($transaksi->total_pembayaran)</b>
            </div>
        </div>
    </div>


    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: white">
        <div class="container">
            <ul class="py-1 navbar-nav nav-justified w-100 align-items-center">

                <li class="nav-item" style="margin-left: 2px">

                    {{-- <button type="button" wire:click="konfirm('{{ $transaksi->id }}')"
                        class="nav-link rounded-pill btn m-1 text-white text-center"
                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                            Konfirm Pembayaran
                        </span>
                    </button> --}}
                    @if ($transaksi->status == 'konfirm')
                        @if (now() < $transaksi->pembayaran_expired_at)
                            <a href="{{ url('pembayaran', $transaksi->no_transaksi) }}"
                                class="nav-link rounded-pill btn m-1 text-white text-center"
                                style="background-color: {{ env('COLOR_PRIMARY') }}">
                                <span class="small d-block" style="font-size: 15px">
                                    Konfirm Pembayaran
                                </span>
                            </a>
                        @else
                            <button disabled type="button"
                                class="nav-link rounded-pill btn m-1 text-white text-center"
                                style="background-color: {{ env('COLOR_PRIMARY') }}">
                                <span class="small d-block" style="font-size: 15px">
                                    Pembayaran expired
                                </span>
                            </button>
                        @endif
                    @elseif($transaksi->status == 'proses_pembayaran')
                        <button disabled type="button" class="nav-link rounded-pill btn m-1 text-white text-center"
                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                            <span class="small d-block" style="font-size: 15px">
                                Pembayaran sedang di cek admin
                            </span>
                        </button>
                    @elseif($transaksi->status == 'sedang_antar')
                        <button onclick="confirm('yakin pesanan telah diterima?') || event.stopImmediatePropagation()"
                            wire:click="diterima('{{ $transaksi->id }}')" type="button"
                            class="nav-link rounded-pill btn m-1 text-white text-center"
                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                            <span class="small d-block" style="font-size: 15px">
                                Terima <span>{{ $transaksi->islunas == true ? '' : 'dan dibayar' }}</span>
                            </span>
                        </button>

                        </button>
                    @else
                    @endif
                </li>
            </ul>
        </div>
    </nav>

    @push('script')
        <script>
            Livewire.on('success', data => {
                console.log(data.pesan);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: data.pesan,
                    showConfirmButton: false,
                    timer: 1500
                })
            })
            Livewire.on('error', data => {
                console.log(data.pesan);
                Swal.fire({
                    title: 'error!',
                    text: data.pesan,
                    icon: 'error',
                    confirmButtonText: 'oke'
                })
            })
        </script>
    @endpush
</div>
