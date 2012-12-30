<?php
ini_set ('short_open_tag', 0);
ini_set ('magic_quotes_gpc', 0);

$MSG_ERROR = "Disculpa, algo salió mal.\n".
    "Se ha enviado un equipo de monos especialmente entrenados ".
    "para resolver el problema.";

$MAIN_TITLE = "The Business Coach";

define ('DIR_UPLOADS',    "uploads");

define ('DF_SECTION_NAME',    "Home");
define ('DF_SUBSECTION_NAME', NULL);
define ('DF_PAGE_NAME',       NULL);

define ('FLAGS_SECTION',                 0x01);
define ('FLAGS_SUBSECTION',              0x02);
define ('FLAGS_PAGE',                    0x04);
define ('FLAGS_SECTION_SUBSECTION',      FLAGS_SECTION | FLAGS_SUBSECTION);
define ('FLAGS_SECTION_SUBSECTION_PAGE', FLAGS_SECTION | FLAGS_SUBSECTION | FLAGS_PAGE);
?>