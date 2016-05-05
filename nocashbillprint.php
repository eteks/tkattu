<?php session_start(); require_once ("includes/application_top.php");
$tabel=(isset($_GET['chairs']) && !empty($_GET['chairs']) ? $_GET['chairs']:"");
$accountsession=(isset($_GET['accountsession']) && !empty($_GET['accountsession']) ? $_GET['accountsession']:"");
$cardid=$_GET['card_id'];
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

$selectbillid = db_query("SELECT bill_id FROM ".TABLE_HMS_BILL_ID." ");
$fetch_billid = db_fetch_array($selectbillid);
$bill_id  = $fetch_billid['bill_id'];
$bill_id_session  = $accountsession.$fetch_billid['bill_id'];

db_query("Update ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET bill_id='".$bill_id_session."' WHERE  account_card_id=$cardid");
db_query("Update ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET bill_id='".$bill_id_session."' WHERE  order_cart_id='".$cardid."'");
db_query("Update ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." SET credit_bill_id='".$bill_id_session."' WHERE  credit_cart_id='".$cardid."'");
db_query("Update ".TABLE_HMS_PAYMENT_DETAIL." SET bill_no='".$bill_id_session."' WHERE  cart_id='".$cardid."'");
db_query("Update ".TABLE_HMS_TABLE_DETAILS." SET htd_bill_id='".$bill_id_session."' WHERE  htd_cart_id='".$cardid."'");
$lstbill_id = $bill_id+1;
db_query("Update ".TABLE_HMS_BILL_ID." SET bill_id=$lstbill_id");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head> 
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
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/printjquery.js"></script>
</head> 
    <body>
<script>
    $(document).ready(function($){
        $('#dinebill').on('click',function(){
          $('#dinelayout').printElement();  

         }); 
         $('#parcelbill').on('click',function(){
          $('#parcellayout').printElement();  

         });
    });
</script>    
<?php

$account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '$cardid' AND tabel_id ='".$chairslist."' $wherecon";
$account_bill_query = db_query($account_bill);
if(db_num_rows($account_bill_query)>0)
{       
$fetchbill = db_fetch_array($account_bill_query);
?>
<div class="print" id="dinelayout">
    
    <?php 
$student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active` FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
    $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
	$parameterEntry_values = db_fetch_array($student_user_sing_records);
?>

    <table width="900"   border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tdalign" >
      
  <tr >
    <td height="38"  colspan="14" align="center" valign="middle" bgcolor="" class="verdanabold">
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
       <tr>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="3" width="100%" align="center" style="font-weight: bold;font-size:40px;font-family:arial;">
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
                <table border="0" cellpadding="0" width="95%" style="margin-left:10px;margin-right:10px;font-size:40px;font-family:arial;" cellspacing="0">
                    <tr>
                        <td  align="left" valign="top" ><?php echo "BILL NO: ".$fetchbill['bill_id']."   ";?> </td><td align="right" valign="top" ><?php  echo '&nbsp;'.date("dS  M  Y h:i A")."   ";?> </td>
                    </tr>
                    <?php if(!empty($tablename)){?><tr><td height="5"></td></tr><tr>
                        <td  align="left" valign="top" ><?php echo "TABLE NO: ".$tablename ;?> </td><td align="right" valign="top" ><?php  echo "&nbsp;S/I : ".$supplier ; ?> </td>

                    </tr><?php }?>
                </table>
        </td></tr>
         <tr align="center">
         <td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td>
      </tr>
  <tr >
      <td align="center" valign="middle">
	<a href="javascript:void(0);" onClick="javascript:getPrintBARList('<?php echo trim($_POST["cartId"]);?>','<?php echo trim($_POST["date"]);?>');"></a> 
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2"  style="font-size:40px;font-family:arial;">
            <tr align="center" style="font-weight: bold;">
<td width="40%"   style="text-align:left;">Item</td>
<td width="3%"  >Qty.</td>
</tr>
     <tr align="center">
         <td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td>
      </tr>
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
		
		if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
            $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id IN ('".$acctdetails["table_entry_id"]."') ";
            $table_records = db_query ($hms_info_fetch_table_sql);
			$table  = db_fetch_array($table_records);		
		}
		$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
?>
            
      <tr align="right">
        <td  style="text-align:left;"><?php echo $acctdetails["order_product"]; if($acctdetails["parcel_status"]==1) echo ' (P)';?></td>
        <td  align="center"><?php echo $acctdetails["order_quantity"];?></td>
         
      </tr>
      
 <?php 
    $i++; 
    }?> 

      
       <tr  bgcolor="">          
         <td colspan="5" align="right" style="text-align:left;border-top: 4px dashed black;"></td>         
        </tr>
       <tr  bgcolor="">          
           <td colspan="5" align="center" ><b>No Cash Amount</b></td>         
        </tr>
       <tr  bgcolor="">          
         <td colspan="5" align="right" style="text-align:left;border-top: 4px dashed black;"></td>  
       </tr>

 <tr>
    <td colspan="8" align="center"></td>
  </tr>
      <?php  if($fetchbill['nocashcomments']!=''){?>
 <tr>
    <td colspan="8" align="left" style="font-size: 35px;" >NCAC - <?php  echo $fetchbill['nocashcomments'] ;?></td>
  </tr>
    <?php }?>           
    </table></td>
  </tr>
  
  <tr>
    <td valign="top">
          </tbody></td>
  </tr>
<tr style="text-align: center; font-size: 30px; font-weight: bold; padding-top: 33px;"><td>Thanking You ! Visit Again !</td></tr>
</table>
</div>

<br/><br/>  
<div style="text-align:center;width:320px;font-size: 30px;" class="submenu">
    <a href="#" id="dinebill">Print</a>&nbsp;&nbsp;<a href="javascript:void(0);" onClick="javascript:self.close();cls();">Close</a>
    
</div>
<br/><br/> 
<?php } 

$chkparcel =db_query("SELECT parcel_status FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' AND parcel_status=1");
	
if(db_num_rows($chkparcel)>0){
$account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '$cardid' AND tabel_id ='".$chairslist."' $wherecon";
$account_bill_query = db_query($account_bill);
if(db_num_rows($account_bill_query)>0)
{       
?>
<div class="print" id="parcellayout">
    
    <?php 
$student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active`  FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
    $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
	$parameterEntry_values = db_fetch_array($student_user_sing_records);
?>

  <table width="900"   border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tdalign"  >
     
  <tr >
    <td height="38"  colspan="14" align="center" valign="middle" bgcolor="" class="verdanabold">
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
       <tr>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="3" width="100%" align="center" style="font-weight: bold;font-size:40px;font-family:arial;">
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
                <table border="0" cellpadding="0" width="95%" style="margin-left:10px;margin-right:10px;font-size:40px;font-family:arial;" cellspacing="0">
                    <tr>
                        <td  align="left" valign="top" ><?php echo "BILL NO: ".$fetchbill['bill_id']."   ";?> </td><td align="right" valign="top" ><?php  echo '&nbsp;'.date("dS  M  Y h:i A")."   ";?> </td>
                    </tr>
                    <?php if(!empty($tablename)){?><tr><td height="5"></td></tr><tr>
                        <td  align="left" valign="top" ><?php echo "TABLE NO: ".$tablename ;?> </td><td align="right" valign="top" ><?php  echo "&nbsp;S/I : ".$supplier ; ?> </td>

                    </tr><?php }?>
                </table>
        </td></tr>
         <tr align="center">
         <td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td>
      </tr>
  <tr >
      <td align="center" valign="middle">
	<a href="javascript:void(0);" onClick="javascript:getPrintBARList('<?php echo trim($_POST["cartId"]);?>','<?php echo trim($_POST["date"]);?>');"></a> 
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" style="font-size:40px;font-family:arial;">
            <tr align="center" style="font-weight: bold;">
<td width="38%"   style="text-align:left;">Item</td>
<td width="3%"  >Qty.</td>

</tr>
      <tr align="center">
         <td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td>
      </tr>
      <?php
	//if(mysql_num_rows($order_query_result)>0) {
/*echo "<pre>";
print_R($_GET);
exit;*/
	  $totalamtt=0;	  
	 $acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' AND parcel_status=1 ";
	//exit;
        $acc_query_result = db_query($acc_query);
		$i = 1; 	
		while ($acctdetails  = db_fetch_array($acc_query_result)) {
		
		if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
            $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id IN ('".$acctdetails["table_entry_id"]."') ";
            $table_records = db_query ($hms_info_fetch_table_sql);
			$table  = db_fetch_array($table_records);		
		}
		$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
?>
            
      <tr align="right">
        <td  style="text-align:left;"><?php echo $acctdetails["order_product"];?></td>
                     <td  align="center"><?php echo $acctdetails["order_quantity"];?></td>
          
      </tr>
     
  <?php } ?>

       <tr  bgcolor="">          
         <td colspan="5" align="right" style="text-align:left;border-top: 4px dashed black;"></td>         
        </tr>
       <tr  bgcolor="">          
           <td colspan="5" align="center" ><b>No Cash Amount</b></td>         
        </tr>
       <tr  bgcolor="">          
         <td colspan="5" align="right" style="text-align:left;border-top: 4px dashed black;"></td>  
       </tr>
     


 <tr>
    <td colspan="8" align="center"></td>
  </tr>
<?php  if($fetchbill['nocashcomments']!=''){?>
 <tr>
    <td colspan="8" align="left" style="font-size:35px;">NCAC - <?php  echo $fetchbill['nocashcomments'] ;?></td>
  </tr>
    <?php }?>
    </table></td>
  </tr>
  
  <tr>
    <td valign="top">
          </tbody></td>
  </tr>
<tr style="text-align: center; font-size: 30px; font-weight: bold; padding-top: 33px;"><td>Thanking You ! Visit Again !</td></tr>
</table>
</div>

<br/><br/>  
<div style="text-align:center;width:320px;font-size: 30px;" class="submenu">
    <a href="#" id="parcelbill">Print</a>&nbsp;&nbsp;<a href="javascript:void(0);" onClick="javascript:self.close();cls();">Close</a>
    
</div>

<?php } 

}?>


</body>
    </html>
