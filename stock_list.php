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
$FromDate=$_POST['ddDateFrom'];
$ToDate=$_POST['ddDateTo'];

if($vendor=="All")
{
$aaa= "where date BETWEEN '$FromDate' AND '$ToDate'";
}

else
{
$aaa= "where vendor_name = '$vendor' AND date BETWEEN '$FromDate' AND '$ToDate'";
}

$vendor_list_sqls =  "SELECT *  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " $aaa"; 
	 	
$vendor_list_recordss = db_query ($vendor_list_sqls);
if(mysql_num_rows($vendor_list_recordss)>0) { 
    
?>
      
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr >
<td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"> Stock Order Detail</td>
</tr>
    <tr>

         <th  style="text-align:center" >S.No</th>
           <th  style="text-align:center" >Date </th>
         <th  style="text-align:center" >Vendor Name </th>
	<th  style="text-align:center" >Item Name </th>
         <th  style="text-align:center" >Item Type </th>
         <th  style="text-align:center" >Price</th>
	<th  style="text-align:center" >Quantity</th>
         <th  style="text-align:center" >Tax%</th>
         <th  style="text-align:center" >Pur.Tax%</th>
         <th  style="text-align:center" >Discount%</th>
         <th  style="text-align:center" >Total Amount</th>
         
    </tr>
   <?php $sno=1; while ($hms_info_values = db_fetch_array($vendor_list_recordss)) { ?>
    <tr>
	
             <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
      <?php echo $sno; ?>
     </td>
     
      <td width="8%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
          
        <?php 
        $date = explode('-',$hms_info_values["date"]);
		echo $date[2] . "-" . $date[1] . "-" . $date[0]; 
        ?></td>

        <td width="8%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen(vendorname($hms_info_values["vendor_name"])) > 30) echo substr(stripslashes(vendorname($hms_info_values["vendor_name"])),0,28).".."; else echo stripslashes(vendorname($hms_info_values["vendor_name"])); ?></td>
        
       <td width="8%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
       
        <?php if(strlen(itemname($hms_info_values["item_name_id"])) > 30) echo substr(stripslashes(itemname($hms_info_values["item_name_id"])),0,28).".."; else echo stripslashes(itemname($hms_info_values["item_name_id"])); ?></td>
        
		  <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <?php if(strlen(itemtypename($hms_info_values["item_type_id"])) > 30) echo substr(itemtypename($hms_info_values["item_type_id"]),0,28)."..";
          else echo itemtypename($hms_info_values["item_type_id"]); ?></td>

		  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["price"]) > 30) echo substr($hms_info_values["price"],0,28).".."; else echo $hms_info_values["price"]; ?></td>


		  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_info_values["quantity"]) > 30) echo substr($hms_info_values["quantity"],0,28).' '.unitname($hms_info_values["unit"]); 
        else echo $hms_info_values["quantity"].' '.unitname($hms_info_values["unit"]); ?></td></td>
        
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

  </tr>
  
   <?php $sno++; }  

   ?>
 <tr>
     <td align="center" colspan="11">&nbsp;</td>

   </tr>
   
   <tr>
   
<?php

 $Purchase_total_amount = "SELECT sum(total_amount) as t_amount FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " $aaa AND status='1'";  

$total_amount = mysql_query($Purchase_total_amount);
$Purchase_amount =mysql_fetch_array($total_amount);
?>
  
      
       <td  colspan="10" align="right"><strong>Total Price</strong></td>
   <td align="center"><?php echo $Purchase_amount['t_amount']?></td>
   </tr>
   
   <tr>
   <td colspan="11" align="center" class="nonprintable">
 <input name="btnPrint" type="button" id="btnPrint" class="submit"
  value="Print" onClick="getStockListView('<?php echo $vendor; ?>','<?php echo $FromDate ; ?>','<?php echo $ToDate ; ?>');">
  </td>
  </tr>
 <?php
   } 

  else {
  ?>
	 <table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
	<tr><td colspan="12" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
	</tr>
	</table>
	<?
	}
 ?>     
   
  
    </table>
    