<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ATOMICKA ~ Hotel Management System ::</title>
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
</head>

<body>

<?php
//$tax_method=$_POST['tax'];
$pur_id=$_GET['pur_id'];


$purchase_add_list_view =  "SELECT *  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where pur_fck_id='$pur_id' order by pur_id desc"; 	 
//echo $purchase_add_list_view;
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

         
</tr>

<?php
$sno=1;
while ($hms_info_values = db_fetch_array($purchase_add_list_records)) { ?>

<tr>
     <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
      <?php echo $sno; ?>
     </td>
     
    <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen(vendorname($hms_info_values["vendor_name"])) > 30) echo substr(stripslashes(vendorname($hms_info_values["vendor_name"])),0,28).".."; 
        else echo stripslashes(vendorname($hms_info_values["vendor_name"])); ?>
        
        <input type="hidden" id="Po_id" name="Po_id" value="<?php if(strlen($hms_info_values["pur_fck_id"]) > 30) echo substr(stripslashes($hms_info_values["pur_fck_id"]),0,28).".."; 
        else echo stripslashes($hms_info_values["pur_fck_id"]); ?>">
        
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
        
  
  
<?php 
$sno++;        
}	
   }    
?>
   <tr>
       <td align="center" colspan="11">&nbsp;</td>
   </tr>
   
    </table>
    </body>
</html>