```php
<?php

// 1. Перевірити, чи була натиснута кнопка "submit" на формі
if(!isset($_POST["submit"])){
    header("Location: index.php"); // Якщо ні, перенаправити на головну сторінку
    exit(); // Додати exit, щоб зупинити виконання скрипта після перенаправлення
}

// 2. Отримаємо ім'я файлу, який користувач вибрав для завантаження
$fileName = $_FILES["fileToUpload"]["name"]; // Ім'я файлу
$fileSize = $_FILES["fileToUpload"]["size"]; // Розмір файлу
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Розширення файлу (малими літерами)
$fileExtensions = ['txt', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif']; // Допустимі розширення файлів

// 3. Перевірити, чи файл вже існує в папці "uploads"
if(file_exists("uploads/". $fileName)){
    echo "Файл з ім'ям $fileName вже існує."; // Вивести повідомлення, якщо файл існує
}
// 4. Перевірити, чи це підтримуваний тип файлу
elseif(!in_array($fileExtension, $fileExtensions)){
    echo "Цей тип файлу не підтримується."; // Вивести повідомлення, якщо розширення файлу не підтримується
}
// 5. Перевірити розмір файлу
elseif($fileSize > 10000000){
    echo "Файл занадто великий. Максимальний розмір файлу - 10MB."; // Вивести повідомлення, якщо файл перевищує допустимий розмір
}
// Все ОК, завантажуємо файл
else{
    // Створення нового імені файлу з унікальним суфіксом
    $newFileName = $_POST["fileName"]. "_". date("Y-m-d_H-i-s"). ".". $fileExtension;

    // Визначити папку для завантаження залежно від типу файлу
    if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])){
        $uploadDir = "uploads/images/";
        if(!file_exists($uploadDir)){
            mkdir($uploadDir, 0777, true); // Створити папку, якщо вона не існує
        }
    } else {
        $uploadDir = "uploads/docs/";
        if(!file_exists($uploadDir)){
            mkdir($uploadDir, 0777, true); // Створити папку, якщо вона не існує
        }
    }

    // Перемістити завантажений файл у відповідну папку
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadDir. $newFileName);
    echo "Файл $newFileName успішно завантажено."; // Вивести повідомлення про успішне завантаження
}

// Виведіть список файлів, які знаходяться в папці uploads та підпапках /images та /docs

// Функція для виводу списку файлів з вказаної директорії
function displayFiles($directory, $title) {
    $files = scandir($directory);
    echo "<h2>$title:</h2><ul>";
    foreach($files as $file){
        if($file != "." && $file != ".."){
            echo "<li>$file</li>"; // Вивести список файлів
        }
    }
    echo "</ul>";
}

// Отримати список файлів у папці uploads
displayFiles("uploads", "Файли в папці uploads");

// Отримати список файлів у папці uploads/images
displayFiles("uploads/images", "Файли в папці images");

// Отримати список файлів у папці uploads/docs
displayFiles("uploads/docs", "Файли в папці docs");

?>
<p>
    <a href="index.php">Go home</a> <!-- Посилання для повернення на головну сторінку -->
</p>
```
