<div>
    <livewire:admin.component.navbar-admin />
    <div class="container mt-3">
        <a href="{{ url('admin') }}" class="btn px-3 btn-primary rounded-pill">
        Kembali
        </a>
        <div class="table-responsive mt-3">
            <table class="table table-sm table-bordered" style="font-size: 12px">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 3%">#</th>
                        <th style="">Nama</th>
                        <th scope="col" style="width: 10%">Jenis kelamin</th>
                        <th scope="col" style="width: 15%">nohp</th>
                        <th scope="col" style="width: 15%">wilayah</th>
                        <th scope="col" style="width: 20%">Email</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    @forelse ($konsumen as $data)
                        <tr>
                            <th scope="row">
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $data->nama }}
                            </td>
                            <td>
                                {{ $data->jeniskelamin }}
                            </td>
                            <td>
                                0{{ $data->nohp }}
                            </td>
                            <td>
                                {{ $data->wilayah }}
                            </td>
                            <td>
                                {{ $data->email }}
                            </td>
                        </tr>
                    @empty
                        tidak ada data
                    @endforelse
                </tbody>
            </table>
            @if ($take < $jml_item)
                <center>
                    <button wire:click='lanjut'
                        class="btn btn-light shadow-sm form-control rounded-pill">Lanjut</button>
                </center>
            @endif
        </div>

    </div>
</div>
