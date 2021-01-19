<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout">Form Keluarkan Pegawai</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("pegawai/moveToPegawaiOut/$nip") ?>" method="POST" id="formPegawaiOut">
    <div class="modal-body">

        <input type="hidden" id="nip_pegawai" value="<?= $pegawai->nip; ?>">
        
        <h6 class="m-0 font-weight-bold text-warning mb-4">Identitas Diri</h6>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $pegawai->nama; ?></td>
                </tr>
                <tr>
                    <td>Divisi</td>
                    <td>:</td>
                    <td><?= $pegawai->nama_divisi; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $pegawai->nama_jabatan; ?></td>
                </tr>
            </table>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-lg-12">

                <p>Dengan ini ingin mengeluarkan pegawai ini dengan alasan :</p>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Alasan</label>
            <div class="col-sm-9">
                <select class="select2-tugas form-control" name="status_out" id="status_out" required>

                    <option value="PHK">PHK</option>
                    <option value="Blacklist">Blacklist</option>
                    <option value="Lainnya">Lainnya...</option>

                </select>

            </div>
        </div>

       

        <div class="form-group row keterangan">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="keterangan" placeholder="Keterangan" rows="4" name="keterangan"></textarea>

            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>