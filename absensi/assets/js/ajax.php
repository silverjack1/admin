<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "pageLength" : 25,
		  "lengthMenu" : [25, 50, 75, 100],
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		  language :{
		  	paginate :{
		  		previous : "<",
		  		next : ">"
		  	},
		  	lengthMenu: "Menampilkan _MENU_ data",
		  	zeroRecords: "Tidak ada data",
		  	info: "Menampilkan halaman _PAGE_ dari _PAGES_",
		  	infoEmpty: "",
		  	search : "Pencarian"
		  }
		});

	window.onload = function() {
		tampilKelas();
		tampilSiswa();
		tampilPegawai();
		tampilTahun_Ajaran();
		tampilMapel();
		tampilMaster();
		tampilWali_Kelas();
		tampilPengajar();
		tampilAbsensi();
		tampilRekapAbsen();
		tampilRekap_SPP();
		tampilDetailRekapSPP()
		tampilLaporanAbsen();
		tampilSPP();
		tampilBulan();
		tampilBulanUpdate();
		tampilSiswaKelas();
		// tampilTahunUpdate();
		tampilTagihan();
		tampilBeasiswa();
		tampilDetailBeasiswa();
		tampilMasterSemester();

		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "pageLength" : 25,
		  "lengthMenu" : [25, 50, 75, 100],
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		  language :{
		  	paginate :{
		  		previous : "<",
		  		next : ">"
		  	},
		  	lengthMenu: "Menampilkan _MENU_ data",
		  	zeroRecords: "Tidak ada data",
		  	info: "Menampilkan halaman _PAGE_ dari _PAGES_",
		  	infoEmpty: "",
		  	search : "Pencarian"
		  }
		});
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	//Kelas
	function tampilKelas() {
		$.get('<?php echo base_url('Kelas/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kelas').html(data);
			refresh();
		});
	}

	var id;
	$(document).on("click", ".konfirmasiHapus-kelas", function() {
		id_kelas = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataKelas", function() {
		var id = id_kelas;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kelas/delete'); ?>",
			data: "id_kelas=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilKelas();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataKelas", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kelas/update'); ?>",
			data: "id_kelas=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kelas').modal('show');
		})
	})

	$(document).on("click", ".detail-dataKelas", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kelas/detail'); ?>",
			data: "id_kelas=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-kelas').modal('show');
		})
	})

	$('#form-tambah-kelas').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kelas/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKelas();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kelas").reset();
				$('#tambah-kelas').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kelas', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kelas/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKelas();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kelas").reset();
				$('#update-kelas').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-kelas').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-kelas').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Mapel
	function tampilMapel() {
		$.get('<?php echo base_url('Mapel/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-mapel').html(data);
			refresh();
		});
	}

	var id;
	$(document).on("click", ".konfirmasiHapus-mapel", function() {
		id_mapel = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataMapel", function() {
		var id = id_mapel;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Mapel/delete'); ?>",
			data: "id_mapel=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilMapel();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataMapel", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Mapel/update'); ?>",
			data: "id_mapel=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-mapel').modal('show');
		})
	})

	$(document).on("click", ".detail-dataMapel", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Mapel/detail'); ?>",
			data: "id_mapel=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-mapel').modal('show');
		})
	})

	$('#form-tambah-mapel').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Mapel/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMapel();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-mapel").reset();
				$('#tambah-mapel').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-mapel', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Mapel/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMapel();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-mapel").reset();
				$('#update-mapel').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-mapel').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-mapel').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Siswa
	function tampilSiswa() {
		$.get('<?php echo base_url('Siswa/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-siswa').html(data);
			refresh();
		});
	}

	var id_siswa;
	$(document).on("click", ".konfirmasiHapus-siswa", function() {
		id_siswa = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataSiswa", function() {
		var id = id_siswa;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Siswa/delete'); ?>",
			data: "NIS=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilSiswa();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataSiswa", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Siswa/update'); ?>",
			data: "NIS=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-siswa').modal('show');
		})
	})

	$(document).on("click", ".detail-dataSiswa", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Siswa/detail'); ?>",
			data: "NIS=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			// $('#tabel-detail').dataTable({
			// 	  "paging": true,
			// 	  "lengthChange": false,
			// 	  "searching": true,
			// 	  "ordering": true,
			// 	  "info": true,
			// 	  "autoWidth": false
			// 	});
			$('#detail-siswa').modal('show');
		})
	})

	$('#form-tambah-siswa').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Siswa/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSiswa();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-siswa").reset();
				$('#tambah-siswa').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-siswa', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Siswa/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSiswa();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-siswa").reset();
				$('#update-siswa').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-siswa').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-siswa').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Tahun Ajaran
	function tampilTahun_Ajaran() {
		$.get('<?php echo base_url('Tahun_ajaran/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-tahun_ajaran').html(data);
			refresh();
		});
	}

	var id_tahun;
	$(document).on("click", ".konfirmasiHapus-Tahun_ajaran", function() {
		id_tahun = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataTahun_ajaran", function() {
		var id = id_tahun;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Tahun_ajaran/delete'); ?>",
			data: "id_tahun=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilTahun_Ajaran();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataTahun_ajaran", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Tahun_ajaran/update'); ?>",
			data: "id_tahun=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-tahun_ajaran').modal('show');
		})
	})

	$('#form-tambah-tahun_ajaran').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Tahun_ajaran/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilTahun_Ajaran();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-tahun_ajaran").reset();
				$('#tambah-tahun_ajaran').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-tahun_ajaran', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Tahun_ajaran/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilTahun_Ajaran();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-tahun_ajaran").reset();
				$('#update-tahun_ajaran').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-tahun_ajaran').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-tahun_ajaran').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//pegawai_ter
	function tampilPegawai() {
		$.get('<?php echo base_url('Pegawai/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pegawai').html(data);
			refresh();
		});
	}

	var id_pegawai;
	$(document).on("click", ".konfirmasiHapus-pegawai", function() {
		id_pegawai = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPegawai", function() {
		var id = id_pegawai;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/delete'); ?>",
			data: "NIP=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPegawai();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPegawai", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/update'); ?>",
			data: "NIP=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pegawai').modal('show');
		})
	})

	$(document).on("click", ".detail-dataPegawai", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/detail'); ?>",
			data: "NIP=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			// $('#tabel-detail').dataTable({
			// 	  "paging": true,
			// 	  "lengthChange": false,
			// 	  "searching": true,
			// 	  "ordering": true,
			// 	  "info": true,
			// 	  "autoWidth": false
			// 	});
			$('#detail-pegawai').modal('show');
		})
	})

	$('#form-tambah-pegawai').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pegawai").reset();
				$('#tambah-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-pegawai', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pegawai").reset();
				$('#update-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Master
	function tampilMaster() {
		$.get('<?php echo base_url('Master/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-master').html(data);
			refresh();
		});
	}

	var id;
	$(document).on("click", ".konfirmasiHapus-master", function() {
		id_biaya = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataMaster", function() {
		var id = id_biaya;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Master/delete'); ?>",
			data: "id_biaya=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilMaster();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataMaster", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Master/update'); ?>",
			data: "id_biaya=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-master').modal('show');
		})
	})

	$(document).on("click", ".detail-dataMaster", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Master/detail'); ?>",
			data: "id_biaya=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-master').modal('show');
		})
	})

	$('#form-tambah-master').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Master/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMaster();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-master").reset();
				$('#tambah-master').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-master', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Master/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMaster();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-master").reset();
				$('#update-master').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-master').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-master').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Wali Kelas
	function tampilWali_Kelas(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Wali_kelas/tampil'); ?>",
			data: "id_tahun=" + $("#filter_wali_kelas").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data-wali_kelas').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	}

	$("#filter_wali_kelas").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Wali_kelas/tampil'); ?>",
			data: "id_tahun=" + $("#filter_wali_kelas").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data-wali_kelas').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	});

	var id_wali_kelas;
	$(document).on("click", ".konfirmasiHapus-wali_kelas", function() {
		id_wali_kelas = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataWali_Kelas", function() {
		var id = id_wali_kelas;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Wali_Kelas/delete'); ?>",
			data: "id_wali_kelas=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilWali_Kelas();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataWali_Kelas", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Wali_Kelas/update'); ?>",
			data: "id_wali_kelas=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-wali_kelas').modal('show');
		})
	})

	$('#form-tambah-wali_kelas').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Wali_Kelas/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilWali_Kelas();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-wali_kelas").reset();
				$('#tambah-wali_kelas').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-wali_kelas', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Wali_Kelas/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilWali_Kelas();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-wali_kelas").reset();
				$('#update-wali_kelas').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-wali_kelas').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-wali_kelas').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

//Pengajar
	// function tampilPengajar() {
	// 	$.get('<?php echo base_url('Pengajar/tampil'); ?>', function(data) {
	// 		MyTable.fnDestroy();
	// 		$('#data-pengajar').html(data);
	// 		refresh();
	// 	});
	// }

	function tampilPengajar(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pengajar/tampil'); ?>",
			data: "id_tahun=" + $("#filter_pengajar").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data_pengajar').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	}

	$("#filter_pengajar").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pengajar/tampil'); ?>",
			data: "id_tahun=" + $("#filter_pengajar").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data_pengajar').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	});

	var id_pengajar;
	$(document).on("click", ".konfirmasiHapus-pengajar", function() {
		id_pengajar = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPengajar", function() {
		var id = id_pengajar;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pengajar/delete'); ?>",
			data: "id_pengajar=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPengajar();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPengajar", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pengajar/update'); ?>",
			data: "id_pengajar=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pengajar').modal('show');
		})
	})

	$('#form-tambah-pengajar').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pengajar/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPengajar();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pengajar").reset();
				$('#tambah-pengajar').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-pengajar', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pengajar/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPengajar();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pengajar").reset();
				$('#update-pengajar').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-pengajar').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-pengajar').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Absensi
	function tampilAbsensi() {
		$.get('<?php echo base_url('Absensi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-absensi').html(data);
			refresh();
		});
	}

	//spp
	// function tampilSPP() {
	// 	$.get('<?php echo base_url('SPP/tampil'); ?>', function(data) {
	// 		MyTable.fnDestroy();
	// 		$('#data-spp').html(data);
	// 		refresh();
	// 	});
	// }
	function tampilSPP(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SPP/tampil'); ?>",
			data: "id_kelas=" + $("#filter-kelas-spp").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data-spp').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	}

	$("#filter-kelas-spp").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SPP/tampil'); ?>",
			data: "id_kelas=" + $("#filter-kelas-spp").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data-spp').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	});
	//Rekap Absensi
	function tampilRekapAbsen() {
		$.get('<?php echo base_url('Rekap_Absen/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-rekap-absen').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataRekapAbsen", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Rekap_Absen/detail'); ?>",
			data: "id_kelas=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-rekap-absen').modal('show');
		})
	})

	$(document).on("click", ".detail-dataRekapAbsenFilter", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Rekap_Absen/detailFilter'); ?>",
			data: "data_rabsen=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-rekap-absen-filter').modal('show');
		})
	})
	
	//rekap spp

	//pencarian by tahun bagian rekap spp
	function tampilRekap_SPP(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Rekap_SPP/tampil'); ?>",
			data: "id_tahun=" + $("#tahun_filter_rekap_spp").val(),
			
			success : function(data){
				 MyTable.fnDestroy();
				$('#data-Rekap_SPP').html(data);
				 refresh();
			},
			error: function(data){

			}
		});
	}

	// $("#tahun_filter_rekap_spp").change(function(e){
	// 	$.ajax({
	// 		method: "POST",
	// 		url: "<?php echo base_url('Rekap_SPP/tampil'); ?>",
	// 		data: "id_tahun=" + $("#tahun_filter_rekap_spp").val(),
			
	// 		success : function(data){
	// 			MyTable.fnDestroy();
	// 			$('#data-Rekap_SPP').html(data);
	// 			refresh();
	// 		},
	// 		error: function(data){

	// 		}
	// 	});
	// });

	function tampilDetailRekapSPP() {
		$.get('<?php echo base_url('Rekap_SPP/tampil_detail'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-detail-Rekap-SPP').html(data);
			refresh();
		});
	}

	var id;
	$(document).on("click", ".konfirmasiHapus-rekap_spp", function() {
		no_transaksi = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataRekap_SPP", function() {
		var id = no_transaksi;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Rekap_SPP/delete'); ?>",
			data: "no_transaksi=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilDetailRekapSPP()
			$('.msg').html(data);
			effect_msg();
		})
	})

	// $(document).on("click", ".detail-dataRekap_SPP", function() {
	// 	var no_transaksi = $(this).attr("data-id");
		
	// 	$.ajax({
	// 		method: "POST",
	// 		url: "<?php echo base_url('Rekap_SPP/detail'); ?>",
	// 		data: "no_transaksi=" +no_transaksi
	// 	})
	// 	.done(function(data) {
	// 		$('#tempat-modal').html(data);
	// 		// $('#tabel-detail').dataTable({
	// 		// 	  "paging": true,
	// 		// 	  "lengthChange": false,
	// 		// 	  "searching": true,
	// 		// 	  "ordering": true,
	// 		// 	  "info": true,
	// 		// 	  "autoWidth": false
	// 		// 	});
	// 		$('#detail-rekap_spp').modal('show');
	// 	})
	// })

	//Laporan Absensi
	function tampilLaporanAbsen() {
		$.get('<?php echo base_url('Laporan_Absensi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-laporan-absen').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataLaporanAbsen", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Laporan_Absensi/detail'); ?>",
			data: "id_kelas=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-laporan-absen').modal('show');
		})
	})

	$(document).on("click", ".detail-dataLaporanAbsenFilter", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Laporan_Absensi/detailFilter'); ?>",
			data: "data_labsen=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-laporan-absen-filter').modal('show');
		})
	})

	//bulan yang dibayar tambah spp
	function tampilBulan(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SPP/bulan_yang_dibayar'); ?>",
			data: "id_tahun=" + $("#filter-bayar-spp").val(),
			
			success : function(data){
				// MyTable.fnDestroy();
				$('#bulan-yang-dibayar').html(data);
				// refresh();
			},
			error: function(data){

			}
		});
	}

	$("#filter-bayar-spp").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SPP/bulan_yang_dibayar'); ?>",
			data: "id_tahun=" + $("#filter-bayar-spp").val(),
			
			success : function(data){
				// MyTable.fnDestroy();
				$('#bulan-yang-dibayar').html(data);
				// refresh();
			},
			error: function(data){

			}
		});
	});

	//bulan yang dibayar update spp
	function tampilBulanUpdate(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SPP/bulan_yang_dibayar_update'); ?>",
			data: "id_tahun=" + $("#filter-update-spp").val(),
			
			success : function(data){
				// MyTable.fnDestroy();
				$('#bulan-update-spp').html(data);
				// refresh();
			},
			error: function(data){

			}
		});
	}

	$("#filter-update-spp").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SPP/bulan_yang_dibayar_update'); ?>",
			data: "id_tahun=" + $("#filter-update-spp").val(),
			
			success : function(data){
				// MyTable.fnDestroy();
				$('#bulan-update-spp').html(data);
				// refresh();
			},
			error: function(data){

			}
		});
	});

	//bulan yang dibayar update spp
	function tampilSiswaKelas(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kelas/selectSiswaTAKelas'); ?>",
			data: "id_tahun=" + $("#filter_kelas_siswa").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data-siswa-kelas').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	}

	$("#filter_kelas_siswa").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kelas/selectSiswaTAKelas'); ?>",
			data: "id_tahun=" + $("#filter_kelas_siswa").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data-siswa-kelas').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	});

	

	//tagihan
	function tampilTagihan(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Tagihan_SPP/tampil'); ?>",
			data: "id_tahun=" + $("#tahun_filter_tagihan").val(),
			
			success : function(data){
				 MyTable.fnDestroy();
				$('#data-Tagihan_SPP').html(data);
				 refresh();
			},
			error: function(data){

			}
		});
	}

	$("#tahun_filter_tagihan").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Tagihan_SPP/tampil'); ?>",
			data: "id_tahun=" + $("#tahun_filter_tagihan").val(),
			
			success : function(data){
				MyTable.fnDestroy();
				$('#data-Tagihan_SPP').html(data);
				refresh();
			},
			error: function(data){

			}
		});
	});

	//Beasiswa
	function tampilBeasiswa() {
		$.get('<?php echo base_url('Beasiswa/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-beasiswa').html(data);
			refresh();
		});
	}

	var id;
	$(document).on("click", ".konfirmasiHapus-beasiswa", function() {
		id_beasiswa = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataBeasiswa", function() {
		var id = id_beasiswa;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Beasiswa/delete'); ?>",
			data: "id_beasiswa=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilBeasiswa();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataBeasiswa", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Beasiswa/update'); ?>",
			data: "id_beasiswa=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-beasiswa').modal('show');
		})
	})

	$(document).on("click", ".detail-dataBeasiswa", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Beasiswa/detail'); ?>",
			data: "id_beasiswa=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-beasiswa').modal('show');
		})
	})

	$('#form-tambah-beasiswa').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Beasiswa/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilBeasiswa();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-beasiswa").reset();
				$('#tambah-beasiswa').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-beasiswa', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Beasiswa/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilBeasiswa();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-beasiswa").reset();
				$('#update-beasiswa').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-beasiswa').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-beasiswa').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Beasiswa
	function tampilDetailBeasiswa() {
		$.get('<?php echo base_url('Beasiswa/tampilDetail'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-detail-beasiswa').html(data);
			refresh();
		});
	}

	var id;
	$(document).on("click", ".konfirmasiHapus-detail-beasiswa", function() {
		NIS = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataDetailBeasiswa", function() {
		var id = NIS;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Beasiswa/deleteDetail'); ?>",
			data: "NIS=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilDetailBeasiswa();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$('#form-tambah-detail-beasiswa').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Beasiswa/prosesTambahDetail'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilDetailBeasiswa();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-detail-beasiswa").reset();
				$('#tambah-detail-beasiswa').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-detail-beasiswa').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//kelola data siswa per kelas
	$("#filter-kelola-kelas-siswa").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kelas/kelola_load_kelas'); ?>",
			data: "id_tahun=" + $("#filter-kelola-kelas-siswa").val(),
			
			success : function(data){
				// MyTable.fnDestroy();
				$('#pilihan-kelola-kelas').html(data);
				// refresh();
			},
			error: function(data){

			}
		});
	});

	$("#tahun_filter_rekap_spp").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Rekap_SPP/kelola_load_kelas'); ?>",
			data: "id_tahun=" + $("#tahun_filter_rekap_spp").val(),
			
			success : function(data){
				// MyTable.fnDestroy();
				$('#kelas_filter_rekap_spp').html(data);
				// refresh();
			},
			error: function(data){

			}
		});
	});

	$("#filter_beasiswa_kelas").change(function(e){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Beasiswa/kelola_load_detail_beasiswa'); ?>",
			data: "id_kelas=" + $("#filter_beasiswa_kelas").val(),
			
			success : function(data){
				// MyTable.fnDestroy();
				$('#filter_beasiswa_nama_siswa').html(data);
				// refresh();
			},
			error: function(data){

			}
		});
	});


	//MasterSemester
	function tampilMasterSemester() {
		$.get('<?php echo base_url('Master_Semester/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-master-semester').html(data);
			refresh();
		});
	}

	var id;
	$(document).on("click", ".konfirmasiHapus-master_semester", function() {
		id_master_semester = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataMasterSemester", function() {
		var id = id_master_semester;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Master_Semester/delete'); ?>",
			data: "id_master_semester=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilMasterSemester();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataMasterSemester", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Master_Semester/update'); ?>",
			data: "id_master_semester=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-master-semester').modal('show');
		})
	})

	$('#form-tambah-master-semester').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Master_Semester/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMasterSemester();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-master-semester").reset();
				$('#tambah-master-semester').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-master-semester', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Master_Semester/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMasterSemester();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-master-semester").reset();
				$('#update-master-semester').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-master-semester').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-master-semester').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

</script>
