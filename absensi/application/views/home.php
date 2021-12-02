<?php
  $date= tanggal(intval(date('d')), intval(date('m')), intval(date('Y')))
?>

<div class="row">

  <div class="col-lg-12 col-xs-12">
    <div class="box box-primary">
      <div class="box-body with-border">
          <h3 style="display:block; text-align:center;">ADMINISTRASI SMA NEGERI 1 GRABAG</h3>
          <?php if($master_semester->num_rows()== 1) {?>
                    <h4 style="display:block; text-align:center;">TAHUN AJARAN <?php echo $tahun_ajaran?> SEMESTER <?php echo $semester?></h4>  
          <?php } else{?> 
                    <?php if($this->userdata->nama_jabatan == 'Admin' || $this->userdata->nama_jabatan == 'Staf Tata Usaha'){?>
                       <h4 style="display:block; text-align:center;">Tahun ajaran dan Semester saat ini belum diatur. Klik <a href="<?php echo base_url('Master_Semester') ?>">di sini</a> untuk melakukan pengaturan.</h4>  
                    <?php }else{?>
                        <h4 style="display:block; text-align:center;">Tahun ajaran dan Semester saat ini belum diatur. Klik <a data-toggle="modal" data-target="#konfirmasiHapus">di sini</a> untuk melakukan pengaturan.</h4>  
          <?php }}?>         
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $jml_pegawai; ?></h3>

        <p>Jumlah Pegawai</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-contact"></i>
      </div>
      <a href="<?php echo base_url('Pegawai') ?>" class="small-box-footer">Detail&Tab;&Tab;&Tab; <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $jml_kelas; ?></h3>

        <p>Jumlah Kelas</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-briefcase-outline"></i>
      </div>
      <a href="<?php echo base_url('Kelas') ?>" class="small-box-footer">Detail&Tab;&Tab;&Tab; <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo $jml_mapel; ?></h3>

        <p>Jumlah Mapel</p>
      </div>
      <div class="icon">
        <i class="ion ion-location"></i>
      </div>
      <a href="<?php echo base_url('Mapel') ?>" class="small-box-footer">Detail&Tab;&Tab;&Tab; <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-purple">
      <div class="inner">
        <h3><?php echo $jml_siswa; ?></h3>

        <p>Jumlah Siswa</p>
      </div>
      <div class="icon">
        <i class="ion ion-location"></i>
      </div>
      <a href="<?php echo base_url('Siswa') ?>" class="small-box-footer">Detail&Tab;&Tab;&Tab; <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  

  <?php if($userdata->id_jabatan == 4 && $this->session->userdata('posisi_halaman')=='absensi') {?>
    <div class="col-lg-6 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik Kehadiran Siswa <small><?php echo $date?></small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="data-presensi" style="height:250px"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik Absensi <small><?php echo $date?></small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="data-absensi" style="height:250px"></canvas>
      </div>
    </div>
  </div>
  <?php } ?>

  <!-- <div class="col-lg-6 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik <small>Data Posisi</small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="data-posisi" style="height:250px"></canvas>
      </div>
    </div>
  </div> -->

  <!-- <div class="col-lg-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik <small>Data Kota</small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="data-kota" style="height:250px"></canvas>
      </div>
    </div>
  </div> -->
</div>

<div id="tempat-modal"></div>

<?php show_alert('konfirmasiHapus', 'konfirmasiAlert', 'Hanya Admin dan Staf Tata Usaha yang dapat Mengatur Tahun Ajaran dan Semester', 'OK'); ?>

<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
  //data presensi
  var pieChartCanvas = $("#data-presensi").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_presensi; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);

  // data absensi
  var pieChartCanvas = $("#data-absensi").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_absensi; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);
</script>