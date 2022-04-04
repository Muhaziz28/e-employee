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





    <div class="table-responsive p-3">

        <table class="table align-items-center table-flush table-hover" id="dataTableHoverr">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Gaji</th>
                    <th>Insentif Kehadiran</th>
                    <th>Tunjangan</th>
                    <th>Total Gaji</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1;
                foreach ($riwayat as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td>Rp&nbsp;<?= number_format($row->gaji_lama, 0, ',', '.'); ?>,-</td>
                        <td>Rp&nbsp;<?= number_format($row->insentif_kehadiran_lama, 0, ',', '.'); ?>,-</td>
                        <td>Rp&nbsp;<?= number_format($row->tunjangan_lama, 0, ',', '.'); ?>,-</td>
                        <th>Rp&nbsp;<?= number_format($row->jumlah_gaji_lama, 0, ',', '.'); ?>,-</th>
                        <td><?= date_format(new DateTime($row->waktu_perubahan), 'd/m/Y H:i'); ?>&nbsp;WIB</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>