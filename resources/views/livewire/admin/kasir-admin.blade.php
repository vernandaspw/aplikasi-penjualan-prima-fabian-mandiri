<div>
    <livewire:admin.component.navbar-admin />

    <div class="container">
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <b>Menu Kasir</b>
            @if ($formedit == false)
                <button wire:click="$toggle('buatkasir')" type="button" class="px-3 shadow-sm btn text-white rounded-pill"
                    style="background-color: {{ env('COLOR_PRIMARY') }}">
                    @if ($buatkasir)
                        Tutup form buat kasir
                    @else
                        Buat kasir baru
                    @endif
                </button>
            @endif
        </div>

        @if ($formedit)
            <div class="mt-2">
                <div class="card mb-2 shadow-sm rounded">
                    <div class="card-body">
                        <div class="mb-1">
                            <b>Edit kasir : {{ $nama }}</b>
                        </div>
                        <form wire:submit.prevent="editkasir('{{ $byid }}')">
                            <div class="">
                                <label for="nama" class="">Nama</label>
                                <input placeholder="exam: kasir 1" required wire:model='nama' type="text"
                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    aria-describedby="namaHelp">
                                @error('nama')
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
                        <button wire:click='tutup' type="button" class="form-control mt-1 btn btn-secondary text-white rounded-pill"
                        >Tutup</button>
                    </div>
                </div>
            </div>
        @else
            @if ($buatkasir)
                <div class="mt-2">
                    <div class="card mb-2 shadow-sm rounded">
                        <div class="card-body">
                            <div class="mb-1">
                                <b>Buat kasir baru</b>
                            </div>
                            <form wire:submit.prevent='kasirbaru'>
                                <div class="">
                                    <label for="namabaru" class="">Nama</label>
                                    <input placeholder="exam: kasir 1" required wire:model='namabaru' type="text"
                                        class="form-control @error('namabaru') is-invalid @enderror" id="namabaru"
                                        aria-describedby="namabaruHelp">
                                    @error('namabaru')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="modalbaru" class="">Modal awal</label>
                                    <input placeholder="(optional)" wire:model='modalbaru' type="number"
                                        class="form-control @error('modalbaru') is-invalid @enderror" id="modalbaru"
                                        aria-describedby="modalbaruHelp">
                                    @error('modalbaru')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="form-control btn text-white rounded-pill"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}">Buat kasir
                                        baru</button>
                                </div>
                            </form>
                            <button wire:click="$toggle('buatkasir')" type="button" class="mt-1 form-control btn-secondary shadow-sm btn text-white rounded-pill"
                           >
                            @if ($buatkasir)
                                Tutup
                            @else
                                Buat kasir baru
                            @endif
                        </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mt-2">
                @forelse ($kasir as $data)
                    <div class="card mb-2 shadow-sm rounded">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <b>{{ $data->nama }}</b>
                                    ({{ $data->isaktif == true ? 'aktif' : 'tidak aktif' }})
                                </div>
                                <div class="">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-trasparent"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('menu-kebab.png') }}" alt="">
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><button wire:click="formedit('{{ $data->id }}')"
                                                    class="dropdown-item" type="button">Edit</button></li>
                                            <li><button wire:click="ubahstatus('{{ $data->id }}')"
                                                    class="dropdown-item text-danger"
                                                    type="button">{{ $data->isaktif == true ? 'non aktif kan' : 'aktifkan' }}</button>
                                            </li>
                                            <li><button
                                                    onclick="confirm('Yakin ingin hapus?') || event.stopImmediatePropagation()"
                                                    wire:click="hapus('{{ $data->id }}')"
                                                    class="dropdown-item text-danger" type="button">Hapus</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    Kas
                                </div>
                                <div class="">
                                    @uang($data->modal)
                                </div>
                            </div>
                            @if ($data->isaktif)
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="w-100 me-1">
                                        <a href="{{ url('admin/kasir/penjualan-produk', $data->id) }}"
                                            class="btn btn-sm form-control text-white rounded-pill"
                                            style="background-color: {{ env('COLOR_PRIMARY') }}">Penjualan</a>
                                    </div>
                                    <div class="w-100 ms-1">
                                        <a href="{{ url('admin/kasir/detail', $data->id) }}"
                                            class="btn btn-sm form-control text-white rounded-pill"
                                            style="background-color: {{ env('COLOR_PRIMARY') }}">Detail kasir</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        @endif



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
