<!DOCTYPE html>
<html lang="en">

<head>

<?php $this->load->view("_layout/_meta.php") ?>
<?php $this->load->view("_layout/_css.php") ?>
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>


<!--     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"> -->
    <!-- <meta http-equiv="content-type" content="text/html; charset=UTF-8"> -->
    <!-- For Google -->
    <!-- <link rel="author" href="https://plus.google.com/+Scoopthemes">
    <link rel="publisher" href="https://plus.google.com/+Scoopthemes"> -->
    <!-- for Twitter -->          
    <!-- <meta name="twitter:card" content="photo">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">
    <meta name="twitter:url" content=""> -->
    <!-- for Facebook OpenGraph -->          
    <!-- <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="" /> -->
    
    <!-- Canonical -->
    <!-- <link rel="canonical" href=""> -->
    <link rel="icon" href="<?php echo base_url();?>assets/img/logo_smansagra.png" type="image/png" />
    <title>Administrasi SMAN 1 GRABAG</title>

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <!-- font Awesome CSS -->
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"> -->

    <!-- Main Styles CSS -->
    <!-- <link href="css/main.css" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
   <div id="wrapper">
	
		


        <div class="nav-wrapper">
            <!-- <div class="container"> -->
                
                <nav class="navbar navbar-default navbar-inverse" role="navigation">
                  <div style="background-color: #0D2F7E; border-color: #0D2F7E" class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <!-- <a class="navbar-brand" href="#">Scoop Themes</a> -->
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      
                      <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><img class="img-profile" src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>"></span>&Tab;<?php echo $userdata->nama_pegawai; ?>&Tab;&Tab;<span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url(); ?>/Profile">Profil</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>/Auth/logout">Keluar</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>

            <!-- </div> -->
            <!-- /.container -->
        </div>
        <!-- /.nav-wrapper -->

        <div id="mainCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#mainCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#mainCarousel" data-slide-to="1"></li>
                <li data-target="#mainCarousel" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="<?php echo base_url(); ?>assets/img/banner-1.png" alt="...">
                  <div class="carousel-caption">
                    <!-- <h3>SMA Negeri 1 Grabag</h3> -->
                  </div>
                </div>
                <div class="item">
                  <img src="<?php echo base_url(); ?>assets/img/banner-2.jpg" alt="...">
                  <div class="carousel-caption">
                    <!-- <h3>Slide Caption</h3> -->
                  </div>
                </div>
                <div class="item">
                  <img src="<?php echo base_url(); ?>assets/img/banner-3.jpg" alt="...">
                  <div class="carousel-caption">
                    <!-- <h3>Slide Caption</h3> -->
                  </div>
                </div>
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#mainCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#mainCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>


        <div class="container">

            <div class="section">
          <!-- <div class="row box-center">
                    <div class="col-md-4">
                        <div class="box-menu box-menu-1"> -->
                            <!-- <a href="#" class="thumbnail"> -->
                            <!-- <img class="img-menu" src="<?php echo base_url(); ?>assets/img/logo-absensi.png" alt="">
                            <hr class="line"> -->
                            <!-- </a> -->
                          <!--   <h3>Absensi Siswa</h3>    
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="box-menu box-menu-2"> -->
                            <!-- <a href="#" class="thumbnail"> -->
                            <!-- <img class="img-menu" src="<?php echo base_url(); ?>assets/img/logo-spp.png" alt="">
                            <hr class="line"> -->
                            <!-- </a> -->
                            <!-- <h3>Pembayaran SPP</h3> -->
                        <!-- <a href="#" class="btn btn-primary btn-sm">Read More</a> -->
                       <!--  </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-menu box-menu-3"> -->
                            <!-- <a href="#" class="thumbnail"> -->
                            <!-- <img class="img-menu" src="<?php echo base_url(); ?>assets/img/logo-rapor.png" alt="">
                            <hr class="line"> -->
                            <!-- </a> -->
                            <!-- <h3>Rapor Siswa</h3> -->
                        <!-- <a href="#" class="btn btn-primary btn-sm">Read More</a> -->
                        <!-- </div>
                    </div> -->
                    <!-- <div class="col-md-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x200" alt="">
                        </a>
                        <h3>Header Four</h3>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div> -->
                <!-- </div> -->
                
                    <div class="row box-center">
                        <a href="<?php echo base_url('Auth/setHalamanAbsensi'); ?>">
                            <div class="col-md-4" style="margin-bottom: 10px">
                                <div class="box-menu box-menu-1">
                                    <!-- <a href="#" class="thumbnail"> -->
                                    <img class="img-menu" src="<?php echo base_url(); ?>assets/img/logo-absensi.png" alt="">
                                    <hr class="line">
                                    <!-- </a> -->
                                    <h3>Absensi Siswa</h3>    
                                </div>
                                
                            </div>
                        </a>
                        <a href="<?php echo base_url('Auth/setHalamanSPP'); ?>">
                            <div class="col-md-4" style="margin-bottom: 10px">
                                <div class="box-menu box-menu-2">
                                    <!-- <a href="#" class="thumbnail"> -->
                                    <img class="img-menu" src="<?php echo base_url(); ?>assets/img/logo-spp.png" alt="">
                                    <hr class="line">
                                    <!-- </a> -->
                                    <h3>Pembayaran SPP</h3>
                                <!-- <a href="#" class="btn btn-primary btn-sm">Read More</a> -->
                                </div>
                            </div>
                        </a>
                        <!-- <a href="<?php echo base_url('Auth/setHalamanRapor'); ?>"> -->
                            <!-- <div class="col-md-3" style="margin-bottom: 10px"> -->
                                <!-- <div class="box-menu box-menu-3"> -->
                                    <!-- <a href="#" class="thumbnail"> -->
                                    <!-- <img class="img-menu" src="<?php echo base_url(); ?>assets/img/logo-rapor.png" alt=""> -->
                                    <!-- <hr class="line"> -->
                                    <!-- </a> -->
                                    <!-- <h3>Rapor Siswa</h3> -->
                                <!-- <a href="#" class="btn btn-primary btn-sm">Read More</a> -->
                                <!-- </div> -->
                            <!-- </div> -->
                        <!-- </a> -->
                        <a href="<?php echo base_url('Auth/setHalamanSekolah'); ?>">
                            <div class="col-md-4" style="margin-bottom: 10px">
                                <div class="box-menu box-menu-4">
                                    <img class="img-menu" src="<?php echo base_url(); ?>assets/img/logo-data-sekolah.png" alt="">
                                    <hr class="line">
                                    <h3>Data Sekolah</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                
            </div>
            <!-- /.section -->
            
            <!-- <hr> -->

            <div class="section">
                <div class="row">
                    <!-- <div class="col-md-7"> -->
                        <!-- <h1>Font Awesome Is There</h1> -->
                        <div class="box-center">
                            <p>Tata Cara Penggunaan Sistem Administrasi SMA Negeri 1 Grabag</p>
                            <a href="https://www.youtube.com/channel/UCLjahTwphr7oeFMHq9bjVsA" class="btn btn-primary " target="_blank">Klik di sini</a>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="col-md-5">
                        <img src="http://placehold.it/450x200" class="img-responsive" alt="">
                    </div> -->
                </div>
            </div>
            <!-- /.section -->

            <!-- <hr> -->

            

        </div>
        <!-- /.container -->
        <footer>
                <div class="copy-rights clearfix">
                    <div class="pull-left">
                       
                    </div>
                <div class="pull-right">
                        <strong><a href="#"></a></strong>
                    </div>
                <p class="m-0 text-center text-white">Copyright &copy; 2020 | Informatika Undip 2017</p>
                </div>
            </footer>

        
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
	<?php $this->load->view("_layout/_js.php") ?>

 


</body>

</html>
