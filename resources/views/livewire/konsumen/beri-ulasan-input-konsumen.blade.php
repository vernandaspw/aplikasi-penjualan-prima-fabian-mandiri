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
                    <span class="text-white"><b>Beri ulasan input</b></span>
                </li>
            </ul>
            {{-- <ul class="navbar-nav ms-auto  w-full align-items-start">
            <li class="nav-item">
                <livewire:konsumen.component.icon-cart-konsumen />
            </li>
        </ul> --}}
        </div>
    </nav>
    <div class="body" style="padding-top: 60px; padding-bottom: 65px;">
        <div class="container-fluid container-lg">
            <div class="mb-3 mt-2">
                <div class="card mt-1  border-0">
                    <div class="card-body py-2">
                        <a href="{{ url('beri-ulasan-input', $data->id) }}" class="text-decoration-none text-dark">
                            <div class="mt-2 d-flex justify-content-start align-items-start">
                                <div class="kiri">
                                    @if($data->produk)
                                    <img src="{{ $data->produk->gambar[0]->img == null ? asset('imagenotfound.jpg') : Storage::url($data->produk->gambar[0]->img) }}"
                                    width="65px" height="65px" class="rounded" alt="...">
                                    @else
                                    <img src="{{ asset('imagenotfound.jpg')}}"
                                        width="65px" height="65px" class="rounded" alt="...">
                                    @endif
                                    
                                </div>
                                <div class="kanan ms-2">
                                    <b>
                                        <span style="font-size: 14px">{{ $data->produk == null ? $data->nama_produk : $data->produk->nama }}</span></b>
                                    <div class="" style="font-size: 13px">
                                        @uang($data->produk == null ? $data->harga_jual : $data->produk->harga_jual) x {{ $data->qty }} qty
                                    </div>
                                    <div class="" style="font-size: 13px">
                                        @uang($data->produk == null ? $data->harga_jual : $data->produk->harga_jual * $data->qty)
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <div class="kir">
                                <div class="text-muted">
                                    Total harga
                                </div>
                                <div class="">
                                    <b>@uang($data->total_harga)</b>
                                </div>
                            </div>
                            <div class="kanan">
                            </div>
                        </div>

                    </div>
                </div>
                {{-- <hr class="mb-0 mt-1"> --}}
                <div class="mt-1">
                    {{-- <b>Perlu diberi ulasan</b> --}}
                </div>
                <form wire:submit.prevent='buat'>
                    <div class="mb-2">
                        <label for="rating">Pilih rating</label>
                        <select wire:model='rating' required class="form-control @error('rating') is-invalid @enderror"
                            id="rating">
                            <option value="">Pilih rating</option>
                            <option value="5">5 bintang</option>
                            <option value="4">4 bintang</option>
                            <option value="3">3 bintang</option>
                            <option value="2">2 bintang</option>
                            <option value="1">1 bintang</option>
                        </select>
                        @error('rating')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="ulasan" class="form-label">Ulasan</label>
                        <textarea placeholder="isi ulasan" class="form-control @error('ulasan') is-invalid @enderror" wire:model='ulasan'
                            id="ulasan" cols="30" rows="4"></textarea>
                        @error('ulasan')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <button type="submit" class="form-control btn btn-warning rounded-pill">Simpan</button>
                    </div>
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
</div>
