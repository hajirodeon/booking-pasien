<?php
session_start();

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/pasien.html");

nocache;

//nilai
$filenya = "pasien_reg.php";
$filenyax = "i_pasien_reg.php";
$judul = "Formulir Pendaftaran Online";
$judulku = "[$adm_session] ==> $judul";
$juduli = $judul;



//hapus semua sesi...
session_destroy();
session_unset();




//isi *START
ob_start();


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<div align="center">
<h1>'.$judul.'</h1>
</div>';
?>




<script>
$(document).ready(function(){
	

	$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
	$('.myimage1').attr('src', 'img/proses11.png');
	$('.myimage2').attr('src', 'img/proses2.png');
	$('.myimage3').attr('src', 'img/proses3.png');
	$('.myimage4').attr('src', 'img/proses4.png');
	
	$("#iproses1").load("<?php echo $sumber;?>/i_proses.php?aksi=1");
	$("#iproses2").load("<?php echo $sumber;?>/i_proses.php?aksi=2");
	$("#iproses3").load("<?php echo $sumber;?>/i_proses.php?aksi=3");
	$("#iproses4").load("<?php echo $sumber;?>/i_proses.php?aksi=4");

})
</script>




	<table border="0" cellpadding="0" cellspacing="0" width="1100">
		<tr valign="top">
			<td align="center" bgcolor="white">
			
				<table border="0" cellpadding="0" cellspacing="0">
					<tr valign="top">
						<td width="250" align="right">
							
							<div id="iproses1">
								<img src="img/progress-bar.gif" width="100">
							</div>
							
						</td>
						<td width="250" align="center">
							<div id="iproses2">
								<img src="img/progress-bar.gif" width="100">
							</div>			
						</td>
						<td width="250" align="center">
							<div id="iproses3">
								<img src="img/progress-bar.gif" width="100">
							</div>
						</td>
						<td width="250" align="left">
							<div id="iproses4">
								<img src="img/progress-bar.gif" width="100">
								</div>			
						</td>
					</tr>
				</table>
					
			</td>
		</tr>
	</table>



	<div id="iform"></div>
	<div id="ihasil"></div>			

	<div id="iproses" style="display:none">
	<img src="img/progress-bar.gif" width="100" height="16">
	</div>
	



<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");



//diskonek
exit();
?>