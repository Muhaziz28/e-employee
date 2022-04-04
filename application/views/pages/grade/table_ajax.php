<div class="table-responsive p-3">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Grade</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan Kehadiran</th>
                <th>Tunjangan Operasional</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->title; ?></td>
                    <td><?= number_format($row->gaji_pokok, 0, ',', '.'); ?></td>
                    <td><?= number_format($row->tunjangan_kehadiran, 0, ',', '.'); ?></td>
                    <td><?= number_format($row->tunjangan_operasional, 0, ',', '.'); ?></td>
                    <td>
                        <a href="#" class="btn btn-info" id="btnEditGrade" data-id="<?= $row->id; ?>"> Edit</a>
                        <a href="#" class="btn btn-danger" id="btnDeleteGrade" data-id="<?= $row->id; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>