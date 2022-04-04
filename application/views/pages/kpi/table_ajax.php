<div class="table-responsive p-3">
    
    
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>Penempatan</th>
                <th>Kehadiran</th>
                <th>Kinerja</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($getPegawai as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->nip; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->nama_divisi; ?></td>
                    <td><?= $row->nama_jabatan; ?></td>
                    <td><?= $row->nama_lokasi; ?></td>
                    <td><?= $row->kehadiran != "" ? $row->kehadiran : "-"; ?></td>
                    <td><?= $row->kinerja != "" ? $row->kinerja : "-"; ?></td>
                    <td><?= $row->created_at != "" ? date_format(new DateTime($row->created_at), 'd/m/Y') : "-"; ?></td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>