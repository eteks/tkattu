<?php

// The HTML href link wrapper function
function href_link($page = '', $parameters = '', $connection = 'NONSSL') {

    if ($page == '') {
        die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>Function used:<br><br>href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    
    if ($connection == 'NONSSL') {
        $link = HTTP_SERVER . DIR_WS_ADMIN;
    } elseif ($connection == 'SSL') {
        if (ENABLE_SSL == 'true') {
            $link = HTTPS_SERVER . DIR_WS_ADMIN;
        } else {
            $link = HTTP_SERVER . DIR_WS_ADMIN;
        }
    } else {
        die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL<br><br>Function used:<br><br>href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    
    if ($parameters == '') {
        $link = $link . $page;
    } else {
        $link = $link . $page . '?' . $parameters ;
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);
    return $link;
}

////
// The HTML image wrapper function
function image($src, $alt = '', $width = '', $height = '', $params = '') {
    $image = '<img src="' . $src . '" border="0" alt="' . $alt . '"';
    if ($alt) {
        $image .= ' title=" ' . $alt . ' "';
    }
    
    if ($width) {
        $image .= ' width="' . $width . '"';
    }
    
    if ($height) {
        $image .= ' height="' . $height . '"';
    }
    
    if ($params) {
        $image .= ' ' . $params;
    }
    
    $image .= '>';

    return $image;
}

// The HTML form submit button wrapper function
// Outputs a button in the selected language
function image_submit($image, $alt = '', $parameters = '') {
    global $language;
    $image_submit = '<input type="image" src="' . output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" border="0" alt="' . output_string($alt) . '"';

    if (not_null($alt)) $image_submit .= ' title=" ' . output_string($alt) . ' "';
    
    if (not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= '>';

    return $image_submit;
}

////
// Draw a 1 pixel black line
function black_line() {
    return image(DIR_WS_IMAGES . 'pixel_black.gif', '', '100%', '1');
}

////
// Output a separator either through whitespace, or with an image
function draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return image(DIR_WS_IMAGES . $image, '', $width, $height);
}

////
// Output a function button in the selected language
function image_button($image, $alt = '', $params = '') {
    global $language;
    return image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $params);
}

////
// Output a form
function draw_form($name, $action, $parameters = '', $method = 'post', $params = '') {
    $form = '<form name="' . output_string($name) . '" action="';
    if (not_null($parameters)) {
        $form .= href_link($action, $parameters);
    } else {
        $form .= href_link($action);
    }
    
    $form .= '" method="' . output_string($method) . '"';
    
    if (not_null($params)) {
        $form .= ' ' . $params;
    }
    
    $form .= '>';
    return $form;
}

////
// Output a form input field
function draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . output_string($type) . '" name="' . output_string($name) . '"';

    if (isset($GLOBALS[$name]) && ($reinsert_value == true) && is_string($GLOBALS[$name])) {
        $field .= ' value="' . output_string(stripslashes($GLOBALS[$name])) . '"';
    } else if (not_null($value)) {
        $field .= ' value="' . output_string($value) . '"';
    }

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
}

////
// Output a form password field
function draw_password_field($name, $value = '', $required = false) {
    $field = draw_input_field($name, $value, 'maxlength="40"', $required, 'password', false);
    return $field;
}

////
// Output a form filefield
function draw_file_field($name, $required = false) {
    $field = draw_input_field($name, '', '', $required, 'file');
    return $field;
}

////
// Output a selection field - alias function for draw_checkbox_field() and draw_radio_field()
function draw_selection_field($name, $type, $value = '', $checked = false, $compare = '') {
    $selection = '<input type="' . output_string($type) . '" name="' . output_string($name) . '"';

    if (not_null($value)) $selection .= ' value="' . output_string($value) . '"';

    if ( ($checked == true) || (isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ($GLOBALS[$name] == 'on')) || (isset($value) && isset($GLOBALS[$name]) && (stripslashes($GLOBALS[$name]) == $value)) || (not_null($value) && not_null($compare) && ($value == $compare)) ) {
        $selection .= ' CHECKED';
    }

    $selection .= '>';

    return $selection;
}

////
// Output a form checkbox field
function draw_checkbox_field($name, $value = '', $checked = false, $compare = '') {
    return draw_selection_field($name, 'checkbox', $value, $checked, $compare);
}

////
// Output a form radio field
function draw_radio_field($name, $value = '', $checked = false, $compare = '') {
    return draw_selection_field($name, 'radio', $value, $checked, $compare);
}

////
// Output a form textarea field
function draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    $field = '<textarea name="' . output_string($name) . '" wrap="' . output_string($wrap) . '" cols="' . output_string($width) . '" rows="' . output_string($height) . '"';

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
        $field .= stripslashes($GLOBALS[$name]);
    } else if (not_null($text)) {
        $field .= $text;
    }

    $field .= '</textarea>';

    return $field;
}

////
// Output a form hidden field
function draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . output_string($name) . '"';

    if (not_null($value)) {
        $field .= ' value="' . output_string($value) . '"';
    } else if (isset($GLOBALS[$name]) && is_string($GLOBALS[$name])) {
        $field .= ' value="' . output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
}

////
// Output a form pull down menu
function draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false, $current_id = '0') {

    $field = '<select name="' . output_string($name) . '"';

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = ($GLOBALS[$name]);

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {

        $is_disabled = (($current_id && $values[$i]['id'] == $current_id) ? 'disabled="true"' : '');
        
        $field .= '<option value="' . output_string($values[$i]['id']) . '"';

            if (is_array($default)) {
                 $key_value = $values[$i]['id'];
                 if (in_array($key_value, $default)) $field .= ' SELECTED';
            } else {
               if ($default == $values[$i]['id']) {
                $field .= ' SELECTED';
               }
            }

        $field .= ' ' . $is_disabled . '>' . output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';

    }
    $field .= '</select>';

    if ($required == true) $field .= "Text Field Required";
    return $field;
}

// Output a form pull down multiple menu select 
function draw_pull_down_menu_multiple($name, $values, $default = '', $parameters = '', $required = false) {
    $field = '<select name="' . output_string($name) . '"';

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= 'multiple>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
        $field .= '<option value="' . output_string($values[$i]['id']) . '"';
            if (is_array($default)) {
                 $key_value = $values[$i]['id'];
				 if (in_array($key_value, $default)) $field .= ' SELECTED';
            } else {
               if ($default == $values[$i]['id']) {
                $field .= ' SELECTED';
               }
		    }

        $field .= '>' . output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= "Text Field Required";
    return $field;
}

//hide values///
/*function draw_pull_down_menu_hide($name, $values, $default = '', $parameters = '', $required = false) {
    $field = '<select name="' . output_string($name) . '"';

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
        $field .= '<option value="' . output_string($values[$i]['id']) . '"';
            if (is_array($default)) {
                 $key_value = $values[$i]['id'];
				 if (in_array($key_value, $default)) $field .= ' SELECTED';
            } else {
               if ($default == $values[$i]['id']) {
                $field .= ' SELECTED';
               }
			   
			   
			   if($values[$i]['text'] == 'Parents') {
			   		
					echo "<script>alert('hai');</script>";
					echo "<script>document.getElementById('hide_1').style.display ='none';
					document.getElementById('hide_2').style.display ='none';</script>";
			   } /*else {
			   		echo "<script>document.getElementById('hide_1').style.display ='block';
					document.getElementById('hide_2').style.display ='block';</script>";
			   }
			   
		    }

        $field .= '>' . output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= "Text Field Required";
    return $field;
}*/
//end hide values//

/*function draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    $field = '<select name="' . output_string($name) . '"';

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
        $field .= '<option value="' . output_string($values[$i]['id']) . '"';
        if ($default == $values[$i]['id']) {
            $field .= ' SELECTED';
        }

        $field .= '>' . output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= "Text Field Required";
    return $field;
}*/
?>