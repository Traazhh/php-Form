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

$form = isset($_GET['form']) ? $_GET['form'] : 'semua';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            padding: 25px 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .note {
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 13px;
            color: #555;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        th {
            width: 220px;
            background: #f9fbfd;
            font-weight: bold;
            color: #2c3e50;
        }
        tr:nth-child(even) td {
            background: #fafafa;
        }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            margin: 8px 5px 0 0;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
        }
        .btn-pdf { background: #2980b9; }
        .btn-edit { background: #2980b9; }
        .btn-done { background: #95a5a6; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
<div class="container">

    <?php if ($form == 'diri' || $form == 'semua'): ?>
        <h2>Data Diri – Tersimpan</h2>
        <p class="note">Data berikut telah disimpan sementara di sesi Anda.</p>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM data_diri");
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <table>
            <tr><th>NIS</th><td><?= $row['nis']; ?></td></tr>
            <tr><th>NISN</th><td><?= $row['nisn']; ?></td></tr>
            <tr><th>Nama Lengkap</th><td><?= $row['nama_lengkap']; ?></td></tr>
            <tr><th>Nama Panggilan</th><td><?= $row['nama_panggilan']; ?></td></tr>
            <tr><th>Hobby</th><td><?= $row['hobby']; ?></td></tr>
            <tr><th>Agama</th><td><?= $row['agama']; ?></td></tr>
            <tr><th>Makanan Favorit</th><td><?= $row['makanan_favorit']; ?></td></tr>
            <tr><th>Alamat Lengkap</th><td><?= $row['alamat_lengkap']; ?></td></tr>
            <tr><th>Deskripsi</th><td><?= $row['deskripsi']; ?></td></tr>
        </table>
        <?php } ?>
        <a href="cetak.php?form=diri" target="_blank" class="btn btn-pdf">Cetak PDF</a>
        <a href="form_diri.php" class="btn btn-edit">Ubah Data</a>
        <a href="index.php" class="btn btn-done">Selesai</a>
    <?php endif; ?>


    <?php if ($form == 'keluarga' || $form == 'semua'): ?>
        <h2>Data Keluarga</h2>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM data_keluarga");
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <table>
            <tr><th colspan="2">Data Ayah</th></tr>
            <tr><th>NIK</th><td><?= $row['nik_ayah']; ?></td></tr>
            <tr><th>Nama</th><td><?= $row['nama_ayah']; ?></td></tr>
            <tr><th>Alamat</th><td><?= $row['alamat_ayah']; ?></td></tr>
            <tr><th>Agama</th><td><?= $row['agama_ayah']; ?></td></tr>
            <tr><th>Hobby</th><td><?= $row['hobby_ayah']; ?></td></tr>
            <tr><th>Deskripsi</th><td><?= $row['deskripsi_ayah']; ?></td></tr>

            <tr><th colspan="2">Data Ibu</th></tr>
            <tr><th>NIK</th><td><?= $row['nik_ibu']; ?></td></tr>
            <tr><th>Nama</th><td><?= $row['nama_ibu']; ?></td></tr>
            <tr><th>Alamat</th><td><?= $row['alamat_ibu']; ?></td></tr>
            <tr><th>Agama</th><td><?= $row['agama_ibu']; ?></td></tr>
            <tr><th>Hobby</th><td><?= $row['hobby_ibu']; ?></td></tr>
            <tr><th>Deskripsi</th><td><?= $row['deskripsi_ibu']; ?></td></tr>
        </table>
        <?php } ?>
        <a href="cetak.php?form=keluarga" target="_blank" class="btn btn-pdf">Cetak PDF</a>
    <?php endif; ?>


    <?php if ($form == 'sekolah' || $form == 'semua'): ?>
        <h2>Data Sekolah</h2>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM data_sekolah");
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <table>
            <tr><th>NIS</th><td><?= $row['nis']; ?></td></tr>
            <tr><th>NISN</th><td><?= $row['nisn']; ?></td></tr>
            <tr><th>Nama</th><td><?= $row['nama_lengkap']; ?></td></tr>
            <tr><th>Alamat</th><td><?= $row['alamat']; ?></td></tr>
            <tr><th>Agama</th><td><?= $row['agama']; ?></td></tr>
            <tr><th>Jurusan</th><td><?= $row['jurusan']; ?></td></tr>
            <tr><th>Sekolah</th><td><?= $row['nama_sekolah']; ?></td></tr>
            <tr><th>Hobby</th><td><?= $row['hobby']; ?></td></tr>
            <tr><th>Motto</th><td><?= $row['motto_hidup']; ?></td></tr>
            <tr><th>Cita-cita</th><td><?= $row['cita_cita']; ?></td></tr>
            <tr><th>Deskripsi</th><td><?= $row['deskripsi']; ?></td></tr>
        </table>
        <?php } ?>
        <a href="cetak.php?form=sekolah" target="_blank" class="btn btn-pdf">Cetak PDF</a>
    <?php endif; ?>


    <?php if ($form == 'upload' || $form == 'semua'): ?>
        <h2>Data Upload</h2>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM upload_data");
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <table>
            <tr><th>Foto</th><td><a href="<?= $row['foto']; ?>" target="_blank">Lihat</a></td></tr>
            <tr><th>Logo SMK</th><td><a href="<?= $row['logo_smk']; ?>" target="_blank">Lihat</a></td></tr>
            <tr><th>KTP</th><td><a href="<?= $row['ktp']; ?>" target="_blank">Lihat</a></td></tr>
            <tr><th>KK</th><td><a href="<?= $row['kk']; ?>" target="_blank">Lihat</a></td></tr>
            <tr><th>Foto Sembarang</th><td><a href="<?= $row['foto_sembarang']; ?>" target="_blank">Lihat</a></td></tr>
        </table>
        <?php } ?>
        <a href="cetak.php?form=upload" target="_blank" class="btn btn-pdf">Cetak PDF</a>
    <?php endif; ?>

</div>
</body>
</html>
