<div class="row">

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <!-- <h6 class="m-0 font-weight-bold text-warning">Daftar Divisi</h6> -->
                <button type="button" class="btn btn-success" onclick="window.location.href='<?= base_url("gaji/rekapitulasi_gaji_pegawai") ?>'"><i class="fas fa-file-excel mr-2"></i>Rekapitulasi Gaji Pegawai</button>
                <div class="form-group">
                    <label for="filter-peg"><i class="fas fa-filter mr-2"></i>Filter :</label>
                    <select name="" class="form-control form-control-sm my-auto" id="filter-peg">
                        <option value="Soraya Bedsheet">Soraya Bedsheet</option>
                        <option value="Hers Clinic">Hers Clinic</option>
                    </select>
                </div>
            </div>
            <div class="list-data-pegawai-gaji">
                <div id="anim4" class="mx-auto mt-3" style="width: 100px;"></div>
                <div class="text-center mt-3">
                    <p><strong>Harap Tunggu...</strong></p>
                </div>
            </div>

        </div>
    </div>
</div>