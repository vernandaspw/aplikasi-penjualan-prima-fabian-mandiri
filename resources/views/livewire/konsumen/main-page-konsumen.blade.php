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


    <nav class="p-1 navbar navbar-dark navbar-expand fixed-bottom shadow-lg" style="background-color: {{ env('COLOR_PRIMARY') }}">
        <ul class="py-1 navbar-nav nav-justified w-100 align-items-center">
            <li class="nav-item">
                <a href="javascript:void(0)" wire:click.prefetch='beranda'
                    class="nav-link {{ $page == 0 ? 'active' : '' }} text-center">
                    <span class="small d-block" style="font-size: 13px">
                        Beranda
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" wire:click.prefetch='pesanan'
                    class="nav-link {{ $page == 1 ? 'active' : '' }} text-center">
                    <span class="small d-block" style="font-size: 13px">
                        Pesanan
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" wire:click.prefetch='akun'
                    class="nav-link {{ $page == 2 ? 'active' : '' }} text-center">
                    <span class="small d-block" style="font-size: 13px">
                        Akun
                    </span>
                </a>
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




