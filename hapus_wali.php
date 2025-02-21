<?php
include 'koneksi.php';

// Periksa apakah parameter ID telah diterima
if (isset($_GET['id'])) {
    $id_wali = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query untuk menghapus wali murid
    $query = "DELETE FROM wali_murid WHERE id_wali = '$id_wali'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data wali murid berhasil dihapus!'); window.location='wali.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='wali.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='wali.php';</script>";
}
?>