<link href="<?= base_url("assets/") ?>img/logo/favicon.png" rel="icon">
<link href="<?= base_url("assets/") ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url("assets/") ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<!-- Select2 -->
<link href="<?= base_url("assets/") ?>vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap DatePicker -->
<link href="<?= base_url("assets/") ?>vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- Bootstrap Touchspin -->
<link href="<?= base_url("assets/") ?>vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet">
<!-- ClockPicker -->
<link href="<?= base_url("assets/") ?>vendor/clock-picker/clockpicker.css" rel="stylesheet">
<link href="<?= base_url("assets/") ?>css/ruang-admin.min.css" rel="stylesheet">
<link href="<?= base_url("assets/") ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.2/css/fixedColumns.bootstrap4.min.css" crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" />


<style>
    /* .table-sticky-avt thead .sticky {
        position: sticky;
        top: 0;
        z-index: 1;
    }

    .table-sticky-avt thead .sticky {
        position: sticky;
        left: 0;
        z-index: 99;
    } */

    #dataTableRekapAktivitas_paginate .pagination {
        margin-top: 30px;
    }

    #dataTableRekapAktivitas_info {
        margin-top: 30px;
    }

    .table-activity {
        width: 1400px !important;
    }

    @media (min-width: 1400px) {
        .table-activity {
            width: 100% !important;
        }
    }

    .input-group-append span {
        -webkit-box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        color: #fff;
        background-color: #feb664;
        border-color: #feb664;
    }

    .bg-navbar {
        background-color: #565656;
    }

    .bg-table-grey {
        background-color: rgba(0, 0, 0, .05);
    }

    .modal-xl {
        max-width: 98% !important;
    }

    .sidebar-light .sidebar-brand {
        color: #fafafa;
        background-color: #333333;
    }

    .sidebar .sidebar-brand .sidebar-brand-icon img {
        max-height: 2.3rem;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #ffa426;
        border-color: #ffa426;
    }

    .page-link {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #ffa426;
        background-color: #fff;
        border: 1px solid #dddfeb;
        -webkit-box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
    }

    .custom-control-input:checked~.custom-control-label::before {
        color: #fff;
        border-color: #f3a54c;
        background-color: #f3a54c;
    }

    .input-group-prepend span {
        -webkit-box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        color: #fff;
        background-color: #feb664;
        border-color: #feb664;
    }


    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Telusuri";
        color: #fff;
        background-color: #ffa426;
        border-color: #ffa426;
    }

    .select2 {
        width: 100% !important;
    }

    .frame-pegawai {
        border: 1px solid rgba(58, 59, 69, .2);
        border-radius: 15px;
    }


    .topbar .dropdown-list .dropdown-header {
        background-color: #565656;
        ;
        border: 1px solid #565656;
        ;
        padding-top: .75rem;
        padding-bottom: .75rem;
        color: #fff;
    }

    .loadBtnGaji {
        display: none;
    }

    #btnExportExcelPegawaiInOut {
        display: none;
    }

    #loadBtn {
        display: none;
    }

    #loadBtnFilter {
        display: none;
    }

    .modal {
        overflow: auto !important;
    }

    @media (max-width: 991px) {
        .img-pegawai {
            width: 200px;
        }

        .table-data-pegawai {
            margin-top: 20px;
        }

        .frame-pegawai {
            margin-left: 0px !important;
        }

        .btn-filter button {
            width: 20% !important;
        }
    }

    @media (max-width: 1384px) {
        /* .group-btn{
            width: 0px;
           
        } */

        .group-btn #btnLihatPegawai {
            margin-top: 5px;
        }
    }
</style>