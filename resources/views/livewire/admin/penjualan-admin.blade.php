<div>
    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="py-2 navbar-nav justify-content-between w-100 align-items-center">
                <div class="me-auto text-white">
                    <div class="">
                        {{ $jml_belanja }} Produk
                    </div>
                    <div class="" style="font-size: 18px">
                        <b>@uang($totalbelanja)</b>
                    </div>

                </div>

                <div class="ms-auto">
                    <button class="nav-link btn px-5 m-1 text-center btn-light" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom"
                        style="color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                            <b>Lanjut</b>
                        </span></button>

                </div>
            </ul>
        </div>
    </nav>
    @if ($show)
        <div class="offcanvas-backdrop show"></div>
    @else
    @endif
    <div class=" offcanvas  @if ($show) show
    @else
    hide @endif offcanvas-bottom"
        style="background-color: {{ env('COLOR_PRIMARY') }}" tabindex="-1" id="offcanvasBottom"
        aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header pb-2 pt-3">

            <div class="offcanvas-title d-flex justify-content-between w-100 align-items-center"
                id="offcanvasBottomLabel">
                <span class="text-white">
                    <div class="" style="font-size: 16px">
                        {{ $jml_belanja }} Produk | <b>@uang($totalbelanja)</b>
                    </div>
                </span>

            </div>


            <button wire:click="showOff" type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mb-5 pb-5">
            <div class="">
                @forelse ($keranjangitem as $data)
                    <div class="card mb-1 shadow-sm border border-light">
                        <div class="card-body py-1 px-2">
                            <div class="d-flex">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex text-start align-items-center">


                                            @if ($data->produk)
                                                @forelse ($data->produk->gambar as $gambar)
                                                    @if ($gambar->no == 1)
                                                        <img src="{{ $gambar->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar->img)) }}"
                                                            width="35px" height="35px" class="rounded"
                                                            alt="...">
                                                    @endif
                                                @empty
                                                    @if ($gambar->no == 1)
                                                        <img src="{{ asset('imagenotfound.jpg') }}" width="35px"
                                                            height="35px" class="rounded" alt="...">
                                                    @endif
                                                @endforelse
                                            @else
                                                <img src="{{ asset('imagenotfound.jpg') }}" width="35px"
                                                    height="35px" class="rounded" alt="...">
                                            @endif


                                            <div class="ms-2">
                                                <b class=""
                                                    style="font-size: 14px">{{ $data->produk != null ? $data->produk->nama : $data->nama_produk }}</b>
                                                <p class="card-text text-muted mb-0" style="font-size: 13px">
                                                    @uang($data->produk != null ? $data->produk->harga_jual : $data->harga_jual)
                                                    @if ($data->produk)
                                                        @if ($data->produk->produkstok->isstok)
                                                            | Stok {{ $data->produk->produkstok->po }}
                                                            {{ $data->produk->produkstok->satuan_unit }}
                                                        @endif
                                                    @else
                                                        (manual input)
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="me-1">
                                            <button wire:click="hapuscartitem('{{ $data->id }}')"
                                                class="btn border-0 btn-white">
                                                <img src="{{ asset('trash.png') }}" alt="">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between pt-1 align-items-center">
                                        <div class="d-flex justify-content-between w-100 align-items-center">
                                            <span style="font-size: 12px" class=" text-center border-0 px-1">
                                                {{ $data->qty }} qty | <b>@uang($data->total_harga)</b>
                                            </span>
                                            <div class="me-2">
                                                @if ($data->produk)
                                                    <button @if ($data->qty >= $data->produk->produkstok->po) disabled @endif
                                                        wire:click="tambahitem('{{ $data->id }}')"
                                                        class="px-3 py-1 btn btn-sm btn-light text-white"
                                                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                        +
                                                    </button>
                                                    <span
                                                        class=" text-center border-0 px-sm-5 px-lg-5 px-xl-5 px-md-5 px-4">
                                                        {{ $data->qty }}
                                                    </span>
                                                    <button type="button"
                                                        wire:click="kurangitem('{{ $data->id }}')"
                                                        class="btn btn-sm btn-warning text-white px-3 py-1">
                                                        -
                                                    </button>
                                                @else
                                                    <button wire:click="tambahitemManual('{{ $data->id }}')"
                                                        class="px-3 py-1 btn btn-sm btn-light text-white"
                                                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                                                        +
                                                    </button>
                                                    <span
                                                        class=" text-center border-0 px-sm-5 px-lg-5 px-xl-5 px-md-5 px-4">
                                                        {{ $data->qty }}
                                                    </span>
                                                    <button type="button"
                                                        wire:click="kurangitemManual('{{ $data->id }}')"
                                                        class="btn btn-sm btn-warning text-white px-3 py-1">
                                                        -
                                                    </button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <center>
                        <span class="text-white">Belum memiliki produk</span>
                    </center>
                @endforelse

            </div>
            <hr class="mt-3 mb-2 text-white">
            <div class="mt-0 text-white">
                {{-- <div class="">Form</div> --}}
                <form wire:submit.prevent='buatpesanan'>
                    <div class="">
                        <div class="">
                            {{-- <label for="metodekirim">Metode pengiriman</label> --}}
                            <select required wire:model='metode_kirim_id' id="metodekirim"
                                class="form-control form-control-sm text-muted @error('metode_kirim_id') is-invalid @enderror">
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
                            {{-- <label for="metodepembayaran">Metode pembayaran</label> --}}
                            <select wire:model='metode_pembayaran_id' required id="metodepembayaran"
                                class="form-control form-control-sm text-muted @error('metode_pembayaran_id') is-invalid @enderror">
                                <option selected value="">Pilih pembayaran</option>
                                @forelse ($pembayaran as $data)
                                    <option value="{{ $data->id }}">{{ $data->metode }} - {{ $data->nama }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('metode_pembayaran_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2 d-flex w-100">
                            <div class="w-100 me-1">
                                <input type="datetime-local" wire:model='created_at' id=""
                                    class="form-control form-control-sm">
                            </div>
                            <div class="ms-1 w-100">
                                <select wire:model='islunas' class="form-control form-control-sm">
                                    <option value="1" selected>Lunas</option>
                                    <option value="0">Belum bayar</option>
                                </select>
                            </div>
                        </div>


                        <div class="accordion mt-2" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button py-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        (optional)
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="mt-0">
                                            <input wire:model.lazy='nama_konsumen' type="text"
                                                placeholder="nama konsumen (optional)"
                                                class="form-control-sm @error('nama_konsumen') is-invalid @enderror rounded shadow-sm border border-light form-control">
                                            @error('nama_konsumen')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <input wire:model.lazy='nowa_konsumen' type="text"
                                                placeholder="nomor telp konsumen.. (optional)"
                                                class="form-control-sm @error('nowa_konsumen') is-invalid @enderror rounded shadow-sm border border-light form-control">
                                            @error('nowa_konsumen')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <input wire:model.lazy='alamat_konsumen' type="text"
                                                placeholder="alamat konsumen (optional)"
                                                class="form-control-sm @error('alamat_konsumen') is-invalid @enderror rounded shadow-sm border border-light form-control">
                                            @error('alamat_konsumen')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <input max="999999999" placeholder="Biaya kirim tambahan (optional)"
                                                wire:model='biaya_kirim_tambahan' type="number"
                                                class="form-control form-control-sm @error('biaya_kirim') is-invalid @enderror rounded shadow-sm border border-light"
                                                id="biaya_kirim" aria-describedby="biaya_kirimHelp">
                                            @error('biaya_kirim')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <input wire:model.lazy='catatan' type="text"
                                                placeholder="Catatan.. (optional)"
                                                class="form-control-sm @error('catatan') is-invalid @enderror rounded shadow-sm border border-light form-control">
                                            @error('catatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="text-dark mt-3">
                        <div class="card bg-none border-left-0 border-right-0 rounded">
                            <div class="card-body">
                                {{-- <h5><b>Ringkasan belanja</b></h5> --}}
                                <div class="d-flex justify-content-between">
                                    <div class="">Total belanja</div>
                                    <div class="">@uang($keranjangitem->sum('total_harga'))</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">Kode unik</div>
                                    <div class="">@uang($kode_unik != null ? $kode_unik : 0)</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">Biaya kirim tambahan</div>
                                    <div class="">@uang($biaya_kirim_tambahan != null ? $biaya_kirim_tambahan : 0)</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">Biaya pengiriman</div>
                                    <div class="">@uang($biaya_kirim = !null ? $biaya_kirim : 0)</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class=""><b>Total pembayaran</b></div>
                                    <div class=""><b>@uang($keranjangitem->sum('total_harga') + $kode_unik + $biaya_kirim + $biaya_kirim_tambahan)</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="">
                <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg"
                    style="background-color: white">
                    <div class="container-fluid">
                        <ul class="py-2 navbar-nav justify-content-between w-100 align-items-center">
                            <div class="me-auto text-dark">
                                <div class="">
                                    Total pembayaran
                                </div>
                                <div class="" style="font-size: 18px">
                                    <b>@uang($keranjangitem->sum('total_harga') + $kode_unik + $biaya_kirim + $biaya_kirim_tambahan)</b>
                                </div>
                            </div>

                            <div class="ms-auto bg-info">

                            </div>
                            <div class="ms-auto d-flex">
                                @if ($jml_belanja >= 1)
                                    <button type="button"
                                        onclick="confirm('Are you sure delete all produk?') || event.stopImmediatePropagation()"
                                        wire:click="deleteallcartitem" class="btn border-0 bg-white btn-white">
                                        <img src="{{ asset('trash.png') }}" alt="">
                                    </button>
                                    <button
                                        onclick="confirm('Telah yakin cek pesanan?') || event.stopImmediatePropagation()"
                                        type="submit" class="nav-link btn px-3 my-1 mx-1 text-center btn-light"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}; color: white;"> <span
                                            class="small d-block" style="font-size: 15px">
                                            <b>Buat pesanan</b>
                                        </span>
                                    </button>
                                @else
                                    <button class="nav-link btn px-3 my-1 mx-1 text-center btn-light" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                        aria-controls="offcanvasBottom"
                                        style="background-color: {{ env('COLOR_PRIMARY') }}; color: white;">
                                        <span class="small d-block" style="font-size: 15px">
                                            <b>Buat pesanan</b>
                                        </span>
                                    </button>
                                @endif


                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
