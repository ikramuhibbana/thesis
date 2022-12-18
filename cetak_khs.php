<?php
include 'koneksi.php';

// get ID
$id = $_GET['id'];
$data_mhs = [];
$mahasiswa = mysqli_query($con, "select * from mahasiswa WHERE id = '$id' LIMIT 1");
while ($row = mysqli_fetch_array($mahasiswa)) {
    $data_mhs['nim'] = $row['nim'];
    $data_mhs['nama'] = $row['nama'];
    $data_mhs['jenis_kelamin'] = $row['jenis_kelamin'];
    $data_mhs['alamat'] = $row['alamat'];
    $data_mhs['tgl_lahir'] = $row['tgl_lahir'];
}
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string
$pdf->Cell(190, 7, 'PROGRAM STUDI TEKNIK INFORMATIKA', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, "CETAK KHS MAHASISWA", 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(14, 7, "NAMA : " . $data_mhs['nama'], 0, 1, 'C');
$pdf->Cell(10, 7, "NIM  : " . $data_mhs['nim'], 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'KODE', 1, 0);
$pdf->Cell(50, 6, 'NAMA MATKUL', 1, 0);
$pdf->Cell(25, 6, 'SKS', 1, 0);
$pdf->Cell(50, 6, 'SEMESTER', 1, 0);
$pdf->Cell(30, 6, 'NILAI', 1, 1);
$pdf->SetFont('Arial', '', 10);
$mahasiswa = mysqli_query($con, "SELECT  mata_kuliah.kode, mata_kuliah.nama as nama_matkul, mata_kuliah.sks, mata_kuliah.sem, khs.nilai FROM khs, mahasiswa, mata_kuliah WHERE mahasiswa.id = '$id' and mata_kuliah.id = khs.id_matkul and mahasiswa.id = khs.id_mhs");
while ($row = mysqli_fetch_array($mahasiswa)) {
    $pdf->Cell(20, 6, $row['kode'], 1, 0);
    $pdf->Cell(50, 6, $row['nama_matkul'], 1, 0);
    $pdf->Cell(25, 6, $row['sks'], 1, 0);
    $pdf->Cell(50, 6, $row['sem'], 1, 0);
    $pdf->Cell(30, 6, $row['nilai'], 1, 1);
}
$pdf->Output();
