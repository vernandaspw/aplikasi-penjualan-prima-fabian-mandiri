<div>
    <nav class="p-1 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-2 form-control w-full d-flex align-items-center bg-white p-0 rounded">
                <li class="nav-item me-2 ms-1 ">
                    <span class="text-white">
                        <img src="{{ asset('logo.png') }}" width="20px" alt="">
                    </span>
                </li>
                <input wire:click='cariproduk' class="form-control rounded border border-right-0 border-1 py-2"
                    type="cariproduk" placeholder="cari produk" aria-label="cariproduk">
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
                    <div class="container-lg container-fluid">
                        <a href="{{ url('perusahaan') }}" class="produkcard"
                            style="text-decoration: none; color:black;">
                            <div class="card border border-orange-500">
                                <div class="card-body">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="kiri me-3">
                                            <img src="{{ asset('logo.png') }}" width="60px" alt="">
                                        </div>
                                        <div class="kanan text-start">
                                            <b style="font-size: 17px">{{ $perusahaan->nm_perusahaan }}</b>
                                            <p>
                                                {{ Str::limit($perusahaan->sejarah, 90, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <section class="kategori mt-1">
                            <div class="mt-2">
                                <span style="font-size: 17px"><b>Kategori</b></span>
                            </div>
                            <div class="scrollmenu">
                                @forelse ($produkkategori as $data)
                                    <a href="{{ url('produk?kategori=' . $data->id) }}">
                                        <div class="card border border-light py-0 shadow-sm my-2 me-1"
                                            style="width: 100%; height: 100%; border-radius: 30px">
                                            <div class="card-body py-2">
                                                <div class=" text-wrap text-center" style="font-size: 14px;">
                                                    {{ $data->nama }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    tidak ada
                                @endforelse
                            </div>
                        </section>
                        {{-- <section class="merek">
                            <div class="mt-2">
                                <span style="font-size: 17px"><b>Merek</b></span>
                            </div>
                            <div class="scrollmenu">
                                @forelse ($produkmerek as $data)
                                    <a href="{{ url('produk?merek=' . $data->id) }}">
                                        <div class="card border border-light py-0 shadow-sm my-2 me-1"
                                            style="width: 100%; height: 100%;">
                                            <div class="card-body">
                                                <div class=" text-wrap text-center" style="font-size: 14px;">
                                                    {{ $data->nama }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    tidak ada
                                @endforelse
                            </div>
                        </section> --}}
                        <section class="produk">
                            <div class="mt-3">
                                <span style="font-size: 17px"><b>Produk Terbaru</b></span>
                            </div>
                            <div class="mt-1">
                                <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-md-3 row-cols-2">
                                    @forelse ($produk as $data)
                                        <div class="col mt-2">
                                            <a href="{{ url('produk', $data->id) }}" class="produkcard"
                                                style="text-decoration: none; color: black;">
                                                <div class="card produkitem shadow-sm border-0">
                                                    @foreach ($data->gambar as $gambar)
                                                        @if ($gambar->no == 1)
                                                            @if ($gambar->img == null)
                                                                <img src="{{ asset('imagenotfound.jpg') }}"
                                                                    class="card-img-top" width="100%" height="170px"
                                                                    alt="">
                                                            @else
                                                                <img src="{{ asset(Storage::url($gambar->img)) }}"
                                                                    class="card-img-top" width="100%" height="170px"
                                                                    alt="">
                                                            @endif
                                                        @endif
                                                    @endforeach

                                                    <div class="card-body">
                                                        <div class="" style="font-size: 13px">
                                                            {{ $data->nama }}
                                                        </div>
                                                        <div class=""
                                                            style="font-size: 14px; color: {{ env('COLOR_PRIMARY') }};">
                                                            <b>
                                                                @uang($data->harga_jual)
                                                            </b>
                                                        </div>

                                                        <div class="" style="font-size: 12px">
                                                            <img src="{{ asset('stars.svg') }}" alt="">
                                                            @rating($data->produkulasan->avg('rating'))
                                                            | Terjual
                                                            {{ $data->transaksiitem->where('terjual', true)->sum('qty') }}

                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        belum ada produk
                                    @endforelse

                                </div>
                                <div class="mt-2">
                                    @if ($take < $jmlproduk)
                                        <center>
                                            <button wire:click='lanjut'
                                                class="btn bg-white shadow-sm form-control rounded-pill">Lanjut</button>
                                        </center>
                                    @endif
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-md-none d-lg-none d-xl-none">
        <div class="body" style="padding-top: 65px; padding-bottom: 65px;">
            <div class="container-lg container-fluid">
                <a href="{{ url('perusahaan') }}" class="produkcard" style="text-decoration: none; color:black;">
                    <div class="card border border-orange-500">
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="kiri me-3">
                                    <img src="{{ asset('logo.png') }}" width="60px" alt="">
                                </div>
                                <div class="kanan text-start">
                                    <b style="font-size: 17px">{{ $perusahaan->nm_perusahaan }}</b>
                                    <p>
                                        {{ Str::limit($perusahaan->sejarah, 90, '...') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <section class="kategori mt-1">
                    <div class="mt-2">
                        <span style="font-size: 17px"><b>Kategori</b></span>
                    </div>
                    <div class="scrollmenu">
                        @forelse ($produkkategori as $data)
                            <a href="{{ url('produk?kategori=' . $data->id) }}">
                                <div class="card border border-light py-0 shadow-sm my-2 me-1"
                                    style="width: 100%; height: 100%;border-radius: 30px">
                                    <div class="card-body py-2">
                                        <div class=" text-wrap text-center" style="font-size: 14px;">
                                            {{ $data->nama }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            tidak ada
                        @endforelse
                    </div>
                </section>
                {{-- <section class="merek">
                    <div class="mt-2">
                        <span style="font-size: 17px"><b>Merek</b></span>
                    </div>
                    <div class="scrollmenu">
                        @forelse ($produkmerek as $data)
                            <a href="{{ url('produk?merek=' . $data->id) }}">
                                <div class="card border border-light py-0 shadow-sm my-2 me-1"
                                    style="width: 100%; height: 100%;">
                                    <div class="card-body">
                                        <div class=" text-wrap text-center" style="font-size: 14px;">
                                            {{ $data->nama }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            tidak ada
                        @endforelse
                    </div>
                </section> --}}
                <section class="produk">
                    <div class="mt-3">
                        <span style="font-size: 17px"><b>Produk Terbaru</b></span>
                    </div>
                    <div class="mt-1">
                        <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-md-3 row-cols-2">
                            @forelse ($produk as $data)
                                <div class="col mt-2">
                                    <a href="{{ url('produk', $data->id) }}" class="produkcard"
                                        style="text-decoration: none; color: black;">
                                        <div class="card produkitem shadow-sm border-0">
                                            @foreach ($data->gambar as $gambar)
                                                @if ($gambar->no == 1)
                                                    @if ($gambar->img == null)
                                                        <img src="{{ asset('imagenotfound.jpg') }}"
                                                            class="card-img-top" width="100%" height="170px"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset(Storage::url($gambar->img)) }}"
                                                            class="card-img-top" width="100%" height="170px"
                                                            alt="">
                                                    @endif
                                                @endif
                                            @endforeach

                                            <div class="card-body">
                                                <div class="" style="font-size: 13px">
                                                    {{ $data->nama }}
                                                </div>
                                                <div class=""
                                                    style="font-size: 14px; color: {{ env('COLOR_PRIMARY') }};">
                                                    <b>
                                                        @uang($data->harga_jual)
                                                    </b>
                                                </div>

                                                <div class="" style="font-size: 12px">
                                                    <img src="{{ asset('stars.svg') }}" alt="">
                                                    @rating($data->produkulasan->avg('rating'))
                                                    | Terjual
                                                    {{ $data->transaksiitem->where('terjual', true)->sum('qty') }}

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                belum ada produk
                            @endforelse

                        </div>
                        <div class="mt-2">
                            @if ($take < $jmlproduk)
                                <center>
                                    <button wire:click='lanjut'
                                        class="btn bg-white shadow-sm form-control rounded-pill">Lanjut</button>
                                </center>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>




    <div class="d-md-none d-lg-none d-xl-none d-block">
        <livewire:konsumen.component.navbottom />
    </div>

</div>

<style>
    body {
        background-color: rgb(248, 248, 248);
    }
</style>
