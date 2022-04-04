<div class="wadahActivityPegawai">
    <?php
    $image = $pegawai->image;

    ?>

    <div id="result">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-4 mt-3">
                    <div class="text-center">
                        <img src="<?= isset($image) && $image != '' ? base_url("images/pegawai/$image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" style="width: 200px; margin-top: -10px;" class="card-img rounded-circle img-pegawai" alt="...">
                        <h4 class="mt-3" id="nama_profile_pegawai_2"><?= $pegawai->nama; ?></h4>
                        <p><?= $pegawai->email; ?></p>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>NIP</td>
                                <td>:</td>
                                <td><?= $pegawai->nip; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><span id="nama_profile_pegawai"><?= $pegawai->nama; ?></span></td>
                            </tr>
                            <tr>
                                <td>Divisi</td>
                                <td>:</td>
                                <td><?= $pegawai->nama_divisi; ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><?= $pegawai->nama_jabatan; ?></td>
                            </tr>





                        </table>
                    </div>
                </div>

            </div>
        </div>






    </div>









</div>
<?php if ($this->session->userdata('nip') == $pegawai->nip) : ?>
    <a href="#" class="btn btn-primary ml-3" id="btnTambahAktivitat" data-nip="<?= $this->session->userdata('nip'); ?>" data-toggle="modal" data-target="#modalAddActivity"><i class="fas fa-plus mr-2"></i>Aktivitas</a>
    <a href="<?= base_url("activity/export-to-excel?nip_pegawai=$pegawai->nip"); ?>" class="btn btn-success" id="btnExportAktivitas"><i class="fas fa-file-excel mr-2"></i>Export to Excel</a>
<?php else : ?>
    <a href="<?= base_url("activity/export-to-excel?nip_pegawai=$pegawai->nip"); ?>" class="btn btn-success ml-3" id="btnExportAktivitas"><i class="fas fa-file-excel mr-2"></i>Export to Excel</a>
<?php endif ?>
<!-- <a href="#" class="btn btn-primary ml-3" id="btnTambahAktivitat" data-nip="<?= $this->session->userdata('nip'); ?>" data-toggle="modal" data-target="#modalAddActivity"><i class="fas fa-plus mr-2"></i>Aktivitas</a> -->
<div class="table-responsive p-3 table-aktivitas-space">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover" id="dataTableAktivitas">
        <thead class="thead-light">
            <tr>
                <th>Tanggal</th>
                <th>Aktivitas</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Realisasi</th>
                <th>Target</th>

            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($content as $row) : ?>
                <tr id="data-<?= $row->id; ?>">
                    <td class="tanggal-aktivitas" style="width: 8%;"><?= date_format(new DateTime($row->tanggal), 'd/m/Y'); ?></td>
                    <td class="isi-aktivitas"><?= $row->aktivitas; ?></td>
                    <td class="mulai-aktivitas" style="width: 1%;"><?= date_format(new DateTime($row->mulai), 'H:i'); ?></td>
                    <td class="selesai-aktivitas" style="width: 1%;"><?= date_format(new DateTime($row->selesai), 'H:i'); ?></td>
                    <td class="realisasi-aktivitas"><?= $row->realisasi; ?></td>
                    <td class="target-aktivitas"><?= $row->target == "" ? "-" : $row->target; ?></td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>