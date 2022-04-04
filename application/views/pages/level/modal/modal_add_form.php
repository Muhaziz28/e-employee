<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("level/insert") ?>" method="POST" id="formTambahLevel">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Level</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_level" placeholder="Nama Level" name="nama_level">
                <span id="nama_level_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="ket" placeholder="Keterangan" rows="4" name="ket"></textarea>

            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>