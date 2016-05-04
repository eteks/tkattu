<?php
    $servicesEntry_obj    = new hmsInfo();
    $servicesEntry_result = $servicesEntry_obj->servicesEntrySingRec();
    $servicesEntry_values = db_fetch_array($servicesEntry_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($servicesEntry_values["date_added"]);?></td>
                    </tr>
                     <?php if($student_user_values["date_modified"] !='0000-00-00 00:00:00' && $student_user_values["date_modified"]!='' ) { ?>
                    <tr>
					
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($servicesEntry_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Department:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($servicesEntry_values["hms_services_entry_department"]);?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Services Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($servicesEntry_values["hms_services_entry_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Charge:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo "Rs." .$servicesEntry_values["hms_services_entry_charges"].".00";?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($servicesEntry_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>