<?php
    $checkout_entry_obj        = new checkout();
    $student_user_all_result = $checkout_entry_obj->checkoutEntrySingRec();
    $student_user_values     = db_fetch_array($student_user_all_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
					<tr>
                        <td width="15%" class="tahoma12blackbold">Checkout Time:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["hms_checkout_time"]); echo ":00";?> Hours</td>
                    </tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($student_user_values["date_added"]);?></td>
                    </tr>
                    <?php if($student_user_values["date_modified"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($student_user_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($student_user_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>