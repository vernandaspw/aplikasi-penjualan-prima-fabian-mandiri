<div>
    <livewire:admin.component.navbar-admin />
    <div class="container-fluid mt-3">
        <h4>LAPORAN PRODUK STOK</h4>
        <div class="">
            {{ now() }}
        </div>
        <hr>
    </div>
    <div class="container-fluid mt-1 mb-1">
        <div class="d-md-flex justify-content-md-between">
            <div class="d-flex align-items-center mt-1">
                <label for="">Tampilkan</label>
                <select class="form-control ms-2 rounded-pill" wire:model='take' id="">
                    <option value="{{ $jml_item }}">- pilih -</option>
                    <option value="20">20 data</option>
                    <option value="100">100 data</option>
                    <option value="{{ $jml_item }}">Semua</option>
                </select>
            </div>
            <div class="row g-3 d-flex align-items-center mt-1">

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
                        <th style="">Produk</th>
                        <th style="width: 15%">Satuan unit</th>
                        <th style="width: 10%">PO</th>
                        <th style="width: 10%">Real</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    @foreach ($produkstok as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->produk->nama }}</td>
                        <td>{{ $data->satuan_unit }}</td>
                        <td>{{ $data->po }}</td>
                        <td>{{ $data->real }}</td>
                    </tr>
                @endforeach
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
