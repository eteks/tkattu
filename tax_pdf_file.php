<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();
//?>


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
 padding:10px;
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
$FromDate=$_GET['from'];
$ToDate=$_GET['to'];

$tax_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$tax_list_recordss = db_query ($tax_list_sqls); 
                                                     
if(mysql_num_rows($tax_list_recordss)>0){  
    
 $vat_amt_sqls = "SELECT sum(vat_amt) as v_amt  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$vat_amt_recordss = db_query ($vat_amt_sqls); 
 $vat_info_values_tax = db_fetch_array($vat_amt_recordss);
 
  $ser_amt_sqls = "SELECT sum(service_amt) as s_amt  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$ser_amt_recordss = db_query ($ser_amt_sqls); 
 $ser_info_values_tax = db_fetch_array($ser_amt_recordss);
 
 
 $val_amt_sqls = "SELECT sum(order_amount) as t_amt FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS."  where itemcancel=0 AND status='close' AND order_open_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
 $val_amt_recordss = db_query($val_amt_sqls);
$val_info_values_tax = db_fetch_array($val_amt_recordss);  
                
 $tol_amt_sqls = "SELECT sum(total_amount) as total_amt FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS."  where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
 $tol_amt_recordss = db_query($tol_amt_sqls);
$tol_info_values_tax = db_fetch_array($tol_amt_recordss);  
 
    $d_amt_sqls = "SELECT sum(disc_amt) as discnt  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$d_amt_recordss = db_query ($d_amt_sqls); 
 $d_info_values_tax = db_fetch_array($d_amt_recordss);

?>
      
<table width="1000" border="1" cellspacing="0" cellpadding="10" class="ntab" style="font-size:12px;">
<tr >
    <td height="38" width="750"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><?php echo $tax_method; ?> 
<p style="font-size: 16px;color:#f20530;"><?php echo $_SESSION["hotelname"];?></p>
Tax Report Detail
</td>

</tr>
  
 <tr>   
     <th width="100" style="text-align:center" align="center">S.No</th> 
     <th width="100" style="text-align:center" align="center">Party</th> 
     <th width="100" style="text-align:center" align="center">Bill.No</th> 
     <th width="100" style="text-align:center" align="center">Date</th> 
     <th width="100" style="text-align:center" align="center">Value</th> 
     <th width="100" style="text-align:center" align="center">VAT Tax</th> 
     <th width="100" style="text-align:center" align="center">SER TaX</th> 
     <th width="100" style="text-align:center" align="center">Discount</th> 
     <th width="100" style="text-align:center" align="center">Total</th>
    </tr>
    
   <?php $sno=1; while ($hms_info_values_tax = db_fetch_array($tax_list_recordss)) { 
       
        $payment_mode = db_query("SELECT *  FROM " .TABLE_HMS_PAYMENT_DETAIL. " where bill_no='".$hms_info_values_tax["bill_id"]."'");       
	$table_data  = db_fetch_array($payment_mode);
    
     $acc_query3 = "SELECT sum(order_amount) as total FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$acctdetails3 = db_fetch_array($acc_query_result3);   
          
         $acc_query3 = "SELECT sum(vat_amount) as vat FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$sum_vat = db_fetch_array($acc_query_result3);  
                
         $acc_query3 = "SELECT sum(service_amount) as ser FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$sum_ser = db_fetch_array($acc_query_result3); 
      
         $acc_disc = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query = db_query($acc_disc);
		$disc_data = db_fetch_array($acc_query);        
                ?>

    <tr>	
      
        <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
 <?php echo $sno; ?></td>

 <td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
<?php if(strlen($table_data["payment_method"]) > 30) echo substr($table_data["payment_method"],0,28).".."; else echo $table_data["payment_method"]; ?></td>

  <td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
<?php if(strlen($hms_info_values_tax["bill_id"]) > 30) echo substr($hms_info_values_tax["bill_id"],0,28).".."; else echo $hms_info_values_tax["bill_id"]; ?></td>

  <td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
     
  <?php  //echo $hms_info_values_tax["orde_close_date"];
  $date = explode('-',$hms_info_values_tax["orde_close_date"]);
 echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?> 
</td>

        
   <td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
     <?php echo round($acctdetails3["total"],1); ?>   
   </td>
        
   <td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
       <?php if(strlen($sum_vat["vat"]) > 30) echo substr($sum_vat["vat"],0,28).".."; else echo $sum_vat["vat"]; ?>
</td>

 
 <td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
 <?php if(strlen($sum_ser["ser"]) > 30) echo substr($sum_ser["ser"],0,28).".."; else echo $sum_ser["ser"]; ?>
 </td>
    
<td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
 <?php 
  $disc=$hms_info_values_tax["total_amount"]*($disc_data["discount"]/100);
  echo round($disc);
 ?>
</td>        

   <td width="13%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
     <?php 
     //echo $disc_data["discount"];
     $disc=$hms_info_values_tax["total_amount"]*($disc_data["discount"]/100);
     echo round($hms_info_values_tax["total_amount"]-round($disc));
    // if(strlen($hms_info_values_tax["total_amount"]) > 30) echo substr($hms_info_values_tax["total_amount"],0,28).".."; else echo $hms_info_values_tax["total_amount"]; 
     ?>
</td>    

  </tr>
  
   <?php $sno++; }   }    ?>
   
  <tr>
     <td align="center" colspan="9"></td>
 </tr>
    
    <tr>
   <td align="center"></td>
   <td align="center"></td>
   <td align="center"></td>
   <td align="center"></td>
   <td align="center"><?php echo round($val_info_values_tax['t_amt'],1); ?></td>
   <td align="center"><?php echo $vat_info_values_tax['v_amt']; ?></td>
   <td align="center"><?php echo $ser_info_values_tax['s_amt']; ?></td>
   <td align="center"><?php echo $d_info_values_tax['discnt']; ?></td>
   <td align="center">
       
       <?php    
       $ttt= round($tol_info_values_tax["total_amt"])-round($d_info_values_tax['discnt']);       
       echo $ttt;
       ?>
   </td>
    
   </tr>
    </table>
    </body>
</html>