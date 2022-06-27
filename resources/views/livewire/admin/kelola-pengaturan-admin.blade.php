<div>
    <livewire:admin.component.navbar-admin />

    <div class="container mt-3 mb-5">
        <h4>
            <b>Ubah Pengaturan</b>
        </h4>
        <hr>
        <div class="mt-2">
            <form wire:submit.prevent="simpan('{{ $pengaturan->id }}')">
                <div class="mt-2">
                    <h6><b>Data Perusahaan</b></h6>
                </div>
                <div class="" wire:ignore>
                    <label for="nm_perusahaan">Nama Perusahaan</label>
                    <input id="nm_perusahaan" type="text" wire:model='nm_perusahaan'
                        class="form-control @error('nm_perusahaan') is-invalid @enderror">
                    @error('nm_perusahaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2" wire:ignore>
                    <label for="sejarah">Sejarah Perusahaan</label>
                    <textarea rows="5" id="sejarah" wire:model='sejarah' class="form-control @error('sejarah') is-invalid @enderror"></textarea>
                    @error('sejarah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2" wire:ignore>
                    <label for="visi">Visi Perusahaan</label>
                    <textarea rows="5" id="visi" wire:model='visi' class="form-control @error('visi') is-invalid @enderror"></textarea>
                    @error('visi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2" wire:ignore>
                    <label for="misi">Misi Perusahaan</label>
                    <textarea rows="5" id="misi" wire:model='misi' class="form-control @error('misi') is-invalid @enderror"></textarea>
                    @error('misi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <hr>
                <div class="mt-2">
                    <h6><b>Data Alamat Perusahaan</b></h6>
                </div>
                <div class="mt-2">
                    <label for="provinsi">Provinsi</label>
                    <input id="provinsi" type="text" wire:model='provinsi'
                        class="form-control @error('provinsi') is-invalid @enderror">
                    @error('provinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="kota">Kota</label>
                    <input id="kota" type="text" wire:model='kota'
                        class="form-control @error('kota') is-invalid @enderror">
                    @error('kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="kecamatan">Kecamatan</label>
                    <input id="kecamatan" type="text" wire:model='kecamatan'
                        class="form-control @error('kecamatan') is-invalid @enderror">
                    @error('kecamatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" rows="3" wire:model='alamat' class="form-control @error('alamat') is-invalid @enderror"></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="kodepos">Kode Pos</label>
                    <input maxlength="7" id="kodepos" type="text" wire:model='kodepos'
                        class="form-control @error('kodepos') is-invalid @enderror">
                    @error('kodepos')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <hr>
                <div class="mt-2">
                    <h6><b>Data kontak</b></h6>
                </div>
                <div class="">
                    <label for="no_telp">Nomor telpon</label>
                    <input id="no_telp" type="telp" wire:model='no_telp'
                        class="form-control @error('no_telp') is-invalid @enderror">
                    @error('no_telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="">
                    <label for="no_wa">Nomor WhatsApp</label>
                    <input id="no_wa" type="telp" wire:model='no_wa'
                        class="form-control @error('no_wa') is-invalid @enderror">
                    @error('no_wa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="">
                    <label for="ig">Instagram</label>
                    <input id="ig" type="telp" wire:model='ig'
                        class="form-control @error('ig') is-invalid @enderror">
                    @error('ig')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button id="my-submit" type="submit"
                    class="btn mt-4 rounded-pill btn-success text-white form-control">Perbarui</button>
            </form>


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
