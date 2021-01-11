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
                        <div class="card-body">
                            <h5 class="card-title" style="margin-bottom: -1px;"><strong><?= $row->nama; ?></strong></h5>
                            <small>NIP: <?= $row->nip; ?></small>
                            <p><i class="fas fa-briefcase"></i>&nbsp;<?= $row->nama_divisi; ?></p>
                            <p class="card-text mt-3"><?= $row->alamat; ?></p>

                            <a href="<?= base_url("pegawai/edit/$row->nip"); ?>" class="btn btn-primary">Edit</a>
                            <a href="#" class="btn btn-danger" id="btnDeletePegawai" data-nip="<?= $row->nip; ?>">Hapus</a>
                            <a href="#" class="btn btn-info" id="btnLihatPegawai" data-nip="<?= $row->nip; ?>">Lihat</a>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>





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