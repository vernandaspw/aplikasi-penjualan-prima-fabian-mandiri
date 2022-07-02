<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('/keranjang') }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>Chekcout</b></span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <livewire:konsumen.component.icon-cart-konsumen />
                </li>
            </ul>
        </div>
    </nav>
    <form wire:submit.prevent='buatpesanan'>
        <div class="body" style="padding-top: 60px; padding-bottom: 95px;">
            <div class="card border-top-0 shadow-sm border-0">
                <div class="card-body">
                    @if ($alamat->provinsi && $alamat->kota && $alamat->kecamatan && $alamat->alamat && $alamat->patokan && $alamat->kodepos)
                        <div class="d-flex justify-content-between">
                            <h5>
                                <b>Alamat pengiriman</b>
                            </h5>
                            <div class="">
                                <a href="{{ url('ubah-alamat') }}" class="text-decoration-none"
                                    style="color: {{ env('COLOR_PRIMARY') }}">
                                    Ubah
                                </a>
                            </div>
                        </div>
                        <div class="">
                            {{ $alamat->nama }} | 0{{ $alamat->nohp }}
                        </div>
                        <div class="">
                            {{ $alamat->alamat }}
                        </div>
                        <div class="">
                            {{ $alamat->kecamatan }}, {{ $alamat->kota }},{{ $alamat->provinsi }}
                        </div>
                        <div class="">
                            {{ $alamat->kodepos }}
                        </div>
                    @else
                        Alamat tidak lengkap, silakan
                        <a href="{{ url('ubah-alamat') }}" class="text-decoration-none"
                            style="color: {{ env('COLOR_PRIMARY') }}">
                            lengkapi alamat
                        </a>
                    @endif

                </div>
            </div>
            <br>
            <div class="container-fluid">
                @forelse ($itemcart as $data)
                    <div class="card mb-1 shadow-sm border border-light">
                        <div class="card-body ">
                            <div class="d-flex justify-content-start ">
                                @forelse ($data->produk->gambar as $gambar)
                                    @if ($gambar->no == 1)
                                        <img src="{{ $gambar->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar->img)) }}"
                                            width="60px" height="60px" class="rounded" alt="...">
                                    @endif
                                @empty
                                    @if ($gambar->no == 1)
                                        <img src="{{ asset('imagenotfound.jpg') }}" width="60px" height="60px"
                                            class="rounded" alt="...">
                                    @endif
                                @endforelse

                                <div class="ms-3">
                                    <h6 class="card-title">{{ $data->produk->nama }}</h6>
                                    <div style="font-size: 13px" class="card-text text-muted my-0">
                                        @uang($data->produk->harga_jual) x {{ $data->qty }}
                                        {{ $data->produk->produkstok->satuan_unit }} (@rating($data->produk->berat_kg) kg)
                                    </div>
                                    <div style="font-size: 12px" class="card-text text-muted my-0">
                                        Total @uang($data->produk->harga_jual * $data->qty)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    tidak ada produk
                @endforelse

                <input wire:model='catatan' type="text" placeholder="Catatan.."
                    class="py-2 mt-3 @error('catatan') is-invalid @enderror rounded shadow-sm border border-light form-control">
                @error('catatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <br>

                <div class="">
                    <label for="metodekirim">Metode pengiriman</label>
                    <select required wire:model='metode_kirim_id' id="metodekirim"
                        class="form-control text-muted @error('metode_kirim_id') is-invalid @enderror">
                        <option selected value="">Pilih pengiriman</option>
                        @forelse ($pengiriman as $data)
                            <option value="{{ $data->id }}">{{ $data->metode }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('metode_kirim_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="metodepembayaran">Metode pembayaran</label>
                    <select wire:model='metode_pembayaran_id' required id="metodepembayaran"
                        class="form-control text-muted @error('metode_pembayaran_id') is-invalid @enderror">
                        <option selected value="">Pilih pembayaran</option>
                        @forelse ($pembayaran as $data)
                            <option value="{{ $data->id }}">{{ $data->metode }} - {{ $data->nama }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('metode_pembayaran_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>
            <br>
            <div class="card border-left-0 border-right-0 rounded-0">
                <div class="card-body">
                    <h5><b>Ringkasan belanja</b></h5>
                    <div class="d-flex justify-content-between">
                        <div class="">Total belanja</div>
                        <div class="">@uang($itemcart->sum('total_harga'))</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="">Kode unik</div>
                        <div class="">@uang($kode_unik)</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="">Biaya pengiriman</div>
                        <div class="">@uang($biaya_kirim)</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class=""><b>Total pembayaran</b></div>
                        <div class=""><b>@uang($itemcart->sum('total_harga') + $kode_unik + $biaya_kirim)</b></div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg"
            style="background-color: {{ env('COLOR_PRIMARY') }}">
            <div class="container-fluid">
                <ul class="py-2 navbar-nav justify-content-between w-100 align-items-center">
                    <div class="me-auto text-white">
                        <div class="">
                            Total Pembayaran
                        </div>
                        <div class="" style="font-size: 18px">
                            <b>@uang($itemcart->sum('total_harga') + $kode_unik + $biaya_kirim)</b>
                        </div>
                    </div>

                    <div class="ms-auto">
                        @if ($alamat->provinsi && $alamat->kota && $alamat->kecamatan && $alamat->alamat && $alamat->patokan && $alamat->kodepos)
                            <button type="submit" class="nav-link btn px-4 m-1 text-center btn-light"
                                style="color: {{ env('COLOR_PRIMARY') }}">
                                <span class="small d-block" style="font-size: 15px">
                                    <b>Buat pesanan</b>
                                </span>
                            </button>
                        @else
                            <a href="{{ url('ubah-alamat') }}" class="nav-link btn px-3 m-1 text-center btn-light"
                                style="color: {{ env('COLOR_PRIMARY') }}">
                                <span class="small d-block" style="font-size: 15px">
                                    <b>Lengkapi alamat</b>
                                </span>
                            </a>
                        @endif

                    </div>
                </ul>
            </div>
        </nav>
    </form>


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
