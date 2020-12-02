<?php
    ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Vendors";
    $template['page_path'] = "vendors";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "(SELECT vendors.id AS id, user_id, vendors.type AS 'type', business_name, users.email_address AS email_address, description, location_name, is_enabled FROM vendors LEFT JOIN users ON vendors.user_id = users.id) AS vendors";
    $template['search'] = isset($_GET['search']) ? $_GET['search'] : "";
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'User Id', 'user_id');
    add_table_template_field($template['fields'], 'Type', 'type');
    add_table_template_field($template['fields'], 'Business Name', 'business_name');
    add_table_template_field($template['fields'], 'Email Address', 'email_address');
    add_table_template_field($template['fields'], 'Description', 'description');
    add_table_template_field($template['fields'], 'Location Name', 'location_name');
    add_table_template_field($template['fields'], 'Is Enabled?', 'is_enabled');

    echo create_table($template);
?>