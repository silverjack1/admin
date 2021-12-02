<div>
<?php
if(isset($_SESSION['id_admin'])){
?>
        <h1>Edit Soal</h1>
    
        <p>
        <?php
		$query=mysql_query("select * from tabel_soal order by tipe asc");
		echo "<i>Untuk tipe soal, silahkan teman-teman kembangkan : )</i>";
		?><table width="100%"><?php
		$no=0;
		while($row=mysql_fetch_array($query)){
		?>
			<tr>
           		<td><font color="#FFFFFF"><?php echo $no=$no+1;?>.</font></td><td><font color="#FFFFFF"><?php echo $row['pertanyaan'];?></font></td>
            </tr>
            <tr>
           		<td></td><td><font color="#FFFFFF">A) <?php echo $row['pilihan_a'];?></font></td>
            </tr>
            <tr>
           		<td></td><td><font color="#FFFFFF">B) <?php echo $row['pilihan_b'];?></font></td>
            </tr>
            <tr>
           		<td></td><td><font color="#FFFFFF">C) <?php echo $row['pilihan_c'];?></font></td>
            </tr>
            <tr>
           		<td></td><td><font color="#FFFFFF">D) <?php echo $row['pilihan_d'];?></font></td>
            </tr>
            <tr>
           		<td></td><td><font color="#FFFF00">JAWABAN : <b><?php echo $row['jawaban'];?></b> &raquo; PUBLISH : <b><?php echo ucwords($row['publish']);?></b> &raquo;
                TIPE : <b><?php echo ucwords($row['tipe']);?></b> &raquo;</font>
                <a href="?page=edit&id=<?php echo $row['id_soal']?>" title="Edit"><img src="img/update.png" /></a> <a href="?page=delete&id=<?php echo $row['id_soal']?>" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus pertanyaan ini ?')"><img src="img/hapus.png" /></a>
                </td>
            </tr>
            <tr>
           		<td colspan="2"><br /></td>
            </tr>
		<?php
		}
		?>
        </table>
        </p>
<?php
}else{
	?><p>Anda belum login. silahkan <a href="index.php">Login</a></p><?php
}
?>
</div>
