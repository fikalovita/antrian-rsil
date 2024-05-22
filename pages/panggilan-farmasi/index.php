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

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

    <!-- Custom Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<?php
// panggil file "database.php" untuk koneksi ke database
require_once "../../config/database.php";
$tanggal = mktime(date("m"), date("d"), date("Y"));
$query = "SELECT ROW_NUMBER() OVER (ORDER BY resep_obat.`no_resep`) AS no_urut, pasien.nm_pasien,resep_obat.`no_resep`, resep_obat.`no_rawat`,
IF(resep_obat.jam='00:00:00','',resep_obat.jam) AS jam_validasi,dokter.nm_dokter,poliklinik.`nm_poli`
FROM resep_obat INNER JOIN reg_periksa ON resep_obat.no_rawat=reg_periksa.no_rawat 
INNER JOIN pasien ON reg_periksa.no_rkm_medis=pasien.no_rkm_medis 
INNER JOIN dokter ON resep_obat.kd_dokter=dokter.kd_dokter
INNER JOIN poliklinik ON reg_periksa.`kd_poli` = poliklinik.`kd_poli`
WHERE resep_obat.status='ralan'
AND LEFT (resep_obat.`no_resep`, 8)= '" . date('Y' . 'm' . 'd') . "' ORDER BY resep_obat.`no_resep` DESC";
// ambil jumlah baris data hasil query
// $rows = mysqli_num_rows($query);
$hasil = mysqli_query($mysqli, $query);
// var_dump(mysqli_fetch_array($hasil));
$rows = mysqli_num_rows($hasil);
?>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container pt-4">
            <div class="d-flex flex-column flex-md-row px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
                <!-- judul halaman -->
                <div class="d-flex align-items-center me-md-auto">
                    <i class="bi-mic-fill text-success me-3 fs-3"></i>
                    <h1 class="h5 pt-2">Panggilan Antrian Farmasi</h1>
                </div>
                <!-- breadcrumbs -->
                <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="https://pustakakoding.com/"><i class="bi-house-fill text-success"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            <li class="breadcrumb-item" aria-current="page">Antrian</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="tabel-antrian" class="table table-bordered table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-2">No.Antrian</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Nama Poli</th>
                                    <th>Panggil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($hasil)) : ?>
                                    <tr>
                                        <td class="text-center"><?= $row['no_urut'] ?></td>
                                        <td><?= $row['nm_pasien'] ?></td>
                                        <td><?= $row['nm_poli'] ?></td>
                                        <td><button class="btn btn-secondary btn-sm rounded-circle" onclick="myFunction(id = '<?= $row['no_urut'] ?>', px = '<?= strtolower($row['nm_pasien'])  ?>', poli = '<?= strtolower($row['nm_poli']) ?>')  "><i class="bi-mic-fill"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="footer mt-auto py-4">
        <div class="container">
            <hr class="my-4">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
                &copy; 2021 - <a href="https://pustakakoding.com/" target="_blank" class="text-brand text-decoration-none">Pustaka Koding</a>. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- load file audio bell antrian -->
    <!-- <audio id="tingtung" src="../../assets/audio/tingtung.mp3"></audio> -->

    <!-- jQuery Core -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <!-- Responsivevoice -->
    <!-- Get API Key -> https://responsivevoice.org/ -->
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>

    <script type="text/javascript">
        $('#tabel-antrian').DataTable({
            pageLength: 20,
            lengthMenu: [20, 25, 30, 50, 75, 100]
        });

        function myFunction(id, px, poli) {
            // let px = document.getElementById(id).value;
            setTimeout(function() {
                responsiveVoice.speak("Atas Nama " + px.replace(", tn", "").replace(", ny", "").replace(", nn", "").replace(", kh", "k h").replace(", nn", "") + ", dari " + poli.replace("poli dermatologi dan venereologi", "poli kulit dan kelamin") + ", silahkan ke loket penyerahan obat", "Indonesian Female", {
                    rate: 0.9,
                    pitch: 1,
                    volume: 1
                });

            });
            console.log(px)

        }
    </script>
</body>

</html>