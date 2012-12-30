<?php
require_once ("_globals_.php");
require_once ("_html_.php");
require_once ("_data_.php");

if (get_magic_quotes_gpc ())
    foreach ($_REQUEST as $key => $val)
        $_REQUEST [$key] = stripslashes ($val);

$menu = get_menu ();
$page = array ("title" => $_REQUEST ["title"],
               "slideshow" => $_REQUEST ["has_slideshow"],
               "news" => $_REQUEST ["has_news"],
               "style" => $_REQUEST ["style"],
               "script" => $_REQUEST ["script"],
               "banner" => $_REQUEST ["banner"],
               "body" => $_REQUEST ["code"],
               "footer" => $_REQUEST ["footer"]);

start_doc ();
myheader ($MAIN_TITLE . " - " . $page ["title"], $page ["slideshow"],
          $page ["style"], $page ["script"]);
start_body ();
header_element ($menu);
banner_element ($page ["banner"]);
body_element ($page ["body"], $page ["news"]);
footer_element ($page ["footer"]);
end_body ();
end_doc ();
?>