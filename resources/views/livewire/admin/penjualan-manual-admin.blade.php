<div>
    <livewire:admin.component.navbar-admin />

    <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="{{ url('admin/penjualan/produk') }}" class="nav-link  text-center">
                    <span class="small d-block" style="font-size: 14px;">
                        Produk
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/penjualan/manual') }}" class="nav-link active text-center">
                    <span class="small d-block" style="font-size: 14px; font-weight: bold; color:white;">
                        Manual
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container mt-3 mb-5 pb-5">
        <b>Tambah Produk secara manual</b>

        <div class="mt-2 mb-5">
            <form wire:submit.prevent='tambahproduk'>
                <div class="mb-2">
                    <label for="nama_produk" class="">Nama produk</label>
                    <input placeholder="isi nama produk" required wire:model='nama_produk' type="text"
                        class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk"
                        aria-describedby="nama_produkHelp">
                    @error('nama_produk')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="qty" class="">jumlah qty produk</label>
                    <input max="10" placeholder="isi nama produk" required wire:model='qty' min="1" minlength="1"
                        type="number" class="form-control @error('qty') is-invalid @enderror" id="qty"
                        aria-describedby="qtyHelp">
                    @error('qty')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="harga_jual" class="">Harga jual produk</label>
                    <input max="999999999" placeholder="isi harga jual produk" required wire:model='harga_jual' min="1"
                        type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual"
                        aria-describedby="harga_jualHelp">
                    @error('harga_jual')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-0 text-primary">
                    Total harga :
                    @if($qty != null && $harga_jual != null)
                    @uang($qty * $harga_jual)
                    @else
                    @uang(0)
                    @endif
                </div>

                <div class="mb-2">
                    <label for="harga_modal" class="">Harga modal produk <span
                            class="text-muted">(optional)</span></label>
                    <input max="999999999" placeholder="isi harga modal produk" wire:model='harga_modal' type="number"
                        class="form-control @error('harga_modal') is-invalid @enderror" id="harga_modal"
                        aria-describedby="harga_modalHelp">
                    @error('harga_modal')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="berat" class="">Berat produk <span class="text-muted">(optional)</span></label>
                    <input max="9999" placeholder="isi berat produk" wire:model='berat' type="number"
                        class="form-control @error('berat') is-invalid @enderror" id="berat"
                        aria-describedby="beratHelp">
                    @error('berat')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>



                <button type="submit" style="background-color: {{ env('COLOR_PRIMARY') }}"
                    class="btn mt-2 text-white border-0 form-control rounded-pill">
                    Tambah ke keranjang
                </button>
            </form>
        </div>
    </div>

    <livewire:admin.penjualan-admin />

    @push('script')
        <script>
            Livewire.on('success', data => {
                console.log(data.pesan);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: data.pesan,
                    showConfirmButton: false,
                    timer: 250
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
            // Livewire.on('edited' => {
            //     alert('A post was added with the id of: ');
            // })
        </script>
    @endpush
</div>

<style>
    .offcanvas {
        height: 89% !important;
    }
</style>
