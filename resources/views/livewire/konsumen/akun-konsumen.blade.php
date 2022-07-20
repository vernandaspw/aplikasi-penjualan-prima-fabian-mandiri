<div>
    @if ($akun == 'login')
        <livewire:konsumen.login-konsumen />
    @else
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

        <livewire:konsumen.component.navbottom />
    @endif

</div>
