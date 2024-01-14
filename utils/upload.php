<?php
require_once 'dbaccess.php';
?>
<?php
$target_dir = "img/newsthumbnails/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// 
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "Datei ist kein Bild - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Die Datei ist kein Bild.";
        $uploadOk = 0;
    }
}
// 
if (file_exists($target_file)) {
    echo "Die Datei wurde bereits hochgeladen.";
    $uploadOk = 0;
}
// 
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
    $target_dir = __DIR__ . "./img/newsthumbnails/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    //TODO: Daten in die Datenbank schreiben
    $sql = "INSERT INTO news (title, newsdate, newstext, thumbnail) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?page=landing&error=stmtfailed");
        exit();
    }
    $title = $_POST["title"];
    $newstext = $_POST["newstext"];
    $newsdate = date("Y-m-d H:i:s", time());
    $thumbnail = $target_file;
    mysqli_stmt_bind_param($stmt, "ssss", $title, $newstext, $newsdate, $thumbnail);
    mysqli_stmt_execute($stmt);

}
?>