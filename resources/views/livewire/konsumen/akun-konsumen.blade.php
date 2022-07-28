<div>
    @if ($akun == 'login')
        <livewire:konsumen.login-konsumen />
    @else
        <div class="d-md-block d-lg-block d-xl-block d-none">
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
            <div class="mt-5 pt-1"></div>

            <div class="body" style="padding-bottom: 65px;">
                <div class="row">
                    <div class="col-md-2">
                        <div class="container-lg container-fluid">
                            <div class="mt-2 text-center">
                                <h5><b>MENU</b></h5>
                            </div>
                            <hr class="mt-0 pt-0">
                            <a href="{{ url('/') }}" class="card text-decoration-none border-0 shadow-sm "
                                style="border-radius: 160px; background-color: {{ Request::is('/') == '/' ? env('COLOR_PRIMARY') . '; color: white;' : '; color:black;' }}">
                                <div class="card-body py-2">
                                    <div class="text-center">
                                        Beranda
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('pesanan') }}" class="card mt-2 text-decoration-none border-0 shadow-sm "
                                style="border-radius: 160px; background-color: {{ Request::is('pesanan*') == 'pesanan*' ? env('COLOR_PRIMARY') . '; color: white;' : '; color:black;' }}">
                                <div class="card-body py-2">
                                    <div class="text-center">
                                        Pesanan
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('akun') }}" class="card mt-2 text-decoration-none border-0 shadow-sm "
                                style="border-radius: 160px; background-color: {{ Request::is('akun*') == 'akun*' ? env('COLOR_PRIMARY') . '; color: white;' : '; color:black;' }}">
                                <div class="card-body py-2">
                                    <div class="text-center">
                                        Akun
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="col-md-10">

                        <div class="mb-2" style="background-color: {{ env('COLOR_PRIMARY') }}">
                            <div class="pb-3 pt-4">
                                <center>
                                    <div class="">
                                        <img class="rounded-circle shadow-sm border border-4 border-white"
                                            src="{{ asset('AvatarMaker.png') }}" width="90px" alt="">
                                    </div>
                                    <div class="mt-2 text-white" style="font-size: 26px">
                                        {{ $akun->nama }}
                                    </div>
                                </center>
                            </div>
                        </div>
                        <div class="container mt-2">
                            <div class="d-flex justify-content-between pt-2">
                                <div class="">
                                    <b>Profil</b>
                                </div>
                                <div class="">
                                    <a href="{{ url('ubah-profil') }}" class="text-decoration-none"
                                        style="color: {{ env('COLOR_PRIMARY') }}">Ubah</a>
                                </div>
                            </div>

                            <div class="mt-2">
                                <div class="text-muted " style="font-size: 12px">Email</div>
                                <div class="" style="font-size: 14px">{{ $akun->email }}</div>
                            </div>

                            <div class="mt-1">
                                <div class="text-muted " style="font-size: 12px">Nomor handphone</div>
                                <div class="" style="font-size: 14px">{{ $akun->nohp }}</div>
                            </div>
                            <div class="mt-1">
                                <div class="text-muted " style="font-size: 12px">Jenis Kelamin</div>
                                <div class="" style="font-size: 14px">{{ $akun->jeniskelamin }}</div>
                            </div>
                        </div>


                        <div class="container">
                            <hr class="my-2">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <b>Alamat</b>
                                </div>
                                <div class="">
                                    <a href="{{ url('ubah-alamat') }}" class="text-decoration-none"
                                        style="color: {{ env('COLOR_PRIMARY') }}">
                                        @if ($akun->provinsi && $akun->kota && $akun->kecamatan && $akun->alamat && $akun->patokan && $akun->kodepos)
                                            Ubah
                                        @endif
                                    </a>
                                </div>
                            </div>
                            @if ($akun->provinsi && $akun->kota && $akun->kecamatan && $akun->alamat && $akun->patokan && $akun->kodepos)
                                <div class="mt-2">
                                    <div class="text-muted" style="font-size: 12px">Provinsi</div>
                                    <div class="" style="font-size: 14px">{{ $akun->provinsi }}</div>
                                </div>
                                <div class="mt-1">
                                    <div class="text-muted" style="font-size: 12px">Kota/kabupaten</div>
                                    <div class="" style="font-size: 14px">{{ $akun->kota }}</div>
                                </div>
                                <div class="mt-1">
                                    <div class="text-muted" style="font-size: 12px">Kecamatan</div>
                                    <div class="" style="font-size: 14px">{{ $akun->kecamatan }}</div>
                                </div>
                                <div class="mt-1">
                                    <div class="text-muted" style="font-size: 12px">Alamat</div>
                                    <div class="" style="font-size: 14px">{{ $akun->alamat }}</div>
                                </div>
                                <div class="mt-1">
                                    <div class="text-muted" style="font-size: 12px">Patokan</div>
                                    <div class="" style="font-size: 14px">{{ $akun->patokan }}</div>
                                </div>
                                <div class="mt-1">
                                    <div class="text-muted" style="font-size: 12px">Kode pos</div>
                                    <div class="" style="font-size: 14px">{{ $akun->kodepos }}</div>
                                </div>
                            @else
                                Alamat tidak lengkap, silakan
                                <a href="{{ url('ubah-alamat') }}" class="text-decoration-none"
                                    style="color: {{ env('COLOR_PRIMARY') }}">
                                    lengkapi alamat
                                </a>
                            @endif



                        </div>



                        <div class="container">
                            <hr class="my-2">
                            <a href="{{ url('ubah-password') }}"
                                class="btn rounded-pill mt-2 form-control text-white"
                                style="background-color: {{ env('COLOR_PRIMARY') }}">
                                Ubah password
                            </a>
                            <button wire:click='logout' class="btn rounded-pill btn-danger mt-2 form-control">
                                Logout
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="d-md-none d-lg-none d-xl-none">
            <div class="body" style="padding-bottom: 65px;">
                <div class="mb-2" style="background-color: {{ env('COLOR_PRIMARY') }}">
                    <div class="pb-3 pt-4">
                        <center>
                            <div class="">
                                <img class="rounded-circle shadow-sm border border-4 border-white"
                                    src="{{ asset('AvatarMaker.png') }}" width="90px" alt="">
                            </div>
                            <div class="mt-2 text-white" style="font-size: 26px">
                                {{ $akun->nama }}
                            </div>
                        </center>
                    </div>
                </div>
                <div class="container mt-2">
                    <div class="d-flex justify-content-between pt-2">
                        <div class="">
                            <b>Profil</b>
                        </div>
                        <div class="">
                            <a href="{{ url('ubah-profil') }}" class="text-decoration-none"
                                style="color: {{ env('COLOR_PRIMARY') }}">Ubah</a>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="text-muted " style="font-size: 12px">Email</div>
                        <div class="" style="font-size: 14px">{{ $akun->email }}</div>
                    </div>

                    <div class="mt-1">
                        <div class="text-muted " style="font-size: 12px">Nomor handphone</div>
                        <div class="" style="font-size: 14px">{{ $akun->nohp }}</div>
                    </div>
                    <div class="mt-1">
                        <div class="text-muted " style="font-size: 12px">Jenis Kelamin</div>
                        <div class="" style="font-size: 14px">{{ $akun->jeniskelamin }}</div>
                    </div>
                </div>


                <div class="container">
                    <hr class="my-2">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <b>Alamat</b>
                        </div>
                        <div class="">
                            <a href="{{ url('ubah-alamat') }}" class="text-decoration-none"
                                style="color: {{ env('COLOR_PRIMARY') }}">
                                @if ($akun->provinsi && $akun->kota && $akun->kecamatan && $akun->alamat && $akun->patokan && $akun->kodepos)
                                    Ubah
                                @endif
                            </a>
                        </div>
                    </div>
                    @if ($akun->provinsi && $akun->kota && $akun->kecamatan && $akun->alamat && $akun->patokan && $akun->kodepos)
                        <div class="mt-2">
                            <div class="text-muted" style="font-size: 12px">Provinsi</div>
                            <div class="" style="font-size: 14px">{{ $akun->provinsi }}</div>
                        </div>
                        <div class="mt-1">
                            <div class="text-muted" style="font-size: 12px">Kota/kabupaten</div>
                            <div class="" style="font-size: 14px">{{ $akun->kota }}</div>
                        </div>
                        <div class="mt-1">
                            <div class="text-muted" style="font-size: 12px">Kecamatan</div>
                            <div class="" style="font-size: 14px">{{ $akun->kecamatan }}</div>
                        </div>
                        <div class="mt-1">
                            <div class="text-muted" style="font-size: 12px">Alamat</div>
                            <div class="" style="font-size: 14px">{{ $akun->alamat }}</div>
                        </div>
                        <div class="mt-1">
                            <div class="text-muted" style="font-size: 12px">Patokan</div>
                            <div class="" style="font-size: 14px">{{ $akun->patokan }}</div>
                        </div>
                        <div class="mt-1">
                            <div class="text-muted" style="font-size: 12px">Kode pos</div>
                            <div class="" style="font-size: 14px">{{ $akun->kodepos }}</div>
                        </div>
                    @else
                        Alamat tidak lengkap, silakan
                        <a href="{{ url('ubah-alamat') }}" class="text-decoration-none"
                            style="color: {{ env('COLOR_PRIMARY') }}">
                            lengkapi alamat
                        </a>
                    @endif



                </div>



                <div class="container">
                    <hr class="my-2">
                    <a href="{{ url('ubah-password') }}" class="btn rounded-pill mt-2 form-control text-white"
                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                        Ubah password
                    </a>
                    <button wire:click='logout' class="btn rounded-pill btn-danger mt-2 form-control">
                        Logout
                    </button>
                </div>

            </div>
        </div>

        <div class="d-md-none d-lg-none d-xl-none d-block">
            <livewire:konsumen.component.navbottom />
        </div>
    @endif

</div>
