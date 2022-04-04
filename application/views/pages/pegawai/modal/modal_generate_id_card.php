<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout">Generate Id Card</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("pegawai/generateIdCardSelected"); ?>" method="POST" id="formGenerateIdCard">
    <div class="modal-body">


        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Pilih Pegawai</label>
            <div class="col-sm-9">
                <select class="select2-tugas form-control" name="pegawai" id="pegawaiList" required>

                    <option></option>
                    <?php foreach ($pegawai as $row) : ?>
                        <option value="<?= $row->nip; ?>"><?= $row->nip; ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
                    <?php endforeach ?>

                </select>

            </div>
        </div>

        <h2 class="card-inside-title mt-3" style="font-size: 16px;">Pegawai yang terpilih</h2>
        <div class="row selected-pegawai">

        </div>



    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Generate</a>
    </div>
</form>