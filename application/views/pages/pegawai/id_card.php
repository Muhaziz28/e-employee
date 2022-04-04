<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }

        .card {
            width: 7.7cm;
            background-color: #fcded4;
            border: none;
            border-radius: 0;
        }

        .card .card-body {
            padding-top: 0;
            padding-bottom: 0;
            padding-left: 16px;
        }

        .card .card-body p {
            font-size: 10px;
            font-weight: bold;
            color: #f16c35;

        }

        .card .card-body h6 {
            color: #f16c35;
        }

        .card .card-body .side-card {
            background-color: #f16c35;
        }

        .nama-pegawai {
            border-bottom: 2px solid #f16c35;
            padding-bottom: 1px;
            display: block;
            font-size: 16px;
        }

        .nip-pegawai {
            font-size: 14px;
            margin-top: -5px;
        }

        .website {
            writing-mode: vertical-lr;
            display: inline;
            font-size: 14px;
            color: white;
            letter-spacing: 1px;
            font-weight: 400;
            transform: rotate(180deg);
            margin-top: 140px;
            margin-left: 10px;
        }

        .tagline-space {
            margin-bottom: 15px;
        }

        .tagline {
            color: #fff;
            letter-spacing: 1px;
            background-color: #f16c35;
            padding: 2px 7px;
            font-size: 10px;
        }

        .pegawai-space {
            margin-top: 45px;
        }

        @media print {
            .pagination-area {
                display: none;
            }
        }
    </style>
    <title>ID CARD PEGAWAI</title>
</head>

<body>
    <div class="container py-3">
        <div class="row align-items-center justify-content-start">
            <?php foreach ($pegawai as $row) : ?>
                <div class="col-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 side-card">
                                    <div class="website">www.sorayabedsheet.id</div>
                                </div>
                                <div class="col-10 mt-4">
                                    <div class="text-center mb-3">
                                        <img src="https://www.sorayabedsheet.id/assets/images/logos/logo.png" width="130" alt="logo-soraya">
                                        <p>PT. SORAYA BERJAYA INDONESIA</p>
                                    </div>
                                    <div class="text-center mb-4">
                                        <img src="https://hrd.sorayabedsheet.id/images/pegawai/<?= $row->image; ?>" class="img-fluid rounded-circle" width="180" alt="pegawai">
                                        <img src="https://hrd.sorayabedsheet.id/code/qrcode/<?= $row->nip; ?>" class="img-fluid" style="width: 60px; position: absolute;
                    left: 9rem; top: 14rem;">
                                    </div>
                                    <div class="text-center pegawai-space">
                                        <h6 class="nama-pegawai"><?= $row->nama; ?></h6>
                                        <h6 class="nip-pegawai">NIP. <?= $row->nip; ?></h6>
                                    </div>
                                    <div class="text-center tagline-space">
                                        <span class="tagline"><strong>Inspirasi Kamar Tidurmu</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="row mt-4 mb-3 pagination-area">
            <div class="col-lg-12">
                <div id="pagination">
                    <nav aria-label="...">
                        <!-- <ul class="pagination" class="justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">
                            2
                            <span class="sr-only">(current)</span>
                        </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul> -->

                        <?= isset($pagination) ? $pagination : ""; ?>
                    </nav>
                </div>

            </div>

        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        window.onload = function() {
            window.print();
        }
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
</body>

</html>