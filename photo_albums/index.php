<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Photo Albums";
    $template['page_path'] = "photo_albums";
    $template['child_page_path'] = "photos";
    $template['child_page_name'] = "Photos";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "photo_albums";
    $template['search'] = $_GET['search'];
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'Title', 'title');
    add_table_template_field($template['fields'], 'Description', 'description');
    add_table_template_field($template['fields'], 'Cover Image URL', 'image_url');
    add_table_template_field($template['fields'], 'Order', 'order_index');

    echo create_table($template);
?>