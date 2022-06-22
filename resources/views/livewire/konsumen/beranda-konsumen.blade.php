<div>
    <nav class="p-2 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-2 form-control w-full align-items-centar bg-white p-1 rounded">
                <li class="nav-item me-2 ms-1 ">
                    <span class="text-white">
                        <img src="{{ asset('logo.png') }}" width="20px" alt="">
                    </span>
                </li>
                <li class="nav-item">
                    <span class="text-white">
                    </span>
                </li>
                <input wire:click='produk' class="form-control rounded border border-right-0 border-1 p-1" type="cariproduk"
                    placeholder="cari produk" aria-label="cariproduk">
            </ul>
            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <a class="shadow-m px-3" href="{{ url('keranjang') }}"><img src="{{ asset('cart.svg') }}"
                            alt=""></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="body" style="padding-top: 75px; padding-bottom: 65px;">
        <div class="container">
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
                                    {{ Str::limit($perusahaan->tentang, 130, '...') }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <section class="kategori">
                <div class="mt-3">
                    <span style="font-size: 17px"><b>Kategori</b></span>
                </div>
                <div class="scrollmenu">
                    @forelse ($produkkategori as $data)
                        <a href="{{ url('produk?kategori=' . $data->id) }}">
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
            </section>
            <section class="merek">
                <div class="mt-3">
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
            </section>
            <section class="produk">
                <div class="mt-3">
                    <span style="font-size: 17px"><b>Produk Terbaru</b></span>
                </div>
                <div class="mt-1">
                    <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-md-3">
                        <div class="col mt-2">
                            <a href="{{ url('produk', 1) }}" class="produkcard"
                                style="text-decoration: none; color: black;">
                                <div class="card produkitem shadow-sm border-0">
                                    <img src="{{ asset('parabola.jpg') }}" class="card-img-top" width="100%"
                                        height="170px" alt="">
                                    <div class="card-body">
                                        <div class="" style="font-size: 14px">
                                            Antena Super
                                        </div>
                                        <div class=""
                                            style="font-size: 16px; color: {{ env('COLOR_PRIMARY') }};">
                                            <b>
                                                @uang(10000)
                                            </b>
                                        </div>

                                        <div class="" style="font-size: 13px">
                                            <img src="{{ asset('stars.svg') }}" alt=""> 4.5 | Terjual 29
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
