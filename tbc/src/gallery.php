<?php
require_once ("_globals_.php");
require_once ("_file_utils_.php");

error_reporting (E_ALL);
ini_set("display_errors", 1);

function get_slideshow_data ($path = DIR_UPLOADS)
{
    if (substr ($path, -1) != DIRECTORY_SEPARATOR)
        $path .= DIRECTORY_SEPARATOR;
    
    $files = get_image_files ($path, 0, 0);

    $script = "\n";

    foreach ($files as $file)
    {
        $script .= str_repeat (" ", 24);
        $script .= "'$file': { caption: '$file', href: '$path/$file' },\n";
    }

    $script = substr ($script, 0, strlen ($script) - 2);

    return $script;
}

function msg_ok ($s)
{
    return "<p style='color:green;'>$s</p>";
}

function msg_err ($s)
{
    return "<p style='color:red;'>$s</p>";
}

if (array_key_exists ('upload', $_POST))
{
    try {
        $path = upload_image ('image_upload', 'uploads/');

        if (file_exists ($path))
            $msg = msg_ok ("La imagen $path se ha subido correctamente.");
        else
            $msg = msg_err ("Se produjo un error al subir la imagen. " .
                            "Por favor, inténtelo de nuevo.");
    } catch (Exception $e) {
        $msg = msg_err ($e->getMessage());
    }
}
else if (array_key_exists ('delete', $_POST))
{
    $path = $_POST ['image'];

    if (file_exists ($path))
        unlink ($path);

    if (!file_exists ($path))
        $msg = msg_ok ("El archivo $path se eliminó correctamente.");
    else
        $msg = msg_err ("El archivo $path no se pudo eliminar.");
}

$files = get_slideshow_data ();

?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="keywords" content="planeacion, estrategia, estrategica, negocio, indicador, desempeño"/>
        <meta name="description" content="The Business Coach"/>
        <meta name="author" content="Eddy Zavaleta <eddy@mictlanix.org>" />
        <meta name="copyright" content="2011 © mictlanix.org" />
        <title>The Business Coach</title>
        <link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
        <link rel="stylesheet" type="text/css" href="css/gallery.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <script type="text/javascript" src="js/mootools.js"></script>
        <script type="text/javascript" src="js/slideshow.js"></script>
        <script type="text/javascript">
            //<![CDaTa[
            var data = {<?php echo $files; ?>};

            window.addEvent('domready', function(){
                var myShow = new Slideshow('gallery_show', data, {
                        hu:'<?php echo DIR_UPLOADS; ?>/', overlap:false,
                        resize:"length", center:true, controller:true,
                        transition:'back:in:out', paused:true, captions:true
                    });
            });
            function setSelectedImage() {
                var show = document.getElementById("gallery_show");
                var a = show.getElementsByTagName("a")[0];
                
                document.deleteForm.image.value = a.getAttribute("href");

                return true;
            }
            //]]>
        </script>
    </head>

    <body>
        <div id="header">
            <div class="content"> 
                <div id="logo">
                    <a href="Home">
                        <img src="images/logo.png" alt=""/>
                    </a>
                </div>
            </div>
        </div>
        <div id="banner">
            <div class="content">
                <div class="bg_slideshow">
                    <div id="gallery_show" class="slideshow"></div>
                    <form name="deleteForm" method="post" action="<?php echo $_SERVER ['PHP_SELF'];?>">
                        <input type="hidden" name="image" id="image" />
                        <input type="submit" name="delete" value="Eliminar" onclick="setSelectedImage();" />
                    </form>
                </div>
            </div>
        </div>
        <div id="body">
            <div class="content">
                <div class="text-content">
                    <form name="uploadForm" method="post" action="<?php echo $_SERVER ['PHP_SELF'];?>" enctype="multipart/form-data">
                        <input id="image_upload" type="file" name="image_upload" class="file" />
                        <input type="submit" name="upload" value="Subir" />
                    </form>
                    <?php echo isset ($msg) ? "$msg\n" : "\n";?>
                </div>
            </div>
        </div>
    </body>
</html>
