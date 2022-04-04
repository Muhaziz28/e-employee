<?php
$image = $pegawai->image;
$jumlah_gaji = isset($gaji->jumlah_gaji) ? '<h3><b class="text-warning">' . 'Rp ' . number_format($gaji->jumlah_gaji, 0, ',', '.') . ',-' . '</b></h3>' : "<h5><b class='text-danger'>Gaji belum ditambahkan.</b></h5>";
$bln_tahun_skrg = date("Y-m");

$tgl_slip_gaji = isset($slip_gaji->created_at) ? $slip_gaji->created_at : "";
$total_gaji    = isset($slip_gaji->total_gaji) && date_format(new DateTime($tgl_slip_gaji), 'Y-m') == $bln_tahun_skrg ? '<h3><b class="text-warning">' . 'Rp ' . number_format($slip_gaji->total_gaji, 0, ',', '.') . ',-' . '</b></h3>' : $jumlah_gaji;
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
            <div class="col-lg-4 mt-3">
                <div class="text-center">

                    <div id="tot_gaji_space">
                        Total Gaji : <?= $total_gaji; ?>
                    </div>
                    <div id="button_space" class="mb-5 mt-3">
                        <img src="<?= base_url("assets/img/load/loaddd2.svg"); ?>" width="50px;" id="loadActioBtn">
                    </div>

                </div>
            </div>
        </div>
        <?php if (checkGaji($pegawai->nip) > 0) : ?>
            <?php if (!isset($slip_gaji->created_at) || date_format(new DateTime($tgl_slip_gaji), "Y-m") != $bln_tahun_skrg) : ?>
                <div id="formSlipGaji">
                    <div class="container-fluid mt-4 mb-5">
                        <form action="#" method="POST" id="formTambahSlipGaji">
                            <input type="hidden" name="nip_pegawai" id="nip_pegawai_slip_gaji" value="<?= $pegawai->nip; ?>">
                            <input type="hidden" name="id_gaji" value="<?= $gaji->id; ?>">
                            <div class="row">
                                <div class="col-lg-6 mt-5">
                                    <h5 class="text-warning">Penambahan</h5>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Lembur</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="lembur" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Lembur" name="lembur">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Bonus</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="bonus" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Bonus" name="bonus">
                                            </div>

                                        </div>
                                    </div>





                                </div>

                                <div class="col-lg-6 mt-5">
                                    <h5 class="text-warning">Pengurangan</h5>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">BPJS</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="bpjs" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="BPJS" name="bpjs">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Bon</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="bon" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Bon" name="bon">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Simp. Koperasi</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="simp_koperasi" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Simp. Koperasi" name="simp_koperasi">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Dana Sosial</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="dana_sosial" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Dana Sosial" name="dana_sosial">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Pinjaman</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="pinjaman" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Pinjaman" name="pinjaman">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">KPI</label>
                                        <div class="col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                                                <input type="text" class="form-control" id="kpi" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="KPI" name="kpi">
                                            </div>

                                        </div>
                                    </div>

                                    <input type="hidden" name="total_gaji" id="total_gaji" value="<?= $gaji->jumlah_gaji; ?>">

                                    <input type="hidden" id="total_gaji_temp" value="<?= $gaji->jumlah_gaji; ?>">
                                    <button type="submit" class="btn btn-warning float-right">Simpan<img src="<?= base_url("assets/img/load/load2.svg"); ?>" width="25px;" id="loadBtn"></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endif ?>
        <?php endif ?>

        <div id="editFormSlipGaji">

        </div>

    </div>


</div>