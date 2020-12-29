<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("jabatan/insert") ?>" method="POST" id="formTambahJabatan">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Jabatan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_jabatan" placeholder="Nama Jabatan" name="nama_jabatan">
                <span id="nama_jabatan_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Divisi</label>
            <div class="col-sm-9">
                <select class="select2-single form-control" name="id_divisi" id="id_divisi">
                    <option></option>
                    <?php foreach ($getDivisi as $row) : ?>
                        <option value="<?= $row->id; ?>"><?= $row->nama_divisi; ?></option>
                    <?php endforeach ?>
                </select>
                <span id="nama_divisi_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="ket_jabatan" placeholder="Keterangan" rows="4" name="ket"></textarea>

            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>