<div class="container-fluid mt-4 mb-5">
    <form action="#" method="POST" id="formEditSlipGaji">
        <input type="hidden" name="nip_pegawai" value="<?= $edit_slip_gaji->nip_pegawai; ?>">
        <input type="hidden" name="id_gaji" value="<?= $edit_slip_gaji->id_gaji; ?>">
        <input type="hidden" name="id" value="<?= $edit_slip_gaji->id; ?>">
        <div class="row">
            <div class="col-lg-6 mt-5">
                <h5 class="text-warning">Penambahan</h5>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Lembur</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                            <input type="text" class="form-control" id="lembur" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Lembur" name="lembur" value="<?= number_format($edit_slip_gaji->lembur, 0, ',', '.'); ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Bonus</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                            <input type="text" class="form-control" id="bonus" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Bonus" name="bonus" value="<?= number_format($edit_slip_gaji->bonus, 0, ',', '.'); ?>">
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
                            <input type="text" class="form-control" id="bpjs" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="BPJS" name="bpjs" value="<?= number_format($edit_slip_gaji->bpjs, 0, ',', '.'); ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Bon</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                            <input type="text" class="form-control" id="bon" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Bon" name="bon" value="<?= number_format($edit_slip_gaji->bon, 0, ',', '.'); ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Simp. Koperasi</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                            <input type="text" class="form-control" id="simp_koperasi" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Simp. Koperasi" name="simp_koperasi" value="<?= number_format($edit_slip_gaji->simp_koperasi, 0, ',', '.'); ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Dana Sosial</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                            <input type="text" class="form-control" id="dana_sosial" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Dana Sosial" name="dana_sosial" value="<?= number_format($edit_slip_gaji->dana_sosial, 0, ',', '.'); ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Pinjaman</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                            <input type="text" class="form-control" id="pinjaman" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Pinjaman" name="pinjaman" value="<?= number_format($edit_slip_gaji->pinjaman, 0, ',', '.');; ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">KPI</label>
                    <div class="col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                            <input type="text" class="form-control" id="kpi" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="KPI" name="kpi" value="<?= number_format($edit_slip_gaji->kpi, 0, ',', '.'); ?>">
                        </div>

                    </div>
                </div>

                <input type="hidden" name="total_gaji" id="total_gaji" value="<?= $edit_slip_gaji->total_gaji; ?>">

                <input type="hidden" id="total_gaji_temp" value="<?= $gaji->jumlah_gaji; ?>">
                <button type="submit" class="btn btn-warning float-right">Simpan<img src="<?= base_url("assets/img/load/load2.svg"); ?>" width="25px;" id="loadBtn"></button>

            </div>
        </div>
    </form>
</div>