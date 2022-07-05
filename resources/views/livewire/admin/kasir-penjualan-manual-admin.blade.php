<div>
    <livewire:admin.component.navbar-admin />

    <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav d-flex justify-content-between w-100 align-items-center">
            <li class="nav-item text-white">
                
                <a style="font-weight: bold; color:white;" href="{{ url('admin/kasir-detail', $kasir->id) }}" class="nav-link text-white text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        <span><b>{{ $kasir->nama }}</b></span>
                        |
                        <span>Kas @uang($kasir->kas)</span>  (lihat)
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/kasir') }}" class="nav-link btn rounded-pill btn-sm btn-danger text-white text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        Ganti kasir
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="p-1 navbar navbar-dark navbar-expand  shadow-sm" style="background-color: orange;">
        <ul class="navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="{{ url('admin/kasir-penjualan-produk', $kasir->id) }}" class="nav-link  text-center">
                    <span class="small d-block" style="font-size: 14px; ">
                        Produk
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/kasir-penjualan-manual', $kasir->id) }}" class="nav-link active text-center">
                    <span class="small d-block" style="font-size: 14px; font-weight: bold; color:white;">
                        Manual
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container mt-3 mb-5">
        da
    </div>
</div>
