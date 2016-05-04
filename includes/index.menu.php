<table width="1000" border="0" cellpadding="0" cellspacing="0">
	<tr>
		
<?php

if ( is_allow_module($_SESSION["userid"], 7)) {
?>			  
		<!--<th width="127" scope="col"><a href="Javascript:getMainReservation();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/reservation_02.jpg',1)"><img src="images/reservation_01.jpg" name="Image3" width="126" height="40" border="0" id="Image3" onmouseover="MM_showMenu(window.mm_menu_0211142529_0,0,40,null,'Image3')" onmouseout="MM_startTimeout();" /></a></th>-->
		


<?php } if ( is_allow_module($_SESSION["userid"], 14)) { ?>
                <th width="126" scope="col">
                    <a href="Javascript:getMainRant();" onmouseout="MM_swapImgRestore()" tabindex="-1" onmouseover="MM_swapImage('Image5','','images/restaurant_02.jpg',1)"><img src="images/restaurant_01.jpg" name="Image5" width="125" height="40" border="0" id="Image5" onmouseover="MM_showMenu(window.mm_menu_0211143209_0,0,40,null,'Image5')" onmouseout="MM_startTimeout();" /></a></th>
<?php } if ( is_allow_module($_SESSION["userid"], 17)) { ?>  

<th width="126" scope="col"><a href="Javascript:getMainBilling();" onmouseout="MM_swapImgRestore()" tabindex="-1" onmouseover="MM_swapImage('Image6','','images/billing_02.jpg',1)"><img src="images/billing_01.jpg" name="Image6" width="125" height="40" border="0" id="Image6" onmouseover="MM_showMenu(window.mm_menu_0211143306_0,0,40,null,'Image6')" onmouseout="MM_startTimeout();" /></a></th> 

<?php } if ( is_allow_module($_SESSION["userid"], 12)) { ?> 
             <th width="126" scope="col"><a href="Javascript:getMainServices();" onmouseout="MM_swapImgRestore()" tabindex="-1" onmouseover="MM_swapImage('Image4','','images/Report1.jpg',1)"><img src="images/Report1.jpg" name="Image4" width="125" height="40" border="0" id="Image4" onmouseover="MM_showMenu(window.mm_menu_0211143051_0,0,40,null,'Image4')" onmouseout="MM_startTimeout();" /></a></th>


<?php } if ( is_allow_module($_SESSION["userid"], 23)) { ?>

                <th width="126" scope="col"><a href="Javascript:getMainInventory();" onmouseout="MM_swapImgRestore()" tabindex="-1" onmouseover="MM_swapImage('Image7','','images/inventory_02.jpg',1)"><img src="images/inventory_01.jpg" name="Image7" width="125" height="40" border="0" id="Image7" onmouseover="MM_showMenu(window.mm_menu_0211152703_0,0,40,null,'Image7')" onmouseout="MM_startTimeout();" /></a></th>
<?php } ?>				
                <th width="126" scope="col"><a href="login.php?from=logout" onmouseout="MM_swapImgRestore()" tabindex="-1" onmouseover="MM_swapImage('Image8','','images/logout_02.jpg',1)"><img src="images/logout_01.jpg" name="Image8" width="125" height="40" border="0" id="Image8" /></a></th>
				
<?php if ( is_allow_module($_SESSION["userid"], 22)) { ?>				
                <th width="126" scope="col"><a href="admin/login.php"  target="_blank" onmouseout="MM_swapImgRestore()" tabindex="-1" onmouseover="MM_swapImage('Image9','','images/adminstaion_02.jpg',1)"><img src="images/adminstaion_01.jpg" name="Image9" width="125" height="40" border="0" id="Image9" /></a></th>
<?php } ?>
				
              </tr>
            </table>