<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm" style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('/') }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>{{ $perusahaan->nm_perusahaan }}</b></span>
                </li>
            </ul>

            {{-- <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">

                </li>
            </ul> --}}
        </div>
    </nav>
    <div class="body" style="padding-top: 70px; padding-bottom: 65px;">
        <div class="container">
            <h2>

            </h2>
            <div>
                <div class="">
                    <h5><b>SEJARAH PERUSAHAAN</b></h5>
                </div>
                <p style="text-align: justify">
                    {!! $perusahaan->sejarah !!}
                </p>
                <hr>
                <div class="">
                    <h5><b>VISI</b></h5>
                </div>
                <p style="text-align: justify">
                    {!! $perusahaan->visi !!}
                </p>
                <hr>
                <div class="">
                    <h5><b>MISI</b></h5>
                </div>
                <p style="text-align: justify">
                    {!! $perusahaan->misi !!}
                </p>
            </div>
            <hr>
            <div class="">
                <h5><b>ALAMAT PERUSAHAAN</b></h5>
            </div>
            @if ($perusahaan->provinsi != null)
                <div class="d-flex justify-content-between">
                    Provinsi
                    <div class="">
                        {{ $perusahaan->provinsi }}
                    </div>
                </div>
            @endif
            @if ($perusahaan->kota != null)
                <div class="d-flex justify-content-between">
                    Kota
                    <div class="">
                        {{ $perusahaan->kota }}
                    </div>
                </div>
            @endif
            @if ($perusahaan->kecamatan != null)
                <div class="d-flex justify-content-between">
                    Kecamatan
                    <div class="">
                        {{ $perusahaan->kecamatan }}
                    </div>
                </div>
            @endif
            @if ($perusahaan->alamat != null)
                <div class="d-flex justify-content-between">
                    Alamat
                    <div class="">{{ $perusahaan->alamat }}</div>
                </div>
            @endif
            @if ($perusahaan->kodepos != null)
                <div class="d-flex justify-content-between">
                    Kode Pos
                    <div class="">
                        {{ $perusahaan->kodepos }}
                    </div>
                </div>
            @endif
<hr>
            <div class="">
                <h5><b>KONTAK PERUSAHAAN</b></h5>
            </div>
            @if ($perusahaan->no_telp != null)
                <div class="d-flex justify-content-between">
                    Telp
                    <div class="">
                        {{ $perusahaan->no_telp }}
                    </div>
                </div>
            @endif
            @if ($perusahaan->no_wa != null)
                <div class="d-flex justify-content-between">
                    Whatsapp
                    <div class="">
                        {{ $perusahaan->no_wa }}
                    </div>
                </div>
            @endif
            @if ($perusahaan->ig != null)
                <div class="d-flex justify-content-between">
                    Instagram
                    <div class="">
                        {{ $perusahaan->ig }}
                    </div>
                </div>
            @endif



        </div>
    </div>
</div>
