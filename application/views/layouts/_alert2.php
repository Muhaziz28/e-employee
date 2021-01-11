<?php
$success    = $this->session->flashdata('success');
$error      = $this->session->flashdata('error');
$warning    = $this->session->flashdata('warning');


if ($success) {
    $alert_status       = 'alert-success';
    $status             = 'Success!';
    $message            = $success;
    $icon               = 'fa-check';
}

if ($error) {
    $alert_status       = 'alert-danger';
    $status             = 'Error!';
    $message            = $error;
    $icon               = 'fa-ban';
}

if ($warning) {
    $alert_status       = 'alert-warning';
    $status             = 'Warning!';
    $message            = $warning;
    $icon               = 'fa-exclamation-triangle';
}
?>


<div class="flash-data" data-flashdata="<?= isset($status) ? $status : ""; ?>" data-message="<?= isset($message) ? $message : ""; ?>"></div>

