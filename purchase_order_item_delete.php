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
	$Pur_id=$_POST['Pur_id'];
        $vendor_name=$_POST['vendor_name'];
	$purchase_order_item_delete =  "DELETE from  " . TABLE_HMS_PURCHASE_ORDER_DETAIL. "  where pur_id = '$Pur_id' ";
	$result=mysql_query($purchase_order_item_delete);
	if ($result > 0){	
	$purchase_add_list_view =  "SELECT *  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where status='0' AND vendor_name='".$vendor_name."'"; 
	$purchase_add_list_records = db_query ($purchase_add_list_view);
	if ($purchase_add_list_records > 0) {
?>
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">

<tr>
          <th width="12%" style="text-align:center" >S.No</th>
      <th width="12%" style="text-align:center" >Bill.No</th>
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
    
   <?php while ($hms_info_values = db_fetch_array($purchase_add_list_records)) { ?>
    <tr>
     <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
      <?php echo $sno; ?>
     </td>
     
     <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
         <?php
         if(strlen($hms_info_values["pur_fck_id"]) > 30) echo substr(stripslashes($hms_info_values["pur_fck_id"]),0,28).".."; 
         else echo stripslashes($hms_info_values["pur_fck_id"]); 
         ?>
     </td>
        
        
    <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["vendor_name"]) > 30) echo substr(stripslashes($hms_info_values["vendor_name"]),0,28).".."; 
        else echo stripslashes($hms_info_values["vendor_name"]); ?>
        
        <input type="hidden" id="Po_id" name="Po_id" value="<?php if(strlen($hms_info_values["pur_fck_id"]) > 30) echo substr(stripslashes($hms_info_values["pur_fck_id"]),0,28).".."; 
        else echo stripslashes($hms_info_values["pur_fck_id"]); ?>">
        
        <input type="hidden" id="Pur_id" name="Pur_id" value="<?php if(strlen($hms_info_values["pur_id"]) > 30) echo substr(stripslashes($hms_info_values["pur_id"]),0,28)."..";
        else echo stripslashes($hms_info_values["pur_id"]); ?>">
        </td>
        
       <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center">       
        <?php if(strlen($hms_info_values["item_name_id"]) > 30) echo substr(stripslashes($hms_info_values["item_name_id"]),0,28).".."; 
        else echo stripslashes($hms_info_values["item_name_id"]); ?></td>
        
        <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
          <?php if(strlen($hms_info_values["item_type_id"]) > 30) echo substr($hms_info_values["item_type_id"],0,28)."..";
          else echo $hms_info_values["item_type_id"]; ?></td>

	  <td width="9%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["price"]) > 30) echo substr($hms_info_values["price"],0,28)."..";
        else echo $hms_info_values["price"]; ?></td>


	 <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["quantity"]) > 30) echo substr($hms_info_values["quantity"],0,28).".."; 
        else echo $hms_info_values["quantity"]; ?></td>
      
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
	}
	
   } 
}
   ?>

   
   
    <tr>
       <td align="center" colspan="12">&nbsp;</td>
   </tr>
   
   
   <tr>
   <?php $Purchase_total_amount = "SELECT sum(total_amount) as t_amount FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where  status='0'";  
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
    
     <tr >
                
                  <td style="left: -159px;position: relative;" align="center"  class="verdanablack"><a style="margin-left: 365px;"  href="javascript:void(0);" Onclick="Javascript:return addPurchaseOrder();" class="submenu" > Submit</a> <a style="margin-left: 15px;" href="javascript:void(0);" Onclick="Javascript:return addPurchaseCancel();" class="submenu" > Cancel</a></td>   
                </tr>
    </table>
		
		
