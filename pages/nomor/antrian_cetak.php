<!DOCTYPE html>
<html lang="en">
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
<body>
    <style>
        .tiket {
            font-family: sans-serif;
        }

        .notiket {

            font-size: 80px;
        }
    </style>
<?php
    require_once "../../config/database.php";
    $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);
    $query = mysqli_query($mysqli, "SELECT count(id) as jumlah FROM tbl_antrian WHERE tanggal='$tanggal'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    $data = mysqli_fetch_assoc($query);
    $jumlah_antrian = $data['jumlah'];
?>
  <div class="tiket">
    <table class="table table-bordered table-sm text-center">
        <thead>
        <tr>
            <th style="font-size: 15px">RS ISLAM LUMAJANG <br> Jln Kyai Muksin 19, Lumajang, Jawa Timur <br> 0334-887999</th>
        </tr>
        </thead>
        <tbody>
            <tr><td style="font-size: 15px"><b>BUKTI REGISTER PENDAFTARAN</b></td></tr>
            <tr>
                <td>
                    <h1>
                        <b class="notiket"><?=$jumlah_antrian?></b>
                    </h1>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr><td style="font-size: 15px">
                <b>Terima Kasih Atas Kepercayaan Anda <br> Bawalah Kartu Berobat Setiap Berkunjung Ke Rumah Sakit</b>
            </td></tr>
        </tfoot>
        
    </table>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

<script>  
 window.print();
 setTimeout(window.close, 500);
 </script>
</body>
</html>
