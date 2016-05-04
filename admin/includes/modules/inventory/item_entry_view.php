<?php
    $item_obj        = new hmsInfo();
    $student_user_all_result = $item_obj->itemSingRec();
    $student_user_values     = db_fetch_array($student_user_all_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
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
                    
                    <!--<tr>
                        <td width="25%" class="tahoma12blackbold">Vendor Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["vendor_name"]);?></td>
                    </tr>-->
                    
                    
                    <tr>
                        <td width="25%" class="tahoma12blackbold">Item Entry Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["item_entry_name"]);?></td>
                    </tr>
                   	   <tr>
                        <td width="25%" class="tahoma12blackbold">Item Type Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["item_entry_type"]);?></td>
                    </tr>
                    
                    <tr>
                        <td width="25%" class="tahoma12blackbold">Unit:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["item_unit"]);?></td>
                    </tr>
                    <!--<tr>
                        <td width="25%" class="tahoma12blackbold">Price/Qty:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["standard_rate"]);?></td>
                    </tr>-->
                    <!--<tr>
                        <td width="25%" class="tahoma12blackbold">Purchased Qty:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["standard_qty"]);?></td>
                    </tr>-->
                    <!--<tr>
                        <td width="25%" class="tahoma12blackbold">Total Amount:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["item_maxqty"]);?></td>
                    </tr>-->
                   	
                   <!-- <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($student_user_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>-->
                </table>
            </td>
        </tr>
    </table>
</form>