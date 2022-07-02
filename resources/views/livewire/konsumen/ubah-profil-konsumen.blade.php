<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('/') }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>Ubah Profil</b></span>
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
            <label for="nama" class="form-label">Nama</label>
            <input placeholder="isi nama lengkap" required wire:model='nama' type="text"
                class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="namaHelp">
            @error('nama')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="nohp" class="form-label">Nomor hp</label>
            <div class="input-group">
                <span class="input-group-text" id="nohp">+62</span>
                <input required placeholder="82144******" wire:model='nohp' type="tel" minlength="5" maxlength="15"
                    class="form-control @error('nohp') is-invalid @enderror" id="nohp" aria-describedby="nohpHelp">
                @error('nohp')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-2">
            <label for="email" class="form-label">Email address</label>
            <input placeholder="example@example.com" required wire:model='email' type="email"
                class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp">
            @error('email')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="jk">Jenis kelamin</label>
            <select wire:model='jeniskelamin' required class="form-control @error('jeniskelamin') is-invalid @enderror"
                id="jk">
                <option value="">Pilih jenis kelamin</option>
                <option value="laki laki">Laki laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
            @error('jeniskelamin')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-2">
            <label for="wilayah" class="form-label">Wilayah</label>
            <input placeholder="isi wilayah" required wire:model='wilayah' type="text"
                class="form-control @error('wilayah') is-invalid @enderror" id="wilayah"
                aria-describedby="wilayahHelp">
            @error('wilayah')
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
