<?php
$nama  = $this->session->userdata('name');
$image = $this->session->userdata('image');
$nip   = $this->session->userdata('nip');
$email = $this->session->userdata('email');
$tempat_lahir = $this->session->userdata('tempat_lahir');
$tgl_lahir = $this->session->userdata('tgl_lahir');
$jenis_kelamin = $this->session->userdata('jenis_kelamin');
$agama    = $this->session->userdata('agama');
$status    = $this->session->userdata('status');
$status_pegawai    = $this->session->userdata('status_pegawai');
$alamat    = $this->session->userdata('alamat');
$nohp    = $this->session->userdata('nohp');
$pendidikan    = $this->session->userdata('pendidikan');
$nama_divisi    = $this->session->userdata('nama_divisi');
$nama_jabatan    = $this->session->userdata('nama_jabatan');
$nama_level    = $this->session->userdata('nama_level');
$tgl_masuk    = $this->session->userdata('tgl_masuk');
$durasi_kerja    = $this->session->userdata('durasi_kerja');
$satuan_durasi    = $this->session->userdata('satuan_durasi');
?>

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="<?= base_url("cuti/insert") ?>" method="POST" id="formAjukanCuti">
    <div class="modal-body">
        <?php $this->load->view('layouts/_alert'); ?>
        <input type="hidden" name="nip_pegawai" id="nip_pegawai" value="<?= $nip; ?>">
        <input type="hidden" name="nama_pegawai" id="nama_pegawai" value="<?= $nama; ?>">
        <h6 class="m-0 font-weight-bold text-warning mb-4">Identitas Diri</h6>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $nama; ?></td>
                </tr>
                <tr>
                    <td>Divisi</td>
                    <td>:</td>
                    <td><?= $nama_divisi; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $nama_jabatan; ?></td>
                </tr>
            </table>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-lg-12">

                <p>Dengan ini ingin mengajukan cuti dengan data sebagai berikut :</p>
            </div>
        </div>




        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Cuti</label>
            <div class="col-sm-9">
                <?php
                $jatah_cuti = $this->session->userdata('jatah_cuti');

                if ($jatah_cuti <= 0) : ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_cuti" id="inlineRadio1" value="Cuti Tahunan" disabled>
                        <label class="form-check-label" for="inlineRadio1">Cuti Tahunan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_cuti" id="inlineRadio2" value="Cuti Khusus" checked>
                        <label class="form-check-label" for="inlineRadio2">Cuti Khusus</label>
                    </div> <br>
                    <span id="jenis_cuti_error"></span>
                <?php else : ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_cuti" id="inlineRadio1" value="Cuti Tahunan">
                        <label class="form-check-label" for="inlineRadio1">Cuti Tahunan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_cuti" id="inlineRadio2" value="Cuti Khusus">
                        <label class="form-check-label" for="inlineRadio2">Cuti Khusus</label>
                    </div> <br>
                    <span id="jenis_cuti_error"></span>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Lama Cuti</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="lama_cuti" placeholder="Lama Cuti (hari)" min="1" name="lama_cuti">
                <span id="lama_cuti_error"></span>
            </div>
        </div>
        <div class="form-group row" id="simple-date1">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Cuti</label>
            <div class="col-sm-9 date">
                <input type="text" class="form-control" id="tgl_cuti" placeholder="Tanggal Cuti" min="1" name="tgl_cuti" autocomplete="off">
                <span id="tgl_cuti_error"></span>
            </div>
        </div>


        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Alasan Cuti</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="alasan_cuti" placeholder="Alasan Cuti" rows="4" name="alasan_cuti"></textarea>
                <span id="alasan_cuti_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Alamat Cuti</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="alamat_cuti" placeholder="Alamat Cuti" rows="4" name="alamat_cuti"></textarea>
                <span id="alamat_cuti_error"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Tugas Digantikan oleh</label>
            <div class="col-sm-9">
                <select class="select2-tugas form-control" name="nip_pengganti" id="nip_pengganti">
                    <option></option>
                    <?php foreach ($pegawai as $row) : ?>
                        <option value="<?= $row->nip; ?>"><?= $row->nip; ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
                    <?php endforeach ?>
                </select>
                <span id="nip_pengganti_error"></span>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Kirim</a>
    </div>
</form>