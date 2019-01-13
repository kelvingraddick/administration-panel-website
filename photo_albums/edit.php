<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/setupshopz/admin/utility/templates.php';

    $database_connection = connect_to_database();

    $template = array();
    $template['page_name'] = "Add/Edit Photo Album";
    $template['page_path'] = "photo_albums";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "photo_albums";
    $template['record_id'] = $_GET['id'];
    $template['fields'] = array();
    add_form_template_field($template['fields'], 'Id', 'id', $FIELD_TYPES['HIDDEN'], false);
    add_form_template_field($template['fields'], 'Cover Image URL', 'image_url', $FIELD_TYPES['IMAGE'], true);
    add_form_template_field($template['fields'], 'Title', 'title', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Description', 'description', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'Order', 'order_index', $FIELD_TYPES['NUMBER'], true);

    echo create_form($template);
?>