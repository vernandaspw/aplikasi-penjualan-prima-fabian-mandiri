<nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow" style="background-color: orange">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto w-full align-items-centar">
            <li class="nav-item me-3">
                <span class="text-white"><b>
                        <a href="{{ url('pesanan-detail', $data->no_transaksi) }}"
                            class="btn btn-close btn-close-white"></a>

                    </b>
                </span>
            </li>
            <li class="nav-item">
                <span class="text-white"><b>Riwayat Perjalanan</b></span>
            </li>
        </ul>

        {{-- <ul class="navbar-nav ms-auto  w-full align-items-start">
            <li class="nav-item">
                <div class="form-check form-switch ">
                    <input wire:click='isonline' type="checkbox" id="flexSwitchCheckDefault"
                        class="form-check-input" {{ $akun['isonline']==true ? 'checked' : '' }}>
                    <label class="form-check-label text-white" for="flexSwitchCheckDefault">Aktif kerja</label>
                </div>
            </li>
        </ul> --}}
    </div>
</nav>

<section style="padding-top: 75px; padding-bottom: 70px">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <div class="kiri">
                <img src="{{ asset('logo.png') }}" alt="" width='45px' height="45px">
            </div>
            <div class="kanan">
                <span class="text-uppercase"><b>{{ $data->status }}</b></span>
            </div>
        </div>
        <div>
            <hr>
            <center>

                {{ $data->status }}
                <center>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <div class="kiri">
                No Transaksi
            </div>
            <div class="kanan">
                <span class="">{{ $data->no_transaksi }}</span>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="kiri">
                No Resi
            </div>
            <div class="kanan">
                <span class="">{{ $data->no_resi == null ? '-' : $daa->no_resi }}</span>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="kiri">
                Tanggal dibuat
            </div>
            <div class="kanan">
                <span class="">{{ $data->created_at }}</span>
            </div>
        </div>
        <hr>

        @forelse ($data->transaksilog as $log)
            <li class="">
                {{ $log->status . ' | ' . $log->created_at }}
                <ul style="list-style-type:none">
                    <li>
                        {{ $log->keterangan != null ? 'keterangan' . $log->keterangan : '' }}
                    </li>
                </ul>
            </li>
            @if ($log->status != 'selesai')
                <div class="garis_vertikal"></div>
            @endif

        @empty
        @endforelse

    </div>
</section>
</div>

<style>
    .garis_vertikal {
        margin-left: 2px;
        border-left: 2px black solid;
        height: 30px;
        width: 1px;
    }
</style>
