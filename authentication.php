<?php
	session_start();
	if (!isset($_SESSION['email_address'])) {
		// User is not logged in, so send user away.
		header("Location:http://".$_SERVER['SERVER_NAME']."/admin/login/");
		die();
	}
?>