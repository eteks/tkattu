<?php
session_start();
require_once ("includes/application_top.php");

$tableid = (isset($_REQUEST['tableid']) && !empty($_REQUEST['tableid']) ? str_replace("undefined,","",$_POST['tableid']):"");
$depart  = (isset($_REQUEST['depart']) && !empty($_REQUEST['depart']) ? $_REQUEST['depart']:"");
$cartid  = (isset($_REQUEST['cartid']) && !empty($_REQUEST['cartid']) ? $_REQUEST['cartid']:"");
$menuid  = (isset($_REQUEST['menuid']) && !empty($_REQUEST['menuid']) ? $_REQUEST['menuid']:"");
$itemcode  = (isset($_REQUEST['itemcode']) && !empty($_REQUEST['itemcode']) ? $_REQUEST['itemcode']:"");
$qty     = (isset($_REQUEST['qty']) && !empty($_REQUEST['qty']) ? $_REQUEST['qty']:"");
$orderid  = (isset($_REQUEST['orderid']) && !empty($_REQUEST['orderid']) ? $_REQUEST['orderid']:"");
$action  = (isset($_REQUEST['action']) && !empty($_REQUEST['action']) ? $_REQUEST['action']:"");
$session = (isset($_REQUEST['session']) && !empty($_REQUEST['session']) ? $_REQUEST['session']:"");
if($action=='tablechk' && !empty($tableid))
{
  $select = db_query("SELECT table_entry_id  FROM ".TABLE_HMS_TABLE_DETAILS." a  LEFT JOIN  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " b ON a.htd_cart_id=b.order_cart_id WHERE status='open' AND itemcancel=0 AND created_role_id='".$_SESSION["admin_role_mst_id"]."' AND htd_table_id IN ($tableid)");
  $selecttblchk = db_query("SELECT table_entry_id  FROM ".TABLE_HMS_TABLE_DETAILS." a  LEFT JOIN  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " b ON a.htd_cart_id=b.order_cart_id WHERE status='open' AND itemcancel=0  AND htd_table_id IN ($tableid)");
  echo (db_num_rows($selecttblchk)>0 && db_num_rows($select)==0 ? 1:0);
  
}
if($action=='update' && !empty($cartid) && !empty($depart))
{
  //db_query("UPDATE ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET depart_status=1  WHERE depart_id='$depart' AND order_cart_id='".$cartid."'");
  db_query("UPDATE  hms_order_qty_flow SET depart_status='1' WHERE depart_id='$depart' AND order_cart_id='".$cartid."'");

}
if($action=='deptordchk' && !empty($cartid))
{
  $select = db_query("SELECT order_id  FROM hms_order_qty_flow WHERE order_cart_id='".$cartid."' AND  depart_status=1");
  echo (db_num_rows($select)>0 ? 1:0);
}   
if($action=='tableexistchk' && !empty($tableid))
{
  $select = db_query("SELECT table_entry_id  FROM ".TABLE_HMS_TABLE_DETAILS." a  LEFT JOIN  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " b ON a.htd_cart_id=b.order_cart_id WHERE status='open' AND itemcancel=0 AND created_role_id='".$_SESSION["admin_role_mst_id"]."' AND htd_table_id IN ($tableid)");
  echo (db_num_rows($select)>0 ? 1:0);
  
}

if($action=='stockchk' && !empty($menuid) && !empty($qty) && !empty($orderid))
{ 
  $select = db_query("SELECT order_quantity  FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE order_id='$orderid'");
  if(db_num_rows($select)>0)
  {
      $fetchqty = db_fetch_array($select);
      $pqty = $fetchqty['order_quantity'];
  }
    
  $select = db_query("SELECT * FROM hms_stock_mt WHERE mse_menu_id='".$menuid."'");
   if(db_num_rows($select)>0)
   {
     $fetch = db_fetch_array($select);
     $in_stock = $fetch['in_stock']+$pqty;
     $in_stockk = $fetch['in_stock'];
     if($qty > $in_stock)
         echo '1###'.$in_stockk.'###'.$pqty;
     else if($qty==$in_stock)
         echo '2###0###'.$pqty;
     else 
         echo 0;
    
   }
   
   
}

if($action=='itemavil' && (!empty($menuid) || !empty($itemcode)))
{ 
  if(!empty($menuid))  
    $con = " mse_menu_id='$menuid'";
  else if(!empty($itemcode))  
    $con = " item_code='$itemcode'";
  $select = db_query("SELECT in_stock ,menu_name, menu_reorder_level FROM hms_stock_mt a LEFT JOIN " . TABLE_HMS_MENUENTRY. " b ON a.mse_menu_id=b.menu_id WHERE $con group by mse_menu_id");
  if(db_num_rows($select)>0)
  {
      $fetchqty = db_fetch_array($select);
      $pqty = $fetchqty['in_stock'];
      $pname = $fetchqty['menu_name'];
      echo $result = ($pqty <= $fetchqty['menu_reorder_level'] ? $pname.'###'.$pqty:"");
  }
  
}

if($action=='itemavilchk' && !empty($itemcode))
{ 
    
 $codechecksel =  db_query("SELECT menu_id FROM " . TABLE_HMS_MENUENTRY . " WHERE `item_code` = '".$itemcode."'");   
 if(db_num_rows($codechecksel)>0)
 {
  $select = db_query("SELECT in_stock FROM hms_stock_mt WHERE in_stock=0 AND mse_menu_id='".itemcode($itemcode)."'");
 if(db_num_rows($select)==0)
  echo '1';
 }
 else 
 echo '2';    
}

if($action=='itemavilchk1' && !empty($itemcode))
{ 
    
 $codechecksel =  db_query("SELECT menu_id FROM " . TABLE_HMS_MENUENTRY . " WHERE `item_code` = '".$itemcode."'");   
 if(db_num_rows($codechecksel)>0)
 {
 // $select = db_query("SELECT in_stock FROM hms_stock_mt WHERE in_stock=0 AND mse_menu_id='".itemcode($itemcode)."'");
// if(db_num_rows($select)==0)
  echo '1';
 }
 else 
 echo '2';    
}

if($action=='checkgen' && !empty($cartid))
{ 
    
  $sqltotalorderqty_temp = db_query("SELECT sum(order_quantity) as order_quantity FROM  hms_order_qty_flow WHERE order_cart_id='$cartid' AND depart_status=1  group by `order_cart_id`"); 
    if(db_num_rows($sqltotalorderqty_temp)>0)
    {
     $fetchtotalorderqty_temp= db_fetch_array($sqltotalorderqty_temp);
     $totalorderqty_temp = $fetchtotalorderqty_temp['order_quantity'];
    }

   $sqltotalorderqty = db_query("SELECT sum(`order_quantity`) as order_quantity FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_cart_id='$cartid' AND  itemcancel=0 group by `order_cart_id`"); 
    if(db_num_rows($sqltotalorderqty)>0)
    {
     $fetchtotalorderqty= db_fetch_array($sqltotalorderqty);
     $totalorderqty = $fetchtotalorderqty['order_quantity'];
    }
   echo $checkgen = ($totalorderqty==$totalorderqty_temp ? 1:0);   
  
}
if($action=='checksave' && !empty($cartid))
{ 
 $sqltotalcartamt = db_query("SELECT sum(`order_total_price`) as order_total_price FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_cart_id='$cartid'   group by `order_cart_id`"); 
    if(db_num_rows($sqltotalcartamt)>0)
    {
     $fetchtotalcartamt= db_fetch_array($sqltotalcartamt);
     $totalcartamt = $fetchtotalcartamt['order_total_price'];
    }
    
  $savebill_printchk=db_query("SELECT total_amount FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE  account_card_id='$cartid'");
  if(db_num_rows($savebill_printchk)>0)
  {
    $save_bill_chk = db_fetch_array($savebill_printchk);
    $account_totalcartamt = $save_bill_chk['total_amount'];
  }
  echo $checksave = ($account_totalcartamt==$totalcartamt ? 1:0);
}

if($action=='updatesession' && !empty($session))
{
 
  if($session=='E')
  {
  /*$selecteof = db_query("SELECT sum(total_amount),status,bill_status,bill_id FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . "  WHERE order_open_date=CURDATE() group by status,bill_status"); 
  if(db_num_rows($selecteof)>0)
  {
    while($fetcheof = db_fetch_array($selecteof))
        {
        if($fetcheof['status']=='close')
           $open 

        }
  }
  */
          
  db_query("UPDATE ".TABLE_HMS_RESTAURANT_ORDER_SESSION." SET hros_start_date=CURDATE(), hros_session='".$session."'");
  db_query("UPDATE ".TABLE_HMS_BILL_ID." set bill_id='100001'");
  }
  else
  {
      
   if($session=='B') 
    $con = 'L';
    else if($session=='L')
    $con = 'S';    
    else if($session=='S')
    $con = 'D';  
    else if($session=='D')
    $con = 'E'; 
    $select = db_query("SELECT order_id FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . "  WHERE order_open_date=CURDATE() AND order_session='".$session."'");
    $selectnext = db_query("SELECT order_id FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . "  WHERE order_open_date=CURDATE() AND order_session='".$con."'");
    $count = db_num_rows($select);
    $countnext = db_num_rows($selectnext);
    $selectsession = db_query("SELECT hros_session FROM ".TABLE_HMS_RESTAURANT_ORDER_SESSION." WHERE hros_start_date=CURDATE() AND hros_session='E'");
    if(($count>0 && $countnext==0 && db_num_rows($selectsession)==0) || ($count==0 && $countnext==0 && db_num_rows($selectsession)==0))
    {
    $select = db_query("SELECT hros_id FROM ".TABLE_HMS_RESTAURANT_ORDER_SESSION."");
    if(db_num_rows($select)>0)
    db_query("UPDATE ".TABLE_HMS_RESTAURANT_ORDER_SESSION." SET hros_start_date=CURDATE(), hros_session='".$session."'");
    else
    db_query("INSERT INTO ".TABLE_HMS_RESTAURANT_ORDER_SESSION." SET hros_start_date=CURDATE(), hros_session='".$session."'");
    
    }
    else 
    {
        $selectsession = db_query("SELECT hros_session FROM ".TABLE_HMS_RESTAURANT_ORDER_SESSION." WHERE hros_start_date=CURDATE() AND hros_session!='E'");
        if(db_num_rows($selectsession)>0)
        {
        $fetchsession = db_fetch_array($selectsession);
        $currentsession = $fetchsession['hros_session'];
        }
        echo '1##'.$currentsession;
    }
  }
}
if($action=='sessionchk' && !empty($session))
{
  if($session=='B') 
  $con = 'L';
  else if($session=='L')
  $con = 'S';    
  else if($session=='S')
  $con = 'D';   
  $select = db_query("SELECT order_id FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . "  WHERE order_open_date=CURDATE() AND order_session='".$con."'");
  echo (db_num_rows($select)>0 ? 1:0);
}
