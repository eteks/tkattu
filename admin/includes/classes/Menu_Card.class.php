<?php
class hmsInfo {
//new
    function MenuCategoryAllRec() {

        $menuEntry_fetch_singrec_sql = "SELECT `hms_menu_category_id`,`hms_menu_category_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `active` = 'Y'";
        $menuEntry_sing_records = db_query ($menuEntry_fetch_singrec_sql);
            while($allMenuType = db_fetch_array($menuEntry_sing_records)) {
                $MenuType_array[] = array('id' => $allMenuType['hms_menu_category_id'], 'text' => $allMenuType['hms_menu_category_name']);
            }
        return $MenuType_array;
    }

    function menuCardInsert() {

        $menuCardInsert=db_query ("INSERT INTO " . TABLE_HMS_MENU_CARD. " (`menu_card_id`,`menu_card_name`,`active`,`date_added`,`date_modified`) VALUES ('','" .addslashes($_POST["menu_card_name"]) . "','Y',now(),'')");
        $menuCardID = db_insert_id();
        for($i=0;$i<count($_POST["qty"]);$i++) {
            $qty1[] = $_POST["qty1"][$i];
            $qty2 = explode("_", $qty1[$i]);
                if($_POST["qty"][$i]!=0){
                    $menuInsert=db_query ("INSERT INTO " . TABLE_HMS_MENU_CARD_SELECTION. " ( `menu_card_selection_id`,`menu_card_id`,`menu_id`,`menu_category_id`,`quty`,`price`) VALUES ( '','" . $menuCardID . "', '" . $qty2[1] . "', '" . $qty2[0] . "','".$_POST["qty"][$i]."','".$_POST["price"][$i]."')");
                }
        }
    }

    function menuEntryAllRecords() {

        $menuEntryAllRecords = "SELECT `menu_id`,`menu_category_id`,`menu_name`,`price`,`item_code`,`menu_price`,`tax`,`menu_price`,`active`,`date_added`,`date_modified`,`Item_available_status` FROM " .TABLE_HMS_MENUENTRY . " ORDER BY `menu_name`";
        $menuEntryAllRecords_query = db_query ($menuEntryAllRecords);
        return $menuEntryAllRecords_query;
    }

    function getMenuCardTotalRecords() {

        $hms_info_total_rows_sql = "SELECT count(`menu_card_id`) FROM " . TABLE_HMS_MENU_CARD ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function MenuCardFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `menu_card_id`,`menu_card_name`,`active`,`date_added`,`date_modified` FROM " .TABLE_HMS_MENU_CARD . " ORDER BY `menu_card_name` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function MenuCardUpdateActive() {

        $MenuCardUpdateActive_sql = "UPDATE " . TABLE_HMS_MENU_CARD. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `menu_card_id` = " . $_GET["id"] ;
        $MenuCardUpdateActive_update = db_query ($MenuCardUpdateActive_sql);
        return $MenuCardUpdateActive_update;
    }

    function MenuCardDelete() {

        if (not_null($_GET["id"])) {
           $MenuCardSelectionDelete = db_query ("DELETE FROM " .TABLE_HMS_MENU_CARD_SELECTION . " WHERE `menu_card_id` = '" . $_GET["id"] . "'");
           $MenuCardDelete          = db_query ("DELETE FROM " .TABLE_HMS_MENU_CARD . " WHERE `menu_card_id` = '" . $_GET["id"] . "'");
        }
    }

    function deleteMenuCardMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
               $MenuCardSelectionDelete = db_query ("DELETE FROM " .TABLE_HMS_MENU_CARD_SELECTION . " WHERE `menu_card_id` = '" . $newsletter_manage_ids . "'");
               $MenuCardDelete = db_query ("DELETE FROM " .TABLE_HMS_MENU_CARD . " WHERE `menu_card_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function MenuCardUpdate() {

        for($i=0;$i<count($_POST["qty"]);$i++) {
            $qty1[] = $_POST["qty1"][$i];
            $qty2 = explode("_", $qty1[$i]);
                if($_POST["qty"][$i]!=0){
                    $menuInsert=db_query ("UPDATE " . TABLE_HMS_MENU_CARD_SELECTION . " SET ( `menu_card_selection_id`,`menu_card_id`,`menu_id`,`menu_category_id`,`quty`,`price`) VALUES ( '','" . $_POST["id"] . "', '" . $qty2[1] . "', '" . $qty2[0] . "','".$_POST["qty"][$i]."','".$_POST["price"][$i]."')");
                }
        }
    }

    function checkDuplicate($mode) {

        if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT `menu_card_id` FROM " .TABLE_HMS_MENU_CARD . " WHERE `menu_card_name` = '" . $_GET["menu_card_name"] . "'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        } 
    }


//function getMenucategoryTree(){
//	 $filtervalues=db_query("SELCT * FROM ".TABLE_HMS_MENUCATEGORY_CREATION." WHERE active='Y' ");
//	 
//	
//}

//new end

//function updatestatus(){
//
//$menustatus=db_query ("UPDATE " . TABLE_HMS_MENUENTRY . " SET (`Item_available_status`) VALUES ('1') WHERE menu_id='15'");
//
//}


}
?>