<div id="items"  style="border:solid #666; ">
<table border="1" width="91%" height="35" align="center">
<tr>
<th width="11%">S.no</th>
<th width="17%">Table no</th>
<th width="38%">Item</th>
<th width="10%">Quantity</th>
<th width="24%">price Per/U</th>
<th width="24%">Total</th>
</tr>
 <?php 
 $hms_info_counter = 1;
 $q=1;
 $hms_info_sql           = $hms_info_obj->menuEntryAllRecords();
 while ($hms_info_values = db_fetch_array($hms_info_sql)) {

?>
<tr>
<td class="verdanablack" style="text-align:center">
        <input type="checkbox" class="noneborder" name="checkbox[]" id="checkbox[]" value="<? echo $hms_info_values["order_id"]; ?>" />

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

 <input type="text"  name="quantity" id="quantity<? echo $q; ?>"   width="20" value="<? echo $hms_info_values["order_quantity"]; ?>" 
    onkeyup="orderquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);" />

 </td>
 <td class="verdanablack" style="text-align:center">
  <?
 echo $hms_info_values["order_price"]; ?>   </td>
<td class="verdanablack" style="text-align:center">
  <?
  $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];
          echo $price; ?> 
  <input type="text" name="<?php echo $hms_info_values["order_id"]; ?>" id="<?php echo $hms_info_values["order_id"]; ?>" value="<?php echo $price;  ?>"/>      
  </td>
 
 <?php
          $hms_info_counter++;
		  $q++;
        }
    ?>
    </tr>
    <tr>
  
     <td class="verdanablack" style="text-align:right; margin-left:50px;">
 <input name="delete" type="submit" id="delete" value="Delete"  onclick="removeitems()"/>
  
 </td>
    </tr>
</table> </div> 