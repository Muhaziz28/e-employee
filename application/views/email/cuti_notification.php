<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Cuti</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <img src="<?= base_url("assets/img/logo/logo_soraya2-min.png"); ?>" style="width: 100px;" alt="">
    <p>
        Kepada Yth., <br>
        Bapak HRD<br>
        PT. Soraya Berjaya Indonesia <br>
        Di tempat. <br>

        <br>
        <br>
        Perihal : <u>Permohonan Izin Cuti</u>

    </p>
    <br>
    <p>Dengan Hormat,</p>
    <p>Berikut saya lampirkan data diri saya :</p>
    <ul style="list-style: none; margin-left: -10px;">
        <li style="margin-bottom: 10px;">Nama : <?= $nama; ?></li>
        <li style="margin-bottom: 10px;">Alamat : <?= $alamat; ?></li>
        <li style="margin-bottom: 10px;">No HP : <?= $nohp; ?></li>
        <li>Jabatan : <?= $jabatan; ?></li>
    </ul>

    <p style="margin-top: 50px;">Bermaksud untuk mengajukan izin cuti selama <?= $lama_cuti; ?> hari kerja, <?= $alasan_cuti; ?> <br>
        Demikian surat izin cuti ini saya ajukan, atas kebijakannya saya mengucapkan terima kasih.</p>

    <br>
    <br>
    <p>Hormat Saya</p>

    <br>
    <br>

    <p><strong><?= $nama; ?></strong></p>
</body>

</html>