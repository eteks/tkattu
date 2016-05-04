<?php
    $room_obj    = new hmsInfo();
    $room_result = $room_obj->roomEntrySingRec();
    //$room_values = db_fetch_array($room_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td width="82%" class="tahoma11blacknormal"><?php echo date_long($room_result["date_added"]);?></td>
                    </tr>
                    <?php if($room_result["date_modified"] != "0000-00-00 00:00:00" && $room_result["date_modified"] != "") { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($room_result["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Room No:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $room_result["room_no"];?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Floor:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php
						$FloorRec    = $room_obj->FloorSingRec();
						echo stripslashes($FloorRec["floor_creation_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Room Type:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php
						$RoomTypeRec = $room_obj->RoomTypeSingRec();
						echo stripslashes($RoomTypeRec["room_type_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Adults:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($room_result["adults"]);?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Child:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($room_result["child"]);?></td>
                    </tr>
                    <tr>
                        <td width="18%" class="tahoma12blackbold">Smoking:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($room_result["smoking"]== 'Y')? Yes : No;?></td>
                    </tr> 
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($room_result["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>