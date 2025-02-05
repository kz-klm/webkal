<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM wali_murid WHERE id_wali = $id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wali = $_POST['nama_wali'];
    $no_telp = $_POST['no_telp'];
    $update_query = "UPDATE wali_murid SET nama_wali = '$nama_wali', no_telp = '$no_telp' WHERE id_wali = $id";
    
    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Wali Murid berhasil diperbarui!'); window.location.href='wali_murid.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui Wali Murid!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Wali Murid</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Wali</label>
                <input type="text" name="nama_wali" class="form-control" value="<?php echo $row['nama_wali']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" value="<?php echo $row['no_telp']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="wali_murid.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
