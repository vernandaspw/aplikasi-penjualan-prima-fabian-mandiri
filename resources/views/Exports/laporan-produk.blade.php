<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan-Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body style="font-size: 12px">

    {{-- <table>
        <tbody>
            <tr>
                <td></td>
                <td><b>LAPORAN PRODUK</b></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    Dicetak pada {{ \Carbon\Carbon::parse(now())->isoFormat('D MMMM Y, H:m') }}
                </td>
            </tr>
        </tbody>
    </table> --}}
    <div class="mb-2">
        <center>
            <div class="">
                <b>LAPORAN PENJUALAN</b>
            </div>
           
            <div class="">
                Dicetak pada {{ \Carbon\Carbon::parse(now())->isoFormat('D MMMM Y, H:m') }}
            </div>
        </center>
    </div>
    <hr class="my-0 py-0">
    <div class="table-responsive mb-5">
        <table class="table table-sm table-bordered" style="font-size: 12px">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 3%">#</th>
                    {{-- <th style="width: 5%"></th> --}}
                    <th scope="col" style="">Produk</th>
                    <th scope="col" style="width: 10%">Kategori</th>
                    <th scope="col" style="width: 10%">Merek</th>
                    <th scope="col" style="width: 10%">Harga Modal</th>
                    <th scope="col" style="width: 10%">Harga Jual</th>
                    <th scope="col" style="width: 10%">Untung</th>
                    <th style="width: 11%">Status</th>
                </tr>
            </thead>
            <tbody class='table-group-divider'>
                @forelse ($datas as $data)
                    <tr>
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        {{-- <th>
                            @foreach ($data->gambar as $gambar)
                                @if ($gambar->no == 1)
                                    @if ($gambar->img == null)
                                        <img width="60px" height="60" src="{{ asset('imagenotfound.jpg') }}"
                                            alt="">
                                    @else
                                        <img width="60px" height="60"
                                            src="{{ asset(Storage::url($gambar->img)) }}" alt="">
                                    @endif
                                @endif
                            @endforeach
                        </th> --}}
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kategori != null ? $data->kategori->nama : '' }}</td>
                        <td>{{ $data->merek != null ? $data->merek->nama : '' }}</td>
                        <td>@uang($data->harga_modal)</td>
                        <td>@uang($data->harga_jual)</td>
                        <td style="color: green">@uang($data->harga_jual - $data->harga_modal)</td>
                        <td>
                            {{ $data->istersedia == true ? 'tersedia' : 'tidak tersedia' }}
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
