<?php
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';
	$database_connection = connect_to_database();

    $session = $_COOKIE['email_address'].$_SERVER["REMOTE_ADDR"];
	if (mysqli_num_rows(mysqli_query($database_connection, "SELECT * FROM `admins` WHERE session = '$session'"))) {
        header("location:verify.php");
        echo $session;
	}

	$error = $_GET['error'];
	$email_address = $_GET['email_address'];
	$password = $_GET['password'];
?>
<!DOCTYPE html>
<html class="full_height">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $site_name ?> - Administration Panel</title>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/css/main.php'; ?>
	</head>
	<body class="full_height">
		<div id="particles" class="background"></div>
		<div class="columns is-centered is-mobile full_height">
			<div class="column is-one-third-desktop is-four-fifths-tablet is-four-fifths-mobile full_height">
				<div class="login card">
					<header class="card-header">
						<a href="http://www.wavelinkllc.com"><img style="height:75px;" src="http://www.wavelinkllc.com/images/WaveLink_Logo.png" alt="Wave Link, LLC - High-Quality Mobile Apps, Websites, & Graphics" /></a><br />
						<p class="card-header-title">Adminstration Panel</p>
					</header>
					<div class="card-content">
						<div class="content">
							<form id="login_form" class="form-grouped" action="verify.php" method="post" data-validate>
								<div class="field">
									<label class="label">Email Address</label>
									<div class="control has-icons-left">
										<input class="input" type="text" name="email_address" placeholder="Email Address" minlength="2" <?php echo 'value="'.$email_address.'"'; ?> required>
										<span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
									</div>
								</div>
								<div class="field">
									<label class="label">Password</label>
									<div class="control has-icons-left">
										<input class="input" type="password" name="password" placeholder="Password" minlength="2" <?php echo 'value="'.$password.'"'; ?> required>
										<span class="icon is-small is-left"><i class="fas fa-key"></i></span>
									</div>
								</div>
								<div class="field">
									<?php if($error == "yes") { echo '<p class="help is-danger">The username/password entered are incorrect. Please try again! &nbsp;</p>'; } ?>
								</div>
							</form>
						</div>
					</div>
					<footer class="card-footer">
						<a href="#" class="card-footer-item" onclick="document.getElementById('login_form').submit(); return false;">Login</a>
					</footer>
				</div>
			</div>
		</div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/js/main.php'; ?>
	</body>
</html>