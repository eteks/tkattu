<?php
include("application_top.php");
echo "sdfsdfdsfsdfsd";
//if(isset($_POST)){
	$crnt_date = date('Y-m-d');
	//$session = $_POST['session'];
	$session = 'L';
	
	if(strtolower($session) == 'l'){
		$sql = db_query("SELECT *   FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE orde_close_date = '" . $crnt_date  . "'");
		print_r(db_fetch_array($sql));
	}
//}

?>