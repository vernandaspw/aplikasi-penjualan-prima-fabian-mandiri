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
    <div class="body" style="padding-top: 65px; padding-bottom: 95px;">
        <div class="card border-top-0 shadow-sm border-0">
            <div class="card-body">
                @if ($alamat->provinsi && $alamat->kota && $alamat->kecamatan && $alamat->alamat && $alamat->patokan && $alamat->kodepos)
                    <h5>
                        <b>Alamat pengiriman</b>
                    </h5>
                    <div class="">
                        {{ $alamat->nama }} | 0{{ $alamat->nohp }}
                    </div>
                    <div class="">
                        {{ $alamat->alamat }}
                    </div>
                    <div class="">
                        {{ $alamat->patokan }}
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
                        <img src="{{ asset('parabola.jpg') }}" width="75px" height="75px" class="rounded"
                            alt="...">
                        <div class="ms-3">
                            <h6 class="card-title">Antena Parabola</h6>
                            <p class="card-text text-muted mb-0">
                                @uang(10000) x 2 unit (1kg)
                            </p>
                            <p class="card-text text-muted mb-0">
                                Total @uang(20000)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            tidak ada produk
            @endforelse

            <input type="text" placeholder="Catatan.."
                class="py-2 mt-3 rounded shadow-sm border border-light form-control">
            <br>

            <div class="">
                <label for="metodepengiriman">Metode pengiriman</label>
                <select wire:model='metode_pengiriman_id' id="metodepengiriman" class="form-control text-muted">
                    <option selected value="">Pilih pengiriman</option>
                    @forelse ($pengiriman as $data)
                        <option value="{{ $data->id }}">{{ $data->metode }}</option>

                    @empty
                    @endforelse
                </select>
            </div>
            @if($metode_pengiriman_id)
            <div class="mt-2">
                <label for="metodepembayaran">Metode pembayaran</label>
                <select id="metodepembayaran" class="form-control text-muted">
                    <option selected value="">Pilih pembayaran</option>
                    @forelse ($pembayaran as $data)
                        <option value="">{{ $data->metode }} - {{ $data->nama }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            @endif

        </div>
        <br>
        <div class="card border-left-0 border-right-0 rounded-0">
            <div class="card-body">
                <h5><b>Ringkasan belanja</b></h5>
                <div class="d-flex justify-content-between">
                    <div class="">Total belanja</div>

                    <div class="">@uang(20000)</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">Kode unik</div>
                    <div class="">@uang(2000)</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">Biaya pengiriman</div>
                    <div class="">@uang(20000)</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class=""><b>Total pembayaran</b></div>
                    <div class=""><b>@uang(20000)</b></div>
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
                        <b>@uang(10000)</b>
                    </div>
                </div>

                <div class="ms-auto">
                    @if ($alamat->provinsi && $alamat->kota && $alamat->kecamatan && $alamat->alamat && $alamat->patokan && $alamat->kodepos)
                        <a href="{{ url('checkout') }}" class="nav-link btn px-4 m-1 text-center btn-light"
                            style="color: {{ env('COLOR_PRIMARY') }}">
                            <span class="small d-block" style="font-size: 15px">
                                <b>Buat pesanan</b>
                            </span>
                        </a>
                    @else
                        <a href="{{  url('ubah-alamat') }}" class="nav-link btn px-3 m-1 text-center btn-light"
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
