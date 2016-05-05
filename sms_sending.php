<?php
require_once ("includes/application_top.php");
if(isset($_POST)){
 $crnt_date = date('Y-m-d');
 $session = $_POST['session'];
 $session = 'L';
 $temp_arr = array();
 if(strtolower($session) == 'l'){
  $sql = db_query("SELECT *   FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE orde_close_date = '".$crnt_date."' and bill_id like 'b1%' order by account_id asc");
 }
 else if(strtolower($session) == 's'){
  $sql = db_query("SELECT *   FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE orde_close_date = '".$crnt_date."' and bill_id like 'l1%' order by account_id asc");
 }
 else if(strtolower($session) == 'd'){
  $sql = db_query("SELECT *   FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE orde_close_date = '".$crnt_date."' and bill_id like 's1%' order by account_id asc");
 }
 else if(strtolower($session) == 'e'){
  $sql = db_query("SELECT *   FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE orde_close_date = '".$crnt_date."' and bill_id like 'd1%' order by account_id asc");
 }
 while($row = db_fetch_array($sql)){
  $temp_arr[] = $row;
 }
 print(json_encode($temp_arr));
}

?>