<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("lokasi/insert") ?>" method="POST" id="formTambahLokasi">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Lokasi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_lokasi" placeholder="Nama Lokasi" name="nama_lokasi">
                <span id="nama_lokasi_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="alamat" placeholder="Alamat" rows="4" name="alamat"></textarea>
                <span id="alamat_error"></span>
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>