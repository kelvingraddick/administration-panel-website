<?php
    ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Users";
    $template['page_path'] = "users";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "users";
    $template['search'] = isset($_GET['search']) ? $_GET['search'] : "";
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'Email Address', 'email_address');
    add_table_template_field($template['fields'], 'Phone Number', 'phone_number');
    add_table_template_field($template['fields'], 'First Name', 'first_name');
    add_table_template_field($template['fields'], 'Last Name', 'last_name');

    $table = create_table($template);
    $table = str_replace('View, edit, and add', 'View and delete', $table);
    $table = str_replace('<a class="button" onclick="onNavigationClick(\'users/edit', '<a style="display:none;" onclick="onNavigationClick(\'users/edit', $table);
    $table = str_replace('<a onclick="onNavigationClick(\'users/edit', '<a style="display:none;" onclick="onNavigationClick(\'users/edit', $table);
    echo $table;
?>