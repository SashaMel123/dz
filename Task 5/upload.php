<?php


if(!isset($_POST["submit"])){
    header("Location: index.php");
}


$fileName = $_FILES["fileToUpload"]["name"];
$fileSize = $_FILES["fileToUpload"]["size"];
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$fileExtensions = ['txt', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif'];


if(file_exists("uploads/". $fileName)){
    echo "Файл з ім'ям $fileName вже є, придумай шось інакше.";
}

elseif(!in_array($fileExtension, $fileExtensions)){
    echo "Вибери шось інакше.";
}

elseif($fileSize > 10000000){
    echo "Файл капець який великий. Максимальний розмір файлу - 10MB.";
}

else{
    $newFileName = $_POST["fileName"]. "_". date("Y-m-d_H-i-s"). ".". $fileExtension;
    if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])){
        $uploadDir = "uploads/images/";
        if(!file_exists($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }
    } else {
        $uploadDir = "uploads/docs/";
        if(!file_exists($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }
    }
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadDir. $newFileName);
    echo "Повезло, файл $newFileName успішно завантажено.";
}


$files = scandir("uploads");
echo "<h2>Файли в папці uploads:</h2><ul>";
foreach($files as $file){
    if($file!= "." && $file!= ".."){
        echo "<li>$file</li>";
    }
}
echo "</ul>";

$images = scandir("uploads/images");
echo "<h2>Файли в папці images:</h2><ul>";
foreach($images as $image){
    if($image!= "." && $image!= ".."){
        echo "<li>$image</li>";
    }
}
echo "</ul>";

$docs = scandir("uploads/docs");
echo "<h2>Файли в папці docs:</h2><ul>";
foreach($docs as $doc){
    if($doc!= "." && $doc!= ".."){
        echo "<li>$doc</li>";
    }
}
echo "</ul>";

?>
    <p>
        <a href="index.php">Go home</a>
    </p>

