<?php
// Memanggil file koneksi.php
include_once("koneksi.php");

// Syntax untuk mengambil semua data dari table mahasiswa
$result = mysqli_query($con, "SELECT * FROM mahasiswa ");
?>
<html>

<head>
    <title>Halaman Utama</title>
</head>

<body>
    <a href="tambah.php">Tambah Data Baru</a> | <a href="cari_mhs.php">Cari Mahasiswa</a> | <a href="cetak_mhs.php">Cetak Mahasiswa</a><br /><br /><br /><br />
    <table width='80%' border=1>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Update</th>
        </tr>
        <?php
        while ($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $user_data['nim'] . "</td>";
            echo "<td>" . $user_data['nama'] . "</td>";
            echo "<td>" . $user_data['jenis_kelamin'] . "</td>";
            echo "<td>" . $user_data['alamat'] . "</td>";
            echo "<td>" . $user_data['tgl_lahir'] . "</td>";
            echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>