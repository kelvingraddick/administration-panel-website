<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Products";
    $template['page_path'] = "products";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "products";
    $template['search'] = $_GET['search'];
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'Type', 'type');
    add_table_template_field($template['fields'], 'Title', 'title');
    add_table_template_field($template['fields'], 'Short Description', 'short_description');
    add_table_template_field($template['fields'], 'Main Image URL', 'main_image_url');
    add_table_template_field($template['fields'], 'Created Time', 'created_time');

    echo create_table($template);
?>