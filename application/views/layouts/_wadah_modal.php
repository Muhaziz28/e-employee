<div id="wadahModalTambahDivisi">

</div>

<div id="wadahModalEditDivisi">

</div>

<div id="wadahModalTambahJabatan">

</div>

<div id="wadahModalEditJabatan">

</div>

<div id="wadahModalTambahLevel">

</div>

<div id="wadahModalEditLevel">

</div>

<div id="wadahModalDetailPegawai">

</div>

<div id="wadahModalAjukanCuti">

</div>

<div id="wadahModalDetailCuti">

</div>

<div id="wadahModalTambahLokasi">

</div>

<div id="wadahModalEditLokasi">

</div>

<div id="wadahModalRiwayatCuti">

</div>

<div id="wadahModalEditProfile">

</div>

<div id="wadahModalPegawaiOut">

</div>

<div id="wadahModalTambahGaji">

</div>

<div id="wadahModalEditGaji">

</div>

<div id="wadahModalViewSlipGaji">

</div>

<div id="wadahModalRiwayatGaji">

</div>

<div id="wadahModalTambahGrade">

</div>

<div id="wadahModalEditGrade">

</div>

<div id="wadahModalDetailGaji">

</div>

<div id="wadahModalDetailPegawaiOut">

</div>

<div id="modalGenerateIdCardPegawai">

</div>

<?php if ($nav_title == 'home' || $nav_title == 'aktivitas') : ?>
    <?php $this->load->view('pages/activity/modal/modal_add_activity'); ?>

    <div id="modalEditActivity">

    </div>
<?php endif ?>

<?php if ($nav_title == 'pegawai') : ?>
    <?php $this->load->view('pages/pegawai/modal/modal_filter'); ?>
<?php endif ?>