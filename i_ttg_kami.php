<?php
session_start();

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");


$filenyax = "i_ttg_kami_post.php";
?>


<script language='javascript'>
//membuat document jquery
$(document).ready(function(){


	$("#btnKRM").on('click', function(){

		$("#formku").submit(function(){
			var e_nama = $('#e_nama').val();
			var e_alamat = $('#e_alamat').val();
			var e_email = $('#e_email').val();
			var e_telp = $('#e_telp').val();
			var e_isi = $('textarea#e_isi').val();
			
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=simpan",
					type:$(this).attr("method"),
					//data:$(this).serialize(),
					data:"e_nama="+e_nama+"&e_alamat="+e_alamat+"&e_email="+e_email+"&e_telp="+e_telp+"&e_isi="+e_isi,
					success:function(data){				
						$("#ihasil").html(data);
						}
					});
				return false;
			});
		
		});
	
	

		
});

</script>




			<div class="row">
				<div class="col-md-4 to-animate">
					<h3 class="section-title">Tentang Kami..</h3>
					<p>Tentang Kami..Tentang Kami..Tentang Kami..Tentang Kami..Tentang Kami..Tentang Kami..</p>
					<p class="copy-right">&copy; 2018. <br>All Rights Reserved. <br>
					</p>
				</div>

				<div class="col-md-4 to-animate">
					<h3 class="section-title">Alamat</h3>
					<ul class="contact-info">
						<li><i class="icon-map-marker"></i>alamat...</li>
						<li><i class="icon-phone"></i>+ telepon</li>
						<li><i class="icon-envelope"></i><a href="#">email..</a></li>
						<li><i class="icon-globe2"></i><a href="#">alamat web</a></li>
					</ul>
					<h3 class="section-title">Kontak Kami</h3>
					<ul class="social-media">
						<li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
						<li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
						<li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
						<li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
					</ul>
				</div>
				<div class="col-md-4 to-animate">
					<h3 class="section-title">Bantuan / Saran / Kritik</h3>
					
					<div id="ihasil">
					<form class="contact-form" id="formku">
						<div class="form-group">
							
							<p>
							<input name="e_nama" id="e_nama" type="text" size="20" value="" class="btn btn-default" placeholder="Nama..."> 
							</p>
						
							<p>
							<input name="e_alamat" id="e_alamat" type="text" size="20" value="" class="btn btn-default" placeholder="Alamat..."> 
							</p>
							
							<p>
							<input name="e_telp" id="e_telp" type="text" size="20" value="" class="btn btn-default" placeholder="Telepon..."> 
							</p>

							<p>
							<input name="e_email" id="e_email" type="text" size="20" value="" class="btn btn-default" placeholder="E-Mail..."> 
							</p>
							
							
							<p>
							<textarea cols="30" id="e_isi" wrap="yes" rows="10" class="btn btn-default" placeholder="Isi Bantuan / Saran / Kritik..."></textarea>
							</p>

							<p>
							<input type="submit" id="btnKRM" class="btn btn-danger" value="KIRIM >>">
							</p>
						</div>
						
						
					</form>
					
					</div>
				</div>
			</div>
