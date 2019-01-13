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
    $template['page_name'] = "Add/Edit Blog Post";
    $template['page_path'] = "blog_posts";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "blog_posts";
    $template['record_id'] = $_GET['id'];
    $template['fields'] = array();
    add_form_template_field($template['fields'], 'Id', 'id', $FIELD_TYPES['HIDDEN'], false);
    add_form_template_field($template['fields'], 'Type', 'type', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Title', 'title', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Slug', 'slug', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Description', 'description', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'Content', 'content', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'Author', 'author', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Is Published?', 'is_published', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Main Image URL', 'main_image_url', $FIELD_TYPES['IMAGE'], true);
    add_form_template_field($template['fields'], 'Tall Image URL', 'tall_image_url', $FIELD_TYPES['IMAGE'], false);

    echo create_form($template);
?>