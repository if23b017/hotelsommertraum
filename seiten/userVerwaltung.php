<?php

/*if ($_SESSION['role'] !== 'admin') {
    header("location: index.php?page=landing&error=notAdmin");
    exit();
}*/

require_once 'utils/dbaccess.php';

$sql = "SELECT * FROM users;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?page=landing&error=stmtfailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


//TODO: code fixen

if ($result->num_rows > 0) {
    ?>
    <div class="login-box d-flex justify-content-center align-items-center" style="width: 90%; max-width: 42rem;">
        <div style="text-align: center;">
            <h1>User</h1>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $userId = $row["userId"];
                $anrede = ($row["gender"] == "H") ? "Herr" : "Frau";
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $date = $row["birthdate"];
                $email = $row["email"];
                $role = $row["role"];
                if ($row["active"] == 1) {
                    $active = "derzeit aktiv";
                } else {
                    $active = "derzeit nicht aktiv";
                }
                //TODO: HTML Code + active
                ?>
                <div class="user-info">
                    <form method="post" id="user-form"
                        action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=userVerwaltung"); ?>">
                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        <label for="gender">Geschlecht:</label>
                        <input type="text" name="gender" value="<?php echo $anrede; ?>"><br>

                        <label for="firstname">Vorname:</label>
                        <input type="text" name="firstname" value="<?php echo $firstname; ?>"><br>

                        <label for="lastname">Nachname:</label>
                        <input type="text" name="lastname" value="<?php echo $lastname; ?>"><br>

                        <label for="birthdate">Geburtsdatum:</label>
                        <input type="text" name="birthdate" value="<?php echo $date; ?>"><br>

                        <label for="email">Email:</label>
                        <input type="text" name="email" value="<?php echo $email; ?>"><br>

                        <label for="role">Benutzertyp:</label>
                        <input type="text" name="role" value="<?php echo $role; ?>"><br>

                        <input type="submit" value="Aktualisieren">
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
} else {
    echo "Keine Benutzer gefunden.";
}
mysqli_stmt_close($stmt);
?>


<?php
//TODO: User updaten

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    if ($_POST["gender"] == "Herr") {
        $anrede = "M";
    } else {
        $anrede = "W";
    }
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $date = $_POST["birthdate"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_POST["userId"];
        if ($_POST["gender"] == "Herr") {
            $anrede = "M";
        } else {
            $anrede = "W";
        }
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $date = $_POST["birthdate"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $role = $_POST["role"];

        $sql = "UPDATE users SET gender = ?, firstname = ?, lastname = ?, birthdate = ?, email = ?, password = ?, role = ? WHERE userId = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: index.php?page=landing&error=stmtfailed");
            exit();
            /* Fehlermeldung */
        }

        mysqli_stmt_bind_param($stmt, "sssssssi", $anrede, $firstname, $lastname, $date, $email, $hashedPassword, $role, $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}
/* Parameter an das Statement binden */
?>