<div>
    <livewire:admin.component.navbar-admin />

    <div class="container mt-3 mb-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h5>
                    <b>{{ $kasir->nama }}</b>
                </h5>

            </div>
            <div class="">
                @if ($formtransaksi)
                @else
                    <button wire:click="$toggle('formtransaksi')" type="button"
                        class="btn me-1 text-white rounded-pill btn-warning">
                        Buat transaksi kas
                    </button>
                @endif
                <a href="{{ url('admin/kasir') }}" class="btn text-white btn-warning shadow-sm rounded-pill">Kembali</a>

            </div>
        </div>
        <div class="mt-2">
            @if ($formtransaksi)
                <div class="card mb-2 shadow-sm rounded">
                    <div class="card-body">
                        <div class="mb-1">
                            <b>Buat Transaksi kas</b>
                        </div>
                        <form wire:submit.prevent='buattransaksi'>
                            <div class="">
                                <label for="kasir_kas_jenis_id" class="">Pilih jenis</label>
                                <select required wire:model='kasir_kas_jenis_id'
                                    class="form-control @error('kasir_kas_jenis_id') is-invalid @enderror"
                                    id="kasir_kas_jenis_id">
                                    <option value="">Pilih jenis transaksi</option>
                                    @foreach ($jenis as $data)
                                        <option value="{{ $data->id }}">Kas {{ $data->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kasir_kas_jenis_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-1">
                                <label for="kasir_kas_kategori_id" class="">Pilih kategori</label>
                                <select required wire:model='kasir_kas_kategori_id'
                                    class="form-control @error('kasir_kas_kategori_id') is-invalid @enderror"
                                    id="kasir_kas_kategori_id">
                                    <option value="">Pilih kategori transaksi</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kasir_kas_kategori_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-1">
                                <label for="nominal" class="">Nominal</label>
                                <input placeholder="Nominal..." required wire:model='nominal' type="number"
                                    class="form-control @error('nominal') is-invalid @enderror" id="nominal"
                                    aria-describedby="nominalHelp">
                                @error('nominal')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-1">
                                <label for="keterangan" class="">Keterangan</label>
                                <input placeholder="(optional)" wire:model='keterangan' type="text"
                                    class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    aria-describedby="keteranganHelp">
                                @error('keterangan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="form-control btn text-white rounded-pill"
                                    style="background-color: {{ env('COLOR_PRIMARY') }}">Simpan</button>
                            </div>
                        </form>
                        <button wire:click="$toggle('formtransaksi')" type="button"
                            class="btn rounded-pill form-control  btn-secondary">
                            Tutup
                        </button>
                    </div>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="">
                Nama Toko
            </div>
            <div class="">
                PFM STORE
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                Kasir
            </div>
            <div class="">
                {{ $kasir->nama }}
            </div>
        </div>
        <hr class="my-1 py-0">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                Start time
            </div>
            <div class="">
                @if($start)
                {{ \Carbon\Carbon::parse($start->created_at)->isoFormat('D MMMM Y H:M') }}
                @else
                -
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                End time
            </div>
            <div class="">

                @if($end)
                {{ \Carbon\Carbon::parse($end->created_at)->isoFormat('D MMMM Y H:M') }}
                @else
                -
                @endif

            </div>
        </div>
        <hr class="my-1 py-0">
        <center>PENJUALAN</center>
        <hr class="my-1 py-0">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="">
                Total penjualan
            </div>
            <div class="">
                @uang($Dpenjualantunai)
            </div>
        </div>
        <hr class="my-1 py-0">
        <center>PAYMENT</center>
        <hr class="my-1 py-0">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="">
                Transaksi
            </div>
            <div class="">
                @dump($paymentcash)
                @uang(2)
            </div>
        </div>
        <hr class="my-1 py-0">
        <b>Hari ini</b>
        <div class="d-flex justify-content-between align-items-center ">
            <div class="">
                Total Modal
            </div>
            <div class="">
                @uang($kasir->modal)
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center ">
            <div class="">
                Modal awal
            </div>
            <div class="">
                @uang($Dmodalawal)
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center ">
            <div class="">
                Modal akhir
            </div>
            <div class="">
                @uang($Dmodalakhir)
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center ">
            <div class="text-danger">
                Selisih @if($selisih > 0)
                    lebih
                    @else
                    kurang
                @endif
            </div>
            <div class="text-danger">
                @uang($selisih)
            </div>
        </div>

        <hr class="my-1 py-0">

        <div class="mt-2">
            <b>Riwayat Transaksi</b>
        </div>
        <div class="mt-1">

            @foreach ($kasirtransaksi as $data)
                <div class="card mb-1 shadow-sm rounded">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <b>{{ $data->jenis->nama }}</b>
                            </div>
                            <div class="">
                                {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }} |
                                <b>{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y') }}</b>
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <div class="">
                                {{ $data->kategori->nama }}
                            </div>
                            <div class="">
                                @uang($data->nominal)
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($take < $kasirtransaksi->count())
                <div class="mt-2">
                    <button wire:click='lanjut' type="button" class="form-control text-white rounded-pill btn btn-warning">Lanjut</button>
                </div>
            @endif
        </div>
    </div>
</div>
