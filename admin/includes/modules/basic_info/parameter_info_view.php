<?php
    $parameterEntry_obj    = new hmsparameter();
    $parameterEntry_result = $parameterEntry_obj->parameterEntrySingRec();
    $parameterEntry_values = db_fetch_array($parameterEntry_result);
?>
<form name="frmInstructions">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="4" width="100%">     
             <tr>
               <td align="center" class="tahoma12blackbold"><?php echo stripslashes( $parameterEntry_values["hms_hotel_name"]);?>
	           ,</td>
             </tr>
			<tr>
                 <td align="center" class="tahoma12blackbold"><?php echo stripslashes( $parameterEntry_values["hms_address1"]);?>                 ,<?php echo stripslashes( $parameterEntry_values["hms_address2"]);?>,<?php echo stripslashes( $parameterEntry_values["hms_city"]);?>-<?php echo stripslashes( $parameterEntry_values["hms_pincode"]);?>, </td>
               </tr>
			  <tr>
                    <td align="center" class="tahoma12blackbold"><?php echo stripslashes( $parameterEntry_values["hms_state"]);?>                    ,<?php echo stripslashes( $parameterEntry_values["hms_country"]);?>,</td>
                  </tr>
				<tr>
                    <td align="center" class="tahoma12blackbold">PhoneNo: <?php echo stripslashes( $parameterEntry_values["hms_phone_no"]);?> ,</td>
                  </tr>
			 
	   <tr>        
	   <td align="center" class="tahoma12blackbold">Url: <?php echo stripslashes( $parameterEntry_values["hms_url"]);?> ,Email: <?php echo stripslashes( $parameterEntry_values["hms_email"]);?>.</td>   
       </tr>
	  <tr>     
	        <td height="27" align="center" class="tahoma12blackbold">================================================================================</td>           
            </tr>			 
	              <tr>
	                <td height="183" align="center" class="tahoma12blackbold">&nbsp;</td>
                  </tr>
	              <tr>
	                <td align="center" class="tahoma12blackbold">================================================================================</td>
                  </tr>
	              <tr>
		         <td align="center" class="tahoma12blackbold"><?php echo stripslashes( $parameterEntry_values["hms_footertxt"]);?>                 </td>
                </tr>
              </table>
            </td>
        </tr>
        </table>
</form>