<?php

$nama  = $this->session->userdata('name');
$image = $this->session->userdata('image');
$nip   = $this->session->userdata('nip');
$email = $this->session->userdata('email');
$tempat_lahir = $this->session->userdata('tempat_lahir');
$tgl_lahir = $this->session->userdata('tgl_lahir');
$jenis_kelamin = $this->session->userdata('jenis_kelamin');
$agama	= $this->session->userdata('agama');
$status	= $this->session->userdata('status');
$status_pegawai	= $this->session->userdata('status_pegawai');
$alamat	= $this->session->userdata('alamat');
$nohp	= $this->session->userdata('nohp');
$pendidikan	= $this->session->userdata('pendidikan');
$nama_divisi	= $this->session->userdata('nama_divisi');
$nama_jabatan	= $this->session->userdata('nama_jabatan');
$nama_level	= $this->session->userdata('nama_level');
$tgl_masuk	= $this->session->userdata('tgl_masuk');
$durasi_kerja	= $this->session->userdata('durasi_kerja');
$satuan_durasi	= $this->session->userdata('satuan_durasi');
$panggilan = explode(" ", $nama);
?>
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Profile</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>
	</div>



	<div class="row mb-3">
		<div class="col-xl-8 col-lg-7">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-warning">Identitas Diri</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<td>Nama Lengkap</td>
								<td>:</td>
								<td><span id="nama_profile_pegawai"><?= $nama; ?></span></td>
							</tr>
							<tr>
								<td>NIP</td>
								<td>:</td>
								<td><?= $nip; ?></td>
							</tr>
							<tr>
								<td>No HP</td>
								<td>:</td>
								<td><?= $nohp; ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td><?= $jenis_kelamin; ?></td>
							</tr>
							<tr>
								<td>TTL</td>
								<td>:</td>
								<td><?= $tempat_lahir; ?>, <?= date_format(new DateTime($tgl_lahir), 'd-m-Y'); ?></td>
							</tr>
							<tr>
								<td>Status</td>
								<td>:</td>
								<td><?= $status; ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td><?= $alamat; ?></td>
							</tr>


						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-5">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-warning">Profile</h6>
					<div class="dropdown no-arrow">
						<a href="#" class="btn btn-secondary btn-sm" id="btnEditProfile" data-nip="<?= $nip; ?>"><i class="fas fa-user-edit"></i>&nbsp;Edit Profile</a>

					</div>
				</div>
				<div class="card-body">
					<div class="text-center">
						<img src="<?= isset($image) && $image != '' ? base_url("images/pegawai/$image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" style="width: 200px; margin-top: -10px;" class="card-img rounded-circle img-pegawai" alt="...">
						<h4 class="mt-3" id="nama_profile_pegawai_2"><?= $nama; ?></h4>
						<p><?= $email; ?></p>
						<a href="#" class="btn btn-info">Lihat Riwayat Gaji&nbsp;<img src="<?= base_url("assets/img/load/load2.svg"); ?>" width="25px;" class="loadBtnGaji"></a>
						<a href="#" class="btn btn-warning" id="btnRiwayatCuti" data-nip="<?= $nip; ?>">Lihat Riwayat Cuti&nbsp;<img src="<?= base_url("assets/img/load/load2.svg"); ?>" width="25px;" class="loadBtn"></a>
					</div>
				</div>
				<!-- <div class="card-footer text-center">
					<a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
				</div> -->
			</div>
		</div>




		<div class="col-xl-12 col-lg-7">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-warning">Status Kepegawaian</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td><?= $pendidikan; ?></td>
							</tr>
							<tr>
								<td>Divisi</td>
								<td>:</td>
								<td><?= $nama_divisi; ?></td>
							</tr>
							<tr>
								<td>Jabatan</td>
								<td>:</td>
								<td><?= $nama_jabatan; ?></td>
							</tr>
							<tr>
								<td>Tingkatan Pegawai</td>
								<td>:</td>
								<td><?= $nama_level; ?></td>
							</tr>
							<tr>
								<td>Tanggal Masuk</td>
								<td>:</td>
								<td><?= date_format(new DateTime($tgl_masuk), 'd-m-Y'); ?></td>
							</tr>
							<tr>
								<td>Status Pegawai</td>
								<td>:</td>
								<td><?= $status_pegawai; ?></td>
							</tr>
							<tr>
								<td>Durasi Kontrak</td>
								<td>:</td>
								<?php
								if ($satuan_durasi == "month") {
									$nama_satuan_durasi = "Bulan";
								} else {
									$nama_satuan_durasi = "Tahun";
								}
								?>

								<td>
									<?php if ($status_pegawai == "Kontrak") : ?>
										<?= $durasi_kerja . " " . $nama_satuan_durasi; ?>
									<?php else : ?>
										-
									<?php endif ?>
								</td>
							</tr>



						</table>
					</div>
				</div>
			</div>
		</div>


	</div>



	<!-- <div class="row">
		<div class="col-lg-12 text-center">
			<p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin" class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
		</div>
	</div> -->



</div>