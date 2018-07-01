<?php
sleep(1);
session_start();

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/i_ttg_kami.php";
$filenyax = "$sumber/i_ttg_kami_post.php";
$judul = "Tentang Kami";
$juduli = $judul;



//ambil nilai
$aksi = nosql($_GET['aksi']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan entri
if ($aksi == "simpan")
	{
	//ambil nilai
	$e_nama = trim(cegah($_GET["e_nama"]));
	$e_alamat = trim(cegah($_GET["e_alamat"]));
	$e_email = trim(cegah($_GET["e_email"]));
	$e_telp = trim(cegah($_GET["e_telp"]));
	$e_isi = trim(cegah($_GET["e_isi"]));


	//echo "$e_nama, $e_alamat, $e_email, $e_telp, $e_isi";

	//cek
	if ((empty($e_nama)) OR (empty($e_email)) OR (empty($e_isi)))
		{
		echo "<h3>ENTRI TIDAK LENGKAP</h3>";
		
		exit();
		}
	
	else
		{
		if ($_SESSION['cekya'] != $e_nama)
			{
			//insert
			mysql_query("INSERT INTO bukutamu(kd, nama, alamat, telp, email, isi, postdate) VALUES ".
							"('$x', '$e_nama', '$e_alamat', '$e_telp', '$e_email', '$e_isi', '$today');");
	
					
			echo "<h3>Terima Kasih, Telah Menghubungi Kami</h3>";

			
			//bikin sesi deteksi, biar gak dobel
			$_SESSION['cekya'] = $e_nama;
			}
		
		
		exit();
		}


	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>