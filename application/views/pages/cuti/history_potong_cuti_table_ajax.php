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

    <div class="table-responsive p-3">
        <?php $this->load->view('layouts/_alert'); ?>
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Tanggal Start</th>
                    <th>Tanggal End</th>
                    <th>Jumlah</th>
                    <th>Alasan Dipotong Cuti</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1;
                foreach ($content as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row->tgl_start; ?></td>
                        <td><?= $row->tgl_end; ?></td>
                        <td><?= $row->jumlah . ' hari'; ?></td>
                        <td><?= $row->alasan; ?></td>
                        <!-- <td>
                        <a href="#" class="btn btn-info" id="btnEditLokasi" data-id="<?= $row->id; ?>"> Edit</a>
                        <a href="#" class="btn btn-danger" id="btnDeleteLokasi" data-id="<?= $row->id; ?>">Delete</a>
                    </td> -->
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>