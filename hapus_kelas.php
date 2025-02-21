<?php
include 'koneksi.php';

// Periksa apakah parameter ID telah diterima
if (isset($_GET['id'])) {
    $id_kelas = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query untuk menghapus kelas
    $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data kelas berhasil dihapus!'); window.location='kelas.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='kelas.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='kelas.php';</script>";
}
?>