<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="<?= $title; ?>" />
    <meta name="author" content="Frais Mediatech" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/dashboard/img/logo-icon.png">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/dashboard/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/dashboard/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/home/toastr/build/toastr.css">
</head>
<style type="text/css">
    @media(max-width: 767px){
        .media-hide{
            display: none !important;
        }
    }
    
</style>
<body class="bg-white">
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="<?= base_url(); ?>assets/dashboard/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->

            <!--start login contant-->
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="login p-50">
                                        <h1 class="mb-2">Silahkan Masuk</h1>
                                        <p>Selamat Datang Di Website Pelatihan Kota Depok</p>
                                        <form method="post" action="<?= base_url('Login/login'); ?>" class="mt-3 mt-sm-5">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">User Name *</label>
                                                        <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Password *</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Captcha :</label><br>
                                                    <label id="captImg" class="mb-2"><?= $captchaImg; ?></label>
                                                    <a href="javascript:void(0);" class="refreshCaptcha" ><img height="70" width="70" src="<?= base_url().'assets/img/loading.gif'; ?>"/></a>
                                                    <input type="text" name="captcha" class="form-control" placeholder="Masukan Captcha" autocomplete="on"/>
                                                    </div>
                                                </div> -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <!-- <label>Recaptcha</label> -->
                                                        <?php echo $recaptcha_html;?>
                                                        <?php echo form_error('g-recaptcha-response'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary text-uppercase">Masuk</button>
                                                </div>
                                                <div class="col-12  mt-3">
                                                    <p>Tidak Punya Akun ?<a href="<?= base_url(); ?>pendaftaran"> Register</a></p>
                                                </div>
                                                <div class="col-12  mt-0">
                                                    <p>Kembali ke<a href="<?= base_url(); ?>"> Beranda</a></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2 media-hide">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid" src="<?= base_url(); ?>assets/dashboard/img/bg/login.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end login contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    <!-- plugins -->
    <script src="<?= base_url(); ?>assets/dashboard/js/vendors.js"></script>
    <!-- custom app -->
    <script src="<?= base_url(); ?>assets/dashboard/js/app.js"></script>
    <script src="<?= base_url();?>assets/home/js/jquery.min.js"></script>
    <script src="<?= base_url();?>assets/home/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?= base_url();?>assets/home/toastr/build/toastr.min.js"></script>
    <!-- <script>
      $(function () { //ready
          toastr.info('If all three of these are referenced correctly, then this should toast should pop-up.');
      });
    </script> -->
    <script>
		$(document).ready(function(){

            var $recaptcha = document.querySelector('#g-recaptcha-response');

            if($recaptcha) {
                $recaptcha.setAttribute("required", "required");
            }

			// $('.refreshCaptcha').on('click', function(){
			// 	$.get('<?php //echo base_url().'login/refresh'; ?>', function(data){
			// 		$('#captImg').html(data);
			// 	});
			// });
		});
	</script>
	
    <?php if ($this->session->flashdata('notif')): ?>
    <script type="text/javascript">
      $(document).ready(function() {
        swal({
          title: "Login Failed !",
          icon: "error",
          text: "<?= $this->session->flashdata('notif'); ?>",
          timer: 2000
        });
      });
    </script>
  <?php endif; ?>
</body>
</html>