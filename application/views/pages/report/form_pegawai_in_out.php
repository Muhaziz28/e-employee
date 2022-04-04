<form action="<?= base_url("report/requestPegawaiInOut") ?>" method="POST" id="formLaporanPegawaiInOut">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">

                <div class="form-group row">
                    <label for="dateRangePicker" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <div id="pegawai-in-out">
                            <div class="input-daterange input-group">
                                <input type="text" class="input-sm form-control" id="tgl_start_inout" placeholder="Tgl Awal" autocomplete="off" />
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary" style="border-color: #757575;">s/d</span>
                                </div>
                                <input type="text" class="input-sm form-control" id="tgl_end_inout" placeholder="Tgl Akhir" autocomplete="off" />

                            </div>

                            <div class="d-flex">
                                <span id="tgl_start_error"></span>
                                <span id="tgl_end_error" class="float-right mx-auto" style="margin-left: 500px;"></span>
                            </div>

                        </div>
                    </div>
                </div>

                <input type="hidden" name="tgl_start" id="tgl_start_inout_temp" value="">
                <input type="hidden" name="tgl_end" id="tgl_end_inout_temp" value="">





                <div class="form-group row">
                    <div class="col-sm-12 mt-3">
                        <button class="btn btn-warning float-right" type="submit">Kirim</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>