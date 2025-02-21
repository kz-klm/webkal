<?php
include 'koneksi.php';

// Ambil ID siswa dari parameter URL
$id = $_GET['id'];
$query = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali FROM siswa 
LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali 
WHERE id_siswa=$id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Ambil data kelas untuk dropdown
$query_kelas = "SELECT * FROM kelas";
$result_kelas = mysqli_query($koneksi, $query_kelas);

// Ambil data wali murid untuk dropdown
$query_wali = "SELECT * FROM wali_murid";
$result_wali = mysqli_query($koneksi, $query_wali);

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];
    
    $query = "UPDATE siswa SET 
              nis='$nis', 
              nama_siswa='$nama_siswa', 
              jenis_kelamin='$jenis_kelamin', 
              tempat_lahir='$tempat_lahir', 
              tanggal_lahir='$tanggal_lahir', 
              id_kelas='$id_kelas', 
              id_wali='$id_wali' 
              WHERE id_siswa=$id";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data siswa!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" value="<?php echo $row['nis']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_siswa" class="form-control" value="<?php echo $row['nama_siswa']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" <?php if($row['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                    <option value="P" <?php if($row['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $row['tempat_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $row['tanggal_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <?php while ($kelas = mysqli_fetch_assoc($result_kelas)) : ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>" <?php if($row['id_kelas'] == $kelas['id_kelas']) echo 'selected'; ?>>
                            <?php echo $kelas['nama_kelas']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Murid</label>
                <select name="id_wali" class="form-control" required>
                    <?php while ($wali = mysqli_fetch_assoc($result_wali)) : ?>
                        <option value="<?php echo $wali['id_wali']; ?>" <?php if($row['id_wali'] == $wali['id_wali']) echo 'selected'; ?>>
                            <?php echo $wali['nama_wali']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>