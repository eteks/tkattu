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
$Pur_id=$_POST['Pur_id'];
$purchase_order_delete_all = "DELETE from  " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where status ='0' ";
$result=mysql_query($purchase_order_delete_all);
if($result>0)
{
?>

<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr>
          <th width="12%" style="text-align:center" >S.No</th>
      <th width="12%" style="text-align:center" >Bill.No</th>
         <th width="12%" style="text-align:center" >Vendor Name</th>
         <th width="11%" style="text-align:center" >Item  Name</th>
		  <th width="12%" style="text-align:center" >Item Type </th>
            <th width="9%" style="text-align:center" >Price</th>
		    <th width="12%" style="text-align:center" >Quantity</th>
             <th width="11%" style="text-align:center" >Tax%</th>
            <th width="11%" style="text-align:center" >Pur.Tax%</th>
          <th width="11%" style="text-align:center" >Discount%</th>
             <th width="14%" style="text-align:center" >Total Amount </th>
             <th width="10%" style="text-align:center" >Remove</th>
         
</tr>
    
    <tr>
        <td height="30" colspan="12"></td>
     </tr>    
     
</table>
		
<?php  } ?>
