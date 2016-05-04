<?php
error_reporting (0);//error_reporting (E_ALL ^ E_NOTICE);
ob_start();

// Set the local configuration parameters - mainly for developers
if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// Include application configuration parameters
require('includes/configure.php');

// Define the project version
define('PROJECT_VERSION', 'Atomicka Softtech Pvt Ltd 1.0');

// set php_self in the local scope
$HTTP_SERVER_VARS = (isset($HTTP_SERVER_VARS['PHP_SELF']) ? $HTTP_SERVER_VARS['PHP_SELF'] : "");
$PHP_SELF = (isset($HTTP_SERVER_VARS) ? $HTTP_SERVER_VARS : $HTTP_SERVER_VARS['SCRIPT_NAME']);

// include the list of project filenames
require(DIR_WS_INCLUDES . 'filenames.php');
// include the list of project database tables
require(DIR_WS_INCLUDES . 'database_tables.php');

// include the database functions
require(DIR_WS_FUNCTIONS . 'database.php');
// make a connection to the database... now
db_connect() or die('Unable to connect to database server!');

// define our general functions used application-wide
require(DIR_WS_FUNCTIONS . 'general.php');
require(DIR_WS_FUNCTIONS . 'html_output.php');
//require(DIR_WS_FUNCTIONS . 'cookie.php');
require(DIR_WS_CLASSES. 'datetimeclass.php');
require(DIR_WS_CLASSES ."class.phpmailer.php");
require(DIR_WS_CLASSES ."class.smtp.php");

//Reservation Class//
require(DIR_WS_CLASSES. 'reservation.class.php');
require(DIR_WS_CLASSES. 'facility.class.php');
require(DIR_WS_CLASSES. 'Room_Services.class.php');
require(DIR_WS_CLASSES. 'house_keep.class.php');
require(DIR_WS_CLASSES. 'confirm_booking.class.php');
require(DIR_WS_CLASSES. 'restaurant.class.php');
require(DIR_WS_CLASSES. 'restaurantbill.class.php');
require(DIR_WS_CLASSES. 'finalbill.class.php');

// 
$status_array = array (
     array("id" => "" , "text" => "Select Status"),
     array("id" => "1" , "text" => "Complete"),
     array("id" => "2" , "text" => "In Process"),
     array("id" => "3" , "text" => "Pending")
);

$countryArray = array (
	  array("id" => "" , "text" => "Select Country"),
	  array("id" => "1" , "text" =>"Afghanistan"),
	  array("id" => "2" , "text" =>"Albania"),
	  array("id" => "3" , "text" =>"Algeria"),
	  array("id" => "4" , "text" =>"Angola"),
	  array("id" => "5" , "text" =>"Argentina"),
	  array("id" => "6" , "text" =>"Armenia"),
	  array("id" => "7" , "text" =>"Australia"),
	  array("id" => "8" , "text" =>"Austria"),
	  array("id" => "9" , "text" =>"Bahamas"),
	  array("id" => "10" , "text" =>"Bahrain"),
	  array("id" => "11" , "text" =>"Bangladesh"),
	  array("id" => "12" , "text" =>"Belgium"),
	  array("id" => "13" , "text" =>"Bermuda"),
	  array("id" => "14" , "text" =>"Bhutan"),
	  array("id" => "15" , "text" =>"Bolivia"),
	  array("id" => "16" , "text" =>"Bosnia-Herzegovina"),
	  array("id" => "17" , "text" =>"Brazil"),
	  array("id" => "18" , "text" =>"Brunei"),
	  array("id" => "19" , "text" =>"Bulgaria"),
	  array("id" => "20" , "text" =>"Cambodia"),
	  array("id" => "21" , "text" =>"Cameroon"),
	  array("id" => "22" , "text" =>"Canada"),
	  array("id" => "23" , "text" =>"Canary Islands"),
	  array("id" => "24" , "text" =>"Chile"),
	  array("id" => "25" , "text" =>"China"),
	  array("id" => "26" , "text" =>"Colombia"),
	  array("id" => "27" , "text" =>"Congo"),
	  array("id" => "28" , "text" =>"Costa Rica"),
	  array("id" => "29" , "text" =>"Croatia"),
	  array("id" => "30" , "text" =>"Cuba"),
	  array("id" => "31" , "text" =>"Cyprus"),
	  array("id" => "32" , "text" =>">Czech Republic"),
	  array("id" => "33" , "text" =>"Denmark"),
	  array("id" => "34" , "text" =>"Ecuador"),
	  array("id" => "35" , "text" =>"Egypt"),
	  array("id" => "36" , "text" =>"El Salvador"),
	  array("id" => "37" , "text" =>"Falkland Islands"),
	  array("id" => "38" , "text" =>"Fiji"),
	  array("id" => "39" , "text" =>"Finland"),
	  array("id" => "40" , "text" =>"France"),
	  array("id" => "41" , "text" =>"Georgia"),
	  array("id" => "42" , "text" =>"Germany"),
	  array("id" => "43" , "text" =>"Ghana"),
	  array("id" => "44" , "text" =>"Gibraltar"),
	  array("id" => "45" , "text" =>"Greece"),
	  array("id" => "46" , "text" =>"Haiti"),
	  array("id" => "47" , "text" =>"Holland"),
	  array("id" => "48" , "text" =>"Hong Kong"),
	  array("id" => "49" , "text" =>"Hungary"),
	  array("id" => "50" , "text" =>"Iceland"),
	  array("id" => "51" , "text" =>"India"),
	  array("id" => "52" , "text" =>"Indonesia"),
	  array("id" => "53" , "text" =>"Iran"),
	  array("id" => "54" , "text" =>"Iraq"),
	  array("id" => "55" , "text" =>"Ireland"),
	  array("id" => "56" , "text" =>"Israel"),
	  array("id" => "57" , "text" =>"Italy"),
	  array("id" => "58" , "text" =>"Jamaica"),
	  array("id" => "59" , "text" =>"Japan"),
	  array("id" => "60" , "text" =>"Jordan"),
	  array("id" => "61" , "text" =>"Kazakhstan"),
	  array("id" => "62" , "text" =>"Kenya"),
	  array("id" => "63" , "text" =>"Kuwait"),
	  array("id" => "64" , "text" =>"Kyrgyzstan"),
	  array("id" => "65" , "text" =>"Latvia"),
	  array("id" => "66" , "text" =>"Lebanon"),
	  array("id" => "67" , "text" =>"Libya"),
	  array("id" => "68" , "text" =>"Lithuania"),
	  array("id" => "69" , "text" =>"Luxembourg"),
	  array("id" => "70" , "text" =>"Malaysia"),
	  array("id" => "71" , "text" =>"Maldives"),
	  array("id" => "72" , "text" =>"Mali"),
	  array("id" => "73" , "text" =>"Malta"),
	  array("id" => "74" , "text" =>"Mauritius"),
	  array("id" => "75" , "text" =>"Mongolia"),
	  array("id" => "76" , "text" =>"Mexico"),
	  array("id" => "77" , "text" =>"Morocco"),
	  array("id" => "78" , "text" =>"Mynamar"),
	  array("id" => "79" , "text" =>"Namibia"),
	  array("id" => "80" , "text" =>"Nepal"),
	  array("id" => "81" , "text" =>"Netherlands"),
	  array("id" => "82" , "text" =>"New Zealand"),
	  array("id" => "83" , "text" =>"Nicaragua"),
	  array("id" => "84" , "text" =>"Nigeria"),
	  array("id" => "85" , "text" =>"North Korea"),
	  array("id" => "86" , "text" =>"Norway"),
	  array("id" => "87" , "text" =>"Oman"),
	  array("id" => "88" , "text" =>"Pakistan"),
	  array("id" => "89" , "text" =>"Pakistan"),
	  array("id" => "90" , "text" =>"Paraguay"),
	  array("id" => "91" , "text" =>"Peru"),
	  array("id" => "92" , "text" =>"Philippines"),
	  array("id" => "93" , "text" =>"Poland"),
	  array("id" => "94" , "text" =>"Portugal"),
	  array("id" => "95" , "text" =>"Puerto Rico"),
	  array("id" => "96" , "text" =>"Qatar"),
	  array("id" => "97" , "text" =>"Romania"),
	  array("id" => "98" , "text" =>"Russia"),
	  array("id" => "99" , "text" =>"Saudi Arabia"),
	  array("id" => "100" , "text" =>"Senegal"),
	  array("id" => "101" , "text" =>"Seychelles"),
	  array("id" => "102" , "text" =>"Sierra Leone"),
	  array("id" => "103" , "text" =>"Singapore"),
	  array("id" => "104" , "text" =>"Slovakia"),
	  array("id" => "105" , "text" =>"Slovenia"),
	  array("id" => "106" , "text" =>"Somalia"),
	  array("id" => "107" , "text" =>"South Africa"),
	  array("id" => "108" , "text" =>"South Korea"),
	  array("id" => "109" , "text" =>"Spain"),
	  array("id" => "110" , "text" =>"Sri Lanka"),
	  array("id" => "111" , "text" =>"Sudan"),
	  array("id" => "112" , "text" =>"Sweden"),
	  array("id" => "113" , "text" =>"Switzerland"),
	  array("id" => "114" , "text" =>"Syria"),
	  array("id" => "115" , "text" =>"Tahiti"),
	  array("id" => "116" , "text" =>"Taiwan"),
	  array("id" => "117" , "text" =>"Tajikistan"),
	  array("id" => "118" , "text" =>"Tanzania"),
	  array("id" => "140" , "text" =>"Thailand"),
	  array("id" => "120" , "text" =>"Tunisia"),
	  array("id" => "121" , "text" =>"Turkey"),
	  array("id" => "122" , "text" =>"Turkmenistan"),
	  array("id" => "123" , "text" =>"Uganda"),
	  array("id" => "124" , "text" =>"Ukraine"),
	  array("id" => "125" , "text" =>"United Arab Emirates"),
	  array("id" => "126" , "text" =>"United Kingdom"),
	  array("id" => "127" , "text" =>"Uruguay"),
	  array("id" => "128" , "text" =>"USA"),
	  array("id" => "129" , "text" =>"Uzbekistan"),
	  array("id" => "130" , "text" =>"Venezuela"),
	  array("id" => "131" , "text" =>"Vietnam"),
	  array("id" => "132" , "text" =>"Yemen"),
	  array("id" => "133" , "text" =>"Yugoslavia"),
	  array("id" => "134" , "text" =>"Zambia"),
	  array("id" => "135" , "text" =>"Zimbabwe"),
	  array("id" => "136" , "text" =>"Others")
);

$IDTypeArray = array (
     array("id" => "" , "text" => "Select"),
     array("id" => "1" , "text" => "Id Type"),
     array("id" => "2" , "text" => "License"),
     array("id" => "3" , "text" => "Passport"),
     array("id" => "4" , "text" => "PAN"),
     array("id" => "5" , "text" => "Vote")
);

$CHECKINTypeArray = array (
     array("id" => "" , "text" => "Select"),
     array("id" => "1" , "text" => "General"),
     array("id" => "2" , "text" => "Corporate"),
     array("id" => "3" , "text" => "Couple"),
     array("id" => "4" , "text" => "Family"),
     array("id" => "5" , "text" => "Friends"),
     array("id" => "6" , "text" => "V.I.P")
);

$file_basename = basename($PHP_SELF);
$file_name = explode("." ,$file_basename);
$file_classname = $file_name[0] . '.class.php';
if (file_exists(DIR_WS_CLASSES.$file_classname)) {
    require(DIR_WS_CLASSES . $file_classname);
}
?>