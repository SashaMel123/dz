<?php
$FILES = 'files';
$FILES_N = 'files_new';

include './functions/translit.php';
include './functions/getfiles.php';
include './functions/deletesymbols.php';

$files = getfiles($FILES);

$new_files = [];
foreach ($files as $file) {
    $new_files[$file] = translit($file);
}

$new_files_clear = [];
foreach ($new_files as $key => $file) {
    $new_files_clear[$key] = deletesymbols($file);
}

print_r($new_files_clear);

function rename_files($FILES, $FILES_N): void
{
    if (!file_exists($FILES_N)) {
        mkdir($FILES_N, 0777, true);
    }

    $files = scandir($FILES);
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $new_name = generate_new_name($file);
            copy($FILES . "/" . $file, $FILES_N . "/" . $new_name);
        }
    }
}

function generate_new_name($name): string
{
    $name_parts = explode(".", $name);
    $extension = array_pop($name_parts);
    $new_name = '';
    $upper = true;
    foreach ($name_parts as $part) {
        if ($upper) {
            $new_name.= strtoupper($part);
        } else {
            $new_name.= strtolower($part);
        }
        $upper =!$upper;
    }
    $new_name.= "." . $extension;
    return $new_name;
}

rename_files($FILES, $FILES_N);