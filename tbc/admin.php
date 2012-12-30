<?php
require_once ("_html_.php");
require_once ("_data_.php");

$menu = get_menu ();
$site_map = get_site_map ();
$page = array("title" => "Administración",
              "slideshow" => false,
              "style" => null,
              "script" => null,
              "banner" => null,
              "body" => build_map_element ($site_map),
              "news" => null,
              "footer" => null);

start_doc ();
myheader ("The Business Coach - " . $page ["title"]);
start_body ();
header_element ($menu);
body_element ($page ["body"]);
footer_element ($page ["footer"]);
end_body ();
end_doc ();
?>