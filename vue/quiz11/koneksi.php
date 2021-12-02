<?php
$host="localhost";
$user="root";
$password="";
$database="db_ujianonline";

$koneksi=mysql_connect($host,$user,$password);
mysql_select_db($database,$koneksi);
//cek koneksi
if($koneksi){
	//echo "berhasil koneksi";
}else{
	echo "gagal koneksi";
}

$acak="ICAgICA8IS0tIFNpZGUgQm94IEVuZCAtLT4KCQkJCTwvZGl2PgoJCQkJPCEtLSBFbmQgU2lkZWJhciBDb250ZW50IC0tPgoJCQk8L2Rpdj4KCQkJPGRpdiBpZD0iYm9keS1ib3R0b20iPjwvZGl2PgoJCQk8IS0tIEZvb3RlciAtLT4KCQkJPGRpdiBpZD0iZm9vdGVyIj4KCQkJCTxwPjxhIGhyZWY9Imh0dHA6Ly9yaTMyLndvcmRwcmVzcy5jb20iPjxmb250IGNvbG9yPSIjNjY2NjY2Ij5odHRwOi8vcmkzMi53b3JkcHJlc3MuY29tPC9mb250PjwvYT48L3A+CgkJICA8L2Rpdj4KCQkJ";

?>