<!DOCTYPE html>
<html lang="en">
	<!-- Session starting & connecting to Database -->
	<?php 
	session_start();
	include('db_connect.php');
	?>
	<!-- heading -->
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title>Tasty Shop</title>
		<?php 
		include('./include/header.php'); ?>
		<?php 
		if(isset($_SESSION['login_id']))
		header("location:index.php?page=orders"); ?>
	</head>
	<!-- internal css -->
	<style>
		body{
			width: 100%;
			height: calc(100%);
			position: fixed;
			top:0;
			left: 0
		}
		main#main{
			width:100%;
			height: calc(100%);
			display: flex;
		}
	</style>
	<body class="bg-dark">
		<main id="main" >	
				<div class="align-self-center w-100">
					<h4 class="text-white text-center"><b>Tasty Shop</b></h4>
					<div id="login-center" class="bg-dark row justify-content-center">
						<div class="card col-md-4">
							<div class="card-body">
								<form id="login-form" >
									<div class="form-group">
										<label for="username" class="control-label">Username</label>
										<input type="text" id="username" name="username" class="form-control">
									</div>
									<div class="form-group">
										<label for="password" class="control-label">Password</label>
										<input type="password" id="password" name="password" class="form-control">
									</div>
									<center><button class=" btn btn-primary col-md-4">Login</button></center>
								</form>
							</div>
						</div>
					</div>
				</div>
		</main>
	</body>
	<script>
		$('#login-form').submit(function(e){
			/* Getting the login form value */
			e.preventDefault()
			$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
			if($(this).find('.alert-danger').length > 0 )
				$(this).find('.alert-danger').remove();
			$.ajax({
				url:'ajax.php?action=login',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
			$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
			},
			/* Checking Credentials */
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=orders';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Wrong Credentials! Try Again.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
				}
			})
		})
	</script>	
</html>