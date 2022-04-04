<div class="pt-3 pb-3 pr-3 table-rekap-aktivitas-space">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table align-items-center table-flush table-hover table-sticky-avt" id="dataTableRekapAktivitas">
        <thead class="thead-light">
            <tr>
                <th rowspan="2" class="" style="vertical-align: middle;">Nama Pegawai</th>
                <th colspan="<?= $limit_day; ?>" class="text-center">Tanggal</th>


            </tr>
            <tr class="tangga-row">
                <?php for ($i = 1; $i <= $limit_day; $i++) : ?>
                    <th class="text-center"><?= $i; ?></th>
                <?php endfor ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($pegawai as $row) : ?>
                <tr>
                    <td style="background-color: white; border-color: white;"><?= $row->nama; ?></td>
                    <?php for ($i = 1; $i <= $limit_day; $i++) : ?>
                        <td class="text-center">
                            <?php if ($emp[$row->nip][$i] == 1) : ?>
                                <i class="fas fa-check text-success"></i>
                            <?php else : ?>
                                <i class="fas fa-times text-danger"></i>
                            <?php endif ?>
                        </td>
                    <?php endfor ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>