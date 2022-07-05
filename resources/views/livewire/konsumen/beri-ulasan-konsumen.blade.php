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
                    <span class="text-white"><b>Beri Ulasan</b></span>
                </li>
            </ul>
            {{-- <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <livewire:konsumen.component.icon-cart-konsumen />
                </li>
            </ul> --}}
        </div>
    </nav>

    <div class="body" style="padding-top: 60px; padding-bottom: 65px;">
        <div class="container-fluid container-lg">
            <div class="mb-3 mt-2">
                <b>Perlu diberi ulasan</b>
            </div>
            @forelse ($transaksiitem as $data)
                <div class="card mt-1 shadow-sm border-light">
                    <div class="card-body py-2">
                        <a href="{{ url('beri-ulasan-input', $data->id) }}" class="text-decoration-none text-dark">
                            <div class="mt-2 d-flex justify-content-start align-items-start">
                                <div class="kiri">
                                    <img src="{{ $data->produk->gambar[0]->img == null ? asset('imagenotfound.jpg') : Storage::url($data->produk->gambar[0]->img) }}" width="65px" height="65px"
                                        class="rounded" alt="...">
                                </div>
                                <div class="kanan ms-2">
                                    <b>
                                        <span style="font-size: 14px">{{ $data->produk->nama }}</span></b>
                                    <div class="" style="font-size: 13px">
                                        @uang($data->produk->harga_jual) x {{ $data->qty }} qty
                                    </div>
                                    <div class="" style="font-size: 13px">
                                        @uang($data->produk->harga_jual * $data->qty)
                                    </div>
                                </div>
                            </div>
                        </a>
                        <hr class="mb-0 mt-1">
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <div class="kir">
                                <div class="text-muted">
                                    Total harga
                                </div>
                                <div class="">
                                    <b>@uang($data->total_harga)</b>
                                </div>
                            </div>
                            <div class="kanan">
                                @if ($data->transaksi->status == 'selesai')
                                    <a href="{{ url('beri-ulasan-input', $data->id) }}"
                                        class="btn btn rounded text-white"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                                        Beri ulasan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                Belum memiliki transaksi untuk diberi rating
            @endforelse
        </div>
    </div>
</div>
