 <!--new-->
<table  id="bill_row" >

<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >RESTAURANT ORDER ITEM LIST 
</span></td>
</tr>
     
<tr>
 <? 
 while ($hms_info_bill = db_fetch_array($hms_info_value)) { 
 		
$hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM      ".TABLE_HMS_TABLE_ENTRY." WHERE table_entry_id = ".$hms_info_bill["table_entry_id"]." ";
           
   $table_records = db_query ($hms_info_fetch_table_sql);
   $table  = db_fetch_array($table_records);
	  
   $tabel=$table["table_no"]; 
   $bill=$hms_info_bill['bill_id'];
   $cardid=$hms_info_bill['order_cart_id'];
   $tabelid=$hms_info_bill['table_entry_id'];
 } 
		  ?>
<td colspan="6" align="left" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
BILL NO:<?php echo $bill; ?>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo date("dS  M  Y h:i A"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($tabel!=0){ ?>
Table NO:<?php echo $tabel;  ?>			
<?php } ?>
</td>

</tr>

<tr>
<td colspan="6" align="center" height="30">
<div id="itemreplace"></div>
<div id="items"  style="border:solid #666; ">
<table border="0" width="91%" height="35" align="center">
<tr>
<th width="7%">S.no</th>

<th width="28%">Item</th>
<th width="21%">Quantity</th>
<th width="21%">Incl Tax</th>
<th width="12%">price Per/U</th>
<th width="20%">Total</th>
</tr>
 <?php 
 $hms_info_counter = 1;
 $q=1;
  
 while ($hms_info_values = db_fetch_array($hms_info_sql)) { 
	
?>
<tr>
<td class="verdanablack" style="text-align:center">
        <input type="checkbox" class="noneborder" name="checkbox[]" id="checkbox[]" value="<? echo $hms_info_values["order_id"]; ?>" />

          <? echo $hms_info_counter; ?></td>
<!-- <td class="verdanablack" style="text-align:center"> -->
          <? 
		  //$hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id = ".$hms_info_values["table_entry_id"]." ";
           // $table_records = db_query ($hms_info_fetch_table_sql);
			//$table  = db_fetch_array($table_records);
		  
		 // $tabel=$table["table_no"]; 
		  //echo $table["table_no"]; 
		  ?>
		  <!-- </td> -->
          <td class="verdanablack" style="text-align:center">
          
  <? if(strlen($hms_info_values["order_product"]) > 15) echo substr(stripslashes($hms_info_values["order_product"]),0,12).".."; 
  else echo stripslashes($hms_info_values["order_product"]); ?>             
          </td>
          
          
<td class="verdanablack" style="text-align:center">

 <input type="text"  name="quantity" id="quantity_<? echo $hms_info_values["order_id"]; ?>" style="width:50px;" autofocus  onfocus="var temp_value=this.value;this.value='';this.value=temp_value"  value="<? echo $hms_info_values["order_quantity"]; ?>" 
       onkeyup="orderquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);" /> 
 </td>
 
  <td class="verdanablack" style="text-align:center">
  <?
 if($hms_info_values["incl_tax"]==0.00) 
 {
  echo "-";
 }
 else{
       echo $hms_info_values["incl_tax"]; 
 }
 ?>   </td>
  
 
 <td class="verdanablack" style="text-align:center">
  <?
 echo $hms_info_values["order_price"]; ?>   </td>
<td class="verdanablack" style="text-align:center">
  <?
  $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];  
         
   $incl_tax=$price*($hms_info_values['incl_tax']/100.0); 
           
         $net_total_price= $price+$incl_tax;
	
  ?> 
         <input type="text" name="<?php echo $hms_info_values["order_id"]; ?>"  style="width:80px;"  id="<?php echo $hms_info_values["order_id"]; ?>" 
  readonly="readonly" value="<?php echo $net_total_price;  ?>"/>      
  </td>
 <?php 
          $hms_info_counter++;
		  $q++;
        }
    ?>
    </tr>
     <tr>
     <td class="verdanablack"  colspan="6"  style="text-align: right; font-size: 12px; padding-right: 32px; padding-top: 20px;" >
  Total-Amount: 
   <?php    
   $menuRecords = db_query("SELECT sum(order_total_price) as netamount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND table_entry_id='".$_POST['tableid']."' AND order_type='".$_POST['ordertype']."' ");
   $price_values=db_fetch_array($menuRecords);  
   echo $price_values['netamount'];
	 ?>
    <input type="hidden" name="total" id="total" value="<?php  echo $price_values['netamount']; ?>"/>  
	 </td>
     
      </tr>
    <tr>
  
     <td class="verdanablack" style="text-align:right; margin-left:50px;">
 <input name="delete" type="submit" id="delete" value="Delete"  onclick="removeitems()"/>  
  
 </td>
 
    </tr>
     <tr>
  <td class="verdanablack" style="text-align:right; margin-left:50px;" colspan="2"></td> 
   
  <td class="verdanablack" style="text-align:right; margin-left:50px;">
  <?php /*?> <select name="tax" id="tax" onchange="gettax(this.value);">
   <option>---select tax---</option>
  <?php
  $sql_tax=db_query("SELECT * FROM ".TABLE_HMS_TAX_SCHEME."");
  while($row_tax=db_fetch_array($sql_tax)){
  ?>
 <option value="<?php echo $row_tax['tax_scheme_id']; ?>"><?php echo $row_tax['tax_scheme_name']; ?></option>
  <?php } ?>
    <input type="hidden" name="total_tax" id="total_tax" />   
  </select><?php */?>
  </td> 
  
<td colspan="2" class="verdanablack" style="text-align:right; margin-left:50px;">
<div id="tax_values" >

<table  cellpadding="2" cellspacing="2" align="right"> 
    <tr style="width:55px;" align="right">
<td height="18" width="40" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px;">DISCOUNT:<input type="text" name="disc" id="disc" value="<?php echo $_POST['discount']; ?>" onkeyup="Gettax()" style="width:40px;"/>%&nbsp;&nbsp;&nbsp;<div style="float:right; width:10px;" id="discount"></div></td>

</tr>
<tr style="width:55px;" align="right">
<td height="18" width="150" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px;">VAT:<input type="text" name="vat" id="vat"  value="<?php echo $_POST['vat']; ?>" onkeyup="Gettax()"  style="width:40px;"/>% &nbsp;&nbsp;&nbsp;<div style="float:right; width:10px;" id="vat_amt"></div></td>
</tr>

<tr style="width:55px;" align="right">
<td height="18" width="40" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px;">SERVICE:<input type="text" name="service" id="service"  value="<?php echo $_POST['service']; ?>" onkeyup="Gettax()" style="width:40px;"/>%&nbsp;&nbsp;&nbsp;<div style="float:right; width:10px;" id="ser_smt"></div></td>
</tr>

<tr style="width:55px;" align="right">
<td height="18" width="40" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px;">SALES:<input type="text" name="sales" id="sales" value="<?php echo $_POST['sales']; ?>" onkeyup="Gettax()" style="width:40px;"/>%&nbsp;&nbsp;&nbsp;<div style="float:right; width:10px;" id="sales_smt"></div></td>

</tr>

</table>

</p>
<p><input type="hidden" name="totaltax" id="totaltax" /></p> 
</div>  
</td>
   </tr>
    <tr>
     <td class="verdanablack"  colspan="6"  style="text-align:right;"> 
 <div id="netamount" style="font-size: 16px;">NET-AMOUNT: 
   <?php   
   $menuRecords = db_query("SELECT sum(order_total_price) as netamount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND table_entry_id='".$_POST['tableid']."' AND order_type='".$_POST['ordertype']."'");
   $price_values=db_fetch_array($menuRecords);  
   echo $price_values['netamount'];
	 ?> </div>
	 </td>
     
      </tr>
   
    <tr>
     <td class="verdanablack" style="text-align:center; margin-left:60px;" colspan="6">
  
 <input name="print" type="submit" id="print" value="print" 
 onclick="print('<? echo $tabelid; ?>','<?php echo $cardid; ?>')" 
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <!-- <input name="print" type="submit" id="print" value="Carry to bill" onclick="carrytobill()" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />-->

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

<input name="print" type="submit" id="print" value="Bill" onclick="RoomBill('<? echo $tabelid; ?>','<?php echo $cardid; ?>')" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
</tr>

</table>