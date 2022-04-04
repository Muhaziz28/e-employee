<?php

$penambahan = array(
    'gaji'      => $gaji->jumlah_gaji,
    'lembur'    => $slip_gaji->lembur,
    'bonus'     => $slip_gaji->bonus
);

$pengurangan = array(
    'bpjs'               => $slip_gaji->bpjs,
    'bon'                => $slip_gaji->bon,
    'simp_koperasi'      => $slip_gaji->simp_koperasi,
    'dana_sosial'        => $slip_gaji->dana_sosial,
    'pinjaman'           => $slip_gaji->pinjaman,
    'kpi'                => $slip_gaji->kpi,
)
?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row">
        <div class="col-lg-12">
            <?php if ($emp == false) : ?>
                <a href="<?= base_url("gaji/print/$pegawai->nip"); ?>" class="btn btn-danger float-right"><i class="fas fa-file-pdf mr-2"></i>Cetak Slip Gaji</a>
            <?php else : ?>
                <a href="<?= base_url("gaji/print_slip_gaji/$slip_gaji->id/$pegawai->nip"); ?>" class="btn btn-danger float-right"><i class="fas fa-file-pdf mr-2"></i>Cetak Slip Gaji</a>
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h5 class="text-warning mb-3">Data Pegawai</h5>
            <div class="table-responsive">
                <table class="table tbl-striped">
                    <tr>
                        <td>Tanggal</td>
                        <td><?= date_format(new DateTime($slip_gaji->created_at), 'd/m/Y'); ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?= $pegawai->nama; ?></td>
                    </tr>
                    <tr>
                        <td>Divisi</td>
                        <td><?= $pegawai->nama_divisi; ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td><?= $pegawai->nama_jabatan; ?></td>
                    </tr>
                    <tr>
                        <td>Penempatan</td>
                        <td><?= $pegawai->nama_lokasi; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h5 class="text-warning mb-3">Data Gaji</h5>
            <div class="table-responsive">
                <table class="table tbl-striped">
                    <!-- penambahan -->
                    <tr>
                        <td>No</td>
                        <td>KETERANGAN</td>
                        <td></td>
                        <td style="text-align: right;">JUMLAH</td>
                    </tr>
                    <tr>
                        <td>1. Penambahan</td>
                        <td>GAJI</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($gaji->jumlah_gaji, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>Lembur</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->lembur, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>Bonus</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->bonus, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td>TOTAL GAJI</td>
                        <td></td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format(array_sum($penambahan), 0, ',', '.') ?></td>
                    </tr>

                    <!-- pengurangan -->

                    <tr>
                        <td>2. Pengurangan</td>
                        <td>BPJS</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->bpjs, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>BON</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->bon, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>SIMP.KOPERASI</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->simp_koperasi, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>DANA SOSIAL</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->dana_sosial, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>PINJAMAN</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->pinjaman, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>KPI</td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format($slip_gaji->kpi, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td>TOTAL PENGURANGAN</td>
                        <td></td>
                        <td>Rp</td>
                        <td style="text-align: right;"><?= number_format(array_sum($pengurangan), 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                        <td>GAJI BERSIH</td>
                        <td></td>
                        <td>Rp</td>
                        <td style="text-align: right; font-weight: bolder;"><?= number_format($slip_gaji->total_gaji, 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>




</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
    
</div>