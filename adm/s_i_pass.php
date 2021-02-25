<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "s_pass.php";
$filenyax = "s_i_pass.php";
$judul = "Ganti Password";
$juduli = $judul;


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	sleep(1);


	//ambil nilai
	$passlama = md5(nosql($_GET["passlama"]));
	$passbaru = md5(nosql($_GET["passbaru"]));
	$passbaru2 = md5(nosql($_GET["passbaru2"]));

	//cek
	//nek null
	if ((empty($passlama)) OR (empty($passbaru)) OR (empty($passbaru2)))
		{
		//pesan
		echo "<h3>Input Tidak Lengkap. Harap Diulangi...!!</h3>";
		exit();
		}

	//nek pass baru gak sama
	else if ($passbaru != $passbaru2)
		{
		//pesan
		echo "<h3>Password Baru Tidak Sama. Harap Diulangi...!!</h3>";
		exit();
		}
	else
		{
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM adminx ".
							"WHERE passwordx = '$passlama'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);

		//cek
		if ($total != 0)
			{
			//perintah SQL
			mysqli_query($koneksi, "UPDATE adminx SET passwordx = '$passbaru'");

			//pesan
			echo "<h3>PASSWORD BERHASIL DIGANTI.</h3>";
			exit();
			}
		else
			{
			//pesan
			echo "PASSWORD LAMA TIDAK COCOK. HARAP DIULANGI...!!!";
			exit();
			}
		}
		
	
	
	exit();
	}








//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	sleep(1);
	
	?>
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#btnKRM").on('click', function(){
			$("#formx2").submit(function(){
				$.ajax({
					url: "<?php echo $sumber;?>/adm/<?php echo $filenyax;?>?aksi=simpan",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#ihasil").html(data);
						setTimeout('$("#iproses").hide()',5000);
						}
					});
				return false;
			});
		
		
		});	
	
	
	});
	
	</script>

	
		

	<form name="formx2" id="formx2">
	<p>Password Lama : <br>
	<input name="passlama" id="passlama" type="password" size="15" class="btn btn-default">
	</p>
	<p>Password Baru : <br>
	<input name="passbaru" id="passbaru" type="password" size="15" class="btn btn-default">
	</p>
	<p>RE-Password Baru : <br>
	<input name="passbaru2" id="passbaru2" type="password" size="15" class="btn btn-default">
	</p>
	<p>
	<input name="btnKRM" id="btnKRM" type="submit" value="SIMPAN" class="btn btn-danger">
	</p>
	</form>


	<?php
	
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>