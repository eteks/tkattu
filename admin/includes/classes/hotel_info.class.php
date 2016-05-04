<?php
class hmsInfo {
//hms info

    function hmsInfoInsert( $upload_banner_image, $upload_banner_image_tmp_name ) {

        $upload_banner_image_extension = get_image_extension($upload_banner_image);
        $upload_banner_image_extension = strtolower($upload_banner_image_extension);
        if ($_POST["active"] == 'Y'){
            $banner_update_sql = "UPDATE " . TABLE_HMS_INFO . " SET `active` = 'N' WHERE `hms_info_id` = '" . $_POST["banner_page"] . "'";
            $banner_update     = db_query($banner_update_sql);
        }
        $banner_insert_sql = "INSERT INTO " . TABLE_HMS_INFO . " ( `hms_info_id`,`hms_info_name`,`hms_info_address`,`hms_info_city`,`hms_info_state`,`hms_info_zip`, `hms_info_country`,`hms_info_phone`,`hms_info_fax`,`hms_info_email`,`hms_info_url`,`hms_info_extension`,`hms_info_active`,`hms_info_created_date`,`hms_info_modify_date`) VALUES('','" . addslashes($_POST["hms_info_name"]) . "','" . addslashes($_POST["hms_info_address"]) . "','" . addslashes( $_POST["hms_info_city"] ) . "','" . addslashes( $_POST["hms_info_state"] ) . "','$_POST[hms_info_zip]','" . addslashes( $_POST["hms_info_country"] ) . "','$_POST[hms_info_phone]','$_POST[hms_info_fax]','$_POST[hms_info_email]','$_POST[hms_info_url]','".$upload_banner_image_extension."','$_POST[hms_info_active]',now(),'')";
        $banner_insert     = db_query ($banner_insert_sql);
        /*$banner_insert_id  = db_insert_id();
        $banner_image_name = $banner_insert_id . "." . $upload_banner_image_extension;
        move_uploaded_file ($upload_banner_image_tmp_name, DIR_FS_BANNER_UPLOADS . $banner_image_name);
        if (file_exists(DIR_FS_BANNER_UPLOADS . $banner_image_name) ) {
            $banner_thumb = DIR_FS_BANNER_UPLOADS . $banner_insert_id . "_thumb." . $upload_banner_image_extension;
            copy(DIR_FS_BANNER_UPLOADS . $banner_image_name, $banner_thumb);
            create_thumbnail_image($banner_thumb, B_THUMB_IMAGE_WIDTH, B_THUMB_IMAGE_HEIGHT);
        }*/
    }

    function hmsInfoUpdate() {

        $hmsInfoUpdate = db_query ("UPDATE " . TABLE_HMS_INFO . 
        " SET 
            `hms_info_name`        = '" . addslashes($_POST["hms_info_name"]) . "' ,
            `hms_info_address`     = '" . addslashes($_POST["hms_info_address"]) . "' ,
            `hms_info_city`        = '" . addslashes( $_POST["hms_info_city"] ) . "' ,
            `hms_info_state`       = '" . addslashes( $_POST["hms_info_state"] ) . "' ,
            `hms_info_zip`         = '" . addslashes( $_POST["hms_info_zip"] ) . "' ,
            `hms_info_country`     = '" . $_POST["country"] . "' ,
            `hms_info_phone`       = '" . $_POST["hms_info_phone"] . "' ,
            `hms_info_fax`         = '" . $_POST["hms_info_fax"] . "' ,
            `hms_info_email`       = '" . $_POST["hms_info_email"] . "',
            `hms_info_url`         = '" . $_POST["hms_info_url"] . "' ,
            `hms_info_active`      = '" . $_POST["hms_info_active"] . "' ,
            `hms_info_modify_date` = NOW() 
        WHERE `hms_info_id` = '". $_POST["id"] . "'");
        return $hmsInfoUpdate;
    }


    function getHotelInfoTotalRecords() {

            $hms_info_total_rows_sql = "SELECT count(`hms_info_id`) FROM " . TABLE_HMS_INFO ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);

        return db_result($hms_info_rows_result,0);
    }

    function HotelInfoFetchAllRecords($start_limit=0, $limit_rows=1) {

       $hms_info_fetch_allrec_sql = "SELECT `hms_info_id`,`hms_info_name`,`hms_info_address`,`hms_info_city`,`hms_info_state`,`hms_info_zip`,`hms_info_country`,`hms_info_phone`,`hms_info_fax`,`hms_info_email`,`hms_info_url`,`hms_info_extension`,`hms_info_active`,`hms_info_created_date`,`hms_info_modify_date` FROM " . TABLE_HMS_INFO . " ORDER BY `hms_info_created_date` LIMIT " . $start_limit . ", ". $limit_rows ."";
       $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
       return $hms_info_all_records;
    }

    function getHmsInfoUpdateActive() {

        $HmsInfo_update_sql = "UPDATE " . TABLE_HMS_INFO . " SET `hms_info_active` = '" . $_GET["value"] . "', `hms_info_modify_date` = NOW() WHERE `hms_info_id` = '" . $_GET["id"] . "'";
        $HmsInfo_update = db_query($HmsInfo_update_sql);
    }

    function hmsInfoDelete() {

        if (not_null($_GET["id"])) {
           $hmsInfoDelete = db_query ("DELETE FROM " . TABLE_HMS_INFO . " WHERE `hms_info_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteHmsInfoManageMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_INFO . " WHERE `hms_info_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function hmsInfoSingRec() {

        $student_user_fetch_singrec_sql = "SELECT `hms_info_id`,`hms_info_name`,`hms_info_address`,`hms_info_city`,`hms_info_state`,`hms_info_zip`,`hms_info_country`,`hms_info_phone`,`hms_info_fax`,`hms_info_email`,`hms_info_url`,`hms_info_extension`,`hms_info_active`,`hms_info_created_date`,`hms_info_modify_date` FROM " . TABLE_HMS_INFO . " WHERE `hms_info_id` = '" .$_GET["id"]."'";
        $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
        return $student_user_sing_records;
    }

//hms info

}
?>