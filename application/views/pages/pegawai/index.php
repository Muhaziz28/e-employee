<div class="container-fluid justify-content-center" id="container-wrapper">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <h1 class="h3 mb-3 text-warning font-weight-bold">Daftar Pegawai</h1>
            <a href="<?= base_url("pegawai/add") ?>" class="btn btn-warning">Tambah Pegawai</a>
            <form class="form-inline float-right">

                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Search</label>
                    <input type="text" class="form-control" id="searchPegawai" placeholder="Search">
                </div>
                <!-- <button type="submit" class="btn btn-primary mb-2">Cari</button> -->
            </form>
        </div>

    </div>
    <div id="list_pegawai">

        
    </div>

</div>