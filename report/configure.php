<?php
$http_server = 'http://' . $_SERVER['HTTP_HOST'] . '/thalapakattu/';

define('HTTP_SERVER', $http_server); 

define('DIR_WS_UPLOADS', HTTP_SERVER . 'uploads/');
define('DIR_WS_JS', HTTP_SERVER . 'js/');
define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');

// individual modules define here
define('DIR_WS_ROOM_SERVICES',DIR_WS_MODULES.'');
define('DIR_WS_',DIR_WS_MODULES.'');

define('DIR_WS_INST_BANNER', HTTP_SERVER . 'uploads/inst_banner/');


define('DIR_WS_PRESS_ADS_UPLOADS', DIR_WS_UPLOADS . 'press_ads/');
define('DIR_WS_SOLUTIONS_UPLOADS', DIR_WS_UPLOADS . 'solutions_category/');
define('DIR_WS_SOLUTIONS_LEARN_UPLOADS', DIR_WS_UPLOADS . 'solutions_learn/');

define('DIR_WS_INST_FORM_IMG_UPLOADS', DIR_WS_UPLOADS . 'form_images/');

// define our database connectionparameter

define('DB_SERVER', 'localhost');//192.168.1.119
define('DB_SERVER_USERNAME','root'); //bgi
define('DB_SERVER_PASSWORD',''); //bgi
define('DB_DATABASE', 'thalapakattu');
define('USE_PCONNECT', 'false'); // use persisstent connections?
define('LANGUAGE', 1);

$dbHost = DB_SERVER;              // Where is the MySQL Server located
$dbName = DB_DATABASE;            // The name of the database
$dbUser = DB_SERVER_USERNAME;     // MySQL username
$dbPasswd = DB_SERVER_PASSWORD;   // MySQL password

define('ROWS_PER_PAGE', 5);
define('PAGINATION_DISPLAYED_RECORDS', ROWS_PER_PAGE);
define('B_THUMB_IMAGE_WIDTH', 75);
define('B_THUMB_IMAGE_HEIGHT', 50);


define('DIR_WS_STUD_IMG_UPLOADS', DIR_WS_UPLOADS . 'student_images/');

/* 09-01-2009*/
define('EMAIL_NOTIFICATION', 'notifications@universitylane.com');

define('DATE_FORMAT_LONG', '%A %d %B, %Y');
define('NOT_REVIEWED', 1); // for application status
define('UNDECIDED', 2); // for application status
define('SCHEDULE_FOR_INTERVIEW', 3); // for application status
define('WAIT_LIST', 4);// for application status
define('REJECT', 5);// for application status
define('ADMIT', 6);// for application status

/* 13-01-2009*/
define('SERVICE_TAX', '12.36');
define('EDUCATION_CESS', '2');
define('HIGHERE_EDUCATION_CESS', '1');

?>
