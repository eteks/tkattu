<?php
    $item_obj        = new hmsInfo();
    $student_user_all_result = $item_obj->itemSingRec();
    $student_user_values     = db_fetch_array($student_user_all_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($student_user_values["date_added"]);?></td>
                    </tr>
                    <?php if($student_user_values["date_modified"] !='0000-00-00 00:00:00' && $student_user_values["date_modified"]!='' ) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($student_user_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Item Type Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["item_type_name"]);?></td>
                    </tr>
                   		
						<tr>
                        <td width="15%" class="tahoma12blackbold">Ingredient:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?= ($student_user_values["ingredient"]=='Y')?Y:N;?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($student_user_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>