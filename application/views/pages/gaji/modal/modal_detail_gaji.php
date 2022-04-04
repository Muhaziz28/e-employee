<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 frame-pegawai">
                <div class="text-center">
                    <img src="<?= isset($content->image) && $content->image != '' ? base_url("images/pegawai/$content->image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" class="card-img rounded-circle p-2 img-pegawai" alt="pegawai-image">
                    <h5 class="mt-3 font-weight-bold"><?= $content->nama; ?></h5>
                    <p style="margin-top: -10px;"><?= $content->email; ?></p>
                </div>

            </div>
            <div class="col-lg-7 table-data-pegawai">
                <h5 class="mb-4"><strong>Identitas Pegawai</strong></h5>
                <div class="table-responsive mx-auto">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $content->nama; ?></td>

                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td><?= $content->nip; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <?php
                            if ($content->jenis_kelamin == "Laki-laki") {
                                $icon = '<i class="fas fa-mars" style="color: #3abaf4;"></i> ';
                            } else {
                                $icon = '<i class="fas fa-venus" style="color: #f997c9;"></i> ';
                            }
                            ?>
                            <td><?= $icon . $content->jenis_kelamin ?></td>
                        </tr>

                        <tr>
                            <td>TTL</td>
                            <td>:</td>

                            <?php

                            $tgl_lahir = date_format(new DateTime($content->tgl_lahir), "d-m-Y");
                            ?>
                            <td><?= $content->tempat_lahir . "," . " " . $tgl_lahir; ?></td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>:</td>
                            <td><?= $content->nohp; ?></td>
                        </tr>

                    </table>
                </div>


            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <h5 class="mb-4"><strong>Gaji</strong></h5>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Grade Pegawai</td>
                            <td>:</td>
                            <td class="text-right"><strong><?= $content->title; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>:</td>
                            <td class="text-right"><?= number_format($content->gaji, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                            <td>Tunjangan Kehadiran</td>
                            <td>:</td>
                            <td class="text-right"><?= number_format($content->insentif_kehadiran, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                            <td>Tunjangan Operasional</td>
                            <td>:</td>
                            <td class="text-right"><?= number_format($content->tunjangan, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                            <td>Tunjangan Kerajinan</td>
                            <td>:</td>
                            <td class="text-right"><?= number_format($content->tunjangan_kerajinan, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                            <td>Total Gaji</td>
                            <td>:</td>
                            <td class="text-right"><span style="font-size: 22px; font-weight: 600; color: #ffa426;">Rp&nbsp;<?= number_format($content->jumlah_gaji, 0, ',', '.') ?>,-</span></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>



</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

</div>