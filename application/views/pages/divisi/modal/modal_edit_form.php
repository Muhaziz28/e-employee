<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("divisi/update") ?>" method="POST" id="formEditDivisi">
    <div class="modal-body">
        <div class="form-group row">
            <input type="hidden" name="id" id="id_divisi" value="<?= $getDivisi->id; ?>">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Divisi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_divisi_edit" placeholder="Nama Divisi" name="nama_divisi" value="<?= $getDivisi->nama_divisi; ?>">
                <span id="nama_divisi_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="ket_edit" placeholder="Keterangan" rows="4" name="ket"><?= $getDivisi->ket; ?></textarea>
                
            </div>
        </div>
        
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>