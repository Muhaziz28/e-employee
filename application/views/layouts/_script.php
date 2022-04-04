<!-- <script src="<?= base_url("assets/") ?>vendor/jquery/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="<?= base_url("assets/") ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url("assets/") ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url("assets/") ?>vendor/select2/dist/js/select2.min.js"></script>
<!-- Bootstrap Datepicker -->
<script src="<?= base_url("assets/") ?>vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap Touchspin -->
<script src="<?= base_url("assets/") ?>vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
<!-- ClockPicker -->
<script src="<?= base_url("assets/") ?>vendor/clock-picker/clockpicker.js"></script>
<!-- RuangAdmin Javascript -->
<script src="<?= base_url("assets/") ?>js/ruang-admin.min.js"></script>
<script src="<?= base_url("assets/") ?>vendor/chart.js/Chart.min.js"></script>
<script src="https://www.sorayabedsheet.id/assets/admin/js/ckeditor/ckeditor.js"></script>


<!-- Page level plugins -->
<script src="<?= base_url("assets/") ?>vendor/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="https://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script> -->
<script src="<?= base_url("assets/") ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.0.2/js/dataTables.fixedColumns.min.js"></script>
<script src="<?= base_url("assets/") ?>js/tata/tata.js"></script>
<script src="<?= base_url("assets/") ?>js/topbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>


<!-- Page level custom scripts -->
<script src="<?= base_url("assets/") ?>js/myapp.js?2129"></script>

<script>
    var animation = bodymovin.loadAnimation({
        container: document.getElementById('anim'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: './assets/anim/grape/Animation05/drawkit-grape-animation-5-LOOP.json'
    });

    var animation = bodymovin.loadAnimation({
        container: document.getElementById('anim_home'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: './assets/anim/grape/Animation02/drawkit-grape-animation-2-LOOP.json'
    });

    var animation = bodymovin.loadAnimation({
        container: document.getElementById('anim4'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: './assets/anim/settings.json'
    });

    var animation = bodymovin.loadAnimation({
        container: document.getElementById('anim3'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '../assets/anim/settings.json'
    });
</script>

<script>
    topbar.config({
        barColors: {
            '0': 'rgba(255, 164, 38, .7)'
        },
        barThickness: 4
    });

    var ready = false;

    if (ready == false) {
        topbar.show();
    }
    $(document).ready(function() {


        ready = true;

        if (ready == true) {
            $('body').fadeIn(500);
            topbar.hide();
        }

        $('.cp-2').clockpicker({
            autoclose: true
        });
    });
    const role = $('body').data('role');
    const base_url_pusher = 'https://hrd.sorayabedsheet.id/';



    // bagian pusher
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('1533388f429c74588023', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {

        loadTableCutiPusher('cuti/loadTable');
        loadNotifPusher('notif/index');

        let nama_pegawai = data.nama;

        if (role == 'hrd') {

            tata.info('Notifikasi!', nama_pegawai + ' ingin mengajukan cuti', {
                position: 'br',
                duration: 5000,
                animate: 'slide',
                onClick: function() {
                    window.location.href = base_url_pusher + 'cuti';
                }
            });
            notifSound();

            let vall = $('.list-notif').data('i');

            if (vall == 0) {
                $('.list-notif' + vall).attr('data-cek', '1');
            }
            //console.log(vall);

        }

    });

    function notifSound() {
        var audioElement = document.createElement("audio");
        audioElement.setAttribute('src', '<?php echo base_url("assets/sound/notif.mp3"); ?>');

        var x = $('#btnNotif').data("played");
        audioElement.play();

    }

    function loadTableCutiPusher(url2) {
        $.ajax({
            type: "POST",
            url: base_url_pusher + url2,
            success: function(response) {
                $('.list-data-cuti').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }




    //load notification when cuti's data insert to db.
    function loadNotifPusher(url2) {
        let count = $('#temp-counter').val();
        let i;
        if (count == '' || count == "NaN") {
            i = 0;
        } else {
            i = count
        }

        if (i < 4) {
            i++;

        }

        $.ajax({
            type: "POST",
            url: base_url_pusher + url2 + '/' + i,
            success: function(response) {
                $('.place-notif').html(response);

                if (i == 4) {
                    $('#notif-counter').text(i + '+');

                } else {
                    $('#temp-counter').val(i);

                }


            }
        });
    }


    //load button notification
    loadNotif('notif/index');

    function loadNotif(url2) {
        $.ajax({
            type: "POST",
            url: base_url_pusher + url2,
            success: function(response) {
                $('.place-notif').html(response);

            }
        });
    }


    //remove counter when button notification clicked
    $(document).on('click', '#alertsDropdown', function() {
        $.ajax({
            type: "POST",
            url: base_url_pusher + 'notif/unset',
            success: function(response) {

                $('#notif-counter').text("");
                $('#temp-counter').val("");
            }
        });
    });

    //generate id card with selected mitra
    $(document).on('click', '#btnShowModalGenerateIdCard', function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?= base_url("pegawai/show_modal_generate_card"); ?>',
            method: "GET",
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                $('#modalGenerateIdCardPegawai').html(response);
                $('#modal-generate-id-card-pegawai').modal('show');
                $('#pegawaiList').select2({
                    placeholder: "- Pilih Pegawai -",
                    allowClear: true
                });
                topbar.hide();
            }
        });
    });

    //filter data pegawai
    $(document).on('click', '#btnSubmitFormFilterPegawai', function() {
        let id_divisi = $('#divisi_pegawai option:selected').val();
        let id_level = $('#level_pegawai option:selected').val();

        let get_divisi = id_divisi == '' ? 'default' : id_divisi;
        let get_level = id_level == '' ? 'default' : id_level;
        $.ajax({
            url: base_url_pusher + 'pegawai/filter/' + get_divisi + '/' + get_level,
            method: "GET",
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                $("#list_pegawai").html(response);
                $('#modal_filter_pegawai').modal('hide');
                topbar.hide();
            }
        });
    });

    $(document).on('change', '#pegawaiList', function() {
        let nip_pegawai = $('#pegawaiList option:selected').val();

        if (nip_pegawai != '') {
            $.ajax({
                url: '<?= base_url("pegawai/load_selected_pegawai"); ?>',
                method: "GET",
                data: {
                    nip_pegawai: nip_pegawai
                },
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    let nip_pegawai_form = $('#nip_pegawai_' + nip_pegawai).val();
                    if (nip_pegawai_form != nip_pegawai) {
                        $('.selected-pegawai').append(response);
                    }
                    topbar.hide();
                }
            });
        }

    });

    $(document).on('click', '.delete_selected_pegawai_generate_id_card', function() {
        let nip_pegawai = $(this).data('id');
        $('#nip_pegawai_' + nip_pegawai).remove();
        $('#nama_pegawai_' + nip_pegawai).remove();
        $('#del_' + nip_pegawai).remove();
    });



    //show form laporan pegawai in out
    showFormLaporanPegawaiInOut();

    function showFormLaporanPegawaiInOut() {
        $.ajax({
            type: "POST",
            url: base_url + 'report/showFormLaporanPegawaiInOut',
            beforeSend: function() {
                bodymovin.loadAnimation({
                    container: document.getElementById('anim3'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: './assets/anim/settings.json'
                });
            },
            success: function(response) {
                $('.wadahFormLaporanPegawaiInOut').html(response);


                $('#pegawai-in-out .input-daterange').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    todayBtn: 'linked',
                });

                $('#anim3').hide();
                $('#textAnim3').hide();
            }
        });
    }

    $('#tambah-pegawai-in-out .input-daterange').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
    });

    $(document).on('change', '#tgl_start_inout', function() {

        let start = $(this).val();

        let split = start.split("/");
        let conv_start = split[2] + "-" + split[1] + "-" + split[0];


        $('#tgl_start_inout_temp').val(conv_start);
    });

    $(document).on('change', '#tgl_end_inout', function() {

        let end = $(this).val();

        let split = end.split("/");
        let conv_end = split[2] + "-" + split[1] + "-" + split[0];


        $('#tgl_end_inout_temp').val(conv_end);
    });

    $('#dataTableHover').DataTable({
        "scrollX": true,
        "responsive": true
    });

    $('#dataTableHoverr').DataTable();
    $('#dataTableAktivitas').DataTable({
        "order": [
            [0, "desc"]
        ], //or asc 
        "columnDefs": [{
            "targets": 0,
            "type": "date-eu"
        }],
    });

    $('#nip_pegawai_aktivitas').select2({
        placeholder: "- Pilih Pegawai -",
        allowClear: true
    });

    $('#dataTableHover2').DataTable({
        "scrollX": true,
        "responsive": true
    });

    $('#dataTableRekapAktivitas').DataTable({

        scrollY: "500px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: true,
    });

    $(document).on('submit', '#formLaporanPegawaiInOut', function(e) {
        e.preventDefault();
        let tgl_start = $('#tgl_start_inout_temp').val();
        let tgl_end = $('#tgl_end_inout_temp').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'report/requestPegawaiInOut',
            data: {
                tgl_start: tgl_start,
                tgl_end: tgl_end
            },
            beforeSend: function() {

            },
            success: function(data) {
                let data_response = JSON.parse(data);

                if (data_response.statusCode == 400) {
                    if (data_response.error == true) {
                        if (data_response.tgl_start_error != '') {
                            $('#tgl_start_error').html(data_response.tgl_start_error);
                        } else {
                            $('#tgl_start_error').html('');
                        }

                        if (data_response.tgl_end_error != '') {
                            $('#tgl_end_error').html(data_response.tgl_end_error);
                        } else {
                            $('#tgl_end_error').html('');
                        }


                    }
                } else {
                    let result = data_response.result;
                    $('.result-report-pegawai-in-out').html(result);
                    $('#tgl_start_error').html('');
                    $('#tgl_end_error').html('');


                    //move to export excel
                    $('#btnExportExcelPegawaiInOut').show();
                    $('#tgl_start_excel').val(tgl_start);
                    $('#tgl_end_excel').val(tgl_end);


                    $('#dataTableHover').DataTable();



                    $('#dataTableHover2').DataTable();
                }
            }
        });
    });

    //click btn add grade gaji
    $(document).on('click', '#btnTambahGrade', function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: base_url_pusher + 'grade/showForm',
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                $('#wadahModalTambahGrade').html(response);
                $('.select2-single').select2({
                    placeholder: "- Pilih Level -",
                    allowClear: true
                });
                $('#modal-add-grade').modal('show');
                topbar.hide();
            }
        })
    });

    //submit data grade
    $(document).on('submit', '#formTambahGrade', function(e) {
        e.preventDefault();

        let data = $(this).serialize();

        //do ajax
        $.ajax({
            method: "POST",
            url: base_url_pusher + 'grade/insert',
            data: data,
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                var data_response = JSON.parse(response);
                if (data_response.statusCode == 200) {
                    loadTableGrade('grade/loadTable');
                    $('#formTambahGrade')[0].reset();

                    //show message success
                    tata.success('Success', 'Data Berhasil Ditambahkan!');

                    $('#id_level_error').html('');
                    $('#id_level').removeClass('is-invalid is-valid');

                    $('#nama_grade_error').html('');
                    $('#nama_grade').removeClass('is-invalid is-valid');

                    $('#nama_grade_error').html('');
                    $('#nama_grade').removeClass('is-invalid is-valid');

                    $('#gaji_pokok_error').html('');
                    $('#gaji_pokok').removeClass('is-invalid is-valid');

                    $('#tunjangan_kehadiran_error').html('');
                    $('#tunjangan_kehadiran').removeClass('is-invalid is-valid');

                    $('#tunjangan_operasional_error').html('');
                    $('#tunjangan_operasional').removeClass('is-invalid is-valid');
                } else {
                    if (data_response.error == true) {
                        if (data_response.id_level_error != '') {
                            $('#id_level_error').html(data_response.id_level_error);
                            $('#id_level').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#id_level_error').html('');
                            $('#id_level').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.nama_grade_error != '') {
                            $('#nama_grade_error').html(data_response.nama_grade_error);
                            $('#nama_grade').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#nama_grade_error').html('');
                            $('#nama_grade').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.gaji_pokok_error != '') {
                            $('#gaji_pokok_error').html(data_response.gaji_pokok_error);
                            $('#gaji_pokok').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#gaji_pokok_error').html('');
                            $('#gaji_pokok').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tunjangan_kehadiran_error != '') {
                            $('#tunjangan_kehadiran_error').html(data_response.tunjangan_kehadiran_error);
                            $('#tunjangan_kehadiran').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tunjangan_kehadiran_error').html('');
                            $('#tunjangan_kehadiran').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tunjangan_operasional_error != '') {
                            $('#tunjangan_operasional_error').html(data_response.tunjangan_operasional_error);
                            $('#tunjangan_operasional').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tunjangan_operasional_error').html('');
                            $('#tunjangan_operasional').removeClass('is-invalid').addClass('is-valid');
                        }
                    }
                }

                topbar.hide();
            }
        })
    });

    //update data grade
    $(document).on('submit', '#formEditGrade', function(e) {
        e.preventDefault();
        let data = $(this).serialize();

        //do ajax
        $.ajax({
            url: base_url_pusher + 'grade/update',
            method: "POST",
            data: data,
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                var data_response = JSON.parse(response);
                if (data_response.statusCode == 200) {
                    loadTableGrade('grade/loadTable');
                    $('#modal-edit-grade').modal('hide');

                    //show message success
                    tata.success('Success', 'Data Berhasil Ditambahkan!');

                    $('#id_level_edit_error').html('');
                    $('#id_level_edit').removeClass('is-invalid is-valid');

                    $('#nama_grade_edit_error').html('');
                    $('#nama_grade_edit').removeClass('is-invalid is-valid');

                    $('#nama_grade_edit_error').html('');
                    $('#nama_grade_edit').removeClass('is-invalid is-valid');

                    $('#gaji_pokok_edit_error').html('');
                    $('#gaji_pokok_edit').removeClass('is-invalid is-valid');

                    $('#tunjangan_kehadiran_edit_error').html('');
                    $('#tunjangan_kehadiran_edit').removeClass('is-invalid is-valid');

                    $('#tunjangan_operasional_edit_error').html('');
                    $('#tunjangan_operasional_edit').removeClass('is-invalid is-valid');
                } else {
                    if (data_response.error == true) {
                        if (data_response.id_level_edit_error != '') {
                            $('#id_level_edit_error').html(data_response.id_level_edit_error);
                            $('#id_level_edit').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#id_level_edit_error').html('');
                            $('#id_level_edit').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.nama_grade_edit_error != '') {
                            $('#nama_grade_edit_error').html(data_response.nama_grade_edit_error);
                            $('#nama_grade_edit').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#nama_grade_edit_error').html('');
                            $('#nama_grade_edit').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.gaji_pokok_edit_error != '') {
                            $('#gaji_pokok_edit_error').html(data_response.gaji_pokok_edit_error);
                            $('#gaji_pokok_edit').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#gaji_pokok_edit_error').html('');
                            $('#gaji_pokok_edit').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tunjangan_kehadiran_edit_error != '') {
                            $('#tunjangan_kehadiran_edit_error').html(data_response.tunjangan_kehadiran_edit_error);
                            $('#tunjangan_kehadiran_edit').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tunjangan_kehadiran_edit_error').html('');
                            $('#tunjangan_kehadiran_edit').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tunjangan_operasional_edit_error != '') {
                            $('#tunjangan_operasional_edit_error').html(data_response.tunjangan_operasional_edit_error);
                            $('#tunjangan_operasional_edit').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tunjangan_operasional_edit_error').html('');
                            $('#tunjangan_operasional_edit').removeClass('is-invalid').addClass('is-valid');
                        }
                    }
                }

                topbar.hide();
            }
        });
    });

    //show modal edit grade
    $(document).on('click', '#btnEditGrade', function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: base_url_pusher + 'grade/showFormEdit/' + id,
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                $('#wadahModalEditGrade').html(response);
                $('#modal-edit-grade').modal('show');

                //show select2
                $('.select2-single').select2({
                    placeholder: "- Pilih Level -",
                    allowClear: true
                });

                topbar.hide();
            }
        })
    });

    //delete data grade
    $(document).on('click', '#btnDeleteGrade', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        Swal.fire({
            title: 'Anda Yakin Ingin Menghapus Data ini?',
            text: "Anda Tidak Dapat Mengembalikan Aksi ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffa426',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Ya, Saya Yakin',
            cancelButtonText: 'Batal',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'grade/destroy/' + id,
                    method: "POST",
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            loadTableGrade('grade/loadTable');
                            tata.success('Success', 'Data Berhasil Dihapus!');
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }
                    }
                });
            }
        })
    });



    //load grade pegawai(gaji)
    loadTableGrade('grade/loadTable');

    function loadTableGrade(url2) {
        $.ajax({
            type: "POST",
            url: base_url_pusher + url2,
            success: function(response) {
                $('.list-data-grade').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }

    //gaji
    loadTableGaji('gaji/loadTable');

    function loadTableGaji(url2) {
        $.ajax({
            type: "GET",
            url: base_url_pusher + url2,
            success: function(response) {
                $('.list-data-pegawai-gaji').html(response);
                $('#dataTableHover').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="tooltip"]').tooltip("hide");
            }
        });
    }



    //show modal add gaji
    $(document).on('click', '#btnTambahGaji', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let id_divisi = $(this).data('divisi');
        $.ajax({
            type: "POST",
            url: base_url + 'gaji/showForm/' + id + '/' + id_divisi,
            beforeSend: function() {
                topbar.show();
            },
            success: function(data) {
                $('#wadahModalTambahGaji').html(data);

                $('.select2-single').select2({
                    placeholder: "- Pilih Grade -",
                    allowClear: true
                });
                $('#modal-add-gaji').modal('show');
                topbar.hide();
            }

        });
    });

    //on change pilih id grade edit
    $(document).on('change', '#id_grade_edit', function() {
        let id_grade = $('#id_grade_edit option:selected').val();
        if (id_grade != "") {
            $.ajax({
                method: "POST",
                url: base_url_pusher + 'gaji/onChangeGrade/' + id_grade,
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        $('#jumlah_gaji_edit').val(formatGaji(data.gaji_pokok));
                        $('#insentif_kehadiran_edit').val(formatGaji(data.tunjangan_kehadiran));
                        $('#tunjangan_edit').val(formatGaji(data.tunjangan_operasional));
                        $('#tunjangan_kerajinan_edit').removeAttr('readonly');
                    }

                    topbar.hide();
                }
            });
        }
    });

    //if select grade has been clear
    $(document).on('select2:clear', '#id_grade_edit', function() {
        $('#jumlah_gaji_edit').val('');
        $('#insentif_kehadiran_edit').val('');
        $('#tunjangan_edit').val('');

        $('#jumlah_gaji_edit').attr('readonly', true);
        $('#insentif_kehadiran_edit').attr('readonly', true);
        $('#tunjangan_edit').attr('readonly', true);
        $('#tunjangan_kerajinan_edit').attr('readonly', true);

    });

    //if select grade has been clear
    $(document).on('select2:clear', '#id_grade', function() {
        $('#jumlah_gaji').val('');
        $('#insentif_kehadiran').val('');
        $('#tunjangan').val('');

        $('#jumlah_gaji').attr('readonly', true);
        $('#insentif_kehadiran').attr('readonly', true);
        $('#tunjangan').attr('readonly', true);
        $('#tunjangan_kerajinan').attr('readonly', true);

    });


    //on change pilih id grade
    $(document).on('change', '#id_grade', function() {

        let id_grade = $('#id_grade option:selected').val();
        if (id_grade != "") {
            $.ajax({
                method: "POST",
                url: base_url_pusher + 'gaji/onChangeGrade/' + id_grade,
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        $('#jumlah_gaji').val(formatGaji(data.gaji_pokok));
                        $('#insentif_kehadiran').val(formatGaji(data.tunjangan_kehadiran));
                        $('#tunjangan').val(formatGaji(data.tunjangan_operasional));
                        $('#tunjangan_kerajinan').removeAttr('readonly');
                    }

                    topbar.hide();
                }
            });
        }

    });

    $(document).on('submit', '#formTambahGaji', function(e) {

        e.preventDefault();

        //get value from form
        let nip_pegawai = $('#nip_pegawai').val();
        let divisi_peg = $('#divisi_peg').val();
        let id_grade = $('#id_grade option:selected').val();
        let jumlah_gaji = $('#jumlah_gaji').val();
        let insentif_kehadiran = $('#insentif_kehadiran').val();
        let tunjangan = $('#tunjangan').val();
        let tunjangan_kerajinan = $('#tunjangan_kerajinan').val();
        let tunjangan_leader = $('#tunjangan_leader').val();
        let tunjangan_kebersihan = $('#tunjangan_kebersihan').val();
        let tunjangan_keamanan = $('#tunjangan_keamanan').val();
        let tunjangan_dokter = $('#tunjangan_dokter').val();
        let tunjangan_lainnya = $('#tunjangan_lainnya').val();

        //do ajax
        $.ajax({
            url: base_url + 'gaji/insert',
            method: "POST",
            data: {
                nip_pegawai: nip_pegawai,
                divisi_peg: divisi_peg,
                id_grade: id_grade,
                jumlah_gaji: jumlah_gaji,
                insentif_kehadiran: insentif_kehadiran,
                tunjangan: tunjangan,
                tunjangan_kerajinan: tunjangan_kerajinan,
                tunjangan_leader: tunjangan_leader,
                tunjangan_kebersihan: tunjangan_kebersihan,
                tunjangan_keamanan: tunjangan_keamanan,
                tunjangan_dokter: tunjangan_dokter,
                tunjangan_lainnya: tunjangan_lainnya,
            },
            beforeSend: function() {
                topbar.show();
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {

                    if (data.divisiPeg != 21) {
                        loadTableGaji('gaji/loadTable');
                        $('#jumlah_gaji_error').html('');
                        $('#insentif_kehadiran_error').html('');
                        $('#tunjangan_error').html('');
                        $('#tunjangan_kerajinan_error').html('');
                        $('#modal-add-gaji').modal('hide');
                    } else {
                        loadTableGaji('gaji/loadTable?peg=Hers%20Clinic');
                        $('#tunjangan_leader').html('');
                        $('#tunjangan_kebersihan').html('');
                        $('#tunjangan_keamanan').html('');
                        $('#tunjangan_dokter').html('');
                        $('#tunjangan_lainnya').html('');
                    }
                    tata.success('Success', 'Data Berhasil Ditambahkan!');


                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {

                        if (data.divisiPeg != 21) {
                            console.log(data.jumlah_gaji_error);
                            if (data.jumlah_gaji_error != '') {
                                $('#jumlah_gaji_error').html(data.jumlah_gaji_error);
                                $('#jumlah_gaji').removeClass('is-valid').addClass('is-invalid');
                            }

                            if (data.insentif_kehadiran_error != '') {
                                $('#insentif_kehadiran_error').html(data.insentif_kehadiran_error);
                                $('#insentif_kehadiran').removeClass('is-valid').addClass('is-invalid');
                            }

                            if (data.tunjangan_error != '') {
                                $('#tunjangan_error').html(data.tunjangan_error);
                                $('#tunjangan').removeClass('is-valid').addClass('is-invalid');

                            }

                            if (data.tunjangan_kerajinan_error != '') {
                                $('#tunjangan_kerajinan_error').html(data.tunjangan_kerajinan_error);
                                $('#tunjangan_kerajinan').removeClass('is-valid').addClass('is-invalid');
                            }
                        } else {

                        }

                    }
                }

                topbar.hide();
            }
        });

    });

    $(document).on('change', '#filter-peg', function() {
        let val_peg = $('#filter-peg option:selected').val();
        $.ajax({
            method: "GET",
            url: base_url + 'gaji/loadTable?peg=' + val_peg,
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                $('.list-data-pegawai-gaji').html(response);
                $('#dataTableHover').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
                topbar.hide();
            }
        });
    });



    function formatGaji(angka, prefix = '') {

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        //return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        return rupiah;
    }

    $(document).on('keyup', '#jumlah_gaji', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#insentif_kehadiran', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_kerajinan', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#gaji_pokok', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_kehadiran', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_operasional', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_leader', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_kebersihan', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_keamanan', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_dokter', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_lainnya', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#gaji_pokok_edit', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_kehadiran_edit', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_operasional_edit', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#tunjangan_kerajinan_edit', function() {
        let bilangan = $(this).val();
        //formatGaji(bilangan);

        $(this).val(formatGaji(bilangan));
    });

    //show modal edit gaji
    $(document).on('click', '#btnEditGaji', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
                type: "POST",
                url: base_url + 'gaji/showFormEdit/' + id,
                beforeSend: function() {
                    topbar.show();
                }

            })
            .done(function(data) {
                $('#wadahModalEditGaji').html(data);

                $('#modal-edit-gaji').modal('show');
                $('.select2-single-edit').select2({
                    placeholder: "- Pilih Grade -",
                    allowClear: true
                });

                $('[data-toggle="tooltip"]').tooltip("hide");

                topbar.hide();
            });
    });

    //show modal detail gaji
    $(document).on('click', '#btnDetailGaji', function(e) {
        e.preventDefault();
        let id_gaji = $(this).data('id');
        $.ajax({
            url: base_url_pusher + 'gaji/viewDetailGaji?id_gaji=' + id_gaji,
            method: "GET",
            beforeSend: function() {
                topbar.show();
            },
            success: function(response) {
                $('#wadahModalDetailGaji').html(response);
                $('#modal-detail-gaji').modal('show');

                $('[data-toggle="tooltip"]').tooltip("hide");
                topbar.hide();
            }
        });
    });

    //update data gaji
    $(document).on('submit', '#formEditGaji', function(e) {

        e.preventDefault();

        //get value from form
        let id = $('#id').val();
        let nip_pegawai = $('#nip_pegawai_edit').val();
        let id_grade = $('#id_grade_edit option:selected').val();
        let jumlah_gaji = $('#jumlah_gaji_edit').val();
        let insentif_kehadiran = $('#insentif_kehadiran_edit').val();
        let tunjangan = $('#tunjangan_edit').val();
        let tunjangan_kerajinan = $('#tunjangan_kerajinan_edit').val();

        //do ajax
        $.ajax({
            url: base_url + 'gaji/update',
            method: "POST",
            data: {
                id: id,
                nip_pegawai: nip_pegawai,
                id_grade: id_grade,
                jumlah_gaji: jumlah_gaji,
                insentif_kehadiran: insentif_kehadiran,
                tunjangan: tunjangan,
                tunjangan_kerajinan: tunjangan_kerajinan,
            },
            beforeSend: function() {
                topbar.show();
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {

                    loadTableGaji('gaji/loadTable');
                    tata.success('Success', 'Data Berhasil Dirubah!');
                    $('#jumlah_gaji_error').html('');
                    $('#modal-edit-gaji').modal('hide');

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        console.log(data.jumlah_gaji_error);
                        if (data.jumlah_gaji_edit_error != '') {
                            $('#jumlah_gaji_edit_error').html(data.jumlah_gaji_edit_error);
                            $('#jumlah_gaji_edit').removeClass('is-valid').addClass('is-invalid');

                        }

                        if (data.insentif_kehadiran_edit_error != '') {
                            $('#insentif_kehadiran_edit_error').html(data.insentif_kehadiran_edit_error);
                            $('#insentif_kehadiran_edit').removeClass('is-valid').addClass('is-invalid');
                        }

                        if (data.tunjangan_edit_error != '') {
                            $('#tunjangan_edit_error').html(data.tunjangan_edit_error);
                            $('#tunjangan_edit').removeClass('is-valid').addClass('is-invalid');

                        }

                        if (data.tunjangan_kerajinan_edit_error != '') {
                            $('#tunjangan_kerajinan_edit_error').html(data.tunjangan_kerajinan_edit_error);
                            $('#tunjangan_kerajinan_edit').removeClass('is-valid').addClass('is-invalid');
                        }
                    }
                }

                topbar.hide();
            }
        });

    });


    //delete gaji
    $(document).on('click', '#btnDeleteGaji', function(e) {
        e.preventDefault();
        $('[data-toggle="tooltip"]').tooltip("hide");
        let id = $(this).data('id');
        Swal.fire({
            title: 'Anda Yakin Ingin Menghapus Data ini?',
            text: "Anda Tidak Dapat Mengembalikan Aksi ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffa426',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Ya, Saya Yakin',
            cancelButtonText: 'Batal',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'gaji/destroy/' + id,
                    method: "POST",
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            loadTableGaji('gaji/loadTable');
                            tata.success('Success', 'Data Berhasil Dihapus!');
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }

                        $('[data-toggle="tooltip"]').tooltip("hide");
                    }
                });
            }
        })

    });

    showFormRiwayatPerubahanGaji();

    function showFormRiwayatPerubahanGaji() {
        $.ajax({
            type: "POST",
            url: base_url + 'gaji/showFormRiwayatPerubahanGaji',
            beforeSend: function() {

            },
            success: function(response) {
                $('.wadahFormRiwayatPerubahanGaji').html(response);
                $('#nip_pegawai_riwayat_perubahan_gaji').select2({
                    placeholder: "- Pilih Pegawai -",
                    allowClear: true
                });


            }
        });
    }

    //get riwayat perubahan riwayat gaji
    $(document).on('change', '#nip_pegawai_riwayat_perubahan_gaji', function() {
        let nip = $('#nip_pegawai_riwayat_perubahan_gaji option:selected').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/resultRiwayatPerubahanGaji/' + nip,
            success: function(response) {
                $('.result-riwayat-perubahan-gaji').html(response);
                $('#dataTableHoverr').DataTable();

            }
        });
    });

    //slip gaji
    showFormSlip();

    function showFormSlip() {
        $.ajax({
            type: "POST",
            url: base_url + 'gaji/showFormSlip',
            beforeSend: function() {

            },
            success: function(response) {
                $('.wadahFormSlipGaji').html(response);
                $('#nip_pegawai_slip_gaji').select2({
                    placeholder: "- Pilih Pegawai -",
                    allowClear: true
                });


            }
        });
    }

    function loadBtnAction(nip) {
        $.ajax({
            type: "POST",
            url: base_url + 'gaji/loadBtnAction/' + nip,
            beforeSend: function() {

            },
            success: function(response) {
                $('#button_space').html(response);



            }
        });
    }

    //get riwayat perubahan riwayat gaji
    $(document).on('change', '#nip_pegawai_slip_gaji', function() {
        let nip = $('#nip_pegawai_slip_gaji option:selected').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/formSlip/' + nip,
            success: function(response) {
                $('.form-slip-gaji').html(response);
                $('#dataTableHoverr').DataTable();
                loadBtnAction(nip);
            }
        });
    });

    $(document).on('keyup', '#lembur', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#bonus', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#bpjs', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#bon', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#simp_koperasi', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#dana_sosial', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#pinjaman', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });

    $(document).on('keyup', '#kpi', function() {
        let bilangan = $(this).val();
        $(this).val(formatGaji(bilangan));
    });


    function penambahanSlipGaji(selector, selector2) {
        let get_nilai = $(selector).val();
        let get_nilai2 = $(selector2).val();

        let nilai_conv = get_nilai.split('.').join("");
        let nilai_2_conv = get_nilai2.split('.').join("");
        let nilai = Number(nilai_conv);


        let nilai2 = Number(nilai_2_conv);

        let hasil = nilai + nilai2;

        return Number(hasil);

    }


    function penguranganSlipGaji(bpjs, bon, simp, dansos, pinjaman, kpi) {
        let bpjs_val = $(bpjs).val();
        let bon_val = $(bon).val();
        let simp_val = $(simp).val();
        let dansos_val = $(dansos).val();
        let pinjaman_val = $(pinjaman).val();
        let kpi_val = $(kpi).val();

        let bpjs_nilai = bpjs_val.split('.').join("");
        let bon_nilai = bon_val.split('.').join("");
        let simp_nilai = simp_val.split('.').join("");
        let dansos_nilai = dansos_val.split('.').join("");
        let pinjaman_nilai = pinjaman_val.split('.').join("");
        let kpi_nilai = kpi_val.split('.').join("");

        let hasil = Number(bpjs_nilai) + Number(bon_nilai) + Number(simp_nilai) + Number(dansos_nilai) + Number(pinjaman_nilai) + Number(kpi_nilai);

        return Number(hasil);

    }

    //penambahan
    $(document).on('change', '#lembur', function() {
        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');



    });


    $(document).on('change', '#bonus', function() {
        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');



    });

    //pengurangan
    $(document).on('change', '#bpjs', function() {

        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');
    });

    $(document).on('change', '#bon', function() {

        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');
    });

    $(document).on('change', '#simp_koperasi', function() {

        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');
    });

    $(document).on('change', '#dana_sosial', function() {

        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');
    });

    $(document).on('change', '#pinjaman', function() {

        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');
    });

    $(document).on('change', '#kpi', function() {

        let get_penambahan = penambahanSlipGaji('#lembur', '#bonus')
        let get_pengurangan = penguranganSlipGaji('#bpjs', '#bon', '#simp_koperasi', '#dana_sosial', '#pinjaman', '#kpi');
        let total_gaji = Number($('#total_gaji_temp').val());

        let hasil = total_gaji + get_penambahan - get_pengurangan;

        $('#total_gaji').val(hasil);
        $('#tot_gaji_space').html('Total Gaji : <h3><b class="text-warning">Rp ' + formatGaji(hasil.toString()) + ',-</b></h3>');
    });

    //insert slip gaji
    $(document).on('submit', '#formTambahSlipGaji', function(e) {

        e.preventDefault();
        let formData = $(this).serialize();
        let nip_pegawai = $('#nip_pegawai_slip_gaji').val();
        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/insert_slip',
            data: formData,
            beforeSend: function() {
                $('#loadBtn').show();
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tata.success('Success!', 'Slip gaji berhasil ditambahkan!');
                    $('#formSlipGaji').remove();
                    $('#loadBtn').hide();
                    loadBtnAction(nip_pegawai);
                }
            }
        });
    });

    //show edit form slip gaji
    $(document).on('click', '#btnEditSlipGaji', function() {
        let nip = $(this).data('nip');

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/editFormSlip/' + nip,
            success: function(response) {
                $('#editFormSlipGaji').html(response);
            }
        })
    });

    //proses update slip gaji
    $(document).on('submit', '#formEditSlipGaji', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/update_slip',
            data: formData,
            beforeSend: function() {
                $('#loadBtn').show();
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tata.success('Success!', 'Slip gaji berhasil dirubah!');
                    $('#editFormSlipGaji').hide();
                    $('#loadBtn').hide();

                }
            }
        });
    });

    //show slip gaji
    $(document).on('click', '#btnLihatSlipGaji', function() {

        let nip = $(this).data('nip');


        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/viewSlipGaji/' + nip,
            beforeSend: function() {

            },
            success: function(response) {
                $('#wadahModalViewSlipGaji').html(response);
                $('#modal-view-slip-gaji').modal('show');
            }
        });
    });

    //view slip gaji every employee
    showFormViewSlipGaji();

    function showFormViewSlipGaji() {
        $.ajax({
            type: "POST",
            url: base_url + 'gaji/showFormViewSlipGaji',
            beforeSend: function() {

            },
            success: function(response) {
                $('.wadahFormViewSlipGaji').html(response);
                $('#nip_pegawai_view_slip_gaji').select2({
                    placeholder: "- Pilih Pegawai -",
                    allowClear: true
                });


            }
        });
    }

    //get slip gaji employee
    $(document).on('change', '#nip_pegawai_view_slip_gaji', function() {
        let nip = $('#nip_pegawai_view_slip_gaji option:selected').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/resultViewSlipGaji/' + nip,
            success: function(response) {
                $('.result-view-slip-gaji').html(response);
                $('#dataTableHoverr').DataTable();

                $('#tahun_filter_slip_gaji').datepicker({
                    minViewMode: 2,
                    format: 'yyyy'
                });
            }
        });
    });

    //show slip gaji
    $(document).on('click', '#btnViewSlipGaji', function() {

        let nip = $(this).data('nip');
        let id = $(this).data('id');
        let is_profile = $(this).data('isprofile');

        showSlipGajiEmp(id, nip, is_profile);

    });



    function showSlipGajiEmp(id, nip, is_profile) {
        $.ajax({
            method: "POST",
            url: base_url_pusher + 'profile/viewSlipGajiEmp/' + id + '/' + nip,
            beforeSend: function() {

            },
            success: function(response) {
                $('#wadahModalViewSlipGaji').html(response);
                if (is_profile == true) {
                    $('#modal-history-gaji').modal('hide');
                }
                $('#modal-view-slip-gaji2').modal('show');

                $('#modal-view-slip-gaji2').on('hidden.bs.modal', function(e) {
                    showRiwayatGaji(nip);

                });
            }
        });
    }

    //filter slip gaji
    $(document).on('click', '#btnFilterSlipGaji', function(e) {
        e.preventDefault();

        let nip = $('#nip_pegawai_view_slip_gaji option:selected').val();
        let bulan = $('#bulan_filter_slip_gaji option:selected').val();
        let tahun = $('#tahun_filter_slip_gaji').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/resultViewSlipGaji/' + nip + '/' + bulan + '/' + tahun,
            success: function(response) {
                $('.result-view-slip-gaji').html(response);
                $('#dataTableHoverr').DataTable();

                $('#tahun_filter_slip_gaji').datepicker({
                    minViewMode: 2,
                    format: 'yyyy'
                });
            }
        });


    });

    //reset filter
    $(document).on('click', '#btnResetFilterSlipGaji', function(e) {
        e.preventDefault();

        let nip = $('#nip_pegawai_view_slip_gaji option:selected').val();


        $.ajax({
            method: "POST",
            url: base_url_pusher + 'gaji/resultViewSlipGaji/' + nip,
            success: function(response) {
                $('.result-view-slip-gaji').html(response);
                $('#dataTableHoverr').DataTable();

                $('#tahun_filter_slip_gaji').datepicker({
                    minViewMode: 2,
                    format: 'yyyy'
                });
            }
        });


    });


    //kpi
    //slip gaji
    showPegawaiNilaiKpi();

    function showPegawaiNilaiKpi() {
        $.ajax({
            type: "POST",
            url: base_url + 'kpi/showPegawaiNilaiKpi',
            beforeSend: function() {

            },
            success: function(response) {
                $('.wadahFormTambahNilaiKpi').html(response);
                $('#nip_pegawai_nilai_kpi').select2({
                    placeholder: "- Pilih Pegawai -",
                    allowClear: true
                });


            }
        });
    }

    //show input form nilai kpi
    $(document).on('change', '#nip_pegawai_nilai_kpi', function() {
        let nip = $('#nip_pegawai_nilai_kpi option:selected').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'kpi/formTambahNilaiKpi/' + nip,
            success: function(response) {
                $('.form-tambah-nilai-kpi').html(response);
                //$('#dataTableHoverr').DataTable();
                //loadBtnAction(nip);
            }
        });
    });

    function loadFormTambahNilaiKpi() {
        let nip = $('#nip_pegawai_nilai_kpi option:selected').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'kpi/formTambahNilaiKpi/' + nip,
            success: function(response) {
                $('.form-tambah-nilai-kpi').html(response);
                //$('#dataTableHoverr').DataTable();
                //loadBtnAction(nip);
            }
        });
    }

    //insert nilai kpi
    $(document).on('submit', '#formTambahNilaiKpi', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'kpi/insert',
            data: formData,
            beforeSend: function() {
                $('#loadBtn').show();
            },

            success: function(data) {
                var data = JSON.parse(data);

                if (data.statusCode == 200) {
                    tata.success('Success', 'Nilai KPI Berhasil Ditambah!');
                    $('#loadBtn').hide();
                    loadFormTambahNilaiKpi();
                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    if (data.error == true) {
                        if (data.kehadiran_error != '') {
                            $('#kehadiran_error').html(data.kehadiran_error);
                        } else {

                            $('#kehadiran_error').html("");
                        }

                        if (data.kinerja_error != '') {
                            $('#kinerja_error').html(data.kinerja_error);
                        } else {
                            $('#kinerja_error').html("");

                        }

                        $('#loadBtn').hide();
                    }
                }
            }

        });
    });

    //show edit form kpi
    $(document).on('click', '#btnEditNilaiKpi', function() {
        let id = $(this).data('id');

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'kpi/editFormTambahNilaiKpi/' + id,
            success: function(response) {
                $('#editFormTambahKpi').html(response);
            }
        });
    });

    //proses update nilai kpi pegawai
    $(document).on('submit', '#formEditNilaiKpi', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'kpi/update',
            data: formData,
            beforeSend: function() {
                $('#loadBtn').show();
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    tata.success('Success!', 'Nilai KPI berhasil dirubah!');
                    $('#editFormTambahKpi').hide();
                    $('#loadBtn').hide();
                    loadFormTambahNilaiKpi();
                } else if (data.statusCode == 201) {

                } else {
                    if (data.error == true) {
                        if (data.kehadiran_error != '') {
                            $('#kehadiran_error').html(data.kehadiran_error);
                        } else {

                            $('#kehadiran_error').html("");
                        }

                        if (data.kinerja_error != '') {
                            $('#kinerja_error').html(data.kinerja_error);
                        } else {
                            $('#kinerja_error').html("");

                        }

                        $('#loadBtn').hide();
                    }
                }
            }
        });
    });

    //load data nilai kpi
    loadTableKpi('kpi/loadTable');
    loadTableMyKpi('mykpi/loadTable');
    $('#tahun_filter_kpi').datepicker({
        minViewMode: 2,
        format: 'yyyy'
    });

    function loadTableKpi(url2, onFilter = false) {

        if (onFilter == false) {
            var bln = '<?php echo date("m"); ?>';
            var thn = '<?php echo date("Y"); ?>';


            $.ajax({
                type: "POST",
                url: base_url_pusher + url2,
                success: function(response) {
                    $('.list-data-kpi').html(response);
                    $('#dataTableHover').DataTable();
                    $('#bulan_filter_kpi').val(bln);


                    $('#tahun_filter_kpi').val(thn);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: base_url_pusher + url2,
                beforeSend: function() {
                    $('#loadBtnFilter').show();
                },
                success: function(response) {
                    $('.list-data-kpi').html(response);
                    $('#dataTableHover').DataTable();
                    $('#loadBtnFilter').hide();

                }
            });
        }

    }

    function loadTableMyKpi(url2, onFilter = false) {

        if (onFilter == false) {
            var bln = '<?php echo date("m"); ?>';
            var thn = '<?php echo date("Y"); ?>';


            $.ajax({
                type: "POST",
                url: base_url_pusher + url2,
                success: function(response) {
                    $('.list-data-mykpi').html(response);
                    $('#dataTableHover').DataTable();
                    $('#bulan_filter_kpi').val(bln);


                    $('#tahun_filter_kpi').val(thn);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: base_url_pusher + url2,
                beforeSend: function() {
                    $('#loadBtnFilter').show();
                },
                success: function(response) {
                    $('.list-data-mykpi').html(response);
                    $('#dataTableHover').DataTable();
                    $('#loadBtnFilter').hide();

                }
            });
        }

    }

    //filter data nilai kpi
    $(document).on('click', '#btnFilterKpi', function(e) {
        e.preventDefault();
        let bln = $('#bulan_filter_kpi option:selected').val();
        let thn = $('#tahun_filter_kpi').val();

        loadTableKpi('kpi/loadTable/' + bln + '/' + thn, true);

    });

    //filter data nilai mykpi
    $(document).on('click', '#btnFilterMyKpi', function(e) {
        e.preventDefault();
        let bln = $('#bulan_filter_kpi option:selected').val();
        let thn = $('#tahun_filter_kpi').val();

        loadTableMyKpi('mykpi/loadTable/' + bln + '/' + thn, true);
    });

    //show riwayat gaji
    $(document).on('click', '#btnRiwayatGaji', function(e) {
        e.preventDefault();
        let nip = $(this).data("nip");

        showRiwayatGaji(nip);

    });

    function showRiwayatGaji(nip) {
        $.ajax({
                type: "POST",
                url: base_url + 'profile/history_gaji/',
                beforeSend: function() {
                    $('.loadBtnGaji').show();
                }

            })
            .done(function(data) {
                $('#wadahModalRiwayatGaji').html(data);
                $('#modal-history-gaji').modal('show');
                bodymovin.loadAnimation({
                    container: document.getElementById('anim4'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: './assets/anim/settings.json'
                });
                //$('#dataTableHover').DataTable();
                loadTableRiwayatGaji('profile/loadTableModal', nip);
                $('.loadBtnGaji').hide();
            });
    }

    function loadTableRiwayatGaji(url2, nip) {
        $.ajax({
            type: "POST",
            url: base_url_pusher + url2 + '/' + nip,
            success: function(response) {
                $('.list-history-gaji').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }

    showFormRiwayatPemotonganCuti();

    function showFormRiwayatPemotonganCuti() {
        $.ajax({
            type: "POST",
            url: base_url + 'cuti/showFormRiwayatPemotonganCuti',
            beforeSend: function() {

            },
            success: function(response) {
                $('.wadahFormRiwayatPemotonganCuti').html(response);
                $('#nip_pegawai_riwayat_pemotongan_cuti').select2({
                    placeholder: "- Pilih Pegawai -",
                    allowClear: true
                });


            }
        });
    }

    //get riwayat pemotongan cuti for hrd
    $(document).on('change', '#nip_pegawai_riwayat_pemotongan_cuti', function() {
        let nip = $('#nip_pegawai_riwayat_pemotongan_cuti option:selected').val();

        $.ajax({
            method: "POST",
            url: base_url_pusher + 'cuti/resultRiwayatPerubahanGaji/' + nip,
            success: function(response) {
                $('.result-riwayat-pemotongan-cuti').html(response);
                $('#dataTableHoverr').DataTable();
                $('#dataTableHoverr2').DataTable();
            }
        });
    });

    $(document).on('click', '#btnTambahAktivitasLainnya', function() {
        let guid = () => {
            let s4 = () => {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }
            //return id of format 'aaaaaaaa'-'aaaa'-'aaaa'-'aaaa'-'aaaaaaaaaaaa'
            return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
        }

        let uniq_id = guid();
        $('.content-table-activity').append(`
                                <tr id="${uniq_id}">
                                    <td style="vertical-align: middle; text-align: center;">
                                        <button type="button" class="btn btn-sm btn-danger" id="btnDeleteFormActivity" data-id="${uniq_id}"><i class="fas fa-times"></i></button>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control activity" name="activity[]" id="activity" rows="3" autocomplete="off" placeholder="Isikan aktivitas Anda disini.."></textarea>
                                            <span class="activity-err err-space"></span>
                                        </div>
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <div class="form-group">
                                            <div class="input-group clockpicker cp-2" id="clockPicker2">
                                                <input type="text" class="form-control" name="mulai[]" id="mulai" value="" autocomplete="off" placeholder="HH:mm">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                            </div>
                                            <span class="mulai-err err-space"></span>
                                        </div>
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <div class="form-group">
                                            <div class="input-group clockpicker cp-2" id="clockPicker2">
                                                <input type="text" class="form-control" name="akhir[]" id="akhir" value="" autocomplete="off" placeholder="HH:mm">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                            </div>
                                            <span class="akhir-err err-space"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control" name="realisasi[]" id="realisasi" rows="3" autocomplete="off" placeholder="Isikan realisasi dari aktivitas Anda disini.."></textarea>
                                            <span class="realisasi-err err-space"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control" name="target[]" id="target" rows="3" autocomplete="off" placeholder="Isikan target dari aktivitas Anda jika ada.."></textarea>
                                        </div>
                                    </td>
                                </tr>
        `);

        $('.cp-2').clockpicker({
            autoclose: true
        });

        $(".activity-err").each(function(index, el) {
            $(this).attr('id', 'activity_' + index);
        });

        $(".mulai-err").each(function(index, el) {
            $(this).attr('id', 'mulai_' + index);
        });

        $(".akhir-err").each(function(index, el) {
            $(this).attr('id', 'akhir_' + index);
        });

        $(".realisasi-err").each(function(index, el) {
            $(this).attr('id', 'realisasi_' + index);
        });
    });

    $(document).on('click', '#btnDeleteFormActivity', function() {
        let id = $(this).data('id');
        $(`#${id}`).remove();

        $(".activity-err").each(function(index, el) {
            $(this).attr('id', 'activity_' + index);
        });

        $(".mulai-err").each(function(index, el) {
            $(this).attr('id', 'mulai_' + index);
        });

        $(".akhir-err").each(function(index, el) {
            $(this).attr('id', 'akhir_' + index);
        });

        $(".realisasi-err").each(function(index, el) {
            $(this).attr('id', 'realisasi_' + index);
        });
    });

    $(document).on('click', '#btnSubmitFormAddActivity', function() {
        $('#formTambahActivity').trigger('submit');
    });

    <?php if ($nav_title == 'home') : ?>
        $(document).on('submit', '#formTambahActivity', function(e) {
            e.preventDefault();
            let form_data = $(this).serialize();

            $.ajax({
                url: base_url_pusher + 'activity/add',
                method: "POST",
                data: form_data,
                beforeSend: function() {
                    topbar.show();
                    $('#btnSubmitFormAddActivity').attr('disabled', true);
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 400) {
                        let activity_err_data = JSON.parse(data.activity_err_arr);
                        let mulai_err_data = JSON.parse(data.mulai_err_arr);
                        let akhir_err_data = JSON.parse(data.akhir_err_arr);
                        let realisasi_err_data = JSON.parse(data.realisasi_err_arr);
                        //console.log(err_data.length);
                        activity_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });

                        mulai_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });

                        akhir_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });

                        realisasi_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });
                    } else if (data.statusCode == 201) {
                        tata.error(data.status, data.message);
                    } else {
                        tata.success(data.status, data.message);
                        $('.err-space').html("");
                        $('#modalAddActivity').modal('hide');
                    }


                    topbar.hide();
                    $('#btnSubmitFormAddActivity').removeAttr('disabled');
                }
            })
        });
    <?php endif ?>

    <?php if ($nav_title == 'aktivitas') : ?>
        $(document).on('submit', '#formTambahActivity', function(e) {
            e.preventDefault();
            let form_data = $(this).serialize();

            $.ajax({
                url: base_url_pusher + 'activity/add',
                method: "POST",
                data: form_data,
                beforeSend: function() {
                    topbar.show();
                    $('#btnSubmitFormAddActivity').attr('disabled', true);
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 400) {
                        let activity_err_data = JSON.parse(data.activity_err_arr);
                        let mulai_err_data = JSON.parse(data.mulai_err_arr);
                        let akhir_err_data = JSON.parse(data.akhir_err_arr);
                        let realisasi_err_data = JSON.parse(data.realisasi_err_arr);
                        //console.log(err_data.length);
                        activity_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });

                        mulai_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });

                        akhir_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });

                        realisasi_err_data.forEach(function(nilai, index) {
                            let keys_object = Object.keys(nilai)[0];
                            let values_object = Object.values(nilai)[0];
                            if (values_object !== "") {
                                $('#' + keys_object).html(values_object);
                            } else {
                                $('#' + keys_object).html("");
                            }
                        });
                    } else if (data.statusCode == 201) {
                        tata.error(data.status, data.message);
                    } else {
                        tata.success(data.status, data.message);
                        $('.err-space').html("");
                        $('#modalAddActivity').modal('hide');
                        load_aktivitas_pegawai();
                    }


                    topbar.hide();
                    $('#btnSubmitFormAddActivity').removeAttr('disabled');
                }
            })
        });

        $(document).on('click', '#btnEditActivity', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                url: base_url_pusher + 'activity/edit',
                method: "GET",
                data: {
                    id: id
                },
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    $('#modalEditActivity').html(response);
                    $('#modal-edit-activity').modal('show');
                    $('.cp-2').clockpicker({
                        autoclose: true
                    });
                    topbar.hide();
                }
            })
        });

        $(document).on('click', '#btnSubmitFormEditActivity', function(e) {
            $('#formEditActivity').trigger('submit');
        });

        $(document).on('submit', '#formEditActivity', function(e) {
            e.preventDefault();
            let form_data = $(this).serialize();
            $.ajax({
                url: base_url_pusher + 'activity/update',
                method: "POST",
                data: form_data,
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.statusCode == 200) {
                        tata.success(data.status, data.message);
                        $('.err-space').html("");
                        $('#modal-edit-activity').modal('hide');

                        let get_data_update = JSON.parse(data.data_update);

                        $('#data-' + get_data_update.id + ' .isi-aktivitas').text(get_data_update.isi_aktivitas);
                        $('#data-' + get_data_update.id + ' .mulai-aktivitas').text(get_data_update.mulai);
                        $('#data-' + get_data_update.id + ' .selesai-aktivitas').text(get_data_update.selesai);
                        $('#data-' + get_data_update.id + ' .realisasi-aktivitas').text(get_data_update.realisasi);
                        $('#data-' + get_data_update.id + ' .target-aktivitas').text(get_data_update.target);

                    } else if (data.statusCode == 201) {
                        tata.error(data.status, data.message);
                    } else {

                    }

                    topbar.hide();
                }
            })
        });

        $(document).on('click', '#btnDeleteActivity', function(e) {
            e.preventDefault();

            let id = $(this).data('id')
            Swal.fire({
                title: 'Anda Yakin Ingin Menghapus Data ini?',
                text: "Anda Tidak Dapat Mengembalikan Aksi ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffa426',
                cancelButtonColor: '#757575',
                confirmButtonText: 'Ya, Saya Yakin',
                cancelButtonText: 'Batal',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url_pusher + 'activity/destroy/' + id,
                        method: "POST",
                        beforeSend: function() {
                            topbar.show();
                        },
                        success: function(data) {
                            $('#data-' + id).remove();
                            topbar.hide();
                        }
                    });
                }
            });
        });

        $(document).on('change', '#nip_pegawai_aktivitas', function() {
            let nip_pegawai = $(this).val();
            $.ajax({
                url: base_url_pusher + 'activity/load-result-aktivitas-pegawai',
                method: "GET",
                data: {
                    nip_pegawai: nip_pegawai,
                },
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    $('.result-activity').html(response);
                    $('#dataTableAktivitas').DataTable({
                        "order": [
                            [0, "desc"]
                        ], //or asc 
                        "columnDefs": [{
                            "targets": 0,
                            "type": "date-eu"
                        }],
                    });

                    topbar.hide();
                }
            })
        });

        $('#tahun_filter_rekap_aktivitas').datepicker({
            minViewMode: 2,
            format: 'yyyy'
        });

        $(document).on('click', '#btnFilterRekapAktivitas', function(e) {
            e.preventDefault();
            let month = $('#bulan_filter_rekap_aktivitas option:selected').val();
            let year = $('#tahun_filter_rekap_aktivitas').val();

            $.ajax({
                url: base_url_pusher + 'activity/rekap/' + month + '/' + year,
                method: "POST",
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    $('.result-rekap-activity').html(response);
                    $('#dataTableRekapAktivitas').DataTable({
                        scrollY: "500px",
                        scrollX: true,
                        scrollCollapse: true,
                        paging: true,
                        fixedColumns: true,
                    });
                    topbar.hide();

                }
            })
        });

        $(document).on('click', '#btnResetFilterRekapAktivitas', function(e) {
            e.preventDefault();

            $.ajax({
                url: base_url_pusher + 'activity/rekap',
                method: "POST",
                beforeSend: function() {
                    topbar.show();
                },
                success: function(response) {
                    $('.result-rekap-activity').html(response);
                    $('#dataTableRekapAktivitas').DataTable({
                        scrollY: "500px",
                        scrollX: true,
                        scrollCollapse: true,
                        paging: true,
                        fixedColumns: true,
                    });
                    $('#bulan_filter_rekap_aktivitas').val('<?= date('m') ?>');
                    $('#tahun_filter_rekap_aktivitas').val('<?= date('Y'); ?>');
                    topbar.hide();

                }
            })
        });

        function load_aktivitas_pegawai() {
            $.ajax({
                url: base_url_pusher + 'activity/load-aktivitas-pegawai',
                method: "GET",
                beforeSend: function() {

                },
                success: function(response) {
                    $('.table-aktivitas-space').html(response);
                    $('#dataTableAktivitas').DataTable({
                        "order": [
                            [0, "desc"]
                        ], //or asc 
                        "columnDefs": [{
                            "targets": 0,
                            "type": "date-eu"
                        }],
                    });
                }
            });
        }
    <?php endif ?>

    //bpjs
    let countPegawai = Number("<?= isset($countPegawai) ? $countPegawai : "" ?>");

    for (let i = 1; i <= countPegawai; i++) {
        $(document).on('change', '#bpjsKetenagakerjaan' + i, function() {
            let nip = $(this).data('nip');
            if ($(this).is(":checked")) {
                $.ajax({
                    method: "POST",
                    url: base_url_pusher + 'pegawai/updateBpjs/' + nip + '/ketenagakerjaan/' + 1,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {

                        }
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: base_url_pusher + 'pegawai/updateBpjs/' + nip + '/ketenagakerjaan/' + 0,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {

                        }
                    }
                });
            }
        });
    }

    for (let i = 1; i <= countPegawai; i++) {
        $(document).on('change', '#bpjsKesehatan' + i, function() {
            let nip = $(this).data('nip');
            if ($(this).is(":checked")) {
                $.ajax({
                    method: "POST",
                    url: base_url_pusher + 'pegawai/updateBpjs/' + nip + '/kesehatan/' + 1,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {

                        }
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: base_url_pusher + 'pegawai/updateBpjs/' + nip + '/kesehatan/' + 0,
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {

                        }
                    }
                });
            }
        });
    }
</script>


<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    //chart area
    var ctx = document.getElementById("chartPegawai");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($lokasi as $row) {
                    echo "'" . $row->nama_lokasi . "',";
                }


                ?>
            ],
            datasets: [{
                label: "Jumlah Pegawai",
                backgroundColor: ["#565656", "#ffa426", "#565656", "#ffa426", "#565656", "#ffa426"],
                hoverBackgroundColor: ["#565656", "#ffa426", "#565656", "#ffa426", "#565656", "#ffa426"],
                borderColor: ["#565656", "#ffa426", "#565656", "#ffa426", "#565656", "#ffa426"],
                data: [

                    <?php
                    foreach ($lokasi as $row) {
                        echo $count[$row->id] . ", ";
                    }

                    ?>
                ]
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'lokasi'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },

                    maxBarThickness: 50,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,

                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        // callback: function(value, index, values) {
                        //     return '$' + number_format(value);
                        // }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    // label: function(tooltipItem, chart) {
                    //     var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    //     return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    // }
                }
            },
        }
    });




    // Pie Chart Example
    var ctx = document.getElementById("chartJekel");
    var chartJekel = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [{
                data: [<?= $male; ?>, <?= $female; ?>],
                backgroundColor: ['#3abaf4', '#f997c9'],
                hoverBackgroundColor: ['#3abaf4', '#f997c9'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 20,
                yPadding: 15,
                displayColors: true,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 60,
        },
    });

    //chart area
    var ctx = document.getElementById("chartUmur");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                "17 - 29", "30 - 49", "50 - 65"
            ],
            datasets: [{
                label: "Jumlah Pegawai",
                backgroundColor: ["#565656", "#ffa426", "#565656"],
                hoverBackgroundColor: ["#565656", "#ffa426", "#565656"],
                borderColor: ["#565656", "#ffa426", "#565656"],
                data: [
                    <?= $umur1729; ?>, <?= $umur3049; ?>, <?= $umur5065; ?>
                ]
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'lokasi'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },

                    maxBarThickness: 50,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,

                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        // callback: function(value, index, values) {
                        //     return '$' + number_format(value);
                        // }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    // label: function(tooltipItem, chart) {
                    //     var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    //     return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    // }
                }
            },
        }
    });

    //chart area
    var ctx = document.getElementById("chartDurasiKerja");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                "Kurang dari setahun", "1 - 5 tahun", "Lebih dari 5 tahun"
            ],
            datasets: [{
                label: "Jumlah Pegawai",
                backgroundColor: ["#565656", "#ffa426", "#565656"],
                hoverBackgroundColor: ["#565656", "#ffa426", "#565656"],
                borderColor: ["#565656", "#ffa426", "#565656"],
                data: [
                    <?= $kurangsetahun; ?>, <?= $rentang; ?>, <?= $lebihdarirentang; ?>
                ]
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'lokasi'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },

                    maxBarThickness: 50,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,

                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        // callback: function(value, index, values) {
                        //     return '$' + number_format(value);
                        // }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    // label: function(tooltipItem, chart) {
                    //     var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    //     return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    // }
                }
            },
        }
    });
</script>