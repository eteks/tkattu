<?php ob_start(); 
	session_start(); ?>
<div id="intialdiv" style="position:absolute; top:0px; left:0px; padding-top:350px; padding-left:450px; display:none"><span style="margin-top:10px;margin-left:20px; position:absolute;top:0px;">Loading...</span></div>
<?php include_once('includes/application_top.php'); 
if(!isset($_SESSION["username"])){
	header("location:login.php");
	exit;
}
db_query("Delete FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " WHERE pur_fck_id=0");
$selectcartid = db_query("SELECT order_cart_id FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " a  WHERE order_cart_id NOT IN (SELECT account_card_id FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." b)");
if(db_num_rows($selectcartid)>0)
{
while($fetchcartid = db_fetch_array($selectcartid))
{
$cartid = $fetchcartid['order_cart_id'];
db_query("DELETE FROM hms_order_qty_flow WHERE order_cart_id='".$cartid."'");
db_query("DELETE FROM ".TABLE_HMS_TABLE_DETAILS." WHERE htd_cart_id='".$cartid."'");
db_query("DELETE FROM " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_cart_id='".$cartid."'");
}
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Junior Thalapakattu Biryani</title>
<link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/CalendarControl.css" rel="stylesheet" type="text/css">
<link href='css/ajax-autocomplete.css' rel='stylesheet' type='text/css'/>
<script language="JavaScript" type="text/javascript" src="js/mm_menu.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!--<script src="js/prototype.js" type="text/javascript"></script>-->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>



<!--<script language="JavaScript" type="text/javascript" src="js/Reservation.js"></script>
<script language="JavaScript" type="text/javascript" src="js/Facility.js"></script>

<script language="JavaScript" type="text/javascript" src="js/house_keep.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/report.js"></script>
<script language="JavaScript" type="text/javascript" src="js/header_menu.js"></script>
<!--<script language="JavaScript" type="text/javascript" src="js/order.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/resorder.js"></script>
<script language="JavaScript" type="text/javascript" src="js/billing.js"></script>

<script language="JavaScript" type="text/javascript" src="js/inventory.js"></script>


<script type="text/javascript" src="js/calendar/calendar.js"></script>
<script language="javascript" type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="js/cal.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/skins/aqua/theme.css" title="Aqua" />

<script>
function checkBoxValidate(cb) 
{
    for (j = 0; j < 2; j++) 
   {
        if (eval("document.reser.ckbox[" + j + "].checked") == true) 
      {
             document.reser.ckbox[j].checked = false;
        if (j == cb)
          {
             document.reser.ckbox[j].checked = true;
           var val = document.reser.ckbox[j].value;
		    document.getElementById('checkboxvalue').value = val;
			 
          }
      }
        if(document.getElementById("ch1").checked)
           {
              document.getElementById("tb1").style.display ="block";
			  document.getElementById("tb2").style.display ="None";
           }
        else if(document.getElementById("ch2").checked)
          {
              document.getElementById("tb2").style.display ="block";
			  document.getElementById("tb1").style.display ="None";
          }
        else 
          {
              document.getElementById("tb1").style.display ="block"; 
			  document.getElementById("tb2").style.display ="none";
          }
  }
   }
</script>
</head>

<body onLoad="MM_preloadImages('images/reservation_02.jpg','images/services_02.jpg','images/restaurant_02.jpg','images/billing_02.jpg','images/inventory_02.jpg','images/logout_02.jpg','images/adminstaion_02.jpg','images/restaurant_04.jpg','images/inventory_04.jpg','images/reservation_04.jpg','images/billing_04.jpg','images/services_04.jpg','images/adminstaion_04.jpg')">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="1002" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="1002" scope="col"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="1000" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th scope="col"><?php include('includes/index.header.php'); ?></th>
          </tr>
          <tr>
            <td class="menubg"><?php include('includes/index.menu.php');?></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th scope="col"><table width="1000" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th scope="col"><?php include('includes/index.welcome.php');?></th>
              </tr>
              <tr>
                <td><?php include('includes/modules/index.middle.php');?></td>
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
        <td height="30" align="center" valign="middle" bgcolor="#648B20"><? include('includes/index.footer.php');?></td>
      </tr>
    </table></th>
  </tr>
</table>

<map name="Map" id="Map"><area shape="rect" coords="7,4,206,47" href="index.php" />
</map></body>
</html>
