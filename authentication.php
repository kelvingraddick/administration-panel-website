<?php
	session_start();
	if (!isset($_SESSION['email_address'])) {
		// User is not logged in, so send user away.
		header("Location:/admin/login/");
		die();
	}
?>