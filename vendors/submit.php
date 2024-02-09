<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';

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
	$instagram_url = addslashes($_POST['instagram_url']);
	$facebook_url = addslashes($_POST['facebook_url']);
	$handclaps = $_POST['handclaps'];
	$is_enabled = $_POST['is_enabled'];

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO vendors (user_id, type, business_name, description, location_name, latitude, longitude, logo_url, banner_image_url, website_url, instagram_url, facebook_url, handclaps, is_enabled) values('$user_id', '$type', '$business_name', '$description', '$location_name', '$latitude', '$longitude', '$logo_url', '$banner_image_url', '$website_url', '$instagram_url', '$facebook_url', '$handclaps', '$is_enabled')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
		$vendor = mysqli_fetch_assoc(mysqli_query($database_connection, "SELECT * FROM vendors WHERE id = '$id' LIMIT 1"));
		$is_already_enabled = ($vendor != null) ? $vendor['is_enabled'] : 0;

		if (mysqli_query($database_connection, "UPDATE vendors SET user_id = '$user_id', type = '$type', business_name = '$business_name', description = '$description', location_name = '$location_name', latitude = '$latitude', longitude = '$longitude', logo_url = '$logo_url', banner_image_url = '$banner_image_url', website_url = '$website_url', instagram_url = '$instagram_url', facebook_url = '$facebook_url', handclaps = '$handclaps', is_enabled = '$is_enabled' where id = '$id'")){ 
			$response['success'] = true;
			if ($is_already_enabled == 0 && $is_enabled == 1) {
				$user = mysqli_fetch_assoc(mysqli_query($database_connection, "SELECT * FROM users WHERE id = '$user_id' LIMIT 1"));
				if ($user != null) {
					$email = array();
					$email['recipient_email_address'] = $user['email_address'];
					$email['recipient_name'] = $user['first_name'].' '.$user['last_name'];
					$email['subject'] = "Time to complete your registration for Cut Corners!";
					$content = 'Thank you for signing up for Cut Corners as a hair professional!<br />
					<b>Your account has been approved and is ready for you to complete your registration!</b><br />
					Please log into the app, go to the account tab, then \'Add/Edit Subscription\', to subscribe and complete the registration.<br />
					<br />
					Welcome!<br />
					- Cut Corners team';
					$settings = get_settings($database_connection);
					$email['body'] = get_email_template($content, $settings);
					send_email($email);
				}
			}
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>