<div>
    <livewire:admin.component.navbar-admin />
    <div class="container-fluid mt-3">
        <h4>LAPORAN PRODUK</h4>
        <div class="">
            {{ now() }}
        </div>
        <hr>
    </div>
    <div class="container-fluid mt-1 mb-1">
        <div class="d-md-flex justify-content-md-between">
            <div class="d-flex align-items-center mt-1">
                <label for="">Tampilkan</label>
                <select class="form-control ms-2 rounded-pill" wire:model='take' id="">
                    <option value="{{ $jml_item }}">- pilih -</option>
                    <option value="20">20 data</option>
                    <option value="100">100 data</option>
                    <option value="{{ $jml_item }}">Semua</option>
                </select>
            </div>
            <div class="row g-3 d-flex align-items-center mt-1">

                <div class="col-auto">
                    <button wire:click='cetak_laporan' type="button"
                        class="btn shadow-sm rounded-pill border-0 btn-primary">Cetak Laporan</button>
                </div>
                <div class="col-auto">
                    <button wire:click='downloadExcel' type="button"
                        class="btn shadow-sm rounded-pill border-0 btn-success">Download Excel</button>
                </div>
            </div>
        </div>


    </div>
    <div class="container-fluid mt-4">
        <div class="table-responsive">
            <table class="table table-sm table-bordered" style="font-size: 12px">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 3%">#</th>
                        <th style="width: 5%"></th>
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
                    @forelse ($produk as $data)
                    <tr>
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        <th>
                            @foreach ($data->gambar as $gambar)
                                @if ($gambar->no == 1)
                                    @if ($gambar->img == null)
                                        <img width="60px" height="60"
                                            src="{{ asset('imagenotfound.jpg') }}" alt="">
                                    @else
                                        <img width="60px" height="60"
                                            src="{{ asset(Storage::url($gambar->img)) }}"
                                            alt="">
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kategori != null ? $data->kategori->nama : '' }}</td>
                        <td>{{ $data->merek != null ? $data->merek->nama : '' }}</td>
                        <td>@uang($data->harga_modal)</td>
                        <td>@uang($data->harga_jual)</td>
                        <td style="color: green">@uang($data->harga_jual - $data->harga_modal)</td>
                        <td>
                            <div

                                class="btn btn-sm text-white rounded-pill {{ $data->istersedia == true ? 'btn-success' : 'btn-danger' }}">
                                {{ $data->istersedia == true ? 'tersedia' : 'tidak tersedia' }}
                            </div>
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

    @push('script')
        <script>
            Livewire.on('success', data => {
                console.log(data.pesan);
                Swal.fire({
                    title: 'success!',
                    text: data.pesan,
                    icon: 'success',
                    confirmButtonText: 'oke'
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
