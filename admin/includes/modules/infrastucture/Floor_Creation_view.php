<?php
    $floor_entry_obj   = new hmsInfo();
    $floorEntry_result = $floor_entry_obj->floorEntrySingRec($id);
    $floorEntry_values = db_fetch_array($floorEntry_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($floorEntry_values["created_date"]);?></td>
                    </tr>
                    <?php if($floorEntry_values["modified_date"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($floorEntry_values["modified_date"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Floor Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($floorEntry_values["floor_creation_name"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($floorEntry_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>