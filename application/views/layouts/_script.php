<script src="<?= base_url("assets/") ?>vendor/jquery/jquery.min.js"></script>
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
<script src="<?= base_url("assets/") ?>js/demo/chart-area-demo.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url("assets/") ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets/") ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url("assets/") ?>js/tata/tata.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url("assets/") ?>js/myapp.js"></script>
<script>
    var animation = bodymovin.loadAnimation({
        container: document.getElementById('anim'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: './assets/anim/grape/Animation05/drawkit-grape-animation-5-LOOP.json'
    });
</script>

<script>
    const role = $('body').data('role');
    const base_url_pusher = 'http://localhost/soraya_employee/';


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
            notifSound();
            tata.info('Notifikasi!', nama_pegawai + ' ingin mengajukan cuti', {
                position: 'br',
                duration: 5000,
                animate: 'slide',
                onClick: function() {
                    window.location.href = base_url_pusher + 'cuti';
                }
            });

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
</script>