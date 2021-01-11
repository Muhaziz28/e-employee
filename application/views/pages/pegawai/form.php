<div class="container" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-warning font-weight-bold"><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 text-info"><?= $sub_title; ?></h6>
                </div>
                <div class="card-body">
                    <?= form_open_multipart($form_action, ['method' => 'POST', 'id' => 'formTambahPegawai']); ?>

                    <div class="form-group">
                        <input type="hidden" name="nip" id="nip_pegawai">
                        <input type="hidden" id="nip_max_pegawai">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nama_pegawai" name="nama" placeholder="Nama Lengkap Pegawai">
                                </div>
                                <span id="nama_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">E-mail</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="email_pegawai" name="email" placeholder="Alamat Email Pegawai">
                                </div>
                                <span id="email_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="tempat_lahir_pegawai" name="tempat_lahir" placeholder="Tempat Lahir">
                                </div>
                                <span id="tempat_lahir_error"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="simple-date1">
                                    <label for="simpleDataInput">Tanggal Lahir</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Tanggal Lahir" id="tgl_lahir_pegawai" name="tgl_lahir" autocomplete="off">
                                    </div>
                                    <span id="tgl_lahir_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">No HP</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nohp_pegawai" name="nohp" placeholder="No HP">
                                </div>
                                <span id="nohp_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="password_pegawai" name="password" placeholder="Password" value="<?= $random_password; ?>" disabled>
                                    <input type="hidden" class="form-control" id="password_generator_pegawai" name="password_generator" value="<?= $random_password; ?>">
                                </div>
                                <span id="nohp_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Jenis Kelamin</label> <br>

                                <div class="custom-control custom-radio form-check form-check-inline">
                                    <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" class="custom-control-input jenis_kelamin" name="jenis_kelawmin">
                                    <label class="custom-control-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio form-check form-check-inline">
                                    <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" class="custom-control-input jenis_kelamin" name="jenis_kelamin">
                                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                                </div>
                                <span id="jenis_kelamin_error"></span>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="simpleDataInput">Agama</label>
                                <select class="form-control" id="agama_pegawai" name="agama">
                                    <option value="">- Pilih Agama -</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                                </select>
                                <span id="agama_error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="simpleDataInput">Status Nikah</label>
                                <select class="form-control" id="status_nikah_pegawai" name="status">
                                    <option value="">- Pilih Status Nikah -</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Belum Menikah">Belum Menikah</option>


                                </select>
                                <span id="status_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="simpleDataInput">Pendidikan</label>
                                <select class="form-control" id="pendidikan_pegawai" name="pendidikan">
                                    <option value="">- Pilih Pendidikan -</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA/K">SMA/K</option>
                                    <option value="D3">D3</option>
                                    <option value="D4/S1">D4/S1</option>
                                    <option value="S2">S2</option>

                                </select>
                                <span id="pendidikan_error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="simpleDataInput">Status Pegawai</label>
                                <select class="form-control" id="status_pegawai" name="status_pegawai">
                                    <option value="">- Pilih Status Pegawai -</option>
                                    <option value="Kontrak">Kontrak</option>
                                    <option value="Tetap">Tetap</option>


                                </select>
                                <span id="status_pegawai_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="simple-date1">
                                    <label for="simpleDataInput">Tanggal Masuk</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Tanggal Masuk" id="tgl_masuk_pegawai" name="tgl_masuk" autocomplete="off">
                                    </div>
                                    <span id="tgl_masuk_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="exampleInputEmail1">Durasi Kerja</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="durasi_kerja_pegawai" name="durasi_kerja" placeholder="Durasi" disabled>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <label for="simpleDataInput">Satuan Durasi</label>
                                <select class="form-control" id="satuan_durasi_pegawai" name="satuan_durasi" disabled>
                                    <option value="">- Pilih Satuan Durasi -</option>
                                    <option value="month">Bulan</option>
                                    <option value="year">Tahun</option>


                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="alamat_pegawai">Alamat</label>
                                <textarea class="form-control" id="alamat_pegawai" name="alamat" rows="4"></textarea>
                                <span id="alamat_error"></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Divisi</label>
                                <select class="form-control" id="id_divisi_pegawai" name="id_divisi">
                                    <option value="">- Pilih Divisi -</option>
                                    <?php foreach ($divisi as $row) : ?>
                                        <option value="<?= $row->id; ?>"><?= $row->nama_divisi; ?></option>
                                    <?php endforeach ?>

                                </select>
                                <span id="id_divisi_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Jabatan</label>
                                <div class="jabatan">
                                    <select class="form-control" id="id_jabatan_pegawai" name="id_jabatan" disabled>
                                        <option>- Pilih Divisi Terlebih Dahulu -</option>


                                    </select>
                                    <span id="id_jabatan_error"></span>
                                </div>

                            </div>


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Tingkatan Pegawai</label>
                                <div class="level">
                                    <select class="form-control" id="id_level_pegawai" name="id_level">
                                        <option value="">- Pilih Tingkatan -</option>
                                        <?php foreach ($level as $row) : ?>
                                            <option value="<?= $row->id; ?>"><?= $row->nama_level; ?></option>
                                        <?php endforeach ?>

                                    </select>
                                    <span id="id_level_error"></span>
                                </div>

                            </div>


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Penempatan</label>
                                <div class="lokasi">
                                    <select class="form-control" id="id_lokasi_pegawai" name="id_lokasi">
                                        <option value="">- Pilih Penempatan -</option>
                                        <?php foreach ($lokasi as $row) : ?>
                                            <option value="<?= $row->id; ?>"><?= $row->nama_lokasi; ?></option>
                                        <?php endforeach ?>

                                    </select>
                                    <span id="id_lokasi_error"></span>
                                </div>

                            </div>


                        </div>
                    </div>


                    <div class="form-group">
                        <label for="simpleDataInput">Foto Pegawai</label>

                        <div class="wadah-image-pegawai mb-3">

                        </div>
                        <div class="custom-file">
                            <input type="hidden" name="image_pegawai" id="image_pegawai" value="">
                            <input type="file" class="custom-file-input" id="upload_image" name="image">
                            <label class="custom-file-label" for="upload_image">Choose file</label>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-warning mt-3 float-right btnSendDataPegawai" data-link="#page-top">Kirim</button>
                    <?= form_close(); ?>
                </div>
            </div>


        </div>


    </div>





</div>

<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalImage">Unggah & Resize Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div id="image_demo" class="text-center mx-auto" style="width:350px; margin-top:30px;"></div>

                    </div>


                    <!-- <div class="col-md-4" style="padding-top:30px;">
                        <br />
                        <br />
                        <br />
                    </div> -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-warning crop_image" id="crop_image">Crop & Upload Image</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="uploadimageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Unggah & Resize Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                        <br />
                        <br />
                        <br />
                        <button class="btn btn-success crop_image" id="crop_image">Crop & Upload Image</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <a href="login.html" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div> -->