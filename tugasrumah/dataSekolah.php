<?php
// koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "biodata";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis          = $_POST['nis'];
    $nisn         = $_POST['nisn'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat       = $_POST['alamat'];
    $agama        = $_POST['agama'];
    $jurusan      = $_POST['jurusan'];
    $nama_sekolah = $_POST['nama_sekolah'];
    $hobby        = $_POST['hobby'];
    $motto        = $_POST['motto'];
    $cita_cita    = $_POST['cita_cita'];
    $deskripsi    = $_POST['deskripsi'];

    $query = "INSERT INTO data_sekolah 
        (nis, nisn, nama_lengkap, alamat, agama, jurusan, nama_sekolah, hobby, motto_hidup, cita_cita, deskripsi)
        VALUES 
        ('$nis', '$nisn', '$nama_lengkap', '$alamat', '$agama', '$jurusan', '$nama_sekolah', '$hobby', '$motto', '$cita_cita', '$deskripsi')";

    if (mysqli_query($conn, $query)) {
        header("Location: hasil.php?form=sekolah");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- Form HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Form Data Sekolah</title>
</head>
<body>
    <h2>Form Data Sekolah</h2>
    <form method="POST" action="">
        NIS: <input type="text" name="nis"><br>
        NISN: <input type="text" name="nisn"><br>
        Nama Lengkap: <input type="text" name="nama_lengkap"><br>
        Alamat: <input type="text" name="alamat"><br>
        Agama: <input type="text" name="agama"><br>
        Jurusan: <input type="text" name="jurusan"><br>
        Nama Sekolah: <input type="text" name="nama_sekolah"><br>
        Hobby: <input type="text" name="hobby"><br>
        Motto Hidup: <input type="text" name="motto"><br>
        Cita-cita: <input type="text" name="cita_cita"><br>
        Deskripsi: <textarea name="deskripsi"></textarea><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
