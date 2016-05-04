<?php
require_once ("includes/application_top.php");
$action=$_REQUEST['action'];
$item=$_REQUEST['item'];

if($action=="check"){
	
$menudisable=db_query("SELECT * FROM " .TABLE_HMS_MENUENTRY." WHERE menu_id='$item'");
 while ($hms_info_values = db_fetch_array($menudisable)) 
{
$status=$hms_info_values['Item_available_status'];
}	
if($status==1){		
$menustatus=db_query("UPDATE ". TABLE_HMS_MENUENTRY . " SET `Item_available_status`='0' WHERE menu_id='$item'");
 if($menustatus > 0)
{
echo "status0";	
}
}
else if($status==0){	
$menufalse=db_query("UPDATE ". TABLE_HMS_MENUENTRY . " SET `Item_available_status`='1' WHERE menu_id='$item'");
 if($menufalse > 0)
{
echo "status1";	
}
}
}
?>