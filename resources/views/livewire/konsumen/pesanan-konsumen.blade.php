<div>
    @if ($transaksi == 'login')
        <livewire:konsumen.login-konsumen />
    @else
        <nav class="p-1 navbar navbar-dark navbar-expand fixed-top shadow-sm"
            style="background-color: {{ env('COLOR_PRIMARY') }}">
            <div class="container-fluid">
                <ul class="navbar-nav me-2 form-control w-full d-flex align-items-center bg-white p-0 rounded">
                    <li class="nav-item me-2 ms-1 ">
                        <span class="text-white">
                            <img src="{{ asset('logo.png') }}" width="20px" alt="">
                        </span>
                    </li>
                    <input wire:model='cari' class="form-control rounded border border-right-0 border-1 py-2"
                        type="cari no transaksi" placeholder="cari produk" aria-label="cariproduk">
                </ul>
                <ul class="navbar-nav ms-auto  w-full">
                    <li class="nav-item">
                        <livewire:konsumen.component.icon-cart-konsumen />
                    </li>
                </ul>
            </div>
        </nav>

        <div class="d-md-block d-lg-block d-xl-block d-none">
            <div class="body" style="padding-top: 65px; padding-bottom: 65px;">
                <div class="row">
                    <div class="col-md-2">
                        <div class="container-lg container-fluid">
                            <div class="mt-2 text-center">
                                <h5><b>MENU</b></h5>
                            </div>
                            <hr class="mt-0 pt-0">
                            <a href="{{ url('/') }}" class="card text-decoration-none border-0 shadow-sm "
                                style="border-radius: 160px; background-color: {{ Request::is('/') == '/' ? env('COLOR_PRIMARY') . '; color: white;' : '; color:black;' }}">
                                <div class="card-body py-2">
                                    <div class="text-center">
                                        Beranda
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('pesanan') }}" class="card mt-2 text-decoration-none border-0 shadow-sm "
                                style="border-radius: 160px; background-color: {{ Request::is('pesanan*') == 'pesanan*' ? env('COLOR_PRIMARY') . '; color: white;' : '; color:black;' }}">
                                <div class="card-body py-2">
                                    <div class="text-center">
                                        Pesanan
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('akun') }}" class="card mt-2 text-decoration-none border-0 shadow-sm "
                                style="border-radius: 160px; background-color: {{ Request::is('akun*') == 'akun*' ? env('COLOR_PRIMARY') . '; color: white;' : '; color:black;' }}">
                                <div class="card-body py-2">
                                    <div class="text-center">
                                        Akun
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="container-fluid container-lg">
                            @forelse ($transaksi as $data)
                                <div class="card mt-1 shadow-sm border-light">
                                    <div class="card-body py-2">
                                        <a href="{{ url('pesanan-detail', $data->no_transaksi) }}"
                                            class="text-decoration-none text-dark">
                                            <div class="d-flex justify-content-between">
                                                <div class="kiri">
                                                    {{ $data->no_transaksi }}
                                                </div>
                                                <div class="kanan">
                                                    {{ $data->status }}
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div class="mt-2 d-flex justify-content-start align-items-start">
                                                {{-- @dd($data->transaksiitem->first()) --}}
                                                {{-- @foreach ($data->transaksiitem->first() as $item) --}}

                                                <div class="kiri">
                                                    <img src="{{ $data->transaksiitem->first()->produk->gambar->first()->img == null ? asset('imagenotfound.jpg') : Storage::url($data->transaksiitem->first()->produk->gambar->first()->img) }}"
                                                        width="65px" height="65px" class="rounded" alt="...">


                                                </div>
                                                <div class="kanan ms-2">
                                                    <b><span
                                                            style="font-size: 14px">{{ $data->transaksiitem->first()->produk->nama }}</span></b>
                                                    <div class="" style="font-size: 13px">
                                                        @uang($data->transaksiitem->first()->produk->harga_jual) x {{ $data->transaksiitem->first()->qty }} qty
                                                    </div>

                                                    <div class="" style="font-size: 13px">
                                                        @uang($data->transaksiitem->first()->produk->harga_jual * $data->transaksiitem->first()->qty)
                                                    </div>
                                                </div>
                                                {{-- @endforeach --}}
                                            </div>
                                            <div class="mt-1">
                                                @if ($data->transaksiitem->count() != 1)
                                                    +{{ $data->transaksiitem->count() - 1 }}
                                                    produk lainnya
                                                @endif

                                            </div>
                                        </a>
                                        <hr class="my-0">
                                        <div class="mt-2 d-flex justify-content-between align-items-center">
                                            <div class="kir">
                                                <div class="text-muted">
                                                    Total pesanan
                                                </div>
                                                <div class="">
                                                    <b>@uang($data->total_pembayaran)</b><span
                                                        style="color: {{ $data->islunas == 1 ? 'green' : 'red' }}">({{ $data->islunas == 1 ? 'sudah bayar' : 'belum bayar' }})</span>
                                                </div>
                                            </div>
                                            <div class="kanan">
                                                @if ($data->status == 'selesai')
                                                    {{-- cek transaksiitem yang produkulasan kosong --}}
                                                    @if($data->transaksiitem->whereNull('produk_ulasan_id')->first())
                                                    <a href="{{ url('beri-ulasan') }}" class="btn btn rounded text-white"
                                                    style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                    Beri ulasan
                                                </a>
                                                    @endif
                                                @elseif($data->status == 'konfirm')
                                                    @if (now() < $data->pembayaran_expired_at)
                                                        <a href="{{ url('pembayaran', $data->no_transaksi) }}"
                                                            class="btn btn rounded text-white"
                                                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                            Sudah bayar
                                                        </a>
                                                    @else
                                                        <a href="{{ url('pembayaran', $data->no_transaksi) }}"
                                                            class="btn btn rounded text-white"
                                                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                            Sudah bayar
                                                        </a>
                                                    @endif
                                                @endif
                                                @if ($data->status == 'sedang_antar')
                                                    <button
                                                        onclick="confirm('yakin pesanan telah diterima?') || event.stopImmediatePropagation()"
                                                        wire:click="diterima('{{ $data->id }}')" type="button"
                                                        class="btn btn-sm text-white m-1 rounded btn-primary"
                                                        style="font-size: 12px">
                                                        Terima <span>{{ $data->islunas == true ? '' : 'dan bayar' }}</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                Belum memiliki transaksi
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-md-none d-lg-none d-xl-none">
        <div class="body" style="padding-top: 60px; padding-bottom: 65px;">
            <div class="container-fluid container-lg">
                @forelse ($transaksi as $data)
                    <div class="card mt-1 shadow-sm border-light">
                        <div class="card-body py-2">
                            <a href="{{ url('pesanan-detail', $data->no_transaksi) }}"
                                class="text-decoration-none text-dark">
                                <div class="d-flex justify-content-between">
                                    <div class="kiri">
                                        {{ $data->no_transaksi }}
                                    </div>
                                    <div class="kanan">
                                        {{ $data->status }}
                                    </div>
                                </div>
                                <hr class="my-0">
                                <div class="mt-2 d-flex justify-content-start align-items-start">
                                    {{-- @dd($data->transaksiitem->first()) --}}
                                    {{-- @foreach ($data->transaksiitem->first() as $item) --}}

                                    <div class="kiri">
                                        <img src="{{ $data->transaksiitem->first()->produk->gambar->first()->img == null ? asset('imagenotfound.jpg') : Storage::url($data->transaksiitem->first()->produk->gambar->first()->img) }}"
                                            width="65px" height="65px" class="rounded" alt="...">


                                    </div>
                                    <div class="kanan ms-2">
                                        <b><span
                                                style="font-size: 14px">{{ $data->transaksiitem->first()->produk->nama }}</span></b>
                                        <div class="" style="font-size: 13px">
                                            @uang($data->transaksiitem->first()->produk->harga_jual) x {{ $data->transaksiitem->first()->qty }} qty
                                        </div>

                                        <div class="" style="font-size: 13px">
                                            @uang($data->transaksiitem->first()->produk->harga_jual * $data->transaksiitem->first()->qty)
                                        </div>
                                    </div>
                                    {{-- @endforeach --}}
                                </div>
                                <div class="mt-1">
                                    @if ($data->transaksiitem->count() != 1)
                                        +{{ $data->transaksiitem->count() - 1 }}
                                        produk lainnya
                                    @endif

                                </div>
                            </a>
                            <hr class="my-0">
                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                <div class="kir">
                                    <div class="text-muted">
                                        Total pesanan
                                    </div>
                                    <div class="">
                                        <b>@uang($data->total_pembayaran)</b><span
                                            style="color: {{ $data->islunas == 1 ? 'green' : 'red' }}">({{ $data->islunas == 1 ? 'sudah bayar' : 'belum bayar' }})</span>
                                    </div>
                                </div>
                                <div class="kanan">
                                    @if ($data->status == 'selesai')
                                        {{-- cek transaksiitem yang produkulasan kosong --}}
                                        @if($data->transaksiitem->whereNull('produk_ulasan_id')->first())
                                        <a href="{{ url('beri-ulasan') }}" class="btn btn rounded text-white"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                                        Beri ulasan
                                    </a>
                                        @endif
                                    @elseif($data->status == 'konfirm')
                                        @if (now() < $data->pembayaran_expired_at)
                                            <a href="{{ url('pembayaran', $data->no_transaksi) }}"
                                                class="btn btn rounded text-white"
                                                style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                Sudah bayar
                                            </a>
                                        @else
                                            <a href="{{ url('pembayaran', $data->no_transaksi) }}"
                                                class="btn btn rounded text-white"
                                                style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                Sudah bayar
                                            </a>
                                        @endif
                                    @endif
                                    @if ($data->status == 'sedang_antar')
                                        <button
                                            onclick="confirm('yakin pesanan telah diterima?') || event.stopImmediatePropagation()"
                                            wire:click="diterima('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-primary"
                                            style="font-size: 12px">
                                            Terima <span>{{ $data->islunas == true ? '' : 'dan bayar' }}</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Belum memiliki transaksi
                @endforelse
            </div>
        </div>
    </div>

    <div class="d-md-none d-lg-none d-xl-none d-block">
        <livewire:konsumen.component.navbottom />
    </div>
        <style>
            body {
                background-color: rgb(254, 254, 254);
            }
        </style>
    @endif
</div>



