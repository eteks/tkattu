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

$tax_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='close' order by bill_id ASC";  
//echo $tax_list_sqls;
$tax_list_recordss = db_query ($tax_list_sqls);                                                      
if(mysql_num_rows($tax_list_recordss)>0)
    {    
?>
    
     <table border="0" width="900" style="max-width: 900px; overflow: scroll;" cellpadding="1" cellspacing="1" class="tableborder">
         <tr align="center" bgcolor="#999999" class="site_font_black" style="font-size: 8px;">
   
 <td  height="27" bgcolor="#cccccc" class="verdanablack" >Date</td>
  <td  height="27" bgcolor="#cccccc" class="verdanablack" >Bill No</td>
   <td  height="27" bgcolor="#cccccc" class="verdanablack" >Party</td>
   
 <?php
  $select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");

  while($categ_list= db_fetch_array($select_itemcate))
  {
      $hms_menu_category_id = $categ_list['hms_menu_category_id'];
      $hms_menu_category_name = $categ_list['hms_menu_category_name'];

      ?>
        
        <td  height="27" bgcolor="#cccccc" class="verdanablack" colspan="2"><?php echo $hms_menu_category_name; ?></td>
        <?php
  }
?>
        <td  height="27" bgcolor="#cccccc" class="verdanablack">Total</td>
         <td  height="27" bgcolor="#cccccc" class="verdanablack">Vat Tax</td>
        <td height="27" bgcolor="#cccccc" class="verdanablack">Service Tax</td>
        <td  height="27" bgcolor="#cccccc" class="verdanablack"> Discount </td>
        <td  height="27" bgcolor="#cccccc" class="verdanablack">Net Amount</td>
</tr>


       <tr align="center" bgcolor="#999999" class="site_font_black" style="font-size: 8px;">
    
     <td  height="27" bgcolor="#cccccc" class="verdanablack" > </td>
  <td height="27" bgcolor="#cccccc" class="verdanablack" > </td>
   <td  height="27" bgcolor="#cccccc" class="verdanablack" > </td>

   <?php
  $select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");
  while($categ_list= db_fetch_array($select_itemcate))
  {
 ?>
<td height="27" bgcolor="#cccccc" class="verdanablack"> VALUES</td>
   <td height="27" bgcolor="#cccccc" class="verdanablack">TAX</td>
           
   <?php  }  ?>
           
        <td height="27" bgcolor="#cccccc" class="verdanablack">    </td>
         <td height="27" bgcolor="#cccccc" class="verdanablack">    </td>
        <td height="27" bgcolor="#cccccc" class="verdanablack">     </td>
        <td height="27" bgcolor="#cccccc" class="verdanablack">    </td> 
               <td height="27" bgcolor="#cccccc" class="verdanablack">    </td> 
 
  
</tr>



  <?php $sno=1; 
   
   while ($hms_info_values_tax = db_fetch_array($tax_list_recordss)) { 
      
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
?>	
         <tr style="font-size: 8px;">

    <td  height="27"  bgcolor="#cccccc" class="verdanablack">

 <?php
        
           $date = explode('-',$hms_info_values_tax['orde_close_date']);
             echo   $row1[3] = $date[2] . "-" . $date[1] . "-" . $date[0];
     ?>  
    
    
    </td>
         <td height="27" bgcolor="#cccccc" class="verdanablack"> <?php echo $hms_info_values_tax['bill_id']; ?>   </td>
        <td height="27" bgcolor="#cccccc" class="verdanablack">   <?php echo $table_data['payment_method']; ?>  </td>

               
<?php 
  $select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");
  while($categ_list= db_fetch_array($select_itemcate))
  {
  $hms_menu_category_id = $categ_list['hms_menu_category_id'];

 $categ_value = "SELECT sum(order_price) as categ_value FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND category_id  = '$hms_menu_category_id' and bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	 
$categ_v = db_query($categ_value);
  if($sum_categ = db_fetch_array($categ_v))
  {
      
 $categ_v = "SELECT sum(vat_amount) as v_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND  category_id  = '$hms_menu_category_id' and bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_v_amt = db_query($categ_v);
$sum_categ_v = db_fetch_array($categ_v_amt); 
$vat_amount = $sum_categ_v['v_amt'];

 $categ_s = "SELECT sum(service_amount) as s_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND category_id  = '$hms_menu_category_id' and bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_s_amt = db_query($categ_s);
$sum_categ_s = db_fetch_array($categ_s_amt); 
$service_amount = $sum_categ_s['s_amt'];

?> 
             <td  height="27" bgcolor="#cccccc" class="verdanablack"> <?php echo $sum_categ['categ_value']; ?>   </td>
             
               <td width="19%" height="27" bgcolor="#cccccc" class="verdanablack"><?php echo $vat_amount; ?>   </td> 
    
                        
  <?php } } ?>  
               
               
   <?php 
    $categ_v = "SELECT sum(vat_amount) as v_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_v_amt = db_query($categ_v);
$sum_categ_v = db_fetch_array($categ_v_amt); 
$vat_amount = $sum_categ_v['v_amt'];

 $categ_s = "SELECT sum(service_amount) as s_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_s_amt = db_query($categ_s);
$sum_categ_s = db_fetch_array($categ_s_amt); 
$service_amount = $sum_categ_s['s_amt'];
   
$tax_amount = $vat_amount+$service_amount;

$netamount =$acctdetails3['total']+$tax_amount;


$disc = $hms_info_values_tax['discount'];
if($disc !="")
{
    $discount= $netamount*$disc/100;
}
else { $discount="0"; }

$net_amount = $netamount-round($discount);

   ?>

        <td height="27" bgcolor="#cccccc" class="verdanablack"> <?php echo round($acctdetails3['total']); ?>   </td>
        <td height="27" bgcolor="#cccccc" class="verdanablack"> <?php echo $vat_amount; ?>    </td>
        <td height="27" bgcolor="#cccccc" class="verdanablack"> <?php echo $service_amount; ?>  </td> 
        <td height="27" bgcolor="#cccccc" class="verdanablack">  <?php echo round($discount); ?>   </td>
        <td  height="27" bgcolor="#cccccc" class="verdanablack"> <?php echo round($net_amount); ?>   </td> 
        
        </tr>
    <?php }  } ?>   

 
 
  </table> 
    


    </body>
</html>
