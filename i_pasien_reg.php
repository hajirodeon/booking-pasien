<?php
sleep(1);
session_start();

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/pasien_reg.php";
$filenyax = "$sumber/i_pasien_reg.php";
$judul = "Formulir Pendaftaran Online";
$juduli = $judul;


//tanggal 
$dateku_now = "$tanggal/$bulan/$tahun";


$dateku = date_create(''.$tahun.'-'.$bulan.'-'.$tanggal.'');
date_add($dateku, date_interval_create_from_date_string('10 days'));
$dateku_batas = date_format($dateku, 'd/m/Y');


$dateku = date_create(''.$tahun.'-'.$bulan.'-'.$tanggal.'');
date_add($dateku, date_interval_create_from_date_string('1 days'));
$dateku_besok = date_format($dateku, 'd/m/Y');





//ambil nilai
$aksi = nosql($_GET['aksi']);
$norm = nosql($_SESSION['norm']);
$kdku = nosql($_SESSION['kdku']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika daftar1
if ($aksi == "daftar")
	{
	$kdku = nosql($_SESSION['kdku']);
	
	
	//jika null, bikin sesi
	if (empty($kdku))
		{
		//bikin session
		$_SESSION['kdku'] = $x;
		}
	
	
	
	$kdku = nosql($_SESSION['kdku']);
	?>
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	$("#e_tgl_lahir").datepicker();
	
	
	<?php
	//jika selesai
	if (!empty($_SESSION['selesai']))
		{
		?>
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar4");
		<?php
		}
	else
		{
		?>
	
	
		$("#btnSMP").on('click', function(){

			$("#formx21").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							$("#iproses").show();			
							$("#ihasil1").html(data);
							setTimeout('$("#iproses").hide()',1000);
							
							
							$("#iform").load("<?php echo $filenyax;?>?aksi=daftar2");
							
							$('.myimage2').attr('src', 'img/proses21.png');
							$('.myimage1').attr('src', 'img/proses1.png');
							$('.myimage3').attr('src', 'img/proses3.png');
							$('.myimage4').attr('src', 'img/proses4.png');
							}
						});
					return false;
				});
			
			});
		
		
		
		
		
				
		
		$('#provinsi').change(function() { 
		     var provinsi = $(this).val(); 
		     $.ajax({
		            type: 'POST', 
		          url: 'i_alamat.php', 
		         data: 'id_provinsi=' + provinsi, 
		         success: function(response) { 
		              $('#kabupaten').html(response);
		            }
		       });
		    });
		 
		
		
		
		$('#kabupaten').change(function() { 
		     var kabupaten = $(this).val(); 
		     $.ajax({
		            type: 'POST', 
		          url: 'i_alamat.php', 
		         data: 'id_kabupaten=' + kabupaten, 
		         success: function(response) { 
		              $('#kecamatan').html(response);
		            }
		       });
		    });
		
		<?php
		}
		?>








		
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
	
	<?php
	//detail edit..
	$qpok = mysqli_query($koneksi, "SELECT * FROM pasien ".
							"WHERE kd = '$kdku'");
	$rpok = mysqli_fetch_assoc($qpok);
	$pok_nama = balikin($rpok['nama']);
	$pok_alamat_jalan = balikin($rpok['alamat_jalan']);
	$pok_alamat_rt = balikin($rpok['alamat_rt']);
	$pok_alamat_rw = balikin($rpok['alamat_rw']);
	$pok_alamat_kodepos = balikin($rpok['alamat_kodepos']);
	$pok_propinsi = balikin($rpok['propinsi']);
	$pok_kabupaten = balikin($rpok['kabupaten']);
	$pok_kecamatan = balikin($rpok['kecamatan']);
	$pok_kelurahan = balikin($rpok['kelurahan']);
	$pok_tmp_lahir = balikin($rpok['tmp_lahir']);
	$pok_tgl_lahir = balikin($rpok['tgl_lahir']);
	$pok_title = balikin($rpok['title']);
	$pok_kelamin = balikin($rpok['kelamin']);



	//propinsi
	$query = mysqli_query($koneksi, "SELECT * FROM provinsi ".
							"WHERE id_prov = '$pok_propinsi'");
	$row = mysqli_fetch_assoc($query);
	$pok_propinsi = balikin($row['nama']);





	//kabupaten
	$query = mysqli_query($koneksi, "SELECT * FROM kabupaten ".
							"WHERE id_kab = '$pok_kabupaten'");
	$row = mysqli_fetch_assoc($query);
	$pok_kabupaten = balikin($row['nama']);



	//kecamatan
	$query = mysqli_query($koneksi, "SELECT * FROM kecamatan ".
							"WHERE id_kec = '$pok_kecamatan'");
	$row = mysqli_fetch_assoc($query);
	$pok_kecamatan = balikin($row['nama']);







	//pecah
	$pecahku = explode("-", $pok_tgl_lahir);
	$lahir_thn = $pecahku[0];
	$lahir_bln = $pecahku[1];
	$lahir_tgl = $pecahku[2];
	
	//jika null
	if ($lahir_thn == "0000")
		{
		$pok_tgl_lahir = "$tanggal/$bulan/$tahun";			
		}
	else
		{
		$pok_tgl_lahir = "$lahir_tgl/$lahir_bln/$lahir_thn";
		}
	

	

	//periksa	
	$qpok2 = mysqli_query($koneksi, "SELECT * FROM pasien_periksa ".
							"WHERE kd_pasien = '$kdku'");
	$rpok2 = mysqli_fetch_assoc($qpok2);
	$pok2_tgl_periksa = $rpok2['tgl_periksa'];
	$pok2_poli_nama = balikin($rpok2['poli_nama']);



	//pecah
	$pecahku = explode("-", $pok2_tgl_periksa);
	$book_thn = $pecahku[0];
	$book_bln = $pecahku[1];
	$book_tgl = $pecahku[2];
	
	//jika null
	if ($book_thn == "0000")
		{
		$book_tgl2 = "$tanggal/$bulan/$tahun";			
		}
	else
		{
		$book_tgl2 = "$book_tgl/$book_bln/$book_thn";
		}
	
	
	
	?>	

	<form name="formx21" id="formx21">
		
	<table border="0" cellpadding="3" cellspacing="3" width="100%">
	<tr valign="top" bgcolor="white">
	<td width="10">
	
	</td>
	<td>
	
	<hr>
	
	<table border="0" cellpadding="3" cellspacing="3" width="100%">
		<tr valign="top">
			<td width="550" bgcolor="white">

				<h3>
					BOOKING PERIKSA
				</h3>		
				<table border="0" cellpadding="3" cellspacing="3" width="100%" bgcolor="<?php echo $warna02;?>">
					<tr>
						<td width="100">
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
								<select name="e_poli" id="e_poli" class="btn btn-info">
									<option value="<?php echo $pok2_poli_nama;?>" selected><?php echo $pok2_poli_nama;?></option>';
									
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
						<td width="100">
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
								<input name="datepickerku" id="datepickerku" type="text" value="<?php echo $book_tgl2;?>" class="btn btn-info">
								<input name="e_tglku" id="e_tglku" type="hidden">
								
							</p>
						</td>		
					</tr>
			

				</table>
				<hr>
				
				<h3>DATA DIRI PASIEN</h3>
	
				<p>
				Title :
					<br>
					<select name="e_title" id="e_title" class="btn btn-info">
					<option value="<?php echo $pok_title;?>" selected>- <?php echo $pok_title;?> -</option>
					<option value="Bapak">Bapak</option>
					<option value="Ibu">Ibu</option>
					<option value="Saudara">Saudara</option>
					<option value="Saudari">Saudari</option>
					</select>
					
				</p>

				<p>
				Nama :
				<br>
				<input name="e_nama" id="e_nama" type="text" size="30" value="<?php echo $pok_nama;?>" class="btn btn-info">
				</p>

				<p>
				Tempat, Tanggal Lahir : 
				<br>
				<input name="e_tmp_lahir" id="e_tmp_lahir" type="text" size="20" value="<?php echo $pok_tmp_lahir;?>" class="btn btn-info">, 
				
				
				<input name="e_tgl_lahir" id="e_tgl_lahir" type="text" size="10" value="<?php echo $pok_tgl_lahir;?>" class="btn btn-info">
				</p>

				<p>
				Jenis Kelamin : 
					<br>
					<select name="e_kelamin" id="e_kelamin" class="btn btn-info">
					<option value="<?php echo $pok_kelamin;?>" selected>- <?php echo $pok_kelamin;?> -</option>
					<option value="L">Laki - Laki</option>
					<option value="P">Perempuan</option>
					</select>
					
				</p>
			</td>		


			<td width="50">
				
			</td>

			<td bgcolor="white">
				<h3>DATA TEMPAT TINGGAL PASIEN</h3>
				<p>
				Propinsi : 
				<br>			
				<?php
					//Dapatkan semua 
					$query = mysqli_query($koneksi, "SELECT * FROM provinsi ".
											"ORDER BY nama ASC");
					$row = mysqli_fetch_assoc($query);
					?>
					
					<select name="provinsi" id="provinsi" class="btn btn-info">
					<option value="<?php echo $pok_propinsi;?>">- <?php echo $pok_propinsi;?> -</option>
					        <?php
					            do
					            	{
					            	$r_idprov = nosql($row['id_prov']);
									$r_nama = balikin($row['nama']);
									 
					                echo '<option value="'.$r_idprov.'">'.$r_nama.'</option>';
									}
								while ($row = mysqli_fetch_assoc($query));
					        ?>
					</select>
					</p>
					
					
					<p>
					Kabupaten / Kota :
					<br>
					<select name="kabupaten" id="kabupaten" class="btn btn-info">
					<option value="<?php echo $pok_kabupaten;?>">- <?php echo $pok_kabupaten;?> -</option>
					</select>
					</p>
					
					<p>
					Kecamatan :
					<br>
					<select name="kecamatan" id="kecamatan" class="btn btn-info">
					<option value="<?php echo $pok_kecamatan;?>">- <?php echo $pok_kecamatan;?> -</option>
					</select>
					</p>

				<p>
				Kelurahan :
				<br> 
				<input name="e_kelurahan" id="e_kelurahan" type="text" size="10" value="<?php echo $pok_kelurahan;?>" class="btn btn-info">
				</p>
				
				<p>
				Jalan : 
				<br>
				<input name="e_alamat_jalan" id="e_alamat_jalan" type="text" size="50" value="<?php echo $pok_alamat_jalan;?>" class="btn btn-info">
				</p>
				
				
				<p>
				RT/RW : 
				<br>
				<input name="e_alamat_rt" id="e_alamat_rt" type="text" size="5" value="<?php echo $pok_alamat_rt;?>" class="btn btn-info">
				/
				<input name="e_alamat_rw" id="e_alamat_rw" type="text" size="5" value="<?php echo $pok_alamat_rw;?>" class="btn btn-info">
				</p>
				
				<p>
				Kode Pos :
				<br> 
				<input name="e_kodepos" id="e_kodepos" type="text" size="5" value="<?php echo $pok_alamat_kodepos;?>" class="btn btn-info">
				</p>
			</td>		
		</tr>


	</table>
	
	
	<hr>
	
	<table border="0" cellpadding="3" cellspacing="3" width="100%">
		<tr valign="top">
			<td align="right">

				<input name="btnSMP" id="btnSMP" type="submit" value="SELANJUTNYA >>" class="btn btn-danger">
			</td>
		</tr>
	</table>
	<hr>
	
	
	</td>
	
	<td width="10">
	
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
	$e_nama = trim(cegah($_GET["e_nama"]));
	$e_provinsi = trim(cegah($_GET["provinsi"]));
	$e_kabupaten = trim(cegah($_GET["kabupaten"]));
	$e_kecamatan = trim(cegah($_GET["kecamatan"]));
	$e_kelurahan = trim(cegah($_GET["e_kelurahan"]));
	$e_alamat = trim(cegah($_GET["e_alamat_jalan"]));
	$e_alamat_rt = trim(cegah($_GET["e_alamat_rt"]));
	$e_alamat_rw = trim(cegah($_GET["e_alamat_rw"]));
	$e_kodepos = trim(cegah($_GET["e_kodepos"]));
	$e_tmp_lahir = trim(cegah($_GET["e_tmp_lahir"]));
	$e_title = trim(cegah($_GET["e_title"]));
	$e_kelamin = trim(cegah($_GET["e_kelamin"]));
	$e_tgl_lahir = trim(cegah($_GET["e_tgl_lahir"]));

	
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
	$booking_kode = $passbaru;
	
	
	
	
	//pecah tanggal
	$e_tgl2 = balikin($e_tgl_lahir);
	
	$pecahku = explode("/", $e_tgl2);
	$e_tgl2_bln = $pecahku[0];
	$e_tgl2_tgl = $pecahku[1];
	$e_tgl2_thn = $pecahku[2];
	
	$e_tgl_lahir = "$e_tgl2_thn:$e_tgl2_bln:$e_tgl2_tgl"; 
	
	
	
	
	
	//ambil sesi
	$kdku = nosql($_SESSION['kdku']);


	//cek
	if ((empty($e_alamat)) OR (empty($e_nama)) OR (empty($e_tgl_lahir)))
		{
		echo "<h3>ENTRI TIDAK LENGKAP</h3>";
		
		exit();
		}
	
	else
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM m_pasien ".
								"WHERE kd = '$kdku'");
		$tcc = mysqli_num_rows($qcc);
		
		//jika null
		if (empty($tcc))
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO pasien(kd, nama, alamat_jalan, alamat_rt, alamat_rw, alamat_kodepos, propinsi, kabupaten, kecamatan, ".
							"kelurahan, tmp_lahir, tgl_lahir, title, kelamin, postdate) VALUES ".
							"('$kdku', '$e_nama', '$e_alamat', '$e_alamat_rt', '$e_alamat_rw', '$e_kodepos', '$e_provinsi', '$e_kabupaten', '$e_kecamatan', ".
							"'$e_kelurahan', '$e_tmp_lahir', '$e_tgl_lahir', '$e_title', '$e_kelamin', '$today');");
			}
			
		else
			{
			//update			
			mysqli_query($koneksi, "UPDATE pasien SET nama = '$e_nama', ".
							"alamat_jalan = '$e_alamat', ".
							"alamat_rt = '$e_alamat_rt', ".
							"alamat_rw = '$e_alamat_rw', ".
							"alamat_kodepos = '$e_kodepos', ".
							"propinsi = '$e_provinsi', ".
							"kabupaten = '$e_kabupaten', ".
							"kecamatan = '$e_kecamatan', ".
							"kelurahan = '$e_kelurahan', ".
							"tmp_lahir = '$e_tmp_lahir', ".
							"tgl_lahir = '$e_tgl_lahir', ".
							"title = '$e_title', ".
							"kelamin = '$e_kelamin', ".
							"postdate = '$today' ".
							"WHERE kd = '$kdku'");	
			}	
			
	
	
			//insert
		mysqli_query($koneksi, "INSERT INTO pasien_periksa(kd, kd_pasien, tgl_periksa, poli_nama, kode_booking, postdate) VALUES ".
						"('$x', '$kdku', '$tgl_booking', '$e_poli', '$booking_kode', '$today');");

	
			//update
		mysqli_query($koneksi, "UPDATE pasien SET kode_booking = '$booking_kode' ".
						"WHERE kd = '$kdku'");
	
			
		
		echo "<font color=red>
		<b>ENTRI BERHASIL</b>
		</font>";

		
		exit();
		}
	

	exit();
	}




















//jika daftar2
if ($aksi == "daftar2")
	{
	//ambil sesi
	$kdku = nosql($_SESSION['kdku']);


	?>
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	
	<?php
	//jika selesai
	if (!empty($_SESSION['selesai']))
		{
		?>
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar4");
		<?php
		}
	
	else
		{
	?>
	
		$("#btnSMP2").on('click', function(){

			$("#formx22").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan2",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							$("#iproses").show();			
							$("#ihasil2").html(data);
							setTimeout('$("#iproses").hide()',1000);
							
							
							$("#iform").load("<?php echo $filenyax;?>?aksi=daftar3");
							
							$('.myimage3').attr('src', 'img/proses31.png');
							$('.myimage2').attr('src', 'img/proses2.png');
							$('.myimage1').attr('src', 'img/proses1.png');
							$('.myimage4').attr('src', 'img/proses4.png');
							}
						});
					return false;
				});
			
		});
		
		


	
		$("#btnBACK").on('click', function(){
			$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
			
			$('.myimage1').attr('src', 'img/proses11.png');
			$('.myimage2').attr('src', 'img/proses2.png');
			$('.myimage3').attr('src', 'img/proses3.png');
			$('.myimage4').attr('src', 'img/proses4.png');
		});
		


		

	
		
		$('#provinsi2').change(function() { 
		     var provinsi = $(this).val(); 
		     $.ajax({
		            type: 'POST', 
		          url: 'i_alamat.php', 
		         data: 'id_provinsi=' + provinsi, 
		         success: function(response) { 
		              $('#kabupaten2').html(response);
		            }
		       });
		    });
		 
		
		
		
		$('#kabupaten2').change(function() { 
		     var kabupaten = $(this).val(); 
		     $.ajax({
		            type: 'POST', 
		          url: 'i_alamat.php', 
		         data: 'id_kabupaten=' + kabupaten, 
		         success: function(response) { 
		              $('#kecamatan2').html(response);
		            }
		       });
		    });
		


	<?php
		}
	?>




			
	});
	
	</script>
	
	

	<form name="formx22" id="formx22">
		
	<?php
	//detail..
	$qyuk = mysqli_query($koneksi, "SELECT * FROM pasien ".
							"WHERE kd = '$kdku'");
	$ryuk = mysqli_fetch_assoc($qyuk);	
	$yuk_jenis_identitas = balikin($ryuk['jenis_identitas']);
	$yuk_no_identitas = balikin($ryuk['no_identitas']);
	$yuk_agama = balikin($ryuk['agama']);
	$yuk_telepon = balikin($ryuk['telepon']);
	$yuk_email = balikin($ryuk['email']);
	$yuk_pendidikan = balikin($ryuk['pendidikan']);
	$yuk_pekerjaan = balikin($ryuk['pekerjaan']);
	$yuk_suku = balikin($ryuk['suku']);
	$yuk_rhesus = balikin($ryuk['rhesus']);
	$yuk_warga_negara = balikin($ryuk['warga_negara']);
	$yuk_gol_darah = balikin($ryuk['gol_darah']);
	$yuk_status_nikah = balikin($ryuk['status_nikah']);




	//keluarga
	$qjuk = mysqli_query($koneksi, "SELECT * FROM pasien_keluarga ".
							"WHERE kd_pasien = '$kdku'");
	$rjuk = mysqli_fetch_assoc($qjuk);
	$juk_nama_ayah = balikin($rjuk['nama_ayah']);
	$juk_nama_ibu = balikin($rjuk['nama_ibu']);
	$juk_nama_keluarga = balikin($rjuk['nama_keluarga']);
	$juk_nama_pasangan = balikin($rjuk['nama_pasangan']);
	$juk_propinsi = balikin($rjuk['propinsi']);
	$juk_kabupaten = balikin($rjuk['kabupaten']);
	$juk_kecamatan = balikin($rjuk['kecamatan']);
	$juk_kelurahan = balikin($rjuk['kelurahan']);
	$juk_alamat_jalan = balikin($rjuk['alamat_jalan']);
	$juk_alamat_rt = balikin($rjuk['alamat_rt']);
	$juk_alamat_rw = balikin($rjuk['alamat_rw']);
	$juk_alamat_kodepos = balikin($rjuk['alamat_kodepos']);





	//propinsi
	$query = mysqli_query($koneksi, "SELECT * FROM provinsi ".
							"WHERE id_prov = '$juk_propinsi'");
	$row = mysqli_fetch_assoc($query);
	$juk_propinsi = balikin($row['nama']);





	//kabupaten
	$query = mysqli_query($koneksi, "SELECT * FROM kabupaten ".
							"WHERE id_kab = '$juk_kabupaten'");
	$row = mysqli_fetch_assoc($query);
	$juk_kabupaten = balikin($row['nama']);



	//kecamatan
	$query = mysqli_query($koneksi, "SELECT * FROM kecamatan ".
							"WHERE id_kec = '$juk_kecamatan'");
	$row = mysqli_fetch_assoc($query);
	$juk_kecamatan = balikin($row['nama']);


	
	
	?>
	<table border="0" cellpadding="3" cellspacing="3" width="100%">
	<tr valign="top" bgcolor="white">
	<td width="10">
	
	</td>
	<td>
	
	<hr>		

	<table border="0" cellpadding="3" cellspacing="3" width="100%">
		<tr valign="top" bgcolor="white">
			<td width="500">
				<h3>DATA LENGKAP PASIEN</h3>
				<p>
				Nomor Identitas :
				<br>
				<select name="e_jenis" id="e_jenis" class="btn btn-info">
					<option value="<?php echo $yuk_jenis_identitas;?>" selected>- <?php echo $yuk_jenis_identitas;?> -</option>
					<option value="KTP">KTP</option>
					<option value="SIM">SIM</option>
					</select>, 

				<input name="e_jenis_no" id="e_jenis_no" type="text" size="20" value="<?php echo $yuk_no_identitas;?>" class="btn btn-info">
				</p>

				<p>
				Agama :
				<br>
				<select name="e_agama" id="e_agama" class="btn btn-info">
					<option value="<?php echo $yuk_agama;?>" selected>- <?php echo $yuk_agama;?> -</option>
					
					<?php 
					//daftar agama
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_agama ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						$yuk_kd = nosql($ryuk['kd']);
						$yuk_nama = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

					?>
					</select>
				</p>



				<p>
				Nomor Telepon :
				<br>
				<input name="e_telp" id="e_telp" type="text" size="20" value="<?php echo $yuk_telepon;?>" class="btn btn-info">
				</p>



				<p>
				E-Mail : 
				<br>
				<input name="e_email" id="e_email" type="text" size="20" value="<?php echo $yuk_email;?>" class="btn btn-info">
				</p>



				<p>
				Pendidikan : 
				<br>
				<select name="e_pddkn" id="e_pddkn" class="btn btn-info">
					<option value="<?php echo $yuk_pendidikan;?>" selected>- <?php echo $yuk_pendidikan;?> -</option>
					
					
					<?php 
					//daftar 
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pendidikan ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						$yuk_kd = nosql($ryuk['kd']);
						$yuk_nama = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

					?>
					</select>
				</p>


				<p>
				Pekerjaan : 
				<br>
				<select name="e_pekerjaan" id="e_pekerjaan" class="btn btn-info">
					<option value="<?php echo $yuk_pekerjaan;?>" selected>- <?php echo $yuk_pekerjaan;?> -</option>

					<?php 
					//daftar 
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pekerjaan ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						$yuk_kd = nosql($ryuk['kd']);
						$yuk_nama = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

					?>
					</select>
				</p>


				<p>
				Suku : 
				<br>
				<select name="e_suku" id="e_suku" class="btn btn-info">
					<option value="<?php echo $yuk_suku;?>" selected>- <?php echo $yuk_suku;?> -</option>
					
					
					<?php 
					//daftar 
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_suku ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						$yuk_kd = nosql($ryuk['kd']);
						$yuk_nama = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

					?>
					
					</select>
				</p>


				<p>
				Rhesus : 
				<br>
				<select name="e_rhesus" id="e_rhesus" class="btn btn-info">
					<option value="<?php echo $yuk_rhesus;?>" selected>- <?php echo $yuk_rhesus;?> -</option>
					<option value="+">+</option>
					<option value="-">-</option>
					</select>
				</p>



				<p>
				Warga Negara : 
				<br>
				<select name="e_warga" id="e_warga" class="btn btn-info">
					<option value="<?php echo $yuk_warga_negara;?>" selected>- <?php echo $yuk_warga_negara;?> -</option>
					<option value="Indonesia">Indonesia</option>
					<option value="Asing">Asing</option>
					</select>
				</p>


				<p>
				Golongan Darah : 
				<br>
				<select name="e_gol_darah" id="e_gol_darah" class="btn btn-info">
					<option value="<?php echo $yuk_gol_darah;?>" selected>- <?php echo $yuk_gol_darah;?> -</option>

					<?php 
					//daftar 
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_gol_darah ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						$yuk_kd = nosql($ryuk['kd']);
						$yuk_nama = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

					?>
					</select>
				</p>


				<p>
				Status Nikah : 
				<br>
				<select name="e_nikah" id="e_nikah" class="btn btn-info">
					<option value="<?php echo $yuk_status_nikah;?>" selected>- <?php echo $yuk_status_nikah;?> -</option>
					<option value="Belum">Belum</option>
					<option value="Menikah">Menikah</option>
					<option value="Duda">Duda</option>
					<option value="Janda">Janda</option>
					</select>
				</p>
			</td>		


		<td width="50"></td>

		<td>

		<h3>DATA KELUARGA</h3>

				<p>
				Nama Ayah :
				<br>
				<input name="e_nama_ayah" id="e_nama_ayah" type="text" size="20" value="<?php echo $juk_nama_ayah;?>" class="btn btn-info">
				</p>



				<p>
				Nama Ibu :
				<br>
				<input name="e_nama_ibu" id="e_nama_ibu" type="text" size="20" value="<?php echo $juk_nama_ibu;?>" class="btn btn-info">
				</p>


				<p>
					Nama Keluarga :
					<br>
					<input name="e_nama_keluarga" id="e_nama_keluarga" type="text" size="20" value="<?php echo $juk_nama_keluarga;?>" class="btn btn-info">
				</p>


				<p>
				Nama Pasangan : 
				<br>
				<input name="e_nama_pasangan" id="e_nama_pasangan" type="text" size="20" value="<?php echo $juk_nama_pasangan;?>" class="btn btn-info">

				</p>



				<p>
				<?php
					//Dapatkan semua 
					$query = mysqli_query($koneksi, "SELECT * FROM provinsi ".
											"ORDER BY nama ASC");
					$row = mysqli_fetch_assoc($query);
					?>
					Propinsi :
					<br>		
					<select name="provinsi2" id="provinsi2" class="btn btn-info">
					<option value="<?php echo $juk_propinsi;?>" selected>- <?php echo $juk_propinsi;?> -</option>
					        <?php
					            do
					            	{
					            	$r_idprov = nosql($row['id_prov']);
									$r_nama = balikin($row['nama']);
									 
					                echo '<option value="'.$r_idprov.'">'.$r_nama.'</option>';
									}
								while ($row = mysqli_fetch_assoc($query));
					        ?>
					</select>
					
				</p>
					
					
				<p>
					Kabupaten :
					<br>
					<select name="kabupaten2" id="kabupaten2" class="btn btn-info">
					<option value="<?php echo $juk_kabupaten;?>" selected>- <?php echo $juk_kabupaten;?> -</option>
					</select>
				</p>
				
				<p>
					Kecamatan : 
					<br>
					<select name="kecamatan2" id="kecamatan2" class="btn btn-info">
					<option value="<?php echo $juk_kecamatan;?>">- <?php echo $juk_kecamatan;?> -</option>
					</select>
				</p>

				<p>
				Kelurahan :
				<br> 
				<input name="e_kelurahan" id="e_kelurahan" type="text" size="10" value="<?php echo $juk_kelurahan;?>" class="btn btn-info">
				</p>
				
				<p>
				Jalan : 
				<br>
				<input name="e_alamat_jalan" id="e_alamat_jalan" type="text" size="50" value="<?php echo $juk_alamat_jalan;?>" class="btn btn-info">
				</p>
				
				<p>
				RT/RW : 
				<br>
				<input name="e_alamat_rt" id="e_alamat_rt" type="text" size="5" value="<?php echo $juk_alamat_rt;?>" class="btn btn-info">
				/
				<input name="e_alamat_rw" id="e_alamat_rw" type="text" size="5" value="<?php echo $juk_alamat_rw;?>" class="btn btn-info">
				</p>
				
				<p>
				Kode Pos :
				<br> 
				<input name="e_kodepos" id="e_kodepos" type="text" size="5" value="<?php echo $juk_alamat_kodepos;?>" class="btn btn-info">
				</p>
			</td>		
		</tr>
	</table>
		
		
	
	<hr>
		<table border="0" cellpadding="3" cellspacing="3" width="100%">
		<tr valign="top">
			<td align="right">

			<input name="btnBACK" id="btnBACK" type="button" value="<< SEBELUMNYA" class="btn btn-danger">
	
			<input name="btnSMP2" id="btnSMP2" type="submit" value="SELANJUTNYA >>" class="btn btn-danger">
			
			</td>
		</tr>
		</table>
	
	<hr>
	

	</td>

	<td width="10">
		
	</td>
	
	</tr>

	</table>
	
	</form>
	<?php
	}
























//jika simpan2
if ($aksi == "simpan2")
	{
	//ambil nilai
	$e_jenis = trim(cegah($_GET["e_jenis"]));
	$e_jenis_no = trim(cegah($_GET["e_jenis_no"]));
	$e_agama = trim(cegah($_GET["e_agama"]));
	$e_telp = trim(cegah($_GET["e_telp"]));
	$e_email = trim(cegah($_GET["e_email"]));
	$e_pddkn = trim(cegah($_GET["e_pddkn"]));
	$e_pekerjaan = trim(cegah($_GET["e_pekerjaan"]));
	$e_suku = trim(cegah($_GET["e_suku"]));
	$e_rhesus = trim(cegah($_GET["e_rhesus"]));
	$e_warga = trim(cegah($_GET["e_warga"]));
	$e_gol_darah = trim(cegah($_GET["e_gol_darah"]));
	$e_nikah = trim(cegah($_GET["e_nikah"]));
	
	
	
	//ambil sesi
	$kdku = nosql($_SESSION['kdku']);


	//cek
	if ((empty($e_jenis)) OR (empty($e_agama)) OR (empty($e_suku)))
		{
		echo "<h3>ENTRI TIDAK LENGKAP</h3>";
		}
	
	else
		{
		//update
		mysqli_query($koneksi, "UPDATE pasien SET jenis_identitas = '$e_jenis', ".
						"no_identitas = '$e_jenis_no', ".
						"agama = '$e_agama', ".
						"telepon = '$e_telp', ".
						"email = '$e_email', ".
						"pendidikan = '$e_pddkn', ".
						"pekerjaan = '$e_pekerjaan', ".
						"suku = '$e_suku', ".
						"rhesus = '$e_rhesus', ".
						"warga_negara = '$e_warga', ".
						"gol_darah = '$e_gol_darah', ".
						"status_nikah = '$e_nikah' ".
						"WHERE kd = '$kdku'");
		
		echo "<font color=red>
		<b>
		ENTRI BERHASIL
		</b>
		</font>";
		}














	$e_nama_ayah = trim(cegah($_GET["e_nama_ayah"]));
	$e_nama_ibu = trim(cegah($_GET["e_nama_ibu"]));
	$e_nama_keluarga = trim(cegah($_GET["e_nama_keluarga"]));
	$e_nama_pasangan = trim(cegah($_GET["e_nama_pasangan"]));
	$e_provinsi = trim(cegah($_GET["provinsi2"]));
	$e_kabupaten = trim(cegah($_GET["kabupaten2"]));
	$e_kecamatan = trim(cegah($_GET["kecamatan2"]));
	$e_alamat_jalan = trim(cegah($_GET["e_alamat_jalan"]));
	$e_alamat_rt = trim(cegah($_GET["e_alamat_rt"]));
	$e_alamat_rw = trim(cegah($_GET["e_alamat_rw"]));
	$e_kelurahan = trim(cegah($_GET["e_kelurahan"]));
	$e_kodepos = trim(cegah($_GET["e_kodepos"]));


	//cek
	$qcc = mysqli_query($koneksi, "SELECT * FROM m_pasien_keluarga ".
							"WHERE kd_pasien = '$kdku'");
	$tcc = mysqli_num_rows($qcc);
	
	//jika null
	if (empty($tcc))
		{
		//insert
		mysqli_query($koneksi, "INSERT INTO pasien_keluarga(kd, kd_pasien, nama_ayah, nama_ibu, nama_keluarga, ".
						"nama_pasangan, propinsi, kabupaten, kecamatan, kelurahan, alamat_jalan, ".
						"alamat_rt, alamat_rw, alamat_kodepos, postdate) VALUES ".
						"('$x', '$kdku', '$e_nama_ayah', '$e_nama_ibu', '$e_nama_keluarga', ".
						"'$e_nama_pasangan', '$e_provinsi', '$e_kabupaten', '$e_kecamatan', '$e_kelurahan', '$e_alamat_jalan', ".
						"'$e_alamat_rt', '$e_alamat_rw', '$e_kodepos', '$today');");
		}
		
	else
		{
		//update
		mysqli_query($koneksi, "UPDATE pasien_keluarga SET nama_ayah = '$e_nama_ayah', ".
						"nama_ibu = '$e_nama_ibu', ".
						"nama_keluarga = '$e_nama_keluarga', ".
						"nama_pasangan = '$e_nama_pasangan', ".
						"propinsi = '$e_provinsi', ".
						"kabupaten = '$e_kabupaten', ".
						"kecamatan = '$e_kecamatan', ".
						"kelurahan = '$e_kelurahan', ".
						"alamat_jalan = '$e_alamat_jalan', ".
						"alamat_rt = '$e_alamat_rt', ".
						"alamat_rw = '$e_alamat_rw', ".
						"alamat_kodepos = '$e_kodepos', ".
						"postdate = '$today' ".
						"WHERE kd_pasien = '$kdku'");
		}
	

	exit();
	}




























//jika daftar3
if ($aksi == "daftar3")
	{
	//ambil sesi
	$kdku = nosql($_SESSION['kdku']);


	?>
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	<?php
	//jika selesai
	if (!empty($_SESSION['selesai']))
		{
		?>
		$("#iform").load("<?php echo $filenyax;?>?aksi=daftar4");
		<?php
		}
		
	else
		{
	?>
	
		$("#btnSMP3").on('click', function(){

			$("#formx23").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan3",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							$("#iproses").show();			
							$("#ihasil4").html(data);
							setTimeout('$("#iproses").hide()',1000);
							
							
							
							$("#iform").load("<?php echo $filenyax;?>?aksi=daftar4");
							$('.myimage4').attr('src', 'img/proses41.png');
							$('.myimage2').attr('src', 'img/proses2.png');
							$('.myimage3').attr('src', 'img/proses3.png');
							$('.myimage1').attr('src', 'img/proses1.png');
							}
						});
					return false;
				});
			
		});
		





		$("#btnBACK").on('click', function(){
			$("#iform").load("<?php echo $filenyax;?>?aksi=daftar2");
			
			$('.myimage1').attr('src', 'img/proses1.png');
			$('.myimage2').attr('src', 'img/proses21.png');
			$('.myimage3').attr('src', 'img/proses3.png');
			$('.myimage4').attr('src', 'img/proses4.png');
		});
		


	<?php
		}
	?>
		


			
	});
	
	</script>
	
	

	<form name="formx23" id="formx23">
	<?php
	//jenis bayar
	$qpuk = mysqli_query($koneksi, "SELECT * FROM pasien_jenisbayar ".
							"WHERE kd_pasien = '$kdku'");
	$rpuk = mysqli_fetch_assoc($qpuk);
	$puk_jenis = balikin($rpuk['jenis_bayar']);		
	
	
	?>	
	
	<table border="0" cellpadding="3" cellspacing="3" width="100%">
	<tr valign="top" bgcolor="white">
	<td width="10">
	
	</td>
	<td>
	
	<hr>		

	<h3>
		Jenis Pembayaran
	</h3>
	<table border="0" cellpadding="3" cellspacing="3" width="100%" bgcolor="<?php echo $warna02;?>">
		<tr>
			<td width="100">
				<p>
				Jenis Bayar
				</p>
			</td>	
			
			<td width="10">
				<p>
					:
				</p>
			</td>
			<td>
				<p>
					<select name="e_jenis" id="e_jenis" class="btn btn-info">
						<option value="<?php echo $puk_jenis;?>" selected><?php echo $puk_jenis;?></option>';
						
						<?php
						//jenis bayar
						$qku = mysqli_query($koneksi, "SELECT * FROM m_jenisbayar ".
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

	</table>
	

	<hr>
		<table border="0" cellpadding="3" cellspacing="3" width="100%">
		<tr valign="top">
			<td align="right">

			<input name="btnBACK" id="btnBACK" type="button" value="<< SEBELUMNYA" class="btn btn-danger">
			<input name="btnSMP3" id="btnSMP3" type="submit" value="SELANJUTNYA >>" class="btn btn-danger">
			
			</td>
		</tr>
		</table>
	<hr>
	
	</td>
	
	<td width="10">
		
	</td>

	</tr>

	</table>
		
	
	</form>
	<?php
	}









//jika simpan entri3
if ($aksi == "simpan3")
	{
	//ambil nilai
	$kdku = nosql($_SESSION['kdku']);	
	$e_jenis = trim(cegah($_GET["e_jenis"]));



	//cek
	if (empty($e_jenis))
		{
		echo "<h3>ENTRI TIDAK LENGKAP</h3>";
		
		exit();
		}
	
	else
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM pasien_jenisbayar ".
								"WHERE kd_pasien = '$kdku'");
		$tcc = mysqli_num_rows($qcc);
		
		//jika null
		if (empty($tcc))
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO pasien_jenisbayar(kd, kd_pasien, jenis_bayar, postdate) VALUES ".
							"('$x', '$kdku', '$e_jenis', '$today');");
			}

		else
			{
			//update
			mysqli_query($koneksi, "UPDATE pasien_jenisbayar SET jenis_bayar = '$e_jenis' ".
							"WHERE kd_pasien = '$kdku'");		
			}


		exit();
		}
	

	exit();
	}














//jika 4
if ($aksi == "daftar4")
	{
	//ambil nilai
	$kdku = nosql($_SESSION['kdku']);	
		


	//ketahui rm terakhir
	$qcc2 = mysqli_query($koneksi, "SELECT * FROM pasien ".
							"ORDER BY round(no_rm) DESC");
	$rcc2 = mysqli_fetch_assoc($qcc2);
	$cc2_norm = nosql($rcc2['no_rm']);
	
	
		
	//cek norm
	$qcc = mysqli_query($koneksi, "SELECT * FROM pasien ".
							"WHERE kd = '$kdku'");
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
	
	
	
	
	
		

	//jika null
	if (empty($cc2_norm))
		{
		$cc_norm1 = "100001";		
		}
		
	else
		{
		$cc_norm1 = $cc2_norm + 1;
		}
	
	



		
	//jika null
	if (empty($cc_norm))
		{
		//kasi kode boking
		$booking = "$tanggal$passbaru";
		
		//update
		mysqli_query($koneksi, "UPDATE pasien SET no_rm = '$cc_norm1', ".
						"kode_booking = '$booking' ".
						"WHERE kd = '$kdku'");
	
	
		//update
		mysqli_query($koneksi, "UPDATE pasien_periksa SET kode_booking = '$booking', ".
						"postdate_booking = '$today' ".
						"WHERE kd_pasien = '$kdku'");
		}


	//detail
	$qcc = mysqli_query($koneksi, "SELECT * FROM pasien ".
							"WHERE kd = '$kdku'");
	$rcc = mysqli_fetch_assoc($qcc);
	$tcc = mysqli_num_rows($qcc);
	$booking = balikin($rcc['kode_booking']);
	$cc_norm1 = balikin($rcc['no_rm']);



		
	//periksa
	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM pasien_periksa ".
							"WHERE kd_pasien = '$kdku' ".
							"ORDER BY postdate DESC");
	$ryuk2 = mysqli_fetch_assoc($qyuk2);
	$yuk2_kd = nosql($ryuk2['kd']);
	$yuk2_tgl = $ryuk2['tgl_periksa'];
	$yuk2_poli = balikin($ryuk2['poli_nama']);

		
		


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
	Halo, Salam
	</p>
	
	<p>
	Terimakasih atas kepercayaan anda kepada '.strtoupper($nama_rs).'. 
	</p>
	
	<p>
	Pendaftaran anda telah kami terima dengan data sebagai berikut :
	</p>


	<p>
	<table border="0" cellpadding="3" cellspacing="3" width="100%">
	<tr>
	<td width="200">
	Nama 	
	</td>
	
	<td>
	: 	<b>'.$cc_nama.'</b>
	</td>
	</tr>
	
	<tr>
	<td>
	Identitas  	
	</td>
	
	<td>
	: <b>'.$cc_ide_jenis.'</b>
	</td>
	</tr>
	
	
	<tr>
	<td>
	No. Identitas   	
	</td>
	
	<td>
	: 	<b>'.$cc_ide_no.'</b>
	</td>
	</tr>
	
	
	
	<tr>
	<td>
	Alamat   	
	</td>
	
	<td>
	: 	<b>'.$cc_kelurahan.', '.$yuk_kec.', '.$yuk_kab.', '.$yuk_prov.'</b>
	</td>
	</tr>
	
	
	
	<tr>
	<td>
	NO.RM   	
	</td>
	
	<td>
	: <b>'.$cc_norm1.'</b>
	</td>
	</tr>

	
	
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
	
	
	<p>
	Info ini dikirim oleh '.strtoupper($nama_rs).'
	</p>
	
	
	
	</td>
	<td width="10">
	</td>
	
	</tr>
	
	</table>';

					
	

	//bikin sesi rm
	$_SESSION['norm'] = $cc_norm1;				
	$_SESSION['selesai'] = $x;				




	exit();
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>