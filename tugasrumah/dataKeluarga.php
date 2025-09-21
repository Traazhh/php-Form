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
    // Data Ayah
    $nik_ayah     = $_POST['nik_ayah'];
    $nama_ayah    = $_POST['nama_ayah'];
    $alamat_ayah  = $_POST['alamat_ayah'];
    $agama_ayah   = $_POST['agama_ayah'];
    $hobby_ayah   = $_POST['hobby_ayah'];
    $deskripsi_ayah = $_POST['deskripsi_ayah'];

    // Data Ibu
    $nik_ibu      = $_POST['nik_ibu'];
    $nama_ibu     = $_POST['nama_ibu'];
    $alamat_ibu   = $_POST['alamat_ibu'];
    $agama_ibu    = $_POST['agama_ibu'];
    $hobby_ibu    = $_POST['hobby_ibu'];
    $deskripsi_ibu = $_POST['deskripsi_ibu'];

    $query = "INSERT INTO data_keluarga 
        (nik_ayah, nama_ayah, alamat_ayah, agama_ayah, hobby_ayah, deskripsi_ayah,
         nik_ibu, nama_ibu, alamat_ibu, agama_ibu, hobby_ibu, deskripsi_ibu)
        VALUES 
        ('$nik_ayah', '$nama_ayah', '$alamat_ayah', '$agama_ayah', '$hobby_ayah', '$deskripsi_ayah',
         '$nik_ibu', '$nama_ibu', '$alamat_ibu', '$agama_ibu', '$hobby_ibu', '$deskripsi_ibu')";

    if (mysqli_query($conn, $query)) {
        header("Location: hasil.php?form=keluarga");
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
    <title>Form Data Keluarga</title>
</head>
<body>
    <h2>Form Data Keluarga</h2>
    <form method="POST" action="">
        <h3>Data Ayah</h3>
        NIK Ayah: <input type="text" name="nik_ayah"><br>
        Nama Ayah: <input type="text" name="nama_ayah"><br>
        Alamat: <input type="text" name="alamat_ayah"><br>
        Agama: <input type="text" name="agama_ayah"><br>
        Hobby: <input type="text" name="hobby_ayah"><br>
        Deskripsi: <textarea name="deskripsi_ayah"></textarea><br>

        <h3>Data Ibu</h3>
        NIK Ibu: <input type="text" name="nik_ibu"><br>
        Nama Ibu: <input type="text" name="nama_ibu"><br>
        Alamat: <input type="text" name="alamat_ibu"><br>
        Agama: <input type="text" name="agama_ibu"><br>
        Hobby: <input type="text" name="hobby_ibu"><br>
        Deskripsi: <textarea name="deskripsi_ibu"></textarea><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
