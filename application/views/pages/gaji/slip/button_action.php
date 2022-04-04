<?php
$bln_tahun_skrg = date("Y-m");
$tgl_slip_gaji = isset($slip_gaji->created_at) ? $slip_gaji->created_at : "";
if (isset($slip_gaji->total_gaji) && date_format(new DateTime($tgl_slip_gaji), 'Y-m') == $bln_tahun_skrg) : ?>
    <button class="btn btn-info" id="btnEditSlipGaji" data-nip="<?= $slip_gaji->nip_pegawai; ?>">Edit Slip Gaji</button>
    <button class="btn btn-warning" id="btnLihatSlipGaji" data-nip="<?= $slip_gaji->nip_pegawai; ?>">Lihat Slip Gaji</button>
<?php endif ?>