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
<div class="modal fade" id="modalAddActivity" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Tambahkan Aktivitas Kerjamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("activity/add"); ?>" method="POST" id="formTambahActivity">
                    <input type="hidden" name="nip_pegawai_activity" id="nip_pegawai_activity" value="<?= $nip; ?>">
                    <input type="hidden" name="nama_pegawai_activity" id="nama_pegawai_activity" value="<?= $nama; ?>">
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
                    <div class="row mt-4">
                        <div class="col">
                            <h6>Isi Form di bawah ini untuk mengisi aktivitas kerjamu.</h6>
                            <p>Tanggal : <strong><?= date_format(new DateTime(), 'l, d F Y'); ?></strong></p>
                        </div>
                    </div>

                    <div class="" style="overflow-x:auto;">
                        <table class="table table-striped table-activity">
                            <thead class="table-dark">
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;"></th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Aktivitas*</th>
                                    <th colspan="2" class="text-center">Waktu*</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Realisasi*</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Target (jika ada)</th>
                                </tr>
                                <tr class="">
                                    <th class="text-center">Mulai</th>
                                    <th class="text-center">Selesai</th>
                                </tr>
                            </thead>

                            <tbody class="content-table-activity">
                                <tr>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <!-- <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button> -->
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control activity" name="activity[]" id="activity" rows="3" autocomplete="off" placeholder="Isikan aktivitas Anda disini.."></textarea>
                                            <span class="activity-err err-space" id="activity_0"></span>
                                        </div>
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <div class="form-group">
                                            <div class="input-group clockpicker cp-2" id="clockPicker2">
                                                <input type="text" class="form-control" name="mulai[]" id="mulai" value="" autocomplete="off" placeholder="HH:mm">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                            </div>
                                            <span class="mulai-err err-space" id="mulai_0"></span>
                                        </div>
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <div class="form-group">
                                            <div class="input-group clockpicker cp-2" id="clockPicker2">
                                                <input type="text" class="form-control" name="akhir[]" id="akhir" value="" autocomplete="off" placeholder="HH:mm">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                            </div>
                                            <span class="akhir-err err-space" id="akhir_0"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control" name="realisasi[]" id="realisasi" rows="3" autocomplete="off" placeholder="Isikan realisasi dari aktivitas Anda disini.."></textarea>
                                            <span class="realisasi-err err-space" id="realisasi_0"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control" name="target[]" id="target" rows="3" autocomplete="off" placeholder="Isikan target dari aktivitas Anda jika ada.."></textarea>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>


                        </table>

                    </div>
                </form>
                <div class="row mt-3 mb-3">
                    <div class="col">
                        <button type="button" id="btnTambahAktivitasLainnya" class="btn btn-outline-primary btn-block"><i class="fas fa-plus mr-2"></i>Tambah Aktivitas Lainnya</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning" id="btnSubmitFormAddActivity">Kirim</a>
            </div>
        </div>
    </div>
</div>