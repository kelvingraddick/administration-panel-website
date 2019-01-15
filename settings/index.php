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
    $template['page_name'] = "Settings";
    $template['page_path'] = "settings";
    $template['database_connection'] = connect_to_database();
    $template['database_table'] = "settings";
    $template['record'] = get_settings($database_connection);
    $template['fields'] = array();
    add_form_template_field($template['fields'], 'Logo URL', 'logo', $FIELD_TYPES['IMAGE'], true);
    add_form_template_field($template['fields'], 'Email Address', 'email_address', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Phone Number', 'phone_number', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Contact Name', 'contact_name', $FIELD_TYPES['TEXT'], true);
    add_form_template_field($template['fields'], 'Address 1', 'address_1', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Address 2', 'address_2', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'City', 'city', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'State', 'state', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Zip', 'zip', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Weekday Hours', 'hours_weekday', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Saturday Hours', 'hours_saturday', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Sunday Hours', 'hours_sunday', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Facebook Link', 'facebook_link', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Twitter Link', 'twitter_link', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'Instagram Link', 'instagram_link', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'LinkedIn Link', 'linkedin_link', $FIELD_TYPES['TEXT'], false);
    add_form_template_field($template['fields'], 'About Us (Who We Are)', 'about_us', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'About Us (Mission)', 'about_us_2', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'About Us (Vision)', 'about_us_3', $FIELD_TYPES['TEXTAREA'], true);
    add_form_template_field($template['fields'], 'About Us (Our Values)', 'about_us_4', $FIELD_TYPES['TEXTAREA'], true);

    echo create_form($template);
?>