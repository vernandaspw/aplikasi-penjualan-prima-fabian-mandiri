<div>
    <livewire:admin.component.navbar-admin />

    <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav d-flex justify-content-between w-100 align-items-center">
            <li class="nav-item text-white">

                <a style="font-weight: bold; color:white;" href="{{ url('admin/kasir-detail', $kasir->id) }}"
                    class="nav-link text-white text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        <span><b>{{ $kasir->nama }}</b></span>
                        |
                        <span>Kas @uang($kasir->kas)</span> (lihat)
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/kasir') }}"
                    class="nav-link btn rounded-pill btn-sm btn-danger text-white text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        Ganti kasir
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="{{ url('admin/kasir-penjualan-produk', $kasir->id) }}" class="nav-link active text-center">
                    <span class="small d-block" style="font-size: 14px; font-weight: bold; color:white;">
                        Produk
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/kasir-penjualan-manual', $kasir->id) }}" class="nav-link  text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        Manual
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container mt-3 mb-5">
        <div class="mb-2 d-flex">
            <input wire:model='cariproduk' class="form-control me-1 rounded-pill" type="text"
                placeholder="Cari produk/kode">
            <select wire:model='kategori_id' class="px-1 form-inline rounded-pill" id="">
                <option value="">Kategori</option>
                @foreach ($kategori as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="">
            @forelse ($produk as $data)
                <div class="card mb-1 shadow-sm border border-light">
                    <div class="card-body py-2">
                        <div class="d-flex">
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex text-start">
                                        @forelse ($data->gambar as $gambar)
                                            @if ($gambar->no == 1)
                                                <img src="{{ $gambar->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar->img)) }}"
                                                    width="45px" height="45px" class="rounded" alt="...">
                                            @endif
                                        @empty
                                            @if ($gambar->no == 1)
                                                <img src="{{ asset('imagenotfound.jpg') }}" width="45px"
                                                    height="45px" class="rounded" alt="...">
                                            @endif
                                        @endforelse
                                        <div class="ms-3">
                                            <b class="">{{ $data->nama }}</b>
                                            <p class="card-text text-muted mb-0" style="font-size: 14px">
                                                @uang($data->harga_jual) | @if ($data->produkstok->isstok)
                                                    Stok {{ $data->produkstok->po }}
                                                    {{ $data->produkstok->satuan_unit }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="me-1">
                                        <button  class="btn btn-white">
                                            <img src="{{ asset('add-filled.png') }}" alt="">
                                        </button>
                                    </div>
                                </div>
                                {{-- <div class="d-flex justify-content-between pt-1 align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <button type="button" @if ($qty >= $data->produkstok->po) disabled @endif
                                        wire:click="tambahitem" class="px-3 btn btn-sm text-white"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                                        +
                                    </button>
                                    <span class=" text-center border-0 px-sm-5 px-lg-5 px-xl-5 px-md-5 px-4">
                                        {{ $qty }}
                                    </span>
                                    <button type="button" @if ($qty <= 1) disabled @endif
                                        wire:click="kurangitem" class="btn btn-sm btn-warning text-white px-3">
                                        -
                                    </button>
                                    <span style="font-size: 12px" class=" text-center text-muted border-0 px-1">
                                        @uang($produk->harga_jual * $qty)
                                    </span>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <center>
                    Belum memiliki produk
                </center>
            @endforelse
        </div>
    </div>

    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="py-2 navbar-nav justify-content-between w-100 align-items-center">
                <div class="me-auto text-white">
                    <div class="">
                        Total Belanja
                    </div>
                    <div class="" style="font-size: 18px">
                        {{-- <b>@uang($totalbelanja)</b> --}}
                    </div>
                </div>

                <div class="ms-auto">
                    <button class="nav-link btn px-5 m-1 text-center btn-light" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom"
                        style="color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                            <b>Checkout</b>
                        </span></button>

                </div>
            </ul>
        </div>
    </nav>



    <div class=" offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Cek transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="">
                d
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

<style>
    .offcanvas {
        height: 80% !important;
    }
</style>
