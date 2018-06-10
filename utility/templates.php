<?php
    function add_table_template_field(&$fields, $display_name, $control_name) {
		array_push($fields, array('display_name' => $display_name, 'control_name' => $control_name));
	}

	function add_form_template_field(&$fields, $display_name, $control_name, $type, $required) {
		array_push($fields, array('display_name' => $display_name, 'control_name' => $control_name, 'type' => $type, 'required' => $required));
	}

    function create_table($template) {
        $html = '
        <div class="columns">
            <div class="column">
                <h5 class="title is-5">'.$template['page_name'].'</h5>
                <h6 class="subtitle is-6">View, edit, and add</h6>
            </div>
            <div class="column">
                <div class="field is-grouped is-grouped-right">
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input" type="text" placeholder="Search..">
                        </div>
                        <div class="control">
                            <a class="button">Search</a>
                        </div>
                    </div>
                    &nbsp;&nbsp;
                    <a class="button" onclick="onNavigationClick(\''.$template['page_path'].'/edit.php\');">
                        <span class="icon">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span>Add</span>
                    </a>
                </div>
            </div>
        </div>
        <table class="table is-bordered is-striped is-hoverable is-fullwidth">
            <thead>
                <tr>';
                    foreach ($template['fields'] as $field) {
                        $html .= "<th>".$field["display_name"]."</th>";
                    }
                    $html .= '
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>';
                $query = "SELECT * FROM ".$template['database_table'];
                $search = $template['search'];
                if ($search <> "") {
                    $search = "%".$search."%";
                    $query = $query." WHERE";
                    $where_clause = array();
                    foreach ($template['fields'] as $field) {
                        array_push($where_clause, $field["control_name"]." LIKE '$search'");
                    }
                    $query .= " ".implode(" OR ", $where_clause);
                }
                $result = mysqli_query($template['database_connection'], $query) or die(mysql_error());
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $html .=
                    "<tr>";
                    foreach ($template['fields'] as $field) {
                        $html .= "<td>".$record[$field['control_name']]."</td>";
                    }
                    $html .= "
                        <td style=\"text-align:center;\">
                            <div class=\"field is-grouped\">
                                <p class=\"control\"><a onclick=\"onNavigationClick('".$template['page_path']."/edit.php?id=".$record["id"]."');\" class=\"button\">Edit</a></p>
                                ".(array_key_exists('child_page_path', $template) && array_key_exists('child_page_name', $template) ? 
                                "<p class=\"control\"><a onclick=\"onNavigationClick('".$template['child_page_path']."/?photo_album_id=".$record["id"]."');\" class=\"button\">".$template['child_page_name']."</a></p>" : "")."
                                <p class=\"control\"><a onclick=\"onRecordDeleteClick('".$template['page_path']."', ".$record["id"].", this);\" class=\"button is-danger\">Delete</a></p>
                            </div>
                        </td>
                    </tr>";
                }
            $html .= '
            </tbody>
        </table>';
        return $html;
    }

    function create_form($template) {
        global $FIELD_TYPES;
        $html = '
        <h5 class="title is-5">'.$template['page_name'].'</h5>
        <h6 class="subtitle is-6">Click the save button after making your changes</h6>
        <form>
            <div class="columns is-multiline">';
                $record;
                if ($template['record'] <> NULL) {
                    $record = $template['record'];
                } else {
                    $result = mysqli_query($template['database_connection'], "SELECT * FROM ".$template['database_table']." WHERE id = ".$template['record_id']);
                    $record = mysqli_fetch_assoc($result);
                }
                foreach ($template['fields'] as $field) {
                    $field['value'] = $record[$field['control_name']];
                    switch ($field['type']) {
                        case $FIELD_TYPES['HIDDEN']: 
                            $html .= create_hidden($field); break;
                        case $FIELD_TYPES['TEXT']: 
                            $html .= create_text($field); break;
                        case $FIELD_TYPES['NUMBER']: 
                            $html .= create_number($field); break;
                        case $FIELD_TYPES['TEXTAREA']: 
                            $html .= create_textarea($field); break;
                        case $FIELD_TYPES['IMAGE']: 
                            $html .= create_image_upload($field); break;
                        case $FIELD_TYPES['FILE']: 
                            $html .= create_file_upload($field); break;
                        default:
                            break;
                    }
                }
            $html .= '
            </div>
            <div class="field is-grouped is-grouped-right">
                <p class="control">
                    <button class="button is-primary" onclick="onFormSaveClick(\''.$template['page_path'].'\', this); return false;">Submit</button>
                </p>
                <p class="control">
                    <a class="button is-light" onclick="onNavigationClick(\''.$template['page_path'].'\');">Cancel</a>
                </p>
            </div>
        </form>';
        return $html;
    }

    function create_hidden($field) {
        return '<input type="hidden" name="'.$field['control_name'].'" value="'.$field['value'].'">';
    }

    function create_text($field) {
        return '
        <div class="column is-half">
            <div class="field">
                <label class="label">'.$field['display_name'].'</label>
                <div class="control">
                    <input class="input" type="input" placeholder="'.$field['display_name'].'" name="'.$field['control_name'].'" value="'.$field['value'].'" '.($field['required'] ? "required" : "").'>
                </div>
            </div>
        </div>';
    }

    function create_number($field) {
        return '
        <div class="column is-half">
            <div class="field">
                <label class="label">'.$field['display_name'].'</label>
                <div class="control">
                    <input class="input" type="number" placeholder="'.$field['display_name'].'" name="'.$field['control_name'].'" value="'.$field['value'].'" '.($field['required'] ? "required" : "").'>
                </div>
            </div>
        </div>';
    }

    function create_textarea($field) {
        return '
        <div class="column is-four-fifths">
            <div class="field">
                <label class="label">'.$field['display_name'].'</label>
                <div class="control">
                    <textarea class="textarea" placeholder="'.$field['display_name'].'" name="'.$field['control_name'].'" rows="10" '.($field['required'] ? "required" : "").'>'.$field['value'].'</textarea>
                </div>
            </div>
        </div>';
    }

    function create_image_upload($field) {
        return '
        <div class="column is-four-fifths">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">'.$field['display_name'].'</label>
                        <div class="control">
                            <input class="input" type="input" placeholder="'.$field['display_name'].'" name="'.$field['control_name'].'" value="'.$field['value'].'" '.($field['required'] ? "required" : "").'>
                        </div>
                    </div>
                    <p class="control">
                        <button class="button is-primary" onclick="onImageUploadOpenClick(this); return false;">Upload Image</button>
                    </p>
                </div>
                <div class="column">
                    <figure class="image is-128x128">
                        <img src="'.$field['value'].'">
                    </figure>
                </div>
            </div>
        </div>';
    }

    function create_file_upload($field) {
        return '
        <div class="column is-half">
            <div class="field">
                <label class="label">'.$field['display_name'].'</label>
                <div class="control">
                    <input class="input" type="input" placeholder="'.$field['display_name'].'" name="'.$field['control_name'].'" value="'.$field['value'].'" '.($field['required'] ? "required" : "").'>
                </div>
            </div>
            <p class="control">
                <button class="button is-primary" onclick="onFileUploadOpenClick(this); return false;">Upload File</button>
            </p>
        </div>';
    }
?>