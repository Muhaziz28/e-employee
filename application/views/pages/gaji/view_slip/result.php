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

        
        <div class="row mt-5 mb-4">
            <div class="col-lg-6 mx-auto">

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>

                    <select class="form-control" id="bulan_filter_slip_gaji" name="bulan">
                        <option value="">- Pilih Bulan -</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4 mx-auto">

                <div class="form-group" id="tahun_filter">

                    <div class="input-group date">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tahun" id="tahun_filter_slip_gaji" name="tahun" autocomplete="off">
                    </div>

                </div>
            </div>

            <div class="col-lg-2 mx-auto">

                <div class="input-group">
                    <a href="#" class="btn btn-info float-right" id="btnFilterSlipGaji"><i class="fas fa-filter mr-2"></i>Filter</a>
                    <a href="#" class="btn btn-secondary float-right ml-3" id="btnResetFilterSlipGaji"><i class="fas fa-sync mr-2"></i>Reset</a>
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
                    <th>Total Gaji</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1;
                foreach ($slip_gaji as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td>Rp&nbsp;<?= number_format($row->jumlah_gaji, 0, ',', '.'); ?>,-</td>
                        <td>Rp&nbsp;<?= number_format($row->total_gaji, 0, ',', '.'); ?>,-</td>
                        <td><?= date_format(new DateTime($row->created_at), 'd/m/Y'); ?></td>
                        <td><a href="#" class="btn btn-warning" id="btnViewSlipGaji" data-id="<?= $row->id; ?>" data-nip="<?= $row->nip_pegawai; ?>">Lihat Slip Gaji</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>