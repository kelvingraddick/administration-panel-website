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
    $template['page_name'] = "Add/Edit Vendor";
    $template['page_path'] = "vendors";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "vendors";
    $template['record_id'] = $_GET['id'];
    $template['fields'] = array();
    add_form_template_field($template['fields'], 'Id', 'id', $FIELD_TYPES['HIDDEN'], false);
    add_form_template_field($template['fields'], 'User Id', 'user_id', $FIELD_TYPES['HIDDEN'], false);
    add_form_template_field($template['fields'], 'Type', 'type', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Business Name', 'business_name', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Description', 'description', $FIELD_TYPES['TEXT_AREA'], true);
    add_form_template_field($template['fields'], 'Location Name', 'location_name', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Latitude', 'latitude', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Longitude', 'longitude', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Logo', 'logo_url', $FIELD_TYPES['IMAGE'], true);
    add_form_template_field($template['fields'], 'Banner Image', 'banner_image_url', $FIELD_TYPES['IMAGE'], false);
    add_form_template_field($template['fields'], 'Website', 'website_url', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Instagram Handle', 'instagram_handle', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Facebook Handle', 'facebook_handle', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Handclaps', 'handclaps', $FIELD_TYPES['NUMBER'], true);
    add_form_template_field($template['fields'], 'Is Enabled (0 = no; 1 = yes)', 'is_enabled', $FIELD_TYPES['NUMBER'], false);

    echo create_form($template);
?>