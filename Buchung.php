<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Sommertraum - Buchung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container" style="margin-bottom: 100px;">
        <h1>Zimmerauswahl</h1>
        <?php $_SESSION['zimmer'] = '' ?>
        <div class="container text-center">
            <div class="row row-cols-4 align-items-start">
                <div class="col">
                    <div class="card" class="" style="width: 18rem;" data-bs-theme="white">
                        <img src="img/zimmer1.jpg" class="card-img-top" alt="Zimmer 1" height="170" width="auto">
                        <div class="card-body">
                            <h5 class="card-title">Doppelbettzimmer</h5>
                            <p class="card-text">50€ / Nacht<br>⠀</p><br>
                            <a href="zimmer1.php" class="btn btn-primary">Jetzt Reservieren</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" class="" style="width: 18rem;" data-bs-theme="white">
                        <img src="img/zimmer2.jpg" class="card-img-top" alt="Zimmer 2" height="170" width="auto">
                        <div class="card-body">
                            <h5 class="card-title">Luxussuite</h5>
                            <p class="card-text">100€ / Nacht<br>⠀</p><br>
                            <a href="zimmer2.php" class="btn btn-primary">Jetzt Reservieren</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" class="" style="width: 18rem;" data-bs-theme="white">
                        <img src="img/zimmer3.jpg" class="card-img-top" alt="Zimmer 3" height="170" width="auto">
                        <div class="card-body">
                            <h5 class="card-title">Luxussuite mit Jacuzzi</h5>
                            <p class="card-text">180€ / Nacht<br>⠀</p><br>
                            <a href="zimmer3.php" class="btn btn-primary">Jetzt Reservieren</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" class="" style="width: 18rem;" data-bs-theme="white">
                        <img src="img/zimmer4.jpg" class="card-img-top" alt="Zimmer 4" height="170" width="auto">
                        <div class="card-body">
                            <h5 class="card-title">Luxussuite mit Jacuzzi und Sauna</h5>
                            <p class="card-text">500€ / Nacht<br>⠀</p>
                            <a href="zimmer4.php" class="btn btn-primary">Jetzt Reservieren</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>