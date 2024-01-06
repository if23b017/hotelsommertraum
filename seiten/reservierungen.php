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