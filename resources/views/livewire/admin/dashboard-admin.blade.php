<div>
    <livewire:admin.component.navbar-admin />

    <div class="container mt-3">

        <div class="row">
            <div class="col-md-6">
                <livewire:admin.component.grafik-cashflow-pie />
            </div>
            <div class="col-md-6">
                <livewire:admin.component.grafik-cashflow-bar />
            </div>
        </div>

        @if (auth('pegawai')->user()->role != 'logistik' )
        <hr>
            <div class="row mt-2">
                <div class="col-lg-3 mb-2">
                    <a href="{{ url('admin/data-konsumen') }}" class="text-decoration-none">
                        <div class="card shadow border-0 text-white" style="background-color: {{ env('COLOR_PRIMARY') }}">
                            <div class="card-header">
                                Jumlah Konsumen
                            </div>
                            <div class="card-body">
                                 {{ $jml_konsumen }}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 mb-2">
                    <div class="card shadow border-0 text-white" style="background-color: {{ env('COLOR_PRIMARY') }}">
                        <div class="card-header">
                            Total produk
                        </div>
                        <div class="card-body">
                             {{ $jml_produk }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <div class="card shadow border-0 text-white" style="background-color: {{ env('COLOR_PRIMARY') }}">
                        <div class="card-header">
                            Total penjualan
                        </div>
                        <div class="card-body">
                             {{ $jml_penjualan }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <div class="card shadow border-0 text-white" style="background-color: {{ env('COLOR_PRIMARY') }}">
                        <div class="card-header">
                            Total transaksi
                        </div>
                        <div class="card-body">
                             {{ $jml_transaksi }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>


</div>
