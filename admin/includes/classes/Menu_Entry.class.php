<?php
class hmsInfo {

    function getMenuEntryTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`menu_category_id`) FROM " . TABLE_HMS_MENUENTRY ." ";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }
 
    function menuEntryFetchAllRecords($start_limit=0, $limit_rows=1) {   

            $hms_info_fetch_allrec_sql = "SELECT b.hms_menu_category_name, a.menu_id,a.menu_category_id,a.menu_name,a.depart_id,a.price,a.menu_price,a.actual_price,a.tax,a.active,a.date_added,a.date_modified,a.item_code FROM " .TABLE_HMS_MENUENTRY . "  a LEFT JOIN ".TABLE_HMS_MENUCATEGORY_CREATION." b ON a.menu_category_id=b.hms_menu_category_id ORDER BY menu_id DESC  LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function getMenuEntryTree ($MenuType_array = '') { 
        if ( !is_array( $MenuType_array ) )
            $MenuType_array = array();
        if ( ( sizeof( $MenuType_array ) < 1 ))
            $MenuType_array[] = array('id' => '0', 'text' => 'Select a Menu Category');
            $country_query = db_query("SELECT `hms_menu_category_id`,`hms_menu_category_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_MENUCATEGORY_CREATION. " WHERE `active` = 'Y' ORDER BY `date_added`");
            while($allMenuType = db_fetch_array($country_query)) {
                $MenuType_array[] = array('id' => $allMenuType['hms_menu_category_id'], 'text' => $allMenuType['hms_menu_category_name']);
            }
        return $MenuType_array;
    }

    function menuEntrySingRec() {

		$menuEntry_fetch_singrec_sql = "SELECT `menu_id`,`menu_category_id`,`hms_menu_sub_category_id`,`menu_name`,`item_code`,`depart_id`,`price`,`menu_price`,`menu_reorder_level`,`actual_price`,`active`,`date_added`,`date_modified` FROM " .TABLE_HMS_MENUENTRY . " WHERE `menu_id` = '" .$_GET["id"]."'";
        $menuEntry_sing_records = db_query ($menuEntry_fetch_singrec_sql);
		$Menu_entry_values     = db_fetch_array($menuEntry_sing_records);
        return $Menu_entry_values;
    }

    function MenuCategorySingRec($id) {

		$menuEntry_fetch_singrec_sql = "SELECT `hms_menu_category_id`,`hms_menu_category_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" . $id ."'";
        $menuEntry_sing_records = db_query ($menuEntry_fetch_singrec_sql);
		$Menu_type_values     = db_fetch_array($menuEntry_sing_records);
        return $Menu_type_values;
    }

function MenuEntryInsert(){ 
$get_categ_tax = "SELECT * FROM " .TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" . $_POST["menu_category"] . "'";
$get_tax_values = db_query ($get_categ_tax); 
if ($get_tax_values = db_fetch_array($get_tax_values)) {
            
$vat_t = $get_tax_values['vat_tax'];
 $ser_t = $get_tax_values['service_tax'];  

$vat_amt = 100*$vat_t/100;
$ser_amt = 100*$ser_t/100;

$tax_amount = $vat_amt+$ser_amt; 

$actual_price = 100+$tax_amount;  

$price  = $_POST["menu_price"]*100/$actual_price;        

$qtystatus = (isset($_POST["menu_reorder_level"]) && !empty($_POST["menu_reorder_level"]) && $_POST["menu_reorder_level"]!=0 ? 1:0);
$menuInsert=db_query("INSERT INTO " . TABLE_HMS_MENUENTRY. " (`menu_id`,`menu_category_id`,`menu_name`,`item_code`,`depart_id`,`price`,`menu_price`,`active`,`date_added`,`date_modified`,`Item_available_status`,`menu_reorder_level`,`menu_qty_status`) VALUES ( '" . $_POST["Menu_id"] . "', '" . $_POST["menu_category"] . "', '" . addslashes($_POST["menu_name"]) . "', '" . addslashes($_POST["item_code"]) . "', '" . addslashes($_POST["menu_dept"]) . "', '$price', '" . $_POST["menu_price"] . "', '" . $_POST["active"] . "', NOW(),'','1','" . $_POST["menu_reorder_level"] . "','".$qtystatus."')");

} 
return $menuInsert;
    } 
  
function menuEntryUpdate() { 
        $get_categ_tax = "SELECT * FROM " .TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" . $_POST["menu_category"] . "'";
$get_tax_values = db_query ($get_categ_tax); 
if ($get_tax_values = db_fetch_array($get_tax_values)) {
            
$vat_t = $get_tax_values['vat_tax'];
 $ser_t = $get_tax_values['service_tax'];  

$vat_amt = 100*$vat_t/100;
$ser_amt = 100*$ser_t/100;

$tax_amount = $vat_amt+$ser_amt; 

$actual_price = 100+$tax_amount;  

$price  = $_POST["menu_price"]*100/$actual_price;  
$qtystatus = (isset($_POST["menu_reorder_level"]) && !empty($_POST["menu_reorder_level"]) && $_POST["menu_reorder_level"]!=0 ? 1:0);
$newsupdate = db_query ("UPDATE " .TABLE_HMS_MENUENTRY . " SET `menu_category_id` = '" . addslashes($_POST["menu_category"]) . "', `menu_name` = '" . addslashes($_POST["menu_name"]) . "', `item_code` = '" . addslashes($_POST["item_code"]) . "',`depart_id` = '" . addslashes($_POST["menu_dept"]) . "',`price` = '".$price."' ,`menu_price` = '" . addslashes($_POST["menu_price"]). "' ,`menu_reorder_level` = '" . addslashes($_POST["menu_reorder_level"]). "',`menu_qty_status` = '" .$qtystatus. "' , `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `menu_id` = '" . (int)$_POST["id"] . "'");
}          
return $newsupdate;
    }

    function MenuEntryUpdateActive() {

        $menuUpdateActive_sql = "UPDATE " . TABLE_HMS_MENUENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `menu_id` = " . $_GET["id"] ;
        $menuUpdateActive_update = db_query ($menuUpdateActive_sql);
        return $menuUpdateActive_update;
    }

    function MenuEntryDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " .TABLE_HMS_MENUENTRY . " WHERE `menu_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteMenuTypeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " .TABLE_HMS_MENUENTRY . " WHERE `menu_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

function checkDuplicate($mode) {
        
  if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT * FROM " . TABLE_HMS_MENUENTRY. " WHERE lower(menu_name) = '".addslashes($_GET["menu_name"])."'  AND `item_code` = '" . $_GET["item_code"] . "' AND `menu_category_id` = '" . $_GET["menu_category"] . "'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        }  else if ($mode == 'update' && $_GET["id"]) { 
            $check_duplicate_sql1 = "SELECT * FROM " .TABLE_HMS_MENUENTRY . " WHERE lower(menu_name) = '".addslashes($_GET["menu_name"])."' AND menu_id!='".$_GET["id"]."' AND `item_code` = '" . $_GET["item_code"] . "' AND `menu_category_id` = '" . $_GET["menu_category"] . "'";
            $check_duplicate1 = db_query ($check_duplicate_sql1);
            if ( db_num_rows($check_duplicate1) ) return "0";
            else return "1";
        }
    }


function getsubMenuEntryTree($MenuType_array = '') {
         if ( !is_array( $MenuType_array ) )
            $MenuType_array = array();
        if ( ( sizeof( $MenuType_array ) < 1 ))
            $MenuType_array[] = array('id' => '0', 'text' => 'Select a Menu Category');
            $country_query = db_query("SELECT * FROM " . TABLE_HMS_MENUSUBCATEGORY_CREATION. "");
            while($allMenuType = db_fetch_array($country_query)) {
                $MenuType_array[] = array('id' => $allMenuType['hms_menu_sub_category_id'], 'text' => $allMenuType['hms_menu_sub_category_name']);
            }
        return $MenuType_array;
    }
function departmentname($id)
{
if($id==1)
$result = 'Kitchen Center';
if($id==2)
$result = 'Juice Center';
return $result;
}
    
    
   
}

?>