<?php
    $tax_obj        = new hmsInfo();
    $student_user_all_result = $tax_obj->taxSingRec();
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
					<?php /*?>	<tr>
                        <td width="15%" class="tahoma12blackbold">tax_category_name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php 
						$sql="SELECT * FROM  ". TABLE_HMS_TAX_SCHEME." WHERE tax_scheme_id='".$student_user_values["tax_category_id"]."'";
						$sql_result=mysql_query($sql);
						while($data_result=mysql_fetch_array($sql_result))
						{
						echo $data_result["tax_scheme_name"];
						}
						?></td>
                    </tr><?php */?>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">tax_info_name:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo stripslashes($student_user_values["tax_info_name"]);?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tahoma12blackbold">charge:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $student_user_values["charge"];?>.00%</td>
                    </tr>

					 <tr>
                        <td width="15%" class="tahoma12blackbold">live:&nbsp;</td>
                        <td class="tahoma11blacknormal"><?php echo $student_user_values["live"];?></td>
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