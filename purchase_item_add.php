<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();
?>

<style>
.submit {
 font:Arial;
 font-size:11px;
 background:#330000;

 color: #CCCCCC;
/* border:1px solid #990000;*/
 padding:1px;
/* font-weight:bold;*/
cursor:pointer;
}
</style>

<?php
$vendor=$_POST['main_menu_id'];
$vendor_details=trim($_POST['vendor_details']);
$date=$_POST['ddDateFrom'];
$item_menu_id=$_POST['item_menu_id'];
$item_type_value=$_POST['item_type_value'];
$item_unit_value=$_POST['item_unit_value'];
$item_quantity=$_POST['item_quantity'];
$item_unit_price=$_POST['item_unit_price'];
$item_total_price=$_POST['item_total_price'];
$reorderlevel=$_POST['reorderlevel'];

$tax=$_POST['tax'];
$tax_amount=$_POST['tax_amt'];
$purchase_tax=$_POST['purchase_tax'];
$purchase_tax_amount=$_POST['purchase_tax_amt'];
$discount=$_POST['discount'];
$discount_amt=$_POST['discount_amt'];

$purchase_order_id="SELECT cart_id,pur_fck_id  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " order by pur_id desc" ;
 $purchase_order_id_records = db_query ($purchase_order_id);
 $hms_pur_order_id_values = db_fetch_array($purchase_order_id_records);
 if(db_num_rows($purchase_order_id_records)>0)
 {
 if($hms_pur_order_id_values["pur_fck_id"]=='')    
 $cart_id = $hms_pur_order_id_values["cart_id"];
 else
 $cart_id = $hms_pur_order_id_values["cart_id"]+1;    
 }
 else
 $cart_id = 1;
 
  $total_amount= $item_total_price+$tax_amount+$purchase_tax_amount-$discount_amt;


$purchase_add_list= "INSERT INTO ".TABLE_HMS_PURCHASE_ORDER_DETAIL. "(vendor_name,cart_id,vendor_detail,item_name_id,item_type_id,unit,quantity,
 reorder_level,price,tax,tax_amount,purchase_tax,purchase_tax_amount,discount,discount_amount,amount,total_amount,date,status) values 
('$vendor','$cart_id','$vendor_details','$item_menu_id','$item_type_value','$item_unit_value','$item_quantity','$reorderlevel','$item_unit_price',
 '$tax','$tax_amount','$purchase_tax','$purchase_tax_amount','$discount','$discount_amt','$item_total_price','$total_amount', '$date','0')";
//echo $purchase_add_list;
 
$result=mysql_query($purchase_add_list);

$purchase_add_list_view =  "SELECT *  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where status='0' AND vendor_detail='".$vendor_details."' order by pur_id desc"; 	 	
$purchase_add_list_records = db_query ($purchase_add_list_view);			
 if ($purchase_add_list_records > 0) {	
?>
      
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr>
          <th width="12%" style="text-align:center" >S.No</th>
      <th width="12%" style="text-align:center" >Vendor Name</th>
         <th width="11%" style="text-align:center" >Item  Name</th>
		  <th width="12%" style="text-align:center" >Item Type </th>
            <th width="9%" style="text-align:center" >Price</th>
		    <th width="12%" style="text-align:center" >Quantity</th>
             <th width="11%" style="text-align:center" >Tax%</th>
            <th width="11%" style="text-align:center" >Pur.Tax%</th>
          <th width="11%" style="text-align:center" >Discount%</th>
             <th width="14%" style="text-align:center" >Total Amount </th>
             <th width="10%" style="text-align:center" >Remove</th>
         
</tr>

<?php
$sno=1;
while ($hms_info_values = db_fetch_array($purchase_add_list_records)) { $vendor_name = vendorname($hms_info_values["vendor_name"]); ?>

<tr>
     <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
      <?php echo $sno; ?>
     </td>
     
    <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($vendor_name) > 30) echo substr(stripslashes($vendor_name),0,28).".."; 
        else echo stripslashes($vendor_name); ?>
        
        <input type="hidden" id="cart_id" name="cart_id" value="<?php echo stripslashes($hms_info_values["cart_id"]); ?>">
        
        <input type="hidden" id="Pur_id" name="Pur_id" value="<?php if(strlen($hms_info_values["pur_id"]) > 30) echo substr(stripslashes($hms_info_values["pur_id"]),0,28)."..";
        else echo stripslashes($hms_info_values["pur_id"]); ?>">
        </td>
        
       <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center">       
        <?php if(strlen(itemname($hms_info_values["item_name_id"])) > 30) echo substr(stripslashes(itemname($hms_info_values["item_name_id"])),0,28).".."; 
        else echo stripslashes(itemname($hms_info_values["item_name_id"])); ?></td>
        
        <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
          <?php if(strlen(itemtypename($hms_info_values["item_type_id"])) > 30) echo substr(itemtypename($hms_info_values["item_type_id"]),0,28)."..";
          else echo itemtypename($hms_info_values["item_type_id"]); ?></td>

	  <td width="9%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["price"]) > 30) echo substr($hms_info_values["price"],0,28)."..";
        else echo $hms_info_values["price"]; ?></td>


	 <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["quantity"]) > 30) echo substr($hms_info_values["quantity"],0,28).' '.unitname($hms_info_values["unit"]); 
        else echo $hms_info_values["quantity"].' '.unitname($hms_info_values["unit"]); ?></td>
      
 <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["tax"]) > 30) echo substr($hms_info_values["tax"],0,28).".."; 
        else echo $hms_info_values["tax"]; ?></td>
 
  <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["purchase_tax"]) > 30) echo substr($hms_info_values["purchase_tax"],0,28).".."; 
        else echo $hms_info_values["purchase_tax"]; ?></td>
  
   <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["discount"]) > 30) echo substr($hms_info_values["discount"],0,28).".."; 
        else echo $hms_info_values["discount"]; ?></td>
   
   
        
<td width="14%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
    
        <?php 
     echo  $hms_info_values['total_amount'];
       ?>


</td>
        
    <td width="5%" style="text-align:center" bgcolor="#FFFFFF"><img src="images/delete.gif" alt="Delete" border="0" title="Click to delete" onClick="deletePurchaseItemRecord()" style="cursor:pointer;"></td>
      
  </tr>
  
  
   <?php 
	$sno++;        
}	
   } 
   
   ?>
   <tr>
       <td align="center" colspan="11">&nbsp;</td>
   </tr>
   
   
   <tr>
   <?php $Purchase_total_amount = "SELECT sum(total_amount) as t_amount FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where  status='0'  AND vendor_detail='".$vendor_details."' ";  
  $total_amount = mysql_query($Purchase_total_amount);
$Purchase_amount =mysql_fetch_array($total_amount);
  ?>

    <td align="center" colspan="9">&nbsp;</td>
   <td align="center"><strong>Total Price</strong></td>
   <td align="center">
       
       <?php 
      echo $Purchase_amount['t_amount']; 
       ?>
   
   </td>
    <td align="center">&nbsp;</td>
   </tr>
    </table>
     <div style="height:30px;"></div>
    <table>
    
     <tr>                
                  <td style="left: -159px;position: relative;" align="center"  class="verdanablack">
                      <a style="margin-left: 365px;"  href="javascript:void(0);" Onclick="Javascript:return addPurchaseOrder();" class="submenu" > Submit</a> <a style="margin-left: 15px;" href="javascript:void(0);" Onclick="Javascript:return addPurchaseCancel();" class="submenu" > Cancel</a></td>   
                </tr>
    </table>
###<?php echo $vendor_name;?>