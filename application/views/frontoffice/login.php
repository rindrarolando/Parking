<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url()?>design/loginadmin/css/style.css">

    <title>Login</title>
  </head>
  <body>
	<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 text-center mb-5">
						<h2 class="heading-section"></h2>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-7 col-lg-5">
						<div class="login-wrap p-4 p-md-5">
					
					<h3 class="text-center mb-4">Connexion</h3>
					<a href="<?php echo base_url('welcome/inscription')?>"><p class="text-center mb-4">s'inscrire</p></a>

					<form method="POST" action="<?php echo base_url('user/login')?>" class="login-form">
						<div class="form-group">
							<input type="text" value="<?php echo set_value('login')?>" class="form-control rounded-left" placeholder="Login" name="login" >
						</div>
						<div class="form-group d-flex">
						<input type="password" value="<?php echo set_value('password')?>" class="form-control rounded-left" placeholder="Password" name="password" >
						</div>
						<div class="form-group">
							<button type="submit" class="form-control btn btn-primary rounded submit px-3">connexion</button>
						</div>
						<div class="form-group d-md-flex">
							<?php if(isset($error)){?>
								<p style="color:red; text-align:center;">Connexion échouée, veuillez réessayer</p>
							<?php }?>
							<p style="color:red; text-align:center;"><?php echo validation_errors() ?></p>
						</div>
				</form>
				</div>
					</div>
				</div>
			</div>
		</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url()?>design/loginadmin/js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>design/loginadmin/js/popper.js"></script>
    <script src="<?php echo base_url()?>design/loginadmin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>design/loginadmin/js/main.js"></script>
  </body>
</html>
