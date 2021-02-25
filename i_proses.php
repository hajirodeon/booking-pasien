<?php
session_start();

sleep(1);
require("inc/fungsi.php");

//ambil nilai
$aksi = nosql($_GET['aksi']);

$filenyax = "i_pasien_reg.php";
?>




<style>
	
a.menuku:hover {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: red;
	text-decoration: underline;
}

	
</style>

<script>
$(document).ready(function(){
		
	$("#step1").on('click', function(){
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
		$('.myimage1').attr('src', 'img/proses11.png');
		$('.myimage2').attr('src', 'img/proses2.png');
		$('.myimage3').attr('src', 'img/proses3.png');
		$('.myimage4').attr('src', 'img/proses4.png');
	});

	
	$("#step2").on('click', function(){
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar2");
		$('.myimage2').attr('src', 'img/proses21.png');
		$('.myimage1').attr('src', 'img/proses1.png');
		$('.myimage3').attr('src', 'img/proses3.png');
		$('.myimage4').attr('src', 'img/proses4.png');
	});


	$("#step3").on('click', function(){
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar3");
		$('.myimage3').attr('src', 'img/proses31.png');
		$('.myimage2').attr('src', 'img/proses2.png');
		$('.myimage1').attr('src', 'img/proses1.png');
		$('.myimage4').attr('src', 'img/proses4.png');
	});


	$("#step4").on('click', function(){
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar4");
		$('.myimage4').attr('src', 'img/proses41.png');
		$('.myimage2').attr('src', 'img/proses2.png');
		$('.myimage3').attr('src', 'img/proses3.png');
		$('.myimage1').attr('src', 'img/proses1.png');
	});


})
</script>



<?php
if ($aksi == "1")
	{
	echo '<img class="myimage1" src="img/proses1.png" height="50" />
	<br>
	
	<div align="center">
	<a id="step1" href="#" class="menuku">Data Anda<br /><font size="2">Masukan Data Diri Anda dengan Benar</font></a>
	</div>';
	}






if ($aksi == "2")
	{
	echo '<img class="myimage2" src="img/proses2.png" height="50" />
	<br>
	
	<div align="center">
	<a id="step2" href="#" class="menuku">Data Lengkap Pasien<br /><font size="2">Masukan Data Diri</font></a>
	</div>';
	}




if ($aksi == "3")
	{
	echo '<img class="myimage3" src="img/proses3.png" height="50" />
	<br>
	
	<div align="center">
	<a id="step3" href="#" class="menuku">Jenis Pembayaran<br /><font size="2">Inputkan Data Jenis Pembayaran</font></a>
	</div>';
	}




if ($aksi == "4")
	{
	echo '<img class="myimage4" src="img/proses4.png" height="50" />
	<br>
	
	<div align="center">
	<a id="step4" href="#" class="menuku">Invoice Booking<br /><font size="2">Kode Booking Pendaftaran Online</font></a>
	</div>';
	}





exit();
?>
