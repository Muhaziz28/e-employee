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