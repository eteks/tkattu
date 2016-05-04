<?php
require_once ("includes/application_top.php");
session_start();
$hms_info_obj = new restaurantbill();
$tabletree   = $hms_info_obj->getTableTree(); 
$action=$_REQUEST['action'];

if($action=='taxvalue')
{
$tax=$_REQUEST['tax'];	
$tax = db_query("SELECT * FROM ".TABLE_HMS_TAX_INFO." WHERE tax_category_id='$tax'");
$i=1;
while($row=db_fetch_array($tax)){
 ?>
<table>
<tr>
 <td width="50" class="verdanablack" style="text-align:right;">
<p> <?php  echo $row['tax_info_name']; ?> </p>
 </td>
 <td width="80" class="verdanablack" style="text-align:right;"> 
 <p>
  
 <input type="hidden" name="taxid" id="taxid" value="<?php  if(($row['tax_category_id'])!=""){echo $row['tax_category_id']; } else
 { echo "0"; } ?>" />
 
 <input type="hidden" style="width:50;float:right;"  class="txt" name="txt" id="txt" value="<?php echo $row['charge']; ?>" 
 /> 
 -&nbsp;&nbsp;<?php echo $row['charge']; ?>%
  </p>

 </td>
 </tr>
 </table>
 <?php 

 $i++;
}
} 

if($action=='getcustomername'){

$room=$_REQUEST['room'];

$room=db_query("SELECT hct.`customer_id`,hct.`customer_name`,hct.`customer_id_no`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`rooms_no` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . " as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`rooms_no` LIKE '%".$room."%'");	
while($cus_name=db_fetch_array($room))
{
echo $cus_name['customer_name'];
}
}



if($action=='showtabel'){
 ?>
<td width="1%" height="22">&nbsp;</td>
                  <td width="14%" class="verdanablack">Table Number: </td>
                  <td colspan="3" align="left">
 <select name='tableid' id='tableid' class="selectinput" >
					<option value=''>-Select-</option>
					<?php  while ($roomTreeresultSet = db_fetch_array($tabletree)) {	
					if($_POST['tableid'] == $roomTreeresultSet['table_entry_id']) $sel = "selected";
					else $sel = "";?>
<option value='<?php echo $roomTreeresultSet['table_entry_id']; ?>' <?php echo $sel;?>> 
						<?php echo $roomTreeresultSet['table_no']; ?></option>
						<?php } ?>
</select>			
</td>
                
	
<?php	
	
}


if($action=='updatequantity'){
$order=$_POST['order'];
$quantity=$_POST['quantity'];	
	$sql_order_price=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id='".$_POST['order']."'");
while($price=db_fetch_array($sql_order_price)){
	
	$total_price=$price['order_price']*$quantity; 
	
$customerDetailsAdd = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET order_total_price='".$total_price."',order_quantity='".$quantity."' WHERE order_id='$order'");
}
$total_order_price=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id='".$_POST['order']."'");
while($total_price=db_fetch_array($total_order_price)){

    
    echo $total_price['order_total_price']; 
}

}

?>