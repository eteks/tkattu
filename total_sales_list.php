<?php require_once ("includes/application_top.php");

$FromDate=$_GET['from'];
$ToDate=$_GET['to'];

$hms_info_obj = new barbill();

$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);
switch ($action) {
    case "totalsales":
	if(isset($_POST['ddDateFrom']) && $_POST['ddDateFrom'] != "" ) { 
	  $order_query = "SELECT * FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE  orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status = 'close' ORDER BY bill_id ASC";	 
	}	 
$order_query_result = db_query($order_query);
    break;
}
?>
<style>  
    @media print { .ScreenOnly { display: none; size:auto;margin: 0mm;  } }
    @media screen { .PrintOnly { display: none; background-color:#5DA6EA;size:auto;margin: 0mm; }
    .TabContentHidden { display: none; visibility: hidden; } }
	
	.blackbold{ font-family:Tahoma, Helvetica, sans-serif; font-size:14px; }
</style>

<?php 

$tax_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='close' order by bill_id ASC"; 
//echo $tax_list_sqls;
$tax_list_recordss = db_query ($tax_list_sqls);                                                      
if(mysql_num_rows($tax_list_recordss)>0)
    {
    
?>
<div class="print"> 
    <table border="1" width="1000" style="max-width: 1000px; overflow: scroll; "cellpadding="1" cellspacing="0" class="tableborder">
<tr align="center" bgcolor="#999999" class="site_font_black">
   
 <td  height="27" bgcolor="#cccccc" class="verdanablack" style="padding: 0 24px;">Date</td>
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


<tr align="center" bgcolor="#999999" class="site_font_black">
    
     <td  height="27" bgcolor="#cccccc" class="verdanablack" > </td>
  <td height="27" bgcolor="#cccccc" class="verdanablack" > </td>
   <td  height="27" bgcolor="#cccccc" class="verdanablack" > </td>

   <?php
  $select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");
  while($categ_list= db_fetch_array($select_itemcate))
  {
 ?>
<td height="27" bgcolor="#cccccc" class="verdanablack" aligh> VALUES</td>
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

    <td  height="27" class="verdanablack" align="right">

<?php  //echo $hms_info_values_tax["orde_close_date"];
  $date = explode('-',$hms_info_values_tax['orde_close_date']);
 echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?> 
    
    </td>
         <td height="27" class="verdanablack" align="right"> <?php echo $hms_info_values_tax['bill_id']; ?>   </td>
        <td height="27" class="verdanablack" align="right">   <?php echo $table_data['payment_method']; ?>  </td>

               
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
             <td  height="27" class="verdanablack" align="right"> <?php echo $sum_categ['categ_value']; ?>   </td>
             
               <td width="19%" height="27" class="verdanablack" align="right"><?php echo $vat_amount; ?>   </td> 
    
                        
  <?php } } ?>  
               
   <?php 
    $categ_v = "SELECT sum(vat_amount) as v_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  itemcancel=0 AND bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_v_amt = db_query($categ_v);
$sum_categ_v = db_fetch_array($categ_v_amt); 
$vat_amount = $sum_categ_v['v_amt'];

 $categ_s = "SELECT sum(service_amount) as s_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND  bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
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

        <td height="27" class="verdanablack" align="right"> <?php echo round($acctdetails3['total']); ?>   </td>
        <td height="27" class="verdanablack" align="right"> <?php echo $vat_amount; ?>    </td>
        <td height="27"  class="verdanablack" align="right"> <?php echo $service_amount; ?>  </td> 
        <td height="27"  class="verdanablack" align="right">  <?php echo round($discount); ?>   </td>
        <td  height="27"  class="verdanablack" align="right"> <?php echo round($net_amount); ?>   </td> 
  
</tr> 
  <?php }  } ?>  




           
                
<?php	
 $Purchase_total_amount = "SELECT sum(total_amount) as total_amount FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE  orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status = 'close'";  
$total_amount = db_query($Purchase_total_amount);
$Purchase_amount =db_fetch_array($total_amount);
?>		
				
<!--<tr><td colspan="12" align="center"><strong><font color="#FF0000">No Details Available</font></strong></td>	</tr>-->
   
	
 </table> </div>
    
<div class="ScreenOnly"> 

     <div class="submenu" style="float:left; margin-left:250px;">
        <a href="javascript:void(0);"  onClick="javascript:window.print();">Print</a></div>
    
    <div style="float:left; width:38px">&nbsp;</div><div class="submenu" style="float:left">
          <a href="javascript:void(0);" onClick="javascript:self.close();cls();">Close</a></div>

</div>
    <br />
  <p>&nbsp;</p>
 <div id="divbarbillview"></div>
  </td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody></table>
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
