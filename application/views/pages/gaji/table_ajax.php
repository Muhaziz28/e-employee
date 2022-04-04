<div class="table-responsive p-3">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Gaji</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->nip; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->nama_jabatan; ?></td>
                    <td><?= $row->jumlah_gaji != '' ? 'Rp ' . number_format($row->jumlah_gaji, 0, ',', '.') . ',-' : '<a href="#" class="btn btn-info" id="btnTambahGaji" data-divisi="' . $row->id_divisi . '" data-lokasi="' . $row->id_lokasi . '" data-id="' . $row->nip . '">Tambah Gaji&nbsp;<img src="' . base_url("assets/img/load/load2.svg") . '" width="25px" class="loadBtnGaji" id="load' . $row->nip . '"></a>'; ?></td>
                    <th>
                        <?php if ($row->jumlah_gaji != '') :  ?>
                            <a href="#" class="btn btn-sm btn-warning" id="btnEditGaji" data-id="<?= $row->id_gaji; ?>" data-toggle="tooltip" data-placement="top" title="Edit Gaji"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger" id="btnDeleteGaji" data-id="<?= $row->id_gaji; ?>" data-toggle="tooltip" data-placement="top" title="Hapus Gaji"><i class="fas fa-trash"></i></a>
                            <a href="#" class="btn btn-sm btn-success" id="btnDetailGaji" data-id="<?= $row->id_gaji; ?>" data-toggle="tooltip" data-placement="top" title="Detail Gaji"><i class="fas fa-list-ul"></i></a>
                        <?php else : ?>
                            <?php echo ""; ?>
                        <?php endif ?>

                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>