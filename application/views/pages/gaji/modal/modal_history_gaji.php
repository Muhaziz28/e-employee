<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabelLogout"><?= $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <p class="ml-3">Filter berdasarkan :</p>
            <!-- <div class="text-center btn-filter">
                <button class="btn btn-warning ml-3" id="btnFilterPending" style="width: 30%;" data-nip="<?= $this->session->userdata('nip'); ?>">Pending</button>
                <button class="btn btn-info ml-3" id="btnFilterDiterima" style="width: 30%;" data-nip="<?= $this->session->userdata('nip'); ?>">Diterima</button>
                <button class="btn btn-danger ml-3" id="btnFilterDitolak" style="width: 30%;" data-nip="<?= $this->session->userdata('nip'); ?>">Ditolak</button>
            </div> -->

        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="list-history-gaji">
                <div class="loadGaji">
                    <div id="anim4" class="mx-auto mt-3" style="width: 100px;"></div>
                    <div class="text-center mt-3">
                        <p><strong>Harap Tunggu...</strong></p>
                    </div>
                </div>


            </div>

        </div>
    </div>



</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

</div>