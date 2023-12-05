<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Sommertraum: Reservierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php include '../utils/navbar.php'; ?>


    </div class="container" style="margin-bottom: 100px;">
    <h1>Ihre Reservierungen</h1>
    <div class="d-grid gap-3 col-6 mx-auto">
        <h3 style="text-align: justify;">
            <?php
            if (isset($_SESSION['zimmer'])) {
                echo 'Zimmer: ' . $_SESSION['zimmer'] . '<br>';
            }
            if (isset($_SESSION['arrival'])) {
                echo 'Anreisedatum: ' . $_SESSION['arrival'] . '<br>';
            }
            if (isset($_SESSION['departure'])) {
                echo 'Abreisedatum: ' . $_SESSION['departure'] . '<br>';
            }
            if (isset($_SESSION['breakfast'])) {
                echo 'Frühstück: ' . $_SESSION['breakfast'] . '<br>';
            }
            if (isset($_SESSION['parking'])) {
                echo 'Parkplatz: ' . $_SESSION['parking'] . '<br>';
            }
            if (isset($_SESSION['tiere'])) {
                echo 'Haustiere: ' . $_SESSION['tiere'] . '<br>';
            }
            if (
                empty($_SESSION['zimmer']) && empty($_SESSION['arrival']) && empty($_SESSION['departure'])
                && empty($_SESSION['breakfast']) && empty($_SESSION['parking']) && empty($_SESSION['tiere'])
            ) {
                echo '<h2>Du hast derzeit keine Buchungen!</h2>';
            }
            ?>
        </h3>
    </div>

    </div>

    <?php include '../utils/footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>