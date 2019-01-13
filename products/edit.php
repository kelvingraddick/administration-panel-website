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
    $template['page_name'] = "Add/Edit Product";
    $template['page_path'] = "products";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "products";
    $template['record_id'] = $_GET['id'];
    $template['fields'] = array();
    add_form_template_field($template['fields'], 'Id', 'id', $FIELD_TYPES['HIDDEN'], false);
    add_form_template_field($template['fields'], 'Type', 'type', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Title', 'title', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Slug', 'slug', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Short Description', 'short_description', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'Long Description', 'long_description', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'Code', 'code', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Price', 'price', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Sale Price', 'sale_price', $FIELD_TYPES['NUMBER'], false);
    add_form_template_field($template['fields'], 'Is On Sale?', 'is_on_sale', $FIELD_TYPES['NUMBER'], false);
    add_form_template_field($template['fields'], 'Quantity', 'quantity', $FIELD_TYPES['NUMBER'], false);
    add_form_template_field($template['fields'], 'Seller', 'seller', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Category', 'category', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Is Published?', 'is_published', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Main Image URL', 'main_image_url', $FIELD_TYPES['IMAGE'], true);
    add_form_template_field($template['fields'], 'Tall Image URL', 'tall_image_url', $FIELD_TYPES['IMAGE'], false);
    add_form_template_field($template['fields'], 'Extra Image URL 1', 'extra_image_url_1', $FIELD_TYPES['IMAGE'], false);
    add_form_template_field($template['fields'], 'Extra Image URL 2', 'extra_image_url_2', $FIELD_TYPES['IMAGE'], false);
    add_form_template_field($template['fields'], 'Extra Image URL 3', 'extra_image_url_3', $FIELD_TYPES['IMAGE'], false);

    echo create_form($template);
?>