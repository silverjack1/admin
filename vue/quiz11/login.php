<div>
<?php
if(isset($_POST['username'])){
	echo "test";
	$username=htmlentities($_POST['username']);
	$password=md5($_POST['password']);
	
	
	if(empty($username) || empty($password)){
	
		?><p>Username atau Password anda masih kosong. silahkan ulangi <a href="index.php">Login</a></p><?php
		
	}else{
	
		$query=mysql_query("select * from tabel_user where username='$username' and password='$password'");
		$cek=mysql_num_rows($query);
		$data=mysql_fetch_array($query);
		
		if($cek){
			$_SESSION['username']=$username;
			$_SESSION['id_user']=$data['id_user'];
			$_SESSION['gambar_user']=$data['gambar_user'];
			
			?><script language="javascript">document.location.href='index.php'</script><?php
		}else{
			?><p>Anda gagal login. silahkan <a href="index.php">Login kembali</a></p><?php
			echo mysql_error();
		}
	
	}

}else{
	unset($_POST['username']);
}
?>
</div>