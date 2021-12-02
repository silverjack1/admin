<?php session_start();
include "koneksi.php";
?>
    <!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Ujian Online -- Ri32.Wordpress.Com</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="Description" content="description" />
		<meta name="Keywords" content="keywords" />
		<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
        <link rel="shortcut icon" href="favicon.gif" type="image/x-icon">
	</head>
	<body onLoad="document.postform.elements['username'].focus();">
		<div id="outer">
			<div id="header">
				<div id="logo">
					<!-- Place your logo here -->
				</div>
	
				<!-- Sign In Box -->
				<div id="login-box">
                <?php
				if(!isset($_SESSION['id_user'])){
				?>
					<form action="?page=login" method="post" name="postform">
                    	Sign In
                        <input type="text" class="txt" name="username" id="username"/> 
                        <input type="password" class="txt" name="password"/> 
                        <input type="image" name="login" src="images/go-button.gif" value="Go" />
					</form>
				<?php
				}
				?>
				</div>
			</div>
			<div id="body-top">
				<!-- Main Navigation -->
				<ul id="main-nav" class="clearfix">
					<li><a href="?page=welcome"><b>Home</b></a></li>
					<?php
					if(isset($_SESSION['id_user'])){
						echo "<li><a href=?page=nilai><b>Nilai</b></a></li>";
					}else{
						echo "<li><a href=?page=daftar><b>Daftar</b></a></li>";
					}
					?>
					<li><a href="?page=ujian"><b>Ujian</b></a></li>
					<!-- Right Navigation Tab -->
					<li id="right-tab"><a href="?page=akun"><b>Account</b></a></li>
				</ul>
			</div>
			<div id="body-middle" class="clearfix">
			
				<!-- Main Column -->
				<div id="main-col">
				
					<!-- Nameplate Box -->
					<div id="nameplate-top"></div>
					<div id="nameplate-middle" class="clearfix">
						<h2><font color="#333333"><b><marquee behavior="scroll" scrollamount="5">Selamat Datang di Ujian Online - <blink>Ri32</blink></marquee></b></font></h2>
					</div>
					<div id="nameplate-bottom"></div>

					<!-- Main Content -->
					<div id="content-top"></div>
					<div id="content-wrapper">
						<div id="content">
						<?php 
							if(isset($_GET['page'])){
								$page=htmlentities($_GET['page']);
							}else{
								$page="welcome";
							}
							
							$file="$page.php";
							$cek=strlen($page);
							
							if($cek>10 || !file_exists($file) || empty($page)){
								include ("welcome.php");
							}else{
								include ($file);
							}
						?>		
                        </div>
					</div>
					<div id="content-bottom"></div>
					
				</div>
				<!-- End Main Column -->

				<!-- Sidebar Content -->
				<div id="side-col">

					<?php
					if(isset($_SESSION['id_user'])){
						include "status-login.php";
					}else{
						?>
						<!-- Side Box Begin -->
						<div class="side-box-top"></div>
						<div class="side-box-middle">
						<img src="images/user-online.jpeg" width="200" height="200" border="0" />
						<br />
						<br />
						</div>
						<div class="side-box-bottom"></div>
						<?php
					}
					?>
                    
                  <!-- Side Box End -->
				</div>
				<!-- End Sidebar Content -->
			</div>
			<div id="body-bottom"></div>

			<!-- Footer -->
			<div id="footer">
				<p><a href="http://www.studio7designs.com"><font color="#666666">web design by studio7designs.com</font></a></p>
		  </div>
			
		</div>
	</body>
	</html>