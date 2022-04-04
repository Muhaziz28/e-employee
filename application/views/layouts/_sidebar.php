<?php $role = $this->session->userdata('role'); ?>
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url("assets") ?>/img/logo/logo_white_soraya.png">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 13px;">E-Employee</div>
    </a>
    <?php if ($role != 'hrd') : ?>
        <hr class="sidebar-divider my-0">
        <li class="nav-item <?= $nav_title == "home" ? "active" : "" ?>">
            <a class="nav-link" href="<?= base_url("home"); ?>">
                <i class="fas fa-home"></i>
                <span>Home</span></a>
        </li>
    <?php endif ?>
    <?php if ($role == 'hrd') : ?>
        <li class="nav-item <?= $nav_title == "dashboard" ? "active" : "" ?>">
            <a class="nav-link" href="<?= base_url("dashboard"); ?>">
                <i class="far fa-chart-bar"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
    <?php endif ?>

    <?php if ($role == 'leader_finance' || $role == 'leader' || $role == 'leader_toko') : ?>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Main
        </div>
        <li class="nav-item <?= $nav_title == "aktivitas" ? "active" : "" ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAktivitas" aria-expanded="true" aria-controls="collapseAktivitas">
                <i class="fas fa-laptop"></i>
                <span>Aktivitas Pegawai</span>
            </a>
            <div id="collapseAktivitas" class="collapse <?= $nav_title == "aktivitas" ? "show" : "" ?>"" aria-labelledby=" headingAktivitas" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Aktivitas</h6>
                    <a class="collapse-item <?= $detail_title == "aktivitas" ? "active" : "" ?>" href="<?= base_url("activity"); ?>">Lihat Aktivitas</a>
                    <a class="collapse-item <?= $detail_title == "rekap_aktivitas" ? "active" : "" ?>" href="<?= base_url("activity/rekap"); ?>">Rekap Pengisian Aktivitas</a>



                </div>
            </div>
        </li>
    <?php endif ?>

    <?php if ($role == 'hrd') : ?>

        <div class="sidebar-heading">
            Main
        </div>
        <li class="nav-item <?= $nav_title == "pegawai" ? "active" : "" ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="fas fa-user-friends"></i>
                <span>Pegawai</span>
            </a>
            <div id="collapseBootstrap" class="collapse <?= $nav_title == "pegawai" ? "show" : "" ?>"" aria-labelledby=" headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pegawai</h6>
                    <a class="collapse-item <?= $detail_title == "pegawai" ? "active" : "" ?>" href="<?= base_url("pegawai"); ?>">Data Pegawai</a>
                    <a class="collapse-item <?= $detail_title == "tambah_pegawai" ? "active" : "" ?>" href="<?= base_url("pegawai/add"); ?>">Tambah Pegawai</a>
                    <a class="collapse-item <?= $detail_title == "pegawai_out" ? "active" : "" ?>" href="<?= base_url("pegawai/out"); ?>">Data Pegawai Out</a>

                </div>
            </div>
        </li>

        <li class="nav-item <?= $nav_title == "cuti" ? "active" : "" ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCutip" aria-expanded="true" aria-controls="collapseCutip">
                <i class="fas fa-list-ul"></i>
                <span>Cuti Pegawai</span>
            </a>
            <div id="collapseCutip" class="collapse <?= $nav_title == "cuti" ? "show" : "" ?>"" aria-labelledby=" headingCutip" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Cuti</h6>
                    <a class="collapse-item <?= $detail_title == "cuti" ? "active" : "" ?>" href="<?= base_url("cuti"); ?>">Daftar Cuti</a>
                    <a class="collapse-item <?= $detail_title == "potong_cuti" ? "active" : "" ?>" href="<?= base_url("cuti/potong"); ?>">Potong Cuti</a>
                    <a class="collapse-item <?= $detail_title == "riwayat_potong_cuti" ? "active" : "" ?>" href="<?= base_url("cuti/riwayat_potong_cuti"); ?>">Riwayat Pemotongan Cuti</a>


                </div>
            </div>
        </li>

        <li class="nav-item <?= $nav_title == "gaji" ? "active" : "" ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGaji" aria-expanded="true" aria-controls="collapseGaji">
                <i class="fas fa-money-check-alt"></i>
                <span>Gaji</span>
            </a>
            <div id="collapseGaji" class="collapse <?= $nav_title == "gaji" ? "show" : "" ?>"" aria-labelledby=" headingGaji" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gaji</h6>
                    <!-- <a class="collapse-item <?= $detail_title == "gaji" ? "active" : "" ?>" href="<?= base_url("cuti"); ?>">Daftar Cuti</a> -->
                    <a class="collapse-item <?= $detail_title == "daftar_gaji" ? "active" : "" ?>" href="<?= base_url("gaji"); ?>">Daftar Gaji</a>
                    <a class="collapse-item <?= $detail_title == "perubahan_gaji" ? "active" : "" ?>" href="<?= base_url("gaji/riwayat_perubahan_gaji"); ?>">Riwayat Perubahan Gaji</a>
                    <a class="collapse-item <?= $detail_title == "slip_gaji" ? "active" : "" ?>" href="<?= base_url("gaji/slip"); ?>">Tambah Slip Gaji</a>
                    <a class="collapse-item <?= $detail_title == "view_slip_gaji" ? "active" : "" ?>" href="<?= base_url("gaji/view_slip_gaji"); ?>">Lihat Slip Gaji</a>



                </div>
            </div>
        </li>

        <li class="nav-item <?= $nav_title == "kpi" ? "active" : "" ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKpi" aria-expanded="true" aria-controls="collapseKpi">
                <i class="fas fa-pen-alt"></i>
                <span>KPI</span>
            </a>
            <div id="collapseKpi" class="collapse <?= $nav_title == "kpi" ? "show" : "" ?>"" aria-labelledby=" headingKpi" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">KPI</h6>
                    <a class="collapse-item <?= $detail_title == "daftar_kpi" ? "active" : "" ?>" href="<?= base_url("kpi"); ?>">Daftar Nilai KPI</a>
                    <a class="collapse-item <?= $detail_title == "tambah_kpi" ? "active" : "" ?>" href="<?= base_url("kpi/nilai"); ?>">Tambah Nilai KPI</a>



                </div>
            </div>
        </li>

        <li class="nav-item <?= $nav_title == "aktivitas" ? "active" : "" ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAktivitas" aria-expanded="true" aria-controls="collapseAktivitas">
                <i class="fas fa-laptop"></i>
                <span>Aktivitas Pegawai</span>
            </a>
            <div id="collapseAktivitas" class="collapse <?= $nav_title == "aktivitas" ? "show" : "" ?>"" aria-labelledby=" headingAktivitas" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Aktivitas</h6>
                    <a class="collapse-item <?= $detail_title == "aktivitas" ? "active" : "" ?>" href="<?= base_url("activity"); ?>">Lihat Aktivitas</a>
                    <a class="collapse-item <?= $detail_title == "rekap_aktivitas" ? "active" : "" ?>" href="<?= base_url("activity/rekap"); ?>">Rekap Pengisian Aktivitas</a>



                </div>
            </div>
        </li>

        <!-- <li class="nav-item <?= $nav_title == "aktivitas" ? "active" : "" ?>">
            <a class="nav-link" href="<?= base_url("activity") ?>">
                <i class="fas fa-laptop"></i>
                <span>Aktivitas Pegawai</span>
            </a>
        </li> -->

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Data
        </div>

        <li class="nav-item <?= $nav_title == "divisi" ? "active" : "" ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
                <i class="fas fa-briefcase"></i>
                <span>Divisi</span>
            </a>
            <div id="collapseForm" class="collapse <?= $nav_title == "divisi" ? "show" : "" ?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Divisi</h6>
                    <a class="collapse-item <?= $detail_title == "divisi" ? "active" : "" ?>" href="<?= base_url("divisi"); ?>">Daftar Divisi</a>
                    <a class="collapse-item" id="btnTambahDivisi" href="#">Tambah Divisi</a>
                </div>
            </div>
        </li>
        <li class="nav-item <?= $nav_title == "jabatan" ? "active" : "" ?>">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
                <i class="fas fa-user-tie"></i>
                <span>Jabatan</span>
            </a>
            <div id="collapseTable" class="collapse <?= $nav_title == "jabatan" ? "show" : "" ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Jabatan</h6>
                    <a class="collapse-item <?= $detail_title == "jabatan" ? "active" : "" ?>" href="<?= base_url("jabatan"); ?>">Data Jabatan</a>
                    <a class="collapse-item" id="btnTambahJabatan" href="#">Tambah Jabatan</a>
                </div>
            </div>
        </li>
        <li class="nav-item <?= $nav_title == "level" ? "active" : "" ?>">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseLevel" aria-expanded="true" aria-controls="collapseTable">
                <i class="fas fa-layer-group"></i>
                <span>Level</span>
            </a>
            <div id="collapseLevel" class="collapse <?= $nav_title == "level" ? "show" : "" ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Level</h6>
                    <a class="collapse-item <?= $detail_title == "level" ? "active" : "" ?>" href="<?= base_url("level"); ?>">Data Level</a>
                    <a class="collapse-item" id="btnTambahLevel" href="#">Tambah Level</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?= $nav_title == "lokasi" ? "active" : "" ?>">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseLokasi" aria-expanded="true" aria-controls="collapseTable">
                <i class="fas fa-map-marked-alt"></i>
                <span>Lokasi</span>
            </a>
            <div id="collapseLokasi" class="collapse <?= $nav_title == "lokasi" ? "show" : "" ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Lokasi</h6>
                    <a class="collapse-item <?= $detail_title == "lokasi" ? "active" : "" ?>" href="<?= base_url("lokasi"); ?>">Data Lokasi</a>
                    <a class="collapse-item" id="btnTambahLokasi" href="#">Tambah Lokasi</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Report
        </div>
        <li class="nav-item <?= $nav_title == "report" ? "active" : "" ?>">
            <a class="nav-link" href="<?= base_url("report") ?>">
                <i class="fas fa-file-alt"></i>
                <span>Laporan Pegawai In Out</span>
            </a>
        </li>
    <?php endif ?>

    <?php if ($role == 'pegawai') : ?>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Activity
        </div>
        <li class="nav-item <?= $nav_title == "aktivitas" ? "active" : "" ?>">
            <a class="nav-link" href="<?= base_url("activity") ?>">
                <i class="fas fa-laptop"></i>
                <span>Aktivitas Saya</span>
            </a>
        </li>
    <?php endif ?>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Profile
    </div>
    <li class="nav-item <?= $nav_title == "profile" ? "active" : "" ?>">
        <a class="nav-link" href="<?= base_url("profile") ?>">
            <i class="fas fa-user"></i>
            <span>My Profile</span>
        </a>
    </li>

    <?php if ($role != 'hrd') : ?>
        <li class="nav-item <?= $nav_title == "history_potong_cuti" ? "active" : "" ?>">
            <a class="nav-link" href="<?= base_url("cuti/history_potong_cuti"); ?>">
                <i class="fas fa-cut"></i>
                <span>Riwayat Potong Cuti</span>
            </a>
        </li>
    <?php endif ?>
    <hr class="sidebar-divider">

    <div class="version" id="version-ruangadmin"></div>
</ul>