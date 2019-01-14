<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';

    $database_connection = connect_to_database();

    $id = $_POST['id'];
	$user_id = $_POST['user_id'];
	$type = $_POST['type'];
	$business_name = addslashes($_POST['business_name']);
	$description = addslashes($_POST['description']);
	$location_name = addslashes($_POST['location_name']);
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$logo_url = addslashes($_POST['logo_url']);
	$banner_image_url = addslashes($_POST['banner_image_url']);
	$website_url = addslashes($_POST['website_url']);
	$instagram_handle = addslashes($_POST['instagram_handle']);
	$facebook_handle = addslashes($_POST['facebook_handle']);
	$handclaps = $_POST['handclaps'];
	$is_enabled = $_POST['is_enabled'];

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO vendors (user_id, type, business_name, description, location_name, latitude, longitude, logo_url, banner_image_url, website_url, instagram_handle, facebook_handle, handclaps, is_enabled) values('$user_id', '$type', '$business_name', '$description', '$location_name', '$latitude', '$longitude', '$logo_url', '$banner_image_url', '$website_url', '$instagram_handle', '$facebook_handle', '$handclaps', '$is_enabled')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
		if (mysqli_query($database_connection, "UPDATE vendors SET user_id = '$user_id', type = '$type', business_name = '$business_name', description = '$description', location_name = '$location_name', latitude = '$latitude', longitude = '$longitude', logo_url = '$logo_url', banner_image_url = '$banner_image_url', website_url = '$website_url', instagram_handle = '$instagram_handle', facebook_handle = '$facebook_handle', handclaps = '$handclaps', is_enabled = '$is_enabled' where id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>