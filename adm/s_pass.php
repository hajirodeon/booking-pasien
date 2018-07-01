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
$filenya = "s_pass.php";
$filenyax = "s_i_pass.php";
$judul = "Ganti Password";
$judulku = "[$adm_session] ==> $judul";
$juduli = $judul;






//isi *START
ob_start();


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>



<script>
$(document).ready(function(){


$(document).ajaxStart(function() 
	{
	$('#iproses').show();
	}).ajaxStop(function() 
	{
	$('#iproses').hide();
	});





$("#iform").load("<?php echo $sumber;?>/adm/<?php echo $filenyax;?>?aksi=form");



})
</script>



<?php
echo '<h1>'.$judul.'</h1>



<div id="ihasil"></div>


<div id="iproses" style="display:none">
<img src="'.$sumber.'/img/progress-bar.gif" width="100" height="16">
</div>

<div id="iform">

<img src="'.$sumber.'/img/progress-bar.gif" width="100" height="16">
</div>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");



//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>