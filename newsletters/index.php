<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Newsletters";
    $template['page_path'] = "newsletters";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "newsletters";
    $template['search'] = $_GET['search'];
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'Title', 'title');
    add_table_template_field($template['fields'], 'PDF URL', 'url');
    add_table_template_field($template['fields'], 'Date', 'created_time');

    echo create_table($template);
?>