<?php
include 'koneksi.php';

// Periksa apakah parameter ID telah diterima
if (isset($_GET['id'])) {
    $id_siswa = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query untuk menghapus siswa
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='index.php';</script>";
}
?>