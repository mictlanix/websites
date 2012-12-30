<?php

function get_files ($path, $offset = 0, $limit = 0, $types = array())
{
    $i = 0;
    $files = array ();
    $handle = opendir ($path);

    if (substr ($path, -1) != DIRECTORY_SEPARATOR)
        $path .= DIRECTORY_SEPARATOR;
    
    if ($handle)
    {
        //$finfo = finfo_open(FILEINFO_MIME_TYPE);

        do
        {
            $file = readdir ($handle);

            if($file && substr ($file, 0, 1) != ".")
            {
                if($offset > 0)
                {
                    $offset--;
                    continue;
                }

                if (is_array ($types) && !empty ($types))
                {
                    //$type = finfo_file ($finfo, $path . $file);
                    $type = getimagesize ($path . $file);
                    $type = $type ["mime"];
                    //$type = image_type_to_mime_type ($type [2]);
                    //echo "$file: $type\n";

                    if (!in_array ($type, $types))
                        continue;
                }

                $files [$i++] = $file;
            }
        }
        while ($file && ($limit == 0 || $i < $limit));

        //finfo_close ($finfo);
        closedir ($handle);
    }

    return $files;
}

function get_image_files ($path, $offset, $limit)
{
    return get_files ($path, $offset, $limit,
                      array ('image/gif', 'image/jpeg', 'image/png',
                             'image/svg+xml', 'image/tiff'));
}

function is_valid_image_type ($type)
{
    return in_array ($type, array ('image/jpeg', 'image/gif', 'image/svg+xml',
                                   'image/png', 'image/x-png', 'image/tiff',
                                   'image/bmp', 'image/x-icon'));
}

function upload_image ($field = '', $path = '')
{
    foreach ($_FILES[$field] as $key => $val)
        $$key = $val;

    if ((!is_uploaded_file($tmp_name)) || ($error != 0) || ($size == 0))
        return false;

    if (!is_valid_image_type ($type))
        throw new Exception("El archivo no es una imagen válida: " . $type);

    if (substr ($path, -1) != DIRECTORY_SEPARATOR)
        $path .= DIRECTORY_SEPARATOR;

    $path .= strtolower(str_replace(" ", "_", basename($name)));

    if (move_uploaded_file ($tmp_name, $path))
        return $path;

    return false;
}

?>
