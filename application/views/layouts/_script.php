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

            tata.info('Notifikasi!', nama_pegawai + ' ingin mengajukan cuti', {
                position: 'br',
                duration: 5000,
                animate: 'slide',
                onClick: function() {
                    window.location.href = base_url_pusher + 'cuti';
                }
            });
            notifSound();

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
</script>