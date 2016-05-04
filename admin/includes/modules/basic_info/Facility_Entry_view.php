<?php
    $facilityEntry_obj    = new hmsInfo();
    $facilityEntry_result = $facilityEntry_obj->facilityEntrySingRec();
    $facilityEntry_values = db_fetch_array($facilityEntry_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($facilityEntry_values["date_added"]);?></td>
                    </tr>
                    <?php if($facilityEntry_values["date_modified"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($facilityEntry_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Occasion Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes( $facilityEntry_values["hms_facility_entry_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Charge:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo "Rs." .$facilityEntry_values["hms_facility_charges"].".00";?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($facilityEntry_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>