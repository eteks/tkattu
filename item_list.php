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
$item=$_POST['main_menu_id'];
$FromDate=$_POST['ddDateFrom'];
$ToDate=$_POST['ddDateTo'];

if($item=="All")
{
	$aaa= "where order_posted_date BETWEEN '$FromDate' AND '$ToDate' AND status='close' order by bill_id ASC"; 
	}

else
{
$aaa= "where order_product = '$item' AND order_posted_date BETWEEN '$FromDate' AND '$ToDate' AND status='close' order by bill_id ASC"; 
	}

$item_list_sqls =  "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " $aaa"; 
//echo $item_list_sqls;
    $item_list_recordss = db_query ($item_list_sqls);
if(mysql_num_rows($item_list_recordss)>0) { 
    
?>
      
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr >
<td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"> Item Order Detail</td>
</tr>
    <tr>

         <th width="13%" style="text-align:center" >S.No</th>
         <th width="12%" style="text-align:center" >Item Name</th>
            <th width="15%" style="text-align:center" >Quantity</th>
            <th width="12%" style="text-align:center" >Date</th>
             <th width="15%" style="text-align:center" >Amount</th>
         
    </tr>
   <?php $sno=1; while ($hms_item_values = db_fetch_array($item_list_recordss)) { ?>
    <tr>
	
        <td width="8%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center">
        <?php echo $sno; ?></td>
        
       <td width="8%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >       
<?php if(strlen($hms_item_values["order_product"]) > 30) echo substr(stripslashes($hms_item_values["order_product"]),0,28).".."; else echo stripslashes($hms_item_values["order_product"]); ?></td>
        
  <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
 <?php if(strlen($hms_item_values["order_quantity"]) > 30) echo substr($hms_item_values["order_quantity"],0,28).".."; else echo $hms_item_values["order_quantity"]; ?></td>


<td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >



        
        <?php if ($hms_item_values["order_posted_date"]== "0") {  echo "- -"; } else {         
        $date = explode('-',$hms_item_values["order_posted_date"]); echo $date[2] . "-" . $date[1] . "-" . $date[0];        
        }
        ?>       

</td>
       

 <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
 <?php if(strlen($hms_item_values["order_total_price"]) > 30) echo substr($hms_item_values["order_total_price"],0,28).".."; else echo $hms_item_values["order_total_price"]; ?></td>
      
  </tr>
  
   <?php  $sno++; } 
?>
<tr>

   <td align="center">&nbsp;</td>
   <td align="center">&nbsp;</td>
   <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
   <td align="center">&nbsp;</td>
   </tr>
   
   <tr>
   
<?php
 $item_total_amount = "SELECT sum(order_total_price) as amount FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " $aaa";  
 //echo $item_total_amount;
$i_total_amount = mysql_query($item_total_amount);
$item_amount =mysql_fetch_array($i_total_amount);
?>
  
       

   <td align="center">&nbsp;</td>
   <td align="center">&nbsp;</td>
   <td align="center">&nbsp;</td>
   <td align="center"><strong>Total Price</strong></td>
   <td align="center"><?php echo $item_amount['amount']?></td>
   </tr>
   
   <tr>
   <td colspan="7" align="center" class="nonprintable">
 <input name="btnPrint" type="button" id="btnPrint" class="submit"
  value="Print" onClick="getItemListView('<?php echo $item; ?>','<?php echo $FromDate ; ?>','<?php echo $ToDate ; ?>');">
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
    