<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Sommertraum: Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container" style="margin-bottom: 100px;">
        <h1>
            News-Upload
        </h1>
        <form action=" upload.php" method="post" enctype="multipart/form-data">
            <div class="cointainer">
                <div class="d-grid gap-4 col-4 mx-auto">
                    <div class="mb-3">
                        <label for="exampleFormControlText" class="form-label">
                            Newstitel:
                        </label>
                        <input type="text" class="form-control" name="title" placeholder="Newstitel" id="title"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label"></label>
                        Newstext
                        </label>
                        <textarea class="form-control" id="text" rows="3" name="text"></textarea>
                        <br>Bild auswählen
                        <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
                        <div class="d-grid gap-3 col-3 mx-auto"></div>
                        <input class="btn btn-primary" type="submit" value="Uploaden">
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>



</html>