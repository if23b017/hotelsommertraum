<div class="container" style="margin-bottom: 100px;">
    <h1>Upload</h1>
    <div>
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
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Die Datei " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " wurde erfolgreich hochgeladen.";
                $_SESSION["text"] = $_POST["text"];
                $_SESSION["title"] = $_POST["title"];
                $timestamp = time();
                $_SESSION["newsdate"] = date("d.m.Y", $timestamp);
                $_SESSION["fileToUpload"] = $_FILES["fileToUpload"]["name"];
            } else {
                echo "Fehler beim hochladen der Datei.";
            }
        }

        ?>
    </div>
</div>