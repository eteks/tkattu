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
<style type="text/css">
<!--
.style1 {font-size: 12px; font-style: normal; line-height: normal; font-variant: normal; text-transform: none; color: #000000; text-decoration: none; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->



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
<style type="text/css" media="print">    
				    .nonprintable
				
					{
					  display: none;
					}  
					</style>
</head>

<body>


<?php
if($_GET["item_name"]=="All")
{
?>

<TABLE cellpadding="0" cellspacing="0" border="0" width="100%">
    <TR><TD valign="top" align="center">

<table width="850"  border="0" align="center" cellpadding="2" cellspacing="2" style="border:1px solid #000000;" class="NormalTxt"  >
  
    <td  bgcolor="#D7DBB0" class="style1" colspan="4" align="center" ><strong><u>ITEM SALES REPORT </u></strong></td>
  </tr>
</table> 
    
  <table width="850"  border="1" align="center" cellpadding="0" cellspacing="0" class="NormalTxt">
    <tr>   
         <th width="13%" style="text-align:center" >S.No</th>
         <th width="12%" style="text-align:center" >Item Name</th>
            <th width="15%" style="text-align:center" >Quantity</th>
            <th width="12%" style="text-align:center" >Date</th>
             <th width="15%" style="text-align:center" >Amount</th>  
    </tr>
  
<?php
$Item_List_Details1 = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " where  order_posted_date BETWEEN '". $_GET["from"] ."' AND '". $_GET["to"] ."' AND status='close' order by bill_id ASC"; 
$ItemQuery1 = mysql_query($Item_List_Details1);
$sno=1;
while ($ItemArray1 = db_fetch_array($ItemQuery1)) { ?>
  
  
  <tr>

    <td align="center"> <?php  echo $sno; ?></td>
    <td align="center"> <?php if ($ItemArray1["order_product"]== ""){ echo "- -";} else { echo $ItemArray1["order_product"];}?></td>
    <td align="center"><?php if ($ItemArray1["order_quantity"]== "0"){ echo "- -";} else { echo $ItemArray1["order_quantity"];}?></td>
    
    <td align="center">
        
        <?php if ($ItemArray1["order_posted_date"]== "0") {  echo "- -"; } else {         
        $date = explode('-',$ItemArray1["order_posted_date"]); echo $date[2] . "-" . $date[1] . "-" . $date[0];        
        }
        ?>       
      
    </td>
    
    <td align="center"><?php echo $ItemArray1["order_total_price"];?></td>
  </tr>
  <?php $sno++; } ?>
      
  <tr>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  </tr>
  
  <tr>
  
  <?php
 $item_total_amount = "SELECT sum(order_total_price) as amount FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " where  order_posted_date BETWEEN '". $_GET["from"] ."' AND '". $_GET["to"] ."' AND status='close'";  
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
    <td colspan="8" align="right" class="YellowTxt">&nbsp;</td>
  </tr>
  
  <!-- <tr>
    <td colspan="8" align="right" class="TitleTxt">SECURITY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr> -->
	
<?php
}

else{
?>

<table width="650"  border="0" align="center" cellpadding="2" cellspacing="2" style="border:1px solid #000000;" class="NormalTxt"  >
  
    <td  bgcolor="#D7DBB0" class="style1" colspan="4" align="center" ><strong><u>ITEM SALES REPORT </u></strong></td>
  </tr>
 
 
  <!--<tr>
    <td align="left"><strong>Vendor Name</strong></td>
    <td align="left" class="NormalTxt">: &nbsp; <?php if ($customerArray["vendor_name"]== ""){ echo "- -";} else { echo $customerArray["vendor_name"];}?> </td>
     <td colspan="2" align="left" class="NormalTxt"><strong>Date</strong>:&nbsp;<?php echo @date('d-m-Y'); ?></td>
   
    </tr>
  
  <tr>
    <td align="left" valign="top"><strong>Vendor Details</strong></td>
    <td colspan="2" align="left" class="NormalTxt">:
<?php /*
$string = $customerArray["vendor_detail"];
$tags = explode(',' , $string);
foreach($tags as $i =>$key) {
$i >0;
echo  '&nbsp;&nbsp;'.$key .'</br>'.'&nbsp;';

}
*/ ?> 

</td>
    <td align="left" class="NormalTxt">&nbsp;</td>
    </tr> -->
    
    
    
    </table> 
    
  <table width="650"  border="1" align="center" cellpadding="0" cellspacing="0" class="NormalTxt"  >

  <tr>
   
         <th width="13%" style="text-align:center" >S.No</th>
         <th width="12%" style="text-align:center" >Item Name</th>
            <th width="15%" style="text-align:center" >Quantity</th>
            <th width="12%" style="text-align:center" >Date</th>
             <th width="15%" style="text-align:center" >Amount</th>
  </tr>
  
  
<?php   
$Item_List_Details = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " where order_product = '". $_GET["item_name"] ."' AND order_posted_date BETWEEN '". $_GET["from"] ."' AND '". $_GET["to"] ."' AND status='close'";
$itemQuery = mysql_query($Item_List_Details);
$sno=1;  
while ($itemArray = db_fetch_array($itemQuery)) {
 ?>
  
  <tr>

    <td align="center"> <?php  echo $sno; ?></td>
    <td align="center"> <?php if ($itemArray["order_product"]== ""){ echo "- -";} else { echo $itemArray["order_product"];}?></td>
    <td align="center"><?php if ($itemArray["order_quantity"]== "0"){ echo "- -";} else { echo $itemArray["order_quantity"];}?></td>
    <td align="center"><?php if ($itemArray["order_posted_date"]== "0"){ echo "- ";} else { echo $itemArray["order_posted_date"];}?></td>
    <td align="center"><?php echo $itemArray["order_total_price"];?></td>
  </tr>
  <?php $sno++; } ?>

  <tr>

  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  
  </tr>
  
  <tr>
  
  <?php 
 $i_total_amount = "SELECT sum(order_total_price) as amount FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " where order_product = '". $_GET["item_name"] ."' AND order_posted_date BETWEEN '". $_GET["from"] ."' AND '". $_GET["to"] ."' AND status='close'";  
  $it_amount = mysql_query($i_total_amount);
$ite_amount =mysql_fetch_array($it_amount);

  ?>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center"><strong>Total Price</strong></td>
  <td align="center"><?php echo $ite_amount['amount']?></td>
 
  </tr>
  
  <tr>
    <td colspan="7" align="right" class="YellowTxt">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="7" align="right" class="TitleTxt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
   <?php }  ?>
   <tr>
  
  
    <td colspan="8"  align="center" class="nonprintable">
	
	<input name="btnPrint" type="button" id="btnPrint" class="submit"
  value="Print" onClick="window.print();"/>
	  &nbsp;&nbsp; <input name="btnclose" class="submit" onClick="window.close();" type="button" id="btnclose" value="Close" />	  </td>
  </tr>
</table>

  
</table> 
</TD> </TR> 
</TABLE>

</body>
</html>