<?php

require_once ("includes/application_top.php");
$action=$_REQUEST['action'];
$sub_cat=$_REQUEST['sub_cat'];
if($action=='menusub_category'){
?>

<select name="menu_sub_category" id="menu_sub_category" style="width:250px;"  >
	<option value="">--Select--</option>
<?php
$menu_sub_category="SELECT * FROM  ".TABLE_HMS_MENUSUBCATEGORY_CREATION." WHERE hms_menu_category_id='$sub_cat' AND active='Y'";
		$menu_sub_category_query= mysql_query($menu_sub_category);
		while($menu_sub_category_result=db_fetch_array($menu_sub_category_query))
	{ ?>
	
<option  value="<?php  echo $menu_sub_category_result['hms_menu_sub_category_id']; ?>"> <?php echo $menu_sub_category_result['hms_menu_sub_category_name'];  ?>
</option>
		<?php  		} 
} 
 ?>
</select>
