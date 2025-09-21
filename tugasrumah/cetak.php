<?php
require('fpdf/fpdf.php');

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

class PDF extends FPDF {
    // Page header
    function Header() {
        // Logo SMK - menggunakan file photo/Logo.png
        $logoPath = 'photo/Logo.png';
        if (file_exists($logoPath)) {
            $this->Image($logoPath, 10, 8, 25);
        }
        
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,'SMK NEGERI 9 SEMARANG',0,1,'C');
        $this->SetFont('Arial','B',14);
        $this->Cell(0,8,'PENDATAAN SISWA SMK 9 SEMARANG - DATA DIRI',0,1,'C');
        $this->SetFont('Arial','I',10);
        $this->Cell(0,6,'Dicetak pada: '.date('d/m/Y H:i:s'),0,1,'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
    }
    
    // Custom table for Data Diri exactly like the web
    function DataDiriTable($data) {
        // Header table - persis seperti di web
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(79, 129, 189); // Biru sama seperti web
        $this->SetTextColor(255);
        $this->Cell(0,10,'DATA SISWA',1,1,'C',true);
        
        // Reset text color
        $this->SetTextColor(0);
        
        // Table content - persis seperti di web
        $this->SetFont('Arial','B',12);
        $this->SetFillColor(220, 230, 241); // Abu-abu biru muda seperti web
        
        // Data rows
        $keys = array_keys($data);
        $values = array_values($data);
        
        for ($i = 0; $i < count($data); $i++) {
            // Label column
            $this->SetFont('Arial','B',12);
            $this->SetFillColor(220, 230, 241); // Warna background label
            $this->Cell(70, 10, $keys[$i], 1, 0, 'L', true);
            
            // Value column
            $this->SetFont('Arial','',12);
            $this->SetFillColor(255, 255, 255); // Background putih
            $this->Cell(0, 10, $values[$i], 1, 1, 'L', true);
        }
    }
    
    // Custom table for Data Keluarga
    function DataKeluargaTable($data) {
        // Header table
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(79, 129, 189);
        $this->SetTextColor(255);
        $this->Cell(0,10,'DATA KELUARGA',1,1,'C',true);
        
        // Reset text color
        $this->SetTextColor(0);
        
        foreach($data as $parent => $parentData) {
            // Parent header - biru lebih terang
            $this->SetFont('Arial','B',12);
            $this->SetFillColor(180, 198, 231);
            $this->Cell(0, 10, strtoupper($parent), 1, 1, 'C', true);
            
            // Parent data
            $keys = array_keys($parentData);
            $values = array_values($parentData);
            
            for ($i = 0; $i < count($parentData); $i++) {
                // Label column
                $this->SetFont('Arial','B',12);
                $this->SetFillColor(220, 230, 241);
                $this->Cell(70, 10, $keys[$i], 1, 0, 'L', true);
                
                // Value column
                $this->SetFont('Arial','',12);
                $this->SetFillColor(255, 255, 255);
                $this->Cell(0, 10, $values[$i], 1, 1, 'L', true);
            }
            
            $this->Ln(2);
        }
    }
    
    // Custom table for Data Sekolah
    function DataSekolahTable($data) {
        // Header table
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(79, 129, 189);
        $this->SetTextColor(255);
        $this->Cell(0,10,'DATA SEKOLAH',1,1,'C',true);
        
        // Reset text color
        $this->SetTextColor(0);
        
        // Table content
        $keys = array_keys($data);
        $values = array_values($data);
        
        for ($i = 0; $i < count($data); $i++) {
            // Label column
            $this->SetFont('Arial','B',12);
            $this->SetFillColor(220, 230, 241);
            $this->Cell(70, 10, $keys[$i], 1, 0, 'L', true);
            
            // Value column
            $this->SetFont('Arial','',12);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(0, 10, $values[$i], 1, 1, 'L', true);
        }
    }
    
    // Custom table for Data Upload
    function DataUploadTable($data) {
        // Header table
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(79, 129, 189);
        $this->SetTextColor(255);
        $this->Cell(0,10,'DATA UPLOAD',1,1,'C',true);
        
        // Reset text color
        $this->SetTextColor(0);
        
        // Table content
        $keys = array_keys($data);
        $values = array_values($data);
        
        for ($i = 0; $i < count($data); $i++) {
            // Label column
            $this->SetFont('Arial','B',12);
            $this->SetFillColor(220, 230, 241);
            $this->Cell(70, 10, $keys[$i], 1, 0, 'L', true);
            
            // Value column
            $this->SetFont('Arial','',12);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(0, 10, basename($values[$i]), 1, 1, 'L', true);
        }
    }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// =================== DATA DIRI ===================
if ($form == 'diri' || $form == 'semua') {
    $res = mysqli_query($conn, "SELECT * FROM data_diri");
    if ($row = mysqli_fetch_assoc($res)) {
        $dataDiri = array(
            'NIS' => $row['nis'],
            'NISN' => $row['nisn'],
            'Nama Lengkap' => $row['nama_lengkap'],
            'Nama Panggilan' => $row['nama_panggilan'],
            'Hobby' => $row['hobby'],
            'Agama' => $row['agama'],
            'Makanan Favorit' => $row['makanan_favorit'],
            'Alamat Lengkap' => $row['alamat_lengkap'],
            'Deskripsi' => $row['deskripsi']
        );
        
        $pdf->DataDiriTable($dataDiri);
        $pdf->Ln(10);
    }
}

// =================== DATA KELUARGA ===================
if ($form == 'keluarga' || $form == 'semua') {
    if ($pdf->GetY() > 200) {
        $pdf->AddPage();
    }
    
    $res = mysqli_query($conn, "SELECT * FROM data_keluarga");
    if ($row = mysqli_fetch_assoc($res)) {
        $dataKeluarga = array(
            'Ayah' => array(
                'NIK' => $row['nik_ayah'],
                'Nama' => $row['nama_ayah'],
                'Alamat' => $row['alamat_ayah'],
                'Agama' => $row['agama_ayah'],
                'Hobby' => $row['hobby_ayah'],
                'Deskripsi' => $row['deskripsi_ayah']
            ),
            'Ibu' => array(
                'NIK' => $row['nik_ibu'],
                'Nama' => $row['nama_ibu'],
                'Alamat' => $row['alamat_ibu'],
                'Agama' => $row['agama_ibu'],
                'Hobby' => $row['hobby_ibu'],
                'Deskripsi' => $row['deskripsi_ibu']
            )
        );
        
        $pdf->DataKeluargaTable($dataKeluarga);
        $pdf->Ln(10);
    }
}

// =================== DATA SEKOLAH ===================
if ($form == 'sekolah' || $form == 'semua') {
    if ($pdf->GetY() > 180) {
        $pdf->AddPage();
    }
    
    $res = mysqli_query($conn, "SELECT * FROM data_sekolah");
    if ($row = mysqli_fetch_assoc($res)) {
        $dataSekolah = array(
            'NIS' => $row['nis'],
            'NISN' => $row['nisn'],
            'Nama Lengkap' => $row['nama_lengkap'],
            'Alamat' => $row['alamat'],
            'Agama' => $row['agama'],
            'Jurusan' => $row['jurusan'],
            'Sekolah' => $row['nama_sekolah'],
            'Hobby' => $row['hobby'],
            'Motto Hidup' => $row['motto_hidup'],
            'Cita-cita' => $row['cita_cita'],
            'Deskripsi' => $row['deskripsi']
        );
        
        $pdf->DataSekolahTable($dataSekolah);
        $pdf->Ln(10);
    }
}

// =================== DATA UPLOAD ===================
if ($form == 'upload' || $form == 'semua') {
    if ($pdf->GetY() > 200) {
        $pdf->AddPage();
    }
    
    $res = mysqli_query($conn, "SELECT * FROM upload_data");
    if ($row = mysqli_fetch_assoc($res)) {
        $dataUpload = array(
            'Foto' => $row['foto'],
            'Logo SMK' => $row['logo_smk'],
            'KTP' => $row['ktp'],
            'KK' => $row['kk'],
            'Foto Sembarang' => $row['foto_sembarang']
        );
        
        $pdf->DataUploadTable($dataUpload);
        $pdf->Ln(10);
    }
}

// Create directory if it doesn't exist
$base_directory = __DIR__ . "/fpdf/";
$target_directory = $base_directory . "CETAKPDF/";

if (!file_exists($base_directory)) {
    mkdir($base_directory, 0777, true);
}

if (!file_exists($target_directory)) {
    mkdir($target_directory, 0777, true);
}

// Generate filename with form type and timestamp
$form_label = ($form == 'semua') ? 'semua_data' : $form;
$filename = "laporan_{$form_label}_" . date('Y-m-d_His') . ".pdf";

// Save PDF to file first
$full_path = $target_directory . $filename;
$pdf->Output("F", $full_path);

// Then output to browser
$pdf->Output("I", $filename);

mysqli_close($conn);

// Optional: Show confirmation message
echo "<script>alert('PDF telah disimpan di: {$full_path}');</script>";
?>