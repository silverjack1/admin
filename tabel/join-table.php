<?php

$conn = new mysqli('localhost', 'root', '', 'tpegawai');

if (mysqli_connect_errno($conn)) {
 echo "Koneksi gagal " . mysqli_connect_error();
}
?>

<!DOCTYPE html>
<html>
<head>
 <title>Join Table</title>
</head>
<body>

 <table border="1">
  <tr>
   <td>No.</td>
   <td>Nama</td>
   <td>Kelas</td>
   <td>Jurusan</td>
   <td>Tahun</td>
   <td>Nominal</td>
  </tr>
  
  <?php

  $query = mysqli_query($conn, "SELECT * FROM tb_siswa INNER JOIN tb_jurusan ON tb_siswa.id_jurusan = tb_jurusan.id_jurusan INNER JOIN tb_spp ON tb_siswa.id_spp = tb_spp.id_spp");

  $no = 1;
  foreach ($query as $row) :
   ?>

   <tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['kelas']; ?></td> 
    <td><?= $row['nama_jurusan']; ?></td>
    <td><?= $row['tahun']; ?></td>
    <td><?= $row['nominal']; ?></td>
   </tr>

  <?php endforeach; ?>

 </table>
</body>
</html>