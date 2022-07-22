<div>
    <livewire:admin.component.navbar-admin />
    <div class="container-fluid mt-3">
        <h4>LAPORAN TRANSAKSI</h4>
        <div class="">
            {{ now() }}
        </div>
        <hr>
    </div>
    <div class="container-fluid mt-1 mb-1">
        <div class="d-md-flex justify-content-md-between">
           <div class="">
            <div class="d-flex align-items-center mt-1">
                <label for="">Tampilkan</label>
                <select class="form-control ms-2 rounded-pill" wire:model='take' id="">
                    <option value="{{ $jml_item }}">- pilih -</option>
                    <option value="20">20 data</option>
                    <option value="100">100 data</option>
                    <option value="{{ $jml_item }}">Semua</option>
                </select>
            </div>
            <div class="d-flex align-items-center mt-1">
                <label for="">Jenis</label>
                <select class="form-control ms-2 rounded-pill" wire:model='selectJenis' id="">
                    <option value="">Semua</option>
                    @foreach ($jenis as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  
                </select>
            </div>
            <div class="d-flex align-items-center mt-1">
                <label for="">Kategori</label>
                <select class="form-control ms-2 rounded-pill" wire:model='selectKategori' id="">
                    <option value="">Semua</option>
                    @foreach ($kategori as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  
                </select>
            </div>
           </div>
            
            <div class="row g-3 d-flex align-items-center mt-1">
                <div class="col-auto">
                    <label for="start_date" class="">Awal</label>
                </div>
                <div class="col-auto">
                    <input wire:model='start_date' type="date" class="form-control rounded-pill" id="start_date">
                </div>
                <div class="col-auto">
                    <div class=""></div>
                    -
                </div>
                <div class="col-auto">
                    <label for="end_date" class="">Akhir</label>
                </div>
                <div class="col-auto">
                    <input wire:model='end_date' type="date" class="form-control rounded-pill" id="end_date">
                </div>
                <div class="col-auto">
                    <button wire:click='cetak_laporan' type="button"
                        class="btn shadow-sm rounded-pill border-0 btn-primary">Cetak Laporan</button>
                </div>
                <div class="col-auto">
                    <button wire:click='downloadExcel' type="button"
                        class="btn shadow-sm rounded-pill border-0 btn-success">Download Excel</button>
                </div>
            </div>
        </div>


    </div>
    <div class="container-fluid mt-4">
        <div class="table-responsive">
            <table class="table table-sm table-bordered" style="font-size: 12px">
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
                                {{ $data->metodekirim == null ? '' : $data->metodekirim->metode }}
                            </td>
                            <td>
                                {{ $data->metodepembayaran == null ? '' : $data->metodepembayaran->metode }}
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
                                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, H:m') }}
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

    @push('script')
        <script>
            Livewire.on('success', data => {
                console.log(data.pesan);
                Swal.fire({
                    title: 'success!',
                    text: data.pesan,
                    icon: 'success',
                    confirmButtonText: 'oke'
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
