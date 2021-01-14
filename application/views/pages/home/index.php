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
		<h1 class="h3 mb-0 text-gray-800">Selamat Datang! <?= $panggilan[0]; ?></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>
	</div>

	<div class="row mb-3">
		<div class="col-lg-12">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-5">
							<div id="anim" class="mx-auto" style="width: 300px;">

							</div>
						</div>
						<div class="col-lg-5 my-auto">
							<h3 class="text-grey-700">Ingin Mengajukan Cuti?</h3>
							<p>Ajukan cutimu kepada HRD dengan mudah dengan menekan tombol di bawah ini, dan tunggu HRD meng-<i>konfirmasi</i> ajuan cutimu.</p>
							<a href="#" class="btn btn-warning" id="btnAjukanCuti" data-jatahcuti="<?= $this->session->userdata('jatah_cuti'); ?>" data-nip="<?= $this->session->userdata('nip'); ?>">AJUKAN CUTIMU</a>

						</div>
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