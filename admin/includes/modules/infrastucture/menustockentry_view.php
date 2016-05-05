<?php
    $menustockentry_obj        = new hmsInfo();
    $menustockentry_all_result = $menustockentry_obj->occasionEntrySingRec();
    $menustockentry_values     = db_fetch_array($menustockentry_all_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td width="83%" class="tahoma11blacknormal"><?php echo date_long($menustockentry_values["mse_createdon"]);?></td>
                    </tr>
               
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Menu:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menustockentry_values["menu_name"]);?></td>
                    </tr>
                     <tr>
                        <td width="17%" class="tahoma12blackbold">Quantity:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menustockentry_values["mse_qty"]);?></td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</form>