<div>
    <livewire:admin.component.navbar-admin />

    {{-- <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="{{ url('admin/kelola-transaksi-penjualan') }}" class="nav-link  text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        Transaksi penjualan
                        <span class="badge bg-danger">{{ $transaksi->where('status', 'proses_pembayaran')->count() == 0 ? '' : $transaksi->where('status', 'proses_pembayaran')->count() }}</span>

                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/kelola-transaksi-lainnya') }}" class="nav-link active text-center">
                    <span class="small d-block" style="font-size: 14px; font-weight: bold; color:white;">
                        Transaksi lainnya
                        <span class="badge bg-danger">1</span>
                    </span>
                </a>
            </li>
        </ul>
    </nav> --}}

    <div class="mt-2 mb-5">
        <div class="mb-3 container-fluid">
            <div class="card shadow-sm">
                <div class="card-body py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <b>KELOLA TRANSAKSI</b>
                        </div>
                        <div class="">
                            {{-- <a href="{{ url('admin/kelola-produk-kategori') }}"
                                class="btn me-1 mb-1 rounded-pill btn-info text-white">
                                Kategori ('{{ $jmlkategori }}')
                            </a> --}}

                            @if ($pageBuat)
                            @else
                                <button wire:click="formBuat"
                                    class="btn btn-sm me-1 mb-1 rounded-pill btn-success text-white">
                                    Buat transaksi baru
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($pageBuat)
            <div class="container-fluid">
                <div class="col-lg-3 col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="">
                                <form wire:submit.prevent='buatTransaksi'>
                                    <div class="mt-2">
                                        <b>Buat Transaksi baru</b>
                                    </div>
                                    <div class="mt-1">
                                        <label for="jenis">Jenis Transaksi</label>
                                        <select required
                                            class="form-control form-control-sm @error('jenis') is-invalid @enderror""
                                            wire:model='inputJenis' id="jenis">
                                            <option value="">Pilih jenis</option>
                                            @foreach ($jenis as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-1">
                                        <label for="kategori">Kategori Transaksi</label>
                                        <select required
                                            class="form-control form-control-sm @error('kategori') is-invalid @enderror""
                                            wire:model='inputKategori' id="kategori">
                                            <option value="">Pilih kategori</option>
                                            @foreach ($kategori as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-1">
                                        <label for="nominal">Nominal</label>
                                        <input required placeholder="Nominal" min="1" id="nominal"
                                            type="number" wire:model.lazy='nominal'
                                            class="form-control form-control-sm @error('nominal') is-invalid @enderror">
                                        @error('nominal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-1">
                                        <label for="catatan">catatan</label>
                                        <input placeholder="catatan" id="catatan" type="text"
                                            wire:model.lazy='catatan'
                                            class="form-control form-control-sm @error('catatan') is-invalid @enderror">
                                        @error('catatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-1 d-flex w-100">
                                        <div class="w-100 me-1">
                                            <input type="datetime-local" wire:model='datetime' id=""
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="ms-1 w-100">
                                            <select wire:model='islunas' class="form-control form-control-sm">
                                                <option value="true">Lunas
                                                </option>
                                                <option value="false">Belum
                                                    bayar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <label for="metodepembayaran">Metode Pembayaran</label>
                                        <select required
                                            class="form-control form-control-sm @error('metodepembayaran') is-invalid @enderror""
                                            wire:model='inputmetodepembayaran' id="metodepembayaran">
                                            <option value="">Pilih metodepembayaran</option>
                                            @foreach ($metodepembayaran as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('metodepembayaran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-1">
                                        <label for="nama">Nama Produk</label>
                                        <input placeholder="Nama produk" id="nama" type="text"
                                            wire:model.lazy='nama'
                                            class="form-control form-control-sm @error('nama') is-invalid @enderror">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="btn form-control btn-sm mt-2 me-1 text-white mb-1 rounded-pill btn-success shadow-sm text-dark">
                                        Simpan
                                    </button>
                                </form>
                            </div>

                            <div class="mt-1">
                                <button wire:click="tutupForm" type="button"
                                    class="btn form-control btn-sm mt-2 me-1 mb-1 rounded-pill btn-light shadow-sm text-dark">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container-fluid">
            <hr>
            <div class="">
                <h5>
                    Riwayat Transaksi
                </h5>
            </div>
            <div class="mt-2">
                <div class="col-lg-3 col-md-6">
                    <input class="form-control" type="text" wire:model='cariproduk'
                        placeholder="Cari no transaksi/barcode">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm" style="font-size: 12px">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 3%">#</th>
                            <th style="width: 10%">No Transaksi</th>
                            <th scope="col" style="width: 10%">Jenis</th>
                            <th scope="col" style="width: 10%">Kategori</th>
                            <th scope="col" style="width: 10%">Konsumen</th>
                            <th scope="col" style="width: 10%">Pengiriman</th>
                            <th scope="col" style="width: 10%">Pembayaran</th>
                            <th scope="col" style="width: 10%">Total Pembayaran</th>
                            <th style="width: 11%">Status</th>
                            <th style="width: 11%">Bayar</th>
                            <th style="width: 11%">Dibuat</th>
                            <th style="width: 11%">aksi</th>
                        </tr>
                    </thead>
                    <tbody class='table-group-divider'>
                        @forelse ($transaksi as $data)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    {{ $data->no_transaksi }}
                                </td>
                                <td>
                                    {{ $data->transaksi_jenis->nama }}
                                </td>
                                <td>
                                    {{ $data->transaksi_kategori->nama }}
                                </td>
                                <td>
                                    @if ($data->konsumen_id)
                                        {{ $data->konsumen->nama }}
                                    @else
                                        {{ $data->nama_konsumen }}
                                    @endif
                                </td>
                                <td>
                                    {{ $data->metodekirim->metode }}
                                </td>
                                <td>
                                    {{ $data->metodepembayaran->metode }}
                                </td>

                                <td>
                                    @uang($data->total_pembayaran)
                                </td>
                                <td>
                                    {{ $data->status }}
                                </td>
                                <td style="color: {{ $data->islunas == true ? 'green' : 'red' }}">
                                    {{ $data->islunas == true ? 'sudah bayar' : 'belum bayar' }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                </td>
                                <td>
                                    @if ($data->status == 'proses_pembayaran')
                                        <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                            wire:click="ubahstatus({{ $data->id }})" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-success"
                                            style="font-size: 12px">
                                            Terima pembayaran
                                        </button>
                                    @endif
                                    {{-- <button wire:click="editform('{{ $data->id }}')"
                                        class="btn m-1 btn-sm rounded text-white btn-warning" style="font-size: 12px">
                                        Edit
                                    </button> --}}
                                </td>



                            </tr>
                        @empty
                            tidak ada data
                        @endforelse
                    </tbody>
                </table>
                @if ($take < $jml_item)
                    <center>
                        <button wire:click='lanjut'
                            class="btn btn-light shadow-sm form-control rounded-pill">Lanjut</button>
                    </center>
                @endif
            </div>
        </div>
    </div>
</div>
