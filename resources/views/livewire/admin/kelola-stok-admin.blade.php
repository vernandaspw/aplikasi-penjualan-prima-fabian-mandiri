<div>
    <div class="">
        <livewire:admin.component.navbar-admin />

        <div class="container-fluid mt-2 mb-5">
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


            <div class="d-lg-flex">
                @if ($tambahpage)
                    <div class="me-3 col-lg-3">
                        <div class="card shadow-sm rounded">
                            <div class="card-header bg-success text-white">
                                Tambah Stok Produk
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="tambahstokproduk('{{ $tambahstok->id }}')">
                                    <div class="">
                                        <label for=""><b>Produk ({{ $tambahstok->satuan_unit }})</b></label>
                                        <div class="">
                                            {{ $tambahstok->produk->nama }}
                                        </div>
                                    </div>
                                    <hr class="my-0 py-0">
                                    <div class="mt-1 d-flex justify-content-between align-items-center">
                                        <div class="">tambah stok po ({{ $tambahstok->po }}) + </div>
                                        <input wire:model='inputtambahpo' min="0" type="number" placeholder="0"
                                            class="form-control rounded-pill  form-control-sm w-25">
                                    </div>
                                    <div class="mt-1 d-flex justify-content-between align-items-center">
                                        <div class="">tambah stok real ({{ $tambahstok->real }}) + </div>
                                        <input wire:model='inputtambahreal' min="0" type="number"
                                            placeholder="0" class="form-control rounded-pill form-control-sm w-25">
                                    </div>
                                    <button type="submit"
                                        class="btn mt-1 btn-success rounded-pill form-control">Simpan</button>

                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($kurangpage)
                    <div class="me-3 col-lg-3">
                        <div class="card shadow-sm rounded">
                            <div class="card-header bg-warning">
                                Kurangi Stok Produk
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="kurangstokproduk('{{ $kurangstok->id }}')">
                                    <div class="">
                                        <label for=""><b>Produk ({{ $kurangstok->satuan_unit }})</b></label>
                                        <div class="">
                                            {{ $kurangstok->produk->nama }}
                                        </div>
                                    </div>
                                    <hr class="my-0 py-0">
                                    <div class="mt-1 d-flex justify-content-between align-items-center">
                                        <div class="">kurangi stok po ({{ $kurangstok->po }}) - </div>
                                        <input wire:model='inputkurangpo' min="0" type="number" placeholder="0"
                                            class="form-control rounded-pill  form-control-sm w-25">
                                    </div>
                                    <div class="mt-1 d-flex justify-content-between align-items-center">
                                        <div class="">kurangi stok real ({{ $kurangstok->real }}) - </div>
                                        <input wire:model='inputkurangreal' min="0" type="number"
                                            placeholder="0" class="form-control rounded-pill form-control-sm w-25">
                                    </div>
                                    <button type="submit"
                                        class="btn mt-1 btn-success rounded-pill form-control">Simpan</button>

                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="table-responsive w-100">
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

                                        <button wire:click="formtambah('{{ $data->id }}')" type="button"
                                            class="btn btn-primary btn-success btn-sm mb-1 mr-1 rounded-pill">
                                            Tambah
                                        </button>
                                        <button wire:click="formkurang('{{ $data->id }}')" type="button"
                                            class="btn btn-warning btn-sm mb-1 mr-1  rounded-pill ">
                                            Kurangi
                                        </button>
                                        {{-- <button wire:click="buatform" type="button"
                                            class="btn btn-secondary btn-sm mb-1 mr-1  rounded-pill ">
                                            riwayat
                                        </button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($take < $jmlprodukstok)
                        <center>
                            <button wire:click='lanjut'
                                class="btn btn-light shadow form-control rounded-pill">Lanjut</button>
                        </center>
                    @endif
                </div>
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
