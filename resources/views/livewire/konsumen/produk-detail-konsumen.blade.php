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
                    <span class="text-white"><b>Produk Detail</b></span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <a class="shadow-m px-3" href="{{ url('keranjang') }}"><img src="{{ asset('cart.svg') }}"
                            alt=""></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="body" style="padding-top: 60px; padding-bottom: 85px;">

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('parabola.jpg') }}" class="d-block w-100" height="300px" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('parabolabig.jpg') }}" class="d-block w-100" height="300px" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('antena.jpg') }}" class="d-block w-100" height="300px" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container mt-3">
            <div class="">
                Kabel Adaptor
            </div>
            <div class="" style="font-size: 18px">
                <b> @uang(10000)</b>
            </div>
            <div class="">
                Terjual 29 | <img src="{{ asset('stars.svg') }}" alt=""> 4.5 (20)
            </div>
            <div class="">
                Stok tersedia 20
            </div>

            <hr style="margin: 0px">

            <div class="mt-2">
                <b>Detail Produk</b>
            </div>
            <div class="d-flex justify-content-between">
                <div class="kiri text-start">
                    Kategori
                </div>
                <div class="kanan text-end">
                    Aksesoris
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div class="kiri text-start">
                    Merek
                </div>
                <div class="kanan text-end">
                    Alpa
                </div>
            </div>

            <div class="mt-2">
                <b>Deskripsi Produk</b>
            </div>
            <div class="">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, ex. Magni possimus, eveniet enim
                    ullam dignissimos sapiente vero minus officiis repellat sequi rerum numquam fugit consequuntur modi
                    itaque delectus maxime
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore, quibusdam sed odit, nobis ipsum
                    molestias expedita est architecto vel quasi sequi veritatis, beatae dolore doloribus voluptatum
                    quaerat cupiditate repellat a.
                </p>
            </div>
            <hr style="margin: 0px">
            <hr style="margin: 0px" class="mt-1">
            <div class="mt-3">
                <b>Ulasan Pembeli</b>
            </div>
            <div class="">
                Kabel Adaptor
            </div>
            <div class="">
                <img src="{{ asset('stars.svg') }}" alt=""> 4.5/5.0 | 20 rating | 12 ulasan
            </div>
       
            <div class="mt-2">
                <div class="card">
                    <div class="card-body pt-2 pb-0">
                        <div>
                            <img src="{{ asset('stars.svg') }}" alt=""> <img src="{{ asset('stars.svg') }}"
                                alt=""> - 4 Hari yg lalu
                        </div>
                        <div class="">
                            <b>Budi</b>
                        </div>
                        <div class="">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellat esse suscipit
                                nisi
                                doloremque quasi nihil veniam sunt perspiciatis aspernatur enim quis hic, ullam eum!
                                Exercitationem
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <center><button class="btn btn-transparent form-control">Lanjut</button></center>
                </div>
            </div>
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
                        class="nav-link btn m-1 text-white text-center"
                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                            + Keranjang
                        </span>
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</div>
