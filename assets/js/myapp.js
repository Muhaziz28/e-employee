const base_url = 'http://localhost/soraya_employee/';
const flashdata = $('.flash-data').data('flashdata');
const message = $('.flash-data').data('message');



$(document).ready(function () {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover


    if (flashdata == 'Success!') {
        tata.success(flashdata, message);
    }


    $('#simple-date1 .input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
    });

    $('#nip_pegawai_potong_cuti').select2({
        placeholder: "- Pilih Pegawai -",
        allowClear: true
    });


    $('#jatah_cuti').TouchSpin({
        min: 1,
        max: 12,
        boostat: 5,
        maxboostedstep: 10,
        initval: 1,
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary',
    });

    $('.loadBtn').hide();
    $('.loadBtnGaji').hide();



    //cek if page reloaded
    if (performance.navigation.type == 1) {
        remove_hash_from_url();
    } else {
        if (window.location.hash == '#success') {
            tata.success('Success', 'Data Berhasil Ditambahkan!', {
                onClick: null
            });
        }

        if (window.location.hash == '#successEdit') {
            tata.success('Success', 'Data Berhasil Dirubah!', {
                onClick: null
            });
        }
    }

    //to remove hash from url
    function remove_hash_from_url() {
        var uri = window.location.toString();

        if (uri.indexOf("#") > 0) {
            var clean_uri = uri.substring(0,
                uri.indexOf("#"));

            window.history.replaceState({},
                document.title, clean_uri);
        }
    }


    //show modal add divisi
    $(document).on('click', '#btnTambahDivisi', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'divisi/showForm'

        })
            .done(function (data) {
                $('#wadahModalTambahDivisi').html(data);
                $('#modal-add-divisi').modal('show');
            });
    });

    //add data divisi
    $(document).on('submit', '#formTambahDivisi', function (e) {

        e.preventDefault();

        //get value from form
        let nama_divisi = $('#nama_divisi').val();
        let ket = $('#ket').val();

        //do ajax
        $.ajax({
            url: base_url + 'divisi/insert',
            method: "POST",
            data: { nama_divisi: nama_divisi, ket: ket },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {

                    loadTableDivisi('divisi/loadTable');
                    $('#formTambahDivisi')[0].reset();
                    tata.success('Success', 'Data Berhasil Ditambahkan!');
                    $('#nama_divisi_error').html('');
                    $('#nama_divisi').removeClass('is-invalid');
                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        console.log(data.nama_divisi_error);
                        if (data.nama_divisi_error != '') {
                            $('#nama_divisi_error').html(data.nama_divisi_error);
                            $('#nama_divisi').removeClass('is-valid').addClass('is-invalid');

                        }
                    }
                }
            }
        });

    });


    //load data divisi
    loadTableDivisi('divisi/loadTable');
    function loadTableDivisi(url2) {
        $.ajax({
            type: "POST",
            url: base_url + url2,
            success: function (response) {
                $('.list-data-divisi').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }

    //show modal edit divisi
    $(document).on('click', '#btnEditDivisi', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: base_url + 'divisi/showFormEdit/' + id

        })
            .done(function (data) {
                $('#wadahModalEditDivisi').html(data);
                $('#modal-edit-divisi').modal('show');
            });
    });


    //update data divisi
    $(document).on('submit', '#formEditDivisi', function (e) {

        e.preventDefault();

        //get value from form
        let id = $('#id_divisi').val();
        let nama_divisi_edit = $('#nama_divisi_edit').val();
        let ket_edit = $('#ket_edit').val();

        //do ajax
        $.ajax({
            url: base_url + 'divisi/update',
            method: "POST",
            data: { id: id, nama_divisi: nama_divisi_edit, ket: ket_edit },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    loadTableDivisi('divisi/loadTable');

                    $('#modal-edit-divisi').modal('hide');
                    tata.success('Success', 'Data Berhasil Dirubah!');

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        if (data.nama_divisi_error != '') {
                            $('#nama_divisi_error').html(data.nama_divisi_error);
                            $('#nama_divisi_edit').removeClass('is-valid').addClass('is-invalid');

                        }
                    }
                }
            }
        });
    });

    //delete data divisi
    $(document).on('click', '#btnDeleteDivisi', function (e) {
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
                    url: base_url + 'divisi/destroy/' + id,
                    method: "POST",
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            loadTableDivisi('divisi/loadTable');
                            tata.success('Success', 'Data Berhasil Dihapus!');
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }
                    }
                });
            }
        })

    });

    //show modal add jabatan
    $(document).on('click', '#btnTambahJabatan', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'jabatan/showForm'

        })
            .done(function (data) {
                $('#wadahModalTambahJabatan').html(data);
                $('.select2-single').select2({
                    placeholder: "- Pilih Divisi -",
                    allowClear: true
                });
                $('#modal-add-jabatan').modal('show');

            });
    });


    //add data jabatan
    $(document).on('submit', '#formTambahJabatan', function (e) {

        e.preventDefault();

        //get value from form
        let nama_jabatan = $('#nama_jabatan').val();
        let id_divisi = $('#id_divisi option:selected').val();
        let ket = $('#ket_jabatan').val();

        //do ajax
        $.ajax({
            url: base_url + 'jabatan/insert',
            method: "POST",
            data: { nama_jabatan: nama_jabatan, id_divisi: id_divisi, ket: ket },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    loadTableJabatan('jabatan/loadTable');
                    $('#formTambahJabatan')[0].reset();
                    tata.success('Success', 'Data Berhasil Ditambahkan!');

                    //remove message validation error
                    $('#nama_jabatan_error').html('');

                    //show select2
                    $('.select2-single').select2({
                        placeholder: "- Pilih Divisi -",
                        allowClear: true
                    });

                    $('.select2-single').select2("val", "");

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        console.log(data.nama_jabatan_error);
                        if (data.nama_jabatan_error != '') {
                            $('#nama_jabatan_error').html(data.nama_jabatan_error);
                            $('#nama_jabatan').removeClass('is-valid').addClass('is-invalid');

                        } else {
                            $('#nama_jabatan_error').html('');
                            $('#nama_jabatan').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data.id_divisi_error != '') {
                            $('#nama_divisi_error').html(data.id_divisi_error);

                        } else {
                            $('#nama_divisi_error').html('');
                        }
                    }
                }
            }
        });

    });

    //show modal edit jabatan
    $(document).on('click', '#btnEditJabatan', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: base_url + 'jabatan/showFormEdit/' + id

        })
            .done(function (data) {
                $('#wadahModalEditJabatan').html(data);
                $('#modal-edit-jabatan').modal('show');

                //show select2
                $('.select2-single').select2({
                    placeholder: "- Pilih Divisi -",
                    allowClear: true
                });
            });
    });

    //update data jabatan
    $(document).on('submit', '#formEditJabatan', function (e) {

        e.preventDefault();

        //get value from form
        let id = $('#id_jabatan').val();
        let nama_jabatan_edit = $('#nama_jabatan_edit').val();
        let id_divisi = $('#id_divisi_jabatan_edit option:selected').val();
        let ket_jabatan_edit = $('#ket_jabatan_edit').val();

        //do ajax
        $.ajax({
            url: base_url + 'jabatan/update',
            method: "POST",
            data: { id: id, nama_jabatan: nama_jabatan_edit, id_divisi: id_divisi, ket: ket_jabatan_edit },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    loadTableJabatan('jabatan/loadTable');

                    $('#modal-edit-jabatan').modal('hide');
                    tata.success('Success', 'Data Berhasil Dirubah!');

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        if (data.nama_jabatan_error != '') {
                            $('#nama_jabatan_error').html(data.nama_jabatan_error);
                            $('#nama_jabatan').removeClass('is-valid').addClass('is-invalid');

                        } else {
                            $('#nama_jabatan_error').html('');
                            $('#nama_jabatan').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data.id_divisi_error != '') {
                            $('#nama_divisi_error').html(data.id_divisi_error);

                        } else {
                            $('#nama_divisi_error').html('');
                        }
                    }
                }
            }
        });
    });

    //delete data jabatan
    $(document).on('click', '#btnDeleteJabatan', function (e) {
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
                    url: base_url + 'jabatan/destroy/' + id,
                    method: "POST",
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            loadTableJabatan('jabatan/loadTable');
                            tata.success('Success', 'Data Berhasil Dihapus!');
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }
                    }
                });
            }
        })

    });


    //load data jabatan
    loadTableJabatan('jabatan/loadTable');
    function loadTableJabatan(url2) {
        $.ajax({
            type: "POST",
            url: base_url + url2,
            success: function (response) {
                $('.list-data-jabatan').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }

    //show modal add level
    $(document).on('click', '#btnTambahLevel', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'level/showForm'

        })
            .done(function (data) {
                $('#wadahModalTambahLevel').html(data);
                $('#modal-add-level').modal('show');
            });
    });

    //add data level
    $(document).on('submit', '#formTambahLevel', function (e) {
        e.preventDefault();

        //get value from form
        let nama_level = $('#nama_level').val();
        let ket = $('#ket').val();

        //do ajax
        $.ajax({
            url: base_url + 'level/insert',
            method: "POST",
            data: {
                nama_level: nama_level,
                ket: ket
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    loadTableLevel('level/loadTable');
                    $('#formTambahLevel')[0].reset();

                    //show message success
                    tata.success('Success', 'Data Berhasil Ditambahkan!');

                    //remove invalid validation style in form input
                    $('#nama_level_error').html('');
                    $('#nama_level').removeClass('is-invalid');
                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        console.log(data.nama_level_error);
                        if (data.nama_level_error != '') {
                            $('#nama_level_error').html(data.nama_level_error);
                            $('#nama_level').removeClass('is-valid').addClass('is-invalid');

                        }
                    }
                }
            }
        });
    });

    loadTableLevel('level/loadTable');
    function loadTableLevel(url2) {
        $.ajax({
            type: "POST",
            url: base_url + url2,
            success: function (response) {
                $('.list-data-level').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }

    //show modal edit level
    $(document).on('click', '#btnEditLevel', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: base_url + 'level/showFormEdit/' + id
        })
            .done(function (data) {
                $('#wadahModalEditLevel').html(data);
                $('#modal-edit-level').modal('show');
            });
    });

    //update data level
    $(document).on('submit', '#formEditLevel', function (e) {
        e.preventDefault();

        //get value from form
        let id = $('#id_level').val();
        let nama_level_edit = $('#nama_level_edit').val();
        let ket_edit = $('#ket_edit').val();

        //do ajax
        $.ajax({
            url: base_url + 'level/update',
            method: "POST",
            data: { id: id, nama_level: nama_level_edit, ket: ket_edit },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    loadTableLevel('level/loadTable');

                    $('#modal-edit-level').modal('hide');
                    tata.success('Success', 'Data Berhasil Dirubah!');

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        if (data.nama_level_error != '') {
                            $('#nama_level_error').html(data.nama_level_error);
                            $('#nama_level_edit').removeClass('is-valid').addClass('is-invalid');

                        }
                    }
                }
            }
        });
    });

    $(document).on('click', '#btnDeleteLevel', function (e) {
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
                    url: base_url + 'level/destroy/' + id,
                    method: "POST",
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            loadTableLevel('level/loadTable');
                            tata.success('Success', 'Data Berhasil Dihapus!');
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }
                    }
                });
            }
        })
    });


    //form tambah pegawai
    $(document).on('change', '#id_divisi_pegawai', function () {
        let id_divisi = $('#id_divisi_pegawai option:selected').val();

        $.ajax({
            type: "POST",
            url: base_url + 'pegawai/formSelectJabatan/' + id_divisi,
            success: function (response) {
                $('#id_jabatan_pegawai').html(response);
                $('#id_jabatan_pegawai').removeAttr('disabled');
            }
        });

    });

    $(document).on('submit', '#formTambahPegawai', function (e) {
        e.preventDefault();
        let data = $(this).serialize();

        $.ajax({
            url: base_url + 'pegawai/insert',
            method: "POST",
            data: data,
            success: function (data) {
                let data_response = JSON.parse(data);
                if (data_response.statusCode == 400) {
                    if (data_response.error == true) {
                        if (data_response.nama_error != '') {
                            $('#nama_error').html(data_response.nama_error);
                            $('#nama_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#nama_error').html('');
                            $('#nama_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.email_error != '') {
                            $('#email_error').html(data_response.email_error);
                            $('#email_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#email_error').html('');
                            $('#email_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tempat_lahir_error != '') {
                            $('#tempat_lahir_error').html(data_response.tempat_lahir_error);
                            $('#tempat_lahir_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tempat_lahir_error').html('');
                            $('#tempat_lahir_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tgl_lahir_error != '') {
                            $('#tgl_lahir_error').html(data_response.tgl_lahir_error);
                            $('#tgl_lahir_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tgl_lahir_error').html('');
                            $('#tgl_lahir_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.nohp_error != '') {
                            $('#nohp_error').html(data_response.nohp_error);
                            $('#nohp_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#nohp_error').html('');
                            $('#nohp_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.jenis_kelamin_error != '') {
                            $('#jenis_kelamin_error').html(data_response.jenis_kelamin_error);

                        } else {
                            $('#jenis_kelamin_error').html('');

                        }

                        if (data_response.agama_error != '') {
                            $('#agama_error').html(data_response.agama_error);

                        } else {
                            $('#agama_error').html('');

                        }
                        if (data_response.status_error != '') {
                            $('#status_error').html(data_response.status_error);
                        } else {
                            $('#status_error').html('');
                        }

                        if (data_response.pendidikan_error != '') {
                            $('#pendidikan_error').html(data_response.pendidikan_error);
                        } else {
                            $('#pendidikan_error').html('');
                        }

                        if (data_response.status_pegawai_error != '') {
                            $('#status_pegawai_error').html(data_response.status_pegawai_error);
                        } else {
                            $('#status_pegawai_error').html('');
                        }

                        if (data_response.alamat_error != '') {
                            $('#alamat_error').html(data_response.alamat_error);
                        } else {
                            $('#alamat_error').html('');
                        }

                        if (data_response.tgl_masuk_error != '') {
                            $('#tgl_masuk_error').html(data_response.tgl_masuk_error);
                            $('#tgl_masuk_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tgl_masuk_error').html('');
                            $('#tgl_masuk_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.id_divisi_error != '') {
                            $('#id_divisi_error').html(data_response.id_divisi_error);
                        } else {
                            $('#id_divisi_error').html('');
                        }

                        if (data_response.id_jabatan_error != '') {
                            $('#id_jabatan_error').html(data_response.id_jabatan_error);
                        } else {
                            $('#id_jabatan_error').html('');
                        }

                        if (data_response.id_level_error != '') {
                            $('#id_level_error').html(data_response.id_level_error);
                        } else {
                            $('#id_level_error').html('');
                        }

                        if (data_response.id_lokasi_error != '') {
                            $('#id_lokasi_error').html(data_response.id_lokasi_error);
                        } else {
                            $('#id_lokasi_error').html('');
                        }

                        window.location.href = '#page-top';
                    }
                } else {
                    if (data_response.statusCode == 200) {

                        window.location.href = base_url + 'pegawai#success';


                    }

                }
            }
        });
    });

    // function generatePass() {
    //     $.ajax({
    //         url: base_url + 'pegawai/generatorPass',
    //         method: "POST",

    //         success: function (response) {

    //             $('#password_pegawai').val(response);

    //             $('#password_generator_pegawai').val(response);

    //             console.log(response);
    //         }
    //     });
    // }

    $(document).on('change', '#formTambahPegawai input[name=tgl_masuk]', function () {
        let gender = $('input[name=jenis_kelamin]:checked', '#formTambahPegawai').val();
        let getTahun = $('#tgl_masuk_pegawai').val();

        let tahun_masuk = getTahun.split("-");

        $.ajax({
            type: "POST",
            url: base_url + 'pegawai/showNipMax/' + gender,
            success: function (data) {
                var data = JSON.parse(data);
                $('#nip_max_pegawai').val(data.nip);
            }
        });

        let nip_max = $('#nip_max_pegawai').val();

        let nip = nipGenerator(gender, tahun_masuk[0].substring(2, tahun_masuk[0].length), nip_max);
        $('#nip_pegawai').val(nip);




    });

    $(document).on('change', '#formTambahPegawai input[name=jenis_kelamin]', function () {
        let gender = $('input[name=jenis_kelamin]:checked', '#formTambahPegawai').val();

        let getTahun = $('#tgl_masuk_pegawai').val();

        let tahun_masuk = getTahun.split("-");
        $.ajax({
            type: "POST",
            url: base_url + 'pegawai/showNipMax/' + gender,
            success: function (data) {
                var data = JSON.parse(data);
                $('#nip_max_pegawai').val(data.nip);
            }
        });


        let nip_max = $('#nip_max_pegawai').val();

        let nip = nipGenerator(gender, tahun_masuk[0].substring(2, tahun_masuk[0].length), nip_max);
        $('#nip_pegawai').val(nip);



    });

    $(document).on('change', '#status_pegawai', function () {

        let valueStatusPegawai = $('#status_pegawai option:selected').val();

        if (valueStatusPegawai == "Kontrak") {
            $('#satuan_durasi_pegawai').prop("disabled", false); //element are now enabled.
            $('#durasi_kerja_pegawai').prop("disabled", false);
        } else {
            $('#satuan_durasi_pegawai').prop("disabled", true); //element are now disabled.
            $('#durasi_kerja_pegawai').prop("disabled", true);
        }



    });

    //fungsi untuk generate nip
    function nipGenerator(gender, tahunMasuk, kodeMax) {
        let kodeGender = gender == "Laki-laki" ? "01" : "02";

        if (kodeMax != '' || kodeMax != undefined) {
            let count = Number(kodeMax.substring(4, kodeMax.length));
            count++;
            var ans = count.toString().padStart(4, '0');

            let nip = kodeGender + tahunMasuk + ans;
            return nip;
        } else {
            let nip = kodeGender + tahunMasuk + '0001';
            return nip;
        }



    }





    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square' //circle
        },
        boundary: {
            width: 300,
            height: 300
        }
    });


    $('#upload_image').on('change', function () {
        //get the file name
        var fileName = $(this).val();
        fileName = fileName.replace("C:\\fakepath\\", "");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
    });

    $('#crop_image').on('click', function () {
        var nama_pegawai = $('#nama_pegawai').val();
        var fileName = nama_pegawai == "" ? 'default' : nama_pegawai;
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: base_url + 'pegawai/uploadProfileImage/' + fileName,
                type: "POST",
                data: { "image": response },
                success: function (data) {
                    var data = JSON.parse(data);
                    $('#uploadimageModal').modal('hide');
                    $('#image_pegawai').val(data.image_name);
                    //$('#image_pegawai_temp').val("");
                    $('.wadah-image-pegawai').html(data.show_image);
                }
            });
        });
        // alert('OK');
    });


    //show list pegawai
    pegawaiList();


    //pagination pegawai
    $(document).on('click', "#pagination li a", function (event) {
        var page_url = $(this).attr('href');
        pegawaiList(page_url);
        event.preventDefault();




    });

    $(document).on('keyup', '#searchPegawai', function () {
        let search_key = $(this).val();
        let search_temp = search_key.split(' ').join('%20');

        console.log(search_temp);

        var page_url = base_url + 'pegawai/search/' + search_temp;
        if (search_temp == '') {
            pegawaiList();
        } else {
            pegawaiList(page_url);
        }
    });

    //load data pegawai
    function pegawaiList(page_url = false) {

        var base_url2 = base_url + 'pegawai/list_pegawai';
        if (page_url == false) {
            var page_url = base_url2;
        }

        $.ajax({
            type: "POST",
            url: page_url,
            beforeSend: function () {
                //do something
            },
            success: function (response) {

                $("#list_pegawai").html(response);

            }
        });
    }

    //lihat detail pegawai
    $(document).on('click', '#btnLihatPegawai', function (e) {
        e.preventDefault();

        let nip = $(this).data("nip");
        $.ajax({
            type: "POST",
            url: base_url + 'pegawai/detail/' + nip

        })
            .done(function (data) {
                $('#wadahModalDetailPegawai').html(data);
                $('#modal-detail-pegawai').modal('show');
            });
    });

    //delete data pegawai
    $(document).on('click', '#btnDeletePegawai', function (e) {
        e.preventDefault();

        let nip = $(this).data('nip');

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
                    url: base_url + 'pegawai/destroy/' + nip,
                    method: "POST",
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            pegawaiList()
                            tata.success('Success', 'Data Berhasil Dihapus!');
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }
                    }
                });
            }
        })
    });

    //update data pegawai
    $(document).on('submit', '#formEditPegawai', function (e) {
        e.preventDefault();

        let data = $(this).serialize();

        $.ajax({
            url: base_url + 'pegawai/update',
            method: "POST",
            data: data,
            success: function (data) {
                let data_response = JSON.parse(data);
                if (data_response.statusCode == 400) {
                    if (data_response.error == true) {
                        if (data_response.nama_error != '') {
                            $('#nama_error').html(data_response.nama_error);
                            $('#nama_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#nama_error').html('');
                            $('#nama_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.email_error != '') {
                            $('#email_error').html(data_response.email_error);
                            $('#email_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#email_error').html('');
                            $('#email_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tempat_lahir_error != '') {
                            $('#tempat_lahir_error').html(data_response.tempat_lahir_error);
                            $('#tempat_lahir_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tempat_lahir_error').html('');
                            $('#tempat_lahir_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.tgl_lahir_error != '') {
                            $('#tgl_lahir_error').html(data_response.tgl_lahir_error);
                            $('#tgl_lahir_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tgl_lahir_error').html('');
                            $('#tgl_lahir_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.nohp_error != '') {
                            $('#nohp_error').html(data_response.nohp_error);
                            $('#nohp_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#nohp_error').html('');
                            $('#nohp_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.jenis_kelamin_error != '') {
                            $('#jenis_kelamin_error').html(data_response.jenis_kelamin_error);

                        } else {
                            $('#jenis_kelamin_error').html('');

                        }

                        if (data_response.agama_error != '') {
                            $('#agama_error').html(data_response.agama_error);

                        } else {
                            $('#agama_error').html('');

                        }
                        if (data_response.status_error != '') {
                            $('#status_error').html(data_response.status_error);
                        } else {
                            $('#status_error').html('');
                        }

                        if (data_response.pendidikan_error != '') {
                            $('#pendidikan_error').html(data_response.pendidikan_error);
                        } else {
                            $('#pendidikan_error').html('');
                        }

                        if (data_response.status_pegawai_error != '') {
                            $('#status_pegawai_error').html(data_response.status_pegawai_error);
                        } else {
                            $('#status_pegawai_error').html('');
                        }

                        if (data_response.alamat_error != '') {
                            $('#alamat_error').html(data_response.alamat_error);
                        } else {
                            $('#alamat_error').html('');
                        }

                        if (data_response.tgl_masuk_error != '') {
                            $('#tgl_masuk_error').html(data_response.tgl_masuk_error);
                            $('#tgl_masuk_pegawai').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#tgl_masuk_error').html('');
                            $('#tgl_masuk_pegawai').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (data_response.id_divisi_error != '') {
                            $('#id_divisi_error').html(data_response.id_divisi_error);
                        } else {
                            $('#id_divisi_error').html('');
                        }

                        if (data_response.id_jabatan_error != '') {
                            $('#id_jabatan_error').html(data_response.id_jabatan_error);
                        } else {
                            $('#id_jabatan_error').html('');
                        }

                        if (data_response.id_level_error != '') {
                            $('#id_level_error').html(data_response.id_level_error);
                        } else {
                            $('#id_level_error').html('');
                        }

                        if (data_response.id_lokasi_error != '') {
                            $('#id_lokasi_error').html(data_response.id_lokasi_error);
                        } else {
                            $('#id_lokasi_error').html('');
                        }

                        window.location.href = '#page-top';
                    }
                } else {
                    if (data_response.statusCode == 200) {

                        window.location.href = base_url + 'pegawai#successEdit';


                    }

                }
            }
        });
    });

    //ajukan cuti

    //show modal ajukan cuti
    $(document).on('click', '#btnAjukanCuti', function (e) {
        e.preventDefault();


        let nip = $(this).data("nip");
        $.ajax({
            type: "POST",
            url: base_url + 'cuti/checkCutiPerDay/' + nip
        })
            .done(function (data) {
                var data = JSON.parse(data);

                if (data.statusCode != 200) {
                    showModalAddCuti();
                } else {
                    tata.warn('Warning', data.message);
                }
            });





    });

    function showModalAddCuti() {
        $.ajax({
            type: "POST",
            url: base_url + 'cuti/showFormCuti'

        })
            .done(function (response) {
                $('#wadahModalAjukanCuti').html(response);
                $('#modal-add-cuti').modal('show');

                $('#tgl_cuti').datepicker({
                    format: 'yyyy-mm-dd',
                    todayBtn: 'linked',
                    todayHighlight: true,
                    autoclose: true,
                });

                $('.select2-tugas').select2({
                    placeholder: "Pilih Pegawai",
                    allowClear: true
                });
            });
    }

    $(document).on('submit', '#formAjukanCuti', function (e) {
        e.preventDefault();
        let data = $(this).serialize();

        $.ajax({
            url: base_url + 'cuti/insert',
            method: "POST",
            data: data,
            beforeSend: function (data) {

                console.log(data);
                Swal.fire({
                    html: '<div id="anim2" class="mx-auto mt-3" style="width: 100px;"></div><div class="text-center mt-3"><p><strong>Harap Tunggu...</strong></p></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }

                });

                bodymovin.loadAnimation({
                    container: document.getElementById('anim2'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: './assets/anim/settings.json'
                });
            },
            success: function (data) {
                let data_response = JSON.parse(data);

                if (data_response.statusCode == 400) {
                    if (data_response.error == true) {


                        if (data_response.jenis_cuti_error != '') {
                            $('#jenis_cuti_error').html(data_response.jenis_cuti_error);

                        } else {
                            $('#jenis_cuti_error').html('');
                        }

                        if (data_response.lama_cuti_error != '') {
                            $('#lama_cuti_error').html(data_response.lama_cuti_error);

                        } else {
                            $('#lama_cuti_error').html('');
                        }

                        if (data_response.tgl_cuti_error != '') {
                            $('#tgl_cuti_error').html(data_response.tgl_cuti_error);

                        } else {
                            $('#tgl_cuti_error').html('');
                        }

                        if (data_response.alasan_cuti_error != '') {
                            $('#alasan_cuti_error').html(data_response.alasan_cuti_error);

                        } else {
                            $('#alasan_cuti_error').html('');
                        }

                        if (data_response.alamat_cuti_error != '') {
                            $('#alamat_cuti_error').html(data_response.alamat_cuti_error);

                        } else {
                            $('#alamat_cuti_error').html('');
                        }

                        if (data_response.nip_pengganti_error != '') {
                            $('#nip_pengganti_error').html(data_response.nip_pengganti_error);

                        } else {
                            $('#nip_pengganti_error').html('');
                        }


                        Swal.close();

                        //window.location.href = '#page-top';
                    }
                } else {

                    console.log('berhasil');
                    $('#modal-add-cuti').modal('hide');
                    Swal.close();
                    tata.success('Success', 'Pengajuan Cuti berhasil dilakukan, harap tunggu konfirmasi HRD');
                    //window.location.href = base_url + 'dashboard#success';




                }
            }
        });
    });

    $(document).on('click', '#tes', function (e) {
        e.preventDefault();

        Swal.fire({
            html: '<div id="anim2" class="mx-auto mt-3" style="width: 100px;"></div><div class="text-center mt-3"><p><strong>Harap Tunggu...</strong></p></div>',
            showConfirmButton: false,
            allowOutsideClick: false,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }

        });

        bodymovin.loadAnimation({
            container: document.getElementById('anim2'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: './assets/anim/settings.json'
        });
    });


    //show data cuti
    loadTableCuti('cuti/loadTable');
    function loadTableCuti(url2) {
        $.ajax({
            type: "POST",
            url: base_url + url2,
            success: function (response) {
                $('.list-data-cuti').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }

    $(document).on('click', '#btnLihatCuti', function () {
        let id = $(this).data("id");

        $.ajax({
            type: "POST",
            url: base_url + 'cuti/detail/' + id

        })
            .done(function (data) {
                $('#wadahModalDetailCuti').html(data);
                $('#modal-detail-cuti').modal('show');
            });
    });

    $(document).on('click', '#btnTerimaCuti', function () {
        let id = $(this).data("id");
        let status = $(this).data("status");
        let nama = $(this).data("nama");
        let email = $(this).data("email");
        let lama_cuti = $(this).data("lamacuti");
        let jatah_cuti = $(this).data("jatahcuti");
        let nip = $(this).data("nip");
        let jenis_cuti = $(this).data("jeniscuti");
        let jenis_cuti_temp = jenis_cuti.split(' ').join('%20');
        let nama_temp = nama.split(' ').join('%20');

        console.log(nama_temp);


        Swal.fire({
            title: 'Anda Yakin Ingin Menerima Ajuan Cuti ini?',
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
                    url: base_url + 'cuti/update_status_cuti/' + id + '/' + status + '/' + nama_temp + '/' + email + '/' + jenis_cuti_temp + '/' + lama_cuti + '/' + jatah_cuti + '/' + nip,
                    method: "POST",
                    beforeSend: function () {
                        Swal.fire({
                            html: '<div id="anim2" class="mx-auto mt-3" style="width: 100px;"></div><div class="text-center mt-3"><p><strong>Harap Tunggu...</strong></p></div>',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }

                        });

                        bodymovin.loadAnimation({
                            container: document.getElementById('anim2'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: './assets/anim/settings.json'
                        });
                    },
                    success: function () {
                        $('#modal-detail-cuti').modal('hide');
                        loadTableCuti('cuti/loadTable');
                        Swal.close();
                        tata.success("Success!", "Cuti telah " + status);

                    }
                });
            }
        })


    });

    $(document).on('click', '#btnTolakCuti', function () {
        let id = $(this).data("id");
        let status = $(this).data("status");
        let nama = $(this).data("nama");
        let email = $(this).data("email");

        let nama_temp = nama.split(' ').join('%20');

        Swal.fire({
            title: 'Anda Yakin Ingin Menolak Ajuan Cuti ini?',
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
                    url: base_url + 'cuti/update_status_cuti/' + id + '/' + status + '/' + nama_temp + '/' + email,
                    method: "POST",
                    beforeSend: function () {
                        Swal.fire({
                            html: '<div id="anim2" class="mx-auto mt-3" style="width: 100px;"></div><div class="text-center mt-3"><p><strong>Harap Tunggu...</strong></p></div>',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }

                        });

                        bodymovin.loadAnimation({
                            container: document.getElementById('anim2'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: './assets/anim/settings.json'
                        });
                    },
                    success: function () {
                        $('#modal-detail-cuti').modal('hide');
                        loadTableCuti('cuti/loadTable');
                        Swal.close();
                        tata.error("Success!", "Cuti telah " + status);

                    }
                });
            }
        })


    });



    //showFormPotongCuti
    showFormPotongCuti();
    function showFormPotongCuti() {
        $.ajax({
            type: "POST",
            url: base_url + 'cuti/showFormPotongCuti',
            beforeSend: function () {
                bodymovin.loadAnimation({
                    container: document.getElementById('anim3'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: './assets/anim/settings.json'
                });
            },
            success: function (response) {
                $('.wadahFormPotongCuti').html(response);
                $('#nip_pegawai_potong_cuti').select2({
                    placeholder: "- Pilih Pegawai -",
                    allowClear: true
                });


                $('#jatah_cuti').TouchSpin({
                    min: 1,
                    max: 12,
                    boostat: 5,
                    maxboostedstep: 10,
                    initval: 1,
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',
                });

                $('#anim3').hide();
                $('#textAnim3').hide();
            }
        });
    }

    $(document).on('change', '#nip_pegawai_potong_cuti', function () {
        let jatah_cuti = $('#nip_pegawai_potong_cuti option:selected').data("cuti");

        $('#jatah_cuti_from_db').val(jatah_cuti);
    });

    //potong cuti
    $(document).on('submit', '#formPotongCuti', function (e) {

        e.preventDefault();

        //get value from form
        let nip_pegawai = $('#nip_pegawai_potong_cuti').val();
        let jatah_cuti = $('#jatah_cuti').val();
        let jatah_cuti_from_db = $('#jatah_cuti_from_db').val();

        //do ajax
        $.ajax({
            url: base_url + 'cuti/potong_jatah_cuti_pegawai',
            method: "POST",
            data: { nip_pegawai: nip_pegawai, jatah_cuti: jatah_cuti, jatah_cuti_from_db: jatah_cuti_from_db },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {


                    //$('#formPotongCuti')[0].reset();
                    $('#nip_pegawai_potong_cuti').select2({
                        placeholder: "- Pilih Pegawai -",
                        allowClear: true
                    });
                    $('#nip_pegawai_error').html('');
                    tata.success('Success', 'Data Berhasil Ditambahkan!');
                    showFormPotongCuti();

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        console.log(data.nip_pegawai_error);
                        if (data.nip_pegawai_error != '') {
                            $('#nip_pegawai_error').html(data.nip_pegawai_error);


                        }

                        if (data.jatah_cuti_error != '') {
                            $('#jatah_cuti_error').html(data.jatah_cuti_error);


                        }
                    }
                }
            }
        });

    });

    loadTableLokasi('lokasi/loadTable');
    function loadTableLokasi(url2) {
        $.ajax({
            type: "POST",
            url: base_url + url2,
            success: function (response) {
                $('.list-data-lokasi').html(response);
                $('#dataTableHover').DataTable();
            }
        });
    }


    //show modal add lokasi
    $(document).on('click', '#btnTambahLokasi', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'lokasi/showForm'

        })
            .done(function (data) {
                $('#wadahModalTambahLokasi').html(data);
                $('#modal-add-lokasi').modal('show');
            });
    });


    //add data lokasi
    $(document).on('submit', '#formTambahLokasi', function (e) {

        e.preventDefault();

        //get value from form
        let nama_lokasi = $('#nama_lokasi').val();
        let alamat = $('#alamat').val();

        //do ajax
        $.ajax({
            url: base_url + 'lokasi/insert',
            method: "POST",
            data: { nama_lokasi: nama_lokasi, alamat: alamat },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {

                    loadTableLokasi('lokasi/loadTable');
                    $('#formTambahLokasi')[0].reset();
                    tata.success('Success', 'Data Berhasil Ditambahkan!');
                    $('#nama_lokasi_error').html('');
                    $('#alamat_error').html('');
                    $('#nama_lokasi').removeClass('is-invalid');

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        console.log(data.nama_lokasi_error);
                        if (data.nama_lokasi_error != '') {
                            $('#nama_lokasi_error').html(data.nama_lokasi_error);
                            $('#nama_lokasi').removeClass('is-valid').addClass('is-invalid');

                        }

                        if (data.alamat_error != '') {
                            $('#alamat_error').html(data.alamat_error);


                        }
                    }
                }
            }
        });

    });

    //show modal edit lokasi
    $(document).on('click', '#btnEditLokasi', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: base_url + 'lokasi/showFormEdit/' + id

        })
            .done(function (data) {
                $('#wadahModalEditLokasi').html(data);
                $('#modal-edit-lokasi').modal('show');
            });
    });

    //update data lokasi
    $(document).on('submit', '#formEditLokasi', function (e) {

        e.preventDefault();

        //get value from form
        let id = $('#id_lokasi').val();
        let nama_lokasi_edit = $('#nama_lokasi_edit').val();
        let alamat_edit = $('#alamat_edit').val();

        //do ajax
        $.ajax({
            url: base_url + 'lokasi/update',
            method: "POST",
            data: { id: id, nama_lokasi: nama_lokasi_edit, alamat: alamat_edit },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {
                    loadTableLokasi('lokasi/loadTable');

                    $('#modal-edit-lokasi').modal('hide');
                    tata.success('Success', 'Data Berhasil Dirubah!');

                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        if (data.nama_lokasi_error != '') {
                            $('#nama_lokasi_error').html(data.nama_lokasi_error);
                            $('#nama_lokasi_edit').removeClass('is-valid').addClass('is-invalid');

                        }


                        if (data.alamat_error != '') {
                            $('#alamat_error').html(data.alamat_error);


                        }
                    }
                }
            }
        });
    });

    //delete data lokasi
    $(document).on('click', '#btnDeleteLokasi', function (e) {
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
                    url: base_url + 'lokasi/destroy/' + id,
                    method: "POST",
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            loadTableLokasi('lokasi/loadTable');
                            tata.success('Success', 'Data Berhasil Dihapus!');
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }
                    }
                });
            }
        })

    });

    //show riwayat cuti
    $(document).on('click', '#btnRiwayatCuti', function (e) {
        e.preventDefault();
        let nip = $(this).data("nip");
        $.ajax({
            type: "POST",
            url: base_url + 'cuti/history_cuti/' + nip,
            beforeSend: function () {
                $('.loadBtn').show();
            }

        })
            .done(function (data) {
                $('#wadahModalRiwayatCuti').html(data);
                $('#modal-history-cuti').modal('show');
                bodymovin.loadAnimation({
                    container: document.getElementById('anim4'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: './assets/anim/settings.json'
                });
                //$('#dataTableHover').DataTable();
                loadTableRiwayatCuti('cuti/loadTableModal', nip);
                $('.loadBtn').hide();
            });
    });

    //load data riwayat cuti
    function loadTableRiwayatCuti(url2, nip, status = '') {

        if (!status) {
            $.ajax({
                type: "POST",
                url: base_url + url2 + '/' + nip,
                success: function (response) {
                    $('.list-history-cuti').html(response);
                    $('#dataTableHover').DataTable();
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: base_url + url2 + '/' + nip + '/' + status,
                success: function (response) {
                    $('.list-history-cuti').html(response);
                    $('#dataTableHover').DataTable();
                }
            });
        }

    }

    //filter riwayat cuti
    //pending
    $(document).on('click', '#btnFilterPending', function (e) {
        e.preventDefault();
        let nip = $(this).data("nip");
        loadTableRiwayatCuti('cuti/loadTableModal', nip, 'pending')
    });

    //diterima
    $(document).on('click', '#btnFilterDiterima', function (e) {
        e.preventDefault();
        let nip = $(this).data("nip");
        loadTableRiwayatCuti('cuti/loadTableModal', nip, 'diterima')
    });

    //ditolak
    $(document).on('click', '#btnFilterDitolak', function (e) {
        e.preventDefault();
        let nip = $(this).data("nip");
        loadTableRiwayatCuti('cuti/loadTableModal', nip, 'ditolak')
    });


    //show edit profile modal
    $(document).on('click', '#btnEditProfile', function (e) {
        e.preventDefault();
        let nip = $(this).data("nip");
        $.ajax({
            type: "POST",
            url: base_url + 'profile/edit/' + nip,
            // beforeSend: function () {
            //     $('.loadBtn').show();
            // }

        })
            .done(function (data) {
                $('#wadahModalEditProfile').html(data);
                $('#modal-edit-profile').modal('show');
                //$('#dataTableHover').DataTable();


            });
    });

    $(document).on('submit', '#formEditProfile', function (e) {

        e.preventDefault();

        //get value from form
        let nama = $('#nama_edit_profile').val();
        let password = $('#password_edit_profile').val();
        let confirm_password = $('#confirm_password_edit_profile').val();

        //do ajax
        $.ajax({
            url: base_url + 'profile/update',
            method: "POST",
            data: { nama: nama, password: password, confirm_password: confirm_password },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.statusCode == 200) {

                    //$('#formEditProfile')[0].reset();
                    tata.success('Success', 'Data Profile Berhasil Dirubah!');
                    $('#modal-edit-profile').modal('hide');

                    $('#nama_profile_pegawai').text(nama);
                    $('#nama_profile_pegawai_2').text(nama);
                } else if (data.statusCode == 201) {
                    //do something
                } else {
                    //if form validation is false
                    if (data.error == true) {
                        console.log(data.nama_error);
                        if (data.nama_error != '') {
                            $('#nama_error').html(data.nama_error);
                            $('#nama_edit_profile').removeClass('is-valid').addClass('is-invalid');

                        }


                        console.log(data.confirm_password_error);
                        if (data.confirm_password_error != '') {
                            $('#confirm_password_error').html(data.confirm_password_error);
                        } else {
                            $('#confirm_password_error').html('');

                        }
                    }
                }
            }
        });

    });


    //pegawai out
    //show modal pegawai out
    $(document).on('click', '#btnOutPegawai', function (e) {
        e.preventDefault();

        let nip = $(this).data("nip");
        $.ajax({
            type: "POST",
            url: base_url + 'pegawai/showModalToPegawaiOut/' + nip,
            success: function (response) {
                $('#wadahModalPegawaiOut').html(response);
                $('#modal-to-pegawai-out').modal('show');
                $('.keterangan').hide();
            }
        });
    });

    $(document).on('change', '#status_out', function () {
        let val = $('#status_out option:selected').val();

        if (val == "Lainnya") {
            $('.keterangan').show(500);
            $('#keterangan').val("");
        } else {
            $('.keterangan').hide(500);
            $('#keterangan').val("");
        }
    });

    $(document).on('submit', '#formPegawaiOut', function (e) {
        e.preventDefault();
        let data = $(this).serialize();
        let nip = $('#nip_pegawai').val();
        $.ajax({
            url: base_url + 'pegawai/moveToPegawaiOut/' + nip,
            method: "POST",
            data: data,
            success: function (data) {
                var data = JSON.parse(data);

                if (data.statusCode == 200) {
                    tata.success("Success!", "Pegawai berhasil dikeluarkan!");
                    $('#modal-to-pegawai-out').modal('hide');
                    pegawaiList();
                } else {
                    tata.error('Error!', 'Oops! Terjadi suatu Kesalahan!');
                    $('#modal-to-pegawai-out').modal('hide');
                }
            }
        });
    });

    //show list pegawai out
    pegawaiOutList();


    //pagination pegawai out
    $(document).on('click', "#pagination_out li a", function (event) {
        var page_url = $(this).attr('href');
        pegawaiOutList(page_url);
        event.preventDefault();




    });

    //search pegawai out
    $(document).on('keyup', '#searchPegawaiOut', function () {
        let search_key = $(this).val();
        let search_temp = search_key.split(' ').join('%20');

        console.log(search_temp);

        var page_url = base_url + 'pegawai/search_out/' + search_temp;
        if (search_temp == '') {
            pegawaiOutList();
        } else {
            pegawaiOutList(page_url);
        }
    });

    //load data pegawai
    function pegawaiOutList(page_url = false) {

        var base_url2 = base_url + 'pegawai/list_pegawai_out';
        if (page_url == false) {
            var page_url = base_url2;
        }

        $.ajax({
            type: "POST",
            url: page_url,
            beforeSend: function () {
                //do something
            },
            success: function (response) {

                $("#list_pegawai_out").html(response);

            }
        });
    }


    $(document).on('click', '#btnMasukkanPegawai', function (e) {
        e.preventDefault();

        let nip = $(this).data("nip");

        Swal.fire({
            title: 'Anda Yakin Ingin Memasukkan Kembali Pegawai ini?',
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
                    url: base_url + 'pegawai/masukPegawai/' + nip,
                    method: "POST",
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                           
                            tata.success('Success', 'Pegawai Berhasil dimasukkan Kembali!');
                            pegawaiOutList();
                        } else {
                            tata.error('Error', 'Oops! Terjadi Kesalahan!');
                        }
                    }
                });
            }
        })
    });





});