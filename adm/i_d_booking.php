<?php
sleep(1);
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/adm/d_booking.php";
$filenyax = "$sumber/adm/i_d_booking.php";


//ambil nilai
$aksi = nosql($_GET['aksi']);
$norm = nosql($_SESSION['norm']);
$kdku = nosql($_SESSION['kdku']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($aksi == "simpan")
	{
	//kode booking
	$e_kode = nosql($_GET['e_kode']);
		
	//periksa
	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM pasien_periksa ".
							"WHERE kode_booking = '$e_kode' ".
							"AND selesai = 'false'");
	$ryuk2 = mysqli_fetch_assoc($qyuk2);
	$tyuk2 = mysqli_num_rows($qyuk2);
	
	//jika belum digunakan
	if (!empty($tyuk2))
		{
		$yuk2_kd = nosql($ryuk2['kd']);
		$yuk2_pasienkd = nosql($ryuk2['kd_pasien']);
		$yuk2_tgl = $ryuk2['tgl_periksa'];
		$yuk2_poli = balikin($ryuk2['poli_nama']);
	
	
		?>
		
		<script language='javascript'>
		//membuat document jquery
		$(document).ready(function(){
		
	
			$("#btnPROSES<?php echo $yuk2_kd;?>").on('click', function(){
					$("#iprosesku").load("<?php echo $filenyax;?>?aksi=proses&kd=<?php echo $yuk2_kd;?>");					
				});
			
		});
		
		</script>
		
		<?php
		
	
			
		//cek norm
		$qcc = mysqli_query($koneksi, "SELECT * FROM pasien ".
								"WHERE kd = '$yuk2_pasienkd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_norm = nosql($rcc['no_rm']);
		$cc_nama = balikin($rcc['nama']);
		$cc_ide_jenis = balikin($rcc['jenis_identitas']);
		$cc_ide_no = balikin($rcc['no_identitas']);
		$cc_kelurahan = balikin($rcc['kelurahan']);
		$cc_kecamatan = balikin($rcc['kecamatan']);
		$cc_kabupaten = balikin($rcc['kabupaten']);
		$cc_propinsi = balikin($rcc['propinsi']);
	
	
		//detail kecamatan
		$qyuk = mysqli_query($koneksi, "SELECT * FROM kecamatan ".
								"WHERE id_kec = '$cc_kecamatan'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$yuk_kec = balikin($ryuk['nama']);
		
		
		
		
		//detail kabupaten
		$qyuk = mysqli_query($koneksi, "SELECT * FROM kabupaten ".
								"WHERE id_kab = '$cc_kabupaten'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$yuk_kab = balikin($ryuk['nama']);
		
		
		
		//detail provinsi
		$qyuk = mysqli_query($koneksi, "SELECT * FROM provinsi ".
								"WHERE id_prov = '$cc_propinsi'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$yuk_prov = balikin($ryuk['nama']);
		
		
	
			
		echo '<h3>
		Kode Booking : '.$e_kode.' 
		</h3>
		
		<p>
		Tanggal Periksa :
		<br>
		<b>'.$yuk2_tgl.'</b>
		</p>
		
		
		<p>
		Ruangan :
		<br>
		<b>'.$yuk2_poli.'</b>
		</p>
		
		
		<p>
		Nama :
		<br>
		<b>'.$cc_nama.'</b>
		</p>
		
		<p>
		Identitas :
		<br>
		<b>'.$cc_ide_jenis.'. '.$cc_ide_no.'</b>
		</p>
		
		
		<p>
		No.RM :
		<br>
		<b>'.$cc_norm.'</b>
		</p>
		
		<p>
		Alamat :
		<br>
		<b>'.$yuk_kec.', '.$yuk_kab.', '.$yuk_prov.'</b>
		</p>
		
		<hr>
		<input name="btnPROSES'.$yuk2_kd.'" id="btnPROSES'.$yuk2_kd.'" type="button" value="PROSES >>" class="btn btn-danger">
		<hr>
		<div id="iprosesku"></div>';		
		}

	else
		{
		echo '<h3>Kode Booking Sudah Pernah Digunakan...!!</h3>';
		}


	exit();		
	}

	
	
	

	
	
	
	
//jika proses
if ($aksi == "proses")
	{
	//kode booking
	$e_kd = nosql($_GET['kd']);
		
	
	//selesaikan...
	mysqli_query($koneksi, "UPDATE pasien_periksa SET selesai = 'true' ".
					"WHERE kd = '$e_kd'");
					
					
	echo '<font color=red>
	<h3>Berhasil Proses...</h3>
	</font>';
	
	exit();
	}
	
exit();
?>
