<div>
    <livewire:admin.component.navbar-admin />

    {{-- <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="{{ url('admin/kelola-transaksi-penjualan') }}" class="nav-link active text-center">
                    <span class="small d-block" style="font-size: 14px; font-weight: bold; color:white;">
                        Transaksi penjualan
                        <span class="badge bg-danger">{{ $transaksi->where('status', 'proses_pembayaran')->count() == 0 ? '' : $transaksi->where('status', 'proses_pembayaran')->count() }}</span>

                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/kelola-transaksi-lainnya') }}" class="nav-link text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        Transaksi lainnya
                        <span class="badge bg-danger">1</span>
                    </span>
                </a>
            </li>
        </ul>
    </nav> --}}

    <div class="mt-3 mb-5" wire:poll>
        <div class="mb-3 container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <b>PESANAN MASUK</b>
                        </div>
                        <div class="">
                            {{-- <a href="{{ url('admin/kelola-produk-kategori') }}"
                                class="btn me-1 mb-1 rounded-pill btn-info text-white">
                                Kategori ('{{ $jmlkategori }}')
                            </a>

                            <a href="{{ url('admin/kelola-produk-merek') }}"
                                class="btn me-1 mb-1 rounded-pill btn-info text-white">
                                Merek ('{{ $jmlmerek }}')
                            </a> --}}

                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="mt-0">
            <div class="mt-2">
                <div class="col-lg-3 col-md-6">
                    <input class="form-control" type="text" wire:model='cari_no'
                        placeholder="Cari no transaksi/barcode">
                </div>
            </div>

        </div>


        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" style="font-size: 12px">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 3%">#</th>
                            <th style="width: 10%">No Transaksi</th>
                            <th scope="col" style="">Konsumen</th>
                            <th scope="col" style="width: 10%">Pengiriman</th>
                            <th scope="col" style="width: 10%">Pembayaran</th>
                            <th scope="col" style="">Total Pembayaran</th>
                            <th style="">Status</th>
                            <th style="width: 10%">Bayar</th>
                            <th style="">Dibuat</th>
                            <th style="width: 21%">aksi</th>
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
                                    {{ $data->total_pembayaran }}
                                </td>
                                <td
                                    style="color: @if ($data->status == 'selesai') green
                                @elseif ($data->status == 'batal')
                                red
                                @elseif ($data->status == 'retur')
                                red @endif">
                                    {{ $data->status }}
                                </td>
                                <td style="color: {{ $data->islunas == true ? 'green' : 'red' }}">
                                    {{ $data->islunas == true ? 'sudah bayar' : 'belum bayar' }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                </td>
                                <td>
                                    
                                    @if ($data->status == 'konfirm')
                                        <button
                                            onclick="confirm('yakin batalkan pesanan?') || event.stopImmediatePropagation()"
                                            wire:click="batal('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-danger"
                                            style="font-size: 12px">
                                            Batal
                                        </button>
                                    @elseif ($data->status == 'proses_pembayaran')
                                        <button
                                            onclick="confirm('Pastikan konsumen telah membayar, klik oke jika sudah bayar') || event.stopImmediatePropagation()"
                                            wire:click="terima_pembayaran('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-success"
                                            style="font-size: 12px">
                                            Terima pembayaran
                                        </button>
                                        <button
                                            onclick="confirm('yakin batal pesanan?') || event.stopImmediatePropagation()"
                                            wire:click="batal('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-danger"
                                            style="font-size: 12px">
                                            Batal
                                        </button>
                                    @elseif($data->status == 'sedang_dikemas')
                                        <button
                                            onclick="confirm('Ingin mengantar pesanan ini?') || event.stopImmediatePropagation()"
                                            wire:click="antar('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-info" style="font-size: 12px">
                                            Antar pesanan
                                        </button>
                                    @elseif($data->status == 'sedang_antar')
                                        <button
                                            onclick="confirm('yakin pesanan telah diterima konsumen?') || event.stopImmediatePropagation()"
                                            wire:click="diterima('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-primary"
                                            style="font-size: 12px">
                                            Diterima <span
                                                style="background-color: yellow; color:black">{{ $data->islunas == true ? '' : 'dan dibayar' }}</span>
                                            konsumen
                                        </button>
                                        <button
                                            onclick="confirm('yakin retur pesanan?') || event.stopImmediatePropagation()"
                                            wire:click="retur('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-danger"
                                            style="font-size: 12px">
                                            Retur
                                        </button>
                                    @elseif($data->status == 'diterima')
                                        <button
                                            onclick="confirm('Pastikan barang telah diterima konsumen dan telah dibayar konsumen!') || event.stopImmediatePropagation()"
                                            wire:click="selesai('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-success"
                                            style="font-size: 12px">
                                            Selesaikan pesanan
                                        </button>
                                        <button
                                            onclick="confirm('yakin retur pesanan?') || event.stopImmediatePropagation()"
                                            wire:click="retur('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-danger"
                                            style="font-size: 12px">
                                            Retur
                                        </button>
                                    @elseif($data->status == 'retur')
                                        <button
                                            onclick="confirm('yakin stok barang pesanan telah diterima kembali?') || event.stopImmediatePropagation()"
                                            wire:click="returditerima('{{ $data->id }}')" type="button"
                                            class="btn btn-sm text-white m-1 rounded btn-info"
                                            style="font-size: 12px">
                                            Selesai retur
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            tidak ada data
                        @endforelse
                    </tbody>
                </table>
                @if ($take < $jmlproduk)
                    <center>
                        <button wire:click='lanjut'
                            class="btn btn-light shadow-sm form-control rounded-pill">Lanjut</button>
                    </center>
                @endif
            </div>
        </div>
    </div>

    @push('script')
        <script>
            Livewire.on('success', data => {
                console.log(data.pesan);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: data.pesan,
                    showConfirmButton: false,
                    timer: 1500
                })
            })
            Livewire.on('error', data => {
                console.log(data.pesan);
                Swal.fire({
                    title: 'error!',
                    text: data.pesan,
                    icon: 'error',
                    confirmButtonText: 'oke'
                })
            })
        </script>
    @endpush
</div>
