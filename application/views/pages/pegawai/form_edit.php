<div class="container" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-warning font-weight-bold"><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url("pegawai"); ?>">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url("pegawai/edit") ?>"></a>Edit Form</li>
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
                    <?= form_open_multipart($form_action, ['method' => 'POST', 'id' => 'formEditPegawai']); ?>

                    <div class="form-group">
                        <input type="hidden" name="nip" id="nip_pegawai" value="<?= $input->nip; ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nama_pegawai" name="nama" placeholder="Nama Lengkap Pegawai" value="<?= $input->nama; ?>">
                                </div>
                                <span id="nama_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">E-mail</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="email_pegawai" name="email" placeholder="Alamat Email Pegawai" value="<?= $input->email; ?>">
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
                                    <input type="text" class="form-control" id="tempat_lahir_pegawai" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $input->tempat_lahir; ?>">
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
                                        <input type="text" class="form-control" placeholder="Tanggal Lahir" id="tgl_lahir_pegawai" name="tgl_lahir" autocomplete="off" value="<?= $input->tgl_lahir; ?>">
                                    </div>
                                    <span id="tgl_lahir_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nik_pegawai">NIK</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nik_pegawai" name="nik" placeholder="NIK" autocomplete="off" value="<?= $input->nik; ?>">
                                </div>
                                <span id="nik_error"></span>
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
                                    <input type="text" class="form-control" id="nohp_pegawai" name="nohp" placeholder="No HP" value="<?= $input->nohp; ?>">
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
                                    <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" class="custom-control-input jenis_kelamin" name="jenis_kelawmin" <?= $input->jenis_kelamin == "Laki-laki" ? "checked" : "" ?>>
                                    <label class="custom-control-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio form-check form-check-inline">
                                    <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" class="custom-control-input jenis_kelamin" name="jenis_kelamin" <?= $input->jenis_kelamin == "Perempuan" ? "checked" : "" ?>>
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
                                    <option value="Islam" <?= $input->agama == "Islam" ? "selected" : "" ?>>Islam</option>
                                    <option value="Katolik" <?= $input->agama == "Katolik" ? "selected" : "" ?>>Katolik</option>
                                    <option value="Protestan" <?= $input->agama == "Protestan" ? "selected" : "" ?>>Protestan</option>
                                    <option value="Hindu" <?= $input->agama == "Hindu" ? "selected" : "" ?>>Hindu</option>
                                    <option value="Buddha" <?= $input->agama == "Buddha" ? "selected" : "" ?>>Buddha</option>
                                    <option value="Kong Hu Cu" <?= $input->agama == "Kong Hu Cu" ? "selected" : "" ?>>Kong Hu Cu</option>
                                </select>
                                <span id="agama_error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="simpleDataInput">Status Nikah</label>
                                <select class="form-control" id="status_nikah_pegawai" name="status">
                                    <option value="">- Pilih Status Nikah -</option>
                                    <option value="Menikah" <?= $input->status == "Menikah" ? "selected" : "" ?>>Menikah</option>
                                    <option value="Belum Menikah" <?= $input->status == "Belum Menikah" ? "selected" : "" ?>>Belum Menikah</option>


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
                                    <option value="SMP" <?= $input->pendidikan == "SMP" ? "selected" : "" ?>>SMP</option>
                                    <option value="SMA/K" <?= $input->pendidikan == "SMA/K" ? "selected" : "" ?>>SMA/K</option>
                                    <option value="D3" <?= $input->pendidikan == "D3" ? "selected" : "" ?>>D3</option>
                                    <option value="D4/S1" <?= $input->pendidikan == "D4/S1" ? "selected" : "" ?>>D4/S1</option>
                                    <option value="S2" <?= $input->pendidikan == "S2" ? "selected" : "" ?>>S2</option>

                                </select>
                                <span id="pendidikan_error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="simpleDataInput">Status Pegawai</label>
                                <select class="form-control" id="status_pegawai" name="status_pegawai">
                                    <option value="">- Pilih Status Pegawai -</option>
                                    <option value="Kontrak" <?= $input->status_pegawai == "Kontrak" ? "selected" : "" ?>>Kontrak</option>
                                    <option value="Tetap" <?= $input->status_pegawai == "Tetap" ? "selected" : "" ?>>Tetap</option>


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
                                        <input type="text" class="form-control" placeholder="Tanggal Masuk" id="tgl_masuk_pegawai" name="tgl_masuk" autocomplete="off" value="<?= $input->tgl_masuk; ?>">
                                    </div>
                                    <span id="tgl_masuk_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="durasi_kerja"> Durasi Kerja</label>
                                <div id="tambah-pegawai-in-out">
                                    <div class="input-daterange input-group">
                                        <input type="text" class="input-sm form-control" name="tgl_mulai_kontrak" id="tgl_mulai_kontrak" value="<?= $input->tgl_mulai_kontrak; ?>" placeholder="Tgl Mulai Kontrak" <?= $input->status_pegawai == "Tetap" ? "disabled" : "" ?> />
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-secondary" style="border-color: #757575;">s/d</span>
                                        </div>
                                        <input type="text" class="input-sm form-control" name="tgl_akhir_kontrak" id="tgl_akhir_kontrak" value="<?= $input->tgl_akhir_kontrak; ?>" placeholder="Tgl Berakhir Kontrak" <?= $input->status_pegawai == "Tetap" ? "disabled" : "" ?> />
                                    </div>

                                    <span id="tgl_mulai_kontrak_error"></span>
                                    <span class="float-right" id="tgl_akhir_kontrak_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="alamat_pegawai">Alamat</label>
                                <textarea class="form-control" id="alamat_pegawai" name="alamat" rows="4"><?= $input->alamat; ?></textarea>
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
                                        <option value="<?= $row->id; ?>" <?= $input->id_divisi == $row->id ? "selected" : "" ?>><?= $row->nama_divisi; ?></option>
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

                                <select class="form-control" id="id_jabatan_pegawai" name="id_jabatan" <?= isset($input->id_jabatan) ? "" : "disabled" ?>>
                                    <option>- Pilih Jabatan -</option>
                                    <?php foreach ($jabatan as $row) : ?>
                                        <option value="<?= $row->id; ?>" <?= $input->id_jabatan == $row->id ? "selected" : "" ?>><?= $row->nama_jabatan; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span id="id_jabatan_error"></span>


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
                                            <option value="<?= $row->id; ?>" <?= $input->id_level == $row->id ? "selected" : "" ?>><?= $row->nama_level; ?></option>
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
                                            <option value="<?= $row->id; ?>" <?= $input->id_lokasi == $row->id ? "selected" : "" ?>><?= $row->nama_lokasi; ?></option>
                                        <?php endforeach ?>

                                    </select>
                                    <span id="id_lokasi_error"></span>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="simpleDataInput">Ukuran Baju</label>
                                <div class="ukuran_baju">
                                    <select class="form-control" id="id_ukuran_baju_pegawai" name="ukuran_baju">
                                        <option value="">- Pilih Ukuran Baju -</option>
                                        <option value="S" <?= $input->ukuran_baju == "S" ? "selected" : "" ?>>S</option>
                                        <option value="M" <?= $input->ukuran_baju == "M" ? "selected" : "" ?>>M</option>
                                        <option value="L" <?= $input->ukuran_baju == "L" ? "selected" : "" ?>>L</option>
                                        <option value="XL" <?= $input->ukuran_baju == "XL" ? "selected" : "" ?>>XL</option>
                                        <option value="XXL" <?= $input->ukuran_baju == "XXL" ? "selected" : "" ?>>XXL</option>
                                    </select>
                                    <span id="id_ukuran_baju_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="simpleDataInput">Foto Pegawai</label>

                        <div class="wadah-image-pegawai mb-3">
                            <?php if ($input->image != "" || $input->image != null) : ?>
                                <img src="<?= base_url("images/pegawai/$input->image"); ?>" class="img-thumbnail img-pegawai">
                            <?php endif ?>
                        </div>
                        <div class="custom-file">
                            <input type="hidden" name="image_pegawai_temp" id="image_pegawai_temp" value="<?= $input->image; ?>">
                            <input type="hidden" name="image_pegawai" id="image_pegawai" value="<?= $input->image; ?>">
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