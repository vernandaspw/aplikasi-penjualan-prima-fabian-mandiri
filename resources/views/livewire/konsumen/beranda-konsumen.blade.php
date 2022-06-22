<div>
    <nav class="p-2 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">

            <ul class="navbar-nav me-2 form-control w-full align-items-centar bg-white p-1 rounded">
                <li class="nav-item me-2 ms-1 ">
                    <span class="text-white">
                        <img src="{{ asset('logo.png') }}" width="20px" alt="">
                    </span>
                </li>
                <li class="nav-item">
                    <span class="text-white">

                    </span>
                </li>
                <input class="form-control rounded border border-right-0 border-1 p-1" type="cariproduk"
                    placeholder="cari produk" aria-label="cariproduk">
            </ul>

            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <a class="shadow-m px-3" href="{{ url('keranjang') }}"><img src="{{ asset('cart.svg') }}"
                            alt=""></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="body" style="padding-top: 70px; padding-bottom: 65px;">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="kiri me-3">
                            <img src="{{ asset('logo.png') }}" width="60px" alt="">
                        </div>
                        <div class="kanan">
                            <b style="font-size: {{ env('FONTSIZE_H') }}">Nama perusahaan</b>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam dipiscing elit ut
                                aliquam dipis ing elit ut aliquam dipiscing elit ut aliquam dipis...
                            </p>
                            <div class="">

                                selengkapnya >>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="kategori">
                <div class="mt-3">
                    <span style="font-size: {{ env('FONTSIZE_H') }}"><b>Kategori</b></span>
                </div>
                <div class="scrollmenu mt-1">
                    <a href="{{ url('pesanan-create') }}">
                        <div class="card border border-light border-2 shadow-sm me-1"
                            style="width: 100%; height: 100%;">
                            <div class="card-body">
                                <div class=" text-wrap text-center" style="font-size: 14px;">
                                    Antena
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <section class="merek">
                <div class="mt-3">
                    <span style="font-size: {{ env('FONTSIZE_H') }}"><b>Merek</b></span>
                </div>
                <div class="scrollmenu mt-1">
                    <a href="{{ url('pesanan-create') }}">
                        <div class="card border border-light border-2 shadow-sm me-1"
                            style="width: 100%; height: 100%;">
                            <div class="card-body">
                                <div class=" text-wrap text-center" style="font-size: 14px;">
                                    Sonoff
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <section class="produk">
                <div class="mt-3">
                    <span style="font-size: {{ env('FONTSIZE_H') }}"><b>Produk Terbaru</b></span>
                </div>
                <div class="mt-1">
                    <div class="row row-cols-2">

                        <div class="col mt-2">
                            <div class="card">
                                <img src="{{ asset('parabola.jpg') }}" class="" width="100%" height="170px" alt="">
                                <div class="card-body">
                                    <div class="">
                                        Antena Super
                                    </div>
                                    <div class="" style="font-size: 19px; color: {{ env('COLOR_PRIMARY') }};">
                                        <b>
                                            @uang(10000)
                                        </b>
                                    </div>

                                    <div class="">
                                        <img src="{{ asset('stars.svg') }}" alt=""> 4.5 | Terjual 29
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

</div>


<style>
    div.scrollmenu {
        overflow: auto;
        white-space: nowrap;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    div.scrollmenu::-webkit-scrollbar {
        display: none;
    }


    div.scrollmenu a {
        display: inline-block;
        text-align: center;
        /* padding-top: 8px;
        padding-bottom: 8px; */
        color: black;
        text-decoration: none;
    }

    div.scrollmenu .card:hover {
        background-color: {
                {
                env('COLOR_PRIMARY')
            }
        }

        ;
        color: white;
        border: none;
    }
</style>
