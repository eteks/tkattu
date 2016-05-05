<?php
class barbill {

    function getTableTree () {
        $RoomType_query = db_query("SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `active` = 'Y'");

        return $RoomType_query;
    }

function getorderTableTree () {
        $RoomType_query = db_query("SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `active` = 'Y'");

        return $RoomType_query;
    }


    function getTaxInfoFetchAllRecords() {

        $hms_info_fetch_allrec_sql = "SELECT `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO. "  ";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
    
    function taxChargeAdd() {

        $hms_info_fetch_allrec_sql = "SELECT `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO. " WHERE `tax_info_id` = '". $_POST["taxid"] ."'";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
//
//function hms_info_menu(){
//	
//	
//	
//}

function SaveMenuList(){

$menuid= $_POST['menuid'];
$table=$_POST['tableid'];
$order_type=$_POST['ordertype'];
if(isset($_POST["menuid"]) && $_POST["menuid"]!="" && isset($_POST["tableid"]) && $_POST["tableid"]=="") {
	
		$select_table = db_query("SELECT order_cart_id FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE ( table_entry_id = '".$_POST["tableid"]."' ) order by order_id desc limit 1 ");
		$count_table =mysql_num_rows($select_table);	
	}	
 
if($count_table==0) {

        $select_cart_id =db_query("SELECT max(order_cart_id) as cart_id , status,table_entry_id FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." GROUP BY `order_cart_id` order by order_id desc");
        $count = mysql_num_rows($select_cart_id);

        if($count>0){
         $rowcart_id = db_fetch_array($select_cart_id);
           if ($rowcart_id["status"] == "open") {
                if((($_POST["menuid"])==$rowcart_id["menuid"])&& (($_POST["tableid"])==$rowcart_id["table_entry_id"])) {
                     $cart_value = $rowcart_id["cart_id"];
                } else {
                    $cart_value = $rowcart_id["cart_id"]+1;
                }
           }
           else {
                    $cart_value = $rowcart_id["cart_id"]+1;
                }
        } else {
         $cart_value="1";
        }

    } else {
      $rowcart_table = db_fetch_array($select_table);
      $cart_value = $rowcart_table["order_cart_id"];
    }


$selectmenudetail=db_query("SELECT * FROM ". TABLE_HMS_MENUENTRY ." WHERE menu_id='".$menuid."'");
while($menudetail_data=db_fetch_array(selectmenudetail))
{
	
  $customerDetailsAdd = db_query( "INSERT INTO " .TABLE_HMS_RESTAURANT_ORDER_DETAILS. "(`order_id`,`cart_id`, `order_type`,`table_entry_id`,`order_posted_date`,`order_product`,`order_price`,`order_quantity`,`total_quantity`,`order_open_date` , `order_close_date`) VALUES ('','".$cart_value."','".$order_type."','".$table."', CURDATE() ,'".$menudetail_data["menu_name"]."','".$menudetail_data["price"]."','1','".$menudetail_data["price"]."')");
}
 }

 
function tableEntryFetchAllRecords() {

            $hms_info_fetch_allrec_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " ORDER BY `date_added`";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
}

?>