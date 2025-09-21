<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #f7f7f7, #eaeaea);
      margin: 0;
      padding: 0;
    }
    .dashboard-container {
      text-align: center;
      padding: 50px 20px;
    }
    h1 {
      color: #103f66;
      margin-bottom: 50px;
    }
    .menu-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 40px;
    }
    .menu-item {
      width: 150px;
      text-align: center;
    }
    .menu-item img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #ccc;
    }
    .menu-item p {
      margin-top: 10px;
      font-size: 18px;
      font-weight: bold;
      color: #123d66;
    }
  </style>
</head>
<body>
    <h2 style="text-align: center;">DASHBOARD</h2>
      <div class="menu-container">
      <div class="menu-item">
        <a href="dataDiri.php"><img src="photo/diri.png" alt="Data Diri"></a>
        <p>Data Diri</p>
      </div>
      <div class="menu-item">
        <a href="dataKeluarga.php"><img src="photo/keluarga.png" alt="Data Keluarga"></a>
        <p>Data Keluarga</p>
      </div>
      <div class="menu-item">
       <a href="dataSekolah.php"> <img src="photo/sekolah.png" alt="Data Sekolah"></a>
        <p>Data Sekolah</p>
      </div>
      <div class="menu-item">
        <a href="uploadData.php"><img src="photo/upload.png" alt="Upload Data"></a>
        <p>Upload Data</p>
      </div>
    </div>
  </div>
</body>
</html>