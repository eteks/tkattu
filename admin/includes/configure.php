<?php
$http_server = 'http://' . $_SERVER['HTTP_HOST'] . '/thalapakattu/';

define('PROJECT_NAME', 'Junior Thalapakattu Biryani');

define('HTTP_SERVER', $http_server); 

define('DIR_WS_UPLOADS', HTTP_SERVER . 'uploads/');

define('DIR_WS_ADMIN', 'admin/'); // absolute path required
define('DIR_WS_INCLUDES', 'includes/');

define('DIR_WS_EXTENSION', 'extension/');
define('DIR_WS_FCKEDITOR', DIR_WS_EXTENSION . 'FCKeditor/');

define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_IMAGES', 'images/');
define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');

/* DEFINE FOLDER (START)*/
//29-01-2009 (Start)
define('DIR_WS_PRIVILEGE', DIR_WS_MODULES . 'privilege/');
define('DIR_WS_HOTEL_INFO',DIR_WS_MODULES.'hotel_info/');
define('DIR_WS_BASIC_INFO',DIR_WS_MODULES.'basic_info/');
define('DIR_WS_INFRASTUCTURE',DIR_WS_MODULES.'infrastucture/');
define('DIR_WS_MENU_CARD',DIR_WS_MODULES.'menu_card/');
define('DIR_WS_FINANCE',DIR_WS_MODULES.'finance/');
define('DIR_WS_CHECKOUT',DIR_WS_MODULES.'checkout/');
define('DIR_WS_BEDDETAILS',DIR_WS_MODULES.'bedDetails/');
define('DIR_WS_INVENTORY',DIR_WS_MODULES.'inventory/');
define('DIR_WS_PRIVILEGE_USER', DIR_WS_MODULES . 'privilegeUser/');

define('DIR_WS_REPORT',DIR_WS_MODULES.'report/');

//29-01-2009 (End)
/* DEFINE FOLDER (START) */

//text
define('COPYRIGHT','www.atomicka.in');
define('TITLE_MANAGE_PRIVILEGE_USER','Privilege User');
define('TITLE_MANAGE_PRIVILEGE_ROLES','Privilege Roles');
define('TITLE_MANAGE_PRIVILEGE_EVENTS','Privilege Events');
define('TITLE_MANAGE_PRIVILEGE_MODULES','Privilege Modules');
define('TITLE_MANAGE_HOTEL_INFO','Hotel Info');
define('TITLE_MANAGE_OCCASION_INFO','Occasion Entry');
define('TITLE_MANAGE_FACILITY_ENTRY','Facility Entry');
define('TITLE_MANAGE_SERVICES_ENTRY','Services Entry');
define('TITLE_MANAGE_CHANGE_PASSWORD','Change Password');
define('TITLE_MANAGE_FLOOR_CREATION','Floor Creation');
define('TITLE_MANAGE_ROOM_TYPE_CREATION','Room Type Creation');
define('TITLE_MANAGE_ROOM','Room Entry');
define('TITLE_MANAGE_TABLE_TYPE_CREATION','Table Type Creation');
define('TITLE_MANAGE_SUPPLIER_CREATION','Supplier Creation');
define('TITLE_MANAGE_SUPPLIER_MAPPING','Supplier Mapping');
define('TITLE_MANAGE_MENU_STOCK_ENTRY','Menu Stock Entry');
define('TITLE_MANAGE_DEPARTMENT_MAPPING','Department Mapping');
define('TITLE_MANAGE_TABLE_ENTRY','Table Entry');
define('TITLE_MANAGE_DEPARTMENT_CREATION','Department Creation');
define('TITLE_MANAGE_DESIGNATION','Designation');
define('TITLE_MANAGE_MENU_CATEGORY','Menu Category');
define('TITLE_MANAGE_MENU_ENTRY','Menu Entry');
define('TITLE_MANAGE_MENU_CARD_CREATION','Menu Card Menu Selection');
define('TITLE_MANAGE_PAYMENT','Payment Mode');
define('TITLE_MANAGE_TAX_INFO','Tax Info');
define('TITLE_MANAGE_TAX_SCHEME','Tax Scheme Entry');
define('TITLE_MANAGE_UNIT_ENTRY','Unit Entry');
define('TITLE_MANAGE_ITEM_TYPE','Item Type Creation');
define('TITLE_MANAGE_ITEM_ENTRY','Item Entry');
define('TITLE_MANAGE_VENDOR_CREATION','Vendor Creation');
define('TITLE_MANAGE_PARAMETER_INFO','Parameter Setting');
define('TITLE_MANAGE_CHECKOUT_TIME','Checkout Time');
define('TITLE_MANAGE_HMS_PRIVILEGE_USER','Privilege Users Side');
define('TITLE_MANAGE_HMS_PRIVILEGE_ROLES','Privilege User Roles');
define('TITLE_MANAGE_HMS_PRIVILEGE_EVENTS','Privilege User Events');
define('TITLE_MANAGE_HMS_PRIVILEGE_MODULES','Privilege User Modules');
define('TITLE_MANAGE_HMS_BED_DETAILS','Bed Details');
define('TITLE_MANAGE_HMS_ROOM','Room Report');
define('TITLE_MANAGE_HMS_RESTAURANT','Restaurant Report');
define('TITLE_MANAGE_HMS_BAR','Bar Report');
define('TITLE_MANAGE_HMS_SERVICE','Service Report');
define('TITLE_MANAGE_HMS_ROOMOCCUPANCY','Room Occupancy Report');
define('TITLE_MANAGE_HMS_DEPARTURE','Departure Report');
define('TITLE_MANAGE_HMS_GROUP_RESERVATION','Group Reservation');
define('TITLE_MANAGE_HMS_GUEST_REPORT','Guest Report');
define('TITLE_MANAGE_HMS_KEEPING_REPORT','House Keeping Report');
define('TITLE_MANAGE_HMS_REGISTERATION_CARD','Registration Card Report');
define('TITLE_MANAGE_HMS_RESERVATION_CANCEL','Reservation Cancel Report');



//define folder

define('DIR_WS_BANNER_UPLOADS', DIR_WS_UPLOADS . 'hotel_banner/');

/* Added on 05-01-2009*/
define('DIR_WS_MANAGE_STATUS', DIR_WS_MODULES . 'manage_status/');
define('NOT_REVIEWED', 1); // for application status
define('UNDECIDED', 2); // for application status
define('SCHEDULE_FOR_INTERVIEW', 3); // for application status
define('WAIT_LIST', 4);// for application status
define('REJECT', 5);// for application status
define('ADMIT', 6);// for application status
define('DATE_FORMAT', 'd/m/y (h.i a)');
/* End of date 05-01-2009 */

// define our database connection
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

//BACKOFFICE THEMES

define('BGCOLOR', '#BBBBBB'); // #656962
define('CPANLECOLOR', '#AF999E');

define('FIRSTROWCOLOR', '#E8E8E8');
define('SECONDROWCOLOR', '#FFFFFF');

define('TITLEROWCOLOR', '#4f4f4f');
define('CENTERBOXBG', '#FFFFFF');
define('CENTERBG', '#555555');
define('CENTERTDBG', '#ececec');

define('DATE_FORMAT_LONG', '%A %d %B, %Y');
define('EMAIL_TRANSPORT', 'sendmail');
define('EMAIL_LINEFEED', 'CRLF');
define('EMAIL_USE_HTML', true);
define('SEND_EMAILS', true);
define('CHARSET', 'iso-8859-1');


define('B_DOCUMENT_SIZE', 1048576);
define('B_IMAGE_WIDTH', 10000);
define('B_IMAGE_HEIGHT', 10000);

//hms
define('ROWS_PER_PAGE', 5);
define('PAGINATION_DISPLAYED_RECORDS', ROWS_PER_PAGE);
define('B_THUMB_IMAGE_WIDTH', 75);
define('B_THUMB_IMAGE_HEIGHT', 50);
//hms

define('ROW_NUMBER_PER_PAGE', 3); // for dynamic form display
define('POST_GRADUATE_ID','4');
define('GRADUATE_ID', '3');
define('REFERENCE_PROF_TAB_ID', '3'); // this is for no of reference for inst in super admin FROM the table `inst_profile_tabs` 
define('APPLICANT_IMAGE_SIZE', '375x450');
define('PRESS_ADS_IMAGE_SIZE','256000');
define('SOLUTIONS_DOC_SIZE','1048576');
define('SOLUTIONS_CAT_SIZE','256000');
define('SOLUTIONS_CAT_WIDTH','750');
define('SOLUTIONS_CAT_HEIGHT','120');

/* 08-01-2009*/
define('DIR_WS_INST_BANNER', HTTP_SERVER . 'uploads/inst_banner/');
/* 13-01-2009*/
define('DIR_WS_DISCOUNT_CODE', DIR_WS_MODULES . 'manage_discount_code/');
?>
