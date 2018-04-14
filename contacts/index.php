<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Contacts";
    $template['page_path'] = "contacts";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "contacts";
    $template['search'] = $_GET['search'];
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'First Name', 'first_name');
    add_table_template_field($template['fields'], 'Last Name', 'last_name');
    add_table_template_field($template['fields'], 'Email Address', 'email_address');
	add_table_template_field($template['fields'], 'Phone Number', 'phone_number');
	add_table_template_field($template['fields'], 'Notes', 'notes');

    echo create_table($template);
?>