<?php
$koneksi = mysqli_connect("localhost", "root", "", "gis");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$nama = $_GET['nama'];
$sql = "SELECT lokasi.* FROM lokasi WHERE id_kategori = (SELECT id FROM kategori WHERE nama = ?)";
$stmt = mysqli_prepare($koneksi, $sql);

// Periksa apakah prepared statement berhasil
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $nama);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($data);
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);



// $koneksi = mysqli_connect("localhost", "root", "", "sig");
// $sql = "SELECT * FROM lokasi";
// $x = mysqli_query($koneksi, $sql);
// while ($k = mysqli_fetch_assoc($x)) {
//     $data[] = $k;
// }
// echo json_encode($data);
