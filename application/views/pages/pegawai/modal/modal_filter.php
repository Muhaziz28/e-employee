<div class="modal fade" id="modal_filter_pegawai" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Filter Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("pegawai/filter"); ?>" method="POST" id="formFilterPegawai">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Divisi</label>
                                <select class="form-control" id="divisi_pegawai" name="id_divisi">
                                    <option value="">- Pilih Divisi -</option>
                                    <?php foreach ($divisi as $row) : ?>
                                        <option value="<?= $row->id; ?>"><?= $row->nama_divisi; ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Level</label>
                                <select class="form-control" id="level_pegawai" name="id_level">
                                    <option value="">- Pilih Level -</option>
                                    <?php foreach ($level as $row) : ?>
                                        <option value="<?= $row->id; ?>"><?= $row->nama_level; ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>


                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning" id="btnSubmitFormFilterPegawai">Filter</a>
            </div>
        </div>
    </div>
</div>