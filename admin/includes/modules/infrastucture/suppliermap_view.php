<?php
    $suppliermap_obj        = new hmsInfo();
    $suppliermap_all_result = $suppliermap_obj->occasionEntrySingRec();
    $suppliermap_values     = db_fetch_array($suppliermap_all_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td width="83%" class="tahoma11blacknormal"><?php echo date_long($suppliermap_values["date_added"]);?></td>
                    </tr>
                    <?php if($suppliermap_values["date_modified"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($suppliermap_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Table Type:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($suppliermap_values["table_type_name"]);?></td>
                    </tr>
                     <tr>
                        <td width="17%" class="tahoma12blackbold">Table:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($suppliermap_values["table_no"]);?></td>
                    </tr>
                     <tr>
                        <td width="17%" class="tahoma12blackbold">Supplier:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($suppliermap_values["supplier_name"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo ($suppliermap_values["active"]== 'Y' ? 'Active' : 'Deactive');?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>