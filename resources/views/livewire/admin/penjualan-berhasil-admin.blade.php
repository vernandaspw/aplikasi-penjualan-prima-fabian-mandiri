<div>
    <livewire:admin.component.navbar-admin />
    <div class="mt-3 container">

        <center>
            <div class="mt-2">
                <img src="{{ asset('success-line.svg') }}" width="60px" alt="">
            </div>
            <div class="mt-3">
                <b>Transaksi Berhasil</b>
            </div>
            <div class="">
                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, H:m') }}
            </div>
        </center>
        <hr>
        <div class="d-flex justify-content-between">
            <div class="">
                Pengiriman
            </div>
            <div class="">
                {{ $data->metodekirim->metode }}
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="">
                Pembayaran
            </div>
            <div class="">
                {{ $data->metodepembayaran->metode }}
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="">
                Status bayar
            </div>
            <div class="" style="color:  {{ $data->islunas == true ? 'green' : 'red' }}">
                {{ $data->islunas == true ? 'lunas' : 'belum bayar' }}
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div class="">
                Total Pembayaran
            </div>
            <div class="">
                @uang($data->total_pembayaran)
            </div>
        </div>

        @if ($data->metodepembayaran->metode == 'tunai')
            <div class="d-flex justify-content-between">
                <div class="">
                    Diterima tunai
                </div>
                <div class="">
                    @uang($data->diterima)
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="">
                    Kembalian
                </div>
                <div class="">
                    @uang($data->kembalian)
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-around">
            <button wire:click='cetak_struk' class="btn btn-info text-white w-100 me-1" type="button">Cetak struk</button>
            <button class="btn btn-outline-info w-100 ms-1" type="button">Kirim struk</button>
        </div>
        <div class="d-flex justify-content-around">
            <button class="btn btn-info text-white w-100 me-1" type="button">Cetak nota</button>
            <button class="btn btn-outline-info w-100 ms-1" type="button">Kirim nota</button>
        </div>
        <div class="d-flex justify-content-around">
            <button class="btn btn-info text-white w-100 me-1" type="button">Cetak surat jalan</button>
            <button class="btn btn-outline-info w-100 ms-1" type="button">Kirim surat jalan</button>
        </div>
    </div>
</div>
