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

<input type="button" value="Refresh" name="Refresh" class="submit" onclick="return getVendorList();" style="float: right;margin-right: 5px;
margin-bottom: 5px;" />  	
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr >
<td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"> Stock Order Detail</td>
</tr>
    <tr>

        
         <th width="12%" style="text-align:center" >Item  Name</th>
		  <th width="13%" style="text-align:center" >Item Type </th>
		    <th width="15%" style="text-align:center" >Available Quantity(UOM)</th>
             <th width="15%" style="text-align:center" >Action</th>
         
    </tr>
   <?php
$name=$_POST['item_name_id'];

if($name=='All')
{
	
$item_name_sql="SELECT item_entry_name,item_entry_type,item_entry_id FROM ".TABLE_HMS_ITEM_ENTRY." ";

	$item_name_records = db_query($item_name_sql);
	
	while($hms_item_name_records=db_fetch_array($item_name_records))
	{
		$all_name=$hms_item_name_records['item_entry_id'];
		
$vendor_list_sqls =  "SELECT item_name_id, item_type_id, unit, sum(quantity) as tot_qty  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where item_name_id='$all_name' ";	 
$vendor_list_recordss = db_query($vendor_list_sqls);
             
    $stock_balance_sql1=" SELECT IFNULL( SUM( processed_quantity ) , 0 ) as bal_qty from ". TABLE_HMS_STOCK_BALANCE_DETAIL ." where item_name='$all_name'";
	$stock_balance_recordss1 = db_query($stock_balance_sql1);
	$hms_stock_balance_values1 = db_fetch_array($stock_balance_recordss1);

	$balance_qty=$hms_stock_balance_values1['bal_qty'];

	if ($vendor_list_recordss > 0) {
	}	
    while ($hms_info_values = db_fetch_array($vendor_list_recordss)) { 
	
	$avail_qty=$hms_info_values["tot_qty"] - $balance_qty;	
	?>
    

    <tr>
	
               
       <td width="8%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
       
        <?php if($hms_item_name_records["item_entry_name"]=="") { echo "- -";} else { echo stripslashes(($hms_item_name_records["item_entry_name"])); } ?></td>
        
		  <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <?php if(itemtypename($hms_item_name_records["item_entry_type"])=="") { echo "- -";} else {  echo itemtypename($hms_item_name_records["item_entry_type"]);} ?></td>
		  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php  echo $avail_qty; ?>&nbsp;<?php echo unitname($hms_info_values["unit"]); ?></td>
        
        <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
    <input name="btnPrint" type="button" id="btnPrint" class="submit"
  value="Process" onClick="getVendorViewList('<?php echo $hms_item_name_records["item_entry_id"]; ?>','<?php echo $hms_item_name_records["item_entry_type"]; ?>','<?php echo $avail_qty;  ?>');"> </td></tr>      

      
  
<?php 
}
} 
?>
  
   
    </table>
	

  
  <?php
	}
	else{	 $name=$_POST['item_name_id'];
$vendor_list_sqls =  "SELECT item_name_id, item_type_id, unit, sum(quantity) as tot_qty  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where item_name_id='$name' ";	 	
    $vendor_list_recordss = db_query($vendor_list_sqls);
             
    $stock_balance_sql1="SELECT IFNULL( SUM( processed_quantity ) , 0 ) as bal_qty from ". TABLE_HMS_STOCK_BALANCE_DETAIL ." where item_name='$name'";
	$stock_balance_recordss1 = db_query($stock_balance_sql1);
	$hms_stock_balance_values1 = db_fetch_array($stock_balance_recordss1);	
	$balance_qty=$hms_stock_balance_values1['bal_qty'];
	//echo $balance_qty;
	}
  
	if ($vendor_list_recordss > 0) {
    while ($hms_info_values = db_fetch_array($vendor_list_recordss)) { 
	
	$avail_qty=$hms_info_values["tot_qty"] - $balance_qty;
	
	?>
    <tr>
	
        
        
       <td width="8%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
       
        <?php if($hms_info_values["item_name_id"]==""){echo "--";} else { echo itemname($hms_info_values["item_name_id"]); }?></td>
        
		  <td width="10%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <?php if(itemtypename($hms_info_values["item_type_id"])==""){echo "--";} else {echo itemtypename($hms_info_values["item_type_id"]); }?></td>


		 
		  <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php  echo $avail_qty; ?>&nbsp;<?php echo unitname($hms_info_values["unit"]); ?></td>
        
        <td width="7%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <input name="btnPrint" type="button" id="btnPrint" class="submit"
  value="Process" onClick="getVendorViewList('<?php echo $hms_info_values["item_name_id"]; ?>','<?php echo $hms_info_values["item_type_id"]; ?>','<?php echo $avail_qty;  ?>');"> </td></tr>      

        
  
<?php 
}
} 
?>
  
    
 </table>
    
 <?php $_POST["action"] = (isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action']:"" );
$action=$_POST['action'];
$_POST["item_name"] = (isset($_POST['item_name']) && !empty($_POST['item_name']) ? $_POST['item_name']:"" );
$item_name=$_POST['item_name'];

if($action=='check')
{

    
$vendor_list_sqlsc =  "SELECT item_name_id, item_type_id, unit, sum(quantity) as tot_qty  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where item_name_id='$item_name' ";	 
$vendor_list_recordssc = db_query($vendor_list_sqlsc);

	$vendor_stock_list = db_fetch_array($vendor_list_recordssc);
	$quantity=$vendor_stock_list['tot_qty'];
        $reorder_level=$vendor_stock_list['reorder_level'];
             
    $stock_balance_sqlc1=" SELECT IFNULL( SUM( processed_quantity ) , 0 ) as bal_qty from ". TABLE_HMS_STOCK_BALANCE_DETAIL ." where item_name='$item_name'";
	$stock_balance_recordssc1 = db_query($stock_balance_sqlc1);
	$hms_stock_balance_valuesc1 = db_fetch_array($stock_balance_recordssc1);

	$processed_quantity=$hms_stock_balance_valuesc1['bal_qty'];
   	
while ($hms_info_values = db_fetch_array($vendor_list_recordss)) { 
$avail_qty=$quantity - $processed_quantity;	

if($reorder_level <= $avail_qty)
{

?>
<?php echo "true"; ?>

<?php } else {  ?>
 <?php echo "false"; ?>
<?php } ?>

<?php } } ?>
 