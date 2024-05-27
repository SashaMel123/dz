<?php

if (isset($_GET['file'])) {

    $fileName = $_GET['file'];

    $directory = 'uploads/';

    if (file_exists($directory . $fileName)) {

        unlink($directory . $fileName);

        header('Location: index.php');
    } else {

        echo 'File not found.';
    }
} else {

    echo 'Invalid request.';
}