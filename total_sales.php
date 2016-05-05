<?php require_once ("includes/application_top.php");
$_POST['ddDateFrom']= (isset($_POST['ddDateFrom']) && !empty($_POST['ddDateFrom']) ? $_POST['ddDateFrom']:"" );
$FromDate=$_POST['ddDateFrom'];
$_POST['ddDateTo']= (isset($_POST['ddDateTo']) && !empty($_POST['ddDateTo']) ? $_POST['ddDateTo']:"" );
$ToDate=$_POST['ddDateTo'];

$hms_info_obj = new barbill();
$action_1 = (isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action']:"" );
$action = (isset($action_1) ? $action_1 : $_GET["action"]);
switch ($action) {
    case "totalsales":
	if(isset($_POST['ddDateFrom']) && $_POST['ddDateFrom'] != "" ) { 
	  $order_query = "SELECT * FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE  orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status = 'close' ORDER BY bill_id ASC";	 
	}	 
$order_query_result = db_query($order_query);
    break;
}
?>



<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
<th width="950" align="center" valign="top" scope="col">
<table width="942" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
<tr>
<td height="39" colspan="6" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold">Total Sales Report</td>
</tr> 
<tr>
<th colspan="6"><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
				</tr>		
<tr class="site_font_black"> 

    <td class="verdanablack" align="right" style="width: 45%">From:</td> 
<td height="35" colspan="2" valign="middle" >
     <input name="ddDateFrom" id="ddDateFrom" class="inputCopy1" type="text" tabindex="19" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /> 
</td>
</tr> 
<tr class="site_font_black"> 
<td class="verdanablack" align="right">To:</td> 
<td height="35" colspan="2" valign="middle" >
  <input name="ddDateTo" id="ddDateTo" type="text" tabindex="20" class="inputCopy1" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateTo','%Y-%m-%d',24, true);" />
	</td>
</tr>
<tr> 
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td width="122" align="center"></td>
<td width="421" align="center"><a href="javascript:void(0);" Onclick="Javascript:gettotalsales('totalsales');" class="submenu" > Show</a></td>		
</tr>
<tr>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  </tr>
</table>
</td>
</tr>
<tr>
        <td align="center">&nbsp;</td>
</tr>
<tr>
<td  align="center">
    
 <?php $_POST["action"] = (isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action']:"" ); if ($_POST["action"]=="totalsales") { 
        
 $tax_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='close' ORDER BY bill_id ASC";  
//echo $tax_list_sqls;
$tax_list_recordss = db_query ($tax_list_sqls);                                                      
if(mysql_num_rows($tax_list_recordss)>0)
    {    
?>
    
<table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
<tr >
<td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold">
<p style="font-family: initial;font-size: 16px;color:#f20530;"><?php echo $_SESSION["hotelname"];?></p>
Total Sales Report Details</td>
</tr>
<tr>
<td align="right"></a></td>
</tr>
<tr>
<td align="center"><br />
    
	 
    
    <table border="0" width="1000" style="max-width: 1000px; overflow: scroll; "cellpadding="2" cellspacing="2" class="tableborder">
<tr align="center" bgcolor="#999999" class="site_font_black">
   
    <td  height="27" bgcolor="#cccccc" class="verdanablack" style="padding: 0 26px;">Date</td>
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
         <td  height="27" bgcolor="#cccccc" class="verdanablack">VAT</td>
        <td height="27" bgcolor="#cccccc" class="verdanablack">CST</td>
        <td  height="27" bgcolor="#cccccc" class="verdanablack"> Discount </td>
        <td  height="27" bgcolor="#cccccc" class="verdanablack">Net Amount</td>
</tr>


<tr align="center" bgcolor="#999999" class="site_font_black">
    
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




    
<tr>
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

    <td  height="27" width="200" bgcolor="#cccccc" align="right" class="verdanablack"> 
        
        <?php
        
               $date = explode('-',$hms_info_values_tax['orde_close_date']);   
		 echo $row1[3]=$date[2] . "-" . $date[1] . "-" . $date[0];       ?>  
    </td>
         <td height="27" bgcolor="#cccccc" align="right" class="verdanablack"> <?php echo $hms_info_values_tax['bill_id']; ?>   </td>
        <td height="27" bgcolor="#cccccc" align="right" class="verdanablack">   <?php echo $table_data['payment_method']; ?>  </td>

               
<?php 
  $select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");
  while($categ_list= db_fetch_array($select_itemcate))
  {
  $hms_menu_category_id = $categ_list['hms_menu_category_id'];

 $categ_value = "SELECT sum(order_amount) as categ_value FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND  category_id  = '$hms_menu_category_id' and bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	 
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
             <td  height="27" bgcolor="#cccccc" align="right" class="verdanablack"> <?php echo $sum_categ['categ_value']; ?>   </td>
             
               <td width="19%" height="27" align="right" bgcolor="#cccccc" class="verdanablack"><?php echo $vat_amount; ?>   </td> 
    
                        
  <?php } } ?>  
               
<?php 
$categ_v = "SELECT sum(vat_amount) as v_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
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

        <td height="27" bgcolor="#cccccc" align="right" class="verdanablack"> <?php echo round($acctdetails3['total']); ?>   </td>
        <td height="27" bgcolor="#cccccc" align="right" class="verdanablack"> <?php echo $vat_amount; ?>    </td>
        <td height="27" bgcolor="#cccccc" align="right" class="verdanablack"> <?php echo $service_amount; ?>  </td> 
        <td height="27" bgcolor="#cccccc" align="right" class="verdanablack">  <?php echo round($discount); ?>   </td>
        <td  height="27" bgcolor="#cccccc" align="right" class="verdanablack"> <?php echo round($net_amount); ?>   </td> 
  
</tr>
  <?php }  } ?>    

 <tr>
   <td colspan="30" align="center" class="nonprintable">       
 <input name="btnPrint" type="button" id="btnPrint" class="submit" value="Print" onClick="getsalesListView('<?php echo $FromDate; ?>','<?php echo $ToDate; ?>');">
 <form name="xls" id="xls" method="post" action="sales_reportxl.php">
    <input name="FromDate" type="hidden" id="FromDate" class="submit" value="<?php echo $FromDate; ?>">
     <input name="ToDate" type="hidden" id="ToDate" class="submit" value="<?php  echo $ToDate; ?>">
         
  <input name="submit" type="submit" id="submit" class="submit" value="XLS Export" >
  <a class="print_bg" href="salespdfprint.php?from=<?php echo $FromDate; ?>&to=<?php  echo $ToDate; ?>" style="width: 56px;" target="_blank">PDF Download</a></span>

 </form>
  </td>
   </tr>
    
<?php	
 $Purchase_total_amount = "SELECT sum(total_amount) as total_amount FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE  orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status = 'close'";  
$total_amount = db_query($Purchase_total_amount);
$Purchase_amount =db_fetch_array($total_amount);
?>		
				
<!--<tr><td colspan="12" align="center"><strong><font color="#FF0000">No Details Available</font></strong></td>	</tr>--> 
	
 </table> 

    <br />
  <p>&nbsp;</p>
 <div id="divbarbillview"></div>
  </td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody></table>
       <?php } ?>
</td>
</tr>

</table></th>
<th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
</tr>
<tr>
<th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
<td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
<th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
</tr>
</table>
