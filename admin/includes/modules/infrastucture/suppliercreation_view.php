<?php
    $suppliercreation_obj        = new hmsInfo();
    $suppliercreation_all_result = $suppliercreation_obj->occasionEntrySingRec();
    $suppliercreation_values     = db_fetch_array($suppliercreation_all_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td width="83%" class="tahoma11blacknormal"><?php echo date_long($suppliercreation_values["date_added"]);?></td>
                    </tr>
                    <?php if($suppliercreation_values["date_modified"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($suppliercreation_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Supplier Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($suppliercreation_values["supplier_name"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo ($suppliercreation_values["active"]== 'Y' ? 'Active' : 'Deactive');?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>