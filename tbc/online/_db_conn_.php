<?php
require_once ("_globals_.php");

function db_connect ()
{
    global $MSG_ERROR;
    $db = mysql_connect ("dbmysql200.my-hosting-panel.com", "click_webtbc", "tbcpasswd") or die ($MSG_ERROR);
    mysql_select_db ("clicknvz_tbc", $db) or die ($MSG_ERROR);

    $db_charset = mysql_query ("SHOW VARIABLES LIKE 'character_set_database'", $db);
    $charset_row = mysql_fetch_assoc ($db_charset);
    mysql_query ("SET NAMES '" . $charset_row['Value'] . "'", $db);

    return $db;
}

function db_disconnect ($db)
{
    mysql_close ($db);
}
?>
