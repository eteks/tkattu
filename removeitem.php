<?php
require_once ("includes/application_top.php");

$action=$_REQUEST['action'];

if(isset($_REQUEST['checkedValue']))
{

echo "<script type='text/javascript'>alert(".$_REQUEST['checkedValue'].");</script>";
 $cnt=array();
 $cnt=count($_REQUEST['checkedValue']);
 for($i=0;$i<$cnt;$i++)
  {
     $del_id=$_REQUEST['checkedValue'][$i];
     $query="DELETE FROM " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id='".$del_id."'";
     db_query($query);
  }
}


?>