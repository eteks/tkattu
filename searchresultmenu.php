<?php
require_once ("includes/application_top.php");

$action=$_REQUEST['action'];
if($_POST)
{
$q=$_POST['search'];
$menu_category=$_REQUEST['menu_category'];
$menu_sub_category=$_REQUEST['menu_sub_category'];

if($menu_category!="" && $menu_sub_category="" && $q!="" ){
$sql_res=db_query("SELECT `menu_id`,`menu_category_id`,`hms_menu_sub_category_id`,`menu_name`,`price`,`Item_available_status`,`active` FROM ".TABLE_HMS_MENUENTRY." WHERE `menu_name` LIKE '%$q%' AND `active`='Y' AND Item_available_status='1' AND `menu_category_id`='".$menu_category."' ORDER BY menu_id LIMIT 5");
while($row=db_fetch_array($sql_res))
{
$menuid=$row['menu_id'];	
$menu=$row['menu_name'];
$price=$row['price'];
$b_menu='<strong>'.$q.'</strong>';
$b_price='<strong>'.$q.'</strong>';
$final_menu = str_ireplace($q, $b_menu, $menu);
$final_price = str_ireplace($q, $b_price, $price);
?>
<div class="show" align="left" onclick='GetMenu(<?php echo $menuid; ?>,"savemenulistres")'>
<span class="name"><?php echo $final_menu; ?></span>&nbsp;<br/><?php echo $final_price; ?><br/><br/>
</div>

<?php
}}
else if($menu_category!="" && $menu_sub_category!="" && $q!=""){
$sql_res=db_query("SELECT `menu_id`,`menu_category_id`,`hms_menu_sub_category_id`,`menu_name`,`price`,`Item_available_status`,`active` FROM ".TABLE_HMS_MENUENTRY." WHERE `menu_name` LIKE '%$q%' AND `active`='Y' AND Item_available_status='1' AND `menu_category_id`='".$menu_category."' AND $menu_sub_category='".$menu_sub_category."' ORDER BY menu_id LIMIT 5");
while($row=db_fetch_array($sql_res))
{
$menuid=$row['menu_id'];
$menu=$row['menu_name'];
$price=$row['price'];
$b_menu='<strong>'.$q.'</strong>';
$b_price='<strong>'.$q.'</strong>';
$final_menu = str_ireplace($q, $b_menu, $menu);
$final_price = str_ireplace($q, $b_price, $price);
?>

<div class="show" align="left" onclick='GetMenu(<?php echo $menuid; ?>,"savemenulistres")'>
<span class="name"><?php echo $final_menu; ?></span>&nbsp;<br/><?php echo $final_price; ?><br/>
<br/>
</div>
<?php
}}

else if($menu_category=="" && $menu_sub_category=="" && $q!="") {
$sql_res=db_query("SELECT `menu_id`,`menu_category_id`,`hms_menu_sub_category_id`,`menu_name`,`price`,`Item_available_status`,`active` FROM ".TABLE_HMS_MENUENTRY." WHERE `menu_name` LIKE '%$q%' AND `active`='Y' AND Item_available_status='1' ORDER BY menu_name ");
while($row=db_fetch_array($sql_res))
{
$menuid=$row['menu_id'];
$menu=$row['menu_name'];
$price=$row['price'];
$b_menu='<strong>'.$q.'</strong>';
$b_price='<strong>'.$q.'</strong>';
$final_menu = str_ireplace($q, $b_menu, $menu);
$final_price = str_ireplace($q, $b_price, $price);
?>


<div class="show" align="left" onclick='GetMenu(<?php echo $menuid; ?>,"savemenulistres")'>
<span class="name"><?php echo $final_menu; ?></span>&nbsp;<br/><?php echo $final_price; ?><br/>
<br/>
</div>
<?php
}}
?>
<?php  } ?>


