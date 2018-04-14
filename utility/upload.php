<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';

    $database_connection = connect_to_database();

    $name = preg_replace('/\s+/', ' ', addslashes($_POST['name']));

    $response = array();
    $response['url'] = upload_file($name, '/images/', 2);

	if ($response['url'] <> "") {
		$response['success'] = true;
	} else {
        $response['success'] = false;
        $response['error_message'] = "There was an error uploading. Please try again.";
    }
    
    echo json_encode($response);
?>