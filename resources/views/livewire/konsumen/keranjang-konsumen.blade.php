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
                    <span class="text-white"><b>Keranjang</b></span>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <livewire:konsumen.component.icon-cart-konsumen />
                </li>
            </ul>
        </div>
    </nav>
    <div wire:poll class="body" style="padding-top: 75px; padding-bottom: 65px;">
        <div class="container-fluid">
            @if (session()->has('error'))
                <div class="alert alert-danger mt-2" role="alert">
                    Centang barang yang ingin di beli
                </div>
            @endif
            @forelse($keranjangitem as $data)
                <div class="card mb-1 shadow-sm border border-light">
                    <div class="card-body pb-2">
                        <div class="d-flex">
                            <div class="me-2 mt-2">
                                <input @if ($data->produk->produkstok->po < $data->qty) disabled @endif id="check{{ $data->id }}"
                                    class="p-1 form-check-input" type="checkbox"
                                    wire:click="check('{{ $data->id }}')"
                                    @if ($data->selected) checked @endif>
                            </div>
                            <div class="w-100">
                                <label for="check{{ $data->id }}">
                                    <div class="d-flex text-start">
                                        @forelse ($data->produk->gambar as $gambar)
                                            @if ($gambar->no == 1)
                                                <img src="{{ $gambar->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar->img)) }}"
                                                    width="75px" height="75px" class="rounded" alt="...">
                                            @endif
                                        @empty
                                            @if ($gambar->no == 1)
                                                <img src="{{ asset('imagenotfound.jpg') }}" width="75px"
                                                    height="75px" class="rounded" alt="...">
                                            @endif
                                        @endforelse
                                        <div class="ms-3">
                                            <h6 class="card-title">{{ $data->produk->nama }}</h6>
                                            <p class="card-text text-muted mb-0">
                                                @uang($data->produk->harga_jual)
                                            </p>
                                            <p class="card-text text-muted mb-0">
                                                @if ($data->produk->produkstok->isstok)
                                                    Sisa stok {{ $data->produk->produkstok->po }}
                                                    {{ $data->produk->produkstok->satuan_unit }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </label>
                                <div class="d-flex justify-content-between pt-1 align-items-center">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <button @if ($data->qty >= $data->produk->produkstok->po) disabled @endif
                                            wire:click="tambahitem('{{ $data->id }}')"
                                            class="px-3 btn btn-sm text-white"
                                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                                            +
                                        </button>
                                        <span class=" text-center border-0 px-sm-5 px-lg-5 px-xl-5 px-md-5 px-4">
                                            {{ $data->qty }}
                                        </span>
                                        <button @if ($data->qty <= 1) disabled @endif
                                            wire:click="kurangitem('{{ $data->id }}')"
                                            class="btn btn-sm btn-warning text-white px-3">
                                            -
                                        </button>
                                        <span style="font-size: 12px" class=" text-center text-muted border-0 px-1">
                                            @uang($data->total_harga)
                                        </span>
                                    </div>
                                    <div class="kanan">
                                        <button wire:click="deleteitem('{{ $data->id }}')"
                                            class="btn btn-sm btn-transparent">
                                            <img src="{{ asset('trash.png') }}" alt="">
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            @empty
                Belum ada barang dikeranjang ini
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
                        <b>@uang($totalbelanja)</b>
                    </div>
                </div>

                <div class="ms-auto">
                    <a href="{{ url('checkout') }}" class="nav-link btn px-5 m-1 text-center btn-light"
                        style="color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                            <b>Checkout</b>
                        </span>
                    </a>
                </div>
            </ul>
        </div>
    </nav>



    @push('script')
        <script>
            Livewire.on('success', data => {
                console.log(data.pesan);
                Swal.fire({
                    title: 'success!',
                    text: data.pesan,
                    icon: 'success',
                    confirmButtonText: 'oke'
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
