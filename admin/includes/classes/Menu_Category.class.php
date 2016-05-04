<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`hms_menu_category_id`) FROM " . TABLE_HMS_MENUCATEGORY_CREATION ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `hms_menu_category_id`,`hms_menu_category_name`, `vat_tax`, `service_tax`, `taxable`,`active`,`date_added`,`date_modified`,session FROM " . TABLE_HMS_MENUCATEGORY_CREATION. " ORDER BY hms_menu_category_id DESC LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function menucaegorySingRec() {

		$menucategory_fetch_singrec_sql =  "SELECT `hms_menu_category_id`,`hms_menu_category_name`, `vat_tax`, `service_tax`, `taxable`,`active`,`date_added`,`date_modified`,session,hms_menu_icon,hms_menu_icon_active FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" .$_GET["id"]."'";
        $menucategory_sing_records = db_query ($menucategory_fetch_singrec_sql);
        return $menucategory_sing_records;
    }

    function menucategoryInsert() { 
        
        $normalicon=$_FILES['normalicon']['name'];
        $activeicon=$_FILES['activeicon']['name'];
            if ($normalicon)  
            {
                    $normaliconname = stripslashes($_FILES['normalicon']['name']);

                            $normaliconaltname = mt_rand().$_FILES['normalicon']['name'];
                            $path = "../images/categoryicon/".$normaliconaltname;
                            $copied = copy($_FILES['normalicon']['tmp_name'], $path);
                            if (!$copied) 
                            { 
                                    echo '<h1>Copy unsuccessfull!</h1>';$errors=1;
                            }

            }
            if ($activeicon)  
            {
                    $activeiconname = stripslashes($_FILES['activeicon']['name']);

                            $activeiconaltname = mt_rand().$_FILES['activeicon']['name'];
                            $path = "../images/categoryicon/".$activeiconaltname;
                            $copied = copy($_FILES['activeicon']['tmp_name'], $path);
                            if (!$copied) 
                            { 
                                    echo '<h1>Copy unsuccessfull!</h1>';$errors=1;
                            }

            }
		if (isset($_POST["taxable"]) && $_POST["taxable"] = "YES") $taxable = $_POST["taxable"];
		else $taxable = "NO";
        $menucategoryInsert=db_query ("INSERT INTO " . TABLE_HMS_MENUCATEGORY_CREATION. " ( `hms_menu_category_id`,`hms_menu_category_name`, `vat_tax`, `service_tax`, `taxable`,`active`,`date_added`,`date_modified`,session,hms_menu_icon,hms_menu_icon_active) VALUES ( '', '" . addslashes( $_POST["menucategory_name"] ) . "', '" . $_POST["vat_tax"] . "', '" . $_POST["service_tax"] . "', '" . $taxable . "','" . $_POST["active"] . "', NOW(),'','".$_POST['menu_session']."','".$normaliconaltname."','".$activeiconaltname."')");
        return $menucategoryInsert;
	}

    function menucategoryUpdate() {
       
        $normalicon=$_FILES['normalicon']['name'];
        $activeicon=$_FILES['activeicon']['name'];
        
        $result = db_query("SELECT hms_menu_icon,hms_menu_icon_active FROM ".TABLE_HMS_MENUCATEGORY_CREATION." WHERE hms_menu_category_id='".$_POST["id"]."'"); 
        
        
        if ($normalicon)  
        {  
            if(db_num_rows($result) > 0)
            {
            $row = db_fetch_array($result);
            if($row['hms_menu_icon']!='')
            unlink("../images/categoryicon/".$row['hms_menu_icon']);
            } 
           
                $normaliconname = stripslashes($_FILES['normalicon']['name']);

                        $normaliconaltname = mt_rand().$_FILES['normalicon']['name'];
                        $path = "../images/categoryicon/".$normaliconaltname;
                        $copied = copy($_FILES['normalicon']['tmp_name'], $path);
                        if (!$copied) 
                        { 
                                echo '<h1>Copy unsuccessfull!</h1>';$errors=1;
                        }

        }
        
        else
        $normaliconaltname = $_POST['normaliconedit']; 
        if ($activeicon)  
        {
            
            if(db_num_rows($result) > 0)
            {
            $row = db_fetch_array($result);
            if($row['hms_menu_icon_active']!='')
            unlink("../images/categoryicon/".$row['hms_menu_icon_active']);
            } 
           
                $activeiconname = stripslashes($_FILES['activeicon']['name']);

                        $activeiconaltname = mt_rand().$_FILES['activeicon']['name'];
                        $path = "../images/categoryicon/".$activeiconaltname;
                        $copied = copy($_FILES['activeicon']['tmp_name'], $path);
                        if (!$copied) 
                        { 
                                echo '<h1>Copy unsuccessfull!</h1>';$errors=1;
                        }

        }
        else
        $activeiconaltname = $_POST['activeiconedit'];
        
        
        $menuselect = db_query("SELECT * FROM " . TABLE_HMS_MENUENTRY. " WHERE 	menu_category_id='".(int)$_POST["id"]."'");
                      
        while($row = db_fetch_array($menuselect)){
            
            $vat_amt = 100*$_POST["vat_tax"]/100;
            $ser_amt = 100*$_POST["service_tax"]/100;
            $tax_amount = $vat_amt+$ser_amt; 
            $actual_price = 100+$tax_amount;  
            $price  = ($row["menu_price"])*100/$actual_price;  
          
           $menuupdate = db_query("UPDATE " .TABLE_HMS_MENUENTRY . " SET `price` = '".$price."' , `date_modified` = NOW() WHERE `menu_id` = '".$row["menu_id"]."'"); 
  }
       $newsupdate = db_query ("UPDATE " . TABLE_HMS_MENUCATEGORY_CREATION . " SET session='".$_POST['menu_session']."',`hms_menu_category_name` = '" . addslashes( $_POST["menucategory_name"] ) . "', `vat_tax`= '" . $_POST["vat_tax"] . "', `service_tax`= '" . $_POST["service_tax"] . "', `taxable`='" . $_POST["taxable"] . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW(),hms_menu_icon='".$normaliconaltname."',hms_menu_icon_active='".$activeiconaltname."' WHERE `hms_menu_category_id` = '" . (int)$_POST["id"] . "'");
       return $newsupdate;
    }

    function menucategoryUpdateActive() {

        $menucategoryUpdateActive_sql = "UPDATE " . TABLE_HMS_MENUCATEGORY_CREATION. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_menu_category_id` = " . $_GET["id"] ;
        $menucategoryUpdateActive_update = db_query ($menucategoryUpdateActive_sql);
        return $menucategoryUpdateActive_update;
    }

    function menucategoryDelete() {

        if (not_null($_GET["id"])) {
            
           $result = db_query("SELECT hms_menu_icon,hms_menu_icon_active FROM ".TABLE_HMS_MENUCATEGORY_CREATION." WHERE hms_menu_category_id='".$_GET["id"]."'");  
           if(db_num_rows($result) > 0)
            {
            $row = db_fetch_array($result);
            if($row['hms_menu_icon']!='')
            unlink("../images/categoryicon/".$row['hms_menu_icon']);
            if($row['hms_menu_icon_active']!='')
            unlink("../images/categoryicon/".$row['hms_menu_icon_active']);
            } 
           
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletemenucategoryMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>