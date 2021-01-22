<form action="<?= base_url("cuti/potong_jatah_cuti_pegawai") ?>" method="POST" id="formPotongCuti">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group row">
                    <input type="hidden" name="jatah_cuti_from_db" id="jatah_cuti_from_db">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-9">
                        <select class="select2-single-potong-cuti form-control" name="nip_pegawai" id="nip_pegawai_potong_cuti">
                            <option value=""></option>
                            <?php foreach ($getPegawai as $row) : ?>
                                <option value="<?= $row->nip; ?>" data-cuti="<?= $row->jatah_cuti; ?>"><?= $row->nip; ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
                            <?php endforeach ?>
                        </select>

                        <span id="nip_pegawai_error"></span>



                    </div>
                </div>

                <div class="form-group row" id="potong-cuti">

                    <div class="col-sm-9">

                    </div>

                </div>

                <!-- <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Cuti yang dipotong</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jatah_cuti" placeholder="Jumlah Cuti" name="jatah_cuti">
                        <span id="jatah_cuti_error"></span>
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="dateRangePicker" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <div id="potong-cuti-tgl">
                            <div class="input-daterange input-group">
                                <input type="text" class="input-sm form-control" id="tgl_start" placeholder="Tgl Awal" />
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary" style="border-color: #757575;">s/d</span>
                                </div>
                                <input type="text" class="input-sm form-control" id="tgl_end" placeholder="Tgl Akhir" />
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="tgl_start" id="tgl_start_temp" value="">
                <input type="hidden" name="tgl_end" id="tgl_end_temp" value="">

              

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Alasan</label>
                    <div class="col-sm-9">
                        <!-- <input type="text" name="alasan" class="form-control" id="inputEmail3" placeholder="Email"> -->
                        <textarea name="alasan" id="alasan" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 mt-3">
                        <button class="btn btn-warning float-right" type="submit">Potong Cuti</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>