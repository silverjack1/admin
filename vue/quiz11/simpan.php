<div>
<?php
if(isset($_SESSION['id_user'])){
?>
	
	<?php
	if(isset($_POST['submit'])){
	
		$id_user=$_POST['id_user'];
		$benar=$_POST['benar'];
		$salah=$_POST['salah'];
		$kosong=$_POST['kosong'];
		$point=$_POST['point'];
		$tanggal=date("Y-m-d");
		
		$query=mysql_query("insert into tabel_nilai values('','$id_user','$benar','$salah','$kosong','$point','$tanggal')");
		
		if($query){
			?><script language="javascript">document.location.href='?page=nilai'</script><?php
		}else{
			echo mysql_error();
		}
		
	}
	?>
	
<?php
}else{
	?><p>Anda belum login. silahkan <a href="index.php">Login</a></p><?php
}
?>
</div>