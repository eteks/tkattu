<?php
require_once ("includes/application_top.php");

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
$Purchase_List_Details = "SELECT *  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where vendor_name = '". $_GET["vendor_name"] ."' AND date BETWEEN '". $_GET["from"] ."' AND '". $_GET["to"] ."' AND status='1'";

$customerQuery = mysql_query($Purchase_List_Details);
$customerArray =mysql_fetch_array($customerQuery);
?>


<table width="650"  border="0" align="center" cellpadding="2" cellspacing="2" style="border:1px solid #000000;" class="NormalTxt"  >
  
    <td  bgcolor="#D7DBB0" class="style1" colspan="4" align="center" >
	<p style="font-family: initial;font-size: 16px;color:#f20530;"><?php echo $_SESSION["hotelname"];?></p>
	<strong><u>RESTAURANT TOTAL SALES REPORT </u></strong></td>
  </tr>
<?php
$date = explode('-',$_GET['fromdd']);
$date1 = explode('-',$_GET['todd']);
?>
  <tr>
    <td align="left"><strong>FROM DATE</strong></td>
    <td align="left" class="NormalTxt">: &nbsp; <?php echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?> </td>
     <td colspan="2" align="left" class="NormalTxt"><strong>TO DATE</strong>:&nbsp;<?php echo $date1[2] . "-" . $date1[1] . "-" . $date1[0]; ?></td>
 </tr>
  
</table> 
    
    
  <table width="650"  border="1" align="center" cellpadding="0" cellspacing="0" class="NormalTxt">
  <tr align="center" bgcolor="#999999" class="site_font_black">   
         <th bgcolor="#cccccc" style="text-align:center" >S.no</th>
		 <th  bgcolor="#cccccc" style="text-align:center" >Bill no</th>
         <th bgcolor="#cccccc" style="text-align:center" >Order Type</th>
         <th bgcolor="#cccccc" style="text-align:center" >Date</th>
		 <th bgcolor="#cccccc" style="text-align:center" >Amount</th>
  </tr>
  
   <?php
   $Purchase_List_Details1 = "SELECT * FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE  orde_close_date BETWEEN '". $_GET["fromdd"] ."' AND '". $_GET["todd"] ."' AND status = 'close' order by bill_id ASC"; 
   
$customerQuery1 = db_query($Purchase_List_Details1);
$i = 1;
    while ($customerArray1 = db_fetch_array($customerQuery1)) { 
 $order_date = explode('-',$customerArray1["orde_close_date"]);  ?>
  <tr>
    <td height="20"  class="verdanablack" align="center"><?php echo $i; ?></td>
    <td height="20"  class="verdanablack" align="center"><?php echo $customerArray1["bill_id"]; ?></td>
    <td height="20"  class="verdanablack" align="center"> <?php echo $customerArray1["order_type"]; ?></td>
    <td height="20"  class="verdanablack" align="center"><?php echo $order_date[2] . "-" . $order_date[1] . "-" . $order_date[0];?> </td>
    <td height="20"  class="verdanablack" align="center"><?php echo $customerArray1["total_amount"]; ?></td>
  </tr>
  <?php $i++; }  ?>
  <tr>
  <td align="center">&nbsp;</td>

  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  </tr>
  
  <tr>
  
  <?php 
  $Purchase_total_amount = "SELECT sum(total_amount) as total_amount FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE  orde_close_date BETWEEN '". $_GET["fromdd"] ."' AND '". $_GET["todd"] ."' AND status = 'close'";
    
  $total_amount =db_query($Purchase_total_amount);
   $Purchase_amount =db_fetch_array($total_amount);

  ?>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center"><strong>Total Price</strong></td>
  <td align="center"><?php echo $Purchase_amount['total_amount']?></td>
  </tr>
    <tr>

    <td colspan="8"  align="center" class="nonprintable">
	
	<input name="btnPrint" type="button" id="btnPrint" class="submit"
  value="Print" onClick="window.print();">
	  &nbsp;&nbsp; <input name="btnclose" class="submit" onClick="window.close();" type="button" id="btnclose" value="Close" >	  </td>
  </tr>
</table>

  
</table> 
</TD> </TR> 
</TABLE>

</body>
</html>