<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group row">
                <input type="hidden" name="jatah_cuti_from_db" id="jatah_cuti_from_db">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Pilih Pegawai</label>
                <div class="col-sm-9">
                    <select class="select2-single-potong-cuti form-control" id="nip_pegawai_slip_gaji">
                        <option value=""></option>
                        <?php foreach ($getPegawai as $row) : ?>
                            <option value="<?= $row->nip; ?>"><?= $row->nip; ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
                        <?php endforeach ?>
                    </select>



                </div>
            </div>



        </div>
    </div>
</div>