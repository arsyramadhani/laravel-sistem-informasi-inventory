<li class="nav-header">Penjualan</li>
<x-navitem
    to="{{ route('penjualan') }}"
    active="{{ (request()->is('penjualan*')) ? 'active' : '' }}"
    icon="fas fa-cash-register"
    judul="Penjualan Baru"
/>
<x-navitem
    to="{{ route('sale.index') }}"
    active="{{ (request()->is('sale*')) ? 'active' : '' }}"
    icon="fas fa-file-invoice-dollar"
    judul="Daftar Penjualan"
/>