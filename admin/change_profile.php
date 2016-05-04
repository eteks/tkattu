<?
require_once ("includes/application_top.php");
checklogin();
$module_title = "Change Password";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=PROJECT_NAME?> : <? echo $module_title?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="js/common.js"></script>
<script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
<script language="javascript" type="text/javascript" src="js/change_profile.js"></script>
<script language="javascript" type="text/javascript" src="js/floating_layer.js"></script>
</head>
<? require_once(FILENAME_FLOATING_LAYER);?>
<body onLoad="javascript:setfocus(document.frmChangeProfile.username);validatePresent(document.frmChangeProfile.username, 'error_username');">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="3">
          <table cellpadding="0" cellspacing="0" width="100%">
            <?
            require_once (DIR_WS_INCLUDES . 'header.php');  
            require_once (DIR_WS_INCLUDES . 'header_bottom.php'); 
            ?>
         </table>
        </td>
      </tr>
     <!-- content -->
      <tr>
     <!-- leftnav -->
     <td style="padding-top:4px;">
<table width="100%"  class="table_outer_border" cellpadding="0" cellspacing="0" bgcolor="<?=SECONDROWCOLOR?>">
<tr>
   <td>
<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" height="350" >

                                   <tr valign="top">
					  <td align="left"  valign="top" width="15%" style="border-right:1px solid #CFCFCF; padding-right:2px; "><? require_once(DIR_WS_INCLUDES.'side_links.php'); ?></td>				  
					  <td>
                        <form name="frmChangeProfile" method="post" action="<? echo href_link(FILENAME_DEFAULT);?>" onSubmit="return submitfrmChangeProfile(document.frmChangeProfile);">
                          <table width="80%" border="0" cellspacing="0" cellpadding="2" align="left">
<tr><td align="left" style="padding-left:6px" class="heading_light_blue" ><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_CHANGE_PASSWORD;?></td></tr>	
<tr><td height="10"></td></tr>					  
                            <tr> 
                              <td width="30%" class="tahoma12blacknormal padding_left">User Name:</td>
                              <td width="20%"><input name="username" class="textbox" readonly="true" type="text" tabindex="1" dir="ltr" size="30" value="<? echo $_COOKIE["admin_username"] ?>" ONCHANGE="validatePresent(this, 'error_username');"></td>
                              <td width="60%" id="error_username" class="tahoma10rednormal"></td>
                            </tr>
                            <tr> 
                              <td width="20%" class="tahoma12blacknormal padding_left">Current Password:</td>
                              <td width="20%"><input name="password" class="textbox" type="password" tabindex="2" dir="ltr" size="30" ONCHANGE="validatePresent(this, 'error_password');"></td>
                              <td width="60%" id="error_password" class="tahoma10rednormal">Required</td>
                            </tr>
                            <tr> 
                              <td  width="20%" class="tahoma12blacknormal padding_left">New Password:</td>
                              <td width="20%"><input class="textbox" name="new_password" type="password" tabindex="3" dir="ltr" size="30" ONCHANGE="validatePresent(this, 'error_new_password');"></td>
                              <td width="60%" id="error_new_password" class="tahoma10rednormal">Required</td>
                            </tr>
                            <tr> 
                              <td width="20%" class="tahoma12blacknormal padding_left">Confirm New Password:</td>
                              <td width="20%"><input name="confirm_new_password" class="textbox" type="password" tabindex="4" dir="ltr" size="30" ONCHANGE="validatePresent(this, 'error_confirm_new_password');"></td>
                              <td width="60%" id="error_confirm_new_password" class="tahoma10rednormal">Required</td>
                            </tr>
							
                            <tr> 
                              <td width="20%" valign="middle">&nbsp;</td>
                              <td colspan="2"><input name="buttonSubmit"  type="submit" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" tabindex="5" title="Submit" onClick="" value="Submit"> <input name="buttonReset" type="reset" tabindex="6" title="Reset" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" value="Reset" ONCLICK="document.location.reload()">&nbsp;<input  name="buttonCancel" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" type="button" tabindex="7" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_DEFAULT); ?>'"></td></td>
                        

                            </tr>
                          </table>
                        </form> 
                        </td>
                    </tr>					
                </table>
   </td>
</tr>
</table>
</td></tr>
        <tr>
            <td valign="top">
            <?php require_once (DIR_WS_INCLUDES . 'footer.php');?>
            </td>
        </tr></table>
</body>
</html>
<script language="javascript" type="text/javascript">
<!--//
ToggleFloatingLayer('PleaseWaitFloatingLayer',0);
//-->
</script>
<?php require_once('mysql_close.php');?>