<?php
require_once ("_db_conn_.php");

function get_menu ()
{
    $sql = "SELECT name, title ".
           "FROM section  ".
           "WHERE is_menu <> 0 ".
           "ORDER BY idx, title";
    $menu = array ();

    $db =  db_connect ();
    $qry = mysql_query ($sql, $db)  or die(mysql_error());

    while($fields = mysql_fetch_array ($qry, MYSQL_BOTH))
    {
        $menu [$fields ["name"]] = $fields ["title"];
    }

    db_disconnect ($db);

    return $menu;
}

function get_section ($section)
{
    $sql = "SELECT * FROM section WHERE idsection = %d";
    $sql = sprintf($sql, $section);

    $db =  db_connect ();
    $qry = mysql_query ($sql, $db)  or die(mysql_error());
    $field = mysql_fetch_array ($qry, MYSQL_ASSOC);
    db_disconnect ($db);

    if($field ["is_menu"] == 0)
        $field ["is_menu"] = false;
    else
        $field ["is_menu"] = true;

    return $field;
}

function get_subsection ($section, $subsection)
{
    $sql = "SELECT * FROM subsection WHERE section = %d AND subsection = %d";
    $sql = sprintf($sql, $section, $subsection);

    $db =  db_connect ();
    $qry = mysql_query ($sql, $db)  or die(mysql_error());
    $field = mysql_fetch_array ($qry, MYSQL_ASSOC);
    db_disconnect ($db);

    return $field;
}

function get_page ($section, $subsection, $page)
{
    $sql = "SELECT * FROM page " .
           "WHERE section = %d AND subsection = %d AND page = %d";
    $sql = sprintf($sql, $section, $subsection, $page);

    $db =  db_connect ();
    $qry = mysql_query ($sql, $db)  or die(mysql_error());
    $field = mysql_fetch_array ($qry, MYSQL_ASSOC);
    db_disconnect ($db);

    return $field;
}

function get_page_from_name ($section, $ss = NULL, $page = NULL)
{
    $sql = "SELECT p.name, p.title, p.style, p.script, p.has_slideshow slideshow, p.banner, p.body, p.footer, p.has_news news ".
           "FROM page p INNER JOIN section s ON p.section = s.idsection ".
           "INNER JOIN subsection ss ON p.subsection = ss.subsection ".
           "WHERE s.name = '$section' ".
           "AND ".($ss == NULL ? "ss.name IS NULL " : "ss.name=\"$ss\" ").
           "AND ".($page == NULL ? "p.name IS NULL " : "p.name=\"$page\" ").
           "ORDER BY idx, title";

    $db =  db_connect ();
    $qry = mysql_query ($sql, $db)  or die(mysql_error());
    $field = mysql_fetch_array ($qry, MYSQL_ASSOC);
    db_disconnect ($db);

    if($page ["slideshow"] == 0)
        $page ["slideshow"] = false;
    else
        $page ["slideshow"] = true;

    return $field;
}

function get_site_map ()
{
    $map = array ();
    $db =  db_connect ();

    $sql = "SELECT idsection, name, title ".
           "FROM section  ".
           "ORDER BY idx, title";
    $qry = mysql_query ($sql, $db)  or die(mysql_error());

    while($fields = mysql_fetch_array ($qry))
    {
        $map [$fields ["idsection"]] = array("name" => $fields ["name"],
                                             "title" => $fields ["title"],
                                             "items" => array());
    }

    $sql = "SELECT section, subsection, name, title ".
           "FROM subsection  ".
           "ORDER BY title";
    $qry = mysql_query ($sql, $db)  or die(mysql_error());

    while($fields = mysql_fetch_array ($qry))
    {
        $items = &$map [$fields ["section"]] ["items"];
        $items [$fields ["subsection"]] = array("name" => $fields ["name"],
                                                "title" => $fields ["title"],
                                                "items" => array());
    }

    $sql = "SELECT section, subsection, page, name, title ".
           "FROM page  ".
           "ORDER BY title";
    $qry = mysql_query ($sql, $db) or die(mysql_error());

    while($fields = mysql_fetch_array ($qry))
    {
        $items = &$map [$fields ["section"]] ["items"];
        $items = &$items [$fields ["subsection"]] ["items"];
        $items [$fields ["page"]] = array("name" => $fields ["name"],
                                          "title" => $fields ["title"]);
    }
    
    db_disconnect ($db);

    return $map;
}

function update_section ($args)
{
    $s = 0;

    if (get_magic_quotes_gpc ())
        foreach ($args as $key => $val)
            $$key = stripslashes ($val);
    else
        foreach ($args as $key => $val)
            $$key = $val;

    if ($s != 0)
        $sql = "UPDATE section " .
               "SET name='%s',title='%s',idx=%d,is_menu=%d," .
               "modification_time=NOW() " .
               "WHERE idsection = %d";
    else
        $sql = "INSERT INTO section (name,title,idx,is_menu,creation_time," .
                                    "modification_time) " .
               "VALUES ('%s','%s',%d,%d,NOW(),NOW())";

    $db =  db_connect ();
    $sql = sprintf($sql,
                   mysql_real_escape_string ($name, $db),
                   mysql_real_escape_string ($title, $db),
                   $idx, $menu, $s);
    $qry = mysql_query ($sql, $db) or die(mysql_error());
    $res = ($s != 0) ? $s : mysql_insert_id ($db);
    db_disconnect ($db);

    return $res;
}

function update_subsection ($args)
{
    $s = 0;
    $ss = 0;

    if (get_magic_quotes_gpc ())
        foreach ($args as $key => $val)
            $$key = stripslashes ($val);
    else
        foreach ($args as $key => $val)
            $$key = $val;

    if ($ss != 0)
        $sql = "UPDATE subsection " .
               "SET name=%s,title='%s',modification_time=NOW() " .
               "WHERE section = %d AND subsection=%d";
    else
        $sql = "INSERT INTO subsection (name,title,section,creation_time," .
                                       "modification_time) " .
               "VALUES (%s,'%s',%d,NOW(),NOW())";

    $db =  db_connect ();
    $sql = sprintf($sql,
                   (strlen (trim ($name)) == 0) ? "NULL" :
                       "'" . mysql_real_escape_string ($name, $db) . "'",
                   mysql_real_escape_string ($title, $db),
                   $s, $ss);
    $qry = mysql_query ($sql, $db) or die(mysql_error());
    $res = ($ss != 0) ? $ss : mysql_insert_id ($db);
    db_disconnect ($db);

    return $res;
}

function update_page ($args)
{
    $s = 0;
    $ss = 0;
    $p = 0;

    if (get_magic_quotes_gpc ())
        foreach ($args as $key => $val)
            $$key = stripslashes ($val);
    else
        foreach ($args as $key => $val)
            $$key = $val;

    if ($p != 0)
        $sql = "UPDATE page " .
               "SET name=%s,title='%s',body='%s',style='%s',script='%s'," .
                   "banner='%s',footer='%s',has_slideshow=%d,has_news=%d," .
                   "modification_time=NOW() " .
               "WHERE section=%d AND subsection=%d AND page=%d";
    else
        $sql = "INSERT INTO page (name,title,body,style,script,banner,footer," .
                                 "has_slideshow,has_news,section,subsection," .
                                 "creation_time,modification_time) " .
               "VALUES (%s,'%s','%s','%s','%s','%s','%s',%d,%d,%d,%d,NOW(),NOW())";

    $db =  db_connect ();
    $sql = sprintf($sql,
                   (strlen (trim ($name)) == 0) ? "NULL" :
                       "'" . mysql_real_escape_string ($name, $db) . "'",
                   mysql_real_escape_string ($title, $db),
                   mysql_real_escape_string ($code, $db),
                   mysql_real_escape_string ($style, $db),
                   mysql_real_escape_string ($script, $db),
                   mysql_real_escape_string ($banner, $db),
                   mysql_real_escape_string ($footer, $db),
                   $has_slideshow, $has_news, $s, $ss, $p);
    $qry = mysql_query ($sql, $db) or die(mysql_error());
    //$qry = mysql_query ("SELECT LAST_INSERT_ID()", $db) or die(mysql_error());
    //$res = mysql_fetch_row ($qry);
    $res = ($p != 0) ? $p : mysql_insert_id ($db);//$res [0];
    db_disconnect ($db);

    return $res;
}

function __execute ($sql)
{
    $db =  db_connect ();
    $qry = mysql_query ($sql, $db) or die(mysql_error());
    $res = mysql_affected_rows ($db);
    db_disconnect ($db);
    return $res;
}

function delete_section ($section)
{
    $sql = "DELETE FROM section WHERE idsection=%d";
    $sql = sprintf($sql, $section);
    return __execute ($sql);
}

function delete_subsection ($section, $subsection)
{
    $sql = "DELETE FROM subsection WHERE section=%d AND subsection=%d";
    $sql = sprintf($sql, $section, $subsection);
    return __execute ($sql);
}

function delete_page ($section, $subsection, $page)
{
    $sql = "DELETE FROM page WHERE section=%d AND subsection=%d AND page=%d";
    $sql = sprintf($sql, $section, $subsection, $page);
    return __execute ($sql);
}
?>