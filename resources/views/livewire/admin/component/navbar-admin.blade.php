<div>
    <nav class="navbar navbar-expand-lg navbar-dark d-print-none" style="background-color: {{ env('COLOR_PRIMARY') }}">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('admin') }}">PT. Prima Fabian Mandiri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin') == 'admin' ? 'active' : '' }}" aria-current="page"
                            href="{{ url('admin') }}">Dashboard</a>
                    </li>
                    @if (auth('pegawai')->user()->role == 'administrator')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/kelola-akun') == 'admin/kelola-akun' ? 'active' : '' }}"
                                href="{{ url('admin/kelola-akun') }}">kelola akun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/kelola-pengaturan') == 'admin/kelola-pengaturan' ? 'active' : '' }}"
                                href="{{ url('admin/kelola-pengaturan') }}">kelola pengaturan</a>
                        </li>
                    @endif
                    @if (auth('pegawai')->user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/penjualan/*') == 'admin/penjualan/*' ? 'active' : '' }}"
                                href="{{ url('admin/penjualan/produk') }}">Penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link
                                @if (Request::is('admin/kelola-transaksi-penjualan') == 'admin/kelola-transaksi-penjualan') active @endif
                           "
                                href="{{ url('admin/kelola-transaksi-penjualan') }}">kelola penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/kelola-transaksi-lainnya') == 'admin/kelola-transaksi-lainnya' ? 'active' : '' }}"
                                href="{{ url('admin/kelola-transaksi-lainnya') }}">Kelola transaksi</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/kelola-produk') == 'admin/kelola-produk' ? 'active' : '' }}"
                                href="{{ url('admin/kelola-produk') }}">kelola produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/kelola-stok') == 'admin/kelola-stok' ? 'active' : '' }}"
                                href="{{ url('admin/kelola-stok') }}">kelola stok</a>
                        </li>
                    @endif
                    @if (auth('pegawai')->user()->role == 'logistik')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/pesanan-masuk') == 'admin/pesanan-masuk' ? 'active' : '' }}"
                                href="{{ url('admin/pesanan-masuk') }}">Pesanan masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/proses-antar') == 'admin/proses-antar' ? 'active' : '' }}"
                                href="{{ url('admin/proses-antar') }}">Proses antar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/semua') == 'admin/semua' ? 'active' : '' }}"
                                href="{{ url('admin/semua') }}">Semua</a>
                        </li>
                    @endif
                    @if (auth('pegawai')->user()->role == 'admin')
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Master
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <li><a class="dropdown-item {{ Request::is('admin/metode-pengiriman') == 'admin/metode-pengiriman' ? 'active' : '' }}"
                                        href="{{ url('admin/metode-pengiriman') }}">Metode
                                        Pengiriman</a></li>
                                <li><a class="dropdown-item {{ Request::is('admin/metode-pembayaran') == 'admin/metode-pembayaran' ? 'active' : '' }}"
                                        href="{{ url('admin/metode-pembayaran') }}">Metode
                                        Pembayaran</a></li>
                            </ul>
                        </li> --}}
                    @endif
                    @if (auth('pegawai')->user()->role == 'pimpinan')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <li><a class="dropdown-item {{ Request::is('admin/laporan-penjualan') == 'admin/laporan-penjualan' ? 'active' : '' }}"
                                        href="{{ url('admin/laporan-penjualan') }}">Laporan
                                        penjualan</a></li>
                                <li><a class="dropdown-item {{ Request::is('admin/laporan-keuangan') == 'admin/laporan-keuangan' ? 'active' : '' }}"
                                        href="{{ url('admin/laporan-transaksi') }}">Laporan
                                        transaksi</a></li>
                                <li><a class="dropdown-item {{ Request::is('admin/laporan-produk') == 'admin/laporan-produk' ? 'active' : '' }}"
                                        href="{{ url('admin/laporan-produk') }}">Laporan produk</a>
                                </li>
                                <li><a class="dropdown-item {{ Request::is('admin/laporan-produk') == 'admin/laporan-produk' ? 'active' : '' }}"
                                        href="{{ url('admin/laporan-produk') }}">Laporan produk stok</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth('pegawai')->user()->nama }}({{ auth('pegawai')->user()->role }})
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- <li><a class="dropdown-item" href="#"></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li> --}}
                            <li><button class="dropdown-item text-danger" wire:click='logout'>Logout</button></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
