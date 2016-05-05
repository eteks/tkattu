<?php
    $taxScheme_obj         = new hmsInfo();
    $taxScheme_all_result  = $taxScheme_obj->taxSchemeSingRec();
    $taxScheme_values   = db_fetch_array($taxScheme_all_result);
?>
<form name="frmInstructions">

    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($taxScheme_values["date_added"]);?></td>
                    </tr>
                    <?php if($taxScheme_values["date_modified"] !='0000-00-00 00:00:00' && $taxScheme_values["date_modified"]!='' )                      { ?>
                    <tr>
                        <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($taxScheme_values["date_modified"]);?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">Scheme Name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($taxScheme_values["tax_scheme_name"]);?></td>
                    </tr>

					
                    <tr>
                        <td width="15%" class="tahoma12blackbold">From Date:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo date_long($taxScheme_values["from_date"]);?></td>
                    </tr>
                    <tr>
                        <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?=($taxScheme_values["active"]== 'Y')? Active : Deactive;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>