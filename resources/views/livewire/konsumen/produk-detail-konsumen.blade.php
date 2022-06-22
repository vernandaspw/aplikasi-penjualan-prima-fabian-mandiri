<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm" style="background-color: {{ env('COLOR_PRIMARY') }}">
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
                    <a class="shadow-m px-3" href="{{ url('keranjang') }}"><img src="{{ asset('cart.svg') }}"
                            alt=""></a>
                </li>
            </ul>

            {{-- <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">

                </li>
            </ul> --}}
        </div>
    </nav>
    <div class="body" style="padding-top: 75px; padding-bottom: 65px;">
        <div class="container">
            detail {{ $produkid }}
        </div>
    </div>
    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: white">
       <div class="container">
        <ul class="py-1 navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item" style="margin-right: 2px">
                <button href="javascript:void(0)" wire:click.prefetch='pesanan'
                    class="nav-link btn m-1 text-center" style=" border-color: {{ env('COLOR_PRIMARY') }};">
                    <span class="small d-block" style="font-size: 15px; color: {{ env('COLOR_PRIMARY') }}">
                        Beli langsung
                    </span>
                </button>
            </li>
            <li class="nav-item" style="margin-left: 2px">
                <button href="javascript:void(0)" wire:click.prefetch='akun'
                    class="nav-link btn m-1 text-white text-center" style="background-color: {{ env('COLOR_PRIMARY') }}">
                    <span class="small d-block" style="font-size: 15px">
                        + Keranjang
                    </span>
                </button>
            </li>
        </ul>
       </div>
    </nav>
</div>
