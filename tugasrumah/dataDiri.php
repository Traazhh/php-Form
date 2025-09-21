<?php
// koneksi.php (bisa juga dipisah jadi file sendiri untuk reuse)
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
    $nis             = $_POST['nis'];
    $nisn            = $_POST['nisn'];
    $nama_lengkap    = $_POST['nama_lengkap'];
    $nama_panggilan  = $_POST['nama_panggilan'];
    $hobby           = $_POST['hobby'];
    $agama           = $_POST['agama'];
    $makanan         = $_POST['makanan'];
    $alamat          = $_POST['alamat'];
    $deskripsi       = $_POST['deskripsi'];

    $query = "INSERT INTO data_diri 
        (nis, nisn, nama_lengkap, nama_panggilan, hobby, agama, makanan_favorit, alamat_lengkap, deskripsi)
        VALUES 
        ('$nis', '$nisn', '$nama_lengkap', '$nama_panggilan', '$hobby', '$agama', '$makanan', '$alamat', '$deskripsi')";

    if (mysqli_query($conn, $query)) {
        header("Location: hasil.php?form=diri");
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
    <title>Form Data Diri</title>
</head>
<body>
    <h2>Form Data Diri</h2>
    <form method="POST" action="">
        NIS: <input type="text" name="nis"><br>
        NISN: <input type="text" name="nisn"><br>
        Nama Lengkap: <input type="text" name="nama_lengkap"><br>
        Nama Panggilan: <input type="text" name="nama_panggilan"><br>
        Hobby: <input type="text" name="hobby"><br>
        Agama: <input type="text" name="agama"><br>
        Makanan Favorit: <input type="text" name="makanan"><br>
        Alamat Lengkap: <textarea name="alamat"></textarea><br>
        Deskripsi: <textarea name="deskripsi"></textarea><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
