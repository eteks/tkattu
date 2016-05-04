<?php 
   session_start();
   include_once('includes/application_top.php');
   if(!empty($_POST["password"])) {
     $select_user_password ="SELECT * FROM hms_admin_mst WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["password"] . "'";
	 $select_user_password_result=db_query($select_user_password);
	  
	 if(db_num_rows($select_user_password_result)>0) {
	    
     	 $rowUser                       = db_fetch_array($select_user_password_result);
		 $_SESSION["userid"]             = $rowUser["id"];
	     $_SESSION["email"]             = $rowUser["email"];
	     $_SESSION["username"]          = $rowUser["username"];
	     $_SESSION["first_name"]        = $rowUser["first_name"];
	     $_SESSION["last_name"]         = $rowUser["last_name"];
         $_SESSION["admin_role_mst_id"] = $rowUser["admin_role_mst_id"];
             
         $sel_parameter  = "SELECT hms_hotel_name FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
         $rows_parameter = db_query ($sel_parameter);
         $fet_parameter  = db_fetch_array($rows_parameter);
         $_SESSION["hotelname"] = $fet_parameter['hms_hotel_name'];
		 
	    header("location:index.php"); 
	  }	else {
	   $error=array();
	   $error[]="<strong>Wrong Username or Password</strong>";
	   //echo "<script>document.getElementByid('password').focus();</script>";
      }
   	} 

?>


<div id="intialdiv" style="position:absolute; top:0px; left:0px; padding-top:350px; padding-left:450px; display:none"><span style="margin-top:10px;margin-left:20px; position:absolute;top:0px;">Loading...</span></div>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Junior Thalapakattu Biryani</title>
<link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script language="JavaScript" type="text/javascript" src="js/mm_menu.js"></script>
<!--<script src="js/prototype.js" type="text/javascript"></script>
-->
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/login.js" type="text/javascript"></script>

</head>

<body onLoad="MM_preloadImages('images/reservation_02.jpg','images/services_02.jpg','images/restaurant_02.jpg','images/billing_02.jpg','images/inventory_02.jpg','images/logout_02.jpg','images/adminstaion_02.jpg','images/restaurant_04.jpg','images/inventory_04.jpg','images/reservation_04.jpg','images/billing_04.jpg','images/services_04.jpg','images/adminstaion_04.jpg');document.forms.loginform.username.focus()">
<script language="JavaScript1.2">mmLoadMenus();</script>
<form name="loginform" method="POST" action="login.php">
<table width="1002" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="1002" scope="col"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th scope="col"><? include('includes/index.header.php'); ?></th>
          </tr>
          <tr>
            <td class="menubg"></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th scope="col"><table width="1000" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <th colspan="6" class="gradientbg" scope="col">&nbsp;</th>
                  </tr>
                  <tr>
                    <td width="3%" height="30">&nbsp;</td>
                    <td width="2%" align="right" valign="bottom">&nbsp;</td>
                    <td width="37%" align="left" valign="middle">&nbsp;</td>
                   <td width="38%" align="left" valign="middle" class="tahomasmall"><!---<script language="JavaScript" type="text/javascript">
					  var curDateTime=new Date()
					  document.write (curDateTime.toLocaleString())
					  </script>---><?php echo date("d-m-y h:i:s"); ?></td>
                    <td width="18%">&nbsp;</td>
                    <td width="2%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="3%"><img src="images/left_corner.jpg" width="29" height="20" /></td>
                    <td colspan="3" align="right" valign="bottom" background="images/topline.jpg">&nbsp;</td>
                    <td width="18%" background="images/topline.jpg">&nbsp;</td>
                    <td width="29"><img src="images/right_corner.jpg" width="29" height="20" /></td>
                  </tr>
                </table></th>
              </tr>
              <tr>
                <td>
		<?php
         if (isset($_GET["from"]) && $_GET["from"]=="logout") {
		    session_destroy(); 
         ?>
 <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
    <th width="942" align="center" valign="top" scope="col"><table width="942" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="231" align="center"><span class="verdanabrown">You have successfully logged out &amp; closed the session</span><br />
          <span class="verdanabrown">To login again :</span> <a href="login.php" class="menulink">Click Here</a></td>
      </tr>
   
    </table></th>
    <th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
  </tr>
  <tr>
    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
    <th width="29" scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
  </tr>
</table>
<?php
 }	
?>
<?php
         if (empty($_GET["from"])){
         ?>                
                <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		    <?php
           if (isset($error) && count($error)>0) {
              foreach ($error as $key => $val) {
          ?>
       <tr>
       <td  align="center" colspan="4">   
           <p><font color="red"><?php echo $val;?></font></p>       </td>
       </tr>    
         <?php        
            }
           }	
         ?>
                
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
    <th width="942" align="center" valign="top" scope="col"><table width="942" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="200" align="center"><table width="670" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              
              <tr>
                <td height="325" align="center" valign="middle" background="images/admin_bg.jpg"><table border="0" align="center" cellpadding="3" cellspacing="3">
                  <tr>
                    <th align="left" valign="bottom" class="tahomawhite12" scope="col">&nbsp;</th>
                    <th height="50" align="left" valign="bottom" class="tahomawhite12" scope="col">&nbsp;</th>
                    <th align="left" valign="bottom" class="tahomawhite12" scope="col">&nbsp;</th>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"><span class="tahomawhite12">Username:</span></td>
                    <td align="left" valign="middle"><label>
                      <input name="username" type="text" class="inputlogin" id="username" />
                    </label></td>
                    <td align="left" valign="middle">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td align="left" valign="middle"><span class="tahomawhite12">Password:</span></td>
                    <td align="left" valign="middle"><input name="password" type="password" class="inputlogin" id="password" style="vertical-align:middle"/></td>
                    <td align="left" valign="middle">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="bottom">&nbsp;</td>
                    <td height="50" align="center" valign="middle"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/login_button_02.jpg',1)">
                      <input type="image" src="images/login_button_01.jpg" id="login" name="login" onClick="return ValidateUser()" width="101" height="22"/>
                    </a></td>
                    <td align="right" valign="bottom">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              
            </table></th>
          </tr>
        </table></td>
      </tr>
   
    </table></th>
    <th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
  </tr>
  <tr>
    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
    <th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
  </tr>
</table>
<?php
  }
?>
                
                </td>
              </tr>
              <tr>
                <td><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <th width="24" align="left" valign="middle" scope="col">&nbsp;</th>
                    </tr>
                  
                </table></td>
              </tr>
            </table></th>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle" bgcolor="#63890F"><? include('includes/index.footer.php');?></td>
      </tr>
    </table></th>
  </tr>
</table>
</form>
<map name="Map" id="Map"><area shape="rect" coords="7,4,206,47" href="index.htm" />
</map></body>
</html>