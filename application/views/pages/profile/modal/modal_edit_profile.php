<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("profile/update") ?>" method="POST" id="formEditProfile">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_edit_profile" placeholder="Nama Pegawai" name="nama" value="<?= $getPegawai->nama; ?>">
                <span id="nama_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="password_edit_profile" placeholder="Password (isi jika ingin mengubah password)" name="password">
                <span id="password_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Konfirmasi Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="confirm_password_edit_profile" placeholder="Konfirmasi Password" name="confirm_password">
                <span id="confirm_password_error"></span>
            </div>
        </div>
        


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>