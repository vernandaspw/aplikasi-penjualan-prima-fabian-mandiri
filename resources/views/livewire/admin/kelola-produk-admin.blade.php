<div>
    <div>
        <livewire:admin.component.navbar-admin />

        <div class="container mt-4 mb-5">
            <div class="mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <b>KELOLA PRODUK</b>
                            </div>

                            <div class="">
                                <a href="{{ url('admin/kelola-produk-kategori') }}"
                                    class="btn me-1 mb-1 rounded-pill btn-info text-white">
                                    Kategori ({{ $jmlkategori }})
                                </a>

                                <a href="{{ url('admin/kelola-produk-merek') }}"
                                    class="btn me-1 mb-1 rounded-pill btn-info text-white">
                                    Merek ({{ $jmlmerek }})
                                </a>

                                @if ($pageedit == false)
                                    <button wire:click="buatform" class="btn btn-primary mb-1 rounded-pill ">
                                        Tambah Produk baru
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="col-lg-3 col-md-6">
                        <input class="form-control" type="text" wire:model='cariproduk'
                            placeholder="Cari nama/barcode">
                    </div>
                </div>
            </div>

            @if ($pagebuat)
                <div class="mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <b>Tambah Produk Baru</b>
                            <form wire:submit.prevent='buat' enctype="multipart/form-data">
                                <div class="mt-2">
                                    <div class="d-flex justify-content-start align-items-start">
                                        <label for="gambar" class="form-label me-2">
                                            <img src="{{ $gambar == null ? asset('imagenotfound.jpg') : $gambar->temporaryUrl() }}"
                                                class="" width="65" height="65" />
                                        </label>
                                        <div class="w-100">
                                            <label for="gambar" class="form-label mb-0">
                                                <div class="">
                                                    Gambar 1 <span class="text-muted">(optional)</span>
                                                </div>
                                            </label>
                                            <input wire:model='gambar'
                                                class="form-control mt-0 @error('gambar') is-invalid @enderror"
                                                type="file" id="gambar">
                                            @error('gambar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="gambar">Uploading...</div>
                                        </div>
                                    </div>

                                    @if ($inputgambar2 == null)
                                        <button type="button" wire:click='inputgambar2'
                                            class="btn btn-sm btn-success">Tambah input
                                            gambar</button>
                                    @endif
                                </div>
                                @if ($inputgambar2)
                                    <div class="mt-2">
                                        <div class="d-flex justify-content-start align-items-start">
                                            <label for="gambar2" class="form-label me-2">
                                                <img src="{{ $gambar2 == null ? asset('imagenotfound.jpg') : $gambar2->temporaryUrl() }}"
                                                    class="" width="65" height="65" />
                                            </label>
                                            <div class="w-100">
                                                <label for="gambar2" class="form-label mb-0">
                                                    <div class="">
                                                        Gambar 2 <span class="text-muted">(optional)</span>
                                                    </div>
                                                </label>
                                                <input wire:model='gambar2'
                                                    class="form-control mt-0 @error('gambar2') is-invalid @enderror"
                                                    type="file" id="gambar2">
                                                @error('gambar2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div wire:loading wire:target="gambar2">Uploading...</div>
                                            </div>
                                        </div>

                                        @if ($inputgambar3 == null)
                                            <button type="button" wire:click='inputgambar3'
                                                class="btn btn-sm btn-success btn-transparent">Tambah input
                                                gambar</button>
                                            <button type="button" wire:click='hapusinputgambar2'
                                                class="btn btn-sm btn-success btn-danger">Hapus</button>
                                        @endif
                                    </div>
                                @endif
                                @if ($inputgambar3)
                                    <div class="mt-2">
                                        <div class="d-flex justify-content-start align-items-start">
                                            <label for="gambar3" class="form-label me-2">
                                                <img src="{{ $gambar3 == null ? asset('imagenotfound.jpg') : $gambar3->temporaryUrl() }}"
                                                    class="" width="65" height="65" />
                                            </label>
                                            <div class="w-100">
                                                <label for="gambar3" class="form-label mb-0">
                                                    <div class="">
                                                        Gambar 3 <span class="text-muted">(optional)</span>
                                                    </div>
                                                </label>
                                                <input wire:model='gambar3'
                                                    class="form-control mt-0 @error('gambar3') is-invalid @enderror"
                                                    type="file" id="gambar3">
                                                <div wire:loading wire:target="gambar3">Uploading...</div>
                                            </div>
                                        </div>
                                        @error('gambar3')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if ($inputgambar4 == null)
                                            <button type="button" wire:click='inputgambar4'
                                                class="btn btn-sm btn-success btn-transparent">Tambah input
                                                gambar</button>
                                            <button type="button" wire:click='hapusinputgambar3'
                                                class="btn btn-sm btn-success btn-danger">Hapus</button>
                                        @endif
                                    </div>
                                @endif
                                @if ($inputgambar4)
                                    <div class="mt-2">
                                        <div class="d-flex justify-content-start align-items-start">
                                            <label for="gambar4" class="form-label me-2">
                                                <img src="{{ $gambar4 == null ? asset('imagenotfound.jpg') : $gambar4->temporaryUrl() }}"
                                                    class="" width="65" height="65" />
                                            </label>
                                            <div class="w-100">
                                                <label for="gambar4" class="form-label mb-0">
                                                    <div class="">
                                                        Gambar 4 <span class="text-muted">(optional)</span>
                                                    </div>
                                                </label>
                                                <input wire:model='gambar4'
                                                    class="form-control mt-0 @error('gambar4') is-invalid @enderror"
                                                    type="file" id="gambar4">
                                                <div wire:loading wire:target="gambar4">Uploading...</div>
                                            </div>
                                        </div>
                                        @error('gambar4')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if ($inputgambar5 == null)
                                            <button type="button" wire:click='inputgambar5'
                                                class="btn btn-sm btn-success btn-transparent">Tambah input
                                                gambar</button>
                                            <button type="button" wire:click='hapusinputgambar4'
                                                class="btn btn-sm btn-success btn-danger">Hapus</button>
                                        @endif
                                    </div>
                                @endif
                                @if ($inputgambar5)
                                    <div class="mt-2">
                                        <div class="d-flex justify-content-start align-items-start">
                                            <label for="gambar5" class="form-label me-2">
                                                <img src="{{ $gambar5 == null ? asset('imagenotfound.jpg') : $gambar5->temporaryUrl() }}"
                                                    class="" width="65" height="65" />
                                            </label>
                                            <div class="w-100">
                                                <label for="gambar5" class="form-label mb-0">
                                                    <div class="">
                                                        Gambar 5 <span class="text-muted">(optional)</span>
                                                    </div>
                                                </label>
                                                <input wire:model='gambar5'
                                                    class="form-control mt-0 @error('gambar5') is-invalid @enderror"
                                                    type="file" id="gambar5">
                                                <div wire:loading wire:target="gambar5">Uploading...</div>
                                            </div>
                                        </div>
                                        @error('gambar5')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if ($inputgambar6 == null)
                                            <button type="button" wire:click='inputgambar6'
                                                class="btn btn-sm btn-success btn-transparent">Tambah input
                                                gambar</button>
                                            <button type="button" wire:click='hapusinputgambar5'
                                                class="btn btn-sm btn-success btn-danger">Hapus</button>
                                        @endif
                                    </div>
                                @endif
                                @if ($inputgambar6)
                                    <div class="mt-2">
                                        <div class="d-flex justify-content-start align-items-start">
                                            <label for="gambar6" class="form-label me-2">
                                                <img src="{{ $gambar6 == null ? asset('imagenotfound.jpg') : $gambar6->temporaryUrl() }}"
                                                    class="" width="65" height="65" />
                                            </label>
                                            <div class="w-100">
                                                <label for="gambar6" class="form-label mb-0">
                                                    <div class="">
                                                        Gambar 6 <span class="text-muted">(optional)</span>
                                                    </div>
                                                </label>
                                                <input wire:model='gambar6'
                                                    class="form-control mt-0 @error('gambar6') is-invalid @enderror"
                                                    type="file" id="gambar6">
                                                <div wire:loading wire:target="gambar6">Uploading...</div>
                                            </div>
                                        </div>
                                        @error('gambar6')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <button type="button" wire:click='hapusinputgambar6'
                                            class="btn btn-sm btn-success btn-danger">Hapus</button>
                                    </div>
                                @endif


                                <div class="mt-2">
                                    <label for="nama">Nama Produk</label>
                                    <input placeholder="Nama produk" id="nama" type="text"
                                        wire:model.lazy='nama'
                                        class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="barcode">Barcode/Kode barang (optional)</label>
                                    <input placeholder="barcode/kode barang" id="barcode" type="text"
                                        wire:model.lazy='barcode'
                                        class="form-control @error('barcode') is-invalid @enderror">
                                    @error('barcode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mt-2">
                                    <label for="kategori">Kategori</label>
                                    <select wire:model='produk_kategori_id' id="kategori" class="form-control">
                                        <option value="">Pilih kategori</option>
                                        @forelse ($kategori as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @empty
                                            not found
                                        @endforelse
                                    </select>
                                </div>

                                <div class="mt-2">
                                    <label for="merek">Merek (optional)</label>
                                    <select wire:model='produk_merek_id' id="merek" class="form-control">
                                        <option value="">Pilih merek</option>
                                        @forelse ($merek as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @empty
                                            not found
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <label for="harga_jual">Harga_jual</label>
                                    <input min="0" placeholder="harga untuk dijual" id="harga_jual"
                                        type="number" wire:model='harga_jual'
                                        class="form-control @error('harga_jual') is-invalid @enderror">
                                    @error('harga_jual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="harga_modal">Harga modal (optional)</label>
                                    <input min="0" placeholder="harga modal" id="harga_modal" type="number"
                                        wire:model='harga_modal'
                                        class="form-control @error('harga_modal') is-invalid @enderror">
                                    @error('harga_modal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-1">
                                    <span style="color: green">Untung

                                        @if ($harga_jual != null && $harga_modal != null)
                                            @uang($harga_jual - $harga_modal)
                                        @elseif ($harga_jual != null)
                                            @uang($harga_jual)
                                        @else
                                            @uang(0)
                                        @endif

                                        </spans>
                                </div>
                                <div class="mt-2">
                                    <label for="berat_kg">Berat produk per kg (optional)</label>
                                    <input id="berat_kg" type="number" wire:model.lazy='berat_kg'
                                        class="form-control @error('berat_kg') is-invalid @enderror">
                                    @error('berat_kg')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="deskripsi">Deskripsi Produk <span class="text-muted">(bisa sisipkan
                                            &lt;br&gt; untuk enter)</span></label>
                                    <textarea placeholder="isi deskripsi produk" class="form-control @error('deskripsi') is-invalid @enderror"
                                        wire:model.lazy='deskripsi' id="deskripsi" cols="30" rows="7"></textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="mt-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" wire:model='isstok' type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Produk ini memiliki stok?</label>
                                      </div>
                                </div>
                                @if($isstok)
                                <div class="mt-2">
                                    <label for="satuan_unit">Satuan unit</label>
                                    <input maxlength="15" placeholder="cth: pcs, kg, dll" id="satuan_unit" type="text"
                                        wire:model.lazy='satuan_unit'
                                        class="form-control @error('satuan_unit') is-invalid @enderror">
                                    @error('satuan_unit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="stok">Stok awal/akhir</label>
                                    <input maxlength="15" placeholder="stok awal/akhir" id="stok" type="text"
                                        wire:model.lazy='stok'
                                        class="form-control @error('stok') is-invalid @enderror">
                                    @error('stok')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="stok_minimum">Stok minumum</label>
                                    <input maxlength="15" placeholder="stok minimum" id="stok_minimum" type="text"
                                        wire:model.lazy='stok_minimum'
                                        class="form-control @error('stok_minimum') is-invalid @enderror">
                                    @error('stok_minimum')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @endif
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success form-control">
                                        Tambah akun
                                    </button>

                                </div>
                            </form>
                            <button wire:click="$toggle('pagebuat')" class="btn mt-2 btn-light form-control">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if ($pageedit)
                <div class="mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <b>Edit Produk</b>
                            <form wire:submit.prevent="edit('{{ $byid }}')" enctype="multipart/form-data">
                                <div class="mt-2">
                                    <div class="d-flex justify-content-start align-items-start">
                                        <label for="gambar" class="form-label me-2">
                                            <img src="
                                            @if($editgambar != null)
                                            {{ $editgambar->temporaryUrl() }}    
                                            @else
                                            {{ $gambar->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar->img)) }}
                                            @endif
                                            "
                                            class="" width="65" height="65" />
                                        </label>
                                        <div class="w-100">
                                            <label for="gambar" class="form-label mb-0">
                                                <div class="">
                                                    Gambar {{ $gambar->no }} <span class="text-muted">(optional)</span>
                                                </div>
                                            </label>
                                            <input wire:model='editgambar'
                                                class="form-control mt-0 @error('gambar') is-invalid @enderror"
                                                type="file" id="gambar">
                                            @error('gambar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="gambar">Uploading...</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="d-flex justify-content-start align-items-start">
                                        <label for="gambar2" class="form-label me-2">
                                            <img src="
                                            @if($editgambar2 != null)
                                            {{ $editgambar2->temporaryUrl() }}    
                                            @else
                                            {{ $gambar2->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar2->img)) }}
                                            @endif
                                            "
                                            class="" width="65" height="65" />
                                        </label>
                                        <div class="w-100">
                                            <label for="gambar2" class="form-label mb-0">
                                                <div class="">
                                                    Gambar {{ $gambar2->no }} <span class="text-muted">(optional)</span>
                                                </div>
                                            </label>
                                            <input wire:model='editgambar2'
                                                class="form-control mt-0 @error('gambar2') is-invalid @enderror"
                                                type="file" id="gambar2">
                                            @error('gambar2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="gambar2">Uploading...</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="d-flex justify-content-start align-items-start">
                                        <label for="gambar3" class="form-label me-2">
                                            <img src="
                                            @if($editgambar3 != null)
                                            {{ $editgambar3->temporaryUrl() }}    
                                            @else
                                            {{ $gambar3->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar3->img)) }}
                                            @endif
                                            "
                                            class="" width="65" height="65" />
                                        </label>
                                        <div class="w-100">
                                            <label for="gambar3" class="form-label mb-0">
                                                <div class="">
                                                    Gambar3 {{ $gambar3->no }} <span class="text-muted">(optional)</span>
                                                </div>
                                            </label>
                                            <input wire:model='editgambar3'
                                                class="form-control mt-0 @error('gambar3') is-invalid @enderror"
                                                type="file" id="gambar3">
                                            @error('gambar3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="gambar3">Uploading...</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="d-flex justify-content-start align-items-start">
                                        <label for="gambar4" class="form-label me-2">
                                            <img src="
                                            @if($editgambar4 != null)
                                            {{ $editgambar4->temporaryUrl() }}    
                                            @else
                                            {{ $gambar4->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar4->img)) }}
                                            @endif
                                            "
                                            class="" width="65" height="65" />
                                        </label>
                                        <div class="w-100">
                                            <label for="gambar4" class="form-label mb-0">
                                                <div class="">
                                                    Gambar4 {{ $gambar4->no }} <span class="text-muted">(optional)</span>
                                                </div>
                                            </label>
                                            <input wire:model='editgambar4'
                                                class="form-control mt-0 @error('gambar4') is-invalid @enderror"
                                                type="file" id="gambar4">
                                            @error('gambar4')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="gambar4">Uploading...</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="d-flex justify-content-start align-items-start">
                                        <label for="gambar5" class="form-label me-2">
                                            <img src="
                                            @if($editgambar5 != null)
                                            {{ $editgambar5->temporaryUrl() }}    
                                            @else
                                            {{ $gambar5->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar5->img)) }}
                                            @endif
                                            "
                                            class="" width="65" height="65" />
                                        </label>
                                        <div class="w-100">
                                            <label for="gambar5" class="form-label mb-0">
                                                <div class="">
                                                    Gambar5 {{ $gambar5->no }} <span class="text-muted">(optional)</span>
                                                </div>
                                            </label>
                                            <input wire:model='editgambar5'
                                                class="form-control mt-0 @error('gambar5') is-invalid @enderror"
                                                type="file" id="gambar5">
                                            @error('gambar5')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="gambar5">Uploading...</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="d-flex justify-content-start align-items-start">
                                        <label for="gambar6" class="form-label me-2">
                                            <img src="
                                            @if($editgambar6 != null)
                                            {{ $editgambar6->temporaryUrl() }}    
                                            @else
                                            {{ $gambar6->img == null ? asset('imagenotfound.jpg') : asset(Storage::url($gambar6->img)) }}
                                            @endif
                                            "
                                            class="" width="65" height="65" />
                                        </label>
                                        <div class="w-100">
                                            <label for="gambar6" class="form-label mb-0">
                                                <div class="">
                                                    Gambar6 {{ $gambar6->no }} <span class="text-muted">(optional)</span>
                                                </div>
                                            </label>
                                            <input wire:model='editgambar6'
                                                class="form-control mt-0 @error('gambar6') is-invalid @enderror"
                                                type="file" id="gambar6">
                                            @error('gambar6')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="gambar6">Uploading...</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <label for="nama">Nama</label>
                                    <input id="nama" type="text" wire:model.lazy='nama'
                                        class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="barcode">Barcode/Kode barang (optional)</label>
                                    <input id="barcode" type="text" wire:model.lazy='barcode'
                                        class="form-control @error('barcode') is-invalid @enderror">
                                    @error('barcode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mt-2">
                                    <label for="kategori">Kategori</label>
                                    <select wire:model='produk_kategori_id' id="kategori" class="form-control">
                                        <option value="">Pilih kategori</option>
                                        @forelse ($kategori as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @empty
                                            not found
                                        @endforelse
                                    </select>
                                </div>

                                <div class="mt-2">
                                    <label for="merek">Merek (optional)</label>
                                    <select wire:model='produk_merek_id' id="merek" class="form-control">
                                        <option value="">Pilih merek</option>
                                        @forelse ($merek as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @empty
                                            not found
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <label for="harga_jual">Harga_jual</label>
                                    <input id="harga_jual" type="number" wire:model.lazy='harga_jual'
                                        class="form-control @error('harga_jual') is-invalid @enderror">
                                    @error('harga_jual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="harga_modal">Harga modal (optional)</label>
                                    <input id="harga_modal" type="number" wire:model.lazy='harga_modal'
                                        class="form-control @error('harga_modal') is-invalid @enderror">
                                    @error('harga_modal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="berat_kg">Berat produk per kg (optional)</label>
                                    <input id="berat_kg" type="number" wire:model.lazy='berat_kg'
                                        class="form-control @error('berat_kg') is-invalid @enderror">
                                    @error('berat_kg')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="deskripsi">Deskripsi Produk <span class="text-muted">(bisa sisipkan
                                            &lt;br&gt; untuk enter)</span></label>
                                    <textarea placeholder="isi deskripsi produk" class="form-control @error('deskripsi') is-invalid @enderror"
                                        wire:model.lazy='deskripsi' id="deskripsi" cols="30" rows="7"></textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success form-control">
                                        Ubah produk
                                    </button>

                                </div>
                            </form>
                            <button wire:click='tutup' class="btn mt-2 btn-light form-control">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-sm">
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
                                <th style="width: 11%">aksi</th>
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
                                            @if($gambar->img == null)
                                            <img width="60px" height="60"
                                            src="{{ asset('imagenotfound.jpg') }}" alt="">
                                                @else
                                                <img width="60px" height="60"
                                                src="{{ asset(Storage::url($gambar->img)) }}" alt="">
                                            @endif
                                            @endif
                                        @endforeach
                                    </th>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->kategori->nama }}</td>
                                    <td>{{ $data->merek->nama }}</td>
                                    <td>@uang($data->harga_modal)</td>
                                    <td>@uang($data->harga_jual)</td>
                                    <td style="color: green">@uang($data->harga_jual - $data->harga_modal)</td>
                                    <td>
                                        <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                            wire:click="ubahstatus({{ $data->id }})" type="button"
                                            class="btn btn-sm text-white rounded-pill {{ $data->istersedia == true ? 'btn-success' : 'btn-danger' }}">
                                            {{ $data->istersedia == true ? 'tersedia' : 'tidak tersedia' }}
                                        </button>
                                    </td>
                                    <td>
                                        <button wire:click="editform('{{ $data->id }}')"
                                            class="btn btn-sm rounded-pill text-white btn-warning">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                tidak ada data
                            @endforelse
                        </tbody>
                    </table>
                    @if ($take <= $jmlproduk)
                        <center>
                            <button class="btn btn-light shadow-sm form-control rounded-pill">Lanjut</button>
                        </center>
                    @endif
                </div>
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
