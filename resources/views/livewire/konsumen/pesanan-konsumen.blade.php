<div>
    @if ($transaksi == 'login')
        <livewire:konsumen.login-konsumen />
    @else
        <nav class="p-2 navbar navbar-dark navbar-expand fixed-top shadow-sm"
            style="background-color: {{ env('COLOR_PRIMARY') }}">
            <div class="container-fluid">
                <ul class="navbar-nav me-2 form-control w-full align-items-centar bg-white p-1 rounded">
                    <li class="nav-item me-2 ms-1 ">
                        <span class="text-white">
                            <img src="{{ asset('logo.png') }}" width="20px" alt="">
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="text-white">
                        </span>
                    </li>
                    <input class="form-control rounded border border-right-0 border-1 p-1" type="cariproduk"
                        placeholder="cari no transaksi" aria-label="cariproduk">
                </ul>
                <ul class="navbar-nav ms-auto  w-full align-items-start">
                    <li class="nav-item">
                        <a class="shadow-m px-3" href="{{ url('keranjang') }}"><img src="{{ asset('cart.svg') }}"
                                alt=""></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="body" style="padding-top: 70px; padding-bottom: 65px;">
            Pesanan
        </div>
    @endif
</div>
