<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Events";
    $template['page_path'] = "events";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "events";
    $template['search'] = $_GET['search'];
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'Title', 'title');
    add_table_template_field($template['fields'], 'Description', 'description');
    add_table_template_field($template['fields'], 'Date And Time', 'date_and_time');
	add_table_template_field($template['fields'], 'Location', 'location');
    add_table_template_field($template['fields'], 'Image', 'image_url');
    add_table_template_field($template['fields'], 'Order', 'order_index');

    echo create_table($template);
?>