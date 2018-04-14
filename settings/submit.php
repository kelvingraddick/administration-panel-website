<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';

    $database_connection = connect_to_database();

	$logo = addslashes($_POST['logo']);
	$phone_number = addslashes($_POST['phone_number']);
	$email_address = addslashes($_POST['email_address']);
	$contact_name = addslashes($_POST['contact_name']);
	$address_1 = addslashes($_POST['address_1']);
	$address_2 = addslashes($_POST['address_2']);
	$city = addslashes($_POST['city']);
	$state = addslashes($_POST['state']);
	$zip = addslashes($_POST['zip']);
	$hours_weekday = addslashes($_POST['hours_weekday']);
	$hours_saturday = addslashes($_POST['hours_saturday']);
	$hours_sunday = addslashes($_POST['hours_sunday']);
	$facebook_link = addslashes($_POST['facebook_link']);
	$twitter_link = addslashes($_POST['twitter_link']);
	$linkedin_link = addslashes($_POST['linkedin_link']);
	$instagram_link = addslashes($_POST['instagram_link']);

	$about_us = addslashes($_POST['about_us']);

	$response = array();

	if (mysqli_query($database_connection,
		"UPDATE settings
    	SET value = CASE code
			WHEN 'logo' THEN '$logo'
			WHEN 'phone_number' THEN '$phone_number'
			WHEN 'email_address' THEN '$email_address'
			WHEN 'contact_name' THEN '$contact_name'
			WHEN 'address_1' THEN '$address_1'
			WHEN 'address_2' THEN '$address_2'
			WHEN 'city' THEN '$city'
			WHEN 'state' THEN '$state'
			WHEN 'zip' THEN '$zip'
			WHEN 'hours_weekday' THEN '$hours_weekday'
			WHEN 'hours_saturday' THEN '$hours_saturday'
			WHEN 'hours_sunday' THEN '$hours_sunday'
			WHEN 'facebook_link' THEN '$facebook_link'
			WHEN 'twitter_link' THEN '$twitter_link'
			WHEN 'linkedin_link' THEN '$linkedin_link'
			WHEN 'instagram_link' THEN '$instagram_link'
			WHEN 'about_us' THEN '$about_us'
		END
		WHERE code IN
		(
			'logo',
			'phone_number',
			'email_address',
			'contact_name',
			'address_1',
			'address_2',
			'city',
			'state',
			'zip',
			'hours_weekday',
			'hours_saturday',
			'hours_sunday',
			'facebook_link',
			'twitter_link',
			'linkedin_link',
			'instagram_link',
			'about_us'
		)"
	)) {
		$response['success'] = true;
	} else {
		$response['success'] = false;
        $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
	}
    
    echo json_encode($response);
?>