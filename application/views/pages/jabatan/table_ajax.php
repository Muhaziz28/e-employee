<div class="table-responsive p-3">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nama Jabatan</th>
                <th>Divisi</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->nama_jabatan; ?></td>
                    <td><?= $row->nama_divisi; ?></td>
                    <td><?= $row->ket; ?></td>
                    <td>
                        <a href="#" class="btn btn-info" id="btnEditJabatan" data-id="<?= $row->id; ?>"> Edit</a>
                        <a href="#" class="btn btn-danger" id="btnDeleteJabatan" data-id="<?= $row->id; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>