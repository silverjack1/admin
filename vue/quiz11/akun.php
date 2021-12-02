<div>
<?php
if(isset($_SESSION['id_user'])){
?>
    <h1>Akun <?php echo ucwords($_SESSION['username']);?></h1>

    <p>
    <i>Berisi informasi akun user yang online</i>
    </p>
    
<?php
}else{
	?><p>Anda belum login. silahkan <a href="index.php">Login</a></p><?php
}
?>
</div>

