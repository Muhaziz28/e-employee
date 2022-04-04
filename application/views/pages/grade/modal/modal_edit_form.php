<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="#" method="POST" id="formEditGrade">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="form-group row">
            <input type="hidden" name="id" id="id_grade_edit" value="<?= $getGrade->id; ?>">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Pilih Level</label>
            <div class="col-sm-9">
                <select class="select2-single form-control" name="id_level" id="id_level_edit">
                    <option></option>
                    <?php foreach ($getLevel as $row) : ?>
                        <option value="<?= $row->id; ?>" <?= $row->id == $getGrade->id_level ? "selected" : "" ?> ><?= $row->nama_level; ?></option>
                    <?php endforeach ?>
                </select>
                <span id="id_level_edit_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Grade</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_grade_edit" placeholder="Nama Grade" name="nama_grade" value="<?= $getGrade->title; ?>">
                <span id="nama_grade_edit_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Gaji Pokok</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="gaji_pokok_edit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Gaji Pokok" name="gaji_pokok" value="<?= number_format($getGrade->gaji_pokok, 0, ',', '.'); ?>">
                </div>
                <span id="gaji_pokok_edit_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Kehadiran</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="tunjangan_kehadiran_edit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Kehadiran" name="tunjangan_kehadiran" value="<?= number_format($getGrade->tunjangan_kehadiran, 0, ',', '.'); ?>">
                </div>
                <span id="tunjangan_kehadiran_edit_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Operasional</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="tunjangan_operasional_edit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Operasional" name="tunjangan_operasional" value="<?= number_format($getGrade->tunjangan_operasional, 0, ',', '.'); ?>">
                </div>
                <span id="tunjangan_operasional_edit_error"></span>
            </div>
        </div>




    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>