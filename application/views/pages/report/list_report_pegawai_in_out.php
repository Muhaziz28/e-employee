<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">Pegawai In</h6>


            </div>

            <div class="table-responsive p-3">

                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th style="width: 120px;">NIP</th>
                            <th style="width: 250px;">Nama Pegawai</th>
                            <th style="width: 150px;">Tgl Masuk</th>
                            <th style="width: 120px;">Divisi</th>
                            <th style="width: 120px;">Jabatan</th>
                            <th style="width: 120px;">Penempatan</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($pegawai_in as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->nip; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= date_format(new DateTime($row->tgl_masuk), 'd/m/Y'); ?></td>
                                <td><?= $row->nama_divisi; ?></td>
                                <td><?= $row->nama_jabatan; ?></td>
                                <td><?= $row->nama_lokasi; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">Pegawai Out</h6>


            </div>

            <div class="table-responsive p-3">

                <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th style="width: 120px;">NIP</th>
                            <th style="width: 250px;">Nama Pegawai</th>
                            <th style="width: 150px;">Tgl Keluar</th>
                            <th style="width: 120px;">Divisi</th>
                            <th style="width: 120px;">Jabatan</th>
                            <th style="width: 120px;">Penempatan</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($pegawai_out as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->nip; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= date_format(new DateTime($row->tgl_keluar), 'd/m/Y'); ?></td>
                                <td><?= $row->nama_divisi; ?></td>
                                <td><?= $row->nama_jabatan; ?></td>
                                <td><?= $row->nama_lokasi; ?></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>