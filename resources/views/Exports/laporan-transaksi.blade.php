<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan-Penjualan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


</head>

<body style="font-size: 12px">

    <table>
        <tbody>
            <tr>
                <td></td>
                <td><b>LAPORAN PENJUALAN</b></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    Laporan tanggal {{ \Carbon\Carbon::parse($start)->isoFormat('D MMMM Y') }} -
                    {{ \Carbon\Carbon::parse($end)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    Dicetak pada {{ \Carbon\Carbon::parse(now())->isoFormat('D MMMM Y, H:m') }}
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div class="table-responsive mb-5">
        <table class="table table-sm table-bordered" style="font-size: 12px">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 3%">#</th>
                    <th style="width: 10%">No Transaksi</th>
                    <th scope="col" style="width: 10%">Jenis</th>
                    <th scope="col" style="width: 10%">Kategori</th>
                    <th scope="col" style="width: 10%">Konsumen</th>
                    <th scope="col" style="width: 10%">Pengiriman</th>
                    <th scope="col" style="width: 10%">Pembayaran</th>
                    <th scope="col" style="width: 10%">Total Pembayaran</th>
                    <th style="width: 11%">Status</th>
                    <th style="width: 11%">Bayar</th>
                    <th style="width: 11%">Dibuat</th>

                </tr>
            </thead>
            <tbody class='table-group-divider'>
                @forelse ($datas as $data)
                    <tr>
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        <td>
                            {{ $data->no_transaksi }}
                        </td>
                        <td>
                            {{ $data->transaksi_jenis->nama }}
                        </td>
                        <td>
                            {{ $data->transaksi_kategori->nama }}
                        </td>
                        <td>
                            @if ($data->konsumen_id)
                                {{ $data->konsumen->nama }}
                            @else
                                {{ $data->nama_konsumen }}
                            @endif
                        </td>
                        <td>
                            {{ $data->metodekirim == null ? '' : $data->metodekirim->metode }}
                        </td>
                        <td>
                            {{ $data->metodepembayaran == null ? '' : $data->metodepembayaran->metode }}
                        </td>

                        <td>
                            @uang($data->total_pembayaran)
                        </td>
                        <td>
                            {{ $data->status }}
                        </td>
                        <td style="color: {{ $data->islunas == true ? 'green' : 'red' }}">
                            {{ $data->islunas == true ? 'sudah bayar' : 'belum bayar' }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, H:m') }}
                        </td>




                    </tr>
                @empty
                    tidak ada data
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="fixed-bottom">
        <div class="col-12">
            <table class="table mb-2">
                <tbody class="table-group-divider pt-1">
                    <tr >
                        <td style="width: 20%">
                            <center>
                              
                            </center>
                        </td>
                        <td style="width: 20%">
                            <center>
                               
                            </center>
                        </td>
                        <td style="width: 20%">
                            <center>
                                
                            </center>
                        </td>
                        <td style="width: 20%" >
                            <center>
                                
                            </center>
                        </td>
                        <td style="width: 20%" >
                            <center>
                                Pimpinan
                            </center>
                        </td>

                    </tr>




                </tbody>
            </table>

            <table class="table mt-5">
                <tbody class="">

                    <tr class="">
                        <td style="width: 20%">
                            <center>
                                {{-- <hr class="mx-3"> --}}
                            </center>
                        </td>
                        <td style="width: 20%">
                            <center>
                                {{-- <hr class="mx-3"> --}}
                            </center>
                        </td>
                        <td style="width: 20%">
                            <center>
                               {{-- <hr class="mx-3"> --}}
                            </center>
                        </td>
                        <td style="width: 20%" >
                            <center>
                               {{-- <hr class="mx-3"> --}}
                            </center>
                        </td>
                        <td style="width: 20%" >
                            <center>
                               <hr class="mx-3">
                            </center>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
