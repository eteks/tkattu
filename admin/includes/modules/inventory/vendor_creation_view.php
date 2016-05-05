<?php
    $vendor_obj    = new hmsInfo();
    $vendor_result = $vendor_obj->vendorSingRec();
    $vendor_values = db_fetch_array($vendor_result);
?>

<form name="frmInstructions">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="4" width="100%">
        <tr>
          <td width="15%" class="tahoma12blackbold">Date Added :&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo date_long($vendor_values["date_added"]);?></td>
        </tr>
        <?php if($vendor_values["date_modified"] !='0000-00-00 00:00:00' && $vendor_values["date_modified"]!='' ) { ?>
        <tr>
          <td class="tahoma12blackbold" >Date Modified :&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo date_long($vendor_values["date_modified"]);?></td>
        </tr>
        <?php } ?>
        <tr>
          <td width="15%" class="tahoma12blackbold">Vendor Name:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo stripslashes(ucwords($vendor_values["vendor_name"]));?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">Address:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo stripslashes(ucwords($vendor_values["vendor_address"]));?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">City:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo stripslashes(ucwords($vendor_values["vendor_city"]));?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">State:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo stripslashes(ucwords($vendor_values["vendor_state"]));?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">Country:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo stripslashes(ucwords($vendor_values["vendor_country"]));?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">Zip:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo $vendor_values["vendor_zip"];?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">Phone:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo $vendor_values["vendor_phone"];?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">Mobile:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo $vendor_values["vendor_mobile"];?></td>
        </tr>
        <tr>
          <td width="15%" class="tahoma12blackbold">Contact Person:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php echo stripslashes(ucwords($vendor_values["vendor_contact"]));?></td>
        </tr>
        <!--<tr>
          <td width="15%" class="tahoma12blackbold">Item Id:&nbsp;</td>
          <td class="tahoma11blacknormal"><?php //echo $vendor_values["item_id"];?></td>
        </tr>-->
        <tr>
          <td class="tahoma12blackbold" valign="top">Status:&nbsp;</td>
          <td class="tahoma11blacknormal"><?=($vendor_values["active"]== 'Y')? Active : Deactive;?></td>
        </tr>
      </table></td>
  </tr>
  </table>
</form>
