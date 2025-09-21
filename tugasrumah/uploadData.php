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

$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Fungsi untuk upload file
function uploadFile($inputName) {
    global $uploadDir;
    $fileName = basename($_FILES[$inputName]["name"]);
    $targetFile = $uploadDir . time() . "_" . $fileName; // hindari duplikat nama
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile)) {
            return $targetFile;
        }
    }
    return null;
}


// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foto          = uploadFile('foto');
    $logo_smk      = uploadFile('logo_smk');
    $ktp           = uploadFile('ktp');
    $kk            = uploadFile('kk');
    $foto_random   = uploadFile('foto_random');

    if ($foto && $logo_smk && $ktp && $kk && $foto_random) {
        $query = "INSERT INTO upload_data (foto, logo_smk, ktp, kk, foto_sembarang)
                  VALUES ('$foto', '$logo_smk', '$ktp', '$kk', '$foto_random')";

        if (mysqli_query($conn, $query)) {
            header("Location: hasil.php?form=upload");
            exit();
        } else {
            echo "Error DB: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal upload satu atau lebih file. Pastikan format file jpg/jpeg/png/pdf.";
    }
}
?>

<!-- Form HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Form Upload Data</title>
</head>
<body>
    <h2>Form Upload Data</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        Upload Foto: <input type="file" name="foto" required><br>
        Upload Logo SMK: <input type="file" name="logo_smk" required><br>
        Upload KTP: <input type="file" name="ktp" required><br>
        Upload KK: <input type="file" name="kk" required><br>
        Upload Foto Sembarang: <input type="file" name="foto_random" required><br>
        <input type="submit" value="Upload dan Simpan">
    </form>
</body>
</html>
