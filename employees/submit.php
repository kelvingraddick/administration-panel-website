<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';

    $database_connection = connect_to_database();

    $id = $_POST['id'];
	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$email_address = addslashes($_POST['email_address']);
    $phone_number = addslashes($_POST['phone_number']);
	$description = addslashes($_POST['description']);
	$order_index = addslashes($_POST['order_index']);

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO employees (first_name, last_name, email_address, phone_number, description, order_index) values('$first_name', '$last_name', '$email_address', '$phone_number', '$description', '$order_index')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
		$updated_time = date("Y-m-d H:i:s");
		if (mysqli_query($database_connection, "UPDATE employees SET first_name = '$first_name', last_name = '$last_name', email_address = '$email_address', phone_number = '$phone_number', description = '$description', order_index = '$order_index', updated_time = '$updated_time' where id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>