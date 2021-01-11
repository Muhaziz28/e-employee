<?php
if ($status == 'pending') {
    $badge_status = 'badge-warning';
    $status       = 'Pending';
}

if ($status == 'diterima') {
    $badge_status = 'badge-info';
    $status       = 'Diterima';
}


if($status == 'ditolak'){
    $badge_status = 'badge-danger';
    $status       = 'Ditolak';
}


?>


<?php if($status) : ?>
    <span class="badge badge-pill <?= $badge_status; ?>" style="font-size: 18px;"><?= $status; ?></span>
<?php endif ?>