<?php
    $hms_info_obj = new hmsInfo();
    $hms_info_all_result = $hms_info_obj->hmsInfoSingRec();
    $hms_info_values     = db_fetch_array($hms_info_all_result);
	//$countryName  = $student_user_obj->studentUserCountry($student_user_values["country_id"]);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($hms_info_values["hms_info_created_date"]);?></td>
                    </tr>
                    <?php if($hms_info_values["hms_info_created_date"]) { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($hms_info_values["hms_info_created_date"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Hotel Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo ucwords(stripslashes($hms_info_values["hms_info_name"]));?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Address:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo ucwords(stripslashes($hms_info_values["hms_info_address"]));?></td>

                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">City:&nbsp;</td>
                       <td class="tahoma11blacknormal"><?php echo ucwords(stripslashes($hms_info_values["hms_info_city"]));?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">State:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo  ucwords(stripslashes($hms_info_values["hms_info_state"]));?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Zip:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $hms_info_values["hms_info_zip"];?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Country:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo ucwords(stripslashes($hms_info_values["hms_info_country"]));?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Phone:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $hms_info_values["hms_info_phone"];?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Fax:&nbsp;</td>
                       <td class="tahoma11blacknormal"><?php echo $hms_info_values["hms_info_fax"];?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Email:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $hms_info_values["hms_info_email"];?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Website:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $hms_info_values["hms_info_url"];?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Active:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($hms_info_values["student_active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>