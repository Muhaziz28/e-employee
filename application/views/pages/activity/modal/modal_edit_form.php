<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout">Edit Aktivitas Kerjamu</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="#" method="POST" id="formEditActivity">
        <input type="hidden" name="id_activity" id="id_activity" value="<?= $aktivitas->id; ?>">

        <div class="row">
            <div class="col">
                <h6>Isi Form di bawah ini untuk mengubah aktivitas kerjamu.</h6>
                <p>Tanggal : <strong><?= date_format(new DateTime($aktivitas->tanggal), 'l, d F Y'); ?></strong></p>
            </div>
        </div>

        <div class="" style="overflow-x:auto;">
            <table class="table table-striped table-activity">
                <thead class="table-dark">
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;"></th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Aktivitas*</th>
                        <th colspan="2" class="text-center">Waktu*</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Realisasi*</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Target (jika ada)</th>
                    </tr>
                    <tr class="">
                        <th class="text-center">Mulai</th>
                        <th class="text-center">Selesai</th>
                    </tr>
                </thead>

                <tbody class="content-table-activity">
                    <tr>
                        <td style="vertical-align: middle; text-align: center;">
                            <!-- <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button> -->
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control activity" name="activity" id="activity" rows="3" autocomplete="off" placeholder="Isikan aktivitas Anda disini.."><?= $aktivitas->aktivitas; ?></textarea>
                                <span class="activity-err err-space" id="activity_edit_error"></span>
                            </div>
                        </td>
                        <td style="width: 15%; vertical-align: middle;">
                            <div class="form-group">
                                <div class="input-group clockpicker cp-2" id="clockPicker2">
                                    <input type="text" class="form-control" name="mulai" id="mulai" value="<?= date_format(new DateTime($aktivitas->mulai), 'H:m'); ?>" autocomplete="off" placeholder="HH:mm">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                </div>
                                <span class="mulai-err err-space" id="mulai_edit_error"></span>
                            </div>
                        </td>
                        <td style="width: 15%; vertical-align: middle;">
                            <div class="form-group">
                                <div class="input-group clockpicker cp-2" id="clockPicker2">
                                    <input type="text" class="form-control" name="akhir" id="akhir" value="<?= date_format(new DateTime($aktivitas->selesai), 'H:m'); ?>" autocomplete="off" placeholder="HH:mm">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                </div>
                                <span class="akhir-err err-space" id="akhir_edit_error"></span>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control" name="realisasi" id="realisasi" rows="3" autocomplete="off" placeholder="Isikan realisasi dari aktivitas Anda disini.."><?= $aktivitas->realisasi; ?></textarea>
                                <span class="realisasi-err err-space" id="realisasi_edit_error"></span>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control" name="target" id="target" rows="3" autocomplete="off" placeholder="Isikan target dari aktivitas Anda jika ada.."><?= $aktivitas->target; ?></textarea>
                            </div>
                        </td>
                    </tr>
                </tbody>


            </table>

        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-warning" id="btnSubmitFormEditActivity">Kirim</a>
</div>