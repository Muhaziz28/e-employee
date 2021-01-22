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
                <th>Sisa Cuti Berlangsung</th>
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

                    <?php if ($row->status_cuti == "pending") {
                        $jenisBadge = "warning";
                    } else if ($row->status_cuti == "diterima") {
                        $jenisBadge = "info";
                    } else {
                        $jenisBadge = "danger";
                    } ?>
                    <td><span class="badge badge-<?= $jenisBadge; ?>"><?= ucwords($row->status_cuti); ?></span></td>
                    <?php

                    //untuk mendapatkan tgl akhir cuti
                    $date = new DateTime($row->tgl_cuti);
                    $date->modify('+' . $row->lama_cuti . 'day');
                    $tgl_akhir = $date->format('Y-m-d');
                    // end tgl akhir cuti

                    //mencari durasi hari cuti pegawai
                    $tgl_sekarang = date("Y-m-d");
                    $diff = date_diff(new DateTime($tgl_akhir), new DateTime($tgl_sekarang));
                    // end durasi hari cuti pegawai
                    
                    ?>
                    <?php if ($row->status_cuti == "diterima") { ?>
                        <?php if ($row->tgl_cuti <= date("Y-m-d")) :  ?>
                            <?php if ($diff->d >= 2) { ?>
                                <td><?= $diff->d . ' hari lagi'; ?></td>
                            <?php } else if ($diff->d < 2 && $diff->d <= 0) { ?>
                                <td class="bg-warning text-white"><?= $diff->d . ' hari lagi'; ?></td>
                            <?php } else { ?>
                                <?php if ($tgl_akhir != date("Y-m-d")) : ?>
                                    <td class="bg-danger text-white"><?= "Cuti Berakhir" ?></td>
                                <?php else : ?>
                                    <td class="bg-warning text-white"><?= "Berakhir Hari Ini" ?></td>
                                <?php endif ?>
                            <?php } ?>
                        <?php else : ?>
                            <td><?= "Cuti Belum Dimulai" ?></td>
                        <?php endif ?>
                    <?php } else if ($row->status_cuti == "ditolak") { ?>
                        <td><?= "Cuti Ditolak"; ?></td>
                    <?php } else { ?>
                        <td><?= "-" ?></td>
                    <?php }  ?>

                    <td>
                        <a href="#" class="btn btn-info" id="btnLihatCuti" data-id="<?= $row->id; ?>"> Lihat</a>

                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>