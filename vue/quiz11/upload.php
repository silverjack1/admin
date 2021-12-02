<div>
<?php
//periksa apakah user telah menekan submit, dengan menggunakan parameter setingan keterangan
if (isset($_POST['submit']))
{
	include "koneksi.php";
	
	$nama=ucwords($_POST['nama']);
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$nama_gambar=$_FILES['gambar']['name'];
	
	//periksa jika data yang dimasukan belum lengkap
	if ($username=="" || $password=="" ||$nama_gambar=="")
	{
		//jika ada inputan yang kosong
		echo "<p>Data Anda belum lengkap</p>";
		
	}else{
		
		//definisikan variabel file dan alamat file
		$uploaddir='./gambar/';
		$alamatfile=$uploaddir.$nama_gambar;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['gambar']['tmp_name'],$alamatfile))
		{
			//catat data file yang berhasil di upload
			$upload=mysql_query("INSERT INTO tabel_user VALUES('','$nama','$alamatfile','$username','$password')");
			
			if($upload){
				//jika berhasil
				echo "<p>Data Anda berhasil disimpan. Silahkan Login</p>";
			}else{
				echo "gagal simpan data";
			}
			
		
		}else{
			//jika gagal
			echo "<p>Proses upload gagal, kode error = " . $_FILES['location']['error']."</p>";
		}
	}
	
}
else
{
	unset($_POST['submit']);
}
?>
</div>