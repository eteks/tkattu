<tr><td background="images/menu_strip.gif" width="100%" height="25" colspan="2">
<table cellpadding="0" width="100%" cellspacing="0">
    <tr>
        <td width="2"><img src="images/menu_left.gif" width="2" height="40"></td>
        <td>
        <span style="float:left;padding-left:5px" class="wel">
            Welcome <?php echo ucfirst($_COOKIE["admin_username"]);?>&nbsp;!
        </span>
        
        <span style="float:right;padding-right:5px"><a href="<?php echo href_link(FILENAME_DEFAULT);?>" class="wel" >Home</a>   |   <a href="<?php echo href_link(FILENAME_LOGOUT);?>"  class="wel">Logout</a></span>
        </td>
        <td width="2" align="right"><img src="images/menu_right.gif" width="2" height="25"></td>
    </tr>
</table>
</td></tr>