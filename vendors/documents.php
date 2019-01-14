<?php
    ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/templates.php';

    $template = array();
    $template['page_name'] = "Vendor Documents";
    $template['page_path'] = "vendors/documents";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "vendor_documents";
    $template['search'] = isset($_GET['search']) ? $_GET['search'] : "";
    $template['fields'] = array();
    add_table_template_field($template['fields'], 'Id', 'id');
    add_table_template_field($template['fields'], 'Vendor Id', 'vendor_id');
    add_table_template_field($template['fields'], 'Type', 'type');
    add_table_template_field($template['fields'], 'URL', 'url');

    $table = create_table($template);
    $table = str_replace('View, edit, and add', 'View', $table);
    $table = str_replace('<a class="button" onclick="onNavigationClick(\'vendors/documents', '<a style="display:none;" onclick="onNavigationClick(\'users/edit', $table);
    $table = str_replace('<a onclick="onNavigationClick(\'vendors/documents/edit', '<a style="display:none;" onclick="onNavigationClick(\'users/edit', $table);
    $table = str_replace('<a onclick="onRecordDeleteClick(\'vendors/documents/', '<a style="display:none;" onclick="onRecordDeleteClick(\'vendors/documents/', $table);
    echo $table;
?>