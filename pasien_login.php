<?php
session_start();

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/pasien.html");

nocache;

//nilai
$filenya = "pasien_login.php";
$filenyax = "i_pasien_login.php";
$judul = "Pasien Booking Periksa";
$judulku = "[$adm_session] ==> $judul";
$juduli = $judul;






//isi *START
ob_start();


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>




<script>
$(document).ready(function(){
	
	$("#iproses").show();
	$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
	setTimeout('$("#iproses").hide()',1000);
})
</script>




<?php
echo '<h1>'.$judul.'</h1>


<table border="0" cellpadding="3" cellspacing="3" width="1200" height="300" bgcolor="grey">
	<tr valign="top">
		<td width="500">
			
			<div id="iform"></div>
		</td>
		
		<td width="50">
		
		</td>
		
		<td>
		
			<div id="ihasil"></div>			
			
		</td>
	</tr>
</table>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");



//diskonek
exit();
?>