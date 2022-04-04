<div class="row" id="result-pegawai">

    <?php $i = 1;
    foreach ($content as $row) : ?>
        <div class="col-lg-4 col-md-12">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        <div class="text-center">

                            <img src="<?= isset($row->image) && $row->image != '' ? base_url("images/pegawai/$row->image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" class="card-img rounded-circle p-2 img-pegawai" alt="...">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h5 class="card-title" style="margin-bottom: -20px;"><strong><?= $row->nama; ?></strong></h5>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">

                                    <a class="dropdown-item text-danger" href="#" id="btnOutPegawai" data-nip="<?= $row->nip; ?>"><strong>Keluarkan</strong></a>


                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <small>NIP: <?= $row->nip; ?></small>
                            <p><i class="fas fa-briefcase"></i>&nbsp;<?= $row->nama_divisi; ?></p>
                            <p class="card-text mt-3"><?= $row->alamat; ?></p>

                            <?php if ($row->jatah_cuti <= 3) : ?>
                                <p><strong>Sisa Jatah Cuti :&nbsp;</strong><span class="text-danger"><strong><?= $row->jatah_cuti; ?>&nbsp;Hari</strong></span></p>
                            <?php else : ?>
                                <p><strong>Sisa Jatah Cuti :&nbsp;</strong><span><?= $row->jatah_cuti; ?>&nbsp;Hari</span></p>
                            <?php endif ?>

                            <?php
                            //durasi kerja
                            $tgl_masuk = new DateTime($row->tgl_masuk);
                            $tgl_sekarang = new DateTime(date('Y-m-d'));


                            $diff = date_diff($tgl_masuk, $tgl_sekarang);

                            if ($diff->m == 0 && $diff->y == 0) {
                                $durasi = 'Kurang dari sebulan';
                            } else if ($diff->y > 0) {
                                $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                            } else {
                                $durasi = $diff->m . ' bulan ' . $diff->d . ' hari';
                            }

                            //sisa kontrak
                            $tgl_mulai_kontrak = new DateTime($row->tgl_mulai_kontrak);
                            $tgl_akhir_kontrak = new DateTime($row->tgl_akhir_kontrak);

                            $diff2 = date_diff($tgl_mulai_kontrak, $tgl_akhir_kontrak);

                            if ($tgl_akhir_kontrak <= $tgl_sekarang) {
                                $sisa = '<span class="text-danger">Kontrak Habis</span>';
                            } else {
                                $d = $tgl_akhir_kontrak->diff($tgl_sekarang)->days;

                                if ($d <= 3) {
                                    $sisa = '<span class="text-danger">' . $d . ' hari lagi</span>';
                                } else {
                                    $sisa = '<span class="text-body">' . $d . ' hari lagi</span>';
                                }
                            }



                            ?>


                            <p><strong>Durasi Kerja :</strong> <?= $durasi; ?></p>
                            <p><strong>Durasi Kontrak :&nbsp;<?= $row->status_pegawai == "Kontrak" ? $sisa : "-"; ?></strong></p>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="bpjsKetenagakerjaan<?= $i; ?>" <?= $row->bpjs_ketenagakerjaan == 1 ? "checked" : "" ?> data-nip="<?= $row->nip; ?>">
                                <label class="custom-control-label" for="bpjsKetenagakerjaan<?= $i; ?>">BPJS Ketenagakerjaan</label>
                            </div>
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" class="custom-control-input" id="bpjsKesehatan<?= $i; ?>" <?= $row->bpjs_kesehatan == 1 ? "checked" : "" ?> data-nip="<?= $row->nip; ?>">
                                <label class="custom-control-label" for="bpjsKesehatan<?= $i; ?>">BPJS Kesehatan</label>
                            </div>
                            <div class="group-btn">
                                <a href="<?= base_url("pegawai/edit/$row->nip/$row->id_divisi"); ?>" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger" id="btnDeletePegawai" data-nip="<?= $row->nip; ?>">Hapus</a>
                                <a href="#" class="btn btn-info" id="btnLihatPegawai" data-nip="<?= $row->nip; ?>">Lihat</a>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $i++;
    endforeach ?>





</div>

<div class="row mt-4 mb-3">
    <div class="col-lg-12">
        <div id="pagination">
            <nav aria-label="...">
                <!-- <ul class="pagination" class="justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">
                            2
                            <span class="sr-only">(current)</span>
                        </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul> -->

                <?= $pagination; ?>
            </nav>
        </div>

    </div>

</div>