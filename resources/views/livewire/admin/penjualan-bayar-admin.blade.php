<div>
    <livewire:admin.component.navbar-admin />
    <div class="mt-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <b>Berhasil dibuat</b>
                </div>
                <div class="">
                    {{ \Carbon\Carbon::parse($transaksi->created_at)->isoFormat('D MMMM Y, H:m') }}
                </div>
            </div>
            <div class="mt-3 mb-2">
                <center>
                    <span style="font-size: 15px"><b>Total Pembayaran</b></span>
                    <div class="mt-">
                        <span
                            style="font-size: 19px; color: {{ env('COLOR_PRIMARY') }}"><b>@uang($transaksi->total_pembayaran)</b></span>
                    </div>
                </center>
            </div>
            <hr class="py-0 my-0 ">
            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        Pengiriman
                    </div>
                    <div class="">
                        {{ $transaksi->metodekirim->metode }}{{ $transaksi->metodekirim->nama != null ? ', ' . $transaksi->metodekirim->nama : '' }}
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        Pembayaran
                    </div>
                    <div class="">
                        {{ $transaksi->metodepembayaran->metode }}{{ $transaksi->metodepembayaran->nama != null ? ', ' . $transaksi->metodepembayaran->nama : '' }}
                    </div>
                </div>
            </div>
            <hr class="py-0 my-0 mt-2">

            <div class="mt-2">
                @if ($transaksi->metodepembayaran->metode == 'tunai')
                    <div class="text-center">
                        <label for="diterima">Uang diterima tunai</label>
                        <input min="{{ $transaksi->total_pembayaran }}" wire:model='diterima' type="number"
                            placeholder="jumlah uang diterima tunai..."
                            class="form-control rounded-pill border-warning shadow">
                    </div>
                    <div class="mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">Diterima</div>
                            <div class="">@uang($diterima == null ? 0 : $diterima)</div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">Kembalian</div>
                            <div class="">@uang($kembalian == null ? 0 : $kembalian)</div>
                        </div>
                    </div>
                @endif
            </div>



            <div class="mt-4">
                <div class="">
                    @if ($transaksi->metodekirim->metode == 'ambil ditempat')
                        <button wire:click='sdh_byr_diterima'
                            class="btn btn-success btn-sm shadow-sm form-control rounded-pill">
                            Sudah bayar dan barang diterima
                        </button>
                    @else
                        <button wire:click='sdh_byr_kemas' class="btn mt-1 btn-outline-success btn-sm shadow-sm form-control rounded-pill">
                            Sudah bayar lalu kemas barang
                        </button>
                    @endif
                </div>
                <div class="mt-2">
                    @if ($transaksi->metodekirim->metode == 'ambil ditempat')
                        <button wire:click='byr_nanti_diterima' class="btn btn-warning btn-sm shadow-sm form-control rounded-pill">
                            Bayar nanti dan barang diterima
                        </button>
                    @else
                        <button wire:click='byr_nanti_kemas' class="btn mt-1 btn-outline-warning btn-sm shadow-sm form-control rounded-pill">
                            Bayar nanti lalu kemas barangs
                        </button>
                    @endif
                </div>
                <div class="mt-2">
                    @if ($transaksi->metodepembayaran->metode != 'tunai')
                        <button wire:click='cek_admin' class="btn btn-secondary btn-sm shadow-sm form-control rounded-pill">
                            Pembayaran dicek admin dulu
                        </button>
                    @endif
                    <button wire:click='batal' class="btn mt-1 btn-danger btn-sm shadow-sm form-control rounded-pill">
                        Batal dan hapus transaksi ini
                    </button>
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
