<?php
// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_COOKIE["email"])) {
    header("Location: index.php?page=landing&error=notloggedin");
    exit();
}
?>

<?php
// Erforderliche Dateien einbinden
require_once 'utils/dbaccess.php';
require_once 'utils/functions.php';
?>

<h1>Ihr Account</h1>

<div class="container" style="margin-bottom: 100px;">

    <?php
    // Variablen initialisieren
    $firstname = $lastname = $email = $date = $password = $newPassword = "";
    $passwordErr = $passwordErrident = $newPasswordErr = $passwordErrLength =
        $passwordErrNumber = $passwordErrBig = $passwordErrLow = $wrongOldPassword = "";

    // Benutzerdaten aus der Datenbank abrufen
    $sql = "SELECT * FROM users WHERE email = '" . $_COOKIE["email"] . "'";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landing&error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($resultData);
    $firstname = test_input($row["firstname"]);
    $lastname = test_input($row["lastname"]);
    $email = test_input($row["email"]);
    $date = test_input($row["birthdate"]);
    $birthDate = date("Y-m-d", strtotime($date));

    // Überprüfen, ob das Formular abgeschickt wurde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["form"])) {
            if ($_POST["form"] == "profile") {
                // Profildaten validieren und aktualisieren
                if (isset($_POST["firstname"])) {
                    $firstname = test_input($_POST["firstname"]);
                }
                if (isset($_POST["lastname"])) {
                    $lastname = test_input($_POST["lastname"]);
                }
                if (isset($_POST["email"])) {
                    $email = test_input($_POST["email"]);
                }
                if (isset($_POST["date"])) {
                    $date = test_input($_POST["date"]);
                }

                $birthDate = date("Y-m-d", strtotime($date));

                $sql = "UPDATE users SET firstname = ? , lastname = ? , email = ?, birthdate = ? WHERE email = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: index.php?page=landing&error=stmtFailed");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $birthDate, $_COOKIE["email"]);
                mysqli_stmt_execute($stmt);

            } elseif ($_POST["form"] == "password") {
                // Passwort ändern
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["form"])) {
                        if ($_POST["form"] == "password") {
                            if (empty($_POST["oldPassword"]) || empty($_POST["newPassword"]) || empty($_POST["newPassword2"])) {
                                $passwordErr = "*Alle Felder müssen ausgefüllt werden";
                            } else {
                                $oldPassword = $_POST["oldPassword"];
                                $hashedPassword = $row["password"];

                                // Überprüfen, ob das alte Passwort korrekt ist und das neue Passwort mit der Bestätigung übereinstimmt
                                if (password_verify($oldPassword, $hashedPassword) && $_POST["newPassword"] == $_POST["newPassword2"]) {
                                    $newPassword = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
                                    $sql = "UPDATE users SET password = ? WHERE email = ?";
                                    $stmt = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                        header("Location: index.php?page=landing&error=stmtFailed");
                                        exit();
                                    }
                                    mysqli_stmt_bind_param($stmt, "ss", $newPassword, $_COOKIE["email"]);
                                    mysqli_stmt_execute($stmt);
                                    echo '<div class="alert alert-success" role="alert" style="width: 50%; margin: 0 auto; margin-bottom: 20px";>
                                            Passwort erfolgreich geändert!
                                            </div>';
                                }

                                // Neues Passwort validieren
                                if (isset($_POST["newPassword"])) {
                                    $password = test_input($_POST["newPassword"]);
                                }
                                if (empty($_POST["oldPassword"]) || empty($_POST["newPassword"]) || empty($_POST["newPassword2"])) {
                                    $passwordErr = "*Passwort erforderlich";
                                }
                                if (strlen($_POST["newPassword"]) < 8) {
                                    $passwordErrLength = "*Passwort muss mindestens 8 Zeichen lang sein";
                                }
                                if (!preg_match("#[0-9]+#", $password)) {
                                    $passwordErrNumber = "*Passwort muss mindestens eine Zahl enthalten";
                                }
                                if (!preg_match("#[A-Z]+#", $password)) {
                                    $passwordErrBig = "*Passwort muss mindestens einen Großbuchstaben enthalten";
                                }
                                if (!preg_match("#[a-z]+#", $password)) {
                                    $passwordErrLow = "*Passwort muss mindestens einen Kleinbuchstaben enthalten";
                                }
                                if (isset($_POST["newPassword"])) {
                                    if ($_POST["newPassword"] != $_POST["newPassword2"]) {
                                        $passwordErrident = "*Passwörter sind nicht ident!";
                                    }
                                }
                                if (isset($_POST["oldPassword"])) {
                                    $oldPassword = $_POST["oldPassword"];
                                    $hashedPassword = $row["password"];

                                    if (!password_verify($oldPassword, $hashedPassword)) {
                                        $wrongOldPassword = "*Altes Passwort ist falsch!";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>


    <div class="container mb-3">
        <div class="d-grid gap-4 col-md-5 mx-auto">
            <a class="btn btn-primary" role="button" href="index.php?page=reservierungen">Meine Reservierungen</a>
        </div>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=account" ?>">
        <input type="hidden" name="form" value="profile">
        <div class="container">
            <div class="d-grid gap-3 col-md-5 mx-auto">
                <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                    value="<?php echo $firstname; ?>">
                <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                    value="<?php echo $lastname; ?>">
                <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" tabindex="3"
                    value="<?php echo $email; ?>" readonly>
                <input type="date" class="form-control" name="date" tabindex="4" value="<?php echo $birthDate; ?>">

                <div class="mb-3">
                    <div class="d-grid gap-4 col-md-5 mx-auto">
                        <input class="btn btn-primary" type="submit" value="Änderungen übernehmen" tabindex="5">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <h3>Passwort ändern:</h3>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=account" ?>">
        <input type="hidden" name="form" value="password">
        <div class="container">
            <div class="d-grid gap-4 col-md-5 mx-auto">
                <input data-toggle="password" class="form-control" type="password" name="oldPassword"
                    placeholder="Altes Passwort" tabindex="6">
            </div>

            <div class="mb-3"></div>

            <div class="d-grid gap-3 col-md-5 mx-auto">
                <input data-toggle="password" class="form-control" type="password" name="newPassword"
                    placeholder="Neues Passwort" tabindex="7">
                <input data-toggle="password" class="form-control" type="password" name="newPassword2"
                    placeholder="Neues Passwort wiederholen" tabindex="8">

                <div class="mb-3">
                    <div class="d-grid gap-4 col-md-5 mx-auto">
                        <input class="btn btn-primary" type="submit" value="Passwort ändern" tabindex="9">
                    </div>
                </div>

                <div class="error">
                    <p style="color: red;">
                        <?php echo $wrongOldPassword; ?>
                    </p>
                    <p style="color: red;">
                        <?php echo $passwordErr; ?>
                    </p>
                    <p style="color: red;">
                        <?php echo $passwordErrLength; ?>
                    </p>
                    <p style="color: red;">
                        <?php echo $passwordErrNumber; ?>
                    </p>
                    <p style="color: red;">
                        <?php echo $passwordErrBig; ?>
                    </p>
                    <p style="color: red;">
                        <?php echo $passwordErrLow; ?>
                    </p>
                    <p style="color: red;">
                        <?php echo $passwordErrident; ?>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>