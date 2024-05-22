<?php
// deklarasi parameter koneksi database
$host     = "192.168.1.35";                // server database, default “localhost” atau “127.0.0.1”
$username = "sik2023updated";                     // username database, default “root”
$password = "adminserver";                         // password database, default kosong
$database = "sik2023updated";               // memilih database yang akan digunakan

// buat koneksi database
$mysqli = mysqli_connect($host, $username, $password, $database);
// cek koneksi
// jika koneksi gagal 
if (!$mysqli) {
    // tampilkan pesan gagal koneksi
    die('Koneksi Database Gagal : ' . mysqli_connect_error());
}
