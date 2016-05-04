<?php
    $table_type_obj        = new hmsInfo();
    $table_type_all_result = $table_type_obj->occasionEntrySingRec();
    $table_type_values     = db_fetch_array($table_type_all_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td width="83%" class="tahoma11blacknormal"><?php echo date_long($table_type_values["date_added"]);?></td>
                    </tr>
                    <?php if($table_type_values["date_modified"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($table_type_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Table Type Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($table_type_values["table_type_name"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo ($table_type_values["active"]== 'Y' ? 'Active' : 'Deactive');?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>