<?php
        session_start();
	require_once ("includes/application_top.php");

$data=$_POST['data'];

$result=mysql_query("SELECT menu_name, item_code FROM hms_menu_entry where menu_id='$data'");
while($response=mysql_fetch_assoc($result))
{
if(!empty($response['menu_name'])){

echo "<input type='text' id='item_code_result' value='".$response['menu_name']."' readonly >";

}else{
echo "";
}
}
?>
