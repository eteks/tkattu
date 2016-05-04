<?php
require_once ("includes/application_top.php");
checklogin();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$module_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/highslides.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./extension/Highslides/js/highslide.packed.js"></script>
</head>
<body bgcolor="<?=BGCOLOR?>" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <?php
    ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="<?=CENTERBOXBG?>">
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="<?=CENTERBG?>">
                    <tr>
                        <td bgcolor="<?=CENTERTDBG?>" width="100%" align="center" valign="middle" ><?php require_once (DIR_WS_BASIC_INFO . FILENAME_PARAMETER_INFO_VIEW); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>