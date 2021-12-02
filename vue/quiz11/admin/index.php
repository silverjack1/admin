<?php  session_start();

if (isset($_POST['login'])){

	include ("koneksi.php");
	
	$username=htmlentities((trim($_POST['username'])));
	$password=htmlentities(md5($_POST['password']));
	
	$login=mysql_query("select * from admin where username='$username' and password='$password'");
	$cek_login=mysql_num_rows($login);

	if (empty($cek_login)){
	
		echo "<script> document.location.href='index.php?status=Password Anda salah!'; </script>";
		
	}else{
	
		//daftarkan ID jika user dan password BENAR
		while ($row=mysql_fetch_array($login))
		{
			$id_admin=$row['id_admin'];
			
			$_SESSION['id_admin']=$id_admin;
			$_SESSION['username']=$username;
			
		}
		
		echo "<script> document.location.href='home.php'; </script>";
	
	}
	
}else{
	unset($_POST['login']);
}
?>


<html>
<head>
    <link rel="shortcut icon" href="favicon.gif" type="image/x-icon">
    <title>Login</title>
</head>
<body onLoad="document.postform.elements['username'].focus();">
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="19%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="center">
<tr> 
	<td width="4%" align="right"><img src="./img/kiri.jpg"></td>
	<td width="74%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">ADMINISTRATOR</font></strong></div></td>
	<td width="21%"><img src="./img/kanan.jpg"></td>
</tr>
<tr>
	<td background="./img/b-kiri.jpg">&nbsp; </td>
	<td>
	<table width="259" align="center">
		<tr><td width="251"><font face="verdana" size="2">&nbsp;
		</font>
		
		<form action="index.php" method="post" name="postform">
		  <table width="251" height="101" border="0" align="center">
		  <tr valign="bottom">
			<td width="104" height="35"><font color="#666666" size="4" face="verdana">Username</font></td>
			  <td width="137"><font size="4" face="verdana">
				<input type="text" name="username" size="20" id="username">
			  </font></td>
		  </tr>
		  
		  <tr valign="top">
			<td height="34"><font color="#666666" size="4" face="verdana">Password</font></td>
			  <td><font size="4" face="verdana">
				<input type="password" name="password" size="20">
			  </font></td>
		  </tr>
		  
		  <tr>
		  	<td>&nbsp;</td>
		  	<td><font size="4" face="verdana">
				<input type="submit" value="LOGIN" name="login">
			  </font></td>
		  </tr>
		  </table>
		</form>
		
				
		</td></tr>
	</table>
	</td>
	<td background="./img/b-kanan.jpg">&nbsp;</td>
	<td width="1%"></td>
</tr>
<tr> 
	<td align="right"><img src="./img/kib.jpg"></td>
	<td bgcolor="#5686c6" ><div align="center"><font face="verdana" size="2" color="#FFFFFF"><?php  if(isset($_GET['status'])){ echo $_GET['status']; }?></font></div></td>
	<td><img src="./img/kab.jpg"></td>
</tr>
</table>
</body>
</html>