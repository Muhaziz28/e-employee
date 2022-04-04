<div class="row">

    <?php foreach ($content as $row) : ?>
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

                        </div>
                        <div class="card-body">

                            <small>NIP: <?= $row->nip; ?></small>
                            <p><i class="fas fa-briefcase"></i>&nbsp;<?= $row->nama_divisi; ?></p>
                            <p class="card-text mt-3"><?= $row->alamat; ?></p>
                            <p>Tgl Masuk : <?= date_format(new DateTime($row->tgl_masuk), 'd M Y'); ?></p>
                            <p>Tgl Dikeluarkan : <?= date_format(new DateTime($row->tgl_keluar), "d M Y"); ?></p>

                            <a href="#" class="btn btn-warning" id="btnMasukkanPegawai" data-nip="<?= $row->nip; ?>">Masukkan</a>
                            <a href="#" class="btn btn-info" id="btnLihatPegawaiOut" data-nip="<?= $row->nip; ?>">Lihat</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>





</div>

<div class="row mt-4 mb-3">
    <div class="col-lg-12">
        <div id="pagination_out">
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