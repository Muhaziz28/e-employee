<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= base_url("assets") ?>/img/logo/favicon.png" rel="icon">
    <title><?= $title; ?></title>
    <link href="<?= base_url("assets") ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url("assets") ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url("assets") ?>/css/ruang-admin.min.css" rel="stylesheet">
    <style>
        .input-group-prepend span {
            -webkit-box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
            box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
            color: #fff;
            background-color: #feb664;
            border-color: #feb664;
        }
    </style>
</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">

                            <div class="col-lg-12 my-auto">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900">Masuk</h1>
                                        <p class="text-gray-500">Isi form di bawah ini untuk masuk.</p>

                                    </div>
                                    <?php $this->load->view('layouts/_alert'); ?>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12">
                                            <div id="anim_login" class="mx-auto" style="width: 300px;">

                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <form action="<?= base_url("login"); ?>" method="POST" class="user mt-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                                    </div>
                                                    <?= form_error('email'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                        </div>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                    </div>
                                                    <?= form_error('password'); ?>
                                                </div>

                                                <div class="form-group mt-5">
                                                    <button type="submit" class="btn btn-secondary btn-block">Masuk</a>
                                                </div>
                                                <hr>

                                            </form>
                                        </div>
                                    </div>



                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="<?= base_url("assets") ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url("assets") ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("assets") ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url("assets") ?>/js/ruang-admin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>
    <script>
        var animation = bodymovin.loadAnimation({
            container: document.getElementById('anim_login'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: './assets/anim/grape/Animation07/drawkit-grape-animation-7-LOOP.json'
        });
    </script>
</body>

</html>