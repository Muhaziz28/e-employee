<div class="table-responsive p-3">
  
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Gaji</th>
                <th>Total Gaji</th>

                <th>Tanggal</th>
                <th></th>


            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($getGaji as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->jumlah_gaji != '' ? 'Rp ' . number_format($row->jumlah_gaji, 0, ',', '.') . ',-' : '-'; ?></td>
                    <td><?= $row->total_gaji != '' ? 'Rp ' . number_format($row->total_gaji, 0, ',', '.') . ',-' : '-'; ?></td>
                    <td><?= date_format(new DateTime($row->created_at), "d-m-Y"); ?></td>
                    <td><a href="#" class="btn btn-warning" id="btnViewSlipGaji" data-id="<?= $row->id; ?>" data-nip="<?= $row->nip_pegawai; ?>" data-isprofile="true">Lihat Slip Gaji</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>