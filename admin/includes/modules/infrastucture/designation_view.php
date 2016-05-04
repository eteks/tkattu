<?php
    $designation_entry_obj   = new hmsInfo();
    $designationEntry_result = $designation_entry_obj->designationEntrySingRec($id);
    $designationEntry_values = db_fetch_array($designationEntry_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($designationEntry_values["created_date"]);?></td>
                    </tr>
                    <?php if($designationEntry_values["modified_date"] != "0000-00-00 00:00:00" && $designationEntry_values["modified_date"] != "") { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($designationEntry_values["modified_date"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="25%" class="tahoma12blackbold">Designation Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes( $designationEntry_values["designation_name"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($designationEntry_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>