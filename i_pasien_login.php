<?php
sleep(1);
session_start();

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");

nocache;

//nilai
$filenya = "pasien_login.php";
$filenyax = "i_pasien_login.php";
$judul = "Booking Periksa";
$juduli = $judul;


//ambil nilai
$aksi = nosql($_GET['aksi']);


//tanggal 
$dateku_now = "$tanggal/$bulan/$tahun";


$dateku = date_create(''.$tahun.'-'.$bulan.'-'.$tanggal.'');
date_add($dateku, date_interval_create_from_date_string('10 days'));
$dateku_batas = date_format($dateku, 'd/m/Y');


$dateku = date_create(''.$tahun.'-'.$bulan.'-'.$tanggal.'');
date_add($dateku, date_interval_create_from_date_string('1 days'));
$dateku_besok = date_format($dateku, 'd/m/Y');




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika 
if ($aksi == "daftar")
	{
	?>
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#btnSMP").on('click', function(){

			$("#formx21").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							$("#iproses").show();			
							$("#ihasil").html(data);
							setTimeout('$("#iproses").hide()',1000);
							}
						});
					return false;
				});
			
		});
		
		
		
		
		
		
		$('#datepickerku').on('changeDate', function() {

	    	$("#e_tglku").val($('#datepickerku').datepicker('getFormattedDate'));

		});
	
	
	
	
		
		var active_dates = [<?php echo $daku_tgl;?>];


		$("#datepickerku").datepicker({
	     format: "dd/mm/yyyy", 
			startDate: "<?php echo $dateku_now;?>",
		    endDate: "<?php echo $dateku_batas;?>", 
	     autoclose: true,
	     todayHighlight: true, 
	     beforeShowDay: function(date){
	         var d = date;
	         var curr_date = d.getDate();
	         var curr_month = d.getMonth() + 1; //Months are zero based
	         var curr_year = d.getFullYear();
	         var formattedDate = curr_date + "/" + curr_month + "/" + curr_year
	
	         if ($.inArray(formattedDate, active_dates) != -1){
	           return {
	              classes: 'activeClass'
	           };
	         }
	      return;
		  }
		});
	

	


			
	});
	
	</script>
	
	

	<form name="formx21" id="formx21">
		

	<table border="0" cellpadding="3" cellspacing="3" width="100%" bgcolor="<?php echo $warna02;?>">
		<tr>
			<td width="200">
				<p>
				NO.RM
				</p>
			</td>	
			
			<td width="10">
				<p>
					:
				</p>
			</td>
			<td>
				<p>			
				<input name="e_norm" id="e_norm" type="text" size="10" value="" class="btn btn-default">
				</p>
			</td>		
		</tr>



		<tr>
			<td>
				<p>
				POLI
				</p>
			</td>	
			
			<td width="10">
				<p>
					:
				</p>
			</td>
			<td>
				<p>			
					<select name="e_poli" id="e_poli" class="btn btn-default">
						<option value="" selected></option>';
						
						<?php
						//jenis bayar
						$qku = mysqli_query($koneksi, "SELECT * FROM m_poli ".
												"ORDER BY nama ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						do
							{
							//nilai
							$ku_kd = nosql($rku['kd']);
							$ku_nama = balikin($rku['nama']);
							
							
							echo '<option value="'.$ku_nama.'">'.$ku_nama.'</option>';
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						?>
						
					</select>

				</p>
			</td>		
		</tr>





		<tr>
			<td>
				<p>
				TANGGAL
				</p>
			</td>	
			
			<td width="10">
				<p>
					:
				</p>
			</td>
			<td>
				<p>			
					<input name="datepickerku" id="datepickerku" type="text" value="<?php echo $tanggal;?>/<?php echo $bulan;?>/<?php echo $tahun;?>">
					<input name="e_tglku" id="e_tglku" type="hidden">
					
				</p>
			</td>		
		</tr>




			
		<tr valign="top">
			<td>

			</td>	
			
			<td>
				
			</td>
			
			<td>
			<input name="btnSMP" id="btnSMP" type="submit" value="BOOKING PERIKSA" class="btn btn-danger">
			
			</td>		
		</tr>



	</table>
	

	
	
	
	</form>
	<?php
	}









//jika simpan entri
if ($aksi == "simpan")
	{
	//ambil nilai
	$e_norm = trim(cegah($_GET["e_norm"]));
	$e_poli = trim(cegah($_GET["e_poli"]));
	$e_tglku = trim(balikin($_GET["e_tglku"]));


	//pecah tanggal
	$pecahku = explode("/", $e_tglku);
	$tg_tgl = trim($pecahku[0]);
	$tg_bln = trim($pecahku[1]);
	$tg_thn = trim($pecahku[2]);
	
	$tgl_booking = "$tg_thn:$tg_bln:$tg_tgl";

	//kode booking
	$booking_kode = "$tanggal$passbaru";
	
	

	//cek
	if ((empty($e_norm)) OR (empty($e_poli)))
		{
		echo "<h3>ENTRI TIDAK LENGKAP</h3>";
		
		exit();
		}
	
	else
		{
		//deteksi pasien
		$qku = mysqli_query($koneksi, "SELECT * FROM pasien ".
								"WHERE no_rm = '$e_norm'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$ku_kd = nosql($rku['kd']);
		$ku_nama = balikin($rku['nama']);
		
		//jika ada
		if (!empty($tku))
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO pasien_periksa(kd, kd_pasien, tgl_periksa, poli_nama, kode_booking, postdate) VALUES ".
							"('$x', '$ku_kd', '$tgl_booking', '$e_poli', '$booking_kode', '$today');");


			//update
			mysqli_query($koneksi, "UPDATE pasien SET kode_booking = '$booking_kode' ".
							"WHERE kd = '$ku_kd'");
		
		
		
			//periksa
			$qyuk2 = mysqli_query($koneksi, "SELECT * FROM pasien_periksa ".
									"WHERE kd_pasien = '$ku_kd' ".
									"ORDER BY postdate DESC");
			$ryuk2 = mysqli_fetch_assoc($qyuk2);
			$yuk2_kd = nosql($ryuk2['kd']);
			$yuk2_tgl = $ryuk2['tgl_periksa'];
			$yuk2_poli = balikin($ryuk2['poli_nama']);
				
						
			//kasi kode boking
			$booking = "$tanggal$passbaru";
			
			//update
			mysqli_query($koneksi, "UPDATE pasien SET kode_booking = '$booking' ".
							"WHERE kd = '$ku_kd'");
		
						
				
			echo '<table border="0" cellpadding="3" cellspacing="3" width="100%">
			<tr valign="top" bgcolor="white">
			<td width="10">
			
			</td>
			<td>
			
			<hr>
			
			<h3>
			Invoice Booking
			</h3>
			
			<p>
			[<a href="i_booking_pdf.php?kd='.$yuk2_kd.'" target="_blank">PRINT PDF</a>]
			</p>
			<hr>

		
			<p>
			<table border="0" cellpadding="3" cellspacing="3" width="500">
			<tr>
			<td>
			Tgl. Periksa 
			</td>
			
			<td>
			: <b>'.$yuk2_tgl.'</b>
			</td>
			</tr>
		
			
			<tr>
			<td>
			Poli 	   	
			</td>
			
			<td>
			: 	<b>'.$yuk2_poli.'</b>
			</td>
			</tr>
				
			
			</table>
			
		
			</p>
		
		
			<p>
			Silahkan melakukan Verifikasi:
			<br>
			KODE BOOKING ANDA
			<br>
			<h3>'.$booking.'</h3>
			</p>
			<br>
			<br>
		
			
			<p>
			Waktu verifikasi
			<br>
			Pagi hingga pukul 09.00 WIB, selanjutnya jika anda mengalami keterlambatan ,dapat mengikuti prosedur pendaftaran lagi.
			</p>
			
			<p>
			Mohon Catat kode BOOKING ANDA sebagai bukti anda melakukan pendaftaran Online.
			</p>

			
			
			</td>
			<td width="10">
			</td>
			
			</tr>
			
			</table>';
					 	
			}
		else
			{
			echo '<table border="1" cellpadding="3" cellspacing="3" width="300" bgcolor="orange">
			<tr>
			<td>
			<font color="red">
			<h3>NO.RM Tidak Ditemukan...</h3>
			Silahkan Coba Lagi...
			</font>
			
			</td>
			</tr>
			</table>';				
			}
		
							
		exit();
		}
	

	exit();
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>