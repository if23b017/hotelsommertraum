<div class="container" style="margin-bottom: 100px;">
    <h1>Reservieren</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="d-grid gap-3 col-4 mx-auto">
            <div class="mb-3">
                <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $_SESSION['zimmer'] ?>"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">
                    <p>Anreisedatum</p>
                </label>
                <input type="date" class="form-control" name="arrival" value="<?php echo $arrival; ?>">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">
                    <p>Abreisedatum</p>
                </label>
                <input type="date" class="form-control" name="departure" value="<?php echo $departure; ?>">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="breakfast">
                <label class="form-check-label" for="flexCheckDefault">
                    <p>Frühstück</p>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="parking">
                <label class="form-check-label" for="flexCheckDefault">
                    <p>Parkplatz</p>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="tiere">
                <label class="form-check-label" for="flexCheckDefault">
                    <p>Haustiere</p>
                </label>
            </div>
            <div class="d-grid gap-3 col-3 mx-auto">
                <input class="btn btn-primary" type="submit" value="Buchen">
            </div>

            <br>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $arr = $dep = $arrival = $departure = $breakfast = $parking = $tiere = "";
                if (isset($_POST["arrival"])) {
                    $arr = test_input($_POST["arrival"]);
                    $arrival = date("d.m.Y", strtotime($arr));
                }
                if (isset($_POST["departure"])) {
                    $dep = test_input($_POST["departure"]);
                    $departure = date("d.m.Y", strtotime($dep));
                }
                if (isset($_POST["breakfast"])) {
                    $breakfast = "inklusiv";

                } else {
                    $breakfast = "nicht inklusiv";
                }
                if (isset($_POST["parking"])) {
                    $parking = "inklusiv";

                } else {
                    $parking = "nicht inklusiv";
                }
                if (isset($_POST["tiere"])) {
                    $tiere = "inklusiv";

                } else {
                    $tiere = "nicht inklusiv";
                }
                $_SESSION['arrival'] = $arrival;
                $_SESSION['departure'] = $departure;
                $_SESSION['breakfast'] = $breakfast;
                $_SESSION['parking'] = $parking;
                $_SESSION['tiere'] = $tiere;
            }
            if (isset($departure) && isset($arrival)) {

                $timestamp = time();
                $today = date("d.m.Y", $timestamp);
                if ($arrival <= $today) {
                    echo '<p style="color: red;">Anreisedatum muss nach ' . $today . ' sein!</p>';
                } else if ($departure <= $arrival) {
                    echo '<p style="color: red;">Anreisedatum muss vor Abreisedatum liegen!</p>';
                } else {
                    echo '<div class="alert alert-success" role="alert">Deine Reise vom ' . $arrival . ' bis ' . $departure .
                        ' wurde mit folgenden Bemerkungen gebucht: Frühstück ' . $breakfast . ', Parkplatz ' . $parking .
                        ', Haustiere ' . $tiere . '</div>';
                    //FIXME: auf richtige Seite umleiten
                    ?>
                        <a href="reservierungen.php">
                            <h3>Meine Buchungen</h3>
                        </a>
                <?php }
            }

            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
        </div>
    </form>
</div>