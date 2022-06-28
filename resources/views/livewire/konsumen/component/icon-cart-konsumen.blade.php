<div>
    <div class="d-flex align-items-center">
        <a wire:poll class="shadow-m mx-2  position-relative" href="{{ url('keranjang') }}">
            <img src="{{ asset('cart.svg') }}" height="25px"
            alt="">
        @if ($jml_itemcart)
            <span style="font-size: 10px" class="position-absolute top-0 start-100 text-dark translate-middle badge rounded-pill bg-white">
                {{ $jml_itemcart }}
                <span class="visually-hidden">unread messages</span>
            </span>
        @endif
    </a>
    </div>
</div>
