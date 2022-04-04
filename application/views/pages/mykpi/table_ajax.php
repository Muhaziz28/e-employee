<div class="table-responsive p-3">


    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Kehadiran</th>
                <th>Kinerja</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($getPegawai as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->created_at != "" ? date_format(new DateTime($row->created_at), 'F') : "-"; ?></td>
                    <td><?= $row->created_at != "" ? date_format(new DateTime($row->created_at), 'Y') : "-"; ?></td>
                    <td><?= $row->kehadiran != "" ? $row->kehadiran : "-"; ?></td>
                    <td><?= $row->kinerja != "" ? $row->kinerja : "-"; ?></td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>