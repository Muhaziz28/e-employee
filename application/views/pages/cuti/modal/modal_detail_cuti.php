<div class="modal-header">
    <?php $this->load->view('layouts/_status', ['status' => $content->status_cuti]); ?>

    <!-- <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5> -->
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">


    <div class="row">
        <div class="col-lg-4 frame-pegawai ml-4">
            <div class="text-center">
                <img src="<?= isset($content->image) && $content->image != '' ? base_url("images/pegawai/$content->image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" class="card-img rounded-circle p-2 img-pegawai" alt="pegawai-image">
                <h3 class="h3 mt-3 font-weight-bold"><?= $content->nama; ?></h3>
                <p style="margin-top: -10px;"><?= $content->email; ?></p>

            </div>

        </div>
        <div class="col-lg-7 table-data-pegawai">
            <h5 class="mb-4 text-warning"><strong>Identitas Pegawai</strong></h5>
            <div class="table-responsive mx-auto">
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $content->nama; ?></td>

                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><?= $content->nip; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <?php
                        if ($content->jenis_kelamin == "Laki-laki") {
                            $icon = '<i class="fas fa-mars" style="color: #3abaf4;"></i> ';
                        } else {
                            $icon = '<i class="fas fa-venus" style="color: #f997c9;"></i> ';
                        }
                        ?>
                        <td><?= $icon . $content->jenis_kelamin ?></td>
                    </tr>



                </table>
            </div>


        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <h5 class="mb-4 text-warning ml-2"><strong>Data Cuti</strong></h5>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>Jenis Cuti</td>
                        <td>:</td>
                        <td><?= $content->jenis_cuti; ?></td>

                    </tr>
                    <tr>
                        <td>Tgl Cuti</td>
                        <td>:</td>
                        <td><?= date_format(new DateTime($content->tgl_cuti), "d-m-Y"); ?></td>

                    </tr>
                    <tr>
                        <td>Lama Cuti</td>
                        <td>:</td>
                        <?php
                        $tgl1 = $content->tgl_cuti;
                        $tgl2 = date('Y-m-d', strtotime('+' . $content->lama_cuti - 1 . 'days', strtotime($tgl1)));



                        ?>
                        <td>
                            <?= $content->lama_cuti; ?>&nbsp;Hari&nbsp;(<?= date_format(new DateTime($tgl2), "d-m-Y"); ?>)&nbsp;
                            <a href="#" class="showRentang">Munculkan Rentang Cuti</a>
                            <div id="rentang" class="mt-3">
                                <div class="input-daterange input-group">
                                    <input type="text" class="input-sm form-control" id="tgl_start" placeholder="Tgl Awal" value="<?= date_format(new DateTime($content->tgl_cuti), "d-m-Y"); ?>" />
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-secondary" style="border-color: #757575;">s/d</span>
                                    </div>
                                    <input type="text" class="input-sm form-control" id="tgl_end" placeholder="Tgl Akhir" value="<?= date_format(new DateTime($tgl2), "d-m-Y"); ?>" />
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td>:</td>
                        <td><?= $content->alasan_cuti; ?></td>

                    </tr>
                    <tr>
                        <td>Alamat Cuti</td>
                        <td>:</td>
                        <td><?= $content->alamat_cuti; ?></td>

                    </tr>


                    <?php
                    foreach ($pegawai as $row) {
                        if ($row->nip == $content->nip_pengganti) {
                            $nama_pengganti = $row->nama;
                        }
                    }
                    ?>
                    <tr>
                        <td>Tugas dialihkan oleh</td>
                        <td>:</td>
                        <td><?= $nama_pengganti; ?></td>

                    </tr>

                </table>
            </div>
        </div>
    </div>

    <?php if ($content->status_cuti == "pending") :  ?>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="text-center">
                    <p>Pegawai ini ingin mengajukan cuti dengan keterangan di atas. Lakukan tindak lanjut atas pengajuan cuti ini.</p>
                    <a href="#" class="btn btn-info btn-lg btn-block" id="btnTerimaCuti" data-status="diterima" data-id="<?= $content->id; ?>" data-nama="<?= $content->nama; ?>" data-email="<?= $content->email; ?>" data-lamacuti="<?= $content->lama_cuti; ?>" data-jatahcuti="<?= $content->jatah_cuti; ?>" data-nip="<?= $content->nip; ?>" data-jeniscuti="<?= $content->jenis_cuti; ?>">Terima</a>
                    <a href="#" class="btn btn-danger btn-lg btn-block" id="btnTolakCuti" data-status="ditolak" data-id="<?= $content->id; ?>" data-nama="<?= $content->nama; ?>" data-email="<?= $content->email; ?>">Tolak</a>

                </div>
            </div>
        </div>
    <?php endif ?>




</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

</div>

<script>
    //$('#rentang').hide();
    $(document).on('click', '.showRentang', function() {
        // $('.datepicker').datepicker({
        //     format: 'yyyy-mm-dd',
        //     startDate: '2021-03-01',
        //     endDate: '2021-03-31',
        //     todayBtn: 'linked'
        // });

        //$('.datepicker').datepicker('show');


        $('#rentang .input-daterange').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: false,
            todayBtn: 'linked',
        });
        $('#tgl_end').datepicker('show');


    });
</script>