<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
	$database_connection = connect_to_database();

	session_start();
	setcookie("email_address", "", time()-3600*6, "/");
	setcookie("current_page_link_id", "", time()-3600*6, "/");
	$email_address = $_SESSION['email_address'];

	if (mysqli_query($database_connection, "UPDATE `users` SET session = 'none' WHERE email_address = '$email_address'")) {
		// success
	} else {
		// failure
	}
	session_destroy();
?>
<html>
	<head>
		<title>Wave Link, LLC - Logout Successful</title>
		<?php echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$_ENV["PROTOCOL"].$_SERVER['SERVER_NAME'].'/admin/">'; ?>
	</head>
	<body align="center">
		Logout Successful <br/>
	</body>
</html>