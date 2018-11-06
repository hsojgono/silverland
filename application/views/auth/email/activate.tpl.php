<html>
<body>
	<h1><?php echo sprintf(lang('email_activate_heading'), $identity);?></h1>
	<p>Username: <?php echo $identity; ?></p>
	<p>Password: <?php echo $password; ?></p> <!-- added by cristhiansagun@gmail.com July 15, 2017 -->
	<p>Please change your password after you activate your account.</p>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link')));?></p>
</body>
</html>