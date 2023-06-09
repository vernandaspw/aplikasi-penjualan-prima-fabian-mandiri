<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('/') }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>Produk Detail</b></span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <livewire:konsumen.component.icon-cart-konsumen />
                </li>
            </ul>
        </div>
    </nav>
    <div class="body" style="padding-top: 55px; padding-bottom: 85px;">
        <div class="d-lg-none d-xl-none d-md-none d-sm-block">
            @if ($lihatgambar)
                <img src="{{ asset($lihatgambar->img == null ? 'imagenotfound.jpg' : Storage::url($lihatgambar->img)) }}"
                    height="250" class="w-100" alt="...">
            @else
                @forelse ($produk->gambar as $data)
                    @if ($data->no == 1)
                        <img src="{{ asset($data->img == null ? 'imagenotfound.jpg' : Storage::url($data->img)) }}"
                            height="250" class="w-100" alt="...">
                    @endif
                @empty
                    <img src="{{ asset('imagenotfound.jpg') }}" height="250" class="d-block w-100" alt="...">
                @endforelse
            @endif
            <div class="container">

                <div class="scrollmenu mt-2">
                    @forelse ($produk->gambar as $data)
                        <img wire:click="lihatgambar('{{ $data->id }}')"
                            src="{{ asset($data->img == null ? 'imagenotfound.jpg' : Storage::url($data->img)) }}"
                            height="60" width="60" class="btn btn-transparent p-0 m-0" alt="...">

                    @empty
                        <img src="{{ asset('imagenotfound.jpg') }}" height="59" class="" alt="...">
                    @endforelse
                </div>
            </div>

            <div class="container mt-3">
                <div class="">
                    {{ $produk->nama }}
                </div>
                <div class="" style="font-size: 18px">
                    <b> @uang($produk->harga_jual)</b>
                </div>
                <div class="">
                    Terjual {{ $produk->transaksiitem->where('terjual', true)->sum('qty') }} | <img
                        src="{{ asset('stars.svg') }}" alt="">
                    @rating($produk->produkulasan->avg('rating')) ({{ $produk->produkulasan->count() }})
                </div>
                <div class="">
                    Stok tersedia @if ($produk->produkstok->isstok == true)
                        {{ $produk->produkstok->po }} {{ $produk->produkstok->satuan_unit }}
                    @endif
                </div>

                <hr style="margin: 0px">

                <div class="mt-2">
                    <b>Detail Produk</b>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="kiri text-start">
                        Kategori
                    </div>
                    <div class="kanan text-end">
                        @if ($produk->kategori)
                            {{ $produk->kategori->nama }}
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="kiri text-start">
                        Merek
                    </div>
                    <div class="kanan text-end">
                        @if ($produk->merek)
                            {{ $produk->merek->nama }}
                        @else
                            -
                        @endif

                    </div>
                </div>

                <div class="mt-2">
                    <b>Deskripsi Produk</b>
                </div>
                <div class="">
                    <p style="text-align: justify">
                        {!! $produk->deskripsi !!}
                    </p>
                </div>
                <hr style="margin: 0px">
                <hr style="margin: 0px" class="mt-1">
                <div class="mt-3">
                    <b>Ulasan Pembeli</b>
                </div>

                <div class="">
                    <img src="{{ asset('stars.svg') }}" alt=""> @rating($produk->produkulasan->avg('rating'))/5.0 |
                    {{ $produk->produkulasan->count('rating') }} rating | {{ $jml_ulasan }} ulasan
                </div>

                @forelse ($produk->produkulasan as $data)
                    <div class="mt-1">
                        <div class="card">
                            <div class="card-body pt-2 pb-0">
                                <div>
                                    <img src="{{ asset('stars.svg') }}" alt=""> <img
                                        src="{{ asset('stars.svg') }}" alt=""> -
                                    {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                </div>
                                <div class="">
                                    <b>{{ $data->konsumen->nama }}</b>
                                </div>
                                <div class="">
                                    <p style="text-align: justify">
                                        {{ Str::limit($data->ulasan, 100, '...') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Belum memiliki rating dan ulasan dari pembeli
                @endforelse
                @if ($produk->produkulasan->count() > $take)
                    <div class="mt-3">
                        <center><button wire:click='lainnya' class="btn btn-transparent form-control">Lanjut</button>
                        </center>
                    </div>
                @endif
            </div>
            <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: white">
                <div class="container">
                    <ul class="py-1 navbar-nav nav-justified w-100 align-items-center">
                        <li class="nav-item" style="margin-right: 2px">
                            @if (auth('konsumen')->check())
                                <a href="{{ url('beli-langsung', $produk->id) }}"
                                    class="nav-link btn m-1 rounded-pill text-center"
                                    style=" border-color: {{ env('COLOR_PRIMARY') }};">
                                    <span class="small d-block"
                                        style="font-size: 15px; color: {{ env('COLOR_PRIMARY') }}">
                                        Beli langsung
                                    </span>
                                </a>
                            @else
                                <a href="{{ url('login') }}" class="nav-link btn m-1 rounded-pill text-center"
                                    style=" border-color: {{ env('COLOR_PRIMARY') }};">
                                    <span class="small d-block"
                                        style="font-size: 15px; color: {{ env('COLOR_PRIMARY') }}">
                                        Beli langsung
                                    </span>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item" style="margin-left: 2px">
                            @if (auth('konsumen')->check())
                                <button type="button" wire:click="tambahkecart('{{ $produk->id }}')"
                                    class="nav-link btn m-1 rounded-pill text-white text-center"
                                    style="background-color: {{ env('COLOR_PRIMARY') }}">
                                    <span class="small d-block" style="font-size: 15px">
                                        + Keranjang
                                    </span>
                                </button>
                            @else
                                <a type="button" href="{{ url('login') }}"
                                    class="nav-link btn m-1 rounded-pill text-white text-center"
                                    style="background-color: {{ env('COLOR_PRIMARY') }}">
                                    <span class="small d-block" style="font-size: 15px">
                                        + Keranjang
                                    </span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        {{-- display laptop --}}
        <div class="d-none d-xl-block d-lg-block d-md-block container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 col-md-6 col-xl-6">
                    @if ($lihatgambar)
                        <img src="{{ asset($lihatgambar->img == null ? 'imagenotfound.jpg' : Storage::url($lihatgambar->img)) }}"
                            height="250" width="340" class="ms-3" alt="...">
                    @else
                        @forelse ($produk->gambar as $data)
                            @if ($data->no == 1)
                                <img src="{{ asset($data->img == null ? 'imagenotfound.jpg' : Storage::url($data->img)) }}"
                                    height="250" width="340" class="ms-3" alt="...">
                            @endif
                        @empty
                            <img src="{{ asset('imagenotfound.jpg') }}" height="250" width="340" class="ms-3"
                                alt="...">
                        @endforelse
                    @endif
                </div>
                <div class="col-lg-6 col-md-6 col-xl-6 ">
                    <div class="">
                        {{ $produk->nama }}
                    </div>
                    <div class="" style="font-size: 18px">
                        <b> @uang($produk->harga_jual)</b>
                    </div>
                    <div class="">
                        Terjual {{ $produk->transaksiitem->where('terjual', true)->sum('qty') }} | <img
                            src="{{ asset('stars.svg') }}" alt="">
                        @rating($produk->produkulasan->avg('rating')) ({{ $produk->produkulasan->count() }})
                    </div>
                    <div class="">
                        Stok tersedia @if ($produk->produkstok->isstok == true)
                            {{ $produk->produkstok->po }} {{ $produk->produkstok->satuan_unit }}
                        @endif
                    </div>

                    <div class="d-flex">
                        @if (auth('konsumen')->check())
                        <a href="{{ url('beli-langsung', $produk->id) }}" class="nav-link btn m-1 p-2 rounded-pill text-center"
                            style=" border-color: {{ env('COLOR_PRIMARY') }};">
                            <span class="small d-block" style="font-size: 15px; color: {{ env('COLOR_PRIMARY') }}">
                                Beli langsung
                            </span>
                        </a>
                    @else
                        <a href="{{ url('login') }}" class="nav-link btn m-1 p-2 rounded-pill text-center"
                            style=" border-color: {{ env('COLOR_PRIMARY') }};">
                            <span class="small d-block" style="font-size: 15px; color: {{ env('COLOR_PRIMARY') }}">
                                Beli langsung
                            </span>
                        </a>
                    @endif
                    @if (auth('konsumen')->check())
                        <button type="button" wire:click="tambahkecart('{{ $produk->id }}')"
                            class="nav-link btn m-1 p-2 rounded-pill text-white text-center"
                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                            <span class="small d-block" style="font-size: 15px">
                                + Keranjang
                            </span>
                        </button>
                    @else
                        <a type="button" href="{{ url('login') }}"
                            class="nav-link btn m-1 p-2 rounded-pill text-white text-center"
                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                            <span class="small d-block" style="font-size: 15px">
                                + Keranjang
                            </span>
                        </a>
                    @endif
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="scrollmenu mt-2">
                    @forelse ($produk->gambar as $data)
                        <img wire:click="lihatgambar('{{ $data->id }}')"
                            src="{{ asset($data->img == null ? 'imagenotfound.jpg' : Storage::url($data->img)) }}"
                            height="60" width="60" class="btn btn-transparent p-0 m-0" alt="...">

                    @empty
                        <img src="{{ asset('imagenotfound.jpg') }}" height="59" class="" alt="...">
                    @endforelse
                </div>
            </div>

            <div class="container mt-3">


                <hr style="margin: 0px">

                <div class="mt-2">
                    <b>Detail Produk</b>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="kiri text-start">
                        Kategori
                    </div>
                    <div class="kanan text-end">
                        @if ($produk->kategori)
                            {{ $produk->kategori->nama }}
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="kiri text-start">
                        Merek
                    </div>
                    <div class="kanan text-end">
                        @if ($produk->merek)
                            {{ $produk->merek->nama }}
                        @else
                            -
                        @endif

                    </div>
                </div>

                <div class="mt-2">
                    <b>Deskripsi Produk</b>
                </div>
                <div class="">
                    <p style="text-align: justify">
                        {!! $produk->deskripsi !!}
                    </p>
                </div>
                <hr style="margin: 0px">
                <hr style="margin: 0px" class="mt-1">
                <div class="mt-3">
                    <b>Ulasan Pembeli</b>
                </div>

                <div class="">
                    <img src="{{ asset('stars.svg') }}" alt=""> @rating($produk->produkulasan->avg('rating'))/5.0 |
                    {{ $produk->produkulasan->count('rating') }} rating | {{ $jml_ulasan }} ulasan
                </div>

                @forelse ($produk->produkulasan as $data)
                    <div class="mt-1">
                        <div class="card">
                            <div class="card-body pt-2 pb-0">
                                <div>
                                    <img src="{{ asset('stars.svg') }}" alt=""> <img
                                        src="{{ asset('stars.svg') }}" alt=""> -
                                    {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                </div>
                                <div class="">
                                    <b>{{ $data->konsumen->nama }}</b>
                                </div>
                                <div class="">
                                    <p style="text-align: justify">
                                        {{ Str::limit($data->ulasan, 100, '...') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Belum memiliki rating dan ulasan dari pembeli
                @endforelse
                @if ($produk->produkulasan->count() > $take)
                    <div class="mt-3">
                        <center><button wire:click='lainnya' class="btn btn-transparent form-control">Lanjut</button>
                        </center>
                    </div>
                @endif
            </div>
        </div>
    </div>




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
