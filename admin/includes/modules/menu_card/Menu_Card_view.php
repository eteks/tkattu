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
                        <td width="17%" class="tahoma12blackbold">menu category:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menu_category_values["hms_menu_category_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="17%" class="tahoma12blackbold">menu name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($menu_entry_values["menu_name"]);?></td>
                    </tr>
                    
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($menu_entry_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>