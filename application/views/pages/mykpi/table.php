<div class="row">

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <!-- <h6 class="m-0 font-weight-bold text-warning">Daftar Divisi</h6> -->



                <div class="col-lg-6" style="margin-top: 0px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>

                        <select class="form-control" id="bulan_filter_kpi" name="bulan_kpi">
                            <option value="">- Pilih Bulan -</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6" style="margin-top: 50px;">


                    <div class="input-group date">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tahun" id="tahun_filter_kpi" name="tahun_kpi" autocomplete="off" value="">
                    </div>
                    <a href="#" class="btn btn-info float-right mt-3" id="btnFilterMyKpi"><i class="fas fa-filter mr-2"></i>Filter<img src="<?= base_url("assets/img/load/load2.svg"); ?>" width="25px;" id="loadBtnFilter"></a>

                </div>






            </div>
            <div class="list-data-mykpi">
                <div id="anim4" class="mx-auto mt-3" style="width: 100px;"></div>
                <div class="text-center mt-3">
                    <p><strong>Harap Tunggu...</strong></p>
                </div>
            </div>

        </div>
    </div>
</div>