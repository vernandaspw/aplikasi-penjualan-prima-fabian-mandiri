<div>

    @if($page == 1)
    pesanan
    @elseif($page == 2)
    beranda
    @else
    <livewire:konsumen.beranda-konsumen />
    @endif


    <nav class="p-0 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: orange">
        <ul class="py-1 navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="javascript:void(0)" wire:click='beranda'
                    class="nav-link {{ $page == 0 ? 'active' : '' }} text-center">
                    <span class="small d-block" style="font-size: 13px">
                        Beranda
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" wire:click='pesanan'
                    class="nav-link {{ $page == 1 ? 'active' : '' }} text-center">
                    <span class="small d-block" style="font-size: 13px">
                        Pesanan
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" wire:click='akun'
                    class="nav-link {{ $page == 2 ? 'active' : '' }} text-center">
                    <span class="small d-block" style="font-size: 13px">
                        Akun
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</div>
