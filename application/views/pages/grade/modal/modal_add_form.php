<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="#" method="POST" id="formTambahGrade">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Pilih Level</label>
            <div class="col-sm-9">
                <select class="select2-single form-control" name="id_level" id="id_level">
                    <option></option>
                    <?php foreach ($getLevel as $row) : ?>
                        <option value="<?= $row->id; ?>"><?= $row->nama_level; ?></option>
                    <?php endforeach ?>
                </select>
                <span id="id_level_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Grade</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_grade" placeholder="Nama Grade" name="nama_grade">
                <span id="nama_grade_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Gaji Pokok</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="gaji_pokok" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Gaji Pokok" name="gaji_pokok">
                </div>
                <span id="gaji_pokok_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Kehadiran</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="tunjangan_kehadiran" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Kehadiran" name="tunjangan_kehadiran">
                </div>
                <span id="tunjangan_kehadiran_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Operasional</label>
            <div class="col-sm-9">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                    <input type="text" class="form-control" id="tunjangan_operasional" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Operasional" name="tunjangan_operasional">
                </div>
                <span id="tunjangan_operasional_error"></span>
            </div>
        </div>




    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>