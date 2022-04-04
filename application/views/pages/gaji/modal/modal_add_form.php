<?php $id_grade_peg = $pegawai->id_grade != null || $pegawai != "" ? $pegawai->id_grade : ""; ?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if ($divisi != 21) : ?>
    <form action="#" method="POST" id="formTambahGaji">
        <div class="modal-body">
            <?php $this->load->view('layouts/_alert'); ?>
            <input type="hidden" name="nip_pegawai" value="<?= $nip; ?>" id="nip_pegawai">
            <input type="hidden" value="<?= $divisi; ?>" id="divisi_peg" name="divisi_peg">
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6><i class="fas fa-info"></i><b> Info!</b></h6>
                <span>Pilih grade pegawai terlebih dahulu jika grade pegawai tidak ada.</span>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Pilih Grade</label>
                <div class="col-sm-9">
                    <select class="select2-single form-control" name="id_grade" id="id_grade">
                        <option></option>
                        <?php foreach ($getGrade as $row) : ?>
                            <option value="<?= $row->id; ?>" <?= $id_grade_peg != "" && $id_grade_peg == $row->id ? "selected" : "" ?>><?= $row->title; ?></option>
                        <?php endforeach ?>
                    </select>
                    <span id="id_grade_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Gaji Pokok</label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="jumlah_gaji" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Gaji Pokok" name="jumlah_gaji" value="<?= isset($grade) ? number_format($grade->gaji_pokok, 0, ',', '.') : ""; ?>" readonly>
                    </div>
                    <span id="jumlah_gaji_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Kehadiran</label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="insentif_kehadiran" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Kehadiran" name="insentif_kehadiran" value="<?= isset($grade) ? number_format($grade->tunjangan_kehadiran, 0, ',', '.') : ""; ?>" readonly>
                    </div>
                    <span id="insentif_kehadiran_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Operasional </label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="tunjangan" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Operasional" name="tunjangan" value="<?= isset($grade) ? number_format($grade->tunjangan_operasional, 0, ',', '.') : ""; ?>" readonly>
                    </div>
                    <span id="tunjangan_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Kerajinan </label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="tunjangan_kerajinan" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Kerajinan" name="tunjangan_kerajinan" <?= $id_grade_peg != "" ? "" : "readonly" ?>>
                    </div>
                    <span id="tunjangan_kerajinan_error"></span>
                </div>
            </div>




        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Kirim</a>
        </div>
    </form>
<?php else : ?>
    <form action="#" method="POST" id="formTambahGaji">
        <div class="modal-body">
            <?php $this->load->view('layouts/_alert'); ?>
            <input type="hidden" name="nip_pegawai" value="<?= $nip; ?>" id="nip_pegawai">
            <input type="hidden" value="<?= $divisi; ?>" id="divisi_peg" name="divisi_peg">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Gaji Pokok</label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="jumlah_gaji" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Gaji Pokok" name="jumlah_gaji" value="<?= isset($grade) ? number_format($grade->gaji_pokok, 0, ',', '.') : ""; ?>">
                    </div>
                    <span id="jumlah_gaji_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Leader </label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="tunjangan_leader" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Leader" name="tunjangan_leader">
                    </div>
                    <span id="tunjangan_leader_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Kebersihan </label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="tunjangan_kebersihan" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Kebersihan" name="tunjangan_kebersihan">
                    </div>
                    <span id="tunjangan_kebersihan_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Keamanan </label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="tunjangan_keamanan" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Keamanan" name="tunjangan_keamanan">
                    </div>
                    <span id="tunjangan_keamanan_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Dokter </label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="tunjangan_dokter" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Dokter" name="tunjangan_dokter">
                    </div>
                    <span id="tunjangan_dokter_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tunjangan Lainnya </label>
                <div class="col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-secondary" style="border-color: #757575; border-radius: 0px;">Rp</span>
                        <input type="text" class="form-control" id="tunjangan_lainnya" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" placeholder="Tunjangan Lainnya" name="tunjangan_lainnya">
                    </div>
                    <span id="tunjangan_lainnya_error"></span>
                </div>
            </div>




        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Kirim</a>
        </div>
    </form>
<?php endif ?>