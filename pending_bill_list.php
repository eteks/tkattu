<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->

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



<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;" id="reopen_id">
    
   <?php
//$tax_method=$_POST['tax'];
$FromDate=$_GET['from'];
$ToDate=$_GET['to'];
 if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='1')
           $wherecon = " AND created_role_id='".$_SESSION["admin_role_mst_id"]."'";
$cancel_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='close' AND bill_status='pending' $wherecon order by bill_id ASC"; 
//echo $tax_list_sqls;
$cancel_list_recordss = db_query ($cancel_list_sqls);                                                     
if(mysql_num_rows($cancel_list_recordss)>0){    
?>
    
    
<tr >
    <td height="38" width="750" colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><?php echo $tax_method; ?> 
<p style="font-size: 16px;color:#f20530;"><?php echo $_SESSION["hotelname"];?></p>
Pending Bill List
</td>
</tr>

    <tr>   
        <th width="12%" style="text-align:center" align="center"> S.No</th> 
    <th width="13%" style="text-align:center" align="center">Bill.No</th> 
      <th width="8%" style="text-align:center" align="center">Cus-Name </th>
    <th width="13%" style="text-align:center"align="center">Date</th>        
    <th width="8%" style="text-align:center" align="center">Total Amount</th>
  
   <th width="8%" style="text-align:center" align="center">Paid Amount</th>
    <th width="8%" style="text-align:center" align="center">Pending Amount</th>
      <?php if($_GET["open"]!='pending_pdf'){ ?>  
    <th width="13%" style="text-align:center" colspan="2" align="center"> Action </th> 
      <?php  }  ?>
    </tr>
    
   <?php $sno=1;    
   while ($hms_info_values_tax = db_fetch_array($cancel_list_recordss)) {        

    $payment_mode = db_query("SELECT *  FROM " .TABLE_HMS_PAYMENT_DETAIL. " where bill_no='".$hms_info_values_tax["bill_id"]."'");       
    $table_data  = db_fetch_array($payment_mode);

    $acc_query3 = "SELECT sum(order_amount) as total FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE  itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
    $acc_query_result3 = db_query($acc_query3);
    $acctdetails3 = db_fetch_array($acc_query_result3);   

    $acc_query3 = "SELECT sum(vat_amount) as vat FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
    $acc_query_result3 = db_query($acc_query3);
    $sum_vat = db_fetch_array($acc_query_result3);  

    $acc_query3 = "SELECT sum(service_amount) as ser FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE  itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
    $acc_query_result3 = db_query($acc_query3);
    $sum_ser = db_fetch_array($acc_query_result3); 
    
   $payment_details = db_query("SELECT name,total_amount,sum(paid_amount) as p_amount FROM " .TABLE_HMS_CREDIT_PAYMENT_DETAIL. " where credit_bill_id='".$hms_info_values_tax["bill_id"]."'");       
    $payment_data  = db_fetch_array($payment_details);
    
  ?> 
    
   <tr>	
       
 <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
 <?php echo $sno; ?></td>

  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
<?php if(strlen($hms_info_values_tax["bill_id"]) > 30) echo substr($hms_info_values_tax["bill_id"],0,28).".."; else echo $hms_info_values_tax["bill_id"]; ?></td>

       
       <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
     <?php  echo $payment_data['name']; ?>
</td>     
       
  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
<?php  //echo $hms_info_values_tax["orde_close_date"];
  $date = explode('-',$hms_info_values_tax["orde_close_date"]);
 echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?> 
</td>
       

   <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
<?php  echo $payment_data['total_amount']; ?>
</td>  

       
  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">     
        
      <?php  echo $payment_data['p_amount']; ?>
</td> 

   <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center"> 
                        
        <?php  echo  $pending_amount = $payment_data['total_amount']-$payment_data['p_amount'] ?>       
</td>  
       
       
 <?php if($_GET["open"]!='pending_pdf'){ ?>  
     <td class="verdanablack" style="text-align:center" >
   <a href="javascript:void(0);" onclick="javascript:getPrintBarList('<?php echo $hms_info_values_tax["bill_id"];?>','<?php echo $hms_info_values_tax["account_card_id"];?>','<?php echo $hms_info_values_tax["tabel_id"];?>',0);">
       View Bill</a>  
         (or)
   <a href="javascript:void(0);" onclick="javascript:getReopenList('<?php echo $hms_info_values_tax["bill_id"];?>','<?php echo $hms_info_values_tax["bill_status"];?>');">
       Edit Bill</a>     

     </td> 

 <?php  } ?> 
  </tr>
  
   <?php $sno++; }  ?>
   
  <tr>
              <?php if($_GET["action"]=='pending_print'){ ?>
   <td colspan="7" align="center" class="nonprintable" >
 <input name="btnPrint" type="button" id="btnPrint" class="submit"  value="Print" onClick="window.print();">
 &nbsp;&nbsp; <input name="btnclose" class="submit" onClick="window.close();" type="button" id="btnclose" value="Close" >
  </td>
              <?php  } ?>
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
    </body>
