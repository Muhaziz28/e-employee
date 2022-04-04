<!DOCTYPE html>
<html lang="en">

<?php
    if($status == "diterima"){
        $conv_status = "menerima";
    } else {
        $conv_status = "menolak";
    }
?>

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
        <?= $nama; ?><br>
        PT. Soraya Berjaya Indonesia <br>
        Di tempat. <br>

        <br>
        <br>
        Perihal : <u>Tindak Lanjut Permohonan Cuti</u>

    </p>
    <br>
    <p>Dengan Hormat,</p>
    <p>Terima Kasih atas permohonan cuti Anda, menindaklanjuti permohonan cuti Anda, maka HRD telah <b><?= $conv_status; ?></b> permohonan cuti Anda. <br>
        Harap untuk menemui HRD untuk proses lebih lanjut.
    </p>

    <!-- <p style="margin-top: 50px;">Bermaksud untuk mengajukan izin cuti selama 2 hari kerja, dengan alasan adanya keperluan keluarga yang tidak bisa ditinggalkan. <br>
    Demikian surat izin cuti ini saya ajukan, atas kebijakannya saya mengucapkan terima kasih.</p> -->

    <br>
    <br>
    <p>Hormat Saya</p>

    <br>
    <br>

    <p><strong>Human Resources</strong></p>
</body>

</html>