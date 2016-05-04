<html>
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="printjquery.js"></script>
<script>
$(document).ready(function($){
    
 $('#kotd').on('click',function(){
  var cartid = $(this).attr('data');
  $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=update&depart=1&cartid='+cartid,
          success: function(data){    
                   
                   
          }
          });         
  $('#kotbill').printElement();  
  
 }); 
 $('#jd').on('click',function(){
  var cartid = $(this).attr('data');
  $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=update&depart=2&cartid='+cartid,
          success: function(data){    
                   
                   
          }
          });      
  $('#jbill').printElement();     
 });  
 
});     
</script>
<style>
#kotbill tr td, #jbill tr td{
    padding-left:5px;
    padding-right:5px;
} 
@media(-webkit-min-device-pixel-ratio:0) {
    #kotbill,  #jbill
{
    width:240px;
}

}

</style>
<body style="background: rgb(229, 224, 198) none repeat scroll 0% 0%;">
<?php require_once ("includes/application_top.php");


$tableno   = (isset($_REQUEST['tableno']) && !empty($_REQUEST['tableno']) ? trim($_REQUEST['tableno']):"");
$ordertype = (isset($_REQUEST['ordertype']) && !empty($_REQUEST['ordertype']) ? trim($_REQUEST['ordertype']):"");
$chkitems = (isset($_REQUEST['chkitems']) && !empty($_REQUEST['chkitems']) ? trim($_REQUEST['chkitems']):"");
$cartid    = (isset($_REQUEST['cartid']) && !empty($_REQUEST['cartid']) ? trim($_REQUEST['cartid']):"");
$action    = (isset($_REQUEST['action']) && !empty($_REQUEST['action']) ? trim($_REQUEST['action']):"");
$datetime  = date("dS  M  Y h:i A");
$supplier    = getsupplier($tableno);

$sel_parameter  = "SELECT hms_hotel_name FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
$rows_parameter = db_query ($sel_parameter);
$fet_parameter  = db_fetch_array($rows_parameter);

if($action=='cancelitem')
{
$orderid = explode(',',$chkitems);
foreach($orderid as $orderidval)
{
  $innerselect  = "SELECT order_quantity,order_product,bill_id,order_cart_id,last_cancel_quantity,order_id,menuid,depart_id FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id = '$orderidval' ";
  $innerrows    = db_query($innerselect); 
  $innerfetch   = db_fetch_array($innerrows);
  if(db_num_rows($innerrows)>0)
  $finalqty     = -$innerfetch['last_cancel_quantity'];  
  db_query("INSERT INTO hms_order_qty_flow SET bill_id='".$innerfetch['bill_id']."',order_product='".$innerfetch['order_product']."',itemcancel='".$innerfetch['itemcancel']."',last_cancel_quantity='".$innerfetch['itemcancel']."',depart_id='".$innerfetch['depart_id']."',order_cart_id='".$innerfetch['order_cart_id']."', menuid='".$innerfetch['menuid']."',order_id='".$innerfetch['order_id']."', order_quantity='".$finalqty."', cancel_status=1");
}    
$wherecon = " AND (itemcancel=1 OR (itemcancel=0 AND last_cancel_quantity!=0)) AND order_id IN ($chkitems)";
}
else
$wherecon = " AND itemcancel=0 AND depart_status=0";    

//KOT
$sel_separatebill  ="SELECT order_quantity,order_product,bill_id,order_cart_id,last_cancel_quantity FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE depart_id=1 $wherecon AND order_cart_id = '$cartid' ";
$rows_separatebill = db_query($sel_separatebill);
$srows_separatebill = db_query($sel_separatebill);
$sfet_separatebill = db_fetch_array($srows_separatebill);
if(db_num_rows($rows_separatebill)>0)
{?>
  
<table cellpadding="0" cellspacing="0" border="0" width="200" id="kotbill" bgcolor="#fff">
    <tr>
        <td align="center" style="font-weight:bold;"><?php echo $fet_parameter['hms_hotel_name'] ;?></td>
    </tr>
    <tr><td>-------------------------------------------</td></tr>
    <tr>
        <td style="font-size:12px;"><?php if($ordertype=='dine'){ echo '<b>T.No: </b>'.$tableno ; }  echo '<b> B.No: </b>'.$sfet_separatebill['bill_id']  ;?></td>
    </tr>
    <tr>
       <td style="font-size:12px;"><?php echo '<b>D/T: </b>'.$datetime ;?></td>
    </tr>
    <?php if($ordertype=='dine'){?>
     <tr>
       <td style="font-size:12px;"><?php echo '<b>S/I: </b>'.$supplier.' <b>Dept: </b>KOT' ;?></td>
    </tr>
    <?php }?>
    <tr><td>-------------------------------------------</td></tr>
    <tr><td>
        <table cellpadding="0" cellspacing="0" border="0">
            <tr><td style="font-size:12px;font-weight:bold;" width="175">Item</td><td style="font-size:12px;font-weight:bold;">Qty</td></tr>
            <?php while($fet_separatebill = db_fetch_array($rows_separatebill)){
                
                if($action=='cancelitem')
                {
                if($fet_separatebill['last_cancel_quantity']==0)
                $totqty += $fet_separatebill['order_quantity'];
                else
                $totqty += $fet_separatebill['last_cancel_quantity'];    
                }
                else
                $totqty += $fet_separatebill['order_quantity'];
       
                $cartid   = $fet_separatebill['order_cart_id'];?>
            <tr><td style="font-size:12px;"><?php echo $fet_separatebill['order_product'] ;?></td><td style="font-size:12px;"><?php if($action=='cancelitem'){ if($fet_separatebill['last_cancel_quantity']==0) echo $fet_separatebill['order_quantity']; else echo $fet_separatebill['last_cancel_quantity'] ;} else echo $fet_separatebill['order_quantity'] ;?></td></tr>
            <?php }?>
        </table>
    </td></tr>     
    <tr><td>-------------------------------------------</td></tr>
    <tr><td>
        <table cellpadding="0" cellspacing="0" border="0" style="font-size:12px;margin-left: 125px;">
            <tr><td style="font-size:12px;font-weight:bold;">Total: </td><td width="10"></td><td><?php echo $totqty;?></td></tr>
        </table>
    </td></tr>   
    <tr><td>-------------------------------------------</td></tr>
    <?php if($action=='cancelbill')
   echo '<tr><td>BILL CANCELLED</td></tr>';
   if($action=='cancelitem')
   echo '<tr><td>ITEM CANCELLED</td></tr>'; 
    ?>    
</table>
<div class='bill'><div style='height:50px;'></div><div style='text-align:center;width:200px;'><input type='button'  id="kotd" data="<?php echo $cartid ;?>" value='Print' /></div><div style='height:50px;' ></div></div>
 <?php
 }


//Juice
$jsel_separatebill  ="SELECT order_quantity,order_product,bill_id,order_cart_id,last_cancel_quantity FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE depart_id=2 $wherecon AND order_cart_id = '$cartid' ";
$jrows_separatebill = db_query($jsel_separatebill);
if(db_num_rows($jrows_separatebill)>0)
{?><div style='height:50px;' ></div>
  
<table cellpadding="0" cellspacing="0" border="0" width="200" id="jbill" bgcolor="#fff">
    <tr>
        <td align="center" style="font-weight:bold;"><?php echo $fet_parameter['hms_hotel_name'] ;?></td>
    </tr>
    <tr><td>-------------------------------------------</td></tr>
    <tr>
        <td style="font-size:12px;"><?php if($jordertype=='dine'){ echo '<b>T.No: </b>'.$tableno ; } echo '<b> B.No: </b>'.$sfet_separatebill['bill_id']  ;?></td>
    </tr>
    <tr>
    </tr>
       <td style="font-size:12px;"><?php echo '<b>D/T: </b>'.$datetime ;?></td>
    </tr>
    <?php if($ordertype=='dine'){?>
     <tr>
       <td style="font-size:12px;"><?php echo '<b>S/I: </b>'.$supplier.' <b>Dept: </b>Juice Center' ;?></td>
    <?php }?>
    <tr><td>-------------------------------------------</td></tr>
    <tr><td>
        <table cellpadding="0" cellspacing="0" border="0">
            <tr><td style="font-size:12px;font-weight:bold;" width="175">Item</td><td style="font-size:12px;font-weight:bold;">Qty</td></tr>
            <?php while($jfet_separatebill = db_fetch_array($jrows_separatebill)){
                if($action=='cancelitem')
                { 
                if($jfet_separatebill['last_cancel_quantity']==0)
                $jtotqty += $jfet_separatebill['order_quantity'];    
                else    
                $jtotqty += $jfet_separatebill['last_cancel_quantity'];
                }
                else
                $jtotqty += $jfet_separatebill['order_quantity'];
                $jcartid   = $jfet_separatebill['order_cart_id'];?>
            <tr><td style="font-size:12px;"><?php echo $jfet_separatebill['order_product'] ;?></td><td style="font-size:12px;"><?php if($action=='cancelitem'){ if($jfet_separatebill['last_cancel_quantity']==0) echo $jfet_separatebill['order_quantity']; else echo $jfet_separatebill['last_cancel_quantity'] ; }else echo $jfet_separatebill['order_quantity'] ;?></td></tr>
            <?php }?>
        </table>
    </td></tr>     
    <tr><td>-------------------------------------------</td></tr>
    <tr><td>
        <table cellpadding="0" cellspacing="0" border="0" style="font-size:12px;margin-left: 125px;">
            <tr><td style="font-size:12px;font-weight:bold;">Total: </td><td width="10"></td><td><?php echo $jtotqty;?></td></tr>
        </table>
    </td></tr>   
    <tr><td>-------------------------------------------</td></tr>
    <?php if($action=='cancelbill')
   echo '<tr><td>BILL CANCELLED</td></tr>';
   if($action=='cancelitem')
   echo '<tr><td>ITEM CANCELLED</td></tr>'; 
    ?>    
</table>
<div class='bill'><div style='height:50px;'></div><div style='text-align:center;width:200px;'><input type='button' id="jd" data="<?php echo $jcartid ;?>" value='Print' /></div><div style='height:50px;' ></div></div>
 <?php 
 }


?>
<div style="width:200px;text-align:center;cursor:pointer;"><span style="text-decoration:underline;" onclick='window.close();'>Close</span></div>
</body>
</html>