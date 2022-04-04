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
            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="email_edit_profile" placeholder="Email Pegawai" name="email" value="<?= $getPegawai->email; ?>">
                <span id="email_error"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat & Tgl Lahir</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tempat_lahir_edit_profile" placeholder="Tempat Lahir Pegawai" name="tempat_lahir" value="<?= $getPegawai->tempat_lahir; ?>">
                <span id="tempat_lahir_error"></span>
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="tgl_lahir_edit_profile" placeholder="Tanggal Lahir Pegawai" name="tgl_lahir" value="<?= $getPegawai->tgl_lahir; ?>">
                <span id="tgl_lahir_error"></span>
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

<script>
    $('#tgl_lahir_edit_profile').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
    });
</script>