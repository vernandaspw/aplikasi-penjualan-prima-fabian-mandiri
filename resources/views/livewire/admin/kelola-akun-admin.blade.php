<div>
    <livewire:admin.component.navbar-admin />

    <div class="container mt-4 mb-5">
        <div class="mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <b>KELOLA AKUN</b>
                        </div>
                        <div class="">
                           @if($pageedit == false)
                           <button wire:click="$toggle('pagebuat')" class="btn btn-primary">
                            Buat akun
                        </button>
                           @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($pagebuat)
            <div class="mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <b>Buat akun</b>
                        <form wire:submit.prevent='buatakun'>
                            <div class="mt-2">
                                <label for="nama">Nama</label>
                                <input id="nama" type="text" wire:model.lazy='nama'
                                    class="form-control @error('nama') is-invalid @enderror">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mt-2">
                                <label for="nohp">Nomor HP</label>
                                <input id="nohp" type="telp" wire:model.lazy='nohp'
                                    class="form-control @error('nohp') is-invalid @enderror">
                                @error('nohp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="email">Email</label>
                                <input id="email" type="email" wire:model.lazy='email'
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="password">Password </label>
                                <input id="password" type="password" wire:model.lazy='password'
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="ulangipassword">Ulangi password</label>
                                <input id="ulangipassword" type="password" wire:model.lazy='ulangipassword'
                                    class="form-control @error('ulangipassword') is-invalid @enderror">
                                @error('ulangipassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="role">Role akses</label>
                                <select wire:model.lazy='role' id="role" class="form-control">
                                    <option value="">Pilih akses sebagai</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="admin">Admin</option>
                                    <option value="logistik">Logistik</option>
                                    <option value="pimpinan">Pimpinan</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success form-control">
                                    Tambah akun
                                </button>

                            </div>
                        </form>
                        <button wire:click="$toggle('pagebuat')" class="btn mt-2 btn-light form-control">
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
                    <b>Edit akun</b>
                    <form wire:submit.prevent="editakun('{{ $byid }}')">
                        <div class="mt-2" wire:ignore>
                            <label for="nama">Nama</label>
                            <input id="nama" type="text" wire:model='nama'
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mt-2" wire:ignore>
                            <label for="nohp">Nomor HP</label>
                            <input id="nohp" type="telp" wire:model='nohp'
                                class="form-control @error('nohp') is-invalid @enderror">
                            @error('nohp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2" wire:ignore>
                            <label for="email">Email</label>
                            <input id="email" type="email" wire:model='email'
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2" wire:ignore>
                            <label for="password">Password</label>
                            <input id="password" type="password" wire:model='password'
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label for="role">Role akses</label>
                            <select wire:model='role' id="role" class="form-control">
                                <option value="">Pilih akses sebagai</option>
                                <option value="administrator" @if($role == 'administrator')
                                selected
                                @endif>Administrator</option>
                                <option value="admin">Admin</option>
                                <option value="logistik">Logistik</option>
                                <option value="pimpinan">Pimpinan</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success form-control">
                                Ubah akun
                            </button>

                        </div>
                    </form>
                    <button wire:click='tutup' class="btn mt-2 btn-light form-control">
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
                            <th scope="col" style="width: 2%">#</th>
                            <th scope="col" style="width: 25%">Nama</th>
                            <th scope="col" style="width: 15%">No HP</th>
                            <th scope="col" style="width: 23%">Email</th>
                            <th scope="col" style="width: 10%">Role</th>
                            <th scope="col" style="width: 10%">Status</th>
                            <th style="width: 10%">aksi</th>
                        </tr>
                    </thead>
                    <tbody class='table-group-divider'>
                        @forelse ($akun as $data)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>{{ $data->nama }}</td>
                                <td>0{{ $data->nohp }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->role }}</td>
                                <td>

                                    <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        wire:click="ubahstatus({{ $data->id }})" type="button"
                                        class="btn btn-sm text-white rounded-pill px-4 {{ $data->isaktif == true ? 'btn-success' : 'btn-danger' }}">
                                        {{ $data->isaktif == true ? 'aktif' : 'tidak aktif' }}
                                    </button>
                                </td>
                                <td>
                                    <button wire:click="edit('{{ $data->id }}')"
                                        class="btn btn-sm rounded-pill text-white btn-warning">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @empty
                            tidak ada data
                        @endforelse
                    </tbody>
                </table>
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
