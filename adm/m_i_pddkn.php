<?php
sleep(1);
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/adm.php");

nocache;

//nilai
$filenya = "m_pddkn.php";
$filenyax = "m_i_pddkn.php";
$judul = "Data Pendidikan";
$juduli = $judul;


//ambil nilai
$aksi = nosql($_REQUEST['aksi']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika daftar
if ($aksi == "daftar")
	{
	?>
	
	<script>
	$(document).ready(function(){
	
		$("#btn1").on('click', function(){
			$("#iform").load("<?php echo $filenyax;?>?aksi=entri");
			});	

	
	})
	</script>

	<?php
	echo '<form name="formx21" id="formx21">
	<input name="btn1" id="btn1" type="button" value="ENTRI BARU" class="btn btn-info">';
	
	//tampilkan daftar...
	$qku = mysqli_query($koneksi, "SELECT * FROM m_pendidikan ".
							"ORDER BY nama ASC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	
	//jika null
	if (!empty($tku))
		{
		echo '<table border="1" cellpadding="3" cellspacing="3" width="600" bgcolor="orange">
		<tr valign="top" bgcolor="'.$warnaheader.'">
			<td width="5">
			&nbsp;
			</td>
			
			<td width="5">
			&nbsp;
			</td>
			
			<td>
			<strong><font color="'.$warnatext.'">NAMA</strong>
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
			
			
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
					<a href="#" onclick="$(\'#iform\').load(\''.$filenyax.'?aksi=edit&kd='.$ku_kd.'\');"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
				</td>
				
				<td>
					<a href="#" onclick="$(\'#iform\').load(\''.$filenyax.'?aksi=hapus&kd='.$ku_kd.'\');"><img src="'.$sumber.'/img/delete.gif" width="16" height="16" border="0"></a>
				</td>
				<td>
					'.$ku_nama.'
				</td>
			</tr>';
				
			}
		while ($rku = mysqli_fetch_assoc($qku));
		
		
		echo '</table>';
		}
	
	
	echo '</form>';

	exit();
	}












//jika form edit
if ($aksi == "edit")
	{
	//ambil kode
	$kd = trim(cegah($_GET['kd']));
	
	
	//detail isinya...
	$qku = mysqli_query($koneksi, "SELECT * FROM m_pendidikan ".
							"WHERE kd = '$kd'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nama = balikin($rku['nama']);
	
	?>
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#btnSMP").on('click', function(){

			$("#formx21").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan2",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							$("#iproses").show();			
							$("#ihasil").html(data);
							setTimeout('$("#ihasil").hide()',1000);
							$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
							setTimeout('$("#iproses").hide()',1000);
							}
						});
					return false;
				});
			
		});	


		$("#btnBTL").on('click', function(){
			$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
			});	
	
	
	});
	
	</script>
	
	

	<form name="formx21" id="formx21">
	
	
	<table border="0" cellpadding="3" cellspacing="3" width="100%" bgcolor="<?php echo $warna02;?>">
		<tr valign="top">
			<td>
				<p>
				Nama :
				<br>			
				<input name="e_nama" id="e_nama" type="text" size="15" value="<?php echo $ku_nama;?>" class="btn btn-default">
				</p>
	
				<p>			
				<input name="e_kd" id="e_kd" type="hidden" value="<?php echo $kd;?>">
				</p>
				
				<p>
				<input name="btnSMP" id="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
				<input name="btnBTL" id="btnBTL" type="button" value="BATAL" class="btn btn-primary">
				</p>
				
			</td>		
		</tr>
	</table>
	
	
	
	
	</form>
	<?php
	}










//jika simpan edit
if ($aksi == "simpan2")
	{
	//ambil nilai
	$e_kd = trim(cegah($_GET["e_kd"]));
	$e_nama = trim(cegah($_GET["e_nama"]));


	//cek
	if (empty($e_nama))
		{
		echo "<h3>ENTRI TIDAK LENGKAP</h3>";
		
		exit();
		}
	
	else
		{
		//update
		mysqli_query($koneksi, "UPDATE m_pendidikan SET nama = '$e_nama' ".
						"WHERE kd = '$e_kd'");
		
		echo "<h3>UPDATE BERHASIL</h3>";
		
		exit();
		}
	

	exit();
	}










//jika form entri
if ($aksi == "entri")
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
							setTimeout('$("#ihasil").hide()',1000);
							$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
							setTimeout('$("#iproses").hide()',1000);
							}
						});
					return false;
				});
			
		});	


		$("#btnBTL").on('click', function(){
			$("#iform").load("<?php echo $filenyax;?>?aksi=daftar");
			});	
	
	
	});
	
	</script>
	
	

	

	<form name="formx21" id="formx21">
	
	
	<table border="0" cellpadding="3" cellspacing="3" width="100%" bgcolor="<?php echo $warna02;?>">
		<tr valign="top">
			<td>
				<p>
				Nama :
				<br>			
				<input name="e_nama" id="e_nama" type="text" size="15" class="btn btn-default">
				</p>
	

				<p>
				<input name="btnSMP" id="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
				<input name="btnBTL" id="btnBTL" type="button" value="BATAL" class="btn btn-primary">
				</p>
				
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


	//cek
	if (empty($e_nama))
		{
		echo "<h3>ENTRI TIDAK LENGKAP</h3>";
		
		exit();
		}
	
	else
		{
		//cek dulu....
		$qcc = mysqli_query($koneksi, "SELECT * FROM m_pendidikan ".
								"WHERE nama = '$e_nama'");
		$tcc = mysqli_num_rows($qcc);
		
		//jika null
		if (empty($tcc))
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO m_pendidikan(kd, nama, postdate) VALUES ".
							"('$x', '$e_nama', '$today');");
		
			echo "<h3>ENTRI BERHASIL</h3>";
			}
		
		exit();
		}
	

	exit();
	}










//jika hapus
if ($aksi == "hapus")
	{
	//ambil nilai
	$kd = trim(cegah($_GET["kd"]));

	
	//hapus
	mysqli_query($koneksi, "DELETE FROM m_pendidikan ".
					"WHERE kd = '$kd'");
	
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