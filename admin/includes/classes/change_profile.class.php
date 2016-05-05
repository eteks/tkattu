<?php

class changeProfile {

    function selectAdminPwd($userName, $password, $adminId) {

        $adminSql = "SELECT id, username FROM " . TABLE_ADMIN_MASTER . " WHERE username = '" . $userName . "' AND password = '" . $password . "' AND id = '" . $adminId . "'"; 
        $adminQry = db_query ($adminSql);
        return $adminQry;

    }

    function updateAdminPwd ($newPassword, $adminId) {

        $updateAdminSql = "UPDATE " . TABLE_ADMIN_MASTER . " SET password = '" . $newPassword . "' WHERE id = '" . $adminId . "'"; 
        $updateAdmin    = db_query ($updateAdminSql);
        return $updateAdmin;

    }

}
?>