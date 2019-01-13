<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';

    $database_connection = connect_to_database();

    $id = $_POST['id'];
    $type = $_POST['type'];
    $title = addslashes($_POST['title']);
    $slug = addslashes($_POST['slug']);
    $short_description = addslashes($_POST['short_description']);
    $long_description = addslashes($_POST['long_description']);
    $code = addslashes($_POST['code']);
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $is_on_sale = $_POST['is_on_sale'];
    $quantity = $_POST['quantity'];
    $seller = addslashes($_POST['seller']);
    $category = addslashes($_POST['category']);
    $is_published = $_POST['is_published'];
    $main_image_url = addslashes($_POST['main_image_url']);
    $tall_image_url = addslashes($_POST['tall_image_url']);
    $extra_image_url_1 = addslashes($_POST['extra_image_url_1']);
    $extra_image_url_2 = addslashes($_POST['extra_image_url_2']);
    $extra_image_url_3 = addslashes($_POST['extra_image_url_3']);

    $response = array();

	if ($id == "") {
		if (mysqli_query($database_connection, "INSERT INTO products (type, title, slug, short_description, long_description, code, price, sale_price, is_on_sale, quantity, seller, category, is_published, main_image_url, tall_image_url, extra_image_url_1, extra_image_url_2, extra_image_url_3) values('$type', '$title', '$slug', '$short_description', '$long_description', '$code', '$price', '$sale_price', '$is_on_sale', '$quantity', '$seller', '$category', '$is_published', '$main_image_url', '$tall_image_url', '$extra_image_url_1', '$extra_image_url_2', '$extra_image_url_3')")) {
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
	} else {
        $updated_time = date("Y-m-d H:i:s");
		if (mysqli_query($database_connection, "UPDATE products SET type = '$type', title = '$title', slug = '$slug', short_description = '$short_description', long_description = '$long_description', code = '$code', price = '$price', sale_price = '$sale_price', is_on_sale = '$is_on_sale', quantity = '$quantity', seller = '$seller', category = '$category', updated_time = '$updated_time', is_published = '$is_published', main_image_url = '$main_image_url', tall_image_url = '$tall_image_url', extra_image_url_1 = '$extra_image_url_1', extra_image_url_2 = '$extra_image_url_2', extra_image_url_3 = '$extra_image_url_3' where id = '$id'")){ 
			$response['success'] = true;
		} else {
            $response['success'] = false;
            $response['error_message'] = "There was an error saving: ".mysqli_error($database_connection);
		}
    }
    
    echo json_encode($response);
?>