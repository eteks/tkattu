<?php

function db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {
    global $$link;

    if (USE_PCONNECT == 'true') {
        $$link = mysql_pconnect($server, $username, $password);
    } else {
        $$link = mysql_connect($server, $username, $password);
    }

    if ($$link) mysql_select_db($database);

    return $$link;
}

function db_close($link = 'db_link') {
    global $$link;
    return mysql_close($$link);
}

function db_error($query, $errno, $error) { 
    die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[ UL STOP]</font></small><br><br></b></font>');
}

function db_query($query, $link = 'db_link') {
    global $$link;
    
    $result = mysql_query($query, $$link) or db_error($query, mysql_errno(), mysql_error());
    return $result;
}

  
function db_fetch_array($db_query) {
    return mysql_fetch_array($db_query, MYSQL_ASSOC);
}

function db_num_rows($db_query) {
    return mysql_num_rows($db_query);
}

function db_insert_id() {
    return mysql_insert_id();
}

function db_input($string) {
    return addslashes($string);
}

function db_seek ($string, $pos) {
	mysql_data_seek($string ,$pos);
}
function db_affected_rows (){
	return mysql_affected_rows();
}

function db_result($db_query, $index) {
    return mysql_result($db_query,$index);
}
?>