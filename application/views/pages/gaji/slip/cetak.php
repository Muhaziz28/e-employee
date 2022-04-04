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
);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        #tfoot {
            border: none !important;
        }

        h4 {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <img src="assets/img/logo_soraya2.png" style="position: absolute; width: 90px; height: auto; margin-left: 20px;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold; font-size: 20px;">
                    PT. SORAYA BERJAYA INDONESIA
                    <br><span style="font-weight: 400; font-size: 15px;" class="mt-4">Jl.Raya Siteba No.26, RT.003 RW.002, Kel. Surau Gadang, Kec. Nanggalo, Padang</span>
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <p class="text-center" style="font-weight: 600; font-size: 18px;">
        SLIP GAJI


    </p>

    <table class="table">
        <tr>
            <td>Tanggal</td>
            <td style="text-align: right;"><?= date_format(new DateTime($slip_gaji->created_at), 'd/m/Y'); ?></td>
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

    <table class="table mt-5">
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

    <br>
    <br>
    <p>Prepared by,</p>
    <img src="assets/img/ttd_finance.jpg" style="width: 110px;">
    <p><u>Rafdi Okcandra</u><br>
        SPV Finance
    </p>



</body>

</html>