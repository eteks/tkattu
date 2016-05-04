<?php
    $department_entry_obj   = new hmsInfo();
    $departmentEntry_result = $department_entry_obj->departmentEntrySingRec($id);
    $departmentEntry_values = db_fetch_array($departmentEntry_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($departmentEntry_values["created_date"]);?></td>
                    </tr>
                    <?php if($departmentEntry_values["modified_date"] != "0000-00-00 00:00:00" && $departmentEntry_values["modified_date"] != "") { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($departmentEntry_values["modified_date"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="25%" class="tahoma12blackbold">Department Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes( $departmentEntry_values["department_creation_name"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($departmentEntry_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>