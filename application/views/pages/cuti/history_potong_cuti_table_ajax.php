<div class="table-responsive p-3">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Tanggal Start</th>
                <th>Tanggal End</th>
                <th>Jumlah</th>
                <th>Alasan Dipotong Cuti</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->tgl_start; ?></td>
                    <td><?= $row->tgl_end; ?></td>
                    <td><?= $row->jumlah; ?></td>
                    <td><?= $row->alasan; ?></td>
                    <!-- <td>
                        <a href="#" class="btn btn-info" id="btnEditLokasi" data-id="<?= $row->id; ?>"> Edit</a>
                        <a href="#" class="btn btn-danger" id="btnDeleteLokasi" data-id="<?= $row->id; ?>">Delete</a>
                    </td> -->
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>