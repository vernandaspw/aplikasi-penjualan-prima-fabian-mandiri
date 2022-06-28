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
        <div class="body" style="padding-top: 75px; padding-bottom: 65px;">
            <div class="container-fluid container-lg">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="kiri">
                                T4325343523523523
                            </div>
                            <div class="kanan">
                                Selesai
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="mt-2 d-flex justify-content-start">
                            <div class="kiri">
                                <img src="{{ asset('parabola.jpg') }}" width="60px" height="60px" class="rounded"
                                    alt="...">
                            </div>
                            <div class="kanan ms-3">
                                <div class="">
                                    <b>Parabola</b>
                                    <div class="">
                                        1 Qty
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1">
                            +2 Produk lainnya
                        </div>
                        <hr class="my-0">
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <div class="kir">
                                <div class="text-muted">
                                    Total pesanan
                                </div>
                                <div class="">
                                    <b>@uang(200000)</b>
                                </div>
                            </div>
                            <div class="kanan">
                                <button class="btn btn rounded text-white"
                                    style="background-color: {{ env('COLOR_PRIMARY') }}">
                                    Beri ulasan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


<style>
    body {
        background-color: rgb(248, 248, 248);
    }
</style>
