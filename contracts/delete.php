<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];

	if(mysqli_query($c, "delete from contracts where id = '$id'")){
		header("Location: index.php");
	}else{
		header("Location: error.php");
	}
?>
