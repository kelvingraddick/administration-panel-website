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
	$description = addslashes($_POST['description']);
    $image_url = addslashes($_POST['image_url']);
    $order_index = addslashes($_POST['order_index']);

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO photo_albums (title, description, image_url, order_index) values('$title', '$description', '$image_url', '$order_index')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
		if (mysqli_query($database_connection, "UPDATE photo_albums SET title = '$title', description = '$description', image_url = '$image_url', order_index = '$order_index' where id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>