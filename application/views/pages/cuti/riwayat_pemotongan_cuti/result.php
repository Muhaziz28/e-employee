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
                        <tr>
                            <td>Sisa Cuti</td>
                            <td>:</td>
                            <td><?= $pegawai->jatah_cuti . ' hari'; ?></td>
                        </tr>




                    </table>
                </div>
            </div>

        </div>
    </div>





    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive p-3">
                <h5 class="mt-4 text-warning" style="margin-bottom: 30px;"><strong>Riwayat Pemotongan Cuti</strong></h5>

                <table class="table align-items-center table-flush table-hover" id="dataTableHoverr">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Jumlah</th>
                            <th>Alasan Dipotong Cuti</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($riwayat as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= date_format(new DateTime($row->tgl_start), 'd-m-Y'); ?></td>
                                <td><?= date_format(new DateTime($row->tgl_end), 'd-m-Y'); ?></td>
                                <td><?= $row->jumlah . " hari"; ?></td>
                                <td><?= $row->alasan; ?></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                    <tfoot>
                        <?php if ($countRiwayat != 0) : ?>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>:</strong></td>
                                <td></td>
                                <td>
                                    <?= array_sum(array_column($riwayat, 'jumlah')) . " hari"; ?>
                                </td>
                                <td></td>
                            </tr>
                        <?php endif ?>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table-responsive p-3">
                <h5 class="mt-4 text-warning" style="margin-bottom: 30px;"><strong>Riwayat Pengajuan Cuti</strong></h5>

                <table class="table align-items-center table-flush table-hover" id="dataTableHoverr2">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Tanggal Cuti</th>
                            <th>Lama Cuti</th>
                            <th>Status Cuti</th>
                            <th>Alasan Cuti</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($riwayat_cuti as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= date_format(new DateTime($row->tgl_cuti), 'd-m-Y'); ?></td>
                                <td><?= $row->lama_cuti ?>&nbsp;hari</td>

                                <?php if ($row->status_cuti == "pending") {
                                    $jenisBadge = "warning";
                                } else if ($row->status_cuti == "diterima") {
                                    $jenisBadge = "info";
                                } else {
                                    $jenisBadge = "danger";
                                } ?>
                                <td><span class="badge badge-<?= $jenisBadge; ?>"><?= ucwords($row->status_cuti); ?></span></td>
                                <td><?= $row->alasan_cuti; ?></td>
                            </tr>
                        <?php endforeach ?>
                        <!-- <?php if ($countRiwayat != 0) : ?>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>:</strong></td>
                        <td></td>
                        <td>
                            <?= array_sum(array_column($riwayat, 'jumlah')) . " hari"; ?>
                        </td>
                        <td></td>
                    </tr>
                <?php endif ?> -->
                    </tbody>

                    <tfoot>
                        <?php if (count($riwayat_cuti) != 0) : ?>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>:</strong></td>
                                <td><?= array_sum(array_column($riwayat_cuti, 'lama_cuti')) . " hari"; ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endif ?>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



</div>