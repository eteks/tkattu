<?php

if (($_POST['fromcurtdate'] == "fromcurtdate")) {


//  $select_acct      = "SELECT *   FROM ".TABLE_ACCOUNT_DETAILS." WHERE act_date1 = '" . $_POST["curntdate"]  . "'  ";
 
  $select_acct_result = dbQuery($select_acct); 	
  $resultAcct     = dbFetchArray($select_acct_result);
  
 $i = 1 ;
 while ($resultAcct = dbFetchArray($select_acct_result)) {
  $_SESSION['report_values'][$i][0] = $resultAcct["act_total"];
  $i = $i+1;
 }
 $_SESSION['report_header']=array("Total"); 
} 

?>  


<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<th scope="row"><img src="images/seperator.jpg" width="8" height="8" /></th>
<th scope="row"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="row"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" >
        <tr>
          <th width="7" align="left" valign="bottom" scope="row"><img src="images/left_top_corner.jpg" width="7" height="7" /></th>
          <td width="1356" class="tablebordertop"></td>
          <td width="8" align="right" valign="bottom"><img src="images/right_top_corner.jpg" width="8" height="7" /></td>
        </tr>
        <tr>
          <th height="191" colspan="3" valign="top" class="tableborderleft" scope="row">
          <table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
              <td align="center">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
			   <tr><td colspan="6">Sales</td></tr>
                <tr align="center">
                  <td  colspan="6" >
                  <a href="<?php echo FILENAME_SALESBYDAY;?>?a=day" class="submenu" rel="facebox">By Day<br />
                    <br />
                  </a>
                  <a href="<?php echo FILENAME_SALESBYDAY;?>?a=order" class="submenu" rel="facebox">By Ordertype<br />
                    <br />
                  </a>
                  <a href="<?php echo FILENAME_SALESBYDAY;?>?a=week" class="submenu" rel="facebox">Last 7 days<br />
                    <br />
                  </a>
                   <a href="<?php echo FILENAME_SALESBYDAY;?>?a=month" class="submenu" rel="facebox">Last 30 days<br />
                    <br />
                  </a>                  
                   <a href="<?php echo FILENAME_SALESBYDAY;?>?a=payment" class="submenu" rel="facebox">By Payment<br />
                    <br />
                  </a>                  
				  <a href="<?php echo FILENAME_SALESBYDAY;?>?a=client" class="submenu" rel="facebox">By Client<br />
                    <br />
                  </a>  
				   <a href="<?php echo FILENAME_SALESBYDAY;?>?a=cashier" class="submenu" rel="facebox">By Cashier<br />
                    <br />
                  </a> 
                  </td>                      
                </tr>
				<tr><td colspan="6">Date</td></tr>
				<tr align="center">
                  <td  colspan="6" >
				   <a href="<?php echo FILENAME_REPORTS;?>?a=date" class="submenu" >By Date<br />
                    <br />
                  </a> 
                  </td>                      
                </tr>
				<!--<tr><td colspan="6">Table</td></tr>
				<tr align="center">
                  <td  colspan="6" >
				   <a href="<?php echo FILENAME_SALESBYDAY;?>?a=table" class="submenu" rel="facebox">By Table<br />
                    <br />
                  </a> 
                  </td>                      
                </tr>-->
                
				<tr><td colspan="6">Shift</td></tr>
				<tr align="center">
                  <td  colspan="6" >
				   <a href="<?php echo FILENAME_REPORTS;?>?a=shift" class="submenu" >By Shift<br />
                    <br />
                  </a> 
                  </td>                      
                </tr>
                
				<tr><td colspan="6">Inventory</td></tr>
				<tr align="center">
                  <td  colspan="6" >
                  <a href="<?php echo FILENAME_INVENTORY;?>?a=day" class="submenu" rel="facebox">By Items<br />
                 
                  </a>
                                          
                  </td>                      
                </tr>
				<tr><td colspan="6">Purchase Order</td></tr>
				<tr align="center">
                  <td  colspan="6" >
                  <a href="<?php echo FILENAME_REPORTS;?>?a=purchase" class="submenu" >Purchase Order<br />
                 
                  </a>
                                          
                  </td>                      
                </tr>
                
			   <?php
                   if (!empty($_POST["Drawer"])) {
               ?>                
                <tr>
                  <td colspan="5">
                <?php  
					     echo "Entered Amount  $". $total;
				 ?>
                  </td>
                </tr>
                <?php
				  }
				?>
			   <?php
                   if (!empty($_POST["begincash"])) {
               ?>                
                <tr>
                  <td colspan="5">
                <?php  
					     echo "Total Amount  $". $_POST["begincash"];
				 ?>
                  </td>
                </tr>
                <?php
				  }
				?>
                
                <tr>
                  <td><img src="images/box.gif" width="25" height="25" /></td>
                  <td width="89%" align="left" valign="top"></td>
                  <td width="9%" valign="top">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th align="left" valign="bottom" scope="row"><img src="images/left_bottom_corner.jpg" width="7" height="9" /></th>
          <td valign="bottom" background="images/box_bottom_gradient.jpg"></td>
          <td width="8" align="right" valign="bottom"><img src="images/right_bottom_corner.jpg" width="8" height="9" /></td>
        </tr>
    </table></th>
    <th scope="row"><img src="images/seperator.jpg" width="8" height="8" /></th>
  </tr>
</table></th>
</tr>
</table>
<?php
    session_unregister("report_values");
?>