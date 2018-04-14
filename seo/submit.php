<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';

    $database_connection = connect_to_database();

	$id = $_POST['id'];
	$page = addslashes($_POST['page']);
	$display = addslashes($_POST['display']);
	$title = addslashes($_POST['title']);
	$description = addslashes($_POST['description']);
	$keywords = addslashes($_POST['keywords']);
	$header = addslashes($_POST['header']);

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO seo (page, display, title, description, keywords, header) values('$page', '$display', '$title', '$description', '$keywords', '$header')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
		if (mysqli_query($database_connection, "UPDATE seo SET page = '$page', display = '$display', title = '$title', description = '$description', keywords = '$keywords', header = '$header' WHERE id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>