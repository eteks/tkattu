<?php session_start();
require_once("includes/application_top.php");
$tabel=(isset($_GET['table_id']) && !empty($_GET['table_id']) ? str_replace("undefined,","",$_GET['table_id']):"");
$cardid=$_GET['card_id'];
$billid=$_GET['billId'];
$tbldtls = explode(',',$tabel);
foreach($tbldtls as $tbldtlsdata)
{
  $tbldtlsplit = explode('_',$tbldtlsdata);
  $dtml = (!empty($chairslist) ? ',':'');  
  $chairslist .= $dtml.$tbldtlsplit[0];
}
$tablename    = $chairslist;
$hms_info_obj = new restaurantbill();
if(!empty($cardid))
{
$htd_info  = $hms_info_obj->gettabledetails($cardid);
$fetch = db_fetch_array($htd_info); 
$supplier = getsuppliername($fetch['htd_supplier_id']);
}
$account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '$cardid' AND tabel_id ='".$chairslist."'";
$account_bill_query = db_query($account_bill);
$account_bill_data = db_fetch_array($account_bill_query);
?><head> 
<style> 
    @media print { .ScreenOnly { display: none; size:auto;margin: 0mm;  } }
    @media screen { .PrintOnly { display: none; background-color:#5DA6EA;size:auto;margin: 0mm; }
    .TabContentHidden { display: none; visibility: hidden; } }
	
         .tdalign tr td{
        padding-left:5px;
        padding-right:5px;
      
        } 
</style>
<title>Junior Thalapakattu Biryani</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem( 'firstLoad' ) )
    {
      localStorage[ 'firstLoad' ] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem( 'firstLoad' );
  }
})();

</script>
</head> 
<body>
    

<div class="print"  onload="window.location.reload()">
    <?php 
$student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active` FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
    $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
	$parameterEntry_values = db_fetch_array($student_user_sing_records);$date = explode('-',$account_bill_data["orde_close_date"]);
?>
<table width="900"   border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tdalign">
     
  <tr >
    <td height="38"  colspan="14" align="center" valign="middle" bgcolor="" class="verdanabold">
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
       <tr>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="3" width="100%" align="center" style="font-weight: bold;font-family: arial;font-size:40px;">
            <tr>
              <td align="center" colspan="2"  style="font-size:50px;"><?php echo stripslashes($parameterEntry_values["hms_hotel_name"]);?>                </td>
            </tr>
            <tr>
              <td align="center" colspan="2"  ><?php echo stripslashes($parameterEntry_values["hms_address1"]);?>,<?php echo stripslashes( $parameterEntry_values["hms_address2"]);?>, </td>
            </tr>
            <tr>
              <td align="center"  ><?php echo stripslashes( $parameterEntry_values["hms_city"]);?>,<?php echo stripslashes( $parameterEntry_values["hms_state"]);?>-<?php echo stripslashes( $parameterEntry_values["hms_pincode"]);?></td>
            </tr>
               <tr>
                   <td align="center"  >
<span align="left" colspan="2"  >Ph.NO : <?php echo stripslashes( $parameterEntry_values["hms_phone_no"]);?>&nbsp;&nbsp;</span><?php if($parameterEntry_values["hms_tin_no"]!=''){?><span align="left" >TIN.NO : <?php echo stripslashes($parameterEntry_values["hms_tin_no"]); ?>&nbsp;&nbsp;</span><?php } if($parameterEntry_values["hms_stc"]!=''){?><span align="left" >STC : <?php echo stripslashes($parameterEntry_values["hms_stc"]);?></span><?php }?>
                   </td>
               </tr>      
                
        </table></td>
      </tr>
    </table></td>
  </tr>
        <tr><td>
                <table border="0" cellpadding="0" width="95%" style="margin-left:10px;margin-right:10px;font-family: arial;font-size:40px;" cellspacing="0">
                    <tr>
                        <td  align="left" valign="top" ><?php echo "BILL NO: ".$billid."   ";?> </td><td align="right" valign="top" ><?php  echo '&nbsp;'.date("dS  M  Y h:i A")."   ";?> </td>
                    </tr>
                    <?php if(!empty($tablename)){?><tr><td height="5"></td></tr><tr>
                        <td  align="left" valign="top" ><?php echo "TABLE NO: ".$tablename ;?> </td><td align="right" valign="top" ><?php  echo "&nbsp;S/I : ".$supplier ; ?> </td>

                    </tr><?php }?>
                </table>
        </td></tr>
  <tr style="font-size:40px !important;font-family: arial !important;">
    <td align="center" valign="top">
	<a href="javascript:void(0);" onClick="javascript:getPrintBARList('<?php echo trim($_POST["cartId"]);?>','<?php echo trim($_POST["date"]);?>');"></a>
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" style="font-family: arial;font-size:40px;">
            <tr align="center">
         <td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td>
      </tr>
            <tr align="center" style="font-weight: bold;">
<td width="38%"   style="text-align:left;">Item</td>
<td width="10%"   >Rate</td>
<td width="3%"  >Qty.</td>
<td width="8%" height="27" >Amt</td>
<td width="8%" height="27" >Total</td>
</tr>
      <tr align="center">
          <td width="38%" colspan="5" style="text-align:left;border-top: 4px dashed black;" valign="top" height="1"> 
          </td>
      <?php
	//if(mysql_num_rows($order_query_result)>0) {
/*echo "<pre>";
print_R($_GET);
exit;*/
	  	  
		 $acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' ";
		//exit;
		
        $acc_query_result = db_query($acc_query);
		$i = 1; 	
		while ($acctdetails  = db_fetch_array($acc_query_result)) {
		$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
		
?>
      <tr align="right">
       
        <td  style="text-align:left;"><?php echo $acctdetails["order_product"];?></td>
           <td  style="text-align:right;"><?php echo $acctdetails["order_price"];?></td>
        <td  align="center"><?php echo $acctdetails["order_quantity"];?></td>
          <td  style="text-align:right;"><?php 
		$amt=$acctdetails["order_price"]*$acctdetails["order_quantity"];  
        //$incl_tax=$amt * ($acctdetails['incl_tax']/100.0); 
        $net_total_price= $amt; 
		echo $net_total_price; 
		?> </td> 
  <td ><?php echo $acctdetails["order_total_price"];?></td>
      </tr>
      
 <?php 
    $i++; 
    } 
    $acc_query3 = "SELECT vat_amount,service_amount,order_amount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id='$cardid' AND table_entry_id ='".$chairslist."' ";	
     $acc_query_result3 = db_query($acc_query3);
    while($acctdetails3=db_fetch_array($acc_query_result3))
   {
    $netamountt += ($acctdetails3['vat_amount']+$acctdetails3['service_amount']+$acctdetails3['order_amount']);
   }
?>

 <tr> 
     
 <?php
$acc_disc = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
  $acc_disc1 = db_query($acc_disc);
  while($acc_disc2 = db_fetch_array( $acc_disc1)){ 
     // echo $acc_disc2['discount'];
  $discount1=roundoff($netamountt)*($acc_disc2['discount']/100);	
  }
	
$acc_query2 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
  $acc_query_result2 = db_query($acc_query2);
  $acctdetails2 = db_fetch_array($acc_query_result2); 
	?>
     <tr align="center" >
 <td  colspan="4" style="text-align:right;">
     <span style="font-weight:bold;">Total&nbsp;&nbsp;:<?php echo " "; ?> </span><br />            </td>
<td  style="text-align:right;"> 

<?php  echo number_format((float)roundoff($netamountt)-$discount1, 2, '.', '');
 // echo $acc_disc2['discount']; ?> 

            </td>
          </tr>	
 
 <?php	
$acc_query4 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
  $acc_query_result4 = db_query($acc_query4);
  $acctdetails4 = db_fetch_array($acc_query_result4); 
	if($acctdetails4['discount']!="0.00"){  
	?>
   
          <tr align="center" >
<td  colspan="4" style="text-align:right;">
Discount&nbsp;<?php echo $acctdetails4["discount"]; ?>(%):<?php echo " "; ?><br />
</td>

<td  style="text-align:right;">
<?php $total=$acctdetails2['total_amount']*($acctdetails4['discount']/100.0); 
         echo  $total.'.00';
?> 
</td>
     </tr>
     
  <?php } ?>
     
     <tr height='20' bgcolor=""  >
         <th width="65%" align="left" colspan="2" >  Tax Details </th>                
              <th  width="10%">  Value  </th>              
               <th width="10%">   Tax   </th>              
               <th width="15%">  Total  </th>  
          </tr>        
          
  <?php          
   $menu_t = db_query("SELECT  sum(vat_amount) as vat_amt, vat_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' group by vat_tax"); 
   while ($table_T = db_fetch_array($menu_t))
  {        
 
    $hms_info_fetch_tax_vat = "SELECT sum(order_price) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' AND vat_tax='".$table_T['vat_tax']."'";
   // echo $hms_info_fetch_tax_vat;
    $menu_records_v_tax = db_query ($hms_info_fetch_tax_vat);
    while ($menu_categ_v_tax = db_fetch_array($menu_records_v_tax))
    {
?>
     <tr align="center" >
 <td   style="text-align:left;" colspan="2" >
      VAT <?php  echo $table_T['vat_tax']; ?>% <br />
            </td>
     
                  
  <td align="right"  > 
       <?php              
        $v_tax_amt =$menu_categ_v_tax['price_value'];        
       echo $v_tax_amt;
        ?>                   
     </td>  
              
 <td align="right"  > 
            <?php       
            $v_tax=$table_T['vat_amt'];            
            echo $v_tax;            
            ?>
   </td> 
         
   
<td align="right"  >                  
  <?php 
$total_v= $v_tax_amt+$v_tax;             
echo $total_v;
?>
</td> 
          </tr>	          
          
         <?php  } } ?>        
   
    
          
   
  <?php          
   $menu_s = db_query("SELECT  service_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND  table_entry_id='".$chairslist."' AND order_cart_id='$cardid' group by service_tax");
   while ($table_s = db_fetch_array($menu_s))
  {       
 
    $hms_info_fetch_tax_ser = "SELECT sum(order_amount) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND  table_entry_id='".$chairslist."' AND order_cart_id='$cardid'  AND service_tax='".$table_s['service_tax']."'";
   // echo $hms_info_fetch_tax_vat;
    $menu_records_s_tax = db_query ($hms_info_fetch_tax_ser);
    while ($menu_categ_s_tax = db_fetch_array($menu_records_s_tax))
    {
?>
     <tr align="center">
 <td   style="text-align:left;" colspan="2" >
      CST <?php  echo $table_s['service_tax']; ?>% 
      (<?php              
        $s_tax_amt =$menu_categ_s_tax['price_value'];        
        echo $s_tax_amt;
        ?>)
            </td>
            
<td align="right" > 
                    <?php echo "0.00"; ?>                  
     </td>  
              
 <td align="right" > 
            <?php       
            $s_tax=$s_tax_amt*($table_s['service_tax']/100.0);            
            echo $s_tax;            
            ?>
   </td> 
         
   
<td align="right" >                  
  <?php 
$total_s=$s_tax;             
echo $total_s;
?>
</td> 
          </tr>	          
          
         <?php  } } ?>         
          
      <tr  bgcolor="">          
         <td colspan="5" align="right" style="text-align:left;border-top: 4px dashed black;"></td>         
        </tr>
          <tr align="center" style="font-weight: bold;">          
              <td  colspan="12" align="right" style="padding-right:0px;">NET AMOUNT : <?php  echo roundoff(roundoff($netamountt)-$discount1); ?></td>   
          </tr>	
        <tr  bgcolor="">          
         <td colspan="5" align="right" style="text-align:left;border-top: 4px dashed black;"></td>         
        </tr>
           

 <?php
   $acc_pay = "SELECT * FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE cart_id	='$cardid' AND table_id ='".$chairslist."' order by id desc";	
 $acc_pay_result = db_query($acc_pay);
	if($acctdetailsresult = db_fetch_array($acc_pay_result))  { 
?>
          
 <tr align="center">
     <td  align="left" colspan="3" > Payment Mode: 
 <?php
echo $acctdetailsresult['payment_method']; 
?></td>	

</tr>   
<?php  } ?>
      
   
    <?php  
 $pending_bill= db_query("SELECT name,paid_date,total_amount,paid_amount, sum(paid_amount) as p_amount  FROM ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." where credit_bill_id='$billid'"); 
if($pending = db_fetch_array($pending_bill))
{    
 $t_paid_amount=$pending['p_amount'];   
 $pending_amount = $pending['total_amount']-$t_paid_amount; 
}

 $pending_bill_sqls= db_query("SELECT *  FROM ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." where credit_bill_id='$billid'"); 
 while($pending_list = db_fetch_array($pending_bill_sqls))
 {
$date = explode('-',$pending_list["paid_date"]); 
$paid_amount=$pending_list['paid_amount']; 
    
 ?>  
        <tr> 
 
    <td   colspan="12" align='right' >

      <?php echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?>  Paid Amount :  <?php echo number_format((float)$paid_amount, 2, '.', '');?>
    </td>      
    </tr>
      
<?php  }  ?> 

       <tr>            
    <td   colspan="12"  align='right' style="text-align: right; padding-right:80px; padding-top: 10px;" >
       Pending Amount :  <?php echo number_format((float)$pending_amount, 2, '.', '');?>
    <input type="hidden" name="balance_amt" id="balance_amt" value="<?php echo $pending_amount; ?> ">
    </td>      
    </tr>
    <?php if($acctdetails4['cancelcomments']!=''){?>
 <tr>
    <td colspan="8" align="left" style="font-size:30px;">CBC - <?php  echo $acctdetails4['cancelcomments'] ;?></td>
  </tr>
    <?php }  
    else if($acctdetails4['nocashcomments']!=''){?>
 <tr>
    <td colspan="8" align="left" style="font-size:30px;">NCAC - <?php  echo $acctdetails4['nocashcomments'] ;?></td>
  </tr>
    <?php }?>  
 <tr>
    <td colspan="8" align="center"></td>
  </tr>
    </table></td>
  </tr>
  <tr style="text-align: center; font-size: 30px; font-weight: bold; padding-top: 33px;"><td>Thanking You ! Visit Again !</td></tr>
  <tr>
    <td valign="top">
          </tbody></td>
  </tr>

</table>
</div>
<br/><br/> <div class="ScreenOnly">
      
   <div style="text-align:center;width:320px;font-size: 30px;" class="submenu">
  <a href="javascript:void(0);"  onClick="javascript:window.print();">Print</a>&nbsp;<a href="javascript:void(0);" onClick="javascript:self.close();cls();">Close</a></div>
</div> 
   
</div>
</body> 