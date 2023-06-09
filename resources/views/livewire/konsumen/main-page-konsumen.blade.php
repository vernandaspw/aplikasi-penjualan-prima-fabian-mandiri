<div>

    @if ($page == 0)
        <livewire:konsumen.beranda-konsumen />
    @elseif ($page == 1)
        <livewire:konsumen.pesanan-konsumen />
    @elseif($page == 2)
        <livewire:konsumen.akun-konsumen />
    @else
        <livewire:konsumen.beranda-konsumen />
    @endif


    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg"
        style="background-color: {{ env('COLOR_PRIMARY') }}">
        <ul class="py-0 navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                @if ($page == 0)
                    <div class="nav-link {{ $page == 0 ? 'active' : '' }} text-center">
                        <img src="{{ asset('icon_home.png') }}" class="mb-0 pb-0" alt=""
                            style=" {{ $page == 0 ? 'width: 21px' : 'width: 15px' }}">
                        <span class="small d-block" style="font-size: 11px">
                            Beranda
                        </span>
                    </div>
                @else
                    <a href="javascript:void(0)" wire:click.prefetch='beranda'
                        class="nav-link {{ $page == 0 ? 'active' : '' }} text-center">
                        <img src="{{ asset('icon_home.png') }}" class="mb-0 pb-0" alt=""
                            style=" {{ $page == 0 ? 'width: 21px' : 'width: 15px' }}">
                        <span class="small d-block" style="font-size: 11px">
                            Beranda
                        </span>
                    </a>
                @endif
            </li>
            <li class="nav-item">
                @if ($page == 1)
                    <div class="nav-link {{ $page == 1 ? 'active' : '' }} text-center">
                        <img src="{{ asset('icon_order.png') }}" class="mb-0 pb-0" alt=""
                            style=" {{ $page == 1 ? 'width: 21px' : 'width: 15px' }}">
                        <span class="small d-block" style="font-size: 11px">
                            Pesanan
                        </span>
                    </div>
                @else
                    <a href="javascript:void(0)" wire:click.prefetch='pesanan'
                        class="nav-link {{ $page == 1 ? 'active' : '' }} text-center">
                        <img src="{{ asset('icon_order.png') }}" class="mb-0 pb-0" alt=""
                            style=" {{ $page == 1 ? 'width: 21px' : 'width: 15px' }}">
                        <span class="small d-block" style="font-size: 11px">
                            Pesanan
                        </span>
                    </a>
                @endif

            </li>
            <li class="nav-item">
                @if ($page == 2)
                    <div class="nav-link {{ $page == 2 ? 'active' : '' }} text-center">
                        <img src="{{ asset('icon_person.png') }}" class="mb-0 pb-0" alt=""
                            style=" {{ $page == 2 ? 'width: 21px' : 'width: 15px' }}">
                        <span class="small d-block" style="font-size: 11px">
                            Akun
                        </span>
                    </div>
                @else
                    <a href="javascript:void(0)" wire:click.prefetch='akun'
                        class="nav-link {{ $page == 2 ? 'active' : '' }} text-center">
                        <img src="{{ asset('icon_person.png') }}" class="mb-0 pb-0" alt=""
                            style=" {{ $page == 2 ? 'width: 21px' : 'width: 15px' }}">
                        <span class="small d-block" style="font-size: 11px">
                            Akun
                        </span>
                    </a>
                @endif
            </li>
        </ul>
    </nav>
</div>


<style>
    .produkcard:hover .card {
        background-color: rgb(228, 228, 228);
        box-shadow: 5px 7px orange;
    }
</style>
