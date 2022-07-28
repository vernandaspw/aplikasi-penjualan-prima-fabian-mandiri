<div>
    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <ul class="py-0 navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">

                {{-- <div class="nav-link  {{ Request::is('/') == '/' ? 'active' : '' }} text-center">
                    <img src="{{ asset('icon_home.png') }}" class="mb-0 pb-0" alt=""
                        style=" {{ Request::is('/') == '/' ? 'width: 21px' : 'width: 15px' }}">
                    <span class="small d-block" style="font-size: 11px">
                        Beranda
                    </span>
                </div> --}}

                <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') == '/' ? 'active' : '' }} text-center">
                    <img src="{{ asset('icon_home.png') }}" class="mb-0 pb-0" alt=""
                        style=" {{ Request::is('/') == '/' ? 'active' : 'width: 15px' }}">
                    <span class="small d-block" style="font-size: 11px">
                        Beranda
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/pesanan') }}"
                    class="nav-link {{ Request::is('/pesanan') == '/pesanan' ? 'active' : '' }} text-center">
                    <img src="{{ asset('icon_order.png') }}" class="mb-0 pb-0" alt=""
                        style=" {{ Request::is('/pesanan') == '/pesanan' ? 'active' : 'width: 15px' }}">
                    <span class="small d-block" style="font-size: 11px">
                        Pesanan
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/akun') }}"
                    class="nav-link {{ Request::is('/akun') == '/akun' ? 'active' : '' }} text-center">
                    <img src="{{ asset('icon_person.png') }}" class="mb-0 pb-0" alt=""
                        style=" {{ Request::is('/akun') == '/akun' ? 'active' : 'width: 15px' }}">
                    <span class="small d-block" style="font-size: 11px">
                        Akun
                    </span>
                </a>

            </li>
        </ul>
    </nav>
</div>
