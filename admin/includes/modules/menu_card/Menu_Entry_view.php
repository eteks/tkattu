<?php
    $menu_entry_obj     = new hmsInfo();
    $menu_entry_values  = $menu_entry_obj->menuEntrySingRec();
    $menu_category_values   = $menu_entry_obj->menuCategorySingRec();
  
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" >
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td width="83%" class="tahoma11blacknormal"><?php echo date_long($menu_entry_values["date_added"]);?></td>
                    </tr>
                    <?php if($menu_entry_values["date_modified"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($menu_entry_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Menu Category:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menu_category_values["hms_menu_category_name"]);?></td>
                    </tr>
                   
                    <tr>
                        <td width="17%" class="tahoma12blackbold">Menu Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menu_entry_values["menu_name"]);?></td>
                    </tr>
                     <tr>
                        <td width="17%" class="tahoma12blackbold">Item Code:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menu_entry_values["item_code"]);?></td>
                    </tr>
                     <tr>
                        <td width="17%" class="tahoma12blackbold">Menu Price:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menu_entry_values["menu_price"]);?></td>
                    </tr>
                     <tr>
                        <td width="17%" class="tahoma12blackbold">Menu Reorder Level:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menu_entry_values["menu_reorder_level"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo($menu_entry_values["active"]== 'Y') ? 'Active' : 'Deactive'; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>