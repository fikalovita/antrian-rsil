<?php
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    // panggil file "database.php" untuk koneksi ke database
    require_once "../../config/database.php";

    // ambil tanggal sekarang
    $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

    // sql statement untuk menampilkan data dari tabel "tbl_antrian" berdasarkan "tanggal"
    $query = mysqli_query($mysqli, "SELECT ROW_NUMBER() OVER (ORDER BY resep_obat.`no_resep`) AS no_urut, pasien.nm_pasien,resep_obat.`no_resep`, resep_obat.`no_rawat`,
    IF(resep_obat.jam='00:00:00','',resep_obat.jam) AS jam_validasi,dokter.nm_dokter,poliklinik.`nm_poli`
    FROM resep_obat INNER JOIN reg_periksa ON resep_obat.no_rawat=reg_periksa.no_rawat 
    INNER JOIN pasien ON reg_periksa.no_rkm_medis=pasien.no_rkm_medis 
    INNER JOIN dokter ON resep_obat.kd_dokter=dokter.kd_dokter
    INNER JOIN poliklinik ON reg_periksa.`kd_poli` = poliklinik.`kd_poli`
    WHERE resep_obat.status='ralan'
    AND LEFT (resep_obat.`no_resep`, 8)= '" . date('Y' . 'm' . 'd') . "' ORDER BY resep_obat.`no_resep` DESC")
        or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika data ada
    if ($rows <> 0) {
        $response         = array();
        $response["data"] = array();

        // ambil data hasil query
        while ($row = mysqli_fetch_assoc($query)) {

            $data['nm_pasien'] = $row["nm_pasien"];
            $data['nm_dokter']         = $row["nm_dokter"];
            $data['no_urut']     = $row["no_urut"];

            array_push($response["data"], $data);
        }

        // tampilkan data
        echo json_encode($response);
    }
    // jika data tidak ada
    else {
        $response         = array();
        $response["data"] = array();

        // buat data kosong untuk ditampilkan
        $data['nm_dokter']         = "";
        $data['nm_pasien'] = "-";
        $data['status']     = "";

        array_push($response["data"], $data);

        // tampilkan data
        echo json_encode($response);
    }
}
