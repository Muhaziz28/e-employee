<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">


    <div class="row">
        <div class="col-lg-4 frame-pegawai ml-4">
            <div class="text-center">
                <img src="<?= isset($content->image) && $content->image != '' ? base_url("images/pegawai/$content->image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" class="card-img rounded-circle p-2 img-pegawai" alt="pegawai-image">
                <h3 class="h3 mt-3 font-weight-bold"><?= $content->nama; ?></h3>
                <p style="margin-top: -10px;"><?= $content->email; ?></p>
                <a href="#" class="btn btn-warning" id="btnRiwayatCuti" data-nip="<?= $content->nip; ?>">Lihat Riwayat Cuti</a>
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

                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td><?= $content->agama; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><?= $content->status; ?></td>
                    </tr>

                </table>
            </div>


        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><i class="fas fa-home" style="color: #ffa426;"></i>&nbsp;<?= $content->alamat; ?></td>

                    </tr>
                    <tr>
                        <td>Tgl Masuk</td>
                        <td>:</td>
                        <td><?= date_format(new DateTime($content->tgl_masuk), "d-m-Y"); ?></td>

                    </tr>
                    <tr>
                        <td>Divisi</td>
                        <td>:</td>
                        <td><?= $content->nama_divisi; ?></td>

                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?= $content->nama_jabatan; ?></td>
                    </tr>
                    <tr>
                        <td>Tingkatan Pegawai</td>
                        <td>:</td>
                        <td><?= $content->nama_level; ?></td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td><?= $content->pendidikan; ?></td>
                    </tr>
                    <tr>
                        <td>Status Pegawai</td>
                        <td>:</td>
                        <td><?= $content->status_pegawai; ?></td>
                    </tr>
                    <tr>
                        <td>Durasi Kontrak</td>
                        <td>:</td>
                        <?php
                        if ($content->satuan_durasi == "month") {
                            $satuan_durasi = "bulan";
                        } else {
                            $satuan_durasi = "tahun";
                        }
                        ?>

                        <td>
                            <?php if ($content->status_pegawai == "Kontrak") : ?>
                                <?= $content->durasi_kerja . " " . $satuan_durasi; ?>
                            <?php else : ?>
                                -
                            <?php endif ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

</div>