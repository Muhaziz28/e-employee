<div class="container-fluid mt-4 mb-5">
    <form action="#" method="POST" id="formEditNilaiKpi">
        <input type="hidden" name="nip_pegawai" id="nip_pegawai_nilai_kpi" value="<?= $edit_kpi->nip_pegawai; ?>">
        <input type="hidden" name="id" id="id_nilai_kpi" value="<?= $edit_kpi->id; ?>">
        <h5 class="text-warning mt-5" style="margin-bottom: 10px;">Edit Nilai KPI</h5>
        <div class="row">
            <div class="col-lg-6">

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Kehadiran</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <!-- <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span> -->
                            <input type="text" class="form-control" id="kehadiran" name="kehadiran" value="<?= $edit_kpi->kehadiran; ?>">
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
                            <input type="text" class="form-control" id="kinerja" name="kinerja" value="<?= $edit_kpi->kinerja; ?>">
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