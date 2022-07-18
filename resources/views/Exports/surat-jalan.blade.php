<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk-{{ $data->no_transaksi }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


</head>

<body>
    <div class="" style="font-size: 11px">
        <div class="col-12">
            <table class="table mb-0">
                <tbody>
                    <tr>
                        <td>PT. PRIMA FEBIAN MANDIRI</td>
                        <td class="text-end">PALEMBANG
                            {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td>JL. H.M Rasyad Nawawi No.127</td>
                        <td class="text-end">Kepada Yth</td>
                    </tr>
                    <tr>
                        <td>PALEMBANG</td>
                        <td class="text-end">
                            @if ($data->nama_konsumen)
                                {{ $data->nama_konsumen }}
                            @elseif($data->konsumen)
                                {{ $data->konsumen->nama }}
                            @else
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>0711-363270</td>
                        <td class="text-end">
                            @if ($data->alamat_konsumen)
                                {{ $data->alamat_konsumen }}
                            @elseif($data->konsumen)
                                {{ $data->konsumen->alamat }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 mt-2">
            <h1 class="mb-1 text-decoration-underline">SURAT JALAN</h1>
            <table class="table mb-0">
                <tbody class="">
                    <tr>
                        <b>
                            <td>NO NOTA : {{ $data->no_transaksi }}</td>
                        </b>
                    </tr>

                </tbody>
            </table>
            <hr class="py-0 my-0">
            <table class="table mb-0">
                <thead class="">
                    <tr>
                        <th style="width: 5%">
                            No.
                        </th>
                        <th style="width: 10%">
                            Qty
                        </th>
                        <th style="width: 20%">
                            Kode
                        </th>
                        <th style="width: 50%">
                            Nama barang
                        </th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data->transaksiitem as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $item->qty }}</td>
                            @if ($item->nama_produk)
                            @else
                                <td>
                                    {{ $item->produk->barcode }}
                                </td>
                            @endif
                            @if ($item->nama_produk)
                                <td>
                                    {{ $item->nama_produk }}

                                </td>
                            @else
                                <td>
                                    {{ $item->produk->nama }}

                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="fixed-bottom">
            <div class="col-12">
                <table class="table mb-2">
                    <tbody class="table-group-divider pt-1">
                        <tr>
                            <td style="width: 20%">
                                <center>
                                    Dibuat,
                                </center>
                            </td>
                            <td style="width: 20%">
                                <center>
                                    Diperiksa,
                                </center>
                            </td>
                            <td style="width: 20%">
                                <center>
                                    Gudang,
                                </center>
                            </td>
                            <td style="width: 20%" >
                                <center>
                                    Pengirim,
                                </center>
                            </td>
                            <td style="width: 20%" >
                                <center>
                                    Penerima,
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
                                    <hr class="mx-3">
                                </center>
                            </td>
                            <td style="width: 20%">
                                <center>
                                    <hr class="mx-3">
                                </center>
                            </td>
                            <td style="width: 20%">
                                <center>
                                   <hr class="mx-3">
                                </center>
                            </td>
                            <td style="width: 20%" >
                                <center>
                                   <hr class="mx-3">
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
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
