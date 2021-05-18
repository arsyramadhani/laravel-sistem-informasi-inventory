<li class="nav-header">Data Master</li>
<li class="nav-item">
    <a href="{{ route('product.index') }}"
        class="nav-link {{ (request()->is('product*')) ? 'active' : '' }}">
        <i class="fas fa-box nav-icon   "></i>
        <p>Data Barang</p>
    </a>
</li>
<li class="nav-header">Menu</li>
<x-navitem to="{{ route('receive.index') }}"
    active="{{ (request()->is('receive*')) ? 'active' : '' }}"
    icon="fas fa-clipboard-check" judul="Terima Barang" />
<x-navitem to="{{ route('refund.index') }}"
    active="{{ (request()->is('refund*')) ? 'active' : '' }}"
    icon="fas fa-trash-restore-alt" judul="Retur Pembelian" />