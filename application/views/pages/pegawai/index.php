<div class="container-fluid justify-content-center" id="container-wrapper">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <h1 class="h3 mb-3 text-warning font-weight-bold">Daftar Pegawai</h1>
            <a href="<?= base_url("pegawai/add") ?>" class="btn btn-warning">Tambah Pegawai</a>
            <form class="form-inline float-right">

                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="text" class="form-control" id="inputPassword2" placeholder="Search">
                </div>
                <!-- <button type="submit" class="btn btn-primary mb-2">Cari</button> -->
            </form>
        </div>

    </div>
    <div class="row">
        <?php foreach ($content as $row) : ?>
            <div class="col-lg-4 col-md-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-lg-4">
                            <img src="<?= isset($row->image) && $row->image != '' ? base_url("images/pegawai/$row->image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" class="card-img rounded-circle p-2" alt="...">
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body">
                                <h5 class="card-title" style="margin-bottom: -1px;"><strong><?= $row->nama; ?></strong></h5>
                                <small>NIP: <?= $row->nip; ?></small>
                                <p><i class="fas fa-briefcase"></i>&nbsp;<?= $row->nama_divisi; ?></p>
                                <p class="card-text mt-3"><?= $row->alamat; ?></p>

                                <a href="#" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger">Hapus</a>
                                <a href="#" class="btn btn-info">Lihat</a>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>





    </div>
    <div class="row mt-4 mb-3">
        <div class="col-lg-12">
            <nav aria-label="...">
                <ul class="pagination" class="justify-content-center">
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
                </ul>
            </nav>
        </div>

    </div>

</div>