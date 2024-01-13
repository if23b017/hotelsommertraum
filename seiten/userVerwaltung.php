<?php include 'utils/head.php'; ?>

<?php /*if ($_SESSION['role'] !== 'admin') {
header("location: index.php?page=landing&error=notAdmin");
exit();
}*/?>

<?php
require_once 'utils/dbaccess.php';
?>

<?php
//TODO: User updaten

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    if ($_POST["gender"] == "Herr") {
        $anrede = "H";
    } else {
        $anrede = "F";
    }
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $date = $_POST["birthdate"];
    $email = $_POST["email"];
    $role = $_POST["role"];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_POST["userId"];
        if ($_POST["gender"] == "Herr") {
            $anrede = "H";
        } else {
            $anrede = "F";
        }
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $date = $_POST["birthdate"];
        $email = $_POST["email"];
        $role = $_POST["role"];

        $sql = "UPDATE users SET gender = ?, firstname = ?, lastname = ?, birthdate = ?, email = ?, role = ? WHERE userId = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: index.php?page=landing&error=stmtfailed");
            exit();
            /* Fehlermeldung */
        }

        mysqli_stmt_bind_param($stmt, "ssssssi", $anrede, $firstname, $lastname, $date, $email, $role, $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}
/* Parameter an das Statement binden */
?>

<?php

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
    <div class="login-box d-flex justify-content-center align-items-center"
        style="width: 100%; display: flex; justify-content: center; align-items: center; margin-bottom: 100px;">
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
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=userVerwaltung"); ?>">
                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        <div class="user-info-row">
                            <div class="user-info-column" style="margin-bottom: 10px;">
                                <label for="gender" style="display: inline-block; width: 150px;">Geschlecht:</label>
                                <select name="gender" style="width: 225px;">
                                    <option value="Herr" <?php if ($anrede == "Herr")
                                        echo "selected"; ?>>Herr</option>
                                    <option value="Frau" <?php if ($anrede == "Frau")
                                        echo "selected"; ?>>Frau</option>
                                </select>
                            </div>
                            <div class="user-info-column" style="margin-bottom: 10px;">
                                <label for="firstname" style="display: inline-block; width: 150px;">Vorname:</label>
                                <input type="text" name="firstname" value="<?php echo $firstname; ?>" style="width: 225px;">
                            </div>
                            <div class="user-info-column" style="margin-bottom: 10px;">
                                <label for="lastname" style="display: inline-block; width: 150px;">Nachname:</label>
                                <input type="text" name="lastname" value="<?php echo $lastname; ?>" style="width: 225px;">
                            </div>
                            <div class="user-info-column" style="margin-bottom: 10px;">
                                <label for="birthdate" style="display: inline-block; width: 150px;">Geburtsdatum:</label>
                                <input type="date" name="birthdate" value="<?php echo $date; ?>" style="width: 225px;">
                            </div>
                            <div class="user-info-column" style="margin-bottom: 10px;">
                                <label for="email" style="display: inline-block; width: 150px;">Email:</label>
                                <input type="email" name="email" value="<?php echo $email; ?>" style="width: 225px;">
                            </div>
                            <div class="user-info-column" style="margin-bottom: 10px;">
                                <label for="role" style="display: inline-block; width: 150px;">Benutzertyp:</label>
                                <select name="role" style="width: 225px;">
                                    <option value="user" <?php if ($role == "user")
                                        echo "selected"; ?>>User</option>
                                    <option value="admin" <?php if ($role == "admin")
                                        echo "selected"; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="user-info-column" style="margin: 20px;">
                                <input type="submit" value="Aktualisieren" style="width: 225px;">
                            </div>
                        </div>
                    </form>
                </div>
                <br>
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