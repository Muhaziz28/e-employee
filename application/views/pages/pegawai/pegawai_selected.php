<div class="col-5" id="nip_pegawai_<?= $selected_pegawai->nip; ?>" style="margin-top: 20px;">
    <h2 class="card-inside-title" style="font-size: 14px;">NIP Pegawai</h2>
    <div class="form-group">
        <div class="form-line">
            <input type="text" class="form-control" id="nip_pegawai_<?= $selected_pegawai->nip;  ?>" name="nip_pegawai[]" value="<?= $selected_pegawai->nip; ?>" readonly />
        </div>

    </div>
</div>
<div class="col-5" id="nama_pegawai_<?= $selected_pegawai->nip; ?>" style="margin-top: 20px;">
    <h2 class="card-inside-title" style="font-size: 14px;">Nama Pegawai</h2>
    <div class="form-group">
        <div class="form-line">
            <input type="text" class="form-control" id="nama_kain" name="nama[]" value="<?= $selected_pegawai->nama; ?>" readonly />
        </div>

    </div>
</div>
<div class="col-2" id="del_<?= $selected_pegawai->nip; ?>" style="margin-top: 20px;">
    <div class="text-right">
        <button type="button" class="btn btn-danger delete_selected_pegawai_generate_id_card mt-3" data-id="<?= $selected_pegawai->nip; ?>"><i class="material-icons">close</i></button>
    </div>
</div>