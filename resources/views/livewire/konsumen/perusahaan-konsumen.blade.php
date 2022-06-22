<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm" style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('/') }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>Tentang kami</b></span>
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
            <h2>
                {{ $perusahaan->nm_perusahaan }}
            </h2>
            <div>
                <div class="">
                    <h5><b>Tentang Perusahaan</b></h5>
                </div>
                <p>
                    {{ $perusahaan->tentang }}
                </p>
            </div>
            <div class="mt-2">
                <h5><b>Alamat</b></h5>
            </div>
            @if ($perusahaan->provinsi != null)
                <div class="">
                    provinsi :{{ $perusahaan->provinsi }}
                </div>
            @endif
            @if ($perusahaan->kota != null)
                <div class="">
                    kota :{{ $perusahaan->kota }}
                </div>
            @endif
            @if ($perusahaan->kecamatan != null)
                <div class="">
                    kecamatan :{{ $perusahaan->kecamatan }}
                </div>
            @endif
            @if ($perusahaan->alamat != null)
                <div class="">
                    alamat :{{ $perusahaan->alamat }}
                </div>
            @endif
            @if ($perusahaan->kodepos != null)
                <div class="">
                    kodepos :{{ $perusahaan->kodepos }}
                </div>
            @endif

            <br>
            @if ($perusahaan->nm_toko != null)
                <div class="">
                    <b> Toko :{{ $perusahaan->nm_toko }}</b>
                </div>
            @endif
            @if ($perusahaan->no_telp != null)
                <div class="">
                    telp :{{ $perusahaan->no_telp }}
                </div>
            @endif
            @if ($perusahaan->no_wa != null)
                <div class="">
                    whatsapp :{{ $perusahaan->no_wa }}
                </div>
            @endif
            @if ($perusahaan->ig != null)
                <div class="">
                    instagram :{{ $perusahaan->ig }}
                </div>
            @endif



        </div>
    </div>
</div>
