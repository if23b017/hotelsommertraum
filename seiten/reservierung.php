<?php
if (!isset($_COOKIE["email"])) {
    header("Location: index.php?page=landing&error=notloggedin");
    exit();
}
?>

<?php
require_once 'utils/functions.php';
require_once 'utils/dbaccess.php';
?>

<?php
$status = $arrival = $departure = $arrivaltime = $departuretime = $breakfast = $parking = $pets = "";
$sum = 0;
$reservationdate = date("d.m.Y", time());
$sql = "SELECT userId FROM users WHERE email = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?page=landing&error=stmtFailed");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $_COOKIE["email"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$FK_userId = $row['userId'];



function calculateSum($conn, $room, $arrival, $departure, $breakfast, $parking, $pets)
{
    if ($room == "Doppelbettzimmer") {
        $price = 50;
    } else if ($room == "Luxussuite") {
        $price = 100;
    } else if ($room == "Luxussuite mit Jacuzzi") {
        $price = 180;
    } else if ($room == "Luxussuite mit Jacuzzi und Sauna") {
        $price = 500;
    }
    $arrival = strtotime($arrival);
    $departure = strtotime($departure);
    $days = ($departure - $arrival) / 86400;
    $sum = $price * $days;
    if ($breakfast == 1) {
        $sum += 10 * $days;
    }
    if ($parking == 1) {
        $sum += 5 * $days;
    }
    if ($pets == 1) {
        $sum += 10 * $days;
    }
    return $sum;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room = $_SESSION['zimmer'];
    if (isset($_POST["arrival"])) {
        $arrival = test_input($_POST["arrival"]);
        $arrivaltime = date("d.m.Y", strtotime($arrival));
    }
    if (isset($_POST["departure"])) {
        $departure = test_input($_POST["departure"]);
        $departuretime = date("d.m.Y", strtotime($departure));
    }
    if (isset($_POST["breakfast"])) {
        $breakfast = 1;
    } else {
        $breakfast = 0;
    }
    if (isset($_POST["parking"])) {
        $parking = 1;
    } else {
        $parking = 0;
    }
    if (isset($_POST["tiere"])) {
        $pets = 1;
    } else {
        $pets = 0;
    }
    $sum = calculateSum($conn, $room, $arrival, $departure, $breakfast, $parking, $pets);
}
?>

<div class="container" style="margin-bottom: 100px;">
    <h1>Reservieren</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=reservierung"; ?>">
        <div class="d-grid gap-3 col-4 mx-auto">
            <div class="mb-3">
                <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $_SESSION['zimmer'] ?>"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">
                    <p>Anreisedatum</p>
                </label>
                <input type="date" class="form-control" name="arrival" value="<?php echo $arrivaltime; ?>">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">
                    <p>Abreisedatum</p>
                </label>
                <input type="date" class="form-control" name="departure" value="<?php echo $departuretime; ?>">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="breakfast">
                <label class="form-check-label" for="flexCheckDefault">
                    <p>Frühstück (10€ pro Tag)</p>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="parking">
                <label class="form-check-label" for="flexCheckDefault">
                    <p>Parkplatz (5€ pro Tag)</p>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="tiere">
                <label class="form-check-label" for="flexCheckDefault">
                    <p>Haustiere (10€ pro Tag)</p>
                </label>
            </div>
            <div class="d-grid gap-3 col-3 mx-auto">
                <input class="btn btn-primary" type="submit" value="Buchen">
            </div>

            <br>

            <?php



            //TODO: zeitliche Verfügbarkeit checken
            if (isset($departuretime) && isset($arrivaltime)) {
                $reservationdate = date("Y-m-d", strtotime($reservationdate));
                $timestamp = time();
                $today = date("d.m.Y", $timestamp);
                if ($arrivaltime <= $today) { ?>
                    <p style="color: red;">Anreisedatum muss nach
                        <?php echo $today ?> sein!
                    </p>
                <?php } else if ($departuretime <= $arrivaltime) { ?>
                        <p style="color: red;">Anreisedatum muss vor Abreisedatum liegen!</p>
                <?php } else {
                    $sql = "INSERT INTO reservations (room, arrivaltime, departuretime, breakfast, pets, parking, sum, reservationdate, FK_userId) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: index.php?page=landing&error=stmtFailed");
                        exit();
                    }

                    mysqli_stmt_bind_param($stmt, "sssiiiisi", $room, $arrivaltime, $departuretime, $breakfast, $pets, $parking, $sum, $reservationdate, $FK_userId);
                    mysqli_stmt_execute($stmt);
                    if ($breakfast == 1) {
                        $breakfast = "inkludiert";
                    } else {
                        $breakfast = "nicht inkludiert";
                    }
                    if ($parking == 1) {
                        $parking = "inkludiert";
                    } else {
                        $parking = "nicht inkludiert";
                    }
                    if ($pets == 1) {
                        $pets = "inkludiert";
                    } else {
                        $pets = "nicht inkludiert";
                    }
                    ?>
                        <div class="alert alert-success" role="alert">Deine Reise vom
                        <?php echo $arrivaltime ?> bis
                        <?php echo $departuretime ?>
                            wurde mit folgenden Bemerkungen gebucht: Frühstück
                        <?php echo $breakfast ?> Parkplatz
                        <?php echo $parking ?> Haustiere
                        <?php echo $pets ?>

                        </div>
                    <?php
                }
            }
            ?>
        </div>
    </form>
</div>