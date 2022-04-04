<?php
$kehadiran = isset($kpi->kehadiran) ? $kpi->kehadiran : "-";
$kinerja   = isset($kpi->kinerja) ? $kpi->kinerja : "-";
?>


<div id="result">
    <div class="container-fluid mt-3">
        <div class="row mb-4">

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

            <div class="col-lg-4 mt-5">
                <div class="text-center">

                    <div class="d-flex justify-content-center">
                        Kehadiran :<h3 class="ml-3 text-warning"><strong><?= $kehadiran; ?></strong></h3>
                    </div>
                    <div class="d-flex justify-content-center">
                        Kinerja : <h3 class="ml-3 text-warning"><strong><?= $kinerja; ?></strong></h3>
                    </div>

                    <?php if (isset($kpi->id)) : ?>
                        <button class="btn btn-info" id="btnEditNilaiKpi" data-id="<?= isset($kpi->id) ? $kpi->id : "" ?>">Edit Nilai KPI</button>
                    <?php endif ?>
                </div>
            </div>

        </div>


        <?php if (!isset($kpi->id)) : ?>
            <div id="formTambahKpi">
                <div class="container-fluid mt-4 mb-5">
                    <form action="#" method="POST" id="formTambahNilaiKpi">
                        <input type="hidden" name="nip_pegawai" id="nip_pegawai_nilai_kpi" value="<?= $pegawai->nip; ?>">
                        <h5 class="text-warning mt-5" style="margin-bottom: 10px;">Tambah Nilai KPI</h5>
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Kehadiran</label>
                                    <div class="col-sm-9">
                                        <div class="input-group-prepend">
                                            <!-- <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span> -->
                                            <input type="text" class="form-control" id="kehadiran" name="kehadiran">
                                        </div>
                                        <span id="kehadiran_error"></span>

                                    </div>
                                </div>







                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Kinerja</label>
                                    <div class="col-sm-9">
                                        <div class="input-group-prepend">
                                            <!-- <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;"><i class="fas fa-user"></i></span> -->
                                            <input type="text" class="form-control" id="kinerja" name="kinerja">
                                        </div>

                                        <span id="kinerja_error"></span>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-warning float-right">Simpan<img src="<?= base_url("assets/img/load/load2.svg"); ?>" width="25px;" id="loadBtn"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif ?>


        <div id="editFormTambahKpi">

        </div>

    </div>


</div>