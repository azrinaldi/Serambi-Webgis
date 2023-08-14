<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <img src="<?php echo base_url('images/logo.png'); ?>" alt="Logo" style="width: 30%; height: auto;">
                    <div style="display: inline-block; vertical-align: top; margin-left: 10px;">
                        <h2 style="margin: 0;">SERAMBI</h2>
                        <h2 style="margin: 0;">WebGIS</h2>
                    </div>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    <a href="/Home" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Beranda</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-map-fill"></i>
                        <span>Administrasi Wilayah</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="/Kecamatan">Kecamatan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/Kelurahan">Kelurahan</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Social Masyarakat</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="/KepadatanPenduduk">Kepadatan Penduduk</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">Bedah Rumah</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">DTKS</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-building"></i>
                        <span>Infrastruktur</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="/Jalan">Jalan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/Bangunan">Bangunan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">Drainase</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">Areal Pertanian</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">Pertokoan</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cash-stack"></i>
                        <span>Ekonomi</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="/PelangganPDAM">Pelanggan Air PDAM</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">Wisata</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">UMKM</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/OnProgress">Potensi Investasi</a>
                        </li>
                    </ul>
                
                <li class="sidebar-item d-flex justify-content-center">
                    <form action="<?= base_url('auth/logout') ?>" method="post">
                        <button type="submit" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i>  Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>