<?php
session_start();

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/adm.php");
$tpl = LoadTpl("../template/admin.html");

nocache;

//nilai
$filenya = "d_booking.php";
$filenyax = "i_d_booking.php";
$judul = "Data Booking";
$judulku = "$judul  [$adm_session]";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();

//js
require("../inc/js/jumpmenu.js");
require("../inc/js/checkall.js");
require("../inc/js/swap.js");



//jika null
if ((empty($utgl)) AND (empty($ubln)) AND (empty($uthn)))
	{
	$ke = "$filenya?uthn=$tahun&ubln=$bulan&utgl=$tanggal";
	xloc($ke);
	exit();
	}





//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<h1>'.$judul.'</h1>';

echo "<select name=\"uthnx\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-info\">";
echo '<option value="'.$uthn.'">'.$uthn.'</option>';
for ($j=$tahun;$j<=($tahun+1);$j++)
	{
	echo '<option value="'.$filenya.'?uthn='.$j.'">'.$j.'</option>';
	}

echo '</select>, ';

echo "<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-info\">";


$nilbln = $arrbln[$ubln];

//jika null
if (empty($nilbln))
	{
	$nilbln = $arrbln1[$ubln]; 
	}

echo '<option value="'.$ubln.'">'.$nilbln.'</option>';
for ($i=1;$i<=12;$i++)
	{
	echo '<option value="'.$filenya.'?uthn='.$uthn.'&ubln='.$i.'">'.$arrbln[$i].'</option>';
	}
echo '</select>, ';

echo "<select name=\"utglx\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-info\">";
echo '<option value="'.$utgl.'">'.$utgl.'</option>';
for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$filenya.'?uthn='.$uthn.'&ubln='.$ubln.'&utgl='.$i.'">'.$i.'</option>';
	}
echo '</select>';




//cek
if ((empty($utgl)) OR (empty($ubln)) OR (empty($uthn)))
	{
	echo '<p>
	<font color="red">
	<b>Pilih Dahulu Tanggal...!!</b>
	</font>
	</p>';
	}
else
	{
	?>
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	

		$("#btnKRM").on('click', function(){
			$("#formx").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){			
							$("#ihasil").html(data);
							}
						});
					return false;
				});
			
			});
		


			
	});
	
	</script>
	
	<?php
	
	echo '<form name="formx" id="formx">
	
	<table border="0" cellpadding="3" cellspacing="3" width="1200">
	<tr valign="top">
	<td width="700">';
	
	//tampilkan daftar...
	$qku = mysql_query("SELECT * FROM m_poli ".
							"ORDER BY nama ASC");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);
	
	echo '<table border="1" cellpadding="3" cellspacing="3" width="600" bgcolor="orange">
	<tr bgcolor="'.$warnaheader.'">
		<td>
		<strong><font color="'.$warnatext.'">NAMA POLI</strong>
		</td>			
		
		<td width="100">
		<strong><font color="'.$warnatext.'">Total Booking</strong>
		</td>
		
		<td width="100">
		<strong><font color="'.$warnatext.'">Booking Selesai</strong>
		</td>
	</tr>';
	

	do
		{
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

			
		//nilai
		$ku_kd = nosql($rku['kd']);
		$ku_nama = balikin($rku['nama']);
		
		
		
		//ketahui jumlah...
		$qyuk = mysql_query("SELECT * FROM pasien_periksa ".
								"WHERE poli_nama = '$ku_nama' ".	
								"AND round(DATE_FORMAT(tgl_periksa, '%d')) = '$utgl' ".
								"AND round(DATE_FORMAT(tgl_periksa, '%m')) = '$ubln' ".
								"AND round(DATE_FORMAT(tgl_periksa, '%Y')) = '$uthn'");
		$tyuk = mysql_num_rows($qyuk);





		//ketahui jumlah... selesai
		$qyuk2 = mysql_query("SELECT * FROM pasien_periksa ".
								"WHERE poli_nama = '$ku_nama' ".	
								"AND round(DATE_FORMAT(tgl_periksa, '%d')) = '$utgl' ".
								"AND round(DATE_FORMAT(tgl_periksa, '%m')) = '$ubln' ".
								"AND round(DATE_FORMAT(tgl_periksa, '%Y')) = '$uthn' ".
								"AND selesai = 'true'");
		$tyuk2 = mysql_num_rows($qyuk2);




		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
				'.$ku_nama.'
			</td>
			
			<td>'.$tyuk.'</td>
			
			<td>'.$tyuk2.'</td>
			

		</tr>';
			
		}
	while ($rku = mysql_fetch_assoc($qku));
	
	
	echo '</table>
	
	
	
	</td>
	<td>
	
	
	
	<table border="1" cellpadding="3" cellspacing="3">
	<tr valign="top">
	<td width="100%">
	<h3>Cek Kode Booking</h3>
	
	
	<input name="e_kode" id="e_kode" type="text" size="20" value="" class="btn btn-info">
	<input name="btnKRM" id="btnKRM" type="submit" value="LANJUT >>" class="btn btn-danger">
	
	<div id="ihasil"></div>
	
	</td>
	</tr>
	</table>
	
	
	</td>
	
	</tr>
	
	</table>';

	

	echo '</form>';
	}

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