
<?php
require_once ("includes/application_top.php");
$country_id = ($_REQUEST["country_id"] <> "") ? trim( addslashes($_REQUEST["country_id"])) : "";
if ($country_id <> "" ) {
$sql = "SELECT * FROM ".TABLE_HMS_MENUSUBCATEGORY_CREATION." WHERE `hms_menu_category_id`='".$country_id."' AND `active`='Y' ";
$query = db_query($sql);
?>

<select name='sub_category' id='sub_category' class="selectinput" >
<option value=''>-Select-</option>
<?php while ($rs = db_fetch_array($query)) { ?>
<option value="<?php echo $rs["hms_menu_sub_category_id"]; ?>"><?php echo $rs["hms_menu_sub_category_name"]; ?></option>
<?php } ?>
</select>
<?php
}

?>