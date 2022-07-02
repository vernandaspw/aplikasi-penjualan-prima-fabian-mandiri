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
        <div class="body" style="padding-top: 60px; padding-bottom: 65px;">
            <div class="container-fluid container-lg">
                @forelse ($transaksi as $data)
                    <div class="card mt-1 shadow-sm border-light">
                        <div class="card-body py-2">
                           <a href="{{ url('pesanan-detail', $data->no_transaksi) }}" class="text-decoration-none text-dark">
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
                                    <img src="{{ asset('parabola.jpg') }}" width="65px" height="65px"
                                        class="rounded" alt="...">
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
                                        <b>@uang($data->total_pembayaran)</b> <span style="color: {{ $data->islunas == 1 ? 'green' : 'red' }}">({{ $data->islunas == 1 ? 'sudah bayar' : 'belum bayar' }})</span>
                                    </div>
                                </div>
                                <div class="kanan">
                                    @if ($data->status == 'selesai')
                                        <button class="btn btn rounded text-white"
                                            style="background-color: {{ env('COLOR_PRIMARY') }}">
                                            Beri ulasan
                                        </button>
                                        @elseif($data->status == 'konfirm')
                                        <button
                                        onclick="confirm('Yakin sudah bayar?') || event.stopImmediatePropagation()"
                                        class="btn btn rounded text-white"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                                        sudah bayar
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
    @endif
</div>


<style>
    body {
        background-color: rgb(248, 248, 248);
    }
</style>
