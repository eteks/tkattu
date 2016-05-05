<div id=divmiddlecontent>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
                    <th width="942" align="center" valign="top" scope="col"><table width="942" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <th scope="col"><img src="images/01.jpg" width="157" height="168" /></th>
                         <th scope="col"><img src="images/02.jpg" width="127" height="168" /></th>
                           <!-- <th scope="col"><img src="images/03.jpg" width="129" height="168" /></th>
						     <th scope="col"><img src="images/05.jpg" width="147" height="168" /></th> -->
                            <th scope="col"><img src="images/04.jpg" width="137" height="168" /></th>
                          
                            <th scope="col"><img src="images/06.jpg" width="181" height="168" /></th>
                          </tr>
                          <tr>
                          
 <?php
if ( is_allow_module($_SESSION["userid"], 14)) {
?>	                      
                            <td><a href="Javascript:getMainRestaurant();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','images/restaurant_04.jpg',1)"><img src="images/restaurant_03.jpg" name="Image23" width="157" height="55" border="0" id="Image23" /></a></td>
 <?php } else { ?>
      <td><img src="images/restaurant_03.jpg" name="Image23" width="157" height="55" border="0" id="Image23" /></a></td>
   <?php } ?>
   
<?php
if ( is_allow_module($_SESSION["userid"], 23)) {
?>                          
                          <td><a href="Javascript:getpurchaseorder();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image28','','images/inventory_04.jpg',1)"><img src="images/inventory_03.jpg" name="Image28" width="127" height="55" border="0" id="Image28" /></a></td>
<?php } else { ?>
     <td><img src="images/inventory_03.jpg" name="Image28" width="127" height="55" border="0" id="Image28" /></a></td>
 <?php } ?>                      
                            
<?php
if ( is_allow_module($_SESSION["userid"], 7)) {
?>							
                           <!-- <td><a href="Javascript:getMainReservation();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image29','','images/reservation_04.jpg',1)"><img src="images/reservation_03.jpg" name="Image29" width="129" height="55" border="0" id="Image29" /></a></td>-->
<?php } else { ?>
<!--<td><img src="images/reservation_03.jpg" name="Image29" width="129" height="55" border="0" id="Image29" /></td>-->
<?php } ?>
<?php
if ( is_allow_module($_SESSION["userid"], 17)) {
?>
                            <td><a href="Javascript:getRestaurantBill();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','images/billing_04.jpg',1)"><img src="images/billing_03.jpg" name="Image30" width="137" height="55" border="0" id="Image30" /></a></td>
<?php } else { ?>
       <td><img src="images/billing_03.jpg" name="Image30" width="137" height="55" border="0" id="Image30" /></a></td>
<?php } ?>                    
                            
<?php
if ( is_allow_module($_SESSION["userid"], 12)) {
?>
                            <!--<td><a href="Javascript:getMainServices();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31','','images/services_04.jpg',1)"><img src="images/services_03.jpg" name="Image31" width="147" height="55" border="0" id="Image31" /></a></td>-->
 <?php } else { ?>
  <!-- <td><img src="images/services_03.jpg" name="Image31" width="147" height="55" border="0" id="Image31" /></a></td>-->
   <?php } ?>             
           
 <?php
if ( is_allow_module($_SESSION["userid"], 22)) {
?>                           
                            <td><a href="admin/login.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','images/adminstaion_04.jpg',1)"><img src="images/adminstaion_03.jpg" name="Image32" width="181" height="55" border="0" id="Image32" /></a></td>
 <?php } else { ?>
        <td><img src="images/adminstaion_03.jpg" name="Image32" width="181" height="55" border="0" id="Image32" /></a></td>
 <?php } ?>     
   
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="center">&nbsp;</td>
                      </tr>
                     
                    </table>
                      </th>
                    <th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
                    </tr>
                  
                  <tr>
                    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
                    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
                    <th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
                  </tr>
                </table>
</div>