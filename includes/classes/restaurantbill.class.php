<?php
class restaurantbill {

    function getTableTree () {

        $RoomType_query = db_query("SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `active` = 'Y'  ORDER BY table_no ASC");

        return $RoomType_query;
    }


function getorderTableTree () {

   $RoomType_query = db_query("SELECT table_entry_id , table_no FROM ".TABLE_HMS_TABLE_ENTRY." WHERE table_entry_id  IN (SELECT table_entry_id FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE status='open' AND itemcancel=0)");

return $RoomType_query;
}


function customerFetchAllRecords() {

        $hms_info_fetch_allrec_sql = ("SELECT * FROM " . TABLE_HMS_CUSTOMER_TABLE );
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

   
function SaveMenuList(){
$menuid= (isset($_POST['menuid']) && !empty($_POST['menuid']) ? $_POST['menuid']:"");
$table=(isset($_REQUEST['tableid']) && !empty($_REQUEST['tableid']) ? $_POST['tableid']:"");
$order_type=$_POST['ordertype'];
$noofpersons = (isset($_POST['noofpersons']) && !empty($_POST['noofpersons']) ? $_POST['noofpersons']:"");
$suppliers = (isset($_POST['suppliers']) && !empty($_POST['suppliers']) ? $_POST['suppliers']:"");
$accountsession = (isset($_POST['accountsession']) && !empty($_POST['accountsession']) ? $_POST['accountsession']:"");
$category = (isset($_POST['category']) && !empty($_POST['category']) ? $_POST['category']:"");
$chairs=(isset($_REQUEST['chairs']) && !empty($_REQUEST['chairs']) ? $_REQUEST['chairs']:"");
$itemcode=(isset($_REQUEST['itemcode']) && !empty($_REQUEST['itemcode']) ? $_REQUEST['itemcode']:"");
$menuid = (!empty($itemcode) ? itemcode($itemcode): $menuid);

$tbldtls = explode(',',$chairs);
foreach($tbldtls as $tbldtlsdata)
{
  $tbldtlsplit = explode('_',$tbldtlsdata);
  $dtml = (!empty($chairslist) ? ',':'');  
  $chairslist .= $dtml.$tbldtlsplit[0];
}

if(!empty($category))
$catcon = " AND menu_category_id IN ($category) " ;
session_start();
$table_valid = db_query("SELECT table_entry_id ,status FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE  status='open' AND itemcancel=0");
	 $tabel = db_fetch_array($table_valid);
	  $value=$tabel['table_entry_id'];


if( !empty($menuid) ||  !empty($itemcode)) {
$select_table = db_query("SELECT table_entry_id ,status,order_product FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE      
		 table_entry_id = '".$chairslist."' AND menuid=$menuid AND status='open' AND itemcancel=0 AND bill_id=''");

	$count_table1 =mysql_num_rows($select_table);
	if($count_table1>0)
		 {
			echo '<script>alert("Item already exist");</script>';
		 }
else{
	
$select_table = db_query("SELECT order_cart_id,bill_id,table_entry_id ,status FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE      
		 table_entry_id = '".$chairslist."' AND status='open' AND itemcancel=0");
		
$count_table =mysql_num_rows($select_table);	

if($count_table==0) {
    $select_cart_id =db_query("SELECT max(order_cart_id) as cart_id , status,table_entry_id FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS."");
        $count = mysql_num_rows($select_cart_id);

        if($count>0){
         $rowcart_id = db_fetch_array($select_cart_id);
           if ($rowcart_id["status"] == "open") {
           
                if($chairslist==$rowcart_id["table_entry_id"]) {
					
                     $cart_value = $rowcart_id["cart_id"];
					 
              
			    } else {
					
					$cart_value = $rowcart_id["cart_id"]+1;
					
			    }
           }
           else {
                    $cart_value = $rowcart_id["cart_id"]+1;
					 
                 
				}
        } 
		else {
         $cart_value="1";
		 
        }
    } 
else 
{
      $rowcart_table = db_fetch_array($select_table);
      $cart_value = $rowcart_table["order_cart_id"];
	   
  
  }

$selectmenudetail=db_query("SELECT * FROM ". TABLE_HMS_MENUENTRY ." a LEFT JOIN ".TABLE_HMS_MENUCATEGORY_CREATION." b ON hms_menu_category_id=menu_category_id WHERE a.active='Y'  AND menu_id=$menuid  $catcon");
while($menudetail_data=db_fetch_array($selectmenudetail))
{
          
    $hms_info_fetch_table_menu = "SELECT `vat_tax`,`service_tax` FROM " . TABLE_HMS_MENU_CATEGORY . " WHERE hms_menu_category_id = ".$menudetail_data["menu_category_id"]." ";
            $menu_records = db_query ($hms_info_fetch_table_menu);
            $menu_categ = db_fetch_array($menu_records);    
            
	    $vat_tax=$menu_categ["vat_tax"];  
            $service_tax=$menu_categ["service_tax"];  
        
  //echo $vat_tax; 
    
    $v_tax=$menudetail_data["price"]*($vat_tax/100.0);
    $s_tax=$menudetail_data["price"]*($service_tax/100.0);    
   // $incl_tax=$menudetail_data["price"]*($menudetail_data['$vat_tax']/100.0);
    $total_price=round($menudetail_data["price"]+$v_tax+$s_tax); 

  $customerDetailsAdd = db_query("INSERT INTO " .TABLE_HMS_RESTAURANT_ORDER_DETAILS. "( `order_id`,`order_cart_id`,`bill_id`,`order_type`,`table_entry_id`,`order_posted_date`,`menuid`,`category_id`,`depart_id`, `vat_tax`,`vat_amount`, `service_tax`, `service_amount`,`order_product`,`order_price`,`order_quantity`, `order_amount`,
  `order_total_price`,`order_open_date` , `order_close_date`,created_by,created_role_id,order_session,no_of_person) VALUES ('','".$cart_value."','".$bill_value."','".$order_type."','".$chairslist."', CURDATE() , '".$menudetail_data["menu_id"]."', '".$menudetail_data["menu_category_id"]."','".$menudetail_data["depart_id"]."', '".$vat_tax."', '".$v_tax."', '". $service_tax."', '".$s_tax."',  '".addslashes($menudetail_data["menu_name"])."','".$menudetail_data["price"]."','1', '".$menudetail_data["price"]."' ,'".$total_price."',NOW(),'','".$_SESSION["userid"]."','".$_SESSION["admin_role_mst_id"]."','".$accountsession."','".$noofpersons."') ");
  $orderedis = mysql_insert_id();          
}


$tbldtls_s = explode(',',$chairs);
foreach($tbldtls_s as $tbldtlsdata_s)
{
  $tbldtlsplit_s = explode('_',$tbldtlsdata_s);
  $checkdata = db_query("SELECT htd_cart_id FROM ".TABLE_HMS_TABLE_DETAILS." WHERE  htd_cart_id='$cart_value' AND htd_table_id='".$tbldtlsplit_s[1]."' AND htd_chairs='".$tbldtlsplit_s[0]."' ");
if(db_num_rows($checkdata)>0)
db_query("UPDATE ".TABLE_HMS_TABLE_DETAILS." SET  htd_supplier_id='$suppliers' , htd_noofpersons='$noofpersons',htd_order_id='$orderedis' WHERE htd_cart_id='$cart_value'");
else
db_query("INSERT INTO ".TABLE_HMS_TABLE_DETAILS." SET htd_order_id='$orderedis',  htd_cart_id='$cart_value' , htd_chairs='".$tbldtlsplit_s[0]."', htd_table_id='".$tbldtlsplit_s[1]."', htd_supplier_id='$suppliers' , htd_noofpersons='$noofpersons',htd_creaton=NOW(),htd_createdby='".$_SESSION["userid"]."', htd_createdroleid='".$_SESSION["admin_role_mst_id"]."'");
}

 }

function tableEntryFetchAllRecords() {
            $hms_info_fetch_allrec_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " ORDER BY `date_added`";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

} }

 function menuEntryAllRecords($id,$order_type) {

        $menuEntryAllRecords = "SELECT  * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0' AND table_entry_id='".$id."' AND order_type='".$order_type."' ORDER BY order_id ASC ";
        $menuEntryAllRecords_query = db_query($menuEntryAllRecords);
        return $menuEntryAllRecords_query;
 

}

function menudetailAllRecords($table_id) {

        $menuEntryAllRecords = "SELECT  * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0'  and table_entry_id='".$table_id."' ORDER BY table_entry_id ";
        $menuEntryAllRecords_query = db_query($menuEntryAllRecords);
        return $menuEntryAllRecords_query;
 
 }
 
 
 
  function getSelectBill($cart_id,$order_type,$table_id) {

        $menuEntryAllRecords = "SELECT  * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0'  AND table_entry_id='".$table_id."' AND order_type='".$order_type."' AND order_cart_id='".$cart_id."' ";
        $menuEntryAllRecords_query = db_query($menuEntryAllRecords);
        return $menuEntryAllRecords_query;
}



 function getCancelBill($c_id,$table_id,$cancelcomments,$accountsession) {
     
   session_start();
$sql1=db_query("SELECT `order_id`,`order_cart_id`,`bill_id`,`order_type`,`table_entry_id`,`order_total_price`,`order_open_date`,`menuid`, sum(`order_total_price`) as `total` ,`status`,`bill`  FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0' AND table_entry_id ='".$table_id."' AND  order_cart_id='$c_id'");
while($row_data1=db_fetch_array($sql1))
 {    
    
$totalamount=$row_data1['total']; 

$sql_delete_acc=db_query("DELETE FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='".$table_id."' AND account_card_id='$c_id'");
$vat     = (!empty($vat) ? $vat:"");
$ser     = (!empty($ser) ? $ser:"");
$vat_amt = (!empty($vat_amt) ? $vat_amt:"");
$ser_amt = (!empty($ser_amt) ? $ser_amt:"");
$disc = (!empty($disc) ? $disc:"");  
$sql_insert=db_query("INSERT INTO ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." (`account_id`,`account_card_id`,`bill_id`,`order_type`,`vat`,`service`,`vat_amt`,`service_amt`,`discount`,`tabel_id`,`subtotal`,`total_amount`,`orde_close_date`, `status`, `bill_status`,created_by,created_role_id,cancelcomments,account_session) VALUES ('','".$row_data1['order_cart_id']."','".$row_data1['bill_id']."','".$row_data1['order_type']."','".$vat."','".$ser."','".$vat_amt."','".$ser_amt."','".$disc."','".$row_data1['table_entry_id']."','".$row_data1['total']."','".$totalamount."',NOW(),'cancel','cancel','".$_SESSION["userid"]."','".$_SESSION["admin_role_mst_id"]."','".$cancelcomments."','".$accountsession."')");	 

 }
//$menuEntryAllRecords1 = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `status`='cancel' WHERE `status` = 'open' AND tabel_id ='$table_id' AND  account_card_id='$c_id'");

$menuEntryAllRecords1 = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET `status`='cancel' WHERE `status` = 'open' AND table_entry_id ='".$table_id."' AND  order_cart_id='$c_id'");

 }
 
 
function getnoCashBill($c_id,$table_id,$nocashcomments) {
     
   session_start();
  $sql1=db_query("SELECT `order_id`,`order_cart_id`,`bill_id`,`order_type`,`table_entry_id`,`order_total_price`,`order_open_date`,`menuid`, sum(`order_total_price`) as `total` ,`status`,`bill`  FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0' AND table_entry_id ='".$table_id."' AND  order_cart_id='$c_id'");
while($row_data1=db_fetch_array($sql1))
 {    
    
$totalamount=$row_data1['total']; 

$sql_delete_acc=db_query("DELETE FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='".$table_id."' AND account_card_id='$c_id'");
$vat     = (!empty($vat) ? $vat:"");
$ser     = (!empty($ser) ? $ser:"");
$vat_amt = (!empty($vat_amt) ? $vat_amt:"");
$ser_amt = (!empty($ser_amt) ? $ser_amt:"");
$disc = (!empty($disc) ? $disc:"");  
$sql_insert=db_query("INSERT INTO ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." (`account_id`,`account_card_id`,`bill_id`,`order_type`,`tabel_id`,`orde_close_date`, `status`, `bill_status`,created_by,created_role_id,nocashcomments) VALUES ('','".$row_data1['order_cart_id']."','".$row_data1['bill_id']."','".$row_data1['order_type']."','".$row_data1['table_entry_id']."',NOW(),'close','nocash','".$_SESSION["userid"]."','".$_SESSION["admin_role_mst_id"]."','".$nocashcomments."')");	 

 }
//$menuEntryAllRecords1 = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `status`='cancel' WHERE `status` = 'open' AND tabel_id ='$table_id' AND  account_card_id='$c_id'");

$menuEntryAllRecords1 = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET order_price='', `status`='close', vat_tax='',vat_amount='',service_tax='', service_amount='',order_amount='',order_total_price='' WHERE `status` = 'open' AND table_entry_id ='".$table_id."' AND  order_cart_id='$c_id'");

 } 
 
 
function getCloseBill($c_id,$table_id) {
     
   
//$sql_close=db_query("SELECT `order_id`,`order_cart_id`,`bill_id`,`order_type`,`table_entry_id`,`order_total_price`,`order_open_date`,`menuid`, sum(`order_total_price`) as `total` ,`status` FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND table_entry_id ='$table_id' AND  order_cart_id='$c_id'");
//while($row_data2=db_fetch_array($sql_close))
//{    
    
//$totalamount=$row_data2['total']; 

//$sql_delete_acc=db_query("DELETE FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='$table_id' AND account_card_id='$c_id'");
     
//$sql_cinsert=db_query("INSERT INTO ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." (`account_id`,`account_card_id`,`bill_id`,`order_type`,`vat`,`service`,`vat_amt`,`service_amt`,`discount`,`tabel_id`,`subtotal`,`total_amount`,`orde_close_date`, `status`) VALUES ('','".$row_data2['order_cart_id']."','".$row_data2['bill_id']."','".$row_data2['order_type']."','".$vat."','".$ser."','".$vat_amt."','".$ser_amt."','".$disc."','".$row_data2['table_entry_id']."','".$row_data2['total']."','".$totalamount."',NOW(),'close')");	 

$menuEntryAllRecords1_c = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET `status`='close' WHERE `status` = 'open' AND table_entry_id ='".$table_id."' AND  order_cart_id='$c_id'");
$menuEntryAllRecords1_c = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `status`='close' WHERE `status` = 'open' AND tabel_id ='".$table_id."' AND  account_card_id='$c_id'");
// }

//$menuEntryAllRecords1_c = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `status`='close' WHERE `status` = 'close' AND table_entry_id ='$table_id' AND  order_cart_id='$c_id'");
//$menuEntryAllRecords1_c = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET `status`='close' WHERE `status` = 'close' AND table_entry_id ='$table_id' AND  order_cart_id='$c_id'");

 }

function getremoveitem(){
$cart_id = (isset($_POST['cart_id']) && !empty($_POST['cart_id']) ? $_POST['cart_id']:"");	
	//$colors = array($_POST['checkedValue']); 
 //$ids = array_map( 'intval', $_POST['checkedValue'] ); 
 if(isset($_POST['checkedValue']) && !empty($_POST['checkedValue']))
 {
 $data = explode(",",$_POST['checkedValue']);
$cnt=count($data);
//echo $cnt;
for($i=0;$i<$cnt;$i++){
$keys = array($_POST['checkedValue']);
foreach($keys as $k) {
    if(!empty($k))
    $data = explode(",", $k);
    //print $data[$i]."<br>"; 
 
$query="DELETE FROM " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id='".$data[$i]."' ";
db_query($query);
}
}
}

$selectcartid = db_query("SELECT order_cart_id FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " a WHERE order_cart_id='".$cart_id."'");
if(db_num_rows($selectcartid)==0)
{
db_query("DELETE FROM hms_order_qty_flow WHERE order_cart_id='".$cart_id."'");
db_query("DELETE FROM ".TABLE_HMS_TABLE_DETAILS." WHERE htd_cart_id='".$cart_id."'");
} 
}

function getcancelitem(){
if(isset($_POST['checkedValue']) && !empty($_POST['checkedValue']))
{
 $data = explode(",",$_POST['checkedValue']);
$cnt=count($data);
//echo $cnt;
for($i=0;$i<$cnt;$i++){
$keys = array($_POST['checkedValue']);
foreach($keys as $k) {
    if(!empty($k))
    $data = explode(",", $k);
    //print $data[$i]."<br>"; 
$sql_order_price=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_quantity!=0 AND last_cancel_quantity=0 AND order_id='".$data[$i]."'");
db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET last_cancel_quantity_disp=0 WHERE order_id='".$data[$i]."' ");
if(db_num_rows($sql_order_price)>0)   
db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET itemcancel=1 WHERE order_id='".$data[$i]."' ");
}}
}
}

function getparcelitem(){
if(isset($_POST['orderids']) && !empty($_POST['orderids']))
{
$datacol = explode("##",$_POST['orderids']); 
$con = (!empty($datacol[1]) ? " order_id='".$datacol[1]."'":" order_cart_id='".$_POST['cart_id']."'");    
db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET parcel_status='".$datacol[0]."' WHERE  $con");
}
}

function getupdatequantity(){
	
$order=$_POST['order'];
$quantity=$_POST['quantity']    ;	
$cquantity=(isset($_POST['cquantity']) && !empty($_POST['cquantity']) ? trim($_POST['cquantity']):0);
if($cquantity!=0)
$quantity=$quantity-$cquantity;
	$sql_order_price=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id='".$_POST['order']."'");
        $fcquantity=0;
while($price=db_fetch_array($sql_order_price)){
	
$hms_info_fetch_table_sql = "SELECT `menu_category_id` FROM " . TABLE_HMS_MENUENTRY . " WHERE menu_id = ".$price["menuid"]." ";
        // echo $hms_info_fetch_table_sql;
            $table_records = db_query ($hms_info_fetch_table_sql);
            $table  = db_fetch_array($table_records);		  
               
           // echo $table["menu_category_id"];   
              
    $hms_info_fetch_table_menu = "SELECT `vat_tax`,`service_tax` FROM " . TABLE_HMS_MENU_CATEGORY . " WHERE hms_menu_category_id = ".$table["menu_category_id"]." ";
            $menu_records = db_query ($hms_info_fetch_table_menu);
            $menu_categ = db_fetch_array($menu_records);    
            
	    $vat_tax=$menu_categ["vat_tax"];  
            $service_tax=$menu_categ["service_tax"];  

       $total_price=$price['order_price']*$quantity; 
  
    $v_tax=$total_price*($vat_tax/100.0);
    $s_tax=$total_price*($service_tax/100.0);
    
    $v_amount=$price['order_price']*($vat_tax/100.0);
    $vat_amount = $v_amount*$quantity;
    
    $s_amount=$price['order_price']*($service_tax/100.0);
    $service_amount=$s_amount*$quantity;
    $fcquantity = $price['cancel_quantity'] + $cquantity; 
    
   // $incl_tax=$menudetail_data["price"]*($menudetail_data['$vat_tax']/100.0);         
      
   // $total_price= $menudetail_data["price"]+$v_tax+$s_tax; 
       
       //$incl_tax=$total_price*($price['incl_tax']/100.0);
          
         $net_total_price= round($total_price+$v_tax+$s_tax); 
      
       
$customerDetailsAdd = db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET order_total_price='".$net_total_price."', vat_amount='".$vat_amount."', service_amount='".$service_amount."', order_quantity='".$quantity."',cancel_quantity='".$fcquantity."',last_cancel_quantity='".$cquantity."',last_cancel_quantity_disp='".$cquantity."', order_amount='".$total_price."' WHERE order_id='$order'");
}
	
}
function gettabledetails($cartid){
$select = db_query("SELECT htd_supplier_id, htd_noofpersons  FROM ".TABLE_HMS_TABLE_DETAILS." a  LEFT JOIN  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " b ON a.htd_cart_id=b.order_cart_id WHERE  itemcancel=0  AND order_cart_id = $cartid");
return $select;
}
function getcategorydetails() {
$select =  db_query("SELECT `hms_menu_category_id`,`hms_menu_category_name`,hms_menu_icon,hms_menu_icon_active FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE active='Y' ");
return $select;
}
function getordercategory($table_id) {
$select =  db_query("SELECT  distinct category_id FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0'  and table_entry_id='".$table_id."'");
return $select;
}
function getordersession() {
$select =  db_query("SELECT hros_session FROM ".TABLE_HMS_RESTAURANT_ORDER_SESSION."");
return $select;
}

}
?>