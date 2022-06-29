<?php

function adjuntar_archivo ($campo){

// Check $_FILES[$campo]['error'] value.
    switch ($_FILES[$campo]['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES[$campo]['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES[$campo]['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES[$campo]['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES[$campo]['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    $archivo= sprintf(__DIR__.'/../../adjuntos/%s.%s',
    basename($_FILES[$campo]['name']).
    sha1_file($_FILES[$campo]['tmp_name']),
    $ext
); 

    if (!move_uploaded_file(
        $_FILES[$campo]['tmp_name'],
        $archivo
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

   return basename($archivo);
}
?>