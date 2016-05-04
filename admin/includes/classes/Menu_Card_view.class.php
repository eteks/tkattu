<?php
class hmsInfo {

    function menuEntrySingRec() {

		$menuEntry_fetch_singrec_sql = "SELECT `menu_id`,`menu_name`,`price`,`tax`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_MENUENTRY . " WHERE `menu_id` = '" . $_GET["id"] ."'";
        $menuEntry_sing_records = db_query ($menuEntry_fetch_singrec_sql);
		$menu_entry_values     = db_fetch_array($menuEntry_sing_records);
        return $menu_entry_values;
    }

    function menuCategorySingRec() {

        $menuEntry = $this->menuEntrySingRec();
		$menuEntry_fetch_singrec_sql = "SELECT `hms_menu_category_id`,`hms_menu_category_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" .$menuEntry["menu_category_id"]."'";
        $menuEntry_sing_records = db_query ($menuEntry_fetch_singrec_sql);
		$menu_entry_values     = db_fetch_array($menuEntry_sing_records);
        return $menu_entry_values;
    }


}
?>