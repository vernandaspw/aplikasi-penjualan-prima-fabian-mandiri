<div>
    <div>
        <livewire:admin.component.navbar-admin />

        <div class="container mt-3 mb-5">
            <div class="mb-3">
                <div class="card shadow-sm">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <b>KELOLA PRODUK MEREK</b>
                            </div>

                            <div class="">

                                @if ($pagebuat)
                                @else
                                    <button wire:click="formBuat" class="btn btn-primary mb-1 rounded-pill ">
                                        Tambah merek baru
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="col-lg-3 col-md-6">
                        <input class="form-control" type="text" wire:model='cari' placeholder="Cari nama">
                    </div>
                </div>
            </div>

            @if ($pagebuat)
                <div class="mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <b>Tambah Merek Baru</b>
                            <form wire:submit.prevent='buatKategori'>

                                <div class="mt-2">
                                    <label for="nama">Nama kategori</label>
                                    <input placeholder="Nama kategori" id="nama" type="text"
                                        wire:model.lazy='nama'
                                        class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success text-light rounded-pill form-control">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                            <button wire:click="tutup" class="btn rounded-pill shadow-sm mt-2 btn-light form-control">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if ($pageedit)
                <div class="mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <b>Edit Merek</b>
                            <form wire:submit.prevent='editKategori'>
                                <div class="mt-2">
                                    <label for="nama">Nama kategori</label>
                                    <input placeholder="Nama kategori" id="nama" type="text"
                                        wire:model.lazy='nama'
                                        class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success text-light rounded-pill form-control">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                            <button wire:click="tutup" class="btn rounded-pill shadow-sm mt-2 btn-light form-control">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 3%">#</th>
                                <th scope="col" style="">Nama kategori</th>
                                <th style="width: 20%">aksi</th>
                            </tr>
                        </thead>
                        <tbody class='table-group-divider'>
                            @forelse ($produkmerek as $data)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>

                                    <td>{{ $data->nama }}</td>


                                    <td>
                                        <button wire:click="formEdit('{{ $data->id }}')"
                                            class="btn btn-sm rounded-pill text-white btn-warning">
                                            Edit
                                        </button>
                                        <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                            wire:click="hapus('{{ $data->id }}')"
                                            class="btn btn-sm rounded-pill text-white btn-danger">
                                            Hapus
                                        </button>
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
