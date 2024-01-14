<?php

if ($_SESSION["admin"] !== true) {
    header("location: index.php?page=landing&error=notAdmin");
    exit();
}

require_once "utils/dbaccess.php";
?>




<h1>Reservierung</h1>

<?php
$sql = "SELECT * FROM reservations;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?page=landing&error=stmtfailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

/* Überprüfung ob zumindest eine Reservierung in der Datenbank ist */
if ($result->num_rows > 0) {

    $number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $sql2 = "SELECT * FROM users WHERE userId = '" . $row["FK_userId"] . "'";
        $stmt2 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
            header("location: index.php?page=landing&error=stmtfailed");
            exit();
        }
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        $row2 = mysqli_fetch_assoc($result2);
        $room = $row["room"];
        $arrivaltime = date("d.m.Y", strtotime($row["arrivaltime"]));
        $departuretime = date("d.m.Y", strtotime($row["departuretime"]));
        $sum = $row["sum"] . "€";
        $status = $row["status"];
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
        if ($row2["gender"] == "H") {
            $anrede = "Herr";
        } else {
            $anrede = "Frau";
        } ?>

        <?php
        //TODO: Reservierung updaten

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $reservationId = $_POST['reservation_id'];
            $arrivaltime = $_POST['arrivaltime'];
            $departuretime = $_POST['departuretime'];
            $room = $_POST['reservierungsnummer'];
            $breakfast = $_POST['breakfast'] == 'inkludiert' ? 1 : 0;
            $parking = $_POST['parking'] == 'inkludiert' ? 1 : 0;
            $pets = $_POST['pets'] == 'inkludiert' ? 1 : 0;
            $status = $_POST['role'];

            $sql = "UPDATE reservations SET arrivaltime = ?, departuretime = ?, room = ?, sum = ?, breakfast = ?, parking = ?, pets
= ?, status = ? WHERE reservationId = ?";

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: index.php?page=landing&error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param(
                $stmt,
                "ssssiiiss",
                $arrivaltime,
                $departuretime,
                $room,
                $sum,
                $breakfast,
                $parking,
                $pets,
                $status,
                $reservationId
            );
            mysqli_stmt_execute($stmt);
        }

        //TODO: Filter mithilfe eines weiteren Formulars und verschiedenen SELECT-Statements einbauen
        ?>


        <div class="d-flex justify-content-center align-items-center" style="width: 100%; margin-bottom: 50px;">
            <div style="text-align: center;">
                <p>
                    <?php echo $anrede ?>
                    <?php echo $row2["firstname"] ?>
                    <?php echo $row2["lastname"] ?>
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="width: 100%; margin-bottom: 100px;">
            <form method="post" id="reservation-form"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=reservierungsverwaltung"); ?>">
                <input type="hidden" name="reservation_id" value="<?php echo $row['reservationID']; ?>
                <div class=" user-info-row">
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="reservierungsnummer" style="display: inline-block; width: 150px;">Reservierung:</label>
                    <input type="text" name="reservierungsnummer" style="width: 225px" ; value="<?php echo $number; ?>"
                        disabled>
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="arrivaltime" style="display: inline-block; width: 150px;">Anreise:</label>
                    <input type="date" name="arrivaltime" value="<?php echo date('Y-m-d', strtotime($arrivaltime)); ?>"
                        style="width: 225px;">
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="departuretime" style="display: inline-block; width: 150px;">Abreise:</label>
                    <input type="date" name="departuretime" value="<?php echo date('Y-m-d', strtotime($departuretime)); ?>"
                        style="width: 225px;">
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="reservierungsnummer" style="display: inline-block; width: 150px;">Zimmer:</label>
                    <select name="reservierungsnummer" style="width: 225px;">
                        <option value="1" <?php if ($room == "Doppelbettzimmer")
                            echo "selected"; ?>>Doppelbettzimmer</option>
                        <option value="2" <?php if ($room == "Luxussuite")
                            echo "selected"; ?>>Luxussuite</option>
                        <option value="3" <?php if ($room == "Luxussuite mit Jacuzzi")
                            echo "selected"; ?>>Luxussuite mit
                            Jacuzzi</option>
                        <option value="4" <?php if ($room == "Luxussuite mit Jacuzzi und Sauna")
                            echo "selected"; ?>>Luxussuite
                            mit Jacuzzi und Sauna
                        </option>
                    </select>
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="sum" style="display: inline-block; width: 150px;">Preis:</label>
                    <input type="text" name="sum" value="<?php echo $sum; ?>" style="width: 225px;" disabled>
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="breakfast" style="display: inline-block; width: 150px;">Frühstück:</label>
                    <select name="breakfast" style="width: 225px;">
                        <option value="inkludiert" <?php if ($breakfast == "1")
                            echo "selected"; ?>>inkludiert</option>
                        <option value="nicht inkludiert" <?php if ($breakfast == "0")
                            echo "selected"; ?>>nicht
                            inkludiert</option>
                    </select>
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="parking" style="display: inline-block; width: 150px;">Parkplatz:</label>
                    <select name="parking" style="width: 225px;">
                        <option value="inkludiert" <?php if ($parking == "1")
                            echo "selected"; ?>>inkludiert</option>
                        <option value="nicht inkludiert" <?php if ($parking == "0")
                            echo "selected"; ?>>nicht
                            inkludiert</option>
                    </select>
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="pets" style="display: inline-block; width: 150px;">Haustiere:</label>
                    <select name="pets" style="width: 225px;">
                        <option value="inkludiert" <?php if ($pets == "1")
                            echo "selected"; ?>>inkludiert</option>
                        <option value="nicht inkludiert" <?php if ($pets == "0")
                            echo "selected"; ?>>nicht
                            inkludiert</option>
                    </select>
                </div>
                <div class="reservation-form-column" style="margin-bottom: 10px;">
                    <label for="role" style="display: inline-block; width: 150px;">Status:</label>
                    <select name="role" style="width: 225px;">
                        <option value="neu" <?php if ($status == "neu")
                            echo "selected"; ?>>Neu</option>
                        <option value="storno" <?php if ($status == "storniert")
                            echo "selected"; ?>>Storniert</option>
                        <option value="bestätigt" <?php if ($status == "bestätigt")
                            echo "selected"; ?>>Bestätigt</option>
                    </select>
                </div>
                <div class="reservation-form-column" style="margin: 20px; text-align: center;">
                    <input type="submit" value="Aktualisieren" style="width: 225px;">
                </div>
        </div>
        </form>
        </div>
        <?php
        $number++;
    }
} else {
    echo "Es gibt noch keine Reservierungen!";
}
?>