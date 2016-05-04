<?php
function checklogin () {
    global $_SESSION;
    if ((!isset ($_SESSION["username"]) || !not_null ($_SESSION["username"]))) {
        redirect (FILENAME_LOGIN);
    }
}

?>