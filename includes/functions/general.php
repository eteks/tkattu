<?php
/*function send_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address)
{
    if (SEND_EMAILS != 'true') return false;
    // Instantiate a new mail object
    $message = new email(array('X-Mailer: osCommerce Mailer'));

    // Build the text version
    $text = strip_tags($email_text);
    if (EMAIL_USE_HTML == 'true') {
        $message->add_html($email_text, $text);
    } else {
        $message->add_text($text);
    }

    // Send message
    $message->build_message();
    $message->send($to_name, $to_email_address, $from_email_name, $from_email_address, $email_subject);
}*/
function send_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address, $header_text="") {

    if (SEND_EMAILS != 'true') return false;

    // Instantiate a new mail object
    $message = new email(array('X-Mailer: osCommerce Mailer'));

    // Build the text version
    $text = strip_tags($email_text);
    if (EMAIL_USE_HTML == 'true') {
      $message->add_html($email_text, $text);
    } else {
      $message->add_text($text);
    }

    // Send message
    $message->build_message();
    $message->send($to_name, $to_email_address, $from_email_name, $from_email_address, $email_subject, $header_text);

  }

// Redirect to another page or site
function redirect($url) {
    echo "text 1";
		header('Location: ' . $url);
		echo "text 2";
    exit;
}

// Parse the data used in the html tags to ensure the tags will not break
function parse_input_field_data($data, $parse) {
    return strtr(trim($data), $parse);
}

function output_string($string, $translate = false, $protected = false) {
    if ($protected == true) {
        return htmlspecialchars($string);
    } else {
        if ($translate == false) {
            return parse_input_field_data($string, array('"' => '&quot;'));
        } else {
            return parse_input_field_data($string, $translate);
        }
    }
}

function output_string_protected($string) {
    return output_string($string, false, true);
}

function sanitize_string($string) {
    $string = ereg_replace(' +', ' ', $string);
    return preg_replace("/[<>]/", '_', $string);
}

function get_all_get_params($exclude_array = '') {
    global $HTTP_GET_VARS;

    if ($exclude_array == '') $exclude_array = array();

    $get_url = '';

    reset($HTTP_GET_VARS);
    while (list($key, $value) = each($HTTP_GET_VARS)) {
        if (($key != session_name()) && ($key != 'error') && (!in_array($key, $exclude_array))) $get_url .= $key . '=' . $value . '&';
    }

    return $get_url;
}

function date_long($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return strftime(DATE_FORMAT_LONG, mktime($hour, $minute, $second, $month, $day, $year));
}

// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
function date_short($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) == $year) {
        return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    } else {
        return ereg_replace('2037' . '$', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
    }

}

function datetime_short($raw_datetime) {
    if ( ($raw_datetime == '0000-00-00 00:00:00') || ($raw_datetime == '') ) return false;

    $year = (int)substr($raw_datetime, 0, 4);
    $month = (int)substr($raw_datetime, 5, 2);
    $day = (int)substr($raw_datetime, 8, 2);
    $hour = (int)substr($raw_datetime, 11, 2);
    $minute = (int)substr($raw_datetime, 14, 2);
    $second = (int)substr($raw_datetime, 17, 2);

    return strftime(DATE_TIME_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
}

function break_string($string, $len, $break_char = '-') {
    $l = 0;
    $output = '';
    for ($i=0, $n=strlen($string); $i<$n; $i++) {
        $char = substr($string, $i, 1);
        if ($char != ' ') {
            $l++;
        } else {
            $l = 0;
        }

        if ($l > $len) {
            $l = 1;
            $output .= $break_char;
        }
        $output .= $char;
    }
    return $output;
}

function not_null($value) {
    if (is_array($value)) {
        if (sizeof($value) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
            return true;
        } else {
            return false;
        }
    }
}

function browser_detect($component) {
    global $HTTP_USER_AGENT;
    return stristr($HTTP_USER_AGENT, $component);
}

// Retreive server information
function get_system_information() {
    global $HTTP_SERVER_VARS;

    $db_query = db_query("select now() as datetime");
    $db = db_fetch_array($db_query);

    list($system, $host, $kernel) = preg_split('/[\s,]+/', @exec('uname -a'), 5);

    return array(
        'date' => datetime_short(date('Y-m-d H:i:s')),
        'system' => $system,
        'kernel' => $kernel,
        'host' => $host,
        'ip' => gethostbyname($host),
        'uptime' => @exec('uptime'),
        'http_server' => $HTTP_SERVER_VARS['SERVER_SOFTWARE'],
        'php' => PHP_VERSION,
        'zend' => (function_exists('zend_version') ? zend_version() : ''),
        'db_server' => DB_SERVER,
        'db_ip' => gethostbyname(DB_SERVER),
        'db_version' => 'MySQL ' . (function_exists('mysql_get_server_info') ? mysql_get_server_info() : ''),
        'db_date' => datetime_short($db['datetime'])
    );
}

// Wrapper function for round() for php3 compatibility
function tep_round($value, $precision) {
    if (PHP_VERSION < 4) {
        $exp = pow(10, $precision);
        return round($value * $exp) / $exp;
    } else {
        return round($value, $precision);
    }
}

// Return a random value
function tep_rand($min = null, $max = null) {
    static $seeded;

    if (!$seeded) {
        mt_srand((double)microtime()*1000000);
        $seeded = true;
    }

    if (isset($min) && isset($max)) {
        if ($min >= $max) {
            return $min;
        } else {
            return mt_rand($min, $max);
        }
    } else {
        return mt_rand();
    }
}

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
function convert_linefeeds($from, $to, $string) {
    if ((PHP_VERSION < "4.0.5") && is_array($from)) {
        return ereg_replace('(' . implode('|', $from) . ')', $to, $string);
    } else {
        return str_replace($from, $to, $string);
    }
}

function string_to_int($string) {
    return (int)$string;
}

function rteSafe($strText) {
    //returns safe code for preloading in the RTE
    $tmpString = $strText;

    //convert all types of single quotes
    $tmpString = str_replace(chr(145), chr(39), $tmpString);
    $tmpString = str_replace(chr(146), chr(39), $tmpString);
    $tmpString = str_replace("'", "&#39;", $tmpString);

    //convert all types of double quotes
    $tmpString = str_replace(chr(147), chr(34), $tmpString);
    $tmpString = str_replace(chr(148), chr(34), $tmpString);
//  $tmpString = str_replace("\"", "\"", $tmpString);

    //replace carriage returns & line feeds
    $tmpString = str_replace(chr(10), " ", $tmpString);
    $tmpString = str_replace(chr(13), " ", $tmpString);

    return $tmpString;
}


function unhtmlentities ($string) {
    // Get HTML entities table
    $trans_tbl = get_html_translation_table (HTML_ENTITIES, ENT_QUOTES);
    // Flip keys<==>values
    $trans_tbl = array_flip ($trans_tbl);
    // Add support for &apos; entity (missing in HTML_ENTITIES)
    $trans_tbl += array('&apos;' => "'");
    // Replace entities by values
    return strtr ($string, $trans_tbl);
}

function get_file_extension ($string) {
    $extension_arr = array();
    $extension_arr = explode("/", $string);
    if (strtoupper($extension_arr[count($extension_arr) - 1])   == "PJPEG") {
      return "jpeg";
    } else {
      return $extension_arr[count($extension_arr) - 1];
    }
}

function create_thumbnail_image($image_filename, $thumbnail_image_width=0, $thumbnail_image_height=0)
{
    if (!not_null ($thumbnail_filename=="")) {
        $thumb = explode(".", $image_filename);
        $thumbnail_filename = $thumb[0]."_thumb.".$thumb[1];
    }
    $thumb = new Thumbnail($image_filename);
    $thumb->resize((int)$thumbnail_image_width, (int)$thumbnail_image_height); // saves thumb nail in the directory specified in the $image_directory
    $thumb->save($image_filename);
}

function get_image_extension($image_type, $uploaded_file=false)
{
    if ($uploaded_file) {
        $image_type_exten = explode("/", $image_type);
        if (strtoupper($image_type_exten[count($image_type_exten) - 1]) == "PJPEG") {
            return "jpeg";
        } else {
            return $image_type_exten[count($image_type_exten) - 1];
        }
    } else {
        $image_type_exten = explode(".", $image_type);
        if (strtoupper($image_type_exten[count($image_type_exten) - 1]) == "PJPEG") {
            return "jpeg";
        } else {
            return $image_type_exten[count($image_type_exten) - 1];
        }
    }
}
function get_http_url($webname) {
    $http_str = substr($webname, 0, 4);
    if (strtoupper($http_str)!="HTTP") $webname = "http://" . $webname;
    return $webname;
}
function uploadedImageValidation($upload_image, $max_width=0, $max_height=0, $max_size=0, $add_on='') {

    $error_msg = "";
    $max_size = (int) $max_size;
    if (is_array ($upload_image) && $upload_image["error"]!=4) {

        $upload_image_type = explode( "/", $upload_image['type']);

        if ($upload_image['size'] == 0) {
            $error_msg = "Invalid image uploaded<BR>";
        } else {

            if (!not_null($error_msg) && (strtoupper(end($upload_image_type))!= "PJPEG") && (strtoupper(end($upload_image_type))!= "JPG") && (strtoupper(end($upload_image_type))!="JPEG") && (strtoupper(end($upload_image_type))!="GIF") && (strtoupper(end($upload_image_type))!="PNG")) {
                $error_msg.= "Invalid image format<BR>";
            }

            if ($max_size && $upload_image['size'] > $max_size) {
                //$error_msg = "Image size should not exceed " . (($max_size/1024)/1024) . " MB";

                if ($max_size >=1024 && $max_size < (1024 * 1024)) $max_size = ($max_size/1024) . " KB ";
                else if ($max_size >= (1024*1024)) $max_size = (($max_size/1024)/1024) . " MB ";
                else $max_size = $max_size . " Bytes ";

                $error_msg = "Image size should not exceed " . $max_size;

            }

            // Upload Image height and width validation
            if ($max_width && $max_height) {

                $image_size = @getimagesize($upload_image['tmp_name']);

                if ($add_on == '') {

                    if (( $max_width && $image_size[0] > $max_width ) || ( $max_height && $image_size[1] > $max_height) ) {
                        $error_msg .= "<BR>Invalid image dimension ! Maximum dimension is (" . $max_width . " X " . $max_height . ") px.";
                    }

                } else if ($add_on == 'pics') {

                    if (( $max_width && $image_size[0] < $max_width ) || ( $max_height && $image_size[1] < $max_height) ) {
                        $error_msg .= "<BR>Invalid image dimension ! Minimum dimension is (" . $max_width . " X " . $max_height . ") px.";
                    }

                }

            }
        }
        if ($error_msg == "") {
            return 1;
        } else {
            return $error_msg;
        }
    } else {
        return $error_msg = "Invalid photo";
    }
}

function SentMail($toEmail,$Subject,$Message,$fromEmail,$file="",$toName="",$fromName="",$MailType=""){

     $mail = new PHPMailer();
     $mail->IsSMTP();                   // set mailer to use SMTP
     //$mail->Host = "192.168.1.5";     // specify main and backup server
     $mail->Host = EMAIL_HOST_NAME;     // specify main and backup server
     $mail->SMTPAuth = false;           // turn on SMTP authentication
     $mail->from = $fromEmail;
     $mail->fromName = $fromName;
     $mail->AddAddress($toEmail, $toName);
     $mail->WordWrap = 50;
     $mail->AddAttachment($file);
     $mail->IsHTML(true);
     $mail->CharSet = 'utf-8';
     $mail->Subject = $Subject;
     $mail->Body    = $Message;
     $mail->AddReplyTo("no-reply@universitylane.com");
         if(!$mail->Send()){
           echo "Message could not be sent. <p>";
           echo "Mailer Error: " . $mail->ErrorInfo;
           exit;
        }
    return true;
}

function RedirectReferee( $message, $url, $waitTime = 30, $alt = 1 ) {
   $HTML = "<html>
               <head>
                 <title>Redirecting...</title>
	                 <meta http-equiv='refresh' content='$waitTime; URL=$url' level='_parent'>
				   <link REL='stylesheet' HREF='css/common.css' TYPE='text/css'>
                 </head>
                 <body> ";
    if ( $message ) $HTML .= "<center><p>&nbsp;</p><p class=\"genblack\"><b>$message</b></p></center> ";
    if ($alt != 0) $HTML .= "<center><p  class=\"genblack\"><a href='$url'>click here to continue</a>.</p><p>&nbsp;</p></center>";
    $HTML .= "</body></html>";
    echo $HTML;
}
function getsupplier($tableno)
{
  $select = db_query("SELECT supplier_name FROM ".TABLE_HMS_SUPPLIER_CREATION." a LEFT JOIN ".TABLE_HMS_SUPPLIER_MAPPING." b  ON a.supplier_id=b.supplier_id WHERE a.active='Y' AND b.active='Y' AND b.table_no_id='$tableno'");
  if(db_num_rows($select)>0)
  $fetch = db_fetch_array($select);
  return $fetch['supplier_name'];
}
function itemtypename($id)
{
   $hms_info_fetch_allrec_sql = "SELECT item_type_name FROM " . TABLE_HMS_ITEM_TYPE. " WHERE item_type_id='".$id."'";
    $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
    $hms_info_fetch_records = db_fetch_array($hms_info_all_records);
    return $hms_info_fetch_records['item_type_name']; 
}
function gettablename($tableno)
{
  $select = db_query("SELECT table_no FROM ".TABLE_HMS_TABLE_ENTRY." WHERE table_entry_id='".$tableno."'");
  if(db_num_rows($select)>0)
  $fetch = db_fetch_array($select);
  return $fetch['table_no'];
}
function unitname($id)
{
   $unit_fetch_singrec_sql =  "SELECT unit_name FROM " . TABLE_HMS_UNIT_ENTRY . " WHERE `unit_entry_id` = '$id'";
    $unit_sing_records = db_query ($unit_fetch_singrec_sql);
    $unit_sing_fetch_records = db_fetch_array($unit_sing_records);
    return $unit_sing_fetch_records['unit_name'];
}
function menuname($id)
{
    $select =  "SELECT menu_name FROM " . TABLE_HMS_MENUENTRY . " WHERE `menu_id` = '$id'";
    $run = db_query ($select);
    $fetch = db_fetch_array($run);
    return $fetch['menu_name'];
}
function itemname($id)
{
    $select =  "SELECT item_entry_name FROM " . TABLE_HMS_ITEM_ENTRY . " WHERE `item_entry_id` = '$id'";
    $run = db_query ($select);
    $fetch = db_fetch_array($run);
    return $fetch['item_entry_name'];
}
function itemcode($id)
{
    $select =  "SELECT menu_id FROM " . TABLE_HMS_MENUENTRY . " WHERE `item_code` = '$id'";
    $run = db_query ($select);
    $fetch = db_fetch_array($run);
    return $fetch['menu_id'];
}
function vendorname($id)
{
    $select =  "SELECT 	vendor_name FROM " . TABLE_HMS_VENDOR_CREATION . " WHERE `vendor_id` = '$id'";
    $run = db_query ($select);
    $fetch = db_fetch_array($run);
    return $fetch['vendor_name'];
}

function roundoff($str)
{
  $afterpoint = explode('.',$str);
  $decimal = '0.'.$afterpoint[1];
  $result = (($decimal<=0.50)  ? number_format((float)$afterpoint[0], 2, '.', ''):number_format((float)$afterpoint[0]+1, 2, '.', ''));
  return $result;  
}
function gettablenamemul($multableno)
{
  $tableids = explode(',',$multableno);
  foreach($tableids as $tabledata)  
  {
  $select = db_query("SELECT table_no FROM ".TABLE_HMS_TABLE_ENTRY." WHERE table_entry_id='".$tabledata."'");
  if(db_num_rows($select)>0)
  $fetch = db_fetch_array($select);
  $dlmt = (empty($tablename) ? '':',');
  $tablename .=$dlmt.$fetch['table_no'];
  }
  return $tablename;
}
function getsuppliername($supplierid)
{
  $select = db_query("SELECT supplier_name FROM ".TABLE_HMS_SUPPLIER_CREATION."  WHERE active='Y' AND supplier_id='$supplierid'");
  if(db_num_rows($select)>0)
  $fetch = db_fetch_array($select);
  return $fetch['supplier_name'];
}
function chairschecking($chair) {
$table   =  db_query("SELECT status  FROM ".TABLE_HMS_TABLE_DETAILS." a  LEFT JOIN  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " b ON a.htd_cart_id=b.order_cart_id WHERE bill_id='' AND htd_chairs='".$chair."' ");
$counttable = db_num_rows($table);
$fetchtable = db_fetch_array($table);

$account =  db_query("SELECT status  FROM  " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . "  WHERE bill_id='' AND  FIND_IN_SET('$chair',tabel_id)");
$countaccount = db_num_rows($account);
$fetchaccount= db_fetch_array($account);

if($counttable>0 && $countaccount==0 && $fetchtable['status']=='open')
$result = 1;
else if($countaccount>0 && $fetchaccount['status']=='open')
$result = 2;
else 
$result = 3;
return $result;
}

function tablechecking($chairs,$cartid,$table) {
if(!empty($cartid))
{
$table   =  db_query("SELECT status  FROM ".TABLE_HMS_TABLE_DETAILS." a  LEFT JOIN  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " b ON a.htd_cart_id=b.order_cart_id WHERE bill_id='' AND status='open' AND htd_cart_id='$cartid' AND htd_table_id='$table'");
$counttable = db_num_rows($table);

$account =  db_query("SELECT status  FROM  " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . "  WHERE bill_id='' AND status='open'  AND account_card_id='$cartid'");
$countaccount = db_num_rows($account);
}    
$flag2 =0;
$chairsplit = explode(',',$chairs);
foreach($chairsplit as $chair)
{
$account =  db_query("SELECT status  FROM  " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . "  WHERE bill_id='' AND status='open' AND  FIND_IN_SET('$chair',tabel_id)");
$countaccountt = db_num_rows($account);
if($countaccountt>0)
$flag2++;
}

if($counttable>0 && $countaccount==0)
$result = 1;
else if(($flag2==2 && $table==4) && $flag2!=0 && empty($cartid))
$result = 2;
else if(($flag2==4 && $table!=4 && $table!=8) && $flag2!=0 && empty($cartid))
$result = 2;
else if(($flag2==6 && $table==8) && $flag2!=0 && empty($cartid))
$result = 2;
else 
$result = 3;
return $result;
}
function editcarttablechk($cartid,$table) {
if(!empty($cartid))
{
$table   =  db_query("SELECT status  FROM ".TABLE_HMS_TABLE_DETAILS." a  LEFT JOIN  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " b ON a.htd_cart_id=b.order_cart_id WHERE bill_id='' AND status='open' AND htd_cart_id='$cartid' AND htd_table_id='$table'");
$counttable = db_num_rows($table);

$account =  db_query("SELECT status  FROM  " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . "  WHERE bill_id='' AND status='open'  AND account_card_id='$cartid'");
$countaccount = db_num_rows($account);
}    
if($counttable>0 && $countaccount>0)
$result = 1;
return $result;
}
function is_allow_module($userid, $moduleid) {
    $module_sql="SELECT * FROM " . TABLE_HMS_MODULE_ADMIN . " WHERE admin_modules_mst_id = '" . $moduleid . "' AND  admin_mst_id = '" . $userid . "'";
	//exit;
    $module_result = db_query($module_sql);
    if(db_num_rows($module_result)>0) {
        return true;
    } else {
        return false;
    }
}
?>