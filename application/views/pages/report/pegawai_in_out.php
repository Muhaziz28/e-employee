<div class="container-fluid float-left" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-warning font-weight-bold">Laporan Pegawai In Out</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
            <!-- <li class="breadcrumb-item"><a href="<?= base_url("cuti"); ?>">Cuti</a></li> -->
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url("report") ?>"></a>Laporan Pegawai In Out</li>
        </ol>
    </div>

    <!-- Row -->
    <?php $this->load->view('pages/report/content') ?>
    <!--Row-->






</div>