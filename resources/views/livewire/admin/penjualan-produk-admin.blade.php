<div>
    <livewire:admin.component.navbar-admin />

    <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="{{ url('admin/penjualan/produk') }}" class="nav-link active text-center">
                    <span class="small d-block" style="font-size: 14px; font-weight: bold; color:white;">
                        Produk
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/penjualan/manual') }}" class="nav-link  text-center">
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
                                        <button wire:click="tambahkecart('{{ $data->id }}')" class="btn btn-white">
                                            <img src="{{ asset('add-filled.svg') }}" alt="">
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
                        {{ $jml_belanja }} Produk
                    </div>
                    <div class="" style="font-size: 18px">
                        <b>@uang($totalbelanja)</b>
                    </div>

                </div>

                <div class="ms-auto">
                    <button class="nav-link btn px-5 m-1 text-center btn-light" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom"
                        style="color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                            <b>Lanjut</b>
                        </span></button>

                </div>
            </ul>
        </div>
    </nav>


    @if($show)
    <div class="offcanvas-backdrop show"></div>
    @else
    @endif
    <div class=" offcanvas  @if($show)
    show
    @else
    hide
    @endif offcanvas-bottom" style="background-color: {{ env('COLOR_PRIMARY') }}" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel"> <span class="text-white">Cek transaksi</span></h5>
            <button wire:click="showOff" type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mb-5 pb-5">
            <div class="">
                @forelse ($keranjangitem as $data)
                    <div class="card mb-1 shadow-sm border border-light">
                        <div class="card-body py-2 px-2">
                            <div class="d-flex">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex text-start align-items-center">
                                            @forelse ($data->produk->gambar as $gambar)
                                                @if ($gambar->no == 1)
                                                    <img src="{{ $gambar->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar->img)) }}"
                                                        width="35px" height="35px" class="rounded" alt="...">
                                                @endif
                                            @empty
                                                @if ($gambar->no == 1)
                                                    <img src="{{ asset('imagenotfound.jpg') }}" width="20px"
                                                        height="20px" class="rounded" alt="...">
                                                @endif
                                            @endforelse
                                            <div class="ms-3">
                                                <b class="" style="font-size: 14px">{{ $data->produk->nama }}</b>
                                                <p class="card-text text-muted mb-0" style="font-size: 13px">
                                                    @uang($data->produk->harga_jual) | @if ($data->produk->produkstok->isstok)
                                                        Stok {{ $data->produk->produkstok->po }}
                                                        {{ $data->produk->produkstok->satuan_unit }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="me-1">
                                            <button wire:click="hapuscartitem('{{ $data->id }}')"
                                                class="btn btn-white">
                                                <img src="{{ asset('trash.png') }}" alt="">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between pt-1 align-items-center">
                                        <div class="d-flex justify-content-between w-100 align-items-center">
                                            <span style="font-size: 12px" class=" text-center border-0 px-1">
                                                {{ $data->qty }} qty | <b>@uang($data->total_harga)</b>
                                            </span>
                                            <div class="me-2">
                                                <button @if ($data->qty >= $data->produk->produkstok->po) disabled @endif
                                                    wire:click="tambahitem('{{ $data->id }}')"
                                                    class="px-3 py-0 btn btn-sm text-white"
                                                    style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                    +
                                                </button>
                                                <span
                                                    class=" text-center border-0 px-sm-5 px-lg-5 px-xl-5 px-md-5 px-4">
                                                    {{ $data->qty }}
                                                </span>
                                                <button type="button" wire:click="kurangitem('{{ $data->id }}')"
                                                    class="btn btn-sm btn-warning text-white px-3 py-0">
                                                    -
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <center>
                        <span class="text-white">Belum memiliki produk</span>
                    </center>
                @endforelse

            </div>
            <div class="">
                <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg"
                    style="background-color: white">
                    <div class="container-fluid">
                        <ul class="py-2 navbar-nav justify-content-between w-100 align-items-center">
                            <div class="me-auto text-dark">
                                <div class="">
                                    {{ $jml_belanja }} Produk
                                </div>
                                <div class="" style="font-size: 18px">
                                    <b>@uang($totalbelanja)</b>
                                </div>
                            </div>

                            <div class="ms-auto">
                                <button class="nav-link btn px-5 m-1 text-center btn-light" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                    aria-controls="offcanvasBottom" style="background-color: {{ env('COLOR_PRIMARY') }}; color: white;">
                                    <span class="small d-block" style="font-size: 15px">
                                        <b>Lanjut</b>
                                    </span></button>

                            </div>
                        </ul>
                    </div>
                </nav>
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
                    timer: 250
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



            // Livewire.on('edited' => {
            //     alert('A post was added with the id of: ');
            // })
        </script>
    @endpush
</div>

<style>
    .offcanvas {
        height: 85% !important;
    }


</style>
