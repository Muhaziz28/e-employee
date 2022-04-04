<div class="table-responsive p-3">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Jenis Cuti</th>

                <th>Status</th>


            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($getCuti as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= date_format(new DateTime($row->created_at), "d-m-Y"); ?></td>
                    <td><?= $row->jenis_cuti; ?></td>
                    <?php if ($row->status_cuti == "pending") {
                        $jenisBadge = "warning";
                    } else if ($row->status_cuti == "diterima") {
                        $jenisBadge = "info";
                    } else {
                        $jenisBadge = "danger";
                    } ?>
                    <td><span class="badge badge-<?= $jenisBadge; ?>"><?= ucwords($row->status_cuti); ?></span></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>