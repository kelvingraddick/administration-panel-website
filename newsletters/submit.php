<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';

    $database_connection = connect_to_database();

    $id = $_POST['id'];
	$title = addslashes($_POST['title']);
    $url = addslashes($_POST['url']);
    $created_time = is_date($_POST['created_time']) ? $_POST['created_time'] : date("Y-m-d H:i:s");

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO newsletters (title, url, created_time) values('$title', '$url', '$created_time')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
		$updated_time = date("Y-m-d H:i:s");
		if (mysqli_query($database_connection, "UPDATE newsletters SET title = '$title', url = '$url', created_time = '$created_time' where id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>