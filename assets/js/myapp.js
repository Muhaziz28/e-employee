const base_url = 'http://localhost/soraya_employee/';

$(document).ready(function () {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover


    $('#simple-date1 .input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
    });




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
                            $('#nama_divisi').removeClass('is-valid').addClass('is-invalid');

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

    //show modal edit divisi
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

    //delete data jaabtan
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

                        window.location.href = '#page-top';
                    }
                } else {
                    if (data_response.statusCode == 200) {
                        //show message
                        tata.success('Success', 'Data Berhasil Ditambahkan!', {
                            onClick: null
                        });

                        generatePass();

                        //duration disabled
                        $('#satuan_durasi_pegawai').prop("disabled", true);
                        $('#durasi_kerja_pegawai').prop("disabled", true);

                        //remove preview image
                        $('.img-pegawai').remove();

                        //remove value form hidden name of image
                        $('#image_pegawai').val("");
                        $('#upload_image').next('.custom-file-label').html("Choose file");

                        //reset form
                        $('#formTambahPegawai')[0].reset();

                        //page to top
                        var $anchor = $('.btnSendDataPegawai');
                        $('html, body').stop().animate({
                            scrollTop: ($($anchor.attr('data-link')).offset().top)
                        }, 1000, 'easeInOutExpo');

                    }

                }
            }
        });
    });

    function generatePass() {
        $.ajax({
            url: base_url + 'pegawai/generatorPass',
            method: "POST",

            success: function (response) {

                $('#password_pegawai').val(response);

                $('#password_generator_pegawai').val(response);

                console.log(response);
            }
        });
    }

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
                    $('.wadah-image-pegawai').html(data.show_image);
                }
            });
        });
        // alert('OK');
    });




});