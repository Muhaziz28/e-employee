<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">


            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url("dashboard") ?>"></a>Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card h-100" style="border-left: solid 15px #66bb6a;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pegawai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countPegawai; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                <span>Seluruh Pegawai</span>
                            </div>
                        </div>
                        <div class="col-auto">

                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card h-100" style="border-left: solid 15px #fc544b;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pegawai Out</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countPegawaiOut; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                <span>Seluruh Pegawai Out</span>
                            </div>
                        </div>
                        <div class="col-auto">

                            <i class="fas fa-users fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card h-100" style="border-left: solid 15px #3abaf4;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pengajuan Cuti</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countCuti; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">

                                <span>Seluruh Cuti</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-desktop fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card h-100" style="border-left: solid 15px #ffa426;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pending Cuti</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countPendingCuti; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">

                                <span>Pending Cuti</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-file-alt fa-2x" style="color: #ffa426;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New User Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                                <span>Since last month</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Pending Requests Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                <span>Since yesterday</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Grafik Jumlah Pegawai berdasarkan Penempatan</h6>

                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartPegawai"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="m-0 small text-warning card-link" href="<?= base_url("pegawai"); ?>">View More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Grafik Jumlah Pegawai berdasarkan Jenis Kelamin</h6>

                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartJekel"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="m-0 small text-warning card-link" href="<?= base_url("pegawai"); ?>">View More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <!-- Invoice Example -->
        <!-- <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                    <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">RA0449</a></td>
                                <td>Udin Wayang</td>
                                <td>Nasi Padang</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA5324</a></td>
                                <td>Jaenab Bajigur</td>
                                <td>Gundam 90' Edition</td>
                                <td><span class="badge badge-warning">Shipping</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA8568</a></td>
                                <td>Rivat Mahesa</td>
                                <td>Oblong T-Shirt</td>
                                <td><span class="badge badge-danger">Pending</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA1453</a></td>
                                <td>Indri Junanda</td>
                                <td>Hat Rounded</td>
                                <td><span class="badge badge-info">Processing</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">RA1998</a></td>
                                <td>Udin Cilok</td>
                                <td>Baby Powder</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div> -->
        <!-- Message From Customer-->
        <!-- <div class="col-xl-6 col-lg-6 mb-5 ">
            <div class="card">
                <div class="card-header py-4 bg-secondary d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-white">Pengajuan Cuti</h6>
                </div>
                <div>
                    <?php foreach ($cuti as $row) : ?>

                        <?php if ($row->status_cuti == "pending") {
                            $jenisBadge = "warning";
                        } else if ($row->status_cuti == "diterima") {
                            $jenisBadge = "info";
                        } else {
                            $jenisBadge = "danger";
                        } ?>
                        <div class="customer-message align-items-center">
                            <a class="font-weight-bold text-warning" href="#" id="btnLihatCuti" data-id="<?= $row->id; ?>">
                                <div class="text-truncate message-title"><?= $row->nama; ?>&nbsp;ingin mengajukan cuti!<span class="badge badge-<?= $jenisBadge; ?> float-right"><?= ucwords($row->status_cuti); ?></span></div>
                                <div class="small text-gray-500 message-time font-weight-bold"><?= time_elapsed_string($row->tgl); ?></div>

                            </a>
                        </div>
                    <?php endforeach ?>

                    <div class="card-footer text-center">
                        <a class="m-0 small text-warning card-link" href="<?= base_url("cuti"); ?>">View More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-xl-6 col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Grafik Jumlah Pegawai berdasarkan Rentang Durasi Kerja</h6>

                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartDurasiKerja"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="m-0 small text-warning card-link" href="<?= base_url("pegawai"); ?>">View More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Grafik Jumlah Pegawai berdasarkan Rentang Umur</h6>

                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartUmur"></canvas>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="m-0 small text-warning card-link" href="<?= base_url("pegawai"); ?>">View More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->



</div>