<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();

?>
<style>
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


<?php
$purchase_order_id="SELECT Po_id  FROM " . TABLE_HMS_PURCHASE_ORDER_ID. "" ;
$purchase_order_id_records = db_query ($purchase_order_id);
$hms_pur_order_id_values = db_fetch_array($purchase_order_id_records);
$Po_id = $hms_pur_order_id_values["Po_id"];

$cart_id=$_POST['cart_id'];
$po_id_in = $Po_id+1;

$purchase_order_sqls =  "UPDATE  " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " SET status='1', pur_fck_id='$Po_id' where cart_id = '$cart_id' ";
$result1=  DB_query($purchase_order_sqls);

$purchase_order_id_sql =  "UPDATE  " . TABLE_HMS_PURCHASE_ORDER_ID. " SET Po_id='$po_id_in' ";
$result2=db_query($purchase_order_id_sql);		
	

		?>
      
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
 </tr>
                
                <td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D6EB99" class="verdanabold"> Purchase Order Entered Successfully</td>
                </tr>
  
    </table>
    
