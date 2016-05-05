<?php
class hmsparameter {

    function hmsParameterInsert() {
	
	  if ($_POST["hms_active"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_PARAMETER_ENTRY . " SET `hms_active` = 'N' WHERE `hms_parameter_id` != '" .        $_GET[ "id"] . "'";
            $banner_update = db_query($banner_update_sql);

        $parameter_insert_sql = "INSERT INTO " . TABLE_HMS_PARAMETER_ENTRY . " ( `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active`) VALUES('','" . addslashes($_POST["hms_hotel_name"]) . "','" . addslashes($_POST["hms_address1"]) . "','" . addslashes($_POST["hms_address2"]) . "','" . addslashes( $_POST["hms_city"] ) . "','" . addslashes( $_POST["hms_state"] ) . "','" . addslashes( $_POST["hms_country"] ) . "','" .$_POST["hms_pincode"]. "','".$_POST["hms_phone_no"]."','" . addslashes($_POST["hms_url"]) . "','" . addslashes($_POST["hms_email"]) . "','" . addslashes($_POST["hms_footertxt"]) . "',now(),'','".$_POST["hms_active"]."')";
        $parameter_insert = db_query ($parameter_insert_sql);
    }
       else {
    $parameter_insert_sql = "INSERT INTO " . TABLE_HMS_PARAMETER_ENTRY . " ( `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active`) VALUES('','" . addslashes($_POST["hms_hotel_name"]) . "','" . addslashes($_POST["hms_address1"]) . "','" . addslashes($_POST["hms_address2"]) . "','" . addslashes( $_POST["hms_city"] ) . "','" . addslashes( $_POST["hms_state"] ) . "','" . addslashes( $_POST["hms_country"] ) . "','" .$_POST["hms_pincode"]. "','".$_POST["hms_phone_no"]."','" . addslashes($_POST["hms_url"]) . "','" . addslashes($_POST["hms_email"]) . "','" . addslashes($_POST["hms_footertxt"]) . "',now(),'','".$_POST["hms_active"]."')";
        $parameter_insert = db_query ($parameter_insert_sql);
		}
		}

    function hmsParameterUpdate() {
	
	  if ($_POST["hms_active"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_PARAMETER_ENTRY . " SET `hms_active` = 'N' WHERE `hms_parameter_id` != '" . $_GET["id"] . "'";
            $banner_update = db_query($banner_update_sql);

   $hmsParameterUpdate = db_query ("UPDATE " .TABLE_HMS_PARAMETER_ENTRY . " SET 
            `hms_hotel_name`   = '" . addslashes($_POST["hms_hotel_name"]) . "' ,
            `hms_address1`     = '" . addslashes($_POST["hms_address1"]) . "' ,
            `hms_address2`     = '" . addslashes( $_POST["hms_address2"] ) . "' ,
            `hms_city`         = '" . addslashes( $_POST["hms_city"] ) . "' ,
            `hms_state`        = '" . addslashes( $_POST["hms_state"] ) . "' ,
            `hms_country`      = '" . $_POST["hms_country"] . "' ,
            `hms_pincode`      = '" . $_POST["hms_pincode"] . "' ,
            `hms_phone_no`     = '" . $_POST["hms_phone_no"] . "' ,
                `hms_cell_no`      = '" . $_POST["hms_cell_no"] . "' ,
            `hms_tin_no`      = '" . $_POST["hms_tin_no"] . "' ,
            `hms_stc`     = '" . $_POST["hms_stc"] . "' ,
            `hms_url`          = '" . $_POST["hms_url"] . "',
            `hms_email`        = '" . $_POST["hms_email"] . "' ,
            `hms_footertxt`    = '" . $_POST["hms_footertxt"] . "' ,
            `date_modified` = NOW(),
			 `hms_active`   = '" . $_POST["hms_active"] . "'
             WHERE `hms_parameter_id` = '". $_POST["id"] . "'");
            return $hmsParameterUpdate;
    }
	else
	{
	     $hmsParameterUpdate = db_query ("UPDATE " .TABLE_HMS_PARAMETER_ENTRY . " SET 
            `hms_hotel_name`   = '" . addslashes($_POST["hms_hotel_name"]) . "' ,
            `hms_address1`     = '" . addslashes($_POST["hms_address1"]) . "' ,
            `hms_address2`     = '" . addslashes( $_POST["hms_address2"] ) . "' ,
            `hms_city`         = '" . addslashes( $_POST["hms_city"] ) . "' ,
            `hms_state`        = '" . addslashes( $_POST["hms_state"] ) . "' ,
            `hms_country`      = '" . $_POST["hms_country"] . "' ,
            `hms_pincode`      = '" . $_POST["hms_pincode"] . "' ,
            `hms_phone_no`     = '" . $_POST["hms_phone_no"] . "' ,
                `hms_cell_no`      = '" . $_POST["hms_cell_no"] . "' ,
            `hms_tin_no`      = '" . $_POST["hms_tin_no"] . "' ,
            `hms_stc`     = '" . $_POST["hms_stc"] . "' ,
            `hms_url`          = '" . $_POST["hms_url"] . "',
            `hms_email`        = '" . $_POST["hms_email"] . "' ,
            `hms_footertxt`    = '" . $_POST["hms_footertxt"] . "' ,
            `date_modified` = NOW(),
			 `hms_active`   = '" . $_POST["hms_active"] . "'
             WHERE `hms_parameter_id` = '". $_POST["id"] . "'");
            return $hmsParameterUpdate;
			}
			}
		

    function getParameterInfoTotalRecords() {

            $hms_parameter_total_rows_sql = "SELECT count(`hms_parameter_id`) FROM " . TABLE_HMS_PARAMETER_ENTRY ."";
            $hms_parameter_rows_result = db_query($hms_parameter_total_rows_sql);

        return db_result($hms_parameter_rows_result,0);
    }

    function ParameterFetchAllRecords($start_limit=0, $limit_rows=1) {

       $hms_info_fetch_allrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active` FROM " .TABLE_HMS_PARAMETER_ENTRY  . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
       $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
       return $hms_info_all_records;
    }

    function getHmsParameterUpdateActive() {
	  if ($_GET["value"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_PARAMETER_ENTRY . " SET `hms_active` = 'N' WHERE `hms_parameter_id` != '" . $_GET[ "id"] . "'";
            $banner_update = db_query($banner_update_sql);
			
        $HmsParameter_update_sql = "UPDATE " .TABLE_HMS_PARAMETER_ENTRY  . " SET `hms_active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_parameter_id` = '" . $_GET["id"] . "'";
        $HmsParameter_update = db_query($HmsParameter_update_sql);
    }
	else {
	 $HmsParameter_update_sql = "UPDATE " .TABLE_HMS_PARAMETER_ENTRY  . " SET `hms_active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_parameter_id` = '" . $_GET["id"] . "'";
        $HmsParameter_update = db_query($HmsParameter_update_sql);
		}
		}
	
	

    function hmsParameterDelete() {

        if (not_null($_GET["id"])) {
           $hmsParameterDelete = db_query ("DELETE FROM " .TABLE_HMS_PARAMETER_ENTRY  . " WHERE `hms_parameter_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteHmsParameterManageMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " .TABLE_HMS_PARAMETER_ENTRY  . " WHERE `hms_parameter_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function parameterEntrySingRec() {

       $student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active` FROM " .TABLE_HMS_PARAMETER_ENTRY  . " WHERE `hms_parameter_id` = '". $_GET["id"] ."'";
	   //exit;
        $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
        return $student_user_sing_records;
    }

//hms info

}
?>