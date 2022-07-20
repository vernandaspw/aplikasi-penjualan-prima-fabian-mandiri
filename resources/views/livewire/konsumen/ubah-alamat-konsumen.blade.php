<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('/akun') }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>Ubah Alamat</b></span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <livewire:konsumen.component.icon-cart-konsumen />
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" style="padding-top: 75px; padding-bottom: 50px">
        <form wire:submit.prevent='ubah'>
            <div class="mb-2">
                <label for="provinsi" class="form-label">Provinsi</label>
                <input placeholder="isi provinsi" required wire:model='provinsi' type="text"
                    class="form-control @error('nama') is-invalid @enderror" id="provinsi"
                    aria-describedby="provinsiHelp">
                @error('provinsi')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="kota" class="form-label">Kota/kabupaten</label>
                <input placeholder="isi kota" required wire:model='kota' type="text"
                    class="form-control @error('kota') is-invalid @enderror" id="kota" aria-describedby="kotaHelp">
                @error('kota')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input placeholder="isi kecamatan" required wire:model='kecamatan' type="text"
                    class="form-control @error('kota') is-invalid @enderror" id="kecamatan"
                    aria-describedby="kecamatanHelp">
                @error('kecamatan')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="alamat" class="form-label">Alamat</label>
                <input placeholder="isi alamat lengkap" required wire:model='alamat' type="text"
                    class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                    aria-describedby="alamatHelp">
                @error('alamat')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="patokan" class="form-label">Patokan</label>
                <input placeholder="cth:depan langan, rumah ijo" required wire:model='patokan' type="text"
                    class="form-control @error('patokan') is-invalid @enderror" id="patokan"
                    aria-describedby="patokanHelp">
                @error('patokan')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="kodepos" class="form-label">Kode Pos</label>
                <input placeholder="kode pos" required wire:model='kodepos' type="text"
                    class="form-control @error('kodepos') is-invalid @enderror" id="kodepos"
                    aria-describedby="kodeposHelp">
                @error('kodepos')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <div class="mb-2">
                <button class="text-center rounded-pill btn btn-warning form-control -mb-2" type="submit">
                    Ubah
                </button>
            </div>
        </form>
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
