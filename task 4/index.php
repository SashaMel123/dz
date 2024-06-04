<?php
$FILES = 'files'; // константа в яку записали назву папки з оригінальними файлами
$FILES_N = 'files_new'; // константа в яку записали назву папки для копій

include './functions/translit.php'; // функція яка заміняє кирилицю на латиницю
include './functions/getfiles.php'; // функція яка повертає масив файлів в папці (їх назви)
include './functions/deletesymbols.php'; // функція яка видаляє зайві символи

// 1. Подивитись в папку з файлами та вивести їх в консоль.
$files = getfiles($FILES); // масив що містить старі назви файлів

// 2. Створити функцію, яка замінить літери з кирилиці на латиницю
$new_files = []; // масив латинських назв
foreach ($files as $file) {
    $new_files[$file] = translit($file);
}

// 3. Створити функцію, яка видаляє символи, пробіли з рядка
$new_files_clear = []; // масив латинських назв без зайвих символів
foreach ($new_files as $key => $file) {
    $new_files_clear[$key] = deletesymbols($file);
}

print_r($new_files_clear); // Отримали індексований масив, у якого ключ - стара назва, значення - нова назва.


//TODO:Написати функцію, яка створить перейменовані копії файлів в папці $FILES_N (files_new)

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

rename_files($FILES, $FILES_N); // Створили копії файлів з новими назвами в папці files_new
