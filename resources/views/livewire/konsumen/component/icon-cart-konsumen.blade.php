<div>
    <a wire:poll class="shadow-m px-3 position-relative" href="{{ url('keranjang') }}"><img src="{{ asset('cart.svg') }}"
            alt="">
        @if ($jml_itemcart)
            <span class="position-absolute top-0 start-100 text-dark translate-middle badge rounded-pill bg-white">
                {{ $jml_itemcart }}
                <span class="visually-hidden">unread messages</span>
            </span>
        @endif
    </a>
</div>
