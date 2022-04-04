<div class="container-fluid float-left" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-warning font-weight-bold">Rekap Pengisian Aktivitas Harian Pegawai</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url("activity"); ?>">Activity</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url("activity/rekap"); ?>"></a>Rekap Activity</li>
        </ol>
    </div>

    <!-- Row -->
    <div class="row">

        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <!-- <h6 class="m-0 font-weight-bold text-warning">Daftar Divisi</h6> -->
                    <!-- <a href="<?= base_url("cuti/showForm"); ?>" class="btn btn-warning" id="btnTambahCuti">Tambah Data</a> -->
                    <h5 class="m-0 font-weight-bold">Rekap Pengisian Aktivitas periode <?= koversiBlnLengkap(date('M')); ?> <?= date('Y'); ?></h5>
                </div>
                <!-- <div class="list-data-cuti">
                
        </div> -->

                <div class="card-body">
                    <div class="row mt-3 mb-4">
                        <div class="col-lg-6 mx-auto">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>

                                <select class="form-control" id="bulan_filter_rekap_aktivitas" name="bulan">
                                    <option value="">- Pilih Bulan -</option>
                                    <option value="01" <?= date('m') == "01" ? "selected" : "" ?>>Januari</option>
                                    <option value="02" <?= date('m') == "02" ? "selected" : "" ?>>Februari</option>
                                    <option value="03" <?= date('m') == "03" ? "selected" : "" ?>>Maret</option>
                                    <option value="04" <?= date('m') == "04" ? "selected" : "" ?>>April</option>
                                    <option value="05" <?= date('m') == "05" ? "selected" : "" ?>>Mei</option>
                                    <option value="06" <?= date('m') == "06" ? "selected" : "" ?>>Juni</option>
                                    <option value="07" <?= date('m') == "07" ? "selected" : "" ?>>Juli</option>
                                    <option value="08" <?= date('m') == "08" ? "selected" : "" ?>>Agustus</option>
                                    <option value="09" <?= date('m') == "09" ? "selected" : "" ?>>September</option>
                                    <option value="10" <?= date('m') == "10" ? "selected" : "" ?>>Oktober</option>
                                    <option value="11" <?= date('m') == "11" ? "selected" : "" ?>>November</option>
                                    <option value="12" <?= date('m') == "12" ? "selected" : "" ?>>Desember</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 mx-auto">

                            <div class="form-group" id="tahun_filter">

                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Tahun" id="tahun_filter_rekap_aktivitas" name="tahun" autocomplete="off" value="<?= date('Y'); ?>">
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-2 mx-auto">

                            <div class="input-group">
                                <a href="#" class="btn btn-info float-right" id="btnFilterRekapAktivitas"><i class="fas fa-filter mr-2"></i>Filter</a>
                                <a href="#" class="btn btn-secondary float-right ml-3" id="btnResetFilterRekapAktivitas"><i class="fas fa-sync mr-2"></i>Reset</a>
                            </div>
                        </div>


                    </div>
                    <div class="result-rekap-activity">
                        <div class="pt-3 pb-3 pr-3 table-rekap-aktivitas-space">
                            <?php $this->load->view('layouts/_alert'); ?>
                            <table class="table align-items-center table-flush table-hover table-sticky-avt" id="dataTableRekapAktivitas">
                                <thead class="thead-light">
                                    <tr>
                                        <th rowspan="2" class="" style="vertical-align: middle;">Nama Pegawai</th>
                                        <th colspan="<?= $limit_day; ?>" class="text-center">Tanggal</th>


                                    </tr>
                                    <tr class="tangga-row">
                                        <?php for ($i = 1; $i <= $limit_day; $i++) : ?>
                                            <th class="text-center"><?= $i; ?></th>
                                        <?php endfor ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($pegawai as $row) : ?>
                                        <tr>
                                            <td style="background-color: white; border-color: white;"><?= $row->nama; ?></td>
                                            <?php for ($i = 1; $i <= $limit_day; $i++) : ?>
                                                <td class="text-center">
                                                    <?php if ($emp[$row->nip][$i] == 1) : ?>
                                                        <i class="fas fa-check text-success"></i>
                                                    <?php else : ?>
                                                        <i class="fas fa-times text-danger"></i>
                                                    <?php endif ?>
                                                </td>
                                            <?php endfor ?>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--Row-->






    </div>
</div>