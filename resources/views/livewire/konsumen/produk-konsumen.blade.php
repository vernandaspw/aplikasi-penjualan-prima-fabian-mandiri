<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">

            <ul class="navbar-nav me-2 form-control w-full align-items-centar p-0 rounded">
                <li class="nav-item me-3 ms-1 ">
                    <span class="text-dark"><b>
                            <a href="{{ url('/') }}" class="btn btn-lg  btn-close btn-close-dark"></a>
                        </b>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="text-white">
                    </span>
                </li>
                <input autofocus wire:model='nama' class="form-control rounded border border-right-0 border-1 p-1" type="cariproduk"
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
            <div class="mt-1">
                <span style="font-size: 17px; text-transform: uppercase; font-weight: bold">
                   @if($namakategori)
                   Kategori {{ $namakategori }}
                   @elseif($namamerek)
                   Merek {{ $namamerek }}
                   @else
                   Produk Terbaru
                   @endif
                </span>
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
                                            <img src="{{ asset('imagenotfound.jpg') }}" class="card-img-top"
                                                width="100%" height="170px" alt="">
                                        @else
                                            <img src="{{ asset(Storage::url($gambar->img)) }}"
                                                class="card-img-top" width="100%" height="170px"
                                                alt="">
                                        @endif
                                    @endif
                                @endforeach

                                <div class="card-body">
                                    <div class="" style="font-size: 14px">
                                        {{ $data->nama }}
                                    </div>
                                    <div class=""
                                        style="font-size: 16px; color: {{ env('COLOR_PRIMARY') }};">
                                        <b>
                                            @uang($data->harga_jual)
                                        </b>
                                    </div>

                                    <div class="" style="font-size: 13px">
                                        <img src="{{ asset('stars.svg') }}" alt=""> @rating($data->produkulasan->avg('rating'))
                                        | Terjual {{ $data->transaksiitem->count() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                        <div class="mt-1">
                            <span style="font-size: 17px">
                                Produk Tidak ditemukan
                            </span>
                        </div>
                    @endforelse
                </div>
                <div class="mt-2">
                    @if ($take < $jmlproduk)
                    <center>
                        <button wire:click='lanjut'
                            class="btn btn-light shadow-sm form-control rounded-pill">Lanjut</button>
                    </center>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
