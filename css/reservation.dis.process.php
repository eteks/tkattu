<?php require_once ("includes/application_top.php");
/*echo "<pre>";
print_R($_GET);
exit;*/
  if($_GET["action"]=="showroomDisplay") {
?>

<!--<script src="js/prototype.js" type="text/javascript"></script>-->
<script src="js/jquery.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="js/reservation.js"></script>
<script language="javascript1.2" type="text/javascript">
function tests(gnid,rmid,rmtypeid){
opener.document.reser.rooms_no.value = gnid;
opener.document.reser.rooms_id.value = rmid;
opener.document.reser.room_type_id.value = rmtypeid;
self.close();
}
function trim(str) {
return str.replace(/^\s*|\s*$/g,"");
}
function showroomno_id(gnid,rmid,rmtypeid) {

//alert(gnid + "rmid=" + rmid + "rmtypeid=" + rmtypeid);


  //var norooms = document.getElementById('no_of_rooms').value;
  var stringspt;
  //var totalamt;
  //var extrabedch;
  //var total_days;
  //var noofdays = document.getElementById('no_of_days').value;
  /*var check_time_hrs = document.getElementById('check_time_hrs').value;
  if(trim(norooms) == "") {
    alert("Please Enter no of rooms");
    return false;
  } else if(trim(noofdays) == "") {
    alert("Please Enter no of days");
    return false;
  } */ 
  roomsno = document.getElementById('rooms_no').value;
  //alert(roomsno);
  //totalamt = document.getElementById('room_amount').value;
  //var extra_bed_ch = document.getElementById('extra_bed_charge').value;
  //if(trim(extra_bed_ch)=="") {  extrabedch = extra_bed_ch; }
  if(trim(roomsno)=="") {
    document.getElementById('rooms_no').value = rmid;	
	document.getElementById('showroomno_id'+rmid).disabled = true;
	document.getElementById('showroomno_id'+rmid).style.backgroundColor="#FF557F";
    document.getElementById('rooms_id').value = gnid;
    //document.getElementById('room_amount').value = totamt;
    document.getElementById('room_type_id').value = rmtypeid;
  } else {
    stringspt=roomsno.split(",");
	//alert(stringspt);
    splength = stringspt.length;
	//alert(splength);
	//alert(document.getElementById('rooms_no').value);
	//for (var i=0; i< splength; i++) {
	//if (document.getElementById('rooms_no').value != rmid[i]) {
    //if(splength < norooms) {
	// alert('showroomno_id'+rmid);
	document.getElementById('showroomno_id'+rmid).style.backgroundColor="#FF557F";
	document.getElementById('showroomno_id'+rmid).disabled = true;
      document.getElementById('rooms_no').value = document.getElementById('rooms_no').value+","+rmid;
      document.getElementById('rooms_id').value = document.getElementById('rooms_id').value+","+gnid;
      document.getElementById('room_type_id').value = document.getElementById('room_type_id').value+","+rmtypeid;
      //document.getElementById('room_amount').value = parseInt(document.getElementById('room_amount').value)+parseInt(totamt);
    /*} else {
      alert("Your selection exists no of room entered");
    }*/
	/*} else {
	alert("Already Room no Exist");
	}*/
	//}
  }
  /*if(check_time_hrs == "12") {
    total_days = (2*(parseInt(document.getElementById('room_amount').value)+parseInt(extrabedch)))*noofdays;
  } else if(check_time_hrs == "24") {
    total_days = (parseInt(document.getElementById('room_amount').value)+parseInt(extrabedch))*noofdays;
  }
  document.getElementById('total_amount').value = total_days;*/
}
</script>
<style type="text/css">
@charset "utf-8";
a.menulink:link {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: bold;
	color: #993399;
	color: #000000;
	text-decoration: underline;
}
a.menulink:visited {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: bold;
	color: #000000;
	text-decoration: underline;
}
a.menulink:hover {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: bold;
	color: #ff0003;
	text-decoration: underline;
}
a.menulink:active {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: bold;
	color: #000000;
	text-decoration: underline;
}
.tahoma12 {
	font-family: Tahoma;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
	text-align: justify;
}
.constantbg {
	background-image: url(../images/menu_gradient.jpg);
	background-repeat: repeat-x;
	height: 65px;
	width: auto;
	font-family: Tahoma;
	font-size: 11px;
	color: #FFFFFF;
	background-position: left top;
}
.tahomasmall {
	font-family: Tahoma;
	font-size: 11px;
	color: #000000;
	text-decoration: none;
	font-style: normal;
	font-weight: normal;
}
.gradientbg {
	background-image: url(../images/grey_grad.jpg);
	background-repeat: repeat-x;
	background-position: top;
	height: 8px;
	width: auto;
}
a.copyrights:link {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #993399;
	color: #FFFFFF;
	text-decoration: none;
}
a.copyrights:visited {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #FFFFFF;
	text-decoration: none;
}
a.copyrights:hover {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #00FFFF;
	text-decoration: underline;
}
a.copyrights:active {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #FFFFFF;
	text-decoration: none;
}
.tahomawhite12 {
	font-family: Tahoma;
	font-size: 12px;
	font-style: normal;
	color: #FFFFFF;
	text-decoration: none;
	font-weight: bold;
}
.input {
	width: 100px;
	font-family: Verdana;
	font-size: 11px;
}
.verdanablack {
	font-family: Tahoma;
	font-size: 11px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}
.verdanabold {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}
.verdanabrown {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #ae4d07;
	text-decoration: none;
}
.verdana13 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}
.menubg {
	background-position: top;
	height: 40px;
	width: auto;
	background-image: url(../images/menu_grad.jpg);
	background-repeat: repeat-x;
}
option {
	height: 15px;
}
.yellowbg {
	background-image: url(../images/yellow_grad.jpg);
	background-repeat: no-repeat;
	background-position: center top;
	height: 50px;
	width: 129px;
}
a.tahoma11:link {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #993399;
	color: #3a6997;
	text-decoration: underline;
}
a.tahoma11:visited {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #3a6997;
	text-decoration: underline;
}
a.tahoma11:hover {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #A00000;
	text-decoration: underline;
}
a.tahoma11:active {
	font-family: Tahoma;
	font-size: 11px;
	font-weight: normal;
	color: #3a6997;
	text-decoration: underline;
}
.tahomasmallbold {
	font-family: Tahoma;
	font-size: 11px;
	color: #000000;
	text-decoration: none;
	font-style: normal;
	font-weight: bold;
}
.tahoma {
	font-family: Tahoma;
	font-size: 11px;
	color: #FFFFFF;
	text-decoration: none;
	font-style: normal;
	font-weight: normal;
}
.mainbg {
	background-position: center top;
	height: 384px;
	width: 707px;
	background-image: url(../images/main_bg.jpg);
	background-repeat: no-repeat;
}
.servicebg {

	background-position: center top;
	height: 384px;
	width: 707px;
	background-image: url(../images/services_bg.jpg);
	background-repeat: no-repeat;
}
.selectinput {
	width: 125px;
	font-family: Verdana;
	font-size: 11px;
	color: #3A6997;
	height: 20px;
}
.selectinput1 {
	width: 100px;
	font-family: Verdana;
	font-size: 11px;
	color: #3A6997;
	height: 20px;
}
.selectinput2 {
	width: 55px;
	font-family: Verdana;
	font-size: 11px;
	color: #3A6997;
	height: 20px;
}
.tableborder {
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #A8B158;
	border-right-color: #A8B158;
	border-bottom-color: #A8B158;
	border-left-color: #A8B158;
}
a.submenu:link {
	font-family: Tahoma;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
	height: 30px;
	width: 103px;
	background-image: url(../images/rollover1.gif);
	background-repeat: no-repeat;
	background-position: left top;
	padding-top: 7px;
	float: left;
	padding-bottom: 0px;
}
a.submenu:visited {
	font-family: Tahoma;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
	width: 103px;
	background-image: url(../images/rollover1.gif);
	background-repeat: no-repeat;
	background-position: left top;
	padding-top: 7px;
	float: left;
	height: 30px;
	padding-bottom: 0px;
}

a.submenu:hover {
	font-family: Tahoma;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
	height: 30px;
	width: 103px;
	background-image: url(../images/rollover2.gif);
	background-repeat: no-repeat;
	background-position: left top;
	padding-top: 7px;
	float: left;
	padding-bottom: 0px;
}
a.submenu:active {
	font-family: Tahoma;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
	height: 30px;
	width: 103px;
	background-image: url(../images/rollover1.gif);
	background-repeat: no-repeat;
	background-position: left top;
	padding-top: 7px;
	float: left;
	padding-bottom: 0px;
}
.inputCopy {
	font-family: Verdana;
	font-size: 11px;
	font-weight: normal;
	text-align: left;
	vertical-align: middle;
	width: 125px;
	color: #3A6997;
	height: 15px;
}

.inputCopy1 {
	font-family: Verdana;
	font-size: 11px;
	font-weight: normal;
	text-align: left;
	vertical-align: middle;
	width: 100px;
	color: #3A6997;
	height: 20px;
}

.inventorybg {
	background-position: center top;
	height: 164px;
	width: 921px;
	background-image: url(../images/inventory_bg.jpg);
	background-repeat: no-repeat;
}
.reservationbg {
	background-position: center top;
	height: 437px;
	width: 718px;
	background-image: url(../images/reservation_bg.jpg);
	background-repeat: no-repeat;
}
.textarea {
	width: 125px;
	font-family: Verdana;
	font-size: 11px;
	color: #3A6997;
	height: 40px;
}

</style>
<body bgcolor="#FFFFFF">
<form name="form1" id="form1">
  <table border="0" align="left" width='90%' style='padding-left:10px' cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
  <tr >
  <td colspan="2"  align="center" valign="middle" class="verdanablack"><span style='color:#ff0000'></span> Room No :
<input name="rooms_no" id="rooms_no" type="text" size='16' tabindex="28" value=""/>
<input name="rooms_id" id="rooms_id" type="hidden" tabindex="28" value="<?php echo $_GET["rooms_id"];?>" />
<input name="room_type_id" id="room_type_id" type="hidden" tabindex="28" value="<?php echo $_GET["room_type_id"];?>" /></td>
    </tr>
    <td style="padding:10px">
      <table border="0" align="left" style='padding-left:10px' cellpadding="3" cellspacing="3">
        <?php
        //$fromdate = $_GET["ddDateFrom"];
        //$todate = $_GET["ddDateTo"];
		
    $formdate1 = explode('/',$_GET["ddDateFrom"]);
	$formdate = $formdate1[2]."-".$formdate1[0]."-".$formdate1[1];
	
	$todate = explode('/',$_GET["ddDateTo"]);
	$todate = $todate[2]."-".$todate[0]."-".$todate[1];
	
	/*echo $formdate;
	echo $todate;
	exit;*/
	
	
        $room_type = $_GET["room_type"];
        if($room_type == "all" || $room_type == "" || $room_type == "0") {
          $roomtypelist = "";
        } else {
          $roomtypelist = "room_type_id = '".$room_type."' AND ";
        }
        //$fromdatefmt = substr($fromdate,0,10);
        //$todatefmt = substr($todate,0,10);
        $sqlselect = "SELECT room_type_id,room_type_name,charge FROM ".TABLE_HMS_ROOM_TYPE_CREATION." WHERE ".$roomtypelist."active='Y'";
        $queryselect = db_query($sqlselect);
        while($rowsel = db_fetch_array($queryselect)) {
          ?>
          <tr>
            <td class="verdanablack" colspan='20' style='padding-left:2px'><?php echo $rowsel["room_type_name"];?>            </td>
          </tr>
          <?php
            $i=1;
            $selectroom = "SELECT room_id,room_no,room_type FROM ".TABLE_HMS_ROOM_CREATION." WHERE room_type = '".$rowsel["room_type_id"]."' ORDER BY room_no ASC";
            $queryroom = db_query($selectroom);
          ?>
            <tr style='padding-left:30px'>
              <?php
                while($roomsel = db_fetch_array($queryroom)) {
                 $selectbookingstatus = "SELECT status,rooms_id,rooms_no FROM ".TABLE_HMS_BOOKING_STATUS." WHERE `rooms_no` LIKE '%".$roomsel["room_no"]."%' AND ((checkin_date BETWEEN '".trim($formdate)."' AND '".trim($todate)."') OR (checkout_date BETWEEN '".trim($formdate)."' AND '".trim($todate)."'))";
				 //exit;
                  $querybookingstatus = db_query($selectbookingstatus);
                  $rowlist = db_fetch_array($querybookingstatus);
                  $rownum = db_num_rows($querybookingstatus);
                  if($rownum >= 1) {
                    $status = $rowlist["status"];
                    $roomlistshow = explode(',',$rowlist["rooms_no"]);
                    $totval = count($roomlistshow);
                    if($totval > 1) {
                      for($j=0;$j < $totval;$j++) {
                        if($roomlistshow[$j] == $roomsel["room_no"]) {
                          if($status == 'F') {
                            $bgcolor = '#FF0000';
                          } else if($status == 'B') {
                            $bgcolor = '#02A000';
                          } else if($status == 'H') {
                            $bgcolor = '#0000OO';
                          } else {
                            $bgcolor = '#0000FF';
                          }
                        }
                      }
                    } else if($totval <= 1) {
                      if($status == 'F') {
                        $bgcolor = '#FF0000';
                      } else if($status == 'B') {
                        $bgcolor = '#02A000';
                      } else if($status == 'H') {
                        $bgcolor = '#0000OO';
                      } else {
                        $bgcolor = '#0000FF';
                      }
                    }
                  } else {
                    $bgcolor = '#0000FF';
                  }
              ?>
         <td width="20">&nbsp;</td>
              <td width='12' bgcolor='<?php echo $bgcolor;?>' style="color:#FFFFFF" class="verdanablack">
                <?php if($bgcolor == '#0000FF') { ?>
				   <input id='showroomno_id<?php echo $roomsel["room_no"];?>' onclick='return showroomno_id(<?php echo $roomsel["room_id"]; ?>,<?php echo $roomsel["room_no"];?>,<?php echo $rowsel["room_type_id"]?>)' type="button" value="<?php echo $roomsel["room_no"];?>" style="background-color:#0000FF; color:#FFFFFF;">

                <?php } else { ?>
                  <?php echo $roomsel["room_no"];?>
                <?php } ?>              </td>
              <!--
                <td width='2' style='padding-left:2px'>
                  <?php if($bgcolor == '#0000FF') { ?>
                    <input type='checkbox' name='room_choose_dis[]' id='room_choose_dis' value='<?php echo $roomsel["room_id"];?>' onclick="return room_select_dis()"/>
                  <?php } else { ?>
                    &nbsp;
                  <?php } ?>
                </td>
              -->
              <?php if($i=="10") { ?>
        </tr><tr style='padding-left:30px'>
              <?php } ?>
          <?php $i = $i+1;
            }
          ?>
          </tr>
        <?php
          }
        ?>
        
        
        
      </table>    </td>
   </tr>
   <tr>
    <td>&nbsp;    </td>
   </tr>
   <tr>
    <td>
      <table border="0" align="left" width='100%' style='padding-left:10px' cellpadding="3" cellspacing="3">
        <tr height='20'>
          <td width='5%' style='padding-left:10px'>&nbsp;</td>
          <td width='4%' bgcolor='#FF0000'>&nbsp;</td>
          <td width='1%'>&nbsp;</td>
          <td width='10%' class="verdanablack" >Occupied</td>
          <td width='2%'>&nbsp;</td>
          <td width='4%' bgcolor='#02A000'>&nbsp;</td>
          <td width='1%'>&nbsp;</td>
          <td width='10%' class="verdanablack" >Booked</td>
          <td width='2%'>&nbsp;</td>
          <td width='4%' bgcolor='#0000FF'>&nbsp;</td>
          <td width='1%'>&nbsp;</td>
          <td width='9%' class="verdanablack" >Empty</td>
          <td width='2%'>&nbsp;</td>
          <td width='4%' bgcolor='#000000'>&nbsp;</td>
          <td width='2%'>&nbsp;</td>
          <td width='19%' class="verdanablack">House Keeping</td>
          <td width='13%'>&nbsp;</td>
          
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr align="right">
        <td align="center"></td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td colspan="9" align="center" class="verdanablack">
        <a href="javascript:void(0);" onClick="tests(document.getElementById('rooms_no').value,document.getElementById('rooms_id').value,document.getElementById('room_type_id').value)" class="submenu" tabindex="30">Close</a>
         <a href="#" class="submenu" tabindex="28">Cancel</a>
       <!-- <a href="javascript:window.close()" class="submenu" tabindex="30">Cancel</a></td>-->
        <td align="center">&nbsp;</td>
        </tr>
      </table>    </td>
  </tr>
</table>
</form>
</body>
<?php } ?>