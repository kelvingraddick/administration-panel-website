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
    $title = addslashes($_POST['title']);
    $slug = addslashes($_POST['slug']);
    $description = addslashes($_POST['description']);
    $content = addslashes($_POST['content']);
    $author = addslashes($_POST['author']);
    $is_published = $_POST['is_published'];
    $main_image_url = addslashes($_POST['main_image_url']);
    $tall_image_url = addslashes($_POST['tall_image_url']);

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO blog_posts (type, title, slug, description, content, author, is_published, main_image_url, tall_image_url) values(0, '$title', '$slug', '$description', '$content', '$author', '$is_published', '$main_image_url', '$tall_image_url')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
        $updated_time = date("Y-m-d H:i:s");
		if (mysqli_query($database_connection, "UPDATE blog_posts SET type = '$type', title = '$title', slug = '$slug', description = '$description', content = '$content', author = '$author', is_published = '$is_published', updated_time = '$updated_time', main_image_url = '$main_image_url', tall_image_url = '$tall_image_url' where id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>