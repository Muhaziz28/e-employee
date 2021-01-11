<div class="table-responsive p-3">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Jenis Cuti</th>
                <th>Status</th>
                
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->nip_pegawai; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->jenis_cuti; ?></td>

                    <?php if($row->status_cuti == "pending") {
                        $jenisBadge = "warning";
                    } else if ($row->status_cuti == "diterima") {
                        $jenisBadge = "info";
                    } else {
                        $jenisBadge = "danger";
                    } ?>
                    <td><span class="badge badge-<?= $jenisBadge; ?>"><?= ucwords($row->status_cuti); ?></span></td>
                    
                    <td>
                        <a href="#" class="btn btn-info" id="btnLihatCuti" data-id="<?= $row->id; ?>"> Lihat</a>
                        
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>