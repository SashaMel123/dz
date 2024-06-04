<?php

// Перевірка, чи встановлений параметр file
if (isset($_GET['file'])) {
    // Отримання імені файлу з параметра
    $fileName = $_GET['file'];

    // Визначення директорії, де знаходиться файл
    $directory = 'uploads/';

    // Перевірка, чи існує файл у вказаній директорії
    if (file_exists($directory . $fileName)) {
        // Видалення файлу
        unlink($directory . $fileName);

        // Переадресація на головну сторінку
        header('Location: index.php');
    } else {
        // Файл не знайдено
        echo 'File not found.';
    }
} else {
    // Параметр file не встановлений
    echo 'Invalid request.';
}
?>
