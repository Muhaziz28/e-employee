<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="#" method="POST" id="formEditGaji">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <input type="hidden" name="id" value="<?= $getGaji->id; ?>" id="id">
        <input type="hidden" name="nip_pegawai" value="<?= $getGaji->nip_pegawai; ?>" id="nip_pegawai_edit">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Pilih Grade</label>
            <div class="col-sm-9">
                <select class="select2-single-edit form-control" name="id_grade" id="id_grade_edit">
                    <option></option>
                    <?php foreach ($getGrade as $row) : ?>
                        <option value="<?= $row->id; ?>" <?= $getGaji->id_grade == $row->id ? "selected" : "" ?>><?= $row->title; ?></option>
                    <?php endforeach ?>
                </select>
                <span id="id_grade_edit_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Gaji Pokok</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="jumlah_gaji_edit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Gaji" name="jumlah_gaji" value="<?= number_format($getGaji->gaji, 0, ',', '.'); ?>" readonly>
                </div>
                <span id="jumlah_gaji_edit_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Kehadiran</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="insentif_kehadiran_edit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Insentif Kehadiran" name="insentif_kehadiran" value="<?= number_format($getGaji->insentif_kehadiran, 0, ',', '.'); ?>" readonly>
                </div>
                <span id="insentif_kehadiran_edit_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Operasional</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="tunjangan_edit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan" name="tunjangan" value="<?= number_format($getGaji->tunjangan, 0, ',', '.'); ?>" readonly>
                </div>
                <span id="tunjangan_edit_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Kerajinan</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="tunjangan_kerajinan_edit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Kerajinan" name="tunjangan_kerajinan" value="<?= number_format($getGaji->tunjangan_kerajinan, 0, ',', '.'); ?>">
                </div>
                <span id="tunjangan_kerajinan_edit_error"></span>
            </div>
        </div>




    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>