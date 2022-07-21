<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk-{{ $data->no_transaksi }}</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <style>
        html {
            margin: 3px 2px;
        }
    </style>

</head>

<body>
    <div class="" style="font-size: 9px;">
        <div class="" style="width: 21%">
            <div class="mb-2">
                <center><b>Prima Elektronik</b></center>
            </div>
            <hr class="my-0 py-0">
            <div class="col-12">
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td>Struk</td>
                            <td class="text-end">{{ $data->no_transaksi }}</td>
                        </tr>
                        <tr>
                            <td>Kasir:{{ $data->pegawai != null ? $data->pegawai->nama : '' }}</td>
                            <td class="text-end">
                                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, H:m') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $data->metodekirim->metode }}</td>
                            <td class="text-end">{{ $data->metodepembayaran->metode }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr class="my-0 py-0">
            <center>
                <b>{{ $data->islunas == true ? 'LUNAS' : 'BELUM BAYAR' }}</b>
            </center>
            <hr class="my-0 py-0">
            <div class="col-12">
                <table class="table mb-0">
                    <tbody>
                        @foreach ($data->transaksiitem as $item)
                            <tr>
                                @if ($item->nama_produk)
                                    <td>
                                        {{ $item->nama_produk }}
                                        <div class="">
                                            x{{ $item->qty }} @uang($item->harga_jual)
                                        </div>
                                    </td>
                                @else
                                    <td>
                                        {{ $item->produk->nama }}
                                        <div>
                                            x{{ $item->qty }}
                                            @uang($item->produk->harga_jual)
                                        </div>
                                    </td>
                                @endif

                                <td class="text-end">@uang($item->total_harga)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr class="my-0 py-0">
            <div class="col-12">
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td>
                                Total Pembayaran
                            </td>
                            <td class="text-end">
                                @uang($data->total_pembayaran)
                            </td>
                        </tr>
                        @if ($data->metodepembayaran->metode == 'tunai')
                            <tr>
                                <td>
                                    Bayar
                                </td>
                                <td class="text-end">
                                    @uang($data->diterima)
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Kembali
                                </td>
                                <td class="text-end">
                                    @uang($data->kembalian)
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <center>
                <div class="mt-1">
                    ~ Terimakasih ~
                </div>
            </center>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
