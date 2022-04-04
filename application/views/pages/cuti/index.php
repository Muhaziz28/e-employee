<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-warning font-weight-bold">Daftar Cuti Pegawai</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
            
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url("cuti") ?>"></a>Cuti</li>
        </ol>
    </div>

    <!-- Row -->
    <?php $this->load->view('pages/cuti/table'); ?>
    <!--Row-->






</div>