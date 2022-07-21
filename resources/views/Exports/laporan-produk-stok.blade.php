<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan-Produk-Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body style="font-size: 12px">

    <table>
        <tbody>
            <tr>
                <td></td>
                <td><b>LAPORAN PRODUK STOK</b></td>
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
                    <th style="">Produk</th>
                    <th style="width: 15%">Satuan unit</th>
                    <th style="width: 10%">PO</th>
                    <th style="width: 10%">Real</th>
                </tr>
            </thead>
            <tbody class='table-group-divider'>
                @foreach ($produkstok as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->produk->nama }}</td>
                        <td>{{ $data->satuan_unit }}</td>
                        <td>{{ $data->po }}</td>
                        <td>{{ $data->real }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
