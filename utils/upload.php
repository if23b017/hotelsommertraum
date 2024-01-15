<?php
require_once 'dbaccess.php';
?>
<?php

// Überprüfen, ob das Formular mit der POST-Methode gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadOk = 0;
    $target_dir = "../uploads/news/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    // Überprüfen, ob die hochgeladene Datei ein Bild ist
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        header("location: ../index.php?page=newsupload&error=notanimage");
        exit();
    }
}

// Überprüfen, ob die Datei ein unterstütztes Bildformat hat
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $uploadOk = 0;
    header("location: ../index.php?page=newsupload&error=wrongfiletype");
    exit();
}

// Überprüfen, ob der Upload erfolgreich war
if ($uploadOk == 0) {
    header("location: ../index.php?page=newsupload&error=uploadfailed");
    exit();
} else {
    // Die hochgeladene Datei in den Zielordner verschieben und verkleinern
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $source_image = null;
        if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
            $source_image = imagecreatefromjpeg($target_file);
        } else if ($imageFileType == "png") {
            $source_image = imagecreatefrompng($target_file);
        } else if ($imageFileType == "gif") {
            $source_image = imagecreatefromgif($target_file);
        }
        if ($source_image) {
            $orig_width = imagesx($source_image);
            $orig_height = imagesy($source_image);
            $max_size = 1280;
            $ratio = $max_size / max($orig_width, $orig_height);
            $new_width = $orig_width * $ratio;
            $new_height = $orig_height * $ratio;

            $new_image = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);

            if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
                imagejpeg($new_image, $target_file);
            } else if ($imageFileType == "png") {
                imagepng($new_image, $target_file);
            } else if ($imageFileType == "gif") {
                imagegif($new_image, $target_file);
            }

            imagedestroy($source_image);
            imagedestroy($new_image);
        }
        echo "Die Datei " . basename($_FILES["fileToUpload"]["name"]) . " wurde hochgeladen.";
    } else {
        echo "Es tut uns leid, es gab einen Fehler beim Hochladen der Datei.";
    }

    // Die Informationen in die Datenbank einfügen
    $sql = "INSERT INTO news (title, newstext, newsdate, thumbnail) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?page=landing&error=stmtfailed");
        exit();
    }
    $title = $_POST["title"];
    $newstext = $_POST["newstext"];
    $newsdate = date("Y-m-d H:i:s", time());
    $thumbnail = str_replace("../", "", $target_file);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $newstext, $newsdate, $thumbnail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?page=news&error=noneUploadsuccess");
}
?>