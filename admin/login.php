<?php
require_once ("includes/application_top.php");
$_POST["username"] = (isset($_POST['username']) && !empty($_POST['username']) ? $_POST['username']:"" );
$username=$_POST["username"];
$_POST["password"] = (isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password']:"" );
$password=$_POST["password"];

if(!empty($_POST["password"]))
{
	$admin_sql = "SELECT `id`, `username`, `active` FROM " . TABLE_ADMIN_MASTER . " WHERE `username` = '" . $username . "' AND `password` = '" . $password . "'";
	
	$admin = db_query($admin_sql);

	if ( db_num_rows ($admin) ) {
    	$admin_values = db_fetch_array ($admin);
    	if($admin_values["active"]!='Y') {
        	echo "Disabled Username!";
        	exit;
        	//echo 0;
    	} else {
        	setcookie ("admin_id", $admin_values["id"]);
        	setcookie ("admin_username", $admin_values["username"]);
        	//wp_press_user_logged($admin_values["username"]);
        	//echo 1;
			//$_SESSION["USERNAME"] = $admin_values["username"];
			header("location:index.php"); 
        	exit;
    	}    
	} else {
    	/*deletecookie ();
    	echo "Invalid username and/or password";
    	exit;*/
		$error=array();
	   $error[]="<strong>Wrong Username or Password</strong>";
    	//echo 0;
	}
	require_once('mysql_close.php');
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Junior Thalapakattu Biryani</title>
<link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script language="javascript" type="text/javascript" src="js/common.js"></script>
<script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
<script language="javascript" type="text/javascript" src="js/login.js"></script>
</head>
<body onLoad="document.forms.loginform.username.focus()">
<form name="loginform" action="login.php" method="post" >

<?php if (empty($_GET["from"])){ ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">

<?php if(isset($error) && ($error)) if (count($error)>0) {
              foreach ($error as $key => $val) {
			  ?>

	  
      <tr>
	  <td>&nbsp;</td>
	  <tr>
       <td  align="center" colspan="4">   
	   
           <p><font color="red"><? echo $val;?></font></p>       </td>
       </tr>   
	   <?php }
	   }
	   ?>
        <td >
           <table width="665" height="336" border="0" align="center" cellpadding="0" cellspacing="0" >
              
              
              <tr><td width="449" height="81" align="center" background="images/admin_bg.jpg">
                 <table cellpadding="0"  cellspacing="0">
                        <tr>
                            <td align="right" class="tahoma11whitebold">Username&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;</td>
                            <td><input type="text" class="input" style="width:250px;" name="username" id="username"></td>
                        </tr>
                        <tr>
                          <td  align="right">&nbsp;</td>
                          <td></td>
                        </tr>
                        <tr>
                        	<td align="right" class="tahoma11whitebold">Password&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;</td>
                            <td><input type="password" name="password" id="password" class="input" style="width:250px;"></td>
                        </tr>
                        <tr>
                          <td align="right">&nbsp;</td>
                          <td align="left" valign="top" style="padding-right:42px;padding-top:5px">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="right">&nbsp;</td>
                          <td align="left" valign="top" style="padding-right:42px;padding-top:5px"><a><input type="image" src="images/login.gif" id="login" name="login"  width="107" height="26" border="0" onClick="return submitfrmLogin()"> </a>              </td>
                        </tr>
                </table>
              </td></tr>
          </table>
		  <?php } ?> 
        </td>
      </tr>
    </table>
</form>
</body>
</html>