<div class="row">

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <!-- <h6 class="m-0 font-weight-bold text-warning">Daftar Divisi</h6> -->
                <form action="<?= base_url("report/exportToExcelPegawaiInOut") ?>" method="POST">
                    <input type="hidden" name="tgl_start_excel" id="tgl_start_excel">
                    <input type="hidden" name="tgl_end_excel" id="tgl_end_excel">
                    <button type="submit" class="btn btn-success" id="btnExportExcelPegawaiInOut"><i class="fas fa-file-excel mr-2"></i>Export to Excel</a>
                </form>

            </div>
            <!-- <div class="list-data-cuti">
                    
            </div> -->
            <div class="wadahFormLaporanPegawaiInOut">
                <div id="anim4" class="mx-auto mt-3" style="width: 100px;"></div>
                <div class="text-center mt-3">
                    <p><strong>Harap Tunggu...</strong></p>
                </div>
            </div>



        </div>
    </div>

    <div class="result-report-pegawai-in-out">


    </div>

</div>