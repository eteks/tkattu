<?php
    $room_type_obj   = new hmsInfo();
    $room_type_result = $room_type_obj->roomTypeEntrySingRec();
    $room_type_values = db_fetch_array($room_type_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td width="82%" class="tahoma11blacknormal"><?php echo date_long($room_type_values["date_added"]);?></td>
                    </tr>
                    <?php if($room_type_values["date_modified"] == "0000-00-00 00:00:00" && $room_type_values["date_modified"] == "") { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($room_type_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Room Type Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($room_type_values["room_type_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Facility:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($room_type_values["room_type_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Bed Size:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $room_type_values["bed_size"];?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Charge:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $room_type_values["charge"];?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Note:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $room_type_values["note"];?></td>
                    </tr> 
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($room_type_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>