<div>
    <livewire:admin.component.navbar-admin />

    <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <button type="button" wire:click='pageproduk'
                    class="nav-link btn-transparent btn border-0 @if ($penjualanproduk = true) active @endif text-center">
                    <span class="small d-block"
                        style="font-size: 14px; 
                    @if ($penjualanproduk = true) font-weight: bold; color:white; @endif
                    ">
                        Produk
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" wire:click='pagemanual'
                class="nav-link btn-transparent btn border-0 @if ($penjualanproduk = false) active @endif text-center">
                <span class="small d-block"
                    style="font-size: 14px; 
                @if ($penjualanproduk = false) font-weight: bold; color:white; @endif
                ">
                    Manual
                </span>
            </button>
            </li>
        </ul>
    </nav>

    <div class="container mt-3 mb-5">
        {{ $penjualanproduk }}
        @if ($penjualanproduk == true)
            <livewire:admin.penjualan-produk-admin />
        @else
            <livewire:admin.penjualan-manual-admin>
        @endif
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
                            <b>Lanjut</b>
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
                awdaw
            </div>
            <div class="">
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
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                    aria-controls="offcanvasBottom" style="color: {{ env('COLOR_PRIMARY') }}">
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
</div>

<style>
    .offcanvas {
        height: 85% !important;
    }
</style>
