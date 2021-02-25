<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/adm.php");
$tpl = LoadTpl("../template/admin.html");

nocache;

//nilai
$filenya = "m_kerja.php";
$filenyax = "m_i_kerja.php";
$judul = "Data Pekerjaan";
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


<table border="1" cellpadding="3" cellspacing="3" width="1200" height="300" bgcolor="grey">
	<tr valign="top">
		<td>
			
			<div id="ihasil"></div>			
			
			<div id="iform"></div>
		</td>
	</tr>
</table>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");



//diskonek
exit();
?>