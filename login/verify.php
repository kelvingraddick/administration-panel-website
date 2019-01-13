<?php
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';
	$database_connection = connect_to_database();

	$email_address = $_POST['email_address'];
	$password = $_POST['password'];
	$session_email_address = $email_address;
	$session_password = $password;

	$email_address = stripslashes($email_address);
	$password = stripslashes($password);
	$email_address = mysqli_real_escape_string($database_connection, $email_address);
	$password = mysqli_real_escape_string($database_connection, $password);

	$session = $_COOKIE['email_address'].$_SERVER["REMOTE_ADDR"];
	if ((mysqli_num_rows(mysqli_query($database_connection, "SELECT * FROM `admins` WHERE session = '$session'"))) && ($email_address == "")) {
		$email_address = mysqli_result($database_connection, "SELECT email_address FROM `admins` WHERE session = '$session'");
		$password = mysqli_result($database_connection, "SELECT password FROM `admins` WHERE session = '$session'");
		session_start();
		$_SESSION["email_address"] = $email_address;
		$_SESSION["password"] = $password;
		header("Location: ".$_ENV["PROTOCOL"].$_SERVER['SERVER_NAME']."/setupshopz/admin/");
	} else {
		$sql = "SELECT * FROM admins WHERE email_address = '$email_address' and password = '$password'";
		$result = mysqli_query($database_connection, $sql);
		$count = mysqli_num_rows($result);
		if ($count == 1) {
			session_start();
			$_SESSION["email_address"] = $session_email_address;
			$_SESSION["password"] = $session_password;
			setcookie("email_address", $session_email_address, time()+3600*24*1, "/"); //expire in 24 hours or 1 day
			if (mysqli_query($database_connection, "UPDATE `admins` SET session='$session' WHERE email_address = '$email_address' and password = '$password'")) { } else { }
			header("Location: ".$_ENV["PROTOCOL"].$_SERVER['SERVER_NAME']."/setupshopz/admin/");
		} else {
			header("Location: ".$_ENV["PROTOCOL"].$_SERVER['SERVER_NAME']."/setupshopz/admin/login/?error=yes&email_address=".$session_email_address."&password=".$session_password."");
		}
	}
?>