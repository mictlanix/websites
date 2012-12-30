<?php

function indent_line ($s, $n = 0)
{
    echo str_repeat("    ", $n);
    echo $s;
    echo "\n";
}

function indent_content ($content, $n = 0)
{
    foreach (explode ("\n", $content) as $s)
        indent_line ($s, $n);
}

function start_doc ()
{
    indent_line ("<?xml version=\"1.0\" encoding=\"utf-8\"?>");
    indent_line ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">");
    indent_line ("<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"es\">");
}

function end_doc ()
{
    indent_line ("</html>");
}

function header_meta ($name, $content)
{
    indent_line ("<meta name=\"$name\" content=\"$content\"/>", 2);
}

function header_css ($ref)
{
    indent_line ("<link rel=\"stylesheet\" type=\"text/css\" href=\"$ref\"/>", 2);
}

function header_js ($src)
{
    indent_line ("<script type=\"text/javascript\" src=\"$src\"></script>", 2);
}

function myheader ($title, $slideshow = FALSE, $style = NULL, $script = NULL, $wym = FALSE)
{
    indent_line ("<head>", 1);
    indent_line ("<meta http-equiv=\"Content-Type\" content=\"text/xhtml; charset=UTF-8\"/>", 2);
    indent_line ("<title>$title</title>", 2);
    header_meta ("keywords", "planeacion, estrategia, estrategica, negocio, indicador, desempeño");
    header_meta ("description", "The Business Coach");
    header_meta ("author", "Eddy Zavaleta <eddy@mictlanix.org>");
    header_meta ("copyright", "2011 © mictlanix.org");
    if($slideshow)
    {
        header_css ("/css/slideshow.css");
        header_css ("/css/markers.css");
    }
    header_css ("/css/main.css");
    if($style != NULL)
    {
        if (file_exists ($style))
            header_css ($style);
        else
        {
            indent_line ("<style type=\"text/css\">", 2);
            indent_content ($style, 3);
            indent_line ("</style>", 2);
        }
    }
    if($slideshow)
    {
        header_js ("/js/mootools.js");
        header_js ("/js/slideshow.js");
        header_js ("/js/slideshow.markers.js");
    }
    if($wym)
    {
        header_js ("/wym/jquery.js");
        header_js ("/wym/jquery.wymeditor.min.js");
        indent_line ("<script type=\"text/javascript\">", 2);
        indent_content (
"//<![CDATA[
jQuery(function() {
    jQuery('.editor').wymeditor({
        logoHtml: '',
        classesItems: [
            {'name': 'clear',     'title': 'Clear [p]', 'expr': 'p'},
            {'name': 'center',     'title': 'Center [p]', 'expr': 'p'},
            {'name': 'right',     'title': 'Right [p]', 'expr': 'p'},
            {'name': 'justify',     'title': 'Justify [p]', 'expr': 'p'},
            {'name': 'separator', 'title': 'Separator [p]', 'expr': 'p'},
            {'name': 'column',    'title': 'Column [ul]', 'expr': 'ul'},
            {'name': 'button',    'title': 'Button [a]', 'expr': 'a'},
            {'name': 'border',    'title': 'Border [table]', 'expr': 'table'}
        ],
        preInit: function(wym) {
            wym._options.toolsItems[16].name = 'MyPreview';
        },
        postInit: function(wym) {
            jQuery(wym._box).find(wym._options.containersSelector)
                .removeClass('wym_dropdown')
                .addClass('wym_panel')
                .find('h2 > span')
                .remove();
            jQuery(wym._box).find('li.wym_tools_preview a')
                .click(function() {
                    doPreview ();
                    return(false);
                });
            jQuery(wym._box).find(wym._options.iframeSelector)
                .css('height', '400px');
        }
    });
});

function doPreview() {
    document.editForm.action = 'preview.php';
    document.editForm.target = 'Preview_Window';
    document.editForm.code.value = jQuery.wymeditors(0).xhtml();

    window.open('', 'Preview_Window', 'menubar=no,titlebar=no,toolbar=no,resizable=no,scrollbars=yes,width=560,height=300,top=0,left=0');
    //window.open('about:blank','Preview_Window');
    document.editForm.submit();

    return false;
}

function doSave() {
    document.editForm.action = 'edit.php';
    document.editForm.target = '';
    document.editForm.code.value = jQuery.wymeditors(0).xhtml();
    document.editForm.submit();

    return true;
}
//]]>", 3);
        indent_line ("</script>", 2);

    }
    if($script != NULL)
    {
        indent_line ("<script type=\"text/javascript\">", 2);
        indent_line ("//<![CDATA[", 3);
        indent_content ($script, 4);
        indent_line ("//]]>", 2);
        indent_line ("</script>", 2);
    }
    
    indent_line ("<script type=\"text/javascript\">", 2);
    indent_content (
"//<![CDATA[
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18900587-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
//]]>", 3);
    indent_line ("</script>", 2);
    
    indent_line ("</head>", 1);
}

function start_body ()
{
    indent_line ("<body>", 1);
}

function end_body ()
{
    indent_line ("</body>", 1);
}

function header_element ($menu, $section = NULL)
{
    $indent = 2;

    indent_line ("<div id=\"header\">", $indent++);
    indent_line ("<div class=\"content\">", $indent++);
    indent_line ("<div id=\"menu\">", $indent++);
    indent_line ("<ul>", $indent++);
    foreach($menu as $name => $title)
    {
        if(strcasecmp($section, $name) == 0)
            indent_line ("<li class=\"active\">", $indent++);
        else
            indent_line ("<li>", $indent++);

        indent_line ("<a href=\"/$name\">", $indent++);
        indent_line ("<span>$title</span>", $indent);
        indent_line ("</a>", --$indent);
        indent_line ("</li>", --$indent);
    }
    indent_line ("</ul>", --$indent);
    indent_line ("</div>", --$indent);
    indent_line ("<div id=\"logo\">", $indent++);
    indent_line ("<a href=\"/Home\">", $indent++);
    indent_line ("<img src=\"/images/logo.png\" alt=\"\"/>", $indent);
    indent_line ("</a>", --$indent);
    indent_line ("</div>", --$indent);
    indent_line ("</div>", --$indent);
    indent_line ("</div>", --$indent);
}

function banner_element ($content)
{
    if(!isset ($content) || $content == NULL)
        return;

    $indent = 2;

    indent_line ("<div id=\"banner\">", $indent++);
    indent_line ("<div class=\"content\">", $indent++);

    indent_content ($content, $indent);

    indent_line ("</div>", --$indent);
    indent_line ("</div>", --$indent);
}

function body_element ($content, $news = NULL)
{
    if(!isset ($content) || $content == NULL)
        return;

    $indent = 2;

    indent_line ("<div id=\"body\">", $indent++);
    indent_line ("<div class=\"content\">", $indent++);
    indent_line ("<div class=\"text-content\">", $indent++);

    indent_content ($content, $indent);

    indent_line ("</div>", --$indent);
    indent_line ("</div>", --$indent);
    indent_line ("</div>", --$indent);
}

function footer_element ($content = NULL)
{
    $indent = 2;

    indent_line ("<div id=\"footer\">", $indent++);
    indent_line ("<div class=\"content\">", $indent++);

    if(isset ($content) && $content != NULL)
        indent_content ($content, $indent);

    indent_line ("</div>", --$indent);
    indent_line ("<div class=\"copyright\">Powered by <a href=\"http://mictlanix.org\">mictlanix</a> | mictlanix.org</div>", $indent);
    indent_line ("</div>", --$indent);
}

function build_map_element ($site_map)
{
    $html = "<ul class=\"map\">\n";

    foreach ($site_map as $skey => $section) {
        $html .= "<li><a href=\"edit.php?s=" . $skey . "\" target=\"_blank\">";
        $html .= $section ["title"] . "</a> [<a href=\"edit.php?s=";
        $html .= $skey . "&new=ss\" target=\"_blank\">+</a>]</li>\n";

        if (count ($section ["items"]) == 0)
            continue;

        $html .= "<ul class=\"map\">\n";

        foreach ($section ["items"] as $sskey => $subsection) {
            $html .= "<li><a href=\"edit.php?s=" . $skey . "&ss=" . $sskey;
            $html .= "\" target=\"_blank\">" . $subsection ["title"] . "</a>";
            $html .= " [<a href=\"edit.php?s=" . $skey . "&ss=" . $sskey;
            $html .= "&new=p\" target=\"_blank\">+</a>]</li>\n";

            if (count ($subsection ["items"]) == 0)
                continue;

            $html .= "<ul class=\"map\">\n";
            foreach ($subsection ["items"] as $pkey => $page) {
                $html .= "<li><a href=\"edit.php?s=" . $skey . "&ss=" . $sskey;
                $html .= "&p=" . $pkey . "\" target=\"_blank\">";
                $html .= $page ["title"] . "</a></li>\n";
            }
            $html .= "</ul>\n";
        }
        
        $html .= "</ul>\n";
    }
    $html .= "<li>[<a href=\"edit.php?new=s\" target=\"_blank\">+</a>]</li>\n";
    $html .= "</ul>";

    return $html;
}

function get_form ($item, $flags)
{
    if ($flags & FLAGS_PAGE)
        return get_page_form ($item);
    else if ($flags & FLAGS_SUBSECTION)
        return get_subsection_form ($item);
    else
        return get_section_form ($item);
}

function get_section_form ($item)
{
    if (!isset ($item ["name"]))
        $item ["name"] = NULL;

    if (!isset ($item ["title"]))
        $item ["title"] = NULL;

    if (!isset ($item ["idx"]))
        $item ["idx"] = 0;

    if (!isset ($item ["is_menu"]))
        $item ["is_menu"] = false;

    $html = "<form method=\"get\">\n";
    $html .= "<fieldset>\n";
    $html .= "<label for=\"name\">Nombre</label>\n";
    $html .= "<input id=\"name\" class=\"text\" name=\"name\" value=\"";
    $html .= $item ["name"] . "\"/>";
    $html .= "<br/>\n";
    $html .= "<label for=\"title\">Título</label>\n";
    $html .= "<input id=\"title\" class=\"text\" name=\"title\" value=\"";
    $html .= $item ["title"] . "\"/>";
    $html .= "<br/>\n";
    $html .= "<label for=\"idx\">Índice</label>\n";
    $html .= "<input id=\"idx\" class=\"text\" name=\"idx\" value=\"";
    $html .= $item ["idx"] ."\"/>";
    $html .= "<br/>\n";
    $html .= "<label>Menú</label>\n";
    $html .= "<input type=\"radio\" name=\"menu\" value=\"1\" ";
    $html .= ($item ["is_menu"] ? "checked=\"checked\"" : "") ."/>";
    $html .= "<span>Si</span>\n";
    $html .= "<input type=\"radio\" name=\"menu\" value=\"0\" ";
    $html .= ($item ["is_menu"] ? "" : "checked=\"checked\"") ."/>";
    $html .= "<span>No</span><br/>\n";
    $html .= "<button type=\"submit\">Guardar</button>\n";
    if (isset ($item ["idsection"]))
    {
        $html .= "<button name=\"delete\" type=\"submit\">Eliminar</button>\n";
        $html .= "<input type=\"hidden\" name=\"save\" value=\"s\"/>\n";
        $html .= "<input type=\"hidden\" name=\"s\" value=\"";
        $html .= $item ["idsection"] ."\"/>\n";
    }
    else
    {
        $html .= "<input type=\"hidden\" name=\"save\" value=\"s\"/>\n";
    }
    $html .= "</fieldset>\n";
    $html .= "</form>";

    return $html;
}

function get_subsection_form ($item)
{
    if (!isset ($item ["name"]))
        $item ["name"] = NULL;

    if (!isset ($item ["title"]))
        $item ["title"] = NULL;

    $html = "<form method=\"get\">\n";
    $html .= "<fieldset>\n";
    $html .= "<label for=\"name\">Nombre</label>\n";
    $html .= "<input id=\"name\" class=\"text\" name=\"name\" value=\"";
    $html .= $item ["name"] . "\"/>";
    $html .= "<br/>\n";
    $html .= "<label for=\"title\">Título</label>\n";
    $html .= "<input id=\"title\" class=\"text\" name=\"title\" value=\"";
    $html .= $item ["title"] . "\"/>";
    $html .= "<br/>\n";
    $html .= "<button type=\"submit\">Guardar</button>\n";
    if (isset ($item ["subsection"]))
    {
        $html .= "<button name=\"delete\" type=\"submit\">Eliminar</button>\n";
        $html .= "<input type=\"hidden\" name=\"save\" value=\"ss\"/>\n";
        $html .= "<input type=\"hidden\" name=\"s\" value=\"";
        $html .= $item ["section"] ."\"/>\n";
        $html .= "<input type=\"hidden\" name=\"ss\" value=\"";
        $html .= $item ["subsection"] ."\"/>\n";
    }
    else
    {
        $html .= "<input type=\"hidden\" name=\"save\" value=\"ss\"/>\n";
        $html .= "<input type=\"hidden\" name=\"s\" value=\"";
        $html .= $item ["section"] ."\"/>\n";
    }
    $html .= "</fieldset>\n";
    $html .= "</form>";

    return $html;
}

function get_page_form ($item)
{
    if (!isset ($item ["name"]))
        $item ["name"] = NULL;

    if (!isset ($item ["title"]))
        $item ["title"] = NULL;

    if (!isset ($item ["has_slideshow"]))
        $item ["has_slideshow"] = FALSE;

    if (!isset ($item ["has_news"]))
        $item ["has_news"] = FALSE;

    if (!isset ($item ["body"]))
        $item ["body"] = NULL;

    if (!isset ($item ["style"]))
        $item ["style"] = NULL;

    if (!isset ($item ["script"]))
        $item ["script"] = NULL;

    if (!isset ($item ["banner"]))
        $item ["banner"] = NULL;

    if (!isset ($item ["footer"]))
        $item ["footer"] = NULL;

    $html = "<form name=\"editForm\" method=\"post\">\n";
    $html .= "<fieldset>\n";
    $html .= "<label for=\"name\">Nombre</label>\n";
    $html .= "<input id=\"name\" class=\"text\" name=\"name\" value=\"";
    $html .= $item ["name"] . "\"/>";
    $html .= "<br/>\n";
    $html .= "<label for=\"title\">Título</label>\n";
    $html .= "<input id=\"title\" class=\"text\" name=\"title\" value=\"";
    $html .= $item ["title"] . "\"/>";
    $html .= "<br/>\n";
    $html .= "<label>Slideshow</label>\n";
    $html .= "<input type=\"radio\" name=\"has_slideshow\" value=\"1\" ";
    $html .= ($item ["has_slideshow"] ? "checked=\"checked\"" : "") ."/>";
    $html .= "<span>Si</span>\n";
    $html .= "<input type=\"radio\" name=\"has_slideshow\" value=\"0\" ";
    $html .= ($item ["has_slideshow"] ? "" : "checked=\"checked\"") ."/>";
    $html .= "<span>No</span>";
    $html .= "<br/>\n";
    $html .= "<label>Noticias</label>\n";
    $html .= "<input type=\"radio\" name=\"has_news\" value=\"1\" ";
    $html .= ($item ["has_news"] ? "checked=\"checked\"" : "") ."/>";
    $html .= "<span>Si</span>\n";
    $html .= "<input type=\"radio\" name=\"has_news\" value=\"0\" ";
    $html .= ($item ["has_news"] ? "" : "checked=\"checked\"") ."/>";
    $html .= "<span>No</span>";
    $html .= "<br/><br/>\n";
    $html .= "<label for=\"code\">Cuerpo</label>\n";
    $html .= "<textarea id=\"code\" name=\"code\" cols=\"40\" rows=\"5\" class=\"editor\">";
    $html .= htmlspecialchars ($item ["body"]) . "</textarea>\n";
    $html .= "<br/>\n";
    $html .= "<label for=\"style\">Style</label>\n";
    $html .= "<textarea id=\"style\" name=\"style\" cols=\"40\" rows=\"5\">";
    $html .= htmlspecialchars ($item ["style"]) . "</textarea>\n";
    $html .= "<br/>\n";
    $html .= "<label for=\"script\">Script</label>\n";
    $html .= "<textarea id=\"script\" name=\"script\" cols=\"40\" rows=\"5\">";
    $html .= htmlspecialchars ($item ["script"]) . "</textarea>\n";
    $html .= "<br/>\n";
    $html .= "<label for=\"banner\">Banner</label>";
    $html .= "<textarea id=\"banner\" name=\"banner\" cols=\"40\" rows=\"5\">";
    $html .= htmlspecialchars ($item ["banner"]) . "</textarea>\n";
    $html .= "<br/>\n";
    $html .= "<label for=\"footer\">Footer</label>\n";
    $html .= "<textarea id=\"footer\" name=\"footer\" cols=\"40\" rows=\"5\">";
    $html .= htmlspecialchars ($item ["footer"]) . "</textarea>\n";
    $html .= "<br/><br/>\n";
    $html .= "<button type=\"submit\" onclick=\"doSave();\">Guardar</button>\n";
    if (isset ($item ["page"]))
    {
        $html .= "<button name=\"delete\" type=\"submit\">Eliminar</button>\n";
        $html .= "<input type=\"hidden\" name=\"save\" value=\"s\"/>\n";
        $html .= "<input type=\"hidden\" name=\"s\" value=\"";
        $html .= $item ["section"] ."\"/>\n";
        $html .= "<input type=\"hidden\" name=\"ss\" value=\"";
        $html .= $item ["subsection"] ."\"/>\n";
        $html .= "<input type=\"hidden\" name=\"p\" value=\"";
        $html .= $item ["page"] ."\"/>\n";
    }
    else
    {
        $html .= "<input type=\"hidden\" name=\"save\" value=\"p\"/>\n";
        $html .= "<input type=\"hidden\" name=\"s\" value=\"";
        $html .= $item ["section"] ."\"/>\n";
        $html .= "<input type=\"hidden\" name=\"ss\" value=\"";
        $html .= $item ["subsection"] ."\"/>\n";
    }
    $html .= "</fieldset>\n";
    $html .= "</form>";

    return $html;
}
?>
