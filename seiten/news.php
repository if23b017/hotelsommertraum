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


    <div style="margin-bottom: 100px;">

        <h1>News</h1>

        <div class="d-grid gap-3 col-8 mx-auto">

            <div class="text-center">
                <h2>
                    <?php
                    if (isset($_SESSION["title"])) {
                        echo $_SESSION["title"];
                    } ?>
                </h2>
            </div>
            <div class="text-center">
                <?php
                if (isset($_SESSION["fileToUpload"])) {
                    echo '<img src="img/newsthumbnails/' . $_SESSION["fileToUpload"] . '" alt="Thumbnail" width="300" height="auto">';
                }
                ?>
            </div>
            <p style="text-align: justify;">
                <?php
                if (isset($_SESSION["text"])) {
                    echo $_SESSION["text"];
                }
                ?>
            </p>
            <h2>
                <?php
                if (isset($_SESSION["newsdate"])) {
                    echo "Hochgeladen am " . $_SESSION["newsdate"];
                }
                ?>
            </h2>
            <?php


            /*if (empty($_SESSION["title"]) && empty($_SESSION["fileToUpload"]) && empty($_SESSION["text"]) && empty($_SESSION["newsdate"])) {
                echo '<div class="text-center"><h2>Derzeit gibt es keine News!</h2></div>';
            }
            */
            ?>



            <div class="mb-3">
                <div class="text-center">
                    <h2>Unsere Umgebung</h2>
                </div>
                <div class="text-center">
                    <img src="img/newsthumbnails/newsarticle2.jpg" alt="News2" width="700" height:"auto"
                        class="img-thumbnail">
                </div>
                <br>
                <p style="text-align: justify;">
                    Umgeben von atemberaubender Natur und spannenden Sehenswürdigkeiten bietet unsere Umgebung
                    zahlreiche
                    Möglichkeiten für Abenteuer und Entspannung. Erkunden Sie lokale Attraktionen, wandern Sie durch
                    malerische
                    Landschaften oder lassen Sie sich von kulturellen Highlights verzaubern.
                </p>
                <h3>News vom 21.11.2023</h3>
            </div>
            <div class="mb-3">
                <div class="text-center">
                    <h2>Neueröffnung - Hotel Sommertraum</h2>
                </div>
                <div class="text-center">
                    <img src="img/newsthumbnails/newsarticle1.jpg" alt="News1" width="700" height:"auto"
                        class="img-thumbnail">
                </div>
                <br>
                <p style="text-align: justify;">
                    Erleben Sie den Komfort unserer frisch renovierten Zimmer, entspannen Sie sich am Pool und genießen
                    Sie kulinarische Köstlichkeiten in unseren hervorragenden Restaurants. Wir sind stolz darauf, Ihnen
                    ein verbessertes und unvergessliches Erlebnis bieten zu können.
                </p>
                <h3>News vom 10.11.2023</h3>

            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>