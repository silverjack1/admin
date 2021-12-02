<?php
if(isset($_SESSION['id_admin'])){
?>
    <div>
        <h1>Assalamualaiku...<?php 
        if(isset($_SESSION['id_user'])){
        
            echo ucwords($_SESSION['username']);
        
        }
        ?></h1>
    
        <p>Anda berada dihalaman yang digunakan untuk menambah dan edit soal pada situs ujian online.</p>
        
        <p><blink>Numpang exist!!!</blink></p>
        <p><a href="http://www.facebook.com/agusumarna"><img src="images/facebook-agus.jpg" width="124" height="213"></a><br />
          </p>
    </div>
    
<?php
}else{
	?><p>Anda belum login. silahkan <a href="index.php">Login</a></p><?php
}
?>
