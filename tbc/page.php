<?php
require_once ("_globals_.php");
require_once ("_html_.php");
require_once ("_data_.php");

if(!isset ($_REQUEST ["s"]) || $_REQUEST ["s"] == "")
    $section_name = DF_SECTION_NAME;
else
    $section_name = $_REQUEST ["s"];

if(!isset ($_REQUEST ["ss"]) || $_REQUEST ["ss"] == "")
    $subsection_name = DF_SUBSECTION_NAME;
else
    $subsection_name = $_REQUEST ["ss"];

if(!isset ($_REQUEST ["p"]) || $_REQUEST ["p"] == "")
    $page_name = DF_PAGE_NAME;
else
    $page_name = $_REQUEST ["p"];

$menu = get_menu ();
$page = get_page_from_name ($section_name, $subsection_name, $page_name);

start_doc ();
myheader ($MAIN_TITLE . " - " . $page ["title"], $page ["slideshow"],
          $page ["style"], $page ["script"]);
start_body ();
header_element ($menu, $section_name);
banner_element ($page ["banner"]);
body_element ($page ["body"], $page ["news"]);
footer_element ($page ["footer"]);
end_body ();
end_doc ();
?>