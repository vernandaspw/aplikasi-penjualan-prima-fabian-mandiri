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
                <div class="d-flex justify-content-start">
                    <img src="{{ asset('parabola.jpg') }}" width="100px" height="70px"
                        class="img-fluid rounded-start" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Antena Parabola</h5>
                        <p class="card-text">
                            @uang(10000)
                        </p>
                        <p class="card-text">
                            <div class="">
                                <div class="k d-flex ">
                                    <button class="btn btn-primary">
                                        +
                                    </button>
                                    <input  min="1" class="w-25 text-center border border-light py-1 px-0" type="number"
                                        wire:model='qty'>
                                    <button class="btn btn-warning">
                                        -
                                    </button>
                                </div>
                                <div class="kanan mt-2">
                                    <button class="btn btn-danger">Hapus</button>
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
