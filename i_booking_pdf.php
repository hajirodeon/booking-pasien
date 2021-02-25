<?php
//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/booking.php");

nocache;

//nilai
$kd = nosql($_REQUEST['kd']);



//start class
$pdf=new PDF('P','mm','F8');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle($judul);
$pdf->SetAuthor($author);
$pdf->SetSubject($description);
$pdf->SetKeywords($keywords);






//periksa
$qyuk2 = mysqli_query($koneksi, "SELECT * FROM pasien_periksa ".
						"WHERE kd = '$kd' ".
						"ORDER BY postdate DESC");
$ryuk2 = mysqli_fetch_assoc($qyuk2);
$yuk2_pasienkd = nosql($ryuk2['kd_pasien']);
$yuk2_tgl = $ryuk2['tgl_periksa'];
$yuk2_kode = balikin($ryuk2['kode_booking']);
$yuk2_poli = balikin($ryuk2['poli_nama']);
	



//pasien
$qyuk = mysqli_query($koneksi, "SELECT * FROM pasien ".
						"WHERE kd = '$yuk2_pasienkd'");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_nama = balikin($ryuk['nama']);






$pdf->Cell(60,60,'',1,0,'L');



$pdf-> Image('img/logo.png',11,11,10);


$pdf->SetY(10);
$pdf->SetFont('Times','B',12);
$pdf->Cell(60,12,''.$nama_rs.'',1,0,'R');


//set posisi
$pdf->SetY(22);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,5,'Tgl. Periksa',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$yuk2_tgl.'',0,0,'L');
$pdf->Ln();


$pdf->SetFont('Times','',10);
$pdf->Cell(20,5,'Nama',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$yuk_nama.'',0,0,'L');
$pdf->Ln();


$pdf->SetFont('Times','',10);
$pdf->Cell(20,5,'Ruangan',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$yuk2_poli.'',0,0,'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Cell(30,5,'Silahkan Verifikasi',0,0,'L');
$pdf->Ln();
$pdf->SetFont('Times','',12);
$pdf->Cell(30,5,'KODE BOOKING',0,0,'L');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Times','B',20);
$pdf->Cell(30,5,''.$yuk2_kode.'',0,0,'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();




//output-kan ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Output("booking_$yuk2_kode.pdf",I);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>