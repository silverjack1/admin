<div>
<?php
if(isset($_SESSION['id_admin'])){
	include ("koneksi.php");
	
	if (isset($_POST['submit'])){
		$id=htmlentities((trim($_POST['id'])));
		$pertanyaan=ucwords(htmlentities((trim($_POST['pertanyaan']))));
		$pilihan_a=ucwords(htmlentities((trim($_POST['pilihan_a']))));
		$pilihan_b=ucwords(htmlentities((trim($_POST['pilihan_b']))));
		$pilihan_c=ucwords(htmlentities((trim($_POST['pilihan_c']))));
		$pilihan_d=ucwords(htmlentities((trim($_POST['pilihan_d']))));
		
		$jawaban=ucwords(htmlentities((trim($_POST['jawaban']))));
		$publish=htmlentities((trim($_POST['publish'])));
		$tipe=htmlentities((trim($_POST['tipe'])));
		
		$query=mysql_query("update tabel_soal set pertanyaan='$pertanyaan',pilihan_a='$pilihan_a',pilihan_b='$pilihan_b',
		pilihan_c='$pilihan_c',pilihan_d='$pilihan_d',jawaban='$jawaban',publish='$publish',tipe='$tipe' where id_soal='$id'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=view";</script><?php
		}else{
			echo mysql_error();
		}
		
	}else{
		unset($_POST['submit']);
	}
	?>

    <h1>Input Soal</h1>
    
    <?php
	$id=$_GET['id'];
	$query=mysql_query("select * from tabel_soal where id_soal='$id'");
	$row=mysql_fetch_array($query);
	?>
    
    <form action="?page=edit" method="post">
    <input type="hidden" name="id" value="<?php echo $id;?>" />
    <table class="datatable" align="center">
    <tr>
        <td width="29%" height="37" valign="top"><font size="2" face="verdana"><p>Pertanyaan</p></font></td>
        <td><textarea cols="23" rows="5" name="pertanyaan"><?php echo $row['pertanyaan']?></textarea></td>
    </tr>
    
    <tr>
        <td width="29%" height="37" valign="middle"><font size="2" face="verdana"><p>Pilihan A</p></font></td>
        <td><input type="text" name="pilihan_a" value="<?php echo $row['pilihan_a'];?>" size="30"/></td>
    </tr>
    
    <tr>
        <td width="29%" height="37" valign="middle"><font size="2" face="verdana"><p>Pilihan B</p></font></td>
        <td><input type="text" name="pilihan_b" value="<?php echo $row['pilihan_b'];?>" size="30"/></td>
    </tr>
    
     <tr>
        <td width="29%" height="37" valign="middle"><font size="2" face="verdana"><p>Pilihan C</p></font></td>
        <td><input type="text" name="pilihan_c" value="<?php echo $row['pilihan_c'];?>"size="30"/></td>
    </tr>
    
     <tr>
        <td width="29%" height="37" valign="middle"><font size="2" face="verdana"><p>Pilihan D</p></font></td>
        <td><input type="text" name="pilihan_d" value="<?php echo $row['pilihan_d'];?>"size="30"/></td>
    </tr>
    
     <tr>
        <td width="29%" height="37" valign="middle"><font size="2" face="verdana"><p><b>JABAWAN</b></p></font></td>
        <td>
        <select name="jawaban">
        	<option value="a" <?php if($row['jawaban']=="A"){ echo "selected='selected'"; }?>>A</option>
            <option value="b" <?php if($row['jawaban']=="B"){ echo "selected='selected'"; }?>>B</option>
            <option value="c" <?php if($row['jawaban']=="C"){ echo "selected='selected'"; }?>>C</option>
            <option value="d" <?php if($row['jawaban']=="D"){ echo "selected='selected'"; }?>>D</option>
        </select>
        </td>
    </tr>
    
    
    <tr>
        <td width="29%" height="37" valign="middle"><font size="2" face="verdana"><p><b>PUBLISH</b></p></font></td>
        <td>
        <select name="publish">
        	<option value="yes" <?php if($row['publish']=="yes"){ echo "selected='selected'"; }?>>Yes</option>
            <option value="no" <?php if($row['publish']=="no"){ echo "selected='selected'"; }?>>No</option>
        </select>
        </td>
    </tr>
    
    
    <tr>
        <td width="29%" height="37" valign="middle"><font size="2" face="verdana"><p><b>TIPE</b></p></font></td>
        <td>
        <select name="tipe">
        	<option value="1" <?php if($row['tipe']=="1"){ echo "selected='selected'"; }?>>1</option>
            <option value="2" <?php if($row['tipe']=="2"){ echo "selected='selected'"; }?>>2</option>
            <option value="3" <?php if($row['tipe']=="3"){ echo "selected='selected'"; }?>>3</option>
            <option value="4" <?php if($row['tipe']=="4"){ echo "selected='selected'"; }?>>4</option>
            <option value="5" <?php if($row['tipe']=="5"){ echo "selected='selected'"; }?>>5</option>
            <option value="6" <?php if($row['tipe']=="6"){ echo "selected='selected'"; }?>>6</option>
            <option value="7" <?php if($row['tipe']=="7"){ echo "selected='selected'"; }?>>7</option>
        </select>
        </td>
    </tr>
    
    <tr>
        <td>&nbsp;</td>
        <td width="71%"><input name="submit" type="submit" value="Submit" />&nbsp;</td>
    </tr>
    </table>
    </form>

    
<?php
}else{
	?><p>Anda belum login. silahkan <a href="index.php">Login</a></p><?php
}
?>
</div>



    
