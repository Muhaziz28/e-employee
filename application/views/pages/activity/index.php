<div class="container-fluid float-left" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-warning font-weight-bold">Aktivitas Harian Pegawai</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url("activity"); ?>"></a>Activity</li>
        </ol>
    </div>

    <!-- Row -->
    <div class="row">

        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <!-- <h6 class="m-0 font-weight-bold text-warning">Daftar Divisi</h6> -->
                    <!-- <a href="<?= base_url("cuti/showForm"); ?>" class="btn btn-warning" id="btnTambahCuti">Tambah Data</a> -->

                </div>
                <!-- <div class="list-data-cuti">
                
        </div> -->

                <div class="card-body">
                    <?php if ($this->session->userdata('role') == 'hrd' || $this->session->userdata('role') == 'leader' || $this->session->userdata('role') == 'leader_finance' || $this->session->userdata('role') == 'leader_toko') : ?>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Pilih Pegawai</label>
                            <div class="col-sm-9">
                                <select class="select2-single-potong-cuti form-control" id="nip_pegawai_aktivitas">
                                    <option value=""></option>
                                    <?php foreach ($getPegawai as $row) : ?>
                                        <option value="<?= $row->nip; ?>"><?= $row->nip; ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
                                    <?php endforeach ?>
                                </select>



                            </div>
                        </div>
                    <?php endif ?>
                    <div class="result-activity">
                        <div class="wadahActivityPegawai">
                            <?php
                            $image = $pegawai->image;

                            ?>

                            <div id="result">
                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col-lg-4 mt-3">
                                            <div class="text-center">
                                                <img src="<?= isset($image) && $image != '' ? base_url("images/pegawai/$image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" style="width: 200px; margin-top: -10px;" class="card-img rounded-circle img-pegawai" alt="...">
                                                <h4 class="mt-3" id="nama_profile_pegawai_2"><?= $pegawai->nama; ?></h4>
                                                <p><?= $pegawai->email; ?></p>

                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td>NIP</td>
                                                        <td>:</td>
                                                        <td><?= $pegawai->nip; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Lengkap</td>
                                                        <td>:</td>
                                                        <td><span id="nama_profile_pegawai"><?= $pegawai->nama; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Divisi</td>
                                                        <td>:</td>
                                                        <td><?= $pegawai->nama_divisi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jabatan</td>
                                                        <td>:</td>
                                                        <td><?= $pegawai->nama_jabatan; ?></td>
                                                    </tr>





                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>






                            </div>









                        </div>
                        <a href="#" class="btn btn-primary ml-3" id="btnTambahAktivitat" data-nip="<?= $this->session->userdata('nip'); ?>" data-toggle="modal" data-target="#modalAddActivity"><i class="fas fa-plus mr-2"></i>Aktivitas</a>
                        <a href="<?= base_url("activity/export-to-excel?nip_pegawai=$pegawai->nip"); ?>" class="btn btn-success" id="btnExportAktivitas"><i class="fas fa-file-excel mr-2"></i>Export to Excel</a>
                        <div class="table-responsive p-3 table-aktivitas-space">
                            <?php $this->load->view('layouts/_alert'); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableAktivitas">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Aktivitas</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Realisasi</th>
                                        <th>Target</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($content as $row) : ?>
                                        <tr id="data-<?= $row->id; ?>">
                                            <td class="tanggal-aktivitas" style="width: 8%;"><?= date_format(new DateTime($row->tanggal), 'd/m/Y'); ?></td>
                                            <td class="isi-aktivitas"><?= $row->aktivitas; ?></td>
                                            <td class="mulai-aktivitas" style="width: 1%;"><?= date_format(new DateTime($row->mulai), 'H:i'); ?></td>
                                            <td class="selesai-aktivitas" style="width: 1%;"><?= date_format(new DateTime($row->selesai), 'H:i'); ?></td>
                                            <td class="realisasi-aktivitas"><?= $row->realisasi; ?></td>
                                            <td class="target-aktivitas"><?= $row->target == "" ? "-" : $row->target; ?></td>
                                            <td style="width: 15%;">
                                                <a href="#" class="btn btn-info mb-2" id="btnEditActivity" data-id="<?= $row->id; ?>"> Edit</a>
                                                <a href="#" class="btn btn-danger mb-2" id="btnDeleteActivity" data-id="<?= $row->id; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--Row-->






    </div>
</div>