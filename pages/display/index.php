<!-- Aplikasi Antrian Berbasis Web 
******************************************
* Developer   : Indra Styawantoro
* Company     : Pustaka Koding
* Release     : Agustus 2021
* Update      : -
* Website     : pustakakoding.com
* E-mail      : pustaka.koding@gmail.com
* WhatsApp    : +62-813-7778-3334
-->

<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Antrian Berbasis Web">
    <meta name="author" content="Indra Styawantoro">

    <!-- Title -->
    <title>Aplikasi Antrian Berbasis Web</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="navbar navbar-light mb-5" style="background-color: #00aa9d;">
            <div class="container-fluid">
                <h1 style="color: white"><b>ANTRIAN LOKET PENDAFTARAN </b></h1>
                <h3 style="color: white"><b><?= date('d-M-Y'); ?></b></h3>
                <h3 style="color: white" id="clock" class="text-end"></h3>
                <!-- <p>Tanggal/Waktu: <span id="jam"></span><span id="menit">:</span><span id="detik"></span></p> -->
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-7">
                        <iframe width="100%" height="850" src="https://www.youtube.com/embed/-geh3qg9_Bc?si=2jV52CK0zNVloW4e" title="Edukasi GERMAS (Bahasa Indonesia)" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share;" allowfullscreen></iframe>
                        <!-- <video width="100%" src="../../assets/video.mp4" type="video/mp4" autoplay="autoplay" loop="loop"> -->
                        <!-- <video width="100%" autoplay="autoplay" loop="loop" muted="muted">
                            <source src="../../assets/video.mp4" type="video/mp4">
                        </video> -->
                    </div>
                    <div class="col-md-5">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center d-grid p-3">
                                <div class="border border-success rounded-2 py-2 mb-5">
                                    <h2 class="pt-4"><b style="font-size:" 150px;>LOKET 1</b></h2>
                                    <!-- menampilkan informasi jumlah antrian -->
                                    <h1 id="antrian-sekarang" class="display-1 fw-bold text-success text-center lh-1 pb-2" style="font-size: 150px;"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center d-grid p-3">
                                    <div class="border border-success rounded-2 py-2 mb-3">
                                        <h2 class="pt-4"> <b>JUMLAH ANTRIAN LOKET 1</b> </h2>
                                        <!-- menampilkan informasi jumlah antrian -->
                                        <h1 id="jumlah-antrian" class="display-1 fw-bold text-success text-center lh-1 pb-2" style="font-size: 150px;"></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="footer mt-auto" style="background-color: #00aa9d;">
        <div class="container-fluid">
            <!-- copyright -->
            <marquee behavior="" direction="">
                <h1 style="color: white; font-size: 25px;"><b>RUMAH SAKIT ISLAM LUMAJANG | LEBIH BAIK RAMAH DAN PEDULI</b></h1>
            </marquee>
        </div>
    </footer>
    <!-- jQuery Core -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="../../assets/bootstrap/css/bootstrap.min.css/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        setInterval(function() {
            $('#antrian-sekarang').load('../panggilan/get_antrian_sekarang.php');
            $('#jumlah-antrian').load('../panggilan/get_jumlah_antrian.php');
        }, 1000);
    </script>


    <script>
        function showTime() {
            var a_p = "";
            var today = new Date();
            var curr_hour = today.getHours();
            var curr_minute = today.getMinutes();
            var curr_second = today.getSeconds();
            if (curr_hour < 12) {
                a_p = "AM";
            } else {
                a_p = "PM";
            }
            if (curr_hour == 0) {
                curr_hour = 12;
            }
            if (curr_hour > 12) {
                curr_hour = curr_hour - 12;
            }
            curr_hour = checkTime(curr_hour);
            curr_minute = checkTime(curr_minute);
            curr_second = checkTime(curr_second);
            document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        setInterval(showTime, 500);
    </script>
    <script type='text/javascript'>
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var thisDay = date.getDay(),
            thisDay = myDays[thisDay];
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
    </script>
</body>

</html>