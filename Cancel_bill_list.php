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


<?php
$FromDate=$_GET['from'];
$ToDate=$_GET['to'];
 if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='1')
           $wherecon = " AND created_role_id='".$_SESSION["admin_role_mst_id"]."'";
$cancel_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='cancel' AND bill_status='cancel' $wherecon order by bill_id ASC"; 
//echo $cancel_list_sqls;
$cancel_list_recordss = db_query ($cancel_list_sqls);                                                      
if(mysql_num_rows($cancel_list_recordss)>0){     
    
?>

<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr >
    <td height="38" width="750"  colspan="8" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><?php echo (!empty($tax_method) ? $tax_method : ""); ?> 
<p style="font-size: 16px;color:#f20530;"><?php echo $_SESSION["hotelname"];?></p>
Cancel Bill List
</td>
</tr>

    <tr>   
        <th width="12%" style="text-align:center" align="center"> S.No  </th> 
    <th width="13%" style="text-align:center" align="center">Bill.No</th> 
    <th width="13%" style="text-align:center" align="center">Date</th> 
    <th width="13%" style="text-align:center" align="center">Value</th> 
    <th width="13%" style="text-align:center" align="center">VAT</th> 
    <th width="13%" style="text-align:center" align="center">CST</th>            
    <th width="8%" style="text-align:center" align="center">Total</th>
    <?php if($_GET["open"]!="cancel_pdf"){   
        ?>
    <th width="13%" style="text-align:center"> Action </th> 
<?php  } ?>
    </tr>
    
   <?php $sno=1;    
   while ($hms_info_values_tax = db_fetch_array($cancel_list_recordss)) {      

     $acc_query3 = "SELECT sum(order_amount) as total FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$acctdetails3 = db_fetch_array($acc_query_result3);   
          
         $acc_query3 = "SELECT sum(vat_amount) as vat FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$sum_vat = db_fetch_array($acc_query_result3);  
                
         $acc_query3 = "SELECT sum(service_amount) as ser FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$sum_ser = db_fetch_array($acc_query_result3);         
  ?> 
   <tr>	
 <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
 <?php echo $sno; ?></td>


  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
<?php if(strlen($hms_info_values_tax["bill_id"]) > 30) echo substr($hms_info_values_tax["bill_id"],0,28).".."; else echo $hms_info_values_tax["bill_id"]; ?></td>

  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
        <?php  //echo $hms_info_values_tax["orde_close_date"];
  $date = explode('-',$hms_info_values_tax["orde_close_date"]);
 echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?> 
</td>


<td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
     <?php if(strlen($acctdetails3["total"]) > 30) echo substr($acctdetails3["total"],0,28).".."; else echo $acctdetails3["total"]; ?>
</td>

   <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
       <?php if(strlen($sum_vat["vat"]) > 30) echo substr($sum_vat["vat"],0,28).".."; else echo $sum_vat["vat"]; ?>
</td>

 
 <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
 <?php if(strlen($sum_ser["ser"]) > 30) echo substr($sum_ser["ser"],0,28).".."; else echo $sum_ser["ser"]; ?>
 </td>

   <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" align="center">
     <?php  echo round($hms_info_values_tax["total_amount"]); ?>
</td>  
 <?php if($_GET["open"]!='cancel_pdf'){ ?>
     <td class="verdanablack" style="text-align:center" align="center">
   <a href="javascript:void(0);" onclick="javascript:getPrintBarList('<?php echo $hms_info_values_tax["bill_id"];?>','<?php echo $hms_info_values_tax["account_card_id"];?>','<?php echo $hms_info_values_tax["tabel_id"];?>',0);">
       View Bill</a>     
     </td> 
 <?php  } ?>
  </tr>
  
   <?php $sno++; }  ?>
   

           <tr>
              <?php if($_GET["action"]=='cancel_print'){ ?>
   <td colspan="7" align="center" class="nonprintable" align="center">
 <input name="btnPrint" type="button" id="btnPrint" class="submit"  value="Print" onClick="window.print();">
 &nbsp;&nbsp; <input name="btnclose" class="submit" onClick="window.close();" type="button" id="btnclose" value="Close" >
  </td>
              <?php  } ?>
         </tr>
         <tr>
              <?php if($_GET["open"]!='cancel_pdf'){ ?>
   <td colspan="7" align="center" class="nonprintable">
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
	<tr><td colspan="12" align="center"><strong><font color="#FF0000">No Details Available</font></strong></td>
	</tr>
	</table>
	<?
	}
 ?>     
    </table>
    </body>
</html>