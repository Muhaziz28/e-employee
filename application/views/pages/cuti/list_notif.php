<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <input type="hidden" id="temp-counter" value="<?= $this->session->userdata('jumlahNotif'); ?>">
        <span class="badge badge-danger badge-counter" id="notif-counter"><?= $this->session->userdata('jumlahNotif') == 4 ? $this->session->userdata('jumlahNotif') . "+" : $this->session->userdata('jumlahNotif'); ?></span>


    </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Notification
        </h6>
        <?php $i = 0;
        foreach ($getNotifCuti as $row) : ?>
            <a class="dropdown-item d-flex align-items-center list-notif" href="#" id="btnLihatCuti" data-id="<?= $row->id; ?>" data-cek="<?= $row->status_notif; ?>">
                <div class="mr-3">
                    <!-- <div class="icon-circle bg-primary">
              <i class="fas fa-file-alt text-white"></i>
            </div> -->
                    <img class="img-profile rounded-circle" src="<?= $row->image != '' ? base_url("images/pegawai/$row->image") : "https://st4.depositphotos.com/9998432/22597/v/600/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg" ?>" style="max-width: 60px">
                </div>
                <div>

                    <!-- <div class="small text-gray-500"><?= date_format(new DateTime($row->tgl), 'M d, Y'); ?></div> -->
                    <div class="small text-gray-500"><?= time_elapsed_string($row->tgl); ?></div>
                    <span class="font-weight-bold"><?= $row->nama; ?>&nbsp;ingin mengajukan cuti!</span>
                </div>
            </a>
        <?php $i++;
        endforeach ?>

        <a class="dropdown-item text-center small text-gray-500" href="<?= base_url("cuti"); ?>">Lihat Semua Daftar Cuti</a>
    </div>
</li>