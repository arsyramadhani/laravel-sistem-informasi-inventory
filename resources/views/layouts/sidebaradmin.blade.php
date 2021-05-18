                <li class="nav-header">Data Master</li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}"
                        class="nav-link {{ (request()->is('product*')) ? 'active' : '' }}">
                        <i class="fas fa-box nav-icon   "></i>
                        <p>Data Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}"
                        class="nav-link {{ (request()->is('supplier*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-warehouse    "></i>
                        <p>Data Supplier</p>
                    </a>
                </li>
                <li class="nav-header">Menu</li>
                <x-navitem
                    to="{{ route('product.stokhabis') }}"
                    active="{{ (request()->is('stokhabis*')) ? 'active' : '' }}"
                    icon="fas fa-box-open"
                    judul="Stok Habis"
                />
                <x-navitem
                    to="{{ route('product.kadaluwarsa') }}"
                    active="{{ (request()->is('kadaluwarsa*')) ? 'active' : '' }}"
                    icon="fas fa-archive"
                    judul="Stok Kadaluwarsa"
                />
                <x-navitem
                    to="{{ route('order.index') }}"
                    active="{{ (request()->is('order*')) ? 'active' : '' }}"
                    icon="fas fa-scroll"
                    judul="Pesanan Pembelian"
                />
                <x-navitem
                    to="{{ route('refund.index') }}"
                    active="{{ (request()->is('refund*')) ? 'active' : '' }}"
                    icon="fas fa-trash-restore-alt"
                    judul="Retur Pembelian"
                />
                <li class="nav-header">Laporan</li>
                <x-navitem
                    to="{{ route('laporan.penjualan') }}"
                    active="{{ (request()->is('laporan/penjualan*')) ? 'active' : '' }}"
                    icon="fas fa-file-alt"
                    judul="Laporan Penjualan"
                />
                <x-navitem
                    to="{{ route('laporan.stok') }}"
                    active="{{ (request()->is('laporan/stok*')) ? 'active' : '' }}"
                    icon="fas fa-file-alt"
                    judul="Laporan Stok"
                />
                <x-navitem
                    to="{{ route('laporan.obatkeluar') }}"
                    active="{{ (request()->is('laporan/obatkeluar*')) ? 'active' : '' }}"
                    icon="fas fa-file-alt"
                    judul="Laporan Obat Keluar"
                />
                <x-navitem
                    to="{{ route('laporan.obatmasuk') }}"
                    active="{{ (request()->is('laporan/obatmasuk*')) ? 'active' : '' }}"
                    icon="fas fa-file-alt"
                    judul="Laporan Obat Masuk"
                />
                <x-navitem
                    to="{{ route('laporan.obatkeras') }}"
                    active="{{ (request()->is('laporan/obatkeras*')) ? 'active' : '' }}"
                    icon="fas fa-file-alt"
                    judul="Lap. Keluar Masuk Obat"
                />