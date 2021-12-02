<div>
<?php
if(isset($_SESSION['id_user'])){
?>
        <h1>Ujian <?php echo ucwords($_SESSION['username']);?></h1>
    
        <p>
        <?php
		$hasil=mysql_query("select * from tabel_soal where publish='yes'");
		$jumlah=mysql_num_rows($hasil);
		$urut=0;
		while($row =mysql_fetch_array($hasil))
		{
			$id=$row["id_soal"];
			$pertanyaan=$row["pertanyaan"];
			$pilihan_a=$row["pilihan_a"];
			$pilihan_b=$row["pilihan_b"];
			$pilihan_c=$row["pilihan_c"];
			$pilihan_d=$row["pilihan_d"]; 
			
			?>
			<form name="form1" method="post" action="?page=jawaban">
			<input type="hidden" name="id[]" value=<?php echo $id; ?>>
			<input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
			<table width="457" border="0">
			<tr>
			  	<td width="17"><font color="#FFFFFF"><?php echo $urut=$urut+1; ?></font></td>
			  	<td width="430"><font color="#FFFFFF"><?php echo "$pertanyaan"; ?></font></td>
			</tr>
			<tr>
			  	<td height="21">&nbsp;</td>
			  	<td><input name="pilihan[<?php echo $id; ?>]" type="radio" value="A"> <font color="#FFFFFF"><?php echo "$pilihan_a";?></font> </td>
			</tr>
			<tr>
			  	<td>&nbsp;</td>
			  	<td><input name="pilihan[<?php echo $id; ?>]" type="radio" value="B"> <font color="#FFFFFF"><?php echo "$pilihan_b";?></font> </td>
			</tr>
			<tr>
			  	<td>&nbsp;</td>
			  	<td><input name="pilihan[<?php echo $id; ?>]" type="radio" value="C"> <font color="#FFFFFF"><?php echo "$pilihan_c";?></font> </td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			  	<td><input name="pilihan[<?php echo $id; ?>]" type="radio" value="D"> <font color="#FFFFFF"><?php echo "$pilihan_d";?></font> </td>
            </tr>
			</table>
		<?php
		}
		?>
        	<tr>
				<td>&nbsp;</td>
			  	<td><input type="submit" name="submit" value="Jawab" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"></td>
            </tr>
		</form>
        </p>

<?php
}else{
	?><p>Anda belum login. silahkan <a href="index.php">Login</a></p><?php
}
?>
</div>
