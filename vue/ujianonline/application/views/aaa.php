<?php 
$sess_level = $this->session->userdata('admin_level');
$uri2 = $this->uri->segment(2);

$menu = array();

if ($sess_level == "guru") {
  $menu = array(
            array("icon"=>"dashboard", "url"=>"", "text"=>"Dashboard"),
            array("icon"=>"list-alt", "url"=>"m_soal", "text"=>"Soal"),
            array("icon"=>"file", "url"=>"m_ujian", "text"=>"Ujian"),
            array("icon"=>"file", "url"=>"h_ujian", "text"=>"Hasil Ujian"),
          );
} else if ($sess_level == "siswa") {
  $menu = array(
            array("icon"=>"dashboard", "url"=>"", "text"=>"Dashboard"),
            array("icon"=>"file", "url"=>"ikuti_ujian", "text"=>"Ujian"),
          );
} else if ($sess_level == "admin") {
  $menu = array(
            array("icon"=>"dashboard", "url"=>"", "text"=>"Dashboard"),
            array("icon"=>"list-alt", "url"=>"m_siswa", "text"=>"Data Siswa"),
            array("icon"=>"list-alt", "url"=>"m_guru", "text"=>"Data Guru/Dosen"),
            array("icon"=>"list-alt", "url"=>"m_mapel", "text"=>"Data Mapel"),
            array("icon"=>"list-alt", "url"=>"m_soal", "text"=>"Soal"),
            array("icon"=>"file", "url"=>"h_ujian", "text"=>"Hasil Ujian"),
          );
} else {
  $menu = array(
            array("icon"=>"dashboard", "url"=>"", "text"=>"Dashboard")
          );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard - Aplikasi Ujian Online</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo base_url(); ?>___/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">
<!--<link href="<?php echo base_url(); ?>___/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>___/css/font-awesome.css" rel="stylesheet">
<!--<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">-->
<!--<link href="<?php echo base_url(); ?>___/css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="color:#286090">Aplikasi Ujian Online</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar">
    <ul class="nav navbar-nav">
    <?php 
    foreach ($menu as $m) {
        if ($uri2 == $m['url']) {
          echo '<li><a href="'.base_url().'adm/'.$m['url'].'" >'.$m['text'].' </a></li>';
        } else {
          echo '<li><a href="'.base_url().'adm/'.$m['url'].'" >'.$m['text'].' </a></li>';
        }
    }
    ?>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->session->userdata('admin_nama')." (".$this->session->userdata('admin_user').")"; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" onclick="return rubah_password();" style="color:#286090">Ubah Password</a></li>
            <li><a href="<?php echo base_url(); ?>adm/logout" onclick="return confirm('keluar..?');" style="color:#286090">Keluar</a></li>
          </ul>
        </li>
      </ul>
      <!--
      <form class="navbar-form navbar-right search-form" role="search">
        <input type="text" class="form-control" placeholder="Search" />
      </form>
      -->
    </div>
  </div>
</nav>



<div class="container" style="margin-top: 70px">



<?php echo $this->load->view($p); ?>



<!-- insert modal -->
<div id="tampilkan_modal"></div>

</div>






<script src="<?php echo base_url(); ?>___/js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo base_url(); ?>___/js/ajaxFileUpload.js"></script> 
<script src="<?php echo base_url(); ?>___/js/bootstrap.js"></script>

<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>___/js/aplikasi.js"></script> 

</body>
</html>
