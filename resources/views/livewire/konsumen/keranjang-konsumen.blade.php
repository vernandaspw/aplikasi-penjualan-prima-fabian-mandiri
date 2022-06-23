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
                    <a class="shadow-m px-2" href="{{ url('keranjang') }}"><img src="{{ asset('cart.svg') }}"
                            alt=""></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="body" style="padding-top: 75px; padding-bottom: 65px;">
        <div class="container-fluid">
            <div class="card shadow-sm border border-light">
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ asset('parabola.jpg') }}" width="100px" height="100px" class="rounded"
                            alt="...">
                        <div class="ms-3">

                            <h5 class="card-title">Antena Parabola</h5>

                            <p class="card-text">
                                @uang(10000)
                            </p>

                        </div>
                    </div>
                    <p class="card-text">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="k d-flex">
                            <button wire:click='tambah' class="btn text-white" style="background-color: {{ env('COLOR_PRIMARY') }}">
                                +
                            </button>
                            <input min="1" class="w-25 text-center border border-light py-1 px-0" type="number"
                                wire:model='qty'>
                            <button wire:click='kurang' class="btn btn-warning text-white">
                                -
                            </button>
                        </div>
                        <div class="kanan mt-2">
                            <button wire:click="delete('1')" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="py-2 navbar-nav justify-content-between w-100 align-items-center">
                <div class="me-auto text-white">
                    <div class="">
                        Total Belanja
                    </div>
                    <div class="" style="font-size: 18px">
                        <b>@uang(10000)</b>
                    </div>
                </div>
              
                <div class="ms-auto">
                    <a href="{{ url('checkout') }}"
                        class="nav-link btn px-5 m-1 text-center btn-light"   style="color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                        <b>Checkout</b>
                        </span>
                    </a>
                </div>
            </ul>
        </div>
    </nav>
</div>
