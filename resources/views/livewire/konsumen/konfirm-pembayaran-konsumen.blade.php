<div>
    <nav class="p-3 navbar navbar-dark navbar-expand fixed-top shadow-sm"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto w-full align-items-centar">
                <li class="nav-item me-3">
                    <span class="text-white"><b><a href="{{ url('pesanan-detail', $transaksi->no_transaksi) }}"
                                class="btn btn-close btn-close-white"></a></b></span>
                </li>
                <li class="nav-item">
                    <span class="text-white"><b>Konfirmasi Pembayaran</b></span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto  w-full align-items-start">
                <li class="nav-item">
                    <livewire:konsumen.component.icon-cart-konsumen />
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="padding-top: 60px; padding-bottom: 70px;">
        <div class="container">
            <div class="mb-3">
                {{-- <b>Isi saldo JePay </b> --}}
            </div>
            <div style="margin-top: 30px">
                <div>
                    <center>
                        <div class="text-danger" style="font-size: 20px">

                            @if (now() < $transaksi->pembayaran_expired_at)
                                <b>Pembayaran Belum selesai</b>
                            @else
                                <b>Pembayaran Expired</b>
                            @endif
                        </div>
                        <div class="mt-2">
                            <img class="m-2" src="{{ asset('logo.png') }}" alt="" width="50px"
                                height="50px">
                        </div>

                        <div class="">Segera Melakukan Pembayaran dan
                        </div>
                        <div class="">konfirmasi bahwa sudah melakukan transfer</div>
                        <div class="text-danger">
                            Pastikan transfer dengan kode unik
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="kiri">
                                No Transaksi
                            </div>
                            <div class="kanan">
                                {{ $transaksi->no_transaksi }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div class="kiri">
                                Batas waktu pembayaran
                            </div>
                            <div class="kanan text-danger">
                                {{ $transaksi->pembayaran_expired_at }}
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <div class="">
                                Metode pembayaran
                            </div>
                            <div class="">
                                {{ $transaksi->metodepembayaran->metode }} -
                                {{ $transaksi->metodepembayaran->nama }}
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <div class="">
                                Status bayar
                            </div>
                            <div class="">
                                <span
                                    style="color: {{ $transaksi->islunas == 1 ? 'green' : 'red' }}">({{ $transaksi->islunas == 1 ? 'sudah bayar' : 'belum bayar' }})</span>
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <div class="">
                                Total Belanja
                            </div>
                            <div class="">
                                @uang($transaksi->total_belanja)
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <div class="">
                                Kode unik
                            </div>
                            <div class="">
                                @uang($transaksi->kode_unik)
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <div class="">
                                Biaya pengiriman
                            </div>
                            <div class="">
                                @uang($transaksi->biaya_kirim)
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <div class="" style="color: {{ env('COLOR_PRIMARY') }}; font-size: 19px">
                                <b>Total Pembayaran</b>
                            </div>
                            <div class="" style="color: {{ env('COLOR_PRIMARY') }}; font-size: 19px">
                                <b>@uang($transaksi->total_pembayaran)</b>
                            </div>
                        </div>

                        @if (now() < $transaksi->pembayaran_expired_at)
                            <hr>
                            <div><b>Transfer ke Rekening</b></div>
                            <div class="mt-1 d-flex justify-content-between">
                                <div class="kiri">
                                    Nama bank
                                </div>
                                <div class="kanan">
                                    {{ $transaksi->metodepembayaran->nama }}
                                </div>
                            </div>
                            <div class="mt-1 d-flex justify-content-between">
                                <div class="kiri">
                                    Atas nama
                                </div>
                                <div class="kanan">
                                    {{ $transaksi->metodepembayaran->an }}
                                </div>
                            </div>
                            <div class="mt-1 d-flex justify-content-between">
                                <div class="kiri">
                                    Nomor Rekening
                                </div>
                                <div class="kanan">
                                    {{ $transaksi->metodepembayaran->norek }}
                                </div>
                            </div>
                            <br>
                        @endif
                        @if (now() < $transaksi->pembayaran_expired_at)
                            <nav class="p-2 navbar navbar-expand bg-white shadow-lg fixed-bottom">
                                <div class="container-fluid">
                                    <button style="background-color: {{ env('COLOR_PRIMARY') }}"
                                        onclick="confirm('Yakin sudah transfer total pembayaran?') || event.stopImmediatePropagation()"
                                        wire:click="konfirm('{{ $transaksi->id }}')"
                                        class="btn  shadow text-white form-control rounded-pill">Konfirmasi
                                        sudah
                                        bayar</button>
                                </div>
                            </nav>
                        @else
                            <nav class="p-2 navbar navbar-expand bg-white shadow-lg fixed-bottom">
                                <div class="container-fluid">
                                    <a href="{{ url('/') }}"
                                        class="btn  btn-danger shadow text-white form-control rounded-pill">Waktu
                                        pembayaran sudah habis</a>
                                </div>
                            </nav>
                        @endif
                    </center>
                </div>
            </div>
        </div>
    </div>
    {{-- <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: white">
        <div class="container">
            <ul class="py-1 navbar-nav nav-justified w-100 align-items-center">

                <li class="nav-item" style="margin-left: 2px">

                    <button type="button" wire:click="konfirm('{{ $transaksi->id }}')"
                        class="nav-link rounded-pill btn m-1 text-white text-center"
                        style="background-color: {{ env('COLOR_PRIMARY') }}">
                        <span class="small d-block" style="font-size: 15px">
                            Konfirm Pembayaran
                        </span>
                    </button>

                </li>
            </ul>
        </div>
    </nav> --}}

    @push('script')
    <script>
        Livewire.on('success', data => {
            console.log(data.pesan);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                text: data.pesan,
                showConfirmButton: false,
                timer: 1500
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
