<?php 
session_start();
require_once ("includes/application_top.php");

$tableno   = (isset($_REQUEST['tableno']) && !empty($_REQUEST['tableno']) ? trim(str_replace("undefined,","",$_REQUEST['tableno'])):"");
$ordertype = (isset($_REQUEST['ordertype']) && !empty($_REQUEST['ordertype']) ? trim($_REQUEST['ordertype']):"");
$chkitems = (isset($_REQUEST['chkitems']) && !empty($_REQUEST['chkitems']) ? trim($_REQUEST['chkitems']):"");
$cartid    = (isset($_REQUEST['cartid']) && !empty($_REQUEST['cartid']) ? trim($_REQUEST['cartid']):"");
$action    = (isset($_REQUEST['action']) && !empty($_REQUEST['action']) ? trim($_REQUEST['action']):"");
$datetime  = date("dS  M  Y h:i A");
$chairs=(isset($_REQUEST['chairs']) && !empty($_REQUEST['chairs']) ? $_REQUEST['chairs']:"");

$tbldtls = explode(',',$chairs);
foreach($tbldtls as $tbldtlsdata)
{
  $tbldtlsplit = explode('_',$tbldtlsdata);
  $dtml = (!empty($chairslist) ? ',':'');  
  $chairslist .= $dtml.$tbldtlsplit[0];
}

$tablename    = $chairslist;
$hms_info_obj = new restaurantbill();
if(!empty($chairslist))
{
$htd_info  = $hms_info_obj->gettabledetails($cartid);
$fetch = db_fetch_array($htd_info); 
$supplier = getsuppliername($fetch['htd_supplier_id']);
}

$sel_parameter  = "SELECT hms_hotel_name FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
$rows_parameter = db_query ($sel_parameter);
$fet_parameter  = db_fetch_array($rows_parameter);



if($action=='cancelitem')
{
$orderid = explode(',',$chkitems);
foreach($orderid as $orderidval)
{
  $innerselect  = "SELECT order_quantity,bill_id,order_cart_id,last_cancel_quantity,order_id,menuid,depart_id,parcel_status FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id = '$orderidval' ";
  $innerrows    = db_query($innerselect); 
  $innerfetch   = db_fetch_array($innerrows);
  if($innerfetch['last_cancel_quantity']!=0)
  $finalqty     = -$innerfetch['last_cancel_quantity']; 
  else
  $finalqty     = -$innerfetch['order_quantity'];
  
  db_query("INSERT INTO hms_order_qty_flow SET bill_id='".$innerfetch['bill_id']."',itemcancel='".$innerfetch['itemcancel']."',last_cancel_quantity='".$innerfetch['itemcancel']."',depart_id='".$innerfetch['depart_id']."',order_cart_id='".$innerfetch['order_cart_id']."', menuid='".$innerfetch['menuid']."',order_id='".$innerfetch['order_id']."', order_quantity='".$finalqty."', cancel_status=1, parcel_status='".$fetch['parcel_status']."'");
  db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET last_cancel_quantity=0 WHERE order_id='$orderidval' ");
  
}

$wherecon = " AND cancel_status=1 AND depart_status=0";
}
else if($action=='deptbill')
{
$select  ="SELECT order_id,order_quantity,bill_id,order_cart_id,last_cancel_quantity,depart_id,menuid, parcel_status FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE  order_cart_id = '$cartid' ";
$rows = db_query($select);
while($fetch = db_fetch_array($rows))
{
  $innerselect  = "SELECT sum(order_quantity) as totqty FROM hms_order_qty_flow WHERE  order_id = '".$fetch['order_id']."' group by menuid";
  $innerrows    = db_query($innerselect); 
  $innerfetch   = db_fetch_array($innerrows);
  if(db_num_rows($innerrows)>0)
  $finalqty     = abs($innerfetch['totqty']-$fetch['order_quantity']);
  else
  $finalqty     = $fetch['order_quantity'];  
  if($finalqty!=0 && $innerfetch['totqty']!=$fetch['order_quantity'])
  db_query("INSERT INTO hms_order_qty_flow SET bill_id='".$fetch['bill_id']."',itemcancel='".$fetch['itemcancel']."',last_cancel_quantity='".$fetch['itemcancel']."',depart_id='".$fetch['depart_id']."',order_cart_id='".$fetch['order_cart_id']."', menuid='".$fetch['menuid']."',order_id='".$fetch['order_id']."', order_quantity='".$finalqty."', parcel_status='".$fetch['parcel_status']."'");
}
$wherecon = " AND itemcancel=0 AND depart_status=0";
}


//KOT
$sel_separatebill  ="SELECT order_id,sum(order_quantity) as order_quantity,bill_id,order_cart_id,last_cancel_quantity, parcel_status,menuid FROM hms_order_qty_flow WHERE depart_id=1 $wherecon AND order_cart_id = '$cartid' group by menuid";
$rows_separatebill = db_query($sel_separatebill);
if(db_num_rows($rows_separatebill)>0)
{?>
  
<table cellpadding="0" cellspacing="0" border="0" width="100" id="kotbill" bgcolor="#fff" style="font-family: arial;font-size:17px;">
    <tr>
        <td align="center" style="font-weight:bold;font-size:20px;"><?php echo $fet_parameter['hms_hotel_name'] ;?></td>
    </tr><br />
    <tr><td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td></tr>
    <tr>
        <td ><?php if($ordertype=='dine'){ echo '<b>T.No: </b>'.$tablename ; } ?></td>
    </tr>
    <tr>
       <td ><?php echo '<b>D/T: </b>'.$datetime ;?></td>
    </tr>
    <?php if($ordertype=='dine'){?>
     <tr>
       <td ><?php echo '<b>S/I: </b>'.$supplier.' <b>Dept: </b>KOT' ;?></td>
    </tr>
    <?php }?>
    <tr><td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td></tr>
    <tr><td>
        <table cellpadding="0" cellspacing="0" border="0" style="font-family: arial;font-size:17px;">
            <tr><td style="font-weight:bold;" >Item</td><td style="font-weight:bold;">Qty</td></tr>
            <?php while($fet_separatebill = db_fetch_array($rows_separatebill)){
               
                
                $totqty += $fet_separatebill['order_quantity'];
       
                $cartid   = $fet_separatebill['order_cart_id'];?>
            <tr><td ><?php echo menuname($fet_separatebill['menuid']); if($fet_separatebill['parcel_status']==1) echo "<span class='pred'>(P)</span>";?></td><td ><?php echo $fet_separatebill['order_quantity'];?></td></tr>
            <?php }?>
        </table>
    </td></tr>     
    <tr><td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td></tr>
    <tr><td>
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 325px;font-family: arial;font-size:17px;">
            <tr><td style="font-weight:bold;">Total: </td><td width="12"></td><td><?php echo $totqty;?></td></tr>
        </table>
    </td></tr>   
    <tr><td align="right" colspan="5" style="text-align:left;border-top: 4px dashed black;"></td></tr>
<?php if($action=='cancelbill')
   echo '<tr><td>BILL CANCELLED</td></tr>';
   if($action=='cancelitem')
   echo '<tr><td>ITEM CANCELLED</td></tr>'; 
    ?>        
</table>
 <?php
 }


?> 
