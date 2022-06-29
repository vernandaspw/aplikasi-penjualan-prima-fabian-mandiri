<div>
    <div class=" d-flex justify-content-center mt-5">
        <div class="col-lg-8 col-md-10 col-sm-10">
            <div class="card shadow mb-5">
                <div class="card-body">
                    <div class="text-center">
                        <h4>Daftar</h4>
                    </div>
                    @if (session()->has('msg_success'))
                        <div class="alert alert-success">{{ session('msg_success') }}</div>
                    @endif
                    @if (session()->has('msg_error'))
                        <div class="alert alert-danger">{{ session('msg_error') }}</div>
                    @endif
                    <br>
                    <form wire:submit.prevent='daftar'>
                        <div class="mb-2">
                            <label for="nama" class="form-label">Nama</label>
                            <input placeholder="isi nama lengkap" required wire:model='nama' type="text"
                                class="form-control @error('nama') is-invalid @enderror" id="nama"
                                aria-describedby="namaHelp">
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
                                <input required placeholder="82144******" wire:model='nohp' type="tel"
                                    minlength="5" maxlength="15" class="form-control @error('nohp') is-invalid @enderror" id="nohp"
                                    aria-describedby="nohpHelp">
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
                            <label for="password" class="form-label">Password</label>
                            <input placeholder="isi password" required wire:model='password' type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password">
                                @error('password')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                        <div class="mb-2">
                            <label for="password2" class="form-label">Ulangi Password</label>
                            <input placeholder="isi ulang password" required wire:model="ulangi_password"
                                type="password" class="form-control @error('ulangi_password') is-invalid @enderror" id="password2">
                                @error('ulangi_password')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                        <div class="mb-2">
                            <label for="jk">Jenis kelamin</label>
                            <select wire:model='jeniskelamin' required class="form-control @error('jeniskelamin') is-invalid @enderror" id="jk">
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
                                class="form-control @error('wilayah') is-invalid @enderror" id="wilayah" aria-describedby="wilayahHelp">
                                @error('wilayah')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                        {{-- <div class="mt-3"><b>Data Alamat</b></div>
                        <div class="mb-2">
                            <label for="provinsi" class="form-label">provinsi</label>
                            <input placeholder="isi provinsi" required wire:model='provinsi' type="text"
                                class="form-control" id="provinsi" aria-describedby="provinsiHelp">
                        </div>
                        <div class="mb-2">
                            <label for="kota" class="form-label">Kota/kabupaten</label>
                            <input placeholder="isi kota" required wire:model='kota' type="text"
                                class="form-control" id="kota" aria-describedby="kotaHelp">
                        </div>
                        <div class="mb-2">
                            <label for="kecamatan" class="form-label">kecamatan</label>
                            <input placeholder="isi kecamatan" required wire:model='kecamatan' type="text"
                                class="form-control" id="kecamatan" aria-describedby="kecamatanHelp">
                        </div>
                        <div class="mb-2">
                            <label for="alamat" class="form-label">alamat lengkap</label>
                            <input placeholder="isi alamat lengkap" required wire:model='alamat' type="text"
                                class="form-control" id="alamat" aria-describedby="alamatHelp">
                        </div>
                        <div class="mb-2">
                            <label for="patokan" class="form-label">patokan</label>
                            <input placeholder="cth:depan langan, rumah ijo" required wire:model='patokan' type="text"
                                class="form-control" id="patokan" aria-describedby="patokanHelp">
                        </div>
                        <div class="mb-2">
                            <label for="kodepos" class="form-label">Kode Pos</label>
                            <input placeholder="kode pos" required wire:model='kodepos' type="text"
                                class="form-control" id="kodepos" aria-describedby="kodeposHelp">
                        </div> --}}


                        {{-- <div class="mb-2 mt-1 form-check">
                            <input checked type="checkbox" wire:model='ingat' class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div> --}}
                        <button type="submit" class="btn mt-3 rounded-pill text-white form-control shadow-sm"
                            style="background-color: {{ env('COLOR_PRIMARY') }};">Daftar</button>
                    </form>
                    <a href="{{ url('login', []) }}"
                        class="btn rounded-pill btn-transparent form-control shadow-sm mt-2">Login</a>
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


<style>
    body {
        background-color: {{ env('COLOR_PRIMARY') }};
    }
</style>
