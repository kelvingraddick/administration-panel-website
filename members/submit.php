<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';

    $database_connection = connect_to_database();

    $id = $_POST['id'];
    $type = $_POST['type'];
	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$email_address = addslashes($_POST['email_address']);
    $phone_number = addslashes($_POST['phone_number']);
	$notes = addslashes($_POST['notes']);

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO admins (type, first_name, last_name, email_address, phone_number, password, notes) values(1, '$first_name', '$last_name', '$email_address', '$phone_number', 'wavelink', '$notes')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
		if (mysqli_query($database_connection, "UPDATE admins SET type = '$type', first_name = '$first_name', last_name = '$last_name', email_address = '$email_address', phone_number = '$phone_number', password = 'wavelink', notes = '$notes' where id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>