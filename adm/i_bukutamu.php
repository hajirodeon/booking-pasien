<?php
sleep(1);
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "bukutamu.php";
$filenyax = "i_bukutamu.php";
$judul = "Data Buku Tamu";
$juduli = $judul;


//ambil nilai
$aksi = nosql($_GET['aksi']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika daftar
if ($aksi == "daftar")
	{
	echo '<form name="formx21" id="formx21">';
	
	//tampilkan daftar...
	$qku = mysql_query("SELECT * FROM bukutamu ".
							"ORDER BY postdate DESC");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);
	
	//jika null
	if (!empty($tku))
		{
		echo '<table border="1" cellpadding="3" cellspacing="3" width="100%" bgcolor="orange">
		<tr bgcolor="'.$warnaheader.'">
			<td width="100">
			<strong><font color="'.$warnatext.'">POSTDATE</strong>
			</td>

			<td width="100">
			<strong><font color="'.$warnatext.'">NAMA</strong>
			</td>
			
			<td width="200">
			<strong><font color="'.$warnatext.'">ALAMAT</strong>
			</td>
			
			<td width="100">
			<strong><font color="'.$warnatext.'">TELEPON</strong>
			</td>
			
			<td width="100">
			<strong><font color="'.$warnatext.'">EMAIL</strong>
			</td>
			
			<td>
			<strong><font color="'.$warnatext.'">ISI BANTUAN / SARAN / KRITIK</strong>
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
			$ku_postdate = $rku['postdate'];
			$ku_nama = balikin($rku['nama']);
			$ku_alamat = balikin($rku['alamat']);
			$ku_telp = balikin($rku['telp']);
			$ku_email = balikin($rku['email']);
			$ku_isi = balikin($rku['isi']);

			

	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$ku_postdate.'</td>
			<td>'.$ku_nama.'</td>
			<td>'.$ku_alamat.'</td>
			<td>'.$ku_email.'</td>
			<td>'.$ku_telp.'</td>
			<td>'.$ku_isi.'</td>
			</tr>';
				
			}
		while ($rku = mysql_fetch_assoc($qku));
		
		
		echo '</table>';
		}
	
	
	echo '</form>';

	exit();
	}










/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>