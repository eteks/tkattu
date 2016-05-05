<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th colspan="5" class="gradientbg" scope="col" style=""> 
		<?php 
                echo date("d-m-y h:i:s"); ?>
	<!---<script language="JavaScript" type="text/javascript">
        var curDateTime=new Date()
        document.write (curDateTime.toLocaleString())
        </script>--->
        
		</th>
    </tr>
    <tr>
        <td width="2%" height="30">&nbsp;</td>
        <td width="2%" align="right" valign="bottom">&nbsp;</td>
        <td width="37%" align="left" valign="middle"><span class="tahomasmallbold">Welcome:</span> <span class="tahomasmall"><?php echo $_SESSION["username"];?>,</span></td>
        <td width="38%" align="left" valign="middle" class="tahomasmall"></td>
        <td width="21%" rowspan="2"><img src="images/home.jpg" width="216" height="50" border="0" usemap="#Map" /></td>
    </tr>
    <tr>
        <td width="2%"><img src="images/left_corner.jpg" width="29" height="20" /></td>
        <td colspan="3" align="right" valign="bottom" background="images/topline.jpg">&nbsp;</td>
    </tr>
</table>
