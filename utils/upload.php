<?php
require_once 'dbaccess.php';
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadOk = 0;
    $target_dir = "../img/newsthumbnails/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Die Datei ist kein Bild.";
        $uploadOk = 0;
    }
}

if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Nur Dateiformate wie: JPG, JPEG, PNG & GIF sind erlaubt.";
    $uploadOk = 0;
}
//
if ($uploadOk == 0) {
    echo "Es gab einen Fehler beim Hochladen.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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