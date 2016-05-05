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
$vendor=$_GET['vendor_name'];
$FromDate=$_GET['from'];
$ToDate=$_GET['to'];

if($vendor=="All")
{
$aaa= " where status='1' AND date BETWEEN '$FromDate' AND '$ToDate'  order by pur_fck_id ASC";
}

else
{
$aaa= " where vendor_name = '$vendor' AND status='1' AND date BETWEEN '$FromDate' AND '$ToDate'  order by pur_fck_id ASC";
}

$tax_list_sqls = "SELECT DISTINCT pur_fck_id FROM ".TABLE_HMS_PURCHASE_ORDER_DETAIL." $aaa "; 
//echo $tax_list_sqls;
$tax_list_recordss = db_query ($tax_list_sqls);                                                      
if(mysql_num_rows($tax_list_recordss)>0)
    {  
?>
      
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr>
<td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><?php echo $tax_method; ?> 
<p style="font-family: initial;font-size: 16px;color:#f20530;"><?php echo $_SESSION["hotelname"];?></p>
Purchase Report Detail
</td>
</tr>
    
    <tr>   
    <th width="12%" style="text-align:center"> S.No</th> 
    <th width="13%" style="text-align:center">Bill.No</th> 
    <th width="13%" style="text-align:center">Date</th> 
    <th width="13%" style="text-align:center">Supplier Name</th> 
    <th width="8%" style="text-align:center">Total</th>.

    </tr>
    
    
  <?php
   
    $sno=1; 
   while ($hms_info_values_tax = db_fetch_array($tax_list_recordss))
   {          
   $payment_mode = db_query("SELECT *  FROM " .TABLE_HMS_PURCHASE_ORDER_DETAIL. " where pur_fck_id='".$hms_info_values_tax["pur_fck_id"]."'");       
   $table_data  = db_fetch_array($payment_mode);
   
   $payment_total = db_query("SELECT sum(total_amount) as t_amount FROM " .TABLE_HMS_PURCHASE_ORDER_DETAIL. " where pur_fck_id='".$hms_info_values_tax["pur_fck_id"]."'");       
   $payment_t = db_fetch_array($payment_total);
   ?>
    
   <tr>	
       
 <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
 <?php echo $sno; ?></td>

  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
<?php if(strlen($hms_info_values_tax["pur_fck_id"]) > 30) echo substr($hms_info_values_tax["pur_fck_id"],0,28).".."; else echo $hms_info_values_tax["pur_fck_id"]; ?></td>

  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
 <?php 
  $date = explode('-',$table_data["date"]);
 echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?> 
</td>


<td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
     <?php echo $table_data["vendor_name"]; ?>
</td>

   <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
     <?php echo round($payment_t["t_amount"]); ?>
</td>
       

 
  </tr>
  
    <?php $sno++; }  } ?>
    
   <tr>
       <td align="center" colspan="9">&nbsp;</td>

   </tr>
      
   <tr>
   <td colspan="9" align="center" class="nonprintable">
 <input name="btnPrint" type="button" id="btnPrint" class="submit"  value="Print" onClick="window.print();">
 &nbsp;&nbsp; <input name="btnclose" class="submit" onClick="window.close();" type="button" id="btnclose" value="Close" >
  </td>
  </tr>
    </table>
    </body>
