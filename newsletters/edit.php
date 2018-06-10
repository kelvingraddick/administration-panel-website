<?php
    //ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/templates.php';

    $database_connection = connect_to_database();

    $template = array();
    $template['page_name'] = "Add/Edit Newsletter";
    $template['page_path'] = "newsletters";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "newsletters";
    $template['record_id'] = $_GET['id'];
    $template['fields'] = array();
    add_form_template_field($template['fields'], 'Id', 'id', $FIELD_TYPES['HIDDEN'], false);
    add_form_template_field($template['fields'], 'Title', 'title', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'PDF URL', 'url', $FIELD_TYPES['FILE'], true);
    add_form_template_field($template['fields'], 'Date (YYYY-MM-DD)', 'created_time', $FIELD_TYPES['TEXT'], true);

    echo create_form($template);
?>