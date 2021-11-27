<!DOCTYPE html>
<!--[if IE 8]>         
<html class="no-js lt-ie9" lang="en">
<![endif]-->
<!--[if gt IE 8]><!--> 
<html lang="en">
<!--<![endif]-->
<?= $page["head"]; ?>
<style type="text/css">
	/*wa link*/
	.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
/*end wa link*/
</style>


<?= $page['main_js'];?>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url();?>"><img src="<?= base_url();?>assets/home/images/pemkotdepok.png" height="50px" width="40px" alt="Pemkot Depok"> Pelatihan Kota Depok</a>
			<button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fas fa-bars"></span> Menu
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav nav ml-auto menusBar">

					<li class="nav-item"><a href="<?= base_url();?>" <?php if ($this->uri->segment(1) == '') { ?>
						class="nav-link nav-active" <?php }else{ ?> class="nav-link" <?php } ?>><span>Beranda</span></a></li>

						<li class="nav-item"><a href="<?= base_url();?>ujianonline" <?php if ($this->uri->segment(1) == 'login') { ?> class="nav-link nav-active" <?php }else{ ?> class="nav-link" <?php } ?>><span>Ujian Online</span></a></li>

						<li class="nav-item dropdown">
							<a <?php if ($this->uri->segment(2) == 'data' || $this->uri->segment(2) == 'pelatihan'  || $this->uri->segment(2) == 'pelatihanDetail'  || $this->uri->segment(2) == 'lpk'  || $this->uri->segment(2) == 'lpkDetail' || $this->uri->segment(2) == 'info' || $this->uri->segment(2) == 'infoDetail') { ?> class="nav-link dropdown-toggle nav-active" <?php }else{ ?> class="nav-link dropdown-toggle" <?php } ?> href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Data
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?= base_url(); ?>Home/lpk/1">LPK/BLKLN</a><!-- 
								<a class="dropdown-item" href="<?= base_url(); ?>Home/pelatihan">Jadwal</a>
								<a class="dropdown-item" href="<?= base_url(); ?>Home/info">Informasi</a> -->
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle nav-active" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								LPK/BLK
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?= base_url(); ?>pendaftaran">Pendaftaran</a>
								<a class="dropdown-item" href="<?= base_url(); ?>login">Login</a>
							</div>
						</li>

<!-- 
						<li class="nav-item"><a href="<?= base_url();?>pendaftaran" <?php if ($this->uri->segment(1) == 'pendaftaran') { ?> class="nav-link nav-active" <?php }else{ ?> class="nav-link" <?php } ?>><span>Pendaftaran</span></a></li>

					

						<li class="nav-item"><a href="<?= base_url();?>login" <?php if ($this->uri->segment(1) == 'login') { ?> class="nav-link nav-active" <?php }else{ ?> class="nav-link" <?php } ?>><span>Login</span></a></li> -->

						

					</ul>
				</div>
			</div>
		</nav>

		<?= $content;?>

		<footer class="ftco-footer ftco-section">
			<div class="container">
				<div class="row mb-5">
					<div class="col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="ftco-footer-widget mb-4">
							<h2 class="ftco-heading-2">Pelatihan <span class="text-info">Kota Depok</span></h2>
							<p class="text-justify"></p>
							<div class="rounded-social-buttons">
								<a class="social-button facebook" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
								<a class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
								<a class="social-button linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
								<a class="social-button youtube" href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
								<a class="social-button instagram" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="ftco-footer-widget mb-4">
							<h2 class="ftco-heading-2">Hubungi Kami</h2>
							<ul class="ul-footer">
								<li><i class="fas fa-envelope"></i> Email : <a href="#" class="text-info" target="_blank">disnakerkotadepok@gmail.com</a></li>
								<li><i class="fas fa-phone"></i> Phone : <a href="#" class="text-info" target="_blank">disnakerkotadepok@gmail.com</a></li>
								<li><i class="fas fa-map-marker"></i> Alamat : <a href="#" class="text-info" target="_blank">Jl. Margonda Raya No.54, Depok, Kec. Pancoran Mas, Kota Depok, Jawa Barat 16431</a></li>
							</ul>

						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="ftco-footer-widget mb-4">
							<h2 class="ftco-heading-2">Helpdesk</h2>
							<form method="POST" action="<?= base_url('Home/tambahHelpDesk'); ?>" class="text-center justify-content-center">
							    
							    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							    
								<div class="form-group">
									<label>Tipe</label><br>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="Umum" name="tipe" autocomplete="off">
										<label class="form-check-label" for="inlineCheckbox1">Umum</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="LPK/BLKLN" name="tipe" autocomplete="off">
										<label class="form-check-label" for="inlineCheckbox2">LPK/BLKLN</label>
									</div>
								</div>
								<!-- <div class="alert alert-success" role="alert">
									Berhasil Dikirim!
								</div> -->
								<?= $this->session->flashdata('notif'); ?>
								<div id="umum">
									<div class="form-group">
										<label>NIK</label>
										<input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" autocomplete="off">
									</div>
									<div class="form-group">
										<label>Status Pekerjaan</label><br>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" id="inlineCheckbox3" value="Sudah Bekerja" name="status" autocomplete="off">
											<label class="form-check-label" for="inlineCheckbox1">Sudah Bekerja</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" id="inlineCheckbox4" value="Belum Bekerja" name="status" autocomplete="off">
											<label class="form-check-label" for="inlineCheckbox2">Belum Bekerja</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Nama <span id="lpk">LPK/BLKLN</span></label>
									<input type="text" name="nama" id="nama" class="form-control nama" placeholder="Nama" autocomplete="off">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com" autocomplete="off">
								</div>
								<div class="form-group">
									<label>Masukan</label>
									<textarea class="form-control" name="masukan" placeholder="Isi Masukan Anda Disini" rows="5" autocomplete="off"></textarea>		
								</div>
								<div class="form-group">
                                    <label class="control-label">Captcha :</label><br>
                                    <label id="captImg" class="mb-2"><?= $captchaImg; ?></label>
                                    <a href="javascript:void(0);" class="refreshCaptcha" ><img height="30" width="30" src="<?= base_url().'assets/img/loading.gif'; ?>"/></a>
                                    <input type="text" name="captcha" class="form-control" placeholder="Masukan Captcha" autocomplete="off"/>
                                </div>
								<button type="submit" class="btn btn-success float-right">Kirim</button>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p>
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by <a href="https://fraismediatech.com" target="_blank"><span class="text-info">Frais Mediatech</span></a>
						</p>
					</div>
				</div>
			</div>
		</footer>
		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
	</body>
	
	<script src="<?= base_url();?>assets/home/js/aos.js"></script>
	<script src="<?= base_url();?>assets/home/js/main.js"></script>
	    <script>
		$(document).ready(function(){
			$('.refreshCaptcha').on('click', function(){
				$.get('<?= base_url().'home/refresh'; ?>', function(data){
					$('#captImg').html(data);
				});
			});
		});
	</script>
	<script type="text/javascript">
		$("#umum").hide();
		$("#lpk").hide();
		$("#nik").val('');
		$("#nama").val('');
		$("#email").val('');
		$('input[type="radio"][name="tipe"]').on('click', function(){
			if (this.value == 'Umum') {
				$("#nik").val('');
				$("#nama").val('');
				$("#email").val('');
				$("#umum").show();
				$("#nama").addClass('nama');
				$("#lpk").hide();
			} else if (this.value == 'LPK/BLKLN') {
				$("#umum").hide();
				$("#nik").val('');
				$("#nama").val('');
				$("#email").val('');
				$("#lpk").show();
				$("#nama").removeClass('nama');
			}
		});
	</script>
	<script type="text/javascript">
		$("#nik").blur(function(){
			cariPeserta($("#nik").val());
		});

		function cariPeserta(cari, nama){
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Home/checkPeserta'); ?>",
				data: {
					cari : cari,

				},
				dataType: "JSON",
				success: function(response) {
					$.each(response.data, function(item, data){
						$("#nik").val(data.nik);
						$(".nama").val(data.nama);
						$("#email").val(data.email);
					});
				}
			});        
		}
	</script>
	</html>