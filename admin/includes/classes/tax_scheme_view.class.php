<?php
class hmsInfo {

    function taxSchemeSingRec() {

		$taxSchemeSingRec =  "SELECT `tax_scheme_id`,`tax_scheme_name`,`from_date`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_SCHEME . " WHERE `tax_scheme_id` = '" .$_GET["id"]."'";
        $taxSchemeSingRec_records = db_query ($taxSchemeSingRec);
        return $taxSchemeSingRec_records;
    }

    function getTaxInfoFetchAllRecords($taxInfoId) {

        $hms_info_fetch_allrec_sql = db_query ("SELECT `tax_info_id`,`tax_category_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO . " WHERE `tax_info_id` = '" . $taxInfoId . "'");
        return $hms_info_fetch_allrec_sql;
    }


}
?>