@extends('layouts.main')

@section('content')
    <div>
        <livewire:admin.component.navbar-admin />
        <div class="mt-3 container pb-5 mb-5" >

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

            <div class="d-flex justify-content-around mt-2">
                <a target="_blank" href="{{ url('cetak-struk', $data->no_transaksi) }}"
                    class="btn btn-primary rounded-pill mt-2 text-white w-100" type="button">Cetak struk</a>
            </div>
            <div class="d-flex justify-content-around">
                <a target="_blank" href="{{ url('cetak-nota', $data->no_transaksi) }}"
                    class="btn btn-primary rounded-pill mt-2 text-white w-100" type="button">Cetak nota</a>

            </div>
            <div class="d-flex justify-content-around">
                <a target="_blank" href="{{ url('cetak-surat-jalan', $data->no_transaksi) }}"
                    class="btn btn-primary rounded-pill mt-2 text-white w-100" type="button">Cetak surat jalan</a>

            </div>
            @if($data->nowa_konsumen != null || $data->konsumen != null)
            <a  target="_blank" href="https://wa.me/62{{ $data->nowa_konsumen != null ? $data->nowa_konsumen : $data->konsumen->nohp }}?text=Prima%20Elektronik%0ATanggal%3A%20{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, H:m') }}%0AINV%3A%20{{ $data->no_transaksi }}%0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%0APengiriman%3A%20{{ $data->metodekirim->metode }}%0APembayaran%3A%20{{ $data->metodepembayaran->metode }}%0AStatus%20bayar%3A%20{{ $data->islunas == true ? 'lunas' : 'belum bayar' }}%0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%0ATotal%20Pembayaran%3A @uang($data->total_pembayaran) @if($data->diterima)
                %0ABayar%3A%20 @uang($data->diterima) %0AKembali%3A%20 @uang($data->kembalian)
            @endif  %0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%0AKlik%20link%20dibawah%20ini%20untuk%20melihat%20nota%20digital
            %0AStruk%3A%20{{ url('cetak-struk', $data->no_transaksi) }}
            %0ANota%3A%20{{ url('cetak-nota', $data->no_transaksi) }}
            %0ASurat%20jalan%3A%20{{ url('cetak-surat-jalan', $data->no_transaksi) }}
                " class="btn mt-2 rounded-pill  btn-outline-primary w-100" type="button">Kirim struk</a>
            @endif


            <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: white">
                <div class="container">
                    <ul class="py-1 navbar-nav nav-justified w-100 align-items-center">

                        <li class="nav-item" style="">

                                <a type="button" href="{{ url('admin/penjualan/produk') }}"
                                    class="nav-link btn m-1 rounded-pill text-white text-center"
                                    style="background-color: {{ env('COLOR_PRIMARY') }}">
                                    <span class="small d-block" style="font-size: 15px">
                                        Transaksi Baru
                                    </span>
                                </a>

                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
@endsection
