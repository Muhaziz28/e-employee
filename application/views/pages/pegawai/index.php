<div class="container-fluid justify-content-center" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-warning font-weight-bold">Daftar Pegawai</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>

            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url("pegawai") ?>"></a>Pegawai</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4">

            <a href="<?= base_url("pegawai/add") ?>" class="btn btn-warning">Tambah Pegawai</a>
            <a href="<?= base_url("pegawai/exportToExcel/pegawai") ?>" class="btn btn-success ml-2"><i class="fas fa-file-excel mr-2"></i>Export to Excel</a>
            <a href="<?= base_url("pegawai/id_card"); ?>" class="btn btn-info ml-2" target="_blank">Generate ID Card</a>
            <a href="<?= base_url("pegawai/id_card"); ?>" class="btn btn-secondary ml-2" id="btnShowModalGenerateIdCard" target="_blank">Pilih Pegawai untuk Generate ID Card</a>
            <form class="form-inline float-right">

                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Search</label>
                    <input type="text" class="form-control" id="searchPegawai" placeholder="Search">
                </div>
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_filter_pegawai"><i class="fas fa-sliders-h mr-2"></i>Filter</button>
            </form>

        </div>

    </div>
    <div id="list_pegawai">
        <div id="load-pegawai">
            <div id="anim4" class="mx-auto mt-3" style="width: 100px;"></div>
            <div class="text-center mt-3">
                <p><strong>Harap Tunggu...</strong></p>
            </div>
        </div>


    </div>

</div>