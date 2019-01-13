<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';

    $database_connection = connect_to_database();

    $id = $_POST['id'];

    $response = array();

	if (mysqli_query($database_connection, "DELETE FROM users WHERE id = '$id'")) {
		$response['success'] = true;
	} else {
		$response['success'] = false;
        $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
    }
    
    echo json_encode($response);
?>