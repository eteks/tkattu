<?php
require_once ("includes/application_top.php");

if($_REQUEST['action']=='sub_menu_select')
{
$sql=db_query("SELECT * FROM " . TABLE_HMS_MENUSUBCATEGORY_CREATION. " WHERE hms_menu_category_id='".$_REQUEST['sub_categ']."'");
?>
<select name='menu_sub_category' id='menu_sub_category' >
<option value='0'>-Select a Menu Category-</option>
<?php 
while ($rs = db_fetch_array($sql)) { ?>
<option value="<?php echo $rs["hms_menu_sub_category_id"]; ?>"><?php echo $rs["hms_menu_sub_category_name"]; ?></option>
<?php } } ?>
</select>
