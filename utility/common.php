<?php
	$BASE_URL = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];

	$FIELD_TYPES = array(
		"HIDDEN" => 0,
        "TEXT" => 1,
		"TEXTAREA" => 2,
		"NUMBER" => 3,
		"SELECT" => 4,
		"CHECKBOX" => 5,
		"IMAGE" => 6,
		"FILE" => 7
	);

	$USER_TYPES = array(
        "DEFAULT" => 0,
        "ADMIN" => 1
    );
	
	$ERROR_CODES = array(
        "NONE" => 0,
        "SERVER_PROBLEM" => 1,
        "DATABASE_PROBLEM" => 2,
        "EMAIL_TAKEN" => 3,
        "PHONE_TAKEN" => 4,
        "INVALID_CREDENTIALS" => 5
    );

	function connect_to_database() {
		$database_connection = mysqli_connect($GLOBALS['database_host'],
							$GLOBALS['database_username'],
							$GLOBALS['database_password'],
							$GLOBALS['database_name'])
							or die("Cannot connect to database.");
		mysqli_set_charset($database_connection, "utf8mb4");
		return $database_connection;
	}

	function get_settings($database_connection) {
		$settings = mysqli_query($database_connection, "SELECT * FROM settings");
		if (!$settings) { echo 'Could not load settings data.'; exit; }
		$setting = array();
		while($row = mysqli_fetch_assoc($settings)) {
			$setting[$row['code']] = $row['value'];
		}
		return $setting;
	}

	function mysqli_result($mysqli, $sql) {
		$result = $mysqli->query($sql);
		$value = $result->fetch_array(MYSQLI_NUM);
		return is_array($value) ? $value[0] : "";
	}

	function upload_file($name, $directory, $levels_from_root) {
		global $BASE_URL;
		$url = null;
		if ($_FILES['file']['name']) {
			$extension = strtolower(_file_extension(stripslashes($_FILES['file']['name'])));
			$filename = $name.'.'.$extension;
			$file_path = _root_path($levels_from_root).$directory.$filename;
			if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) { 
				$url = $BASE_URL.$directory.$filename;
			}
		}
		return $url;
	}

	function is_date($string) {
		if (!$string) { return false; }
		try { new \DateTime($string); return true; } 
		catch (\Exception $error) { return false; }
	}

	function _file_extension($str) {
		$i = strrpos($str,'.');
		if (!$i) { return ''; } 
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	function _root_path($levels_from_root) {
		if ($levels_from_root != null && $levels_from_root > 0) {
			$path = '..';
			for ($i=1; $i<$levels_from_root; $i++) { $path = $path.'/..'; }
			return $path;
		}
		return '';
	}

	function reArrayFiles(&$file_post) {
		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);
		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}
?>