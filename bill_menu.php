<?php
require_once ("includes/application_top.php");

$total_bill=db_query("SELECT sum(`order_total_price`) as `total`,`order_cart_id`,`table_entry_id`,`order_product`,`status`,`order_price`,`order_total_price`,`order_quantity` FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE table_entry_id='".$_POST['tableid']."' AND 
status='open' GROUP BY order_cart_id");
while ($hms_bill_values = db_fetch_array($total_bill)) {
	
	 $total=$hms_bill_values["total"];
	 $table_entry_id=$hms_bill_values["table_entry_id"];
	 $order_cart_id=$hms_bill_values["order_cart_id"];
}
$sql_bill=db_query("SELECT `order_id`,`order_cart_id`,`table_entry_id`,`order_product`,`status`,`order_price`,`order_quantity` FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE table_entry_id='".$_POST['tableid']."' AND status='open'");
		
	?>
 <div style="border:solid #666; ">
<table border="0" width="91%" height="35" align="center">
<tr>
<th width="7%"  >S.no</th>
<th width="12%">Table no</th>
<th width="30%">Item</th>
<th width="11%">Quantity</th>
<th width="20%">price</th>
<th width="20%">Amount</th>
</tr>
 <?php 
 $hms_info_counter = 1;
 $q=1;
 while ($hms_info_values = db_fetch_array($sql_bill)) {
	
?>
<tr>
<td class="verdanablack" style="text-align:center">
       
          <? echo $hms_info_counter; ?></td>
<td class="verdanablack" style="text-align:center">
          <? 
		  $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id = ".$hms_info_values["table_entry_id"]." ";
            $table_records = db_query ($hms_info_fetch_table_sql);
			$table  = db_fetch_array($table_records);
		  
		  echo $table["table_no"];   
		 ?></td>
          <td class="verdanablack" style="text-align:center">
          <? echo $hms_info_values["order_product"]; ?></td>
<td class="verdanablack" style="text-align:center">

<?php  echo $hms_info_values["order_quantity"]; ?>

 </td>
 <td class="verdanablack" style="text-align:center">
  <?
 $price=$hms_info_values["order_price"];
          echo $price; ?></td>
           <td class="verdanablack" style="text-align:center">
  <?
 $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];
          echo $price; ?></td>
 <?php
          $hms_info_counter++;
		  $q++;
        }
    ?>
   </tr>
   
   
   <tr>
  <td class="verdanablack" style="text-align:right; margin-left:50px;" colspan="3"></td>
   
  <td class="verdanablack" style="text-align:right; margin-left:50px;">
   <select name="tax" id="tax" onchange="gettax(this.value);">
   <option>---select tax---</option>
  <?php
  $sql_tax=db_query("SELECT * FROM ".TABLE_HMS_TAX_SCHEME."");
  while($row_tax=db_fetch_array($sql_tax)){
  ?>
 <option value="<?php echo $row_tax['tax_scheme_id']; ?>"><?php echo $row_tax['tax_scheme_name']; ?></option>
  <?php } ?>
    <input type="hidden" name="total_tax" id="total_tax" />   
  </select>
  </td> 
  
<td colspan="2" class="verdanablack" style="text-align:right; margin-left:50px;">
<div id="tax_values" >
</div>  
</td>
   </tr>
     <tr>
<td class="verdanablack" style="text-align:right; margin-left:50px;"  colspan="4"> </td>
<td class="verdanablack" style="text-align:right; margin-left:50px;">Sub Total </td>
<td class="verdanablack" style="text-align:center"><? echo $total; ?> </td>
    </tr> 
   
     <tr>
     <td class="verdanablack" style="text-align:center; margin-left:60px;" colspan="6">
 <input name="print" type="submit" id="print" value="print" onclick="print('<? echo $table_entry_id; ?>','<?php echo $order_cart_id; ?>')" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="print" type="submit" id="cancel" value="cancel" onclick="cancel()" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="print" type="submit" id="print" value="Carry to bill" onclick="carrytobill()" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />

<div id="carry">
<select name="rooms" id="rooms" onchange="getcustomername(this.value)" >
<option>-Rooms-</option>
<?php
$rooms=db_query("SELECT * FROM ".TABLE_HMS_BOOKING_STATUS." WHERE status='C'");
while($rooms_no=db_fetch_array($rooms)){
?>
<option value="<?php echo $rooms_no['rooms_no']; ?>"><?php echo $rooms_no['rooms_no']; ?></option>
<?php }  ?>
</select>

<input type="text" name="cus_name" id="cus_name"/>

<input name="print" type="submit" id="print" value="Bill" onclick="RoomBill('<? echo $table_entry_id; ?>','<?php echo $order_cart_id; ?>')" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />

</div>
</td>
</tr>
</table>                                                 
</div> 
   
<script>

function gettax(tax){
$.ajax({
type: "POST",
url: "updatequantity.php",
data:'action='+"taxvalue"+'&tax='+tax,
success: function(html) {  
$("#tax_values").html(html).show();
 calculateSum();
}
});			

}


function carrytobill(){
$("#carry").show();
}

function getcustomername(room){

$.ajax({
type: "POST",
url: "updatequantity.php",
data:'action='+"getcustomername"+'&room='+room,
success: function(data) {  
 $("#cus_name").val(data);
}
});	
}
</script>

<style>
div #carry{
    display: none;
}
</style>