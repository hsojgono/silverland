<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>KAWANI | Log in</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/bootstrap/3.3.7/css/bootstrap.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/icon-fonts/font-awesome/4.3.0/css/font-awesome.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/icon-fonts/ionicons/2.0.1/css/ionicons.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/iCheck/flat/blue.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/iCheck/minimal/blue.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/adminLTE/2.3.11/dist/css/AdminLTE.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/app-custom.css'); ?>">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script type="text/javascript" src="<?php echo site_url('assets/libs/jquery/3.2.1/jquery.min.js'); ?>"></script>
	</head>
	<body class="hold-transition login-page">
		
		<div class="row">
			<div class="col-lg-8"></div>
			<div class="col-lg-4">
				<div class="login-box">
			<div class="login-logo">
				<a href="javascript:void(0);"><b>KAWANI</b></a>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg"><?php echo lang('login_subheading'); ?></p>
				<div id="infoMessage" class="text-red"><?php echo $message;?></div>
				<?php if ($this->session->flashdata('success')): ?>
					<div id="infoMessage" class="text-green">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif ?>
				<?php echo form_open("auth/login");?>
					<div class="form-group has-feedback">
						<?php echo form_input($identity);?>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<?php echo form_input($password);?>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>

					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
									<?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="minimal"');?> Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->

						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
						</div>
						<div class></div>
						<!-- /.col -->
					</div>

				<?php echo form_close();?>

				<a href="forgot_password"><?php echo lang('login_forgot_password');?></a><br>
				<a href="<?php echo site_url('auth/sign_up'); ?>" class="text-center">Create Account</a>

			</div>
			<!-- /.login-box-body -->
		</div>
			</div>
		</div>
		<!-- /.login-box -->

		<script type="text/javascript" src="<?php echo site_url('assets/libs/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/iCheck/icheck.min.js'); ?>"></script>

		<!-- Custom JavaScript -->
		<script type="text/javascript" src="<?php echo site_url('assets/js/icheck-custom.js'); ?>"></script>
		<script>
			$(function () {
				$('#remember').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
				$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
					checkboxClass: 'icheckbox_minimal-blue',
					radioClass: 'iradio_minimal-blue'
				});
			});
		</script>
	</body>
</html>
