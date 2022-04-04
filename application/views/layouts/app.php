<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= isset($title) ? $title : "Soraya Bedshet -" ?></title>
    <!-- style -->
    <?php $this->load->view('layouts/_style'); ?>


    <!--style-->
</head>

<body id="page-top" data-role="<?= $this->session->userdata('role'); ?>" style="display: none;">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('layouts/_sidebar'); ?>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php $this->load->view('layouts/_alert2'); ?>
                <!-- TopBar -->
                <?php $this->load->view('layouts/_topbar'); ?>
                <!-- Topbar -->


                <!-- Container Fluid-->
                <?php $this->load->view($page); ?>
                <!-- Container Fluid-->

                <!-- Modal Logout -->
                <?php $this->load->view('layouts/_modal_logout'); ?>

                <!-- Wadah Modal -->
                <?php $this->load->view('layouts/_wadah_modal'); ?>

            </div>
            <!-- Footer -->
            <?php $this->load->view('layouts/_footer'); ?>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- script -->
    <?php $this->load->view('layouts/_script'); ?>
    <!-- script -->

</body>

</html>