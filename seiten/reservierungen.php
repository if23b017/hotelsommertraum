<div class="container" style="margin-bottom: 100px;">
    <h1>Ihre Reservierungen</h1>
    <div class="d-grid gap-3 col-6 mx-auto">
        <h3 style="text-align: justify;">
            <?php
            require_once 'utils/dbaccess.php';

            // Abfrage des Benutzers anhand der E-Mail aus dem Cookie
            $sql = "SELECT * FROM users WHERE email = '" . $_COOKIE["email"] . "'";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?page=landing&error=stmtfailed");
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $userId = $row["userId"];

            // Abfrage der Reservierungen des Benutzers anhand der Benutzer-ID
            $sql = "SELECT * FROM reservations WHERE FK_userId = '" . $userId . "'";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?page=landing&error=stmtfailed");
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Überprüfen, ob Reservierungen vorhanden sind
            if ($result->num_rows > 0) {
                $number = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // Überprüfen und Zuweisen von Werten für Frühstück, Parkplatz und Haustiere
                    if ($row["breakfast"] == 1) {
                        $breakfast = "inkludiert";
                    } else {
                        $breakfast = "nicht inkludiert";
                    }
                    if ($row["parking"] == 1) {
                        $parking = "inkludiert";
                    } else {
                        $parking = "nicht inkludiert";
                    }
                    if ($row["pets"] == 1) {
                        $pets = "inkludiert";
                    } else {
                        $pets = "nicht inkludiert";
                    }

                    // Ausgabe der Reservierungsinformationen
                    echo "Reservierung " . $number . "<br>";
                    echo "Zimmer: " . $row["room"] . "<br>";
                    echo "Anreise: " . $row["arrivaltime"] . "<br>";
                    echo "Abreise: " . $row["departuretime"] . "<br>";
                    echo "Frühstück: " . $breakfast . "<br>";
                    echo "Parkplatz: " . $parking . "<br>";
                    echo "Haustiere: " . $pets . "<br>";
                    echo "Preis: " . $row["sum"] . "€<br>";
                    echo "Reservierungsdatum: " . date("d.m.y", strtotime($row["reservationDate"])) . "<br>";
                    echo "Status: " . $row["status"] . "<br>";
                    echo "<br>";
                    $number++;
                }
            } else {
                echo "Sie haben noch keine Reservierungen getätigt!";
            }
            ?>
        </h3>
    </div>
</div>