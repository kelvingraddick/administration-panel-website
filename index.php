<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
	$database_connection = connect_to_database();
	$setting = get_settings($database_connection);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $site_name ?> - Administration Panel</title>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/css/main.php'; ?>
	</head>
	<body>
		<div id="particles" class="background"></div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/navigation.php'; ?>
		<div id="page" class="page card">
			<div class="loading">Loading...</div>
		</div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/modal.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/js/main.php'; ?>
	</body>
</html>