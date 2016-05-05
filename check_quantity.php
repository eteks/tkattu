<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();
?>
    
<?php
$action=$_POST['action'];
$item_name=$_POST['item_name'];

if($action=='check')
{
	
$vendor_list_sqlsc1 =  "SELECT  MAX(pur_id) as p_id, sum(quantity) as tot_qty   FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where item_name_id='$item_name' ORDER BY pur_id DESC";	 
//echo $vendor_list_sqlsc;
$vendor_list_recordssc1 = db_query($vendor_list_sqlsc1);
       if($vendor_stock_listc1 = db_fetch_array($vendor_list_recordssc1)) {            
           $quantity=$vendor_stock_listc1['tot_qty'];
           // echo $quantity;
            //$reorder_level=$vendor_stock_listc['reorder_level'];
              $pur_id=$vendor_stock_listc1['p_id'];
      // echo $reorder_level;
       }
              
$vendor_list_sqlsc =  "SELECT item_name_id, reorder_level, item_type_id, unit FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where pur_id='$pur_id'";	 
//echo $vendor_list_sqlsc;
$vendor_list_recordssc = db_query($vendor_list_sqlsc);
       if($vendor_stock_listc = db_fetch_array($vendor_list_recordssc))
               {         
             $reorder_level=$vendor_stock_listc['reorder_level'];
             //echo $reorder_level;
             
    $stock_balance_sqlc2=" SELECT IFNULL( SUM(processed_quantity) , 0 ) as bal_qty from ". TABLE_HMS_STOCK_BALANCE_DETAIL ." where item_name='$item_name'";
	//echo $stock_balance_sqlc2;        
    $stock_balance_recordssc2 = db_query($stock_balance_sqlc2);
    
        if($hms_stock_balance_valuesc2 = db_fetch_array($stock_balance_recordssc2)) { 
	$processed_quantity=$hms_stock_balance_valuesc2['bal_qty'];        
        $avail_qty=$quantity - $processed_quantity;
        
//echo $avail_qty;
//echo $reorder_level;

if($reorder_level >= $avail_qty)
{
?>
 <?php echo $item_name.' Reached Minimum Reorder Level'.''; ?> <?php echo $avail_qty; ?>
<?php } ?>
<?php } } } ?>
 