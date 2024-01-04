<div id="sidebar-menu">

    <ul class="metismenu" id="side-menu">

        <li class="menu-title">Navigation</li>

        <li>
            <a href="<?= site_url('admin') ?>">
                <i class="ti-home"></i>
                <span> Dashboard </span>
            </a>
        </li>

        <li>
            <a href="<?= site_url('kategori') ?>">
                <i class="ti-package"></i>
                <span> Kategori </span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('admin/produk') ?>">
                <i class="fas fa-box"></i>
                <span> Produk </span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('admin/stock') ?>">
                <i class="mdi mdi-layers-triple"></i>
                <span> Stock </span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('settings?page=pengaturan_toko') ?>">
                <i class="fas fa-cog"></i>
                <span> Settings </span>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);">
                <i class="fab fa-whatsapp"></i>
                <span> Whatsapp Gateway</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><a href="<?= site_url('admin/wa_gateway') ?>">Setting</a></li>
                <li><a href="<?= site_url('admin/wa_gateway/auto_reply') ?>">Pesan BOT</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);">
                <i class="ti-light-bulb"></i>
                <span> Components </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><a href="<?= site_url('admin/hero_section') ?>">Hero Section</a></li>
            </ul>
        </li>


    </ul>

</div>