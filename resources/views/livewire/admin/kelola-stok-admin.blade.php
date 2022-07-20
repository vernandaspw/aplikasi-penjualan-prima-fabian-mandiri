<div>
    <div class="">
        <livewire:admin.component.navbar-admin />

        <div class="container mt-2 mb-5">
            <div class="mb-3">
                <div class="card shadow-sm">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <b>KELOLA STOK PRODUK</b>
                            </div>

                            {{-- <button wire:click="buatform" class="btn btn-warning mb-1 rounded-pill ">
                                Tambah Produk baru
                            </button> --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <div class="col-lg-3 col-md-6">
                    <input class="form-control rounded-pill mb-2" type="text" wire:model='cariproduk'
                        placeholder="Cari nama produk/barcode">
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 3%">#</th>
                            <th style="">Produk</th>
                            <th style="width: 15%">Satuan unit</th>
                            <th style="width: 10%">PO</th>
                            <th style="width: 10%">Real</th>
                            <th style="width: 25%">Aksi</th>
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
                                <td>
                                    <button wire:click="buatform" class="btn btn-success btn-sm mb-1 mr-1 rounded-pill ">
                                        Tambah
                                    </button>
                                    <button wire:click="buatform" class="btn btn-warning btn-sm mb-1 mr-1  rounded-pill ">
                                        Kurang
                                    </button>
                                    <button wire:click="buatform" class="btn btn-secondary btn-sm mb-1 mr-1  rounded-pill ">
                                        riwayat
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($take < $jmlprodukstok)
                <center>
                    <button wire:click='lanjut'
                        class="btn btn-light shadow-sm form-control rounded-pill">Lanjut</button>
                </center>
                @endif
            </div>
        </div>
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
