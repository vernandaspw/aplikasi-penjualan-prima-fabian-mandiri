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
                    <th scope="col" style="">Konsumen</th>
                    <th scope="col" style="width: 10%">Pengiriman</th>
                    <th scope="col" style="width: 10%">Pembayaran</th>
                    <th scope="col" style="">Total Pembayaran</th>
                    <th style="">Status</th>
                    <th style="width: 10%">Bayar</th>
                    <th style="">Dibuat</th>
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
                            @if ($data->konsumen_id)
                                {{ $data->konsumen->nama }}
                            @else
                                {{ $data->nama_konsumen }}
                            @endif
                        </td>
                        <td>
                            {{ $data->metodekirim->metode }}
                        </td>
                        <td>
                            {{ $data->metodepembayaran->metode }}
                        </td>

                        <td>
                            @uang($data->total_pembayaran)
                        </td>
                        <td
                            style="color: @if ($data->status == 'selesai') green
                    @elseif ($data->status == 'batal')
                    red
                    @elseif ($data->status == 'retur')
                    red @endif">
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

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
