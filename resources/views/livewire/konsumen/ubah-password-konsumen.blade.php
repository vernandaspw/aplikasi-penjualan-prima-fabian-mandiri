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
                    <span class="text-white"><b>Ubah Password</b></span>
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
                <label for="password" class="form-label">Password saat ini</label>
                <input placeholder="isi password lama" required wire:model='password' type="password"
                    class="form-control @error('nama') is-invalid @enderror" id="password"
                    aria-describedby="passwordHelp">
                @error('password')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="password_baru" class="form-label">Password baru</label>
                <input placeholder="isi password baru" required wire:model='password_baru' type="password"
                    class="form-control @error('password_baru') is-invalid @enderror" id="password_baru" aria-describedby="password_baruHelp">
                @error('password_baru')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="ulang_password_baru" class="form-label">Ulang password baru</label>
                <input placeholder="isi ulang password baru" required wire:model='ulang_password_baru' type="password"
                    class="form-control @error('kota') is-invalid @enderror" id="ulang_password_baru"
                    aria-describedby="ulang_password_baruHelp">
                @error('ulang_password_baru')
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
