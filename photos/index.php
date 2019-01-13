<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Photos";
    $template['page_path'] = "photos";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = isset($_GET['photo_album_id']) ? "(SELECT * FROM photos WHERE photo_album_id = ".$_GET['photo_album_id'].") AS photos" : "photos";
    $template['search'] = $_GET['search'];
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'Photo Album Id', 'photo_album_id');
    add_table_template_field($template['fields'], 'URL', 'url');
    add_table_template_field($template['fields'], 'Title', 'title');
    add_table_template_field($template['fields'], 'Description', 'description');
    add_table_template_field($template['fields'], 'Order', 'order_index');

    echo create_table($template);
?>