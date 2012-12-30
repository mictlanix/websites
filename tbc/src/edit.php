<?php
require_once ("_globals_.php");
require_once ("_html_.php");
require_once ("_data_.php");

$flags = 0;
$title = "untitled";
$menu = null;
$item = null;
$page = null;

if (isset ($_REQUEST ["s"]))
{
    $section = $_REQUEST ["s"];
    $flags |= FLAGS_SECTION;
}

if (isset ($_REQUEST ["ss"]))
{
    $subsection = $_REQUEST ["ss"];
    $flags |= FLAGS_SUBSECTION;
}

if (isset ($_REQUEST ["p"]))
{
    $page = $_REQUEST ["p"];
    $flags |= FLAGS_PAGE;
}

if (isset ($_REQUEST ["delete"]))
{
    if ($flags & FLAGS_PAGE)
    {
        delete_page ($section, $subsection, $page);
    }
    else if ($flags & FLAGS_SUBSECTION)
    {
        delete_subsection ($section, $subsection);
    }
    else
    {
        delete_section ($section);
    }
    $flags = 0;
}
else if (isset ($_REQUEST ["save"]))
{
    if ($_REQUEST ["save"] == "p")
        $flags |= FLAGS_PAGE;
    else if ($_REQUEST ["save"] == "ss")
        $flags |= FLAGS_SUBSECTION;
    else if ($_REQUEST ["save"] == "s")
        $flags |= FLAGS_SECTION;
    
    if ($flags & FLAGS_PAGE)
    {
        $page = update_page ($_REQUEST);
        $flags = FLAGS_SECTION_SUBSECTION_PAGE;
    }
    else if ($flags & FLAGS_SUBSECTION)
    {
        $subsection = update_subsection ($_REQUEST);
        $flags = FLAGS_SECTION_SUBSECTION;
    }
    else
    {
        $section = update_section ($_REQUEST);
        $flags = FLAGS_SECTION;
    }
}

if ($flags == FLAGS_SECTION_SUBSECTION_PAGE)
{
    $title = "Página [Edición]";
    $item = get_page ($section, $subsection, $page);
}
else if ($flags == FLAGS_SECTION_SUBSECTION)
{
    $title = "Subsección [Edición]";
    $item = get_subsection ($section, $subsection);
}
else if ($flags == FLAGS_SECTION)
{
    $title = "Sección [Edición]";
    $item = get_section ($section);
}

if (isset ($_REQUEST ["new"]))
{
    switch ($_REQUEST ["new"])
    {
        case "s":
            $title = "Sección [Nueva]";
            $flags = FLAGS_SECTION;
            break;
        case "ss":
            $title = "Subsección [Nueva]";
            $flags = FLAGS_SUBSECTION;
            $item = array("section" => $section);
            break;
        case "p":
            $title = "Página [Nueva]";
            $flags = FLAGS_PAGE;
            $item = array("section" => $section,
                          "subsection" => $subsection);
            break;
    }
}

start_doc ();
myheader ($MAIN_TITLE . " - " . $title, FALSE, "css/edit.css", NULL,
          ($flags & FLAGS_PAGE) ? TRUE : FALSE);
start_body ();
header_element (get_menu ());
body_element (get_form ($item, $flags));
footer_element ();
end_body ();
end_doc ();
?>