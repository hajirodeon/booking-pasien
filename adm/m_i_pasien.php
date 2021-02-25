<?php
sleep(1);
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "pasien.php";
$filenyax = "m_i_pasien.php";
$judul = "Data Pasien";
$juduli = $judul;


//ambil nilai
$aksi = nosql($_GET['aksi']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika daftar
if ($aksi == "daftar")
	{
	echo '<form name="formx21" id="formx21">';
	
	//tampilkan daftar...
	$qku = mysqli_query($koneksi, "SELECT * FROM pasien ".
							"ORDER BY nama ASC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	
	//jika null
	if (!empty($tku))
		{
		echo '<table border="1" cellpadding="3" cellspacing="3" width="100%" bgcolor="orange">
		<tr bgcolor="'.$warnaheader.'">
			<td width="5">
			&nbsp;
			</td>
			
			
			<td width="50">
			<strong><font color="'.$warnatext.'">NO.RM</strong>
			</td>
			
			<td>
			<strong><font color="'.$warnatext.'">NAMA</strong>
			</td>
			
			<td>
			<strong><font color="'.$warnatext.'">ALAMAT</strong>
			</td>
			
			<td width="50">
			<strong><font color="'.$warnatext.'">TELEPON</strong>
			</td>

			<td width="100">
			<strong><font color="'.$warnatext.'">JENIS BAYAR</strong>
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
			$ku_norm = balikin($rku['no_rm']);
			$ku_nama = balikin($rku['nama']);
			$ku_propinsi = balikin($rku['propinsi']);
			$ku_kabupaten = balikin($rku['kabupaten']);
			$ku_kecamatan = balikin($rku['kecamatan']);
			$ku_alamat = balikin($rku['alamat']);
			$ku_telepon = balikin($rku['telepon']);
			
			
			//jenis bayar
			$qku2 = mysqli_query($koneksi, "SELECT * FROM pasien_jenisbayar ".
									"WHERE kd_pasien = '$ku_kd'");
			$rku2 = mysqli_fetch_assoc($qku2);
			$ku2_jenis_bayar = balikin($rku2['jenis_bayar']);

	
	
	
			//propinsi
			$qku3 = mysqli_query($koneksi, "SELECT * FROM provinsi ".
									"WHERE id_prov = '$ku_propinsi'");
			$rku3 = mysqli_fetch_assoc($qku3);
			$ku_propinsi = balikin($rku3['nama']);
	
			//kabupaten
			$qku3 = mysqli_query($koneksi, "SELECT * FROM kabupaten ".
									"WHERE id_kab = '$ku_kabupaten'");
			$rku3 = mysqli_fetch_assoc($qku3);
			$ku_kabupaten = balikin($rku3['nama']);
	
			//kecamatan
			$qku3 = mysqli_query($koneksi, "SELECT * FROM kecamatan ".
									"WHERE id_kec = '$ku_kecamatan'");
			$rku3 = mysqli_fetch_assoc($qku3);
			$ku_kecamatan = balikin($rku3['nama']);
	
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
					<a href="#" onclick="$(\'#iform\').load(\''.$filenyax.'?aksi=hapus&kd='.$ku_kd.'\');"><img src="'.$sumber.'/img/delete.gif" width="16" height="16" border="0"></a>
				</td>
				<td>
					'.$ku_norm.'
				</td>
				<td>
					'.$ku_nama.'
				</td>
				<td>
					'.$ku_propinsi.', 

					'.$ku_kabupaten.', 

					'.$ku_kecamatan.'
					<br>
					'.$ku_alamat.'
				</td>
				<td>
					'.$ku_telepon.'
				</td>

				
				<td>
					'.$ku2_jenis_bayar.'
				</td>
				
			</tr>';
				
			}
		while ($rku = mysqli_fetch_assoc($qku));
		
		
		echo '</table>';
		}
	
	
	echo '</form>';

	exit();
	}














//jika hapus
if ($aksi == "hapus")
	{
	//ambil nilai
	$kd = trim(cegah($_GET["kd"]));

	
	//hapus
	mysqli_query($koneksi, "DELETE FROM pasien WHERE kd = '$kd'");
	
	//re-direct
	?>
	
	<script>
	$(document).ready(function(){
					
		$("#iproses").show();			
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
		setTimeout('$("#iproses").hide()',1000);

	})
	</script>
		
	<?php
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>