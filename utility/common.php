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

	function send_email($parameters) {
        $url = "https://api.sendgrid.com/v3/mail/send";
        $content = '{
            "personalizations": [
                {
                    "to": [
                        {
                            "email": '.json_encode($parameters['recipient_email_address']).',
                            "name": '.json_encode($parameters['recipient_name']).'
                        }
					],
                    "subject": '.json_encode($parameters['subject']).'
                }
            ],
            "from": {
                "email": "notifications@cutcornersapp.com",
                "name": "Cut Corners"
            },
			"content": [
                {
                    "type": "text/html",
                    "value": '.json_encode($parameters['body']).'
                }
            ]
        }';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json", "Authorization: Bearer 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"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$curl_response = json_decode(curl_exec($curl));
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($status != 202) { 
			$curl_response -> error_message = "Error: call to URL $url failed with status $status, response ".json_encode($curl_response).", curl_error ".curl_error($curl).", curl_errno ".curl_errno($curl);
		}
		curl_close($curl);
		return $curl_response;
	}

	function get_email_template($content, $setting) {
        $template = '
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <style type="text/css">
            table {
                border-spacing: 0;
            }
            table td {
                border-collapse: collapse;
            }
            @media screen and (max-width: 600px) {
                table[class="container"] {
                    width: 95% !important;
                }
            }
            @media screen and (max-width: 480px) {
                td[class="container-padding"] {
                    padding-left: 12px !important;
                    padding-right: 12px !important;
                }
            }
            @media only screen and (max-width : 600px) {
                td[class="force-col"] {
                    display: block;
                    padding-right: 0 !important;
                }
            }
        </style>
        <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#ebebeb">
            <tbody>
                <tr>
                    <td align="center" valign="top" bgcolor="#ebebeb" style="background-color: #ebebeb;">
                        <br><br>
                        <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td class="container-padding" bgcolor="#ffffff" 
                                        style="background-color: #ffffff; padding-left: 30px; padding-right: 30px; font-size: 14px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;-moz-box-shadow: 3px 3px 3px 3px #ccc; -webkit-box-shadow: 3px 3px 3px 3px #ccc; box-shadow: 3px 3px 3px 3px #ccc;&nbsp;border-radius:10px;">
                                        <br>
                                        <img src="{logo_url}" width="25%">
                                        <br> 
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td class="force-col" style="background-color: #ffffff; font-size: 13px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;" valign="top">
                                                        <br>
                                                        {content}                                
                                                        <br><br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <span style="font-size: 12px; font-family: Helvetica, sans-serif; color: #333;"><a href="http://www.cutcornersapp.com/email/unsubscribe/">Unsubscibe</a></span>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>';
        $template = str_replace("{logo_url}", $setting['logo'], $template);
        $template = str_replace("{content}", $content, $template);
        $template = str_replace("{facebook_link}", $setting['facebook_link'], $template); 
        $template = str_replace("{instagram_link}", $setting['instagram_link'], $template);
        $template = str_replace("{twitter_link}", $setting['twitter_link'], $template);
        $template = str_replace("{linkedin_link}", $setting['linkedin_link'], $template);
        return $template;
    }
?>